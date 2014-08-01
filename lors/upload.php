<?php
/*
 * Upload form for the lor. Accepts input via upload
 * file prompt or a textarea. Data gets processed by
 * submit.php
 */
 
include ('../layout/header.php]');
require_once ('FileMaker.php');
include ('../databases.php');
// Footer Breadcrumbs
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Upload LORs" => "",
);

if (array_key_exists('recid', $_GET) && array_key_exists('n', $_GET)) {
	$recid = $_GET['recid'];
	$number = $_GET['n'];
} else exit;
	
	$fm->setProperty('database', $db_name['application']);

	$record = $fm->getRecordById($db_layout['application'], $recid);
	
	// Error Checking to see if record exists.
	if (FileMaker::isError($record)) {
	    echo "Error: {$result->getMessage()}\n";
	    exit;
	}
	
?>

    <div class="jumbotron">
      <div class="container">
        <h1>Upload LOR <small>For <?php echo str_replace("_", " ", $record->getField('NameFull')); ?></small></h1>
    	<p>You may use the following form to upload or type your letter of recommendation for the student listed. Please verify that the information below is correct including the student name and your name and information before submitting.  We will accept documents of type <i>.pdf, .doc, .docx, .txt, .pages, and .rtf</i>.
Image files are also accepted, but text files are preferred. If you would like to directly copy and paste your letter into a text box, click the "write to a textbox" link below.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>
    
    <div class="container">



<form role="form" class="form-horizontal" id="upload" action="submit.php?recid=<?php echo $recid; ?>&n=<?php echo $number; ?>" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="Name" class="col-sm-4 control-label">Student Name</label>
    <div class="col-sm-6">
      <input class="form-control" id="Name" name="Name" type="text" placeholder="<?php echo str_replace("_", " ", $record->getField('NameFull')); ?>" disabled>
    </div>
  </div>
  
  
  <div class="form-group">
    <label for="Rec" class="col-sm-4 control-label">Recommender Information</label>
    <div class="col-sm-6">
      <input class="form-control" id="Rec" name="Rec" type="text" placeholder="<?php echo str_replace("_", " ", $record->getField('Faculty' . $number . ' name')); ?>" disabled>
    </div>
  </div>
  
  <div class="form-group">
    <label for="RecE" class="col-sm-4 control-label">Recommender Email</label>
    <div class="col-sm-6">
      <input class="form-control" id="RecE" name="RecE" type="text" placeholder="<?php echo str_replace("_", " ", $record->getField('Faculty' . $number . ' email')); ?>" disabled>
    </div>
  </div>
  
  
  <div class="form-group">
    <label for="file" class="col-sm-4 control-label">Letter of Recommendation</label>
    <div class="col-sm-6" id="upFile">
      <input style="margin-top:5px;margin-bottom:10px;" type="file" name="file" id="file">
      <p class="help-block">Upload a file using the input above, or <a href="javascript:displayTextarea()">write to text box</a></p>
      </div>
    <div class="col-sm-6" id="textbox"><p><textarea class="form-control" rows="6" name="text" id="text"></textarea></p>
	<p class="help-block"><a href="javascript:displayUpload()">Upload a file instead?</a></p>

</div>
  </div>


  <div class="form-group">
    <div style="text-align:center;">
      <button type="submit" name="action" value="edit" style="margin-right:10px;" class="btn btn-success">Upload Letter</button>
      <button type="reset" class="btn btn-danger">Clear Form</button>
    </div>
  </div>
</form>

<?php include "../layout/footer.php" ?>