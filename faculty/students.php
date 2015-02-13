<?php
include ('../databases.php');
$pwAcc = getPermissions('applicantReview');
require ('../pw/login.php');
include "../layout/header.php";

$db_key = 'profs';
$db_key2 = 'application';

	if (array_key_exists('recid', $_GET)) {

		// Get the record through the ID recid post data
		$record = $fm->getRecordById($db_layout[$db_key], $_GET['recid']);
		$prof = $record->getField('Professor_FullName');
		$request = $fm->newFindCommand($db_layout[$db_key2]);
		$request->addFindCriterion('Possible PIs.', $prof);
		$request->addSortRule('NameLast', 1, FILEMAKER_SORT_ASCEND);
		$result = $request->execute(); // Execute find
		
	} else {
		$record = null;
	}
	
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Applicant Review" => $webFront . "faculty/",
    $prof => "",
);

?>

    <div class="jumbotron">
      <div class="container">
        <h1>Top Applicants <small>for <?php echo $record->getField('Professor_FullName'); ?></small></h1>
    	<p>Below is a list of students and their information who we believe to be most suited for your laboratory. To
    	view a students application info, click on the link provided, with in that pdf there should be further links to the
    	letters of recommendation.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>
    
       <div class="container">    
       
       
<?php
	// Handle special case: professor does not have any
	// students on their list.
	if (FileMaker::isError($result)) {
		echo "<p>There are currently no students on this list. If you believe this is an error, please <a href='mailto:" . $emails . "'>let us know</a>.</p>";
	} else {
		$value = $result->getRecords();
		
?>

	<table class="table table-hover" style="width: 80%; margin: 0px auto;">
	<thead>
		<tr>
			<th>Student Name</th>
			<th>College</th>
			<th>Applicant Info</th>
		</tr>
	</thead>
	<tbody>
	
<?php
		// Loop through the related students
		$count = 1;
		foreach($value as $student) {
			$name = $student->getField('NameFull');
		
			// If PDF container field is empty, do not display link.
			if($student->getField('Final PDF URL') == "") {
				echo ('<tr><td>' . str_replace("_", " ", $name) . '</td><td>' . $student->getField('College') . '</td><td>Currently Unavailable</td></tr>');
			// If PDF container field is not empty, show the link.
			} else {
				$url = $webFront . "faculty/pdf.php?recid=" . $student->getRecordId();
				echo ('<tr><td>'. str_replace("_", " ", $name) . '</td><td>' . $student->getField('College') . '</td><td><a href="' . $url . '">Click to View</a></td></tr>'); 
			}
			$count += 1;
		}
	}
?>
	</tbody>

</table>

<?php include "../layout/footer.php"; ?>