<?php
include "../layout/header.php";
require_once ('FileMaker.php');
include ('../databases.php');
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "PI Evalution" => "",
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

<script type="text/javascript" src="../layout/js/evals.js"></script> 
<link rel="stylesheet" type="text/css" href="../layout/css/evals.css">

</style>

    <div class="jumbotron">
      <div class="container">
        <h1>PI Evaluation Form</h1>
        <p>Please evaluate the following issues. When possible please use a scale of 0-5. <br />
(0=absolutely not, poor, very negative; 2-3=ok, moderate; 5=definitely, excellent, very positive)</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>

    <div class="container">
    
    
<form id="eval" class="form-horizontal" role="form" method="post" action="submit.php?db_key=pi_eval">
	<input name="block" value="1" type="hidden" />
	

	<h3 class="special">Evaluator Info</h3>
 <div class="form-group">
    <label for="InternName" class="col-sm-5 control-label">Select Your Intern</label>
    <div class="col-sm-5">
    	<select class="form-control" name="InternName" id="InternName">
            <option selected="selected" value="no selection"></option>
            <?php foreach ($records as $record) {
            	echo "<option value='" . str_replace("_", " ", $record->getField('NameFull')) . "'>" . str_replace("_", " ", $record->getField('NameFull')) . "</option>";
            } ?>
        </select>
    </div>
  </div>
  <div class="form-group block">
	<label class="col-sm-5 control-label" for="EvalName">Evaluator Name</label>
  		<div class="col-sm-5">
  			<input type="text" class="form-control" id="EvalName" name="EvalName">
		</div>
  </div><br />
	
	<h3 class="special">1. Your Intern</h3>

  <div class="form-group block">
	<label class="col-sm-6 control-label" for="a">a. Do you feel that you had sufficient input to the intern selection process?</label>
  		<div class="col-sm-4 radi">
  			<input name="a" value="0" type="radio"> 0 
        <input name="a" value="1" type="radio"> 1 <input name="a" value="2" type="radio"> 2 
        <input name="a" value="3" type="radio"> 3 <input name="a" value="4" type="radio"> 4 <input name="a" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="b">b. Was your intern adequately prepared for the research experience?</label>
  		<div class="col-sm-4 radi">
  			<input name="b" value="0" type="radio"> 0 
        <input name="b" value="1" type="radio"> 1 <input name="b" value="2" type="radio"> 2 
        <input name="b" value="3" type="radio"> 3 <input name="b" value="4" type="radio"> 4 <input name="b" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="c">c. Was he/she qualified to join the lab as an undergraduate researcher?</label>
  		<div class="col-sm-4 radi">
  			<input name="c" value="0" type="radio"> 0 
        <input name="c" value="1" type="radio"> 1 <input name="c" value="2" type="radio"> 2 
        <input name="c" value="3" type="radio"> 3 <input name="c" value="4" type="radio"> 4 <input name="c" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="d">d. How would you rate his/her performance? skill level? ability/predisposition to learn?</label>
  		<div class="col-sm-4 radi">
  			<input name="d" value="0" type="radio"> 0 
        <input name="d" value="1" type="radio"> 1 <input name="d" value="2" type="radio"> 2 
        <input name="d" value="3" type="radio"> 3 <input name="d" value="4" type="radio"> 4 <input name="d" value="5" type="radio"> 5
  </div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="e">e. Was she/he happy in the lab?</label>
  		<div class="col-sm-4 radi">
  			<input name="e" value="0" type="radio"> 0 
        <input name="e" value="1" type="radio"> 1 <input name="e" value="2" type="radio"> 2 
        <input name="e" value="3" type="radio"> 3 <input name="e" value="4" type="radio"> 4 <input name="e" value="5" type="radio"> 5
		</div>
  </div>

  <div class="form-group">
	<label class="col-sm-6 control-label" for="f">f. Was she/he suitably challenged by the project/training?</label>
  		<div class="col-sm-4 radi">
  			<input name="f" value="0" type="radio"> 0 
        <input name="f" value="1" type="radio"> 1 <input name="f" value="2" type="radio"> 2 
        <input name="f" value="3" type="radio"> 3 <input name="f" value="4" type="radio"> 4 <input name="f" value="5" type="radio"> 5
		</div>
  </div>
  
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="g">g. Was she/he devoted to the research?</label>
  		<div class="col-sm-4 radi">
  			<input name="g" value="0" type="radio"> 0 
        <input name="g" value="1" type="radio"> 1 <input name="g" value="2" type="radio"> 2 
        <input name="g" value="3" type="radio"> 3 <input name="g" value="4" type="radio"> 4 <input name="g" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="h">h. Was she/he responsible in the lab?</label>
  		<div class="col-sm-4 radi">
  			<input name="h" value="0" type="radio"> 0 
        <input name="h" value="1" type="radio"> 1 <input name="h" value="2" type="radio"> 2 
        <input name="h" value="3" type="radio"> 3 <input name="h" value="4" type="radio"> 4 <input name="h" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="i">i. How do you think the intern rated their experience in her/his Intern Evaluation?</label>
  		<div class="col-sm-4 radi">
  			<input name="i" value="0" type="radio"> 0 
        <input name="i" value="1" type="radio"> 1 <input name="i" value="2" type="radio"> 2 
        <input name="i" value="3" type="radio"> 3 <input name="i" value="4" type="radio"> 4 <input name="i" value="5" type="radio"> 5
		</div>
  </div>


  <div class="form-group">
	<label class="col-sm-6 control-label" for="j">j. How enthusiastic would you be to have this intern return to your lab in the future?</label>
  		<div class="col-sm-4 radi">
  			<input name="j" value="0" type="radio"> 0 
        <input name="j" value="1" type="radio"> 1 <input name="j" value="2" type="radio"> 2 
        <input name="j" value="3" type="radio"> 3 <input name="j" value="4" type="radio"> 4 <input name="j" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="k">k. How could we improve the program to select more suitable interns, prepare them for the experience, and enhance their performance?</label>
  		<div class="col-sm-4">
  			<textarea class="form-control" rows="2" name="k" id="k"></textarea>
  		</div>
  </div>
  
  
  
  	<br />
	<h3 class="special">2. The Mentor</h3>
	
  <div class="form-group">
	<label class="col-sm-6 control-label" for="a1">a. Were you satisfied with the performance of the mentor you chose to train the intern?</label>
  		<div class="col-sm-4 radi">
  			<input name="a1" value="0" type="radio"> 0 
        <input name="a1" value="1" type="radio"> 1 <input name="a1" value="2" type="radio"> 2 
        <input name="a1" value="3" type="radio"> 3 <input name="a1" value="4" type="radio"> 4 <input name="a1" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="b1">b. Did the mentor gain valuable research/teaching experience training the intern?</label>
  		<div class="col-sm-4 radi">
  			<input name="b1" value="0" type="radio"> 0 
        <input name="b1" value="1" type="radio"> 1 <input name="b1" value="2" type="radio"> 2 
        <input name="b1" value="3" type="radio"> 3 <input name="b1" value="4" type="radio"> 4 <input name="b1" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="c1">c. Did you feel that the mentor spent too much time in training the intern?</label>
  		<div class="col-sm-4 radi">
  			<input name="c1" value="0" type="radio"> 0 
        <input name="c1" value="1" type="radio"> 1 <input name="c1" value="2" type="radio"> 2 
        <input name="c1" value="3" type="radio"> 3 <input name="c1" value="4" type="radio"> 4 <input name="c1" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="d1">d. Do you feel that the Mentoring Workshop was worthwhile for your mentor?</label>
  		<div class="col-sm-4 radi">
  			<input name="d1" value="0" type="radio"> 0 
        <input name="d1" value="1" type="radio"> 1 <input name="d1" value="2" type="radio"> 2 
        <input name="d1" value="3" type="radio"> 3 <input name="d1" value="4" type="radio"> 4 <input name="d1" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="e1">e. How could we improve the program to make better use of the mentors’ time, energy, patience?</label>
  		<div class="col-sm-4">
       		<textarea class="form-control" rows="2" name="e1" id="e1"></textarea>
       	</div>
  </div>

  <div class="form-group">
	<label class="col-sm-6 control-label" for="f1">f. How do you think the mentor rated their experience in her/his Mentor Evaluation?</label>
  		<div class="col-sm-4 radi">
  			<input name="f1" value="0" type="radio"> 0 
        <input name="f1" value="1" type="radio"> 1 <input name="f1" value="2" type="radio"> 2 
        <input name="f1" value="3" type="radio"> 3 <input name="f1" value="4" type="radio"> 4 <input name="f1" value="5" type="radio"> 5
		</div>
  </div>



	<br />
	<h3 class="special">3. The Program</h3>
	
  <div class="form-group">
	<label class="col-sm-6 control-label" for="a2">a. Do you think the intern's motivation could have been higher if some program or lab features were improved? Please explain.</label>
  		<div class="col-sm-4">
       		<textarea class="form-control" rows="2" name="a2" id="a2"></textarea>
       	</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="b2">b. What were the principal drawbacks of your experience this Summer?</label>
  		<div class="col-sm-4">
       		<textarea class="form-control" rows="2" name="b2" id="b2"></textarea>
       	</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="c2">c. How severe was your time commitment, energy commitment, frustration?  Did you feel that your lab personnel devoted too much time and energy?</label>
  		<div class="col-sm-4">
       		<textarea class="form-control" rows="2" name="c2" id="c2"></textarea>
       	</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="d2">d. Did the program events (seminars, workshops, tours, recreational trips) that your intern attended interfere with your laboratory plans for the intern? </label>
  		<div class="col-sm-4 radi">
  			<input name="d2" value="0" type="radio"> 0 
        <input name="d2" value="1" type="radio"> 1 <input name="d2" value="2" type="radio"> 2 
        <input name="d2" value="3" type="radio"> 3 <input name="d2" value="4" type="radio"> 4 <input name="d2" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="e2">e. Should we change the frequency or timing of these events?</label>
  		<div class="col-sm-4 radi">
  			<input name="e2" value="0" type="radio"> 0 
        <input name="e2" value="1" type="radio"> 1 <input name="e2" value="2" type="radio"> 2 
        <input name="e2" value="3" type="radio"> 3 <input name="e2" value="4" type="radio"> 4 <input name="e2" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-6 control-label" for="f2">f. Would you like to be invited to join program-related events?</label>
  		<div class="col-sm-4 radi">
  			<input name="f2" value="0" type="radio"> 0 
        <input name="f2" value="1" type="radio"> 1 <input name="f2" value="2" type="radio"> 2 
        <input name="f2" value="3" type="radio"> 3 <input name="f2" value="4" type="radio"> 4 <input name="f2" value="5" type="radio"> 5
		</div>
  </div>

	<br />
	<h3 class="special">4. Other</h3>
	
  <div class="form-group">
	<label class="col-sm-6 control-label" for="comments">If you have other concerns/ideas that you want to include, please feel free to add comments.</label>
  		<div class="col-sm-4">
       		<textarea class="form-control" rows="4" name="comments" id="comments"></textarea>
       	</div>
  </div>
  
  <br />

  <div class="form-group">
    <div style="text-align:center;">
      <button type="button" id="btn" style="margin-right:15px;" class="btn btn-success">Submit Application</button>
      <button type="reset" class="btn btn-danger">Clear Form</button>
    </div>
  </div>
</form>


<?php include "../layout/footer.php"; ?>