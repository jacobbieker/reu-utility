<?php
/*
 * Displays the current abstracts of all students
 * enrolled in the program.
 */
 
require ('../pw/login.php');
include ('../layout/header.php');
require_once ('FileMaker.php');
include ('../databases.php');

// Footer Breadcrumbs
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Abstracts" => "",
);
 
	 $db_key = 'application';
	// Set the database.
	$fm->setProperty('database', $db_name[$db_key]);
	
	// Perfrom new find command for interns
	$request = $fm->newFindCommand($db_layout[$db_key]);
	$request->addFindCriterion('Triage', 'Intern');
	$request->addSortRule('NameLast', 1, FILEMAKER_SORT_ASCEND);
	$result = $request->execute();
	

	// Error Checking.
	if (FileMaker::isError($result)) {
    	echo "Error: " . $result->getMessage() . "\n";
    	exit;
	}

	// Get array of found records
	$records = $result->getRecords();
	
?>


    <div class="jumbotron">
      <div class="container">
        <h1>Abstracts</h1>
    	<p>Below is a list of students currently enrolled in the <?php echo $pnmName; ?> program and links to view and edit their abstracts.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>

    <div class="container">

	<table class="table table-hover" style="width: 80%; margin: 0px auto;">
	<thead>
		<tr>
			<th>Intern</th>
			<th>College</th>
			<th>Professor</th>
			<th>Update Abstract</th>
		</tr>
	</thead>
	<tbody>
	
<?php
	foreach ($records as $record) {
    	echo "<tr><td><a href=\"#" . $record->getField('NameLast') .  "\">" . str_replace("_", " ", $record->getField('NameFull')) . "</a></td>";
    	echo "<td>" . $record->getField('College') . "</td>";
    	echo "<td>" . $record->getField('Professor') . "</td>";
    	echo "<td><a href=\"abstracts.php?recid=" . $record->getRecordId() . "\">Click Here</a></td></tr>";
	}
	
?> 
	</tbody>

</table><br />

<hr />


<?php
	foreach ($records as $record) {
		echo "<a name=\"" . $record->getField('NameLast') . "\"></a><h3>";
		echo str_replace("_", " ", $record->getField('NameFull'));
      	echo "</h3>";

      	if ($record->getField('AbstractDate') != "")
      		echo "Last Updated: " . $record->getField('AbstractDate') . " | " . $record->getField('NameFull');
      	echo $time;
      	if ($record->getField('AbstractTitle') != "")
      		echo "<h4><i> \"" . $record->getField('AbstractTitle') . "\"</i></h4>";
      	if ($record->getField('Abstract') != "")
      		echo "<blockquote><p>" . nl2br($record->getField('Abstract')) . "</p></blockquote>";
      	
      	if(end($records) !== $record){
    		echo '<hr />';
		}
      	
	}
	
	include "../layout/footer.php";
?> 
