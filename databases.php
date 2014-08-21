<?php
	/* 
	 * Administration file including important variables
	 * used throughout the utility, and the main filemaker
	 * object and connection to the database. Most variable
	 * values are drawn from the "Setup" layout in filemaker.
	 * Author: Sarah Yablok | contact@sarahyablok.com
	 */
	 
	require_once ('FileMaker.php');
	
	$fm = new FileMaker();
	$fm->setProperty('hostspec', 'http://localhost');
	

	// These variables will later be set by a launch page 
	//(or the setup layout in filemaker) instead of being
	// manually inputted.
	$db = 'Website Utility';
	$user = ''; // CHANGE THIS
	$password = ''; // CHANGE THIS
	
	// Username and password can be set up in filemaker
	// in File -> Manage -> Security. User must have access
	// to PHP publishing.
	$fm->setProperty('username', $user);
	$fm->setProperty('password', $password);
	
	
	$fm->setProperty('database', $db);
	$rec = $fm->getRecordById('Setup', '1'); // Get fields from Setup Layout

	// Error Checking to see if record exists.
	if (FileMaker::isError($rec)) {
	    echo "Error: {$result->getMessage()}\n";
	    exit;
	}

	// Main global variables
	$webFront = rtrim($rec->getField('WebsiteURL'), '/').'/';
	$pgmName = $rec->getField('PgmName');
	$pgmAcronym = ($rec->getField('PgmAcronym') == "" ? $rec->getField('PgmName') :$rec->getField('PgmAcronym'));
	$emails = $rec->getField('AdminEmail');
	$adminName = $rec->getField('AdminName');
	$phoneNumber = $rec->getField('PhoneNumber');
	$faxNumber = $rec->getField('FaxNumber');
	$color = $rec->getField('AccentColor');

	
	$db_name = array(); // Name of the database
	$db_layout = array(); // Name of the appropriate layout
	$success_message = array(); // Subject name for emails.
	$email_to = array(); // Email the data to
	$email_from = array(); // Default email (sent from)
	

	// Applications
	$db_name['application'] = $db;
	$db_layout['application'] = 'Everything';
	$success_message['application'] = 'Thank you for your application.';
	$email_to['application'] = $emails;
	$email_from['application'] = $emails;
	
	
	// Mentor Evaluations
	$db_name['mentor_eval'] = $db;
	$db_layout['mentor_eval'] = 'Mentor Survey';
	$success_message['mentor_eval'] = 'Thank you for your evaluation!';
	$email_to['mentor_eval'] = $emails;
	$email_from['mentor_eval'] = $emails;


	// PI Evaluations
	$db_name['pi_eval'] = $db;
	$db_layout['pi_eval'] = 'PI Survey';
	$success_message['pi_eval'] = 'Thank you for your evaluation!';
	$email_to['pi_eval'] = $emails;
	$email_from['pi_eval'] = $emails;


	// Intern Evaluations
	$db_name['intern_eval'] = $db;
	$db_layout['intern_eval'] = 'Intern Survey';
	$success_message['intern_eval'] = 'Thank you for your evaluation!';
	$email_to['intern_eval'] = $emails;
	$email_from['intern_eval'] = $emails;
	

?>