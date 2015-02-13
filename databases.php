<?php
	/* 
	 * List of databases and associated information for the system.
	 * and the layouts associated with each.
	 * Includes application and evaluations.
	 */
	 
	require_once ('FileMaker.php');
	
	$fm = new FileMaker();
	
	// Specify the Host - (localhost)
	$fm->setProperty('hostspec', 'http://localhost');
	
	
	// These variables will later be set by a launch page 
	//(or the setup layout in filemaker) instead of being
	// manually inputted.
	$db = 'IRO';
	$user = ''; // CHANGE THIS
	$password = ''; // CHANGE THIS
	
	// Username and password can be set up in filemaker
	// in File -> Manage -> Security. User must have access
	// to PHP publishing.
	$fm->setProperty('username', $user);
	$fm->setProperty('password', $password);
	
	
	$fm->setProperty('database', $db);
	$rec = $fm->getRecordById('Setup', '5'); // Get fields from Setup Layout
	// Error Checking to see if record exists.
	if (FileMaker::isError($rec)) {
	    echo "Error: {$result->getMessage()}\n";
	    exit;
	}
	
	
	
	// Main global variables
	$year = $rec->getField('createdYR');
	$webFront = $rec->getField('WebsiteURL');
	$webFront = rtrim($webFront, '/').'/';
	$pgmName = $rec->getField('PgmName');
	$pgmAcronym = ($rec->getField('PgmAcronym') == "" ? $rec->getField('PgmName') :$rec->getField('PgmAcronym'));
	$emails = $rec->getField('AdminEmail');
	$adminName = $rec->getField('AdminName');
	$phoneNumber = $rec->getField('PhoneNumber');
	$faxNumber = $rec->getField('FaxNumber');
	$color = $rec->getField('AccentColor');
	$logo = $rec->getField('LogoURL');
	
	
	
	// Function to set account permissions on each page
	function getPermissions($name) {
		global $rec;
		$perm = array(
			"Faculty" => false,
			"Mentor" => false,
			"Intern" => false,
			"Admin" => true,
			"Login" => false
		);
		if ($name == "login") {
			$perm["Faculty"] = true;
			$perm["Mentor"] = true;
			$perm["Intern"] = true;
			$perm["Login"] = true;
			return $perm;
		}
		
		$vals = $rec->getField($name . "_perm");
		if (strpos($vals, 'Faculty') !== false) {
    		$perm["Faculty"] = true;
		}
		if (strpos($vals, 'Mentor') !== false) {
    		$perm["Mentor"] = true;
		}

		if (strpos($vals, 'Intern') !== false) {
    		$perm["Intern"] = true;
		}
		return $perm;
	}
	

	
	$db_name = array(); // Name of the database
	$db_layout = array(); // Name of the appropriate layout
	$success_message = array(); // Subject name for emails.
	$email_to = array(); // Email the data to
	

	// Applications
	$db_name['application'] = $db;
	$db_layout['application'] = 'Applicants';
	$success_message['application'] = 'Thank you for your application.';
	$email_to['application'] = $emails;
	$email_from['application'] = $emails;
	
	// Professors
	$db_name['profs'] = $db;
	$db_layout['profs'] = 'Professors';
	$success_message['profs'] = 'Thank you for your application.';
	$email_to['profs'] = $emails;
	$email_from['profs'] = $emails;

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