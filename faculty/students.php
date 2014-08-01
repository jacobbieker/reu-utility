<?php
/* 
 * Display the list of students associated
 * with the professor (from $_GET['recid']).
 * as well as their university and a link to
 * thier pdf info.
 */
 
require ('../pw/login.php');
include "../layout/header.php";
require_once ('FileMaker.php');
include ('../databases.php');


	if (array_key_exists('recid', $_GET)) {

		// Get the record through the ID recid post data
		$record = $fm->getRecordById('LabMatching Form', $_GET['recid']);
		$prof = $record->getField('Professor_FullName');
		$request = $fm->newFindCommand('Everything');
		$request->addFindCriterion('Possible PIs.', $prof);
		$request->addSortRule('NameLast', 1, FILEMAKER_SORT_ASCEND);
		$result = $request->execute(); // Execute find
	
		// Handle special case: professor does not have any
		// students on their list.
		if (FileMaker::isError($result)) {
			echo ("<h2>SPUR top Applicants for " . $record->getField('Professor_FullName') . "(" . $record->getField('Professor_Department') . ")</h2>");
	    	echo "<p>There are no students on your list currently.</p>";
	    	exit;
		} else {
			$value = $result->getRecords();
		}
		
		
	} else {
		$record = null;
	}
// Footer Breadcrumbs	
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
       
	<table class="table table-hover" style="width: 80%; margin: 0px auto;">
	<thead>
		<tr>
			<th>Student Name</th>
			<th>Program</th>
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
			echo ('<tr><td>' . str_replace("_", " ", $name) . '</td><td>'. $student->getField('Program') . '</td><td>' . $student->getField('College') . '</td><td>Currently Unavailable</td></tr>');
		// If PDF container field is not empty, show the link.
		} else {
			$url = $student->getField('Final PDF URL');
			echo ('<tr><td>'. str_replace("_", " ", $name) . '</td><td> '. $student->getField('Program') . '</td><td>' . $student->getField('College') . '</td><td><a href="' . $url . '">Click to View</a></td></tr>'); 
		}
		$count += 1;
	}
?>
	</tbody>

</table>

<?php include "../layout/footer.php"; ?>