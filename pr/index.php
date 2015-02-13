<?php
include ('../databases.php');
$pwAcc = getPermissions('prView');
require ('../pw/login.php');
include "../layout/header.php";
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Progress Reports" => "",
);
 
	 $db_key = 'application';
	// Set the database.
	$fm->setProperty('database', $db_name[$db_key]);
	
	// Perfrom new find command for interns
	$request = $fm->newFindCommand($db_layout[$db_key]);
	$request->addFindCriterion('Triage', 'Intern');
	$request->addSortRule('NameLast', 1, FILEMAKER_SORT_ASCEND);
	$result = $request->execute();
	
?>

    <div class="jumbotron">
      <div class="container">
        <h1>Progress Reports</h1>
    	<p>Below is a list of students currently enrolled in the <?php echo $pnmName; ?> program and links to view and edit their progress reports. Progress reports are displayed in descending order such that the first under each name is the most recently submitted report.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>
    

    <div class="container">
    
    <?php
    	// Error Checking.
	if (FileMaker::isError($result)) {
    	if ($result->code == 401)
    		echo "<code>Error:</code> There are currently no students listed as interns. Please changes the 'Triage' field to Intern to add them to this page.";
    	else
    		echo "Error: " . $result->getMessage() . "\n";
    	include "../layout/footer.php";
    	exit;
	}

	// Get array of found records
	$records = $result->getRecords();
     ?>

	<table class="table table-hover" style="width: 80%; margin: 0px auto;">
	<thead>
		<tr>
			<th>Intern</th>
			<th>College</th>
			<th>Professor</th>
			<th>Submit Progress Report</th>
		</tr>
	</thead>
	<tbody>
	
<?php
	foreach ($records as $record) {
    	echo "<tr><td><a href=\"#" . $record->getField('NameLast') .  "\">" . str_replace("_", " ", $record->getField('NameFull')) . "</a></td>";
    	echo "<td>" . $record->getField('College') . "</td>";
    	echo "<td>" . $record->getField('Professor') . "</td>";
    	echo "<td><a href=\"pr.php?recid=" . $record->getRecordId() . "\">Click Here</a></td></tr>";
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
      	$j = 0;
      	for($i = 10; $i > 0; $i--) {
      		if ($record->getField('pr' . $i) != "") {
      			$j++;
      			if ($j == 1) {
					echo "<h4><i>Week " . $i . ": " . $record->getField('prDate' . $i ) . " " . $record->getField('NameFull') . "</i></h4>";
      				echo "<blockquote><p>" . nl2br($record->getField('pr' . $i)) . "</p></blockquote>";
      
      			} else {
      				echo "<div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'>Week " . $i . ": " . $record->getField('prDate' . $i) . " " . $record->getField('NameFull') . "</h4></div>";
      				echo "<div class='panel-body'>" . nl2br($record->getField('pr' . $i)) . "</div></div>";
      			}
      		}
      	}
      	if(end($records) !== $record){
    		echo '<hr />';
		}
      	
	}
	
	include "../layout/footer.php";
?>