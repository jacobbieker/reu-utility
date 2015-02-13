<?php
include ('../databases.php');
$pwAcc = getPermissions('applicantReview');
require ('../pw/login.php');

include "../layout/header.php";
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Applicant Review" => "",
);

$db_key = 'profs';
$db_key2 = 'application';

?>

    <div class="jumbotron">
      <div class="container">
        <h1>Applicant Review Center</h1>
    	<p>Select your name from the list below to review the applicants that we have chosen as potential interns for your lab this summer.
The students will be listed with links to their application information and letters of recommendation in PDF format.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>
    
    <div class="container">

<?php

	$request = $fm->newFindAllCommand($db_layout[$db_key]);
	$request->addSortRule('Professor_Lname', 1, FILEMAKER_SORT_ASCEND);
	$result = $request->execute();
    // Error Checking.
	if (FileMaker::isError($result)) {
    	echo "Error: " . $result->getMessage() . "\n";
    	include "../layout/footer.php";
    	exit;
	}
	

	// Get array of found records
	$records = $result->getRecords();
	
	if(count($records) == 0) {
		echo "<code>Error:</code> There are currently no professors in the database, to add faculty refer to the setup layout in Filemaker.";
    	include "../layout/footer.php";
    	exit;
	}
	
	
?>

<div class="bs-example">
<div class="row">
<div class="col-sm-5 col-sm-offset-1">
<div class="list-group">
<?php
	$t = floor(count($records)/2);
	if (count($records) > 2) {
		if (count($list) % 2 != 0) {
			$t = floor(count($list)/2)+1;
		}
	} else {
		if ($t == 0) $t = 1;
	}
	for($i=0; $i<$t; $i++) {
  		$record = $records[$i];
  		$badge;
  		
		$prof = $record->getField('Professor_FullName');
		$request = $fm->newFindCommand($db_layout[$db_key2]);
		$request->addFindCriterion('Possible PIs.', $prof);
		$result = $request->execute(); // Execute find
	
		// Handle special case: professor does not have any
		// students on their list.
		if (FileMaker::isError($result)) {
			$badge = "";
		} else {
			$value = $result->getRecords();
			$badge = "<span class='badge'>" . count($value) . "</span>";
		}
    	echo "<a class=\"list-group-item\" href=\"students.php?recid=" . $record->getRecordId() . "\">" . $record->getField('Professor_FullName') . $badge . "</a>";
	}
?>
</div>
</div>

<div class="col-sm-5">
<div class="list-group">
<?php
	if (count($records) >= 2) {
	for($i=$t; $i<count($records); $i++) {
  		$record = $records[$i];
  		$badge;
  		
		$prof = $record->getField('Professor_FullName');
		$request = $fm->newFindCommand($db_layout[$db_key2]);
		$request->addFindCriterion('Possible PIs.', $prof);
		$result = $request->execute(); // Execute find
	
		// Handle special case: professor does not have any
		// students on their list.
		if (FileMaker::isError($result)) {
			$badge = "";
		} else {
			$value = $result->getRecords();
			$badge = "<span class='badge'>" . count($value) . "</span>";
		}
    	echo "<a class=\"list-group-item\" href=\"students.php?recid=" . $record->getRecordId() . "\">" . $record->getField('Professor_FullName') . $badge . "</a>";
	}
	}
?>
</div>
</div>
</div>
</div>



<?php include "../layout/footer.php"; ?>