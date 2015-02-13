<?php
if (array_key_exists('recid', $_GET) && array_key_exists('n', $_GET)) {
	$recid = $_GET['recid'];
	$number = $_GET['n'];
} else exit;

include ('../databases.php');
include "../layout/header.php";
require('fpdf.php');

$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Upload LORs" => $webFront . "lors/upload.php?recid=" . $_GET['recid'] . "&" . "n=" . $_GET['n'],
    "Uploading Your LOR" => ""
);

?>

    <div class="jumbotron">
      <div class="container">
        <h1>Uploading Your LOR</h1>
      </div>
    </div>
    
    <div class="container">


<?php

/* 
 * Determines the new filename for the file that was
 * uploaded by the recommender. Formula:
 * (LastName)(FirstInitial)(year)LOR(number).(FileExtension)
 */
function getNewFileName($record, $year, $number) {
	// Get the correct file extension
	$ext;
	$path_parts = pathinfo($_FILES["file"]["name"]);
	if ($_POST['text'] != "" && $_FILES['file']['error'] == 4) $ext = "pdf";
	else $ext = $path_parts['extension'];

	$last = $record->getField('NameLast');
	$newFile = str_replace(" ", "-" , $last) . substr($record->getField('NameFirst'), 0, 1) . $year . "LOR" . $number . "." . $ext;
	return $newFile;
}


/* 
 * Uploads the file to the server in a folder called
 * uploads. If the recommender chose to write their
 * recommendations in the text box, the text will be
 * converted into a PDF format and uploaded with the
 * other files.
 */
function uploadFile($record, $newFile, $db_key) {
	global $webFront, $email_to, $bread, $color;
	if ($_FILES['file']['error'] == 4) { // No upload file
		if ($_POST['text'] != "") { // Text box submitted - Create PDF version
			// Path to save PDF
 			$path = "uploads/" . $newFile;
 			// Save textbox value as pdf.
			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->SetFont('Arial', '', 12);
			$pdf->MultiCell(0, 10, $_POST['text']);
			$pdf->Output($path, 'F');
			include "../layout/header.php"; // Fix for fpdf
			echo '<div class="jumbotron"><div class="container"><h1>Uploading Your LOR</h1></div></div><div class="container">';
			// Ouput success message.
			echo "<p>Thank you, the following Letter of Recommendation has been submitted to our database.</p>";
 			echo "<p><a href='" . $webFront . "'>Click here</a> to return to the home page.</p>";
 			echo "<p><i>" . nl2br($_POST['text']) . "</i></p>";
		} else {
			echo "<p> We did not receive your letter, please use the upload tool or type your letter in the box provided. Feel free to <a href='mailto:" . $email_to[$db_key] . "'>email us</a> if you are having any techincal issues.</p>";
			include "../layout/footer.php";
			exit;
		}

	} elseif ($_FILES['file']['error'] !== UPLOAD_ERR_OK) { // Other error in upload
  	  	echo "Upload failed with error " . $_FILES['file']['error'] . $_FILES['file']['type'];
  	  	exit;
	} elseif ($_FILES['file']['error'] == UPLOAD_ERR_OK) { // Successful upload
		if ($_POST['text'] != "") {
			echo "<p>Please upload a single file OR enter your letter in the text box. Do not submit both. Please go back and re-submit your letter using only one of these form fields. Please <a href='mailto:" . $email_to[$db_key] . "'>email us</a> if you are having any techincal issues.</p>";
			include "../layout/footer.php";
			exit;
		} else {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $_FILES['file']['tmp_name']);
			// Allowed MIME file types.
			switch ($mime) {
   				case 'application/msword':
   					break;
  			 	case 'image/jpeg':
   					break;
   				case 'image/gif':
    				break;
   				case 'image/png':
    				break;
   				case 'application/msword':
    				break;
  	 			case 'text/rtf':
   					break;
   				case 'text/plain':
   					break;
   				case 'application/zip':
   					break;
   				case 'application/pdf':
   					break;
   				default:
       				echo "<p>Unknown/not permitted file type</p>";
       				exit;
    				break;
			}
		
			// Save the uploaded file
 			move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $newFile);
 			// Show the success message
 			echo "<p>Thank you, your Letter of Recommendation has been uploaded to our database.</p>";
 			echo "<p><a href='" . $webFront . "'>Click here</a> to return to the main website.</p>";
 			echo "File Name: " . $_FILES["file"]["name"] . "<br />";
 			echo "Uploaded As: " . $newFile . "<br />";
   	 		echo "Type: " . $_FILES["file"]["type"] . "<br />";
    		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br />";
    	}
	}
}


/*
 * Create the text output message for both the
 * failsafe file, and the notification email.
 */
function createTextOutput($record, $number) {
	$text = "Student Name: " . $record->getField('NameFull') . "\n";
	$text .= "Recommender Information: " . $record->getField('Faculty' . $number . ' name') . "\n";
	$text .= "Recommender Email: " . $record->getField('Faculty' . $number . ' email') . "\n";
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
	global $email_from, $email_to;
	$text = str_replace("\n", "<br />", $text);
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'From: ' . $email_from[$db_key];
	$to = $email_to[$db_key];
	$subject =  "A new LOR has been uploaded.";

	mail($to, $subject, $text, $headers);
}


/* 
 * Utility function to set field values from posted
 * data to the corresponding fields in filemaker.
 */
function setFieldData($record, $number, $keys) {
	// loop over each field value and append to array
	$result = array();
	$record->setField('Letter' . $number, "uploaded");
	foreach ($keys as $fieldname) {
		// Field names are different in Filemaker, rename them!
		if ($fieldname == 'file') {
			$field = 'AppLOR' . $number . 'filename';
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
function recordAddition($record, $number, $keys, $db_key) {
	global $db_layout, $bread;
	// declare new record as null
	if (!array_key_exists('cancel', $_POST)) {
	
		// set field data from form data
		setFieldData($record, $number, $keys);
		// commit record to database
		$result = $record->commit();
	
		if (FileMaker::isError($result)) {
			echo '<code>Record addition failed:</code> (' . $result->getCode() . ') ' . $result->getMessage() . "\n";
			include "../layout/footer.php";
	    	exit;
		}
	}
}

/* Main Program function calls */

$db_key = 'application';
	
$fm->setProperty('database', $db_name[$db_key]);
	
// Field names we expect as keys in $_POST[]
$keys = array('file');
	
$record = $fm->getRecordById($db_layout[$db_key], $recid);
	
// Error Checking to see if record exists.
if (FileMaker::isError($record)) {
	echo "Error: {$result->getMessage()}\n";
	exit;
}
	
$year = $record->getField('createdYR');
	
$newFile = getNewFileName($record, $year, $number);

uploadFile($record, $newFile, $db_key);

$_POST['file'] = $webFront . 'lors/uploads/' . $newFile;
 	
$text = createTextOutput($record, $number);
failsafe($text, $newFile);
sendEmail($text, $db_key);

recordAddition($record, $number, $keys, $db_key);
	

include "../layout/footer.php";

?>