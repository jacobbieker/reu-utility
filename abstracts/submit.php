<?php

include ('../databases.php');

/*
 * Set the field in Filemaker according to the
 * $_POST value from the form provided.
 */
function setFieldData($record, $keys) {
	$result = array();
	foreach ($keys as $fieldname) {
		$value = null;
		if (!strpos($fieldname, " ")) {
			$value = $_POST[$fieldname];
		} else {
			$value = $_POST[str_replace(" ", "_", $fieldname)];
		}
		if (strlen($value) > 0) {
			$record->setField($fieldname, $value);
		} elseif (strlen($record->getField($fieldname)) > 0) {
			$record->setField($fieldname, null);
		}
	}
	return $result;
}


/*
 * Main function of the program which executes the other
 * functions, sets special cases and executes the commit.
 */
function execSub($db_key, $rec, $keys) {
	global $fm, $db_layout;
	if (array_key_exists('recid', $_GET)) {
		$rec = $fm->getRecordById($db_layout[$db_key], $_GET['recid']);
	} else {
		echo "Record addition failed: No existing record of this ID #.";
		exit;
	}
	if ($_POST['AbstractMonth'] == "" || $_POST['AbstractDay'] == "")
		$_POST['AbstractDate'] = "";
	else
		$_POST['AbstractDate'] = $_POST['AbstractMonth'] . " " . $_POST['AbstractDay'] . ", " . $_POST['AbstractYear'];

	// set field data from form data
	setFieldData($rec, $keys);


	// commit record to database
	$result = $rec->commit();

	if (FileMaker::isError($result)) {
		echo 'Record addition failed: ' . $result->getMessage() . "\n";
		exit;
	}
	emailToUs($db_key, $rec);
}



/*
 * Sends the email with all of the abstract data
 * to the owner of the program.
 */
function emailToUs($db_key, $rec) {
	global $email_to, $email_from;
	$subject = $rec->getField('NameFull') . " has updated their abstract.";

	$message = $rec->getField('NameFull') . "\n";
	$message .= "Updated: " . $rec->getField('AbstractDate') . "\n";
	$message .= $rec->getField('AbstractTitle') . "\n";
	$message .= $rec->getField('Abstract');
	
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


$db_key = 'application';
$keys = array('AbstractTitle', 'AbstractDate', 'Abstract');
$rec = null;
execSub($db_key, $rec, $keys);
redirectPage();
		
?>