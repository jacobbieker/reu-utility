<?php
/*
 * Editing page for any given student's abstract.
 * For submits through submit.php.
 */
require ('../pw/login.php');
require_once ('FileMaker.php');
include ('../databases.php');
include ('../layout/header.php');

// Footer breadcrumbs
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Abstracts" => $webFront . "abstracts",
    "Update" => ""
);

	if (array_key_exists('recid', $_GET)) {
		$recid = $_GET['recid'];
	} else exit;
	
	$db_key = 'application';
	$fm->setProperty('database', $db_name[$db_key]);

	$record = $fm->getRecordById($db_layout[$db_key], $recid);
	
	// Error Checking to see if record exists.
	if (FileMaker::isError($record)) {
	    echo "Error: {$result->getMessage()}\n";
	    exit;
	}
	
?>

    <div class="jumbotron">
      <div class="container">
        <h1>Update Abstract <small><?php echo $record->getField('NameFull') ?></small></h1>
    	<p>Update your abstract in the form below. Please note that once you change your abstract it will permanently be changed in the database.
We advise you to keep a copy of your abstracts from each week that you submit them. Your most recent abstract submission will be shown in the box below.</p>
      </div>
    </div>

    <div class="container">


	<h3>Update your Abstract</h3>
	<br />
    <form class="form-horizontal" role="form" action="submit.php?recid=<?php echo $recid ?>" method="post">

    <div class="form-group">
    <label for="AbstractMonth" class="col-sm-2 control-label">Date of Update</label>
    <div class="row-fluid">
    <div class="col-sm-3">
    	<select class="form-control" name="AbstractMonth" id="AbstractMonth" placeholder="Month">
			<option selected="selected" value="no selection"></option>
			<option value="Jan">Jan</option>
			<option value="Feb">Feb</option>
			<option value="March">March</option>
			<option value="April">April</option>
			<option value="May">May</option>
			<option value="June">June</option>
			<option value="July">July</option>
			<option value="Aug">Aug</option>
			<option value="Sep">Sep</option>
			<option value="Oct">Oct</option>
			<option value="Nov">Nov</option>
			<option value="Dec">Dec</option>
        </select>
    </div>
	<div class="col-sm-3">
    	<select class="form-control" name="AbstractDay" id="AbstractDay" placeholder="Day">
			<option selected="selected" value="no selection"></option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
        </select>
	</div>
	<div class="col-sm-3">
		<input type="text" class="form-control" name="AbstractYear" size="3" maxlength="2" value="<?php echo $record->getField('createdYR'); ?>"></input>
	</div>
    </div>
  </div>
		
  <div class="form-group">	
	<label for="AbstractTitle" class="col-sm-2 control-label">Title</label>
	<div class="col-sm-9">
		<input type="text" class="form-control" name="AbstractTitle" value="<?php echo $record->getField('AbstractTitle'); ?>"></input>
	</div>
   </div>
   

  <div class="form-group">	
	<label for="Abstract" class="col-sm-2 control-label">Abstract</label>
	<div class="col-sm-9">
		<textarea class="form-control" name="Abstract" rows="20"><?php echo $record->getField('Abstract'); ?></textarea>	
	</div>
   </div>


		<input type="hidden" name="recid" value="<?php echo $record->getRecordId(); ?>">

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button type="submit" style="margin-right:15px;" class="btn btn-success">Submit Changes</button>
      <button type="reset" class="btn btn-danger">Revert Changes</button>
    </div>
  </div>
		
</form>

<?php include "../layout/footer.php"; ?>
