<?php

/*
 * Submit the updated progress report to the
 * database and email the administrator to let
 * with the new progress report.
 */

require_once ('FileMaker.php');
include ('../databases.php');

/*
 * Set the field in Filemaker according to the
 * $_POST value from the form provided.
 */
function setFieldData($record, $week, $keys) {
	$result = array();
	foreach ($keys as $fieldname) {
		$value = null;
		if (!strpos($fieldname, " ")) {
			$value = $_POST[$fieldname];
		} else {
			$value = $_POST[str_replace(" ", "_", $fieldname)];
		}
		if (strlen($value) > 0) {
			$record->setField($fieldname . $week, $value);
			echo $fieldname . $week;
		} elseif (strlen($record->getField($fieldname . $week)) > 0) {
			echo $fieldname . $week;
			$record->setField($fieldname . $week, null);
		}
	}
	return $result;
}


/*
 * Main function of the program which executes the other
 * functions, sets special cases and executes the commit.
 */
function execSub($db_key, $rec, $keys, $week) {
	global $fm, $db_layout;
	if (array_key_exists('recid', $_GET) && array_key_exists('week', $_POST)) {
		$rec = $fm->getRecordById($db_layout[$db_key], $_GET['recid']);
	} else {
		echo "Record addition failed: No existing record of this ID #, or invalid week #.";
		exit;
	}
	if ($_POST['prMonth'] == "" || $_POST['prDay'] == "")
		$_POST['prDate'] = "";
	else
		$_POST['prDate'] = $_POST['prMonth'] . " " . $_POST['prDay'] . ", " . $_POST['prYear'];

	// set field data from form data
	setFieldData($rec, $week, $keys);


	// commit record to database
	$result = $rec->commit();

	if (FileMaker::isError($result)) {
		echo 'Record addition failed: ' . $result->getMessage() . "\n";
		exit;
	}
	emailToUs($db_key, $rec, $week);
}


/*
 * Sends the email with all of the abstract data
 * to the owner of the program.
 */
function emailToUs($db_key, $rec, $week) {
	global $email_to, $email_from;
	$subject = $rec->getField('NameFull') . " has updated a new progress report.";

	$message = $rec->getField('NameFull') . "\n";
	$message .= "Updated: " . $rec->getField('AbstractDate') . "\n";
	$message .= "Submitted for week # " . $week . ": " . $rec->getField('prDate' . $week) . "\n";
	$message .= $rec->getField('pr' . $week);
	
	mail($email_to[$db_key], $subject, $message, "From: " . $email_from[$db_key]);
}



/*
 * Redirect the user to the abstracts page
 * once the submission is complete.
 */
function redirectPage() {
	$r =  "index.php";
	// set Location: HTTP header to force redirect
	header("Location: $r");
}
	
	

$week = $_POST['week'];
$db_key = 'application';
$keys = array('prDate', 'pr');
$rec = null;
execSub($db_key, $rec, $keys, $week);
redirectPage();
		
?>