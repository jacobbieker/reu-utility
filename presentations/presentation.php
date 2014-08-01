<?php
/* 
 * Upload form for presentations.
 */
 
require ('../pw/login.php');
include ('../layout/header.php');
require_once ('FileMaker.php');
include ('../databases.php');
// Footer Breadcrumbs
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Presentations" => $webFront . "presentations/",
    "Upload Presentation"  => ""
);

	$db_key = "application";
	
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
        <h1>Upload your Presentation</h1>
    	<p>Upload your oral presentation by using the form below. The accepted formats are <i>.pdf, .ppt, and .pptx</i>. Image files are also accepted, but these file types are preferred.
If you have any issues using this upload form, please <a href="mailto:<?php echo $email_to[$db_key]; ?>">contact us</a>.</p>
        <p><a href="index.php" class="btn btn-primary" role="button">View all Current Presentations</a>
        <a href="poster.php" class="btn btn-primary" role="button">Upload your Poster</a></p>
      </div>
    </div>
    
    <div class="container">

<form role="form" id="upload" class="form-horizontal" action="submit.php?type=pres" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="NameFull" class="col-sm-5 control-label">Select Your Name</label>
    <div class="col-sm-4">
		<select class="form-control" name="NameFull" id="NameFull">
			<option value="no selection"></option>
			<?php
				foreach ($records as $record) {
    				echo "<option>" . str_replace("_", " ", $record->getField('NameFull')) . "</option>";
				}
			?> 
		</select>
	</div>
  </div>


  <div class="form-group">
    <label for="file" class="col-sm-5 control-label">Upload your Oral Presentation</label>
    <div class="col-sm-4">
      <input style="margin-top:5px;margin-bottom:10px;" type="file" name="file" id="file">
    </div>
  </div>



  <div class="form-group">
    <div style="text-align:center;">
      <button type="submit" name="action" value="edit" style="margin-right:10px;" class="btn btn-success">Upload Presentation</button>
      <button type="reset" class="btn btn-danger">Clear Form</button>
    </div>
  </div>

</form>

<?php include "../layout/footer.php" ?>