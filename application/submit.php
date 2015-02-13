<?php

require_once ('../databases.php');
include "../layout/header.php";

//include_once ('banned_ip.php');

$time = date('l jS \of F Y h:i:s A');

?>

    <div class="jumbotron">
      <div class="container">
        <h1>Application Submission</h1>
        <p>The following information was submitted to our database @ <?php echo $time; ?>. Thank you for completing your application.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>

    <div class="container">
    
<?php

/*
 * Combination of various validators for the application
 * Must have a db_key, must have passed the JS validator.
 * Must be from the correct reference page. Must not be a
 * blocked IP Address.
 */
function validateDB ($valid, $ip) {
	global $db_name, $db_layout, $email_to, $email_from;
	$msg = "";
	$db_key;
	// Does the database key exist?
	if(isset($_GET['db_key'])) {
	
		$db_key = $_GET['db_key'];
		if ($db_key === sha1('application')) {
			$db_key = 'application';
		}
						
		// Error checking for database.
		if(!(array_key_exists($db_key, $db_name) 
	       && array_key_exists($db_key, $db_layout)
	       && array_key_exists($db_key, $email_from)
	       && array_key_exists($db_key, $email_to))) {
				$msg = "Error: db_key not recognized.";
				$valid = false;
		}
		
	} else {
		$msg = "Error: db_key not recognized";
		$valid = false;
	}
	
	// JS Validator should set block value
	if($_POST['block'] != 12) {
		$msg = "Error: Did not pass validator";
		$valid = false;
		unset($_POST['block']);
	}

    // Check for the correct reference page
    if (!(isset($_POST['referencecorr']))) {
    	$msg = "Error: Reference page incorrect.";
    	$valid = false;
    	unset($_POST['referencecorr']);
    }
    
	// Check for blocked IP Adress.
	/*if (in_array ($ip, $banned)) {
   		$msg = "Error: This IP Address has been blocked.";
   		$valid = false;
	}*/
    
    // Kill the program if invalid
    if (!$valid) {
    	die($msg);
    }
    return $db_key;
}


/*
 * Did the students include their reference information?
 * And did they select to notify the references. If so,
 * Update the "Letter" fields to note that they have been
 * requested.
 */
function emailReferences($send) {
	// 'notifyLetters' is the checkbox on the application form.
	if (isset($_POST['notifyLetters'])) {
		$send = true;
		$_POST["Letter1"] = "requested";
		$_POST["Letter2"] = "requested";
		unset($_POST['notifyLetters']);
	}
	return $send;
}


/*
 * This is the main function which sends all of the
 * data entered in the form to the filemaker database.
 * returns a record ID # for the new record created.
 */
function submitToDB ($respondent_data, $fields, $db_key, $fm) {
	global $db_name, $db_layout;
	$recID;
	$respondent_data['ip_address'] = $ip; // Set IP Addr for DB
	
	// Set the values in respondent data to submit to filemaker
	foreach($_POST as $key => $value) {
		$key = str_replace("_", " ", $key);
		if(in_array($key, $fields)) { // Verify that this field exists
			$respondent_data[$key] = stripslashes($value);
		}
	}

	// Send to Filemaker Database.
	if(!isset($_GET['nocommit']) ) {       
		$newRequest =& $fm->newAddCommand($db_layout[$db_key], $respondent_data);
		$result = $newRequest->execute();
		$newRecord = current($result->getRecords());
		$recID = $newRecord->getRecordID();
		
		// Check for an error - Filemaker API
		if (FileMaker::isError($result)) {
			echo "<p>Error: " . $result->getMessage() . "<p>";
			exit;
		}
	}
	return $recID;
}


/*
 * This creates a string of HTML and a formatted string.
 * the HTML is to be displayed on the final version of
 * this page. The text data is used for the email
 * notification.
 */
function generateTextHTML($db_key) {
	// Prepare a text and HTML representation of the submitted data
	$html_data = '<table class="table table-hover" style="width: 75%; margin: 0px auto;"><thead><tr><th>Field Name</th><th>Submitted Value</th></thead><tbody>' ;
	$text_data = '';

	foreach($_POST as $key => $value) {
		$html_data .= "<tr><td> ". $key ." </td><td> ". $value ." </td></tr>\n";
		$text_data .= $key . ": " . $value . "\n";
	}

	$html_data .="</tbody></table>";
	
	$array = array(
    "html" => $html_data,
    "text" => $text_data,
	);
	return $array;
}


/*
 * Add the file to the failsafe folder in case data is
 * lost or unable to submit to the filemaker database.
 */
function failsafe($time, $db_key, $text_data) {
	// Generate a cryptological hash of the data, to verify the file
	$secret_key = 'tKaCZ8dfKK4o1WaBKlswLKecX9d81vwy';
	$hashed_data = $secret_key . $time . $db_key;
	$hash = md5($hashed_data);

	// Write a failsafe file
	chmod ('failsafe', 0755);
	chdir('failsafe');
	$file = $db_key . '_' . $hash . '.txt';
	$handle = fopen($file, 'w');
	fwrite($handle, $text_data) or die("can't open file");
	fclose($handle);
}


/*
 * Sends the email with all of the data submission
 * to the owner of the program.
 */
function emailToUs($db_key, $ip, $text_data) {
	global $email_to;
	$subject = ucfirst($db_key) . " Submission" ;

	$browser = getenv("HTTP_USER_AGENT");

	$message  = "Received from " . $ip . ", using " . $browser . "\n\n";
	$message .= $text_data;
	
	mail($email_to[$db_key], $subject, $message, "From: \"no-reply\" <no-reply@example.com>");
	
}


/*
 * Sends the notification to the two references listed by
 * the student who applied.
 */
function emailToRefs($recID, $year, $db_key, $fm) {
	global $email_from;
	$to1 = $_POST['Faculty1_email'];
	$to2 = $_POST['Faculty2_email'];
	$record = $fm->getRecordById('Email Templates', $_GET['recid']);


	$subject1 = 'Letter of Recomemndation Request';

	$change = array("n=" => "n=1");
	$message1 = strtr($record->getField('LORrequestLetterCSS'), $change);
	$message1 = html_entity_decode(chunk_split(base64_encode(html_entity_decode($message1))));
	

	$change = array("n=" => "n=2");
	$message2 = strtr($record->getField('LORrequestLetterCSS'), $change);
	$message2 = html_entity_decode(chunk_split(base64_encode(html_entity_decode($message2))));

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= 'Content-Transfer-Encoding: base64' . "\r\n";

	// Additional headers
	$headers .= 'From: ' . $email_from[$db_key];


	mail($to1, $subject1, $message1, $headers);
	mail($to2, $subject1, $message2, $headers);
}



/* Key global variables for the main program */
$ip = getenv("REMOTE_ADDR");
$db_key = validateDB(true, $ip);
$respondent_data = array(); // Array of all the submited value fields
$time = time(); // Store the time

$fm->setProperty('database', $db_name[$db_key]);
$layout = $fm->getLayout($db_layout[$db_key]);
$field = $layout->getFields();
$fields = array();

// Create array of field names, based on Filemaker fields.
foreach($field as $val) {
	$fields[] = str_replace("_", " ", $val->getName());
}

$sendRef = emailReferences(false);

$recID = submitToDB($respondent_data, $fields, $db_key, $fm);

$arr = generateTextHTML($db_key);
$text_data = $arr['text'];
$html_data = $arr['html'];

failsafe($time, $db_key, $text_data);

emailToUs($db_key, $ip, $text_data);

if ($sendRef)
	emailToRefs($recID, $year, $db_key, $fm);


echo $html_data;
include "../layout/footer.php";

?>