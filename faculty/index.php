<?php
/*
 * Main page for the faculty review center.
 * displays the names of all the faculty and
 * links to their individual suggested students list.
 */
require ('../pw/login.php');
include "../layout/header.php";
require_once ('FileMaker.php');
include ('../databases.php');
// Footer breadcrumbs
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Applicant Review" => "",
);
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
	
	// Create a new Find All command for sorting
	$findCommand =& $fm->newFindAllCommand('LabMatching Form');

	// Sort professors in ascending order by Last name.
	$findCommand->addSortRule('Professor_Lname', 1, FILEMAKER_SORT_ASCEND);

	// Execute the find command to sort.
	$result = $findCommand->execute();
	

	// Error checking.
	if (FileMaker::isError($result)) {
    	echo "Error: " . $result->getMessage() . "\n";
    	exit;
	}

	// Get array of sorted records.
	$records = $result->getRecords();
	
?>

<div class="bs-example">
<div class="row">
<div class="col-sm-5 col-sm-offset-1">
<div class="list-group">
<?php
	$t = floor(count($records)/2);
	if (count($records) > 2) {
		$t = floor(count($records)/2)+1;
	}
	for($i=0; $i<$t; $i++) {
  		$record = $records[$i];
  		$badge;
  		
		$prof = $record->getField('Professor_FullName');
		$request = $fm->newFindCommand('Everything');
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
		$request = $fm->newFindCommand('Everything');
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