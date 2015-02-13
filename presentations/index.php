<?php
include ('../databases.php');
$pwAcc = getPermissions('presentationView');
require ('../pw/login.php');
include "../layout/header.php";

$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Presentations" => "",
);

$db_key = 'application';
$request = $fm->newFindCommand($db_layout[$db_key]);
$request->addFindCriterion('Triage', 'Intern');
$request->addSortRule('NameLast', 1);
$result = $request->execute();

?>

    <div class="jumbotron">
      <div class="container">
        <h1>Presentations</h1>
    	<p>The following is the current list of interns who have submitted one or both of their presentation pieces. Please <a href="mailto:<?php echo $email_to[$db_key] ?>">let us know</a> if you have any technical issues uploading your files.</p>
        <p><a href="presentation.php" class="btn btn-primary" role="button">Upload your Oral Presentation</a>
        <a href="poster.php" class="btn btn-primary" role="button">Upload your Poster</a></p>
      </div>
    </div>
    
       <div class="container">
       
    <?php
    	// Error Checking.
	if (FileMaker::isError($result)) {
    	if ($result->code == 401)
    		echo "<code>Error:</code> There are currently no students listed as interns. Please changes the 'Triage' field to Intern to add them to this page.";
    	else
    		echo "<code>Error:</code> " . $result->getMessage() . "\n";
    	include "../layout/footer.php";
    	exit;
	}

	// Get array of found records
	$records = $result->getRecords();
     ?>


	<table class="table table-hover" style="width: 80%; margin: 0px auto;">
	<thead>
		<tr>
			<th>Student Name</th>
			<th>Oral Presentation Link</th>
			<th>Symposium Poster Link</th>
		</tr>
	</thead>
	<tbody>


<?php

	
	foreach ($records as $record) {
		if ($record->getField('presentationOral') != "" || $record->getField('presentationPoster') != "") {
    		echo "<tr><td>" . str_replace("_", " ", $record->getField('NameFull')) . "</td>";
    		if ($record->getField('presentationOral') != "")
    			echo "<td><a href='". $record->getField('presentationOral') . "'>Oral Presentation</a></td>";
    		else
    			echo "<td>Unavailable</td>";
    		if ($record->getField('presentationPoster') != "")
    			echo "<td><a href='". $record->getField('presentationPoster') . "'>Symposium Poster</a></td>";
    		else
    			echo "<td>Unavailable</td>";
    		echo "</tr>";
    	}
	}
?>

</tbody>
</table>

<?php include "../layout/footer.php" ?>