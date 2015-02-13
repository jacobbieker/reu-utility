<?php
	require('hash.php');
	require_once ('FileMaker.php');
	include ('../databases.php');


if ($_GET['ref'] == "db") {
	$record = $fm->getRecordById('Setup', 5);

	$hasher = new PasswordHash(8, false);

	$Fpassword = $record->getField('facultyPW');
	$Spassword = $record->getField('studentPW');
	$Mpassword = $record->getField('mentorPW');
	$Apassword = $record->getField('adminPW');

	// Passwords should never be longer than 72 characters to prevent DoS attacks
	if (strlen($password) > 72) { die("Password must be 72 characters or less"); }

	// 
	$Fhash = $hasher->HashPassword($Fpassword);
	$Shash = $hasher->HashPassword($Spassword);
	$Mhash = $hasher->HashPassword($Mpassword);
	$Ahash = $hasher->HashPassword($Apassword);

	if (strlen($Fhash) >= 20 OR strlen($Shash) >= 20 OR strlen($Mhash) >= 20) {
		$record->setField('facultyPWHash', $Fhash);
		$record->setField('studentPWHash', $Shash);
		$record->setField('mentorPWHash', $Mhash);
		$record->setField('adminPWHash', $Ahash);
		$result = $record->commit();
		echo "Passwords have been updated.";
	} else {
		die("Failed to change Passwords.");
	}
} else {
	die("Invalid reference.");
}


?>