<?php
include ('../databases.php');
include "../layout/header.php";

$type = "Poster";
$url = "poster.php";
if ($_GET['type'] == "pres") {
	$type = "Presentation";
	$url = "presentation.php";
}

$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Upload " . $type => $webFront . "presentations/" . $url,
    "Uploading Your File" => ""
);


?>

    <div class="jumbotron">
      <div class="container">
        <h1>Uploading Your File</h1>
      </div>
    </div>
    
    <div class="container">


<?php

/* 
 * Determines the new filename for the file that was
 * uploaded by the recommender. Formula:
 * (LastName)(FirstInitial)(year)LOR(number).(FileExtension)
 */
function getNewFileName($record, $year) {
	// Get the correct file extension
	$path_parts = pathinfo($_FILES["file"]["name"]);
	$ext = $path_parts['extension'];

	$newFile = $record->getField('NameLast') . substr($record->getField('NameFirst'), 0, 1) . $year . "." . $ext;
	if ($_GET['type'] == "poster")
		$newFile = $record->getField('NameLast') . substr($record->getField('NameFirst'), 0, 1) . $year . "poster." . $ext;

	return $newFile;
}


/* 
 * Uploads the file to the server in a folder called
 * uploads. If the recommender chose to write their
 * recommendations in the text box, the text will be
 * converted into a PDF format and uploaded with the
 * other files.
 */
function uploadFile($record, $newFile) {
	global $webFront, $email_to, $bread, $type;
	if ($_FILES['file']['error'] == 4) { // No upload file
		echo "<p> We did not receive your presentation file please try again to upload it. Feel free to <a href='mailto:" . $email_to[$db_key] . "'>email us</a> if you are having any techincal issues.</p>";
		exit;
	} elseif ($_FILES['file']['error'] !== UPLOAD_ERR_OK) { // Other error in upload
  	  	echo "Upload failed with error " . $_FILES['file']['error'] . $_FILES['file']['type'];
  	  	exit;
	} elseif ($_FILES['file']['error'] == UPLOAD_ERR_OK) { // Successful upload
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES['file']['tmp_name']);
		if ($ext != 'ppt') {
			switch ($mime) {
  				case 'image/jpeg':
   					break;
   				case 'image/gif':
    				break;
   				case 'image/png':
    				break;
   				case 'application/vnd.ms-powerpoint':
   					break;
   				case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
   					break;
   				case 'application/vnd.ms-powerpoint.addin.macroenabled.12':
   					break;
       	 	    case 'application/mspowerpoint':
            		break;
            	case 'application/vnd.openxmlformats-officedocument.presentationml.slideshow':
            		break;
           		case 'application/vnd.ms-powerpoint.presentation.macroenabled.12':
   					break;
   				case 'application/pdf':
   					break;
   				default:
       				echo "<p>Unknown/not permitted file type</p>";
       				exit;
    				break;
			}
		}
	
		// Save the uploaded file
		move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $newFile);
		
		echo "<p>Thank you, your " . $type .  " has been uploaded to our database.</p>";
		echo "<p><a href='" . $webFront . "'>Click here</a> to return to the main website.</p>";
		echo "File Name: " . $_FILES["file"]["name"] . "<br />";
		echo "Uploaded As: " . $newFile . "<br />";
		echo "Type: " . $_FILES["file"]["type"] . "<br />";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br />";
	}
}


/*
 * Create the text output message for both the
 * failsafe file, and the notification email.
 */
function createTextOutput($record) {
	$text = "Student Name: " . $record->getField('NameFull') . "\n";
	$text .= "URL for file: " . $_POST['file'];
	return $text;
}


/*
 * Write an extra backup file to the failsafe
 * so that we have record of the letter being
 * submitted.
 */
function failsafe($text, $newFile) {
	// Write a failsafe file
	//chmod ('failsafe', 0755);
	chdir('failsafe');
	$file = $newFile . '_backup.txt';
	$handle = fopen($file, 'w');
	fwrite($handle, $text) or die("can't open file");
	fclose($handle);
	chdir('..');
}


/*
 * Write an email notification to the program's
 * main email. To notify us that the LOR has been
 * submitted.
 */
function sendEmail($text, $db_key) {
	global $email_from, $email_to, $type;
	$text = str_replace("\n", "<br />", $text);
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'From: ' . $email_from[$db_key];
	$to = $email_to[$db_key];
	$subject =  "A new " . $type . " has been uploaded.";

	mail($to, $subject, $text, $headers);
}


/* 
 * Utility function to set field values from posted
 * data to the corresponding fields in filemaker.
 */
function setFieldData($record, $keys) {
	global $type;
	$result = array();
	foreach ($keys as $fieldname) {
		if ($fieldname == 'file') {
			if ($type == "Presentation") {
				$field = 'presentationOral';
			} elseif ($type == "Poster") {
				$field = 'presentationPoster';
			}
		} else {
			$field = $fieldname; 
		}
			
		$value = $_POST[$fieldname];
			
		// workaround PHP's insistence that spaces in
		// form variables be replaced by "_"
		if (!strpos($fieldname, " ")) {
			$value = $_POST[$fieldname];
		} else {
			$value = $_POST[str_replace(" ", "_", $fieldname)];
		}
		if (strlen($value) > 0) {
			$record->setField($field, $value);
		} elseif (strlen($record->getField($field)) > 0) {
			$record->setField($field, null);
		}
	}
	return $result;
}


/*
 * Final commit to add the new field values to
 * the database. Uses helper function setFieldData.
 */
function recordAddition($record, $keys, $db_key) {
	global $db_layout, $bread;
	// declare new record as null
	if (!array_key_exists('cancel', $_POST)) {
	
		// set field data from form data
		setFieldData($record, $keys);
		// commit record to database
		$result = $record->commit();
	
		if (FileMaker::isError($result)) {
			echo 'Record addition failed: (' . $result->getCode() . ') ' . $result->getMessage() . "\n";
			include "../layout/footer.php";
	    	exit;
		}
	}
}


function getRecordByName($db_key) {
	global $db_layout, $fm, $bread;
			//echo $db_layout[$db_key];
	$request = $fm->newFindCommand($db_layout[$db_key]);
	$request->addFindCriterion('NameFull', $_POST['NameFull']);
	$request->addSortRule('NameLast', 1, FILEMAKER_SORT_ASCEND);
	$result = $request->execute();
	if (FileMaker::isError($result)) {
	    echo "Error: {$result->getMessage()}\n";
		include "../layout/footer.php";
	    exit;
	}
	$records = $result->getRecords();
	$record = $records[0];
	// Error Checking to see if record exists.
	if (FileMaker::isError($record)) {
	    echo "Error: {$result->getMessage()}\n";
	    include "../layout/footer.php";
	    exit;
	}
	return $record->getRecordId();
}

/* Main Program function calls */

$db_key = 'application';
$fm->setProperty('database', $db_name[$db_key]);
$recid = getRecordByName($db_key);
// Field names we expect as keys in $_POST[]
$keys = array('NameFull', 'file');
$record = $fm->getRecordById($db_layout[$db_key], $recid);
// Error Checking to see if record exists.
if (FileMaker::isError($record)) {
	echo "Error: {$result->getMessage()}\n";
	exit;
}
$year = $record->getField('createdYR');
$newFile = getNewFileName($record, $year);
uploadFile($record, $newFile);
$_POST['file'] = $webFront . 'presentations/uploads/' . $newFile;
$text = createTextOutput($record, $number);
failsafe($text, $newFile);
sendEmail($text, $db_key);
recordAddition($record, $keys, $db_key);



include "../layout/footer.php";

?>