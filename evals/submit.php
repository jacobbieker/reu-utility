<?php

include ('../databases.php');
include "../layout/header.php";

$time = date('l jS \of F Y h:i:s A');

?>

    <div class="jumbotron">
      <div class="container">
        <h1>Evaluation Submission</h1>
        <p>The following information was submitted to our database @ <?php echo $time; ?>. Thank you for completing your evaluation.</p>
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
function validateDB ($valid) {
	global $db_name, $db_layout, $email_to, $email_from;
	if(isset($_GET['db_key'])) {
		$db_key = $_GET['db_key'];
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

    // Kill the program if invalid
    if (!$valid) {
    	die($msg);
    }
    return $db_key;
}


/*
 * This is the main function which sends all of the
 * data entered in the form to the filemaker database.
 * returns a record ID # for the new record created.
 */
function submitToDB ($respondent_data, $fields, $db_key, $fm) {
	global $db_name, $db_layout;
	$recID;
	foreach($_POST as $key => $value) {
		if(in_array($key, $fields)) { // Verify that this field exists
			$respondent_data[$key] = stripslashes($value);
		} else {
		 	echo "Unexpected POST field: " . $key . "<br>";
		}
	}

	// Send to Filemaker Database.
	if(!isset($_GET['nocommit'])) {       
		$newRequest =& $fm->newAddCommand($db_layout[$db_key], $respondent_data);
		$result = $newRequest->execute();
		$newRecord = current($result->getRecords());
		$recID = $newRecord->getRecordID();

		//check for an error
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
function failsafe($db_key, $text_data) {
	$time = time();
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
	chdir('..');
}


/*
 * Sends the email with all of the data submission
 * to the owner of the program.
 */
function emailToUs($db_key, $ip, $text_data) {
	global $email_to, $email_from;
	$subject =  $db_key . " Submission";
	$message = $text_data;
	if( !isset($_GET['nocommit']) ) {
		mail($email_to[$db_key], $subject, $message, "From: " . $email_from[$db_key]);
	}
	
}



$db_key = validateDB(true);
$fm->setProperty('database', $db_name[$db_key]);
$layout = $fm->getLayout($db_layout[$db_key]);
$field = $layout->getFields();
$fields = array();

// Create array of field names.
foreach($field as $val) {
	$fields[] = $val->getName();
}

unset($_POST['block']);
$_POST['Timestamp'] = $time;
$respondent_data = array();
$recID = submitToDB($respondent_data, $fields, $db_key, $fm);
unset($_POST['Timestamp']);

$arr = generateTextHTML($db_key);
$text_data = $arr['text'];
$html_data = $arr['html'];

failsafe($db_key, $text_data);
emailToUs($db_key, $ip, $text_data);


if ($db_key == "pi_eval") {
	$crumb = "PI Evaluation";
	$url = $webFront . "evals/pi.php";
} elseif ($db_key == "mentor_eval") {
	$crumb = "Mentor Evaluation";
	$url = $webFront . "evals/mentor.php";
} elseif ($db_key == "intern_eval") {
	$crumb = "Intern Evaluation";
	$url = $webFront . "evals/intern.php";
}

$bread = array(
    $pgmAcronym . " Home" => $webFront,
    $crumb => $url,
    "Evaluation Submission" => ""
);


echo $html_data;
include "../layout/footer.php";

?>