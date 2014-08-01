<?php
/*
 * Submits the data taken from the application form
 * in application.php and commits it to the database,
 * sends confirmation emails to the faculty provided
 * by the student, adds data to a textfile in the failsafe,
 * and emails the administrator with the application info.
 */

include_once ('../FileMaker.php');
require_once ('../databases.php');
include_once ('banned_ip.php');

/*
 * Combination of various validators for the application
 * Must have a db_key, must have passed the JS validator.
 * Must be from the correct reference page. Must not be a
 * blocked IP Address.
 */
function validateDB ($valid, $ip) {
	global $db_name, $db_layout, $success_message, $email_to, $email_from, $banned;
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
	       && array_key_exists($db_key, $success_message)
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
	if (in_array ($ip, $banned)) {
   		$msg = "Error: This IP Address has been blocked.";
   		$valid = false;
	}
    
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
	$html_data = '<table><tr><td>db_key</td><td>' . $db_key . '</td></tr>';
	$text_data = 'db_key: ' . $db_key . "\n";

	foreach($_POST as $key => $value) {
		$html_data .= "<tr><td> ". $key ." </td><td> ". $value ." </td></tr>\n";
		$text_data .= $key . ": " . $value . "\n";
	}

	$html_data .="</table>";
	
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
	$subject = $db_key . " Submission" ;

	$browser = getenv("HTTP_USER_AGENT");

	$message  = "Received from " . $ip . ", using " . $browser . "\n\n";
	$message .= $text_data;
	
	mail($email_to[$db_key], $subject, $message, "From: \"no-reply\" <no-reply@example.com>");
	
}


/*
 * Sends the notification to the two references listed by
 * the student who applied.
 */
function emailToRefs($recID, $year, $db_key) {
	global $email_from;
	$to1 = $_POST['Faculty1_email'];
	$to2 = $_POST['Faculty2_email'];

	$subject1 = 'Letter of Recomemndation Request';
	$message1 = file_get_contents('email.html', true);
	$message1 = str_replace("[firstName]", $_POST['NameFirst'], $message1);
	$message1 = str_replace("[lastName]", $_POST['NameLast'], $message1);
	$message1 = str_replace("[year]", $year, $message1);
	$message1 = str_replace("[recid]", $recID, $message1);
	$message1 = str_replace("[number]", "1", $message1);
	
	$message2 = file_get_contents('email.html', true);
	$message2 = str_replace("[firstName]", $_POST['NameFirst'], $message1);
	$message2 = str_replace("[lastName]", $_POST['NameLast'], $message1);
	$message2 = str_replace("[year]", $year, $message1);
	$message2 = str_replace("[recid]", $recID, $message1);
	$message2 = str_replace("[number]", "2", $message1);

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'From: ' . $email_from[$db_key];


	mail($to1, $subject1, $message1, $headers);
	mail($to2, $subject1, $message2, $headers);
}



/* Key global variables for the main program */

$year = "2014"; // fix later!!
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
	emailToRefs($recID, $year, $db_key);


?>
<!doctype html>
<html>
<head>
    <title>Thank you for your submission</title>
    <style type="text/css">
		table {
    		margin: auto;
    		text-align: center;
		}

		table td {
    		padding: 5px;
    		border: 1px solid #ccc;
    		border-collapse: collapse;
		}
	</style>
</head>
<body>

    
<div style="text-align: center; margin: 30px;"><h2><?php echo $success_message[$db_key]; ?></h2></div>

<div style="text-align: center; color: #FF0000;">
<b>Please print this page as proof of your submission:</b><br>
<input type='button' value='Print Page' onClick='window.print()'>
</div>

<hr>

<div style="text-align: center;">
<p>Submission Time: <?php echo $time; ?></p>
<p>Submitted to the <?php echo $pgmName; ?> server.</p>
<h2>Submitted Data</h2>
<?php echo $html_data; ?>
</div>

</body>
</html>