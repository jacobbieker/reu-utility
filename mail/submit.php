<?php

include ('../databases.php');
include "../layout/header.php";

if(!isset($_GET['recid']) OR !isset($_POST['type'])) {
	exit;
}

$type = $_POST['type'];

if ($type == "regrets") {
	$crumb = "Email Regrets Letter";
	$url = $webFront . "mail/regrets.php?recid=" . $_GET['recid'];
} elseif ($type == "request") {
	$crumb = "Email LOR Request";
	$url = $webFront . "mail/request.php?recid=" . $_GET['recid'] . "&n=" . $_GET['n'];
} elseif ($type == "completion") {
	$crumb = "Email Completion Letter";
	$url = $webFront . "mail/completion.php?recid=" . $_GET['recid'];
}  elseif ($type == "confirmation") {
	$crumb = "Email Confirmation Letter";
	$url = $webFront . "mail/confirmation.php?recid=" . $_GET['recid'] . "&n=" . $_GET['n'];
} elseif ($type == "professor") {
	$crumb = "Email Applicants List";
	$url = $webFront . "mail/professor.php?recid=" . $_GET['recid'] . "&n=" . $_GET['n'];
}

$bread = array(
    $pgmAcronym . " Home" => $webFront,
    $crumb => $url,
    "Sending Email" => ""
);


$db_key = 'application';
$fm->setProperty('database', $db_name[$db_key]);

$record = $fm->getRecordById($db_layout[$db_key], $_GET['recid']);
$record2 = $fm->getRecordById('Professors', $_GET['recid']);


$to = $_POST['to'];
$subject = $_POST['subject'];
$message = $_POST['msg'];
$newMessage = chunk_split(base64_encode($message));
	
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: ' . $_POST['from'] . "\r\n";
$headers .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
	
$n = $_GET['n'];

if(@mail($to, $subject, $newMessage, $headers)) {
	if ($_POST['type'] == "regrets") {
		$record->setField("regretsSent?", "Yes");
		$result = $record->commit();
	} else if ($_POST['type'] == "request") {
		$record->setField("Letter" . $n, "requested");
		$result = $record->commit();
	} else if ($_POST['type'] == "confirmation") {
		$record->setField("Letter" . $n, "acknowledged");
		$result = $record->commit();
	} else if ($_POST['type'] == "professor") {
		$record2->setField("EmailCheck", "Yes");
		$result = $record2->commit();
	}
} else{
  	die("Mail not sent, try again.");
}
?>

    <div class="jumbotron">
      <div class="container">
        <h1>Email sent successfully</h1>
    	<p>The following message was sent to <?php echo $to . " @ " . date('l jS \of F Y h:i:s A'); ?>.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>

    <div class="container">


<div id="msg"><?php echo $message; ?></div>


<?php include "../layout/footer.php" ?>
