<?php
include ('../databases.php');
$pwAcc = getPermissions('prEdit');
require ('../pw/login.php');
include "../layout/header.php";

$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Progress Reports" => $webFront . "pr",
    "Update" => ""
);
 
	if (array_key_exists('recid', $_GET)) {
		$recid = $_GET['recid'];
	} else exit;

	$db_key = 'application';
	$record = $fm->getRecordById($db_layout[$db_key], $_GET['recid']);
	
	// Error Checking to see if record exists.
	if (FileMaker::isError($record)) {
	    echo "Error: {$result->getMessage()}\n";
	    exit;
	}
	
?>
   <div class="jumbotron">
      <div class="container">
        <h1>Update Progress Reports <small><?php echo $record->getField('NameFull') ?></small></h1>
    	<p>Update your progress reports in the form below. Please note that each form is individual, updating one progress report will not
change all of your reports on the page, update and submit them independently as needed.</p>
      </div>
    </div>

    <div class="container">


<?php 
	$last = 0;
	$c = 0;
	for($i = 10; $i > 0; $i--) { 
		if ($record->getField('pr' . $i) != "") {
			if($c == 0)
				$last = $i;
				$c++;
		}
	}				
	if($last != 10) { ?>



	<h3>Submit Next Progress Report</h3>
	<br />
    <form class="form-horizontal" role="form" action="submit.php?recid=<?php echo $recid ?>" method="post">
	
	<div class="form-group">
	<label for="week" class="col-sm-2 control-label">Week #:</label>
    <div class="col-sm-3">
		<select class="form-control" name="week" id="week" placeholder="Week #">
			<?php
				for($i = $last+1; $i <=10; $i++) {
					echo "<option value='" . $i . "'>" . $i . "</option>";
				}
			?>
		</select>
	</div>
	</div>
		
		
    <div class="form-group">
    <label for="prMonth" class="col-sm-2 control-label">Date of Update</label>
    <div class="row-fluid">
    <div class="col-sm-3">
    	<select class="form-control" name="prMonth" id="prMonth" placeholder="Month">
			<option selected="selected" value=""></option>
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
    	<select class="form-control" name="prDay" id="prDay" placeholder="Day">
			<option selected="selected" value=""></option>
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
		<input type="text" class="form-control" name="prYear" size="3" maxlength="2" value="<?php echo $year; ?>"></input>
	</div>
    </div>
  </div>
   

  <div class="form-group">	
	<label for="pr" class="col-sm-2 control-label">Progress Report</label>
	<div class="col-sm-9">
		<textarea class="form-control" name="pr" rows="20"></textarea>	
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
		
<?php } ?>

<hr />



<?php 
	for($i = 10; $i > 0; $i--) { 
	
		if ($record->getField('pr' . $i) != "") { ?>
		
		<div class='panel panel-default'>
		<div class='panel-heading'>
		<h4 class='panel-title'>Progress Report for Week <?php echo $i; ?></h4>
		</div>
		<div class='panel-body'>
		
    <form class="form-horizontal" role="form" action="submit.php?recid=<?php echo $recid; ?>" method="post">
   
   
    <div class="form-group">
    <label for="prMonth" class="col-sm-2 control-label">Date of Update</label>
    <div class="row-fluid">
    <div class="col-sm-3">
    	<select class="form-control" name="prMonth" id="prMonth" placeholder="Month">
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
    	<select class="form-control" name="prDay" id="prDay" placeholder="Day">
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
		<input type="text" class="form-control" name="prYear" value="<?php echo $record->getField('createdYR'); ?>"></input>
	</div>
    </div>
  </div>
  
  <div class="form-group">	
	<label for="last" class="col-sm-2 control-label">Last Updated</label>
	<div class="col-sm-9">
		<input class="form-control" id="last" name="last" type="text" placeholder="<?php echo $record->getField('prDate' . $i); ?>" disabled>
	</div>
   </div>
   

  <div class="form-group">	
	<label for="pr" class="col-sm-2 control-label">Progress Report</label>
	<div class="col-sm-9">
		<textarea class="form-control" name="pr" rows="10"><?php echo $record->getField('pr' . $i); ?></textarea>	
	</div>
   </div>
   
   <input type="hidden" name="week" id="week" value="<?php echo $i; ?>"</input>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button type="submit" style="margin-right:15px;" class="btn btn-default">Submit Changes</button>
      <button type="reset" class="btn btn-default">Revert Changes</button>
    </div>
  </div>
		
</form>
</div></div>
		
<?php
	 } } ?>

<?php include "../layout/footer.php"; ?>
