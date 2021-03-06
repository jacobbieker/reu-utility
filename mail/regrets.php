<?php
include ('../databases.php');
include "../layout/header.php";
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Email Regrets Letter" => ""
);

$db_key = 'application';
$fm->setProperty('database', $db_name[$db_key]);
if(!isset($_GET['recid'])) {
	exit;
}

$record = $fm->getRecordById('Email Templates', $_GET['recid']);
$record2 = $fm->getRecordById($db_layout[$db_key], $_GET['recid']);
$subject = $pgmName . ": Application Update";
?>
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>


    <div class="jumbotron">
      <div class="container">
        <h1>Letter of Regrets <small>For <?php echo str_replace("_", " ", $record2->getField('NameFull')); ?></small></h1>
    	<p>This page is for administrators only. Convenience email form to accommodate HTML email formatting.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>

    <div class="container">




<form class="form-horizontal" role="form" action="submit.php?recid=<?php echo $_GET['recid']; ?>" method="post">
  <input type="hidden" name="type" value="regrets" />
  
  <div class="form-group">	
	<label for="to" class="col-sm-2 control-label">To</label>
	<div class="col-sm-8">
		<input type="text" class="form-control" name="to" value="<?php echo $record2->getField('email'); ?>"></input>
	</div>
   </div>
   
  <div class="form-group">	
	<label for="from" class="col-sm-2 control-label">From</label>
	<div class="col-sm-8">
		<input type="text" class="form-control" name="from" value="<?php echo $email_from[$db_key]; ?>"></input>
	</div>
   </div>
   
   
  <div class="form-group">	
	<label for="subject" class="col-sm-2 control-label">Subject</label>
	<div class="col-sm-8">
		<input type="text" class="form-control" name="subject" value="<?php echo $subject; ?>"></input>
	</div>
   </div>

<div class="form-group">	
	<div class="col-sm-offset-2 col-sm-8">
		<textarea name="msg" class="form-control">
		<?php	
			echo $record->getField('LORregretsLetterCSS')
	
 		?>
		</textarea>
	</div>
</div>
		
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button type="submit" style="margin-right:15px;" class="btn btn-success">Send Email</button>
      <button type="reset" class="btn btn-danger">Revert Changes</button>
    </div>
  </div>
   
</form>

<?php include "../layout/footer.php" ?>
