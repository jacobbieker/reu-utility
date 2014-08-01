<?php
/* 
 * Checks the hash generated against the
 * hash stored in the database.
 */

require('hash.php');
require_once ('FileMaker.php');
include ('../databases.php');


$record = $fm->getRecordById('Setup', 1);

session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['loggedIn'] = false;
}

if (isset($_POST['password'])) {
	$password = $_POST['password'];
	$hasher = new PasswordHash(8, false);
	if (strlen($password) > 72) { die("Password must be 72 characters or less"); }
	$stored_hash = "*";
	$stored_hash = $record->getField('facultyPWHash');
	$check = $hasher->CheckPassword($password, $stored_hash);
	
    if ($check) {
        $_SESSION['loggedIn'] = true;
    } else {
        die ('Incorrect password');
    }
    
}
?>