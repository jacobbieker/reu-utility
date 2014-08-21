<?php

include "../layout/header.php";
require_once ('FileMaker.php');
include ('../databases.php');
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Mentor Evaluation" => "",
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


    <div class="jumbotron">
      <div class="container">
        <h1>Mentor Evaluation Form</h1>
        <p>Please evaluate the following issues. When possible, please use a scale of 0-10.<br />
(0=absolutely not, poor, very negative; 5=ok, moderate, neutral; 10=definitely, excellent, very positive)</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>

    <div class="container">
    
    
<form id="eval" class="form-horizontal" role="form" method="post" action="submit.php?db_key=mentor_eval">
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
	
	<h3 class="special">1. The Overall Experience</h3>

  <div class="form-group block">
	<label class="col-sm-5 control-label" for="a">a. Would you recommend the program to potential mentors you know?</label>
  		<div class="col-sm-5 radi">
  			<input name="a" value="0" type="radio"> 0 
        <input name="a" value="1" type="radio"> 1 <input name="a" value="2" type="radio"> 2 
        <input name="a" value="3" type="radio"> 3 <input name="a" value="4" type="radio"> 4 <input name="a" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="b">b. Did you gain valuable experience from mentoring this summer?</label>
  		<div class="col-sm-5 radi">
  			<input name="b" value="0" type="radio"> 0 
        <input name="b" value="1" type="radio"> 1 <input name="b" value="2" type="radio"> 2 
        <input name="b" value="3" type="radio"> 3 <input name="b" value="4" type="radio"> 4 <input name="b" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="c">c. Did your mentoring experience with the program influence your views on research, science, or teaching?</label>
  		<div class="col-sm-5 radi">
  			<input name="c" value="0" type="radio"> 0 
        <input name="c" value="1" type="radio"> 1 <input name="c" value="2" type="radio"> 2 
        <input name="c" value="3" type="radio"> 3 <input name="c" value="4" type="radio"> 4 <input name="c" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="d">d. Did it give you insight regarding your abilities as well as your career and life goals? Comments?</label>
  		<div class="col-sm-5">
  			<textarea class="form-control" rows="2" name="d" id="d"></textarea>
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="e">e. How could we improve the program to make better use of your time, energy, and patience?</label>
  		<div class="col-sm-5">
  			<textarea class="form-control" rows="2" name="e" id="e"></textarea>
		</div>
  </div>

  <div class="form-group">
	<label class="col-sm-5 control-label" for="f">f. How else could we improve mentoring for the program?</label>
  		<div class="col-sm-5">
  			<textarea class="form-control" rows="2" name="f" id="f"></textarea>
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="g">g. How could we improve the Mentoring Workshop?</label>
  		<div class="col-sm-5">
  			<textarea class="form-control" rows="2" name="g" id="g"></textarea>
		</div>
  </div>
  
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="h">h. Did the efforts of the intern advance your research program/project?</label>
  		<div class="col-sm-5 radi">
  			<input name="h" value="0" type="radio"> 0 
        <input name="h" value="1" type="radio"> 1 <input name="h" value="2" type="radio"> 2 
        <input name="h" value="3" type="radio"> 3 <input name="h" value="4" type="radio"> 4 <input name="h" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="i">i. How could we improve the chances of success in this regard?</label>
  		<div class="col-sm-5">
  			<textarea class="form-control" rows="2" name="i" id="i"></textarea>
		</div>
  </div>


  <div class="form-group">
	<label class="col-sm-5 control-label" for="j">j. How pleased/displeased would you be to have another student from the program next summer?</label>
  		<div class="col-sm-5">
  			<textarea class="form-control" rows="2" name="j" id="j"></textarea>
		</div>
  </div>
  	<br /><br />
	<h3 class="special">2. Mentoring</h3>
	
  <div class="form-group">
	<label class="col-sm-5 control-label" for="a1">a. Do you feel you were an effective mentor?</label>
  		<div class="col-sm-5 radi">
  			<input name="a1" value="0" type="radio"> 0 
        <input name="a1" value="1" type="radio"> 1 <input name="a1" value="2" type="radio"> 2 
        <input name="a1" value="3" type="radio"> 3 <input name="a1" value="4" type="radio"> 4 <input name="a1" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="b1">b. Did your intern efficiently learn: <br />a) procedural skills; b)experimental design; c) strategies; d) the big picture?</label>
  		<div class="col-sm-5 radi">
  		<p />
  		a) 
  			<input name="b1a" value="0" type="radio"> 0 
        	<input name="b1a" value="1" type="radio"> 1 <input name="b1a" value="2" type="radio"> 2 
        	<input name="b1a" value="3" type="radio"> 3 <input name="b1a" value="4" type="radio"> 4 <input name="b1a" value="5" type="radio"> 5
  		<p />
  		b) 
  			<input name="b1b" value="0" type="radio"> 0 
        	<input name="b1b" value="1" type="radio"> 1 <input name="b1b" value="2" type="radio"> 2 
        	<input name="b1b" value="3" type="radio"> 3 <input name="b1b" value="4" type="radio"> 4 <input name="b1b" value="5" type="radio"> 5
		<p />
  		c) 
  			<input name="b1c" value="0" type="radio"> 0 
        	<input name="b1c" value="1" type="radio"> 1 <input name="b1c" value="2" type="radio"> 2 
        	<input name="b1c" value="3" type="radio"> 3 <input name="b1c" value="4" type="radio"> 4 <input name="b1c" value="5" type="radio"> 5
  		<p />
  		d) 
  			<input name="b1d" value="0" type="radio"> 0 
        	<input name="b1d" value="1" type="radio"> 1 <input name="b1d" value="2" type="radio"> 2 
        	<input name="b1d" value="3" type="radio"> 3 <input name="b1d" value="4" type="radio"> 4 <input name="b1d" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="c1">c. How would you rate yourself as a mentor?</label>
  		<div class="col-sm-5 radi">
  			<input name="c1" value="0" type="radio"> 0 
        <input name="c1" value="1" type="radio"> 1 <input name="c1" value="2" type="radio"> 2 
        <input name="c1" value="3" type="radio"> 3 <input name="c1" value="4" type="radio"> 4 <input name="c1" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="d1">d. Do you think you helped the student gain valuable research experience?</label>
  		<div class="col-sm-5 radi">
  			<input name="d1" value="0" type="radio"> 0 
        <input name="d1" value="1" type="radio"> 1 <input name="d1" value="2" type="radio"> 2 
        <input name="d1" value="3" type="radio"> 3 <input name="d1" value="4" type="radio"> 4 <input name="d1" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="e1">e. Do you think you helped the student make valuable career decisions?</label>
  		<div class="col-sm-5 radi">
  			<input name="e1" value="0" type="radio"> 0 
        <input name="e1" value="1" type="radio"> 1 <input name="e1" value="2" type="radio"> 2 
        <input name="e1" value="3" type="radio"> 3 <input name="e1" value="4" type="radio"> 4 <input name="e1" value="5" type="radio"> 5
		</div>
  </div>

  <div class="form-group">
	<label class="col-sm-5 control-label" for="f1">f. Did you learn important aspects of mentoring from your experience?</label>
  		<div class="col-sm-5 radi">
  			<input name="f1" value="0" type="radio"> 0 
        <input name="f1" value="1" type="radio"> 1 <input name="f1" value="2" type="radio"> 2 
        <input name="f1" value="3" type="radio"> 3 <input name="f1" value="4" type="radio"> 4 <input name="f1" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="g1">g. Did you encourage/help your student to perform to a high standard?</label>
  		<div class="col-sm-5 radi">
  			<input name="g1" value="0" type="radio"> 0 
        <input name="g1" value="1" type="radio"> 1 <input name="g1" value="2" type="radio"> 2 
        <input name="g1" value="3" type="radio"> 3 <input name="g1" value="4" type="radio"> 4 <input name="g1" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="h1">h. How could your performance be improved?</label>
  		<div class="col-sm-5">
  		  	<textarea class="form-control" rows="2" name="h1" id="h1"></textarea>
  		 </div>
  </div>

  	<br />


	<h3 class="special">3. The Intern</h3>
	
  <div class="form-group">
	<label class="col-sm-5 control-label" for="a2">a. Did you feel you were adequately involved in the process in which your intern was selected?</label>
  		<div class="col-sm-5 radi">
  			<input name="a2" value="0" type="radio"> 0 
        <input name="a2" value="1" type="radio"> 1 <input name="a2" value="2" type="radio"> 2 
        <input name="a2" value="3" type="radio"> 3 <input name="a2" value="4" type="radio"> 4 <input name="a2" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="b2">b. Was your intern adequately prepared for the research experience?</label>
  		<div class="col-sm-5 radi">
  			<input name="b2" value="0" type="radio"> 0 
        <input name="b2" value="1" type="radio"> 1 <input name="b2" value="2" type="radio"> 2 
        <input name="b2" value="3" type="radio"> 3 <input name="b2" value="4" type="radio"> 4 <input name="b2" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="c2">c. How would you rate the intern's: a) Performance; b) skill level; c) ability/predisposition to learn</label>
  		<div class="col-sm-5 radi">
  		<p />
  		a) 
  			<input name="c2a" value="0" type="radio"> 0 
        	<input name="c2a" value="1" type="radio"> 1 <input name="c2a" value="2" type="radio"> 2 
        	<input name="c2a" value="3" type="radio"> 3 <input name="c2a" value="4" type="radio"> 4 <input name="c2a" value="5" type="radio"> 5
  		<p />
  		b) 
  			<input name="c2b" value="0" type="radio"> 0 
        	<input name="c2b" value="1" type="radio"> 1 <input name="c2b" value="2" type="radio"> 2 
        	<input name="c2b" value="3" type="radio"> 3 <input name="c2b" value="4" type="radio"> 4 <input name="c2b" value="5" type="radio"> 5
		<p />
  		c) 
  			<input name="c2c" value="0" type="radio"> 0 
        	<input name="c2c" value="1" type="radio"> 1 <input name="c2c" value="2" type="radio"> 2 
        	<input name="c2c" value="3" type="radio"> 3 <input name="c2c" value="4" type="radio"> 4 <input name="c2c" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="d2">d. Do you think your mentoring experience might have been more fruitful had the intern participated in a workshop on research methods?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="d2" id="d2"></textarea>
       	</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="e2">e. How could we prepare/select interns in a way that would improve chances for the execution of a successful summer research program?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="e2" id="e2"></textarea>
       	</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="a2">f. Was the intern devoted to the research?</label>
  		<div class="col-sm-5 radi">
  			<input name="f2" value="0" type="radio"> 0 
        <input name="f2" value="1" type="radio"> 1 <input name="f2" value="2" type="radio"> 2 
        <input name="f2" value="3" type="radio"> 3 <input name="f2" value="4" type="radio"> 4 <input name="f2" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="g2">g. Was the intern happy in the lab?</label>
  		<div class="col-sm-5 radi">
  			<input name="g2" value="0" type="radio"> 0 
        <input name="g2" value="1" type="radio"> 1 <input name="g2" value="2" type="radio"> 2 
        <input name="g2" value="3" type="radio"> 3 <input name="g2" value="4" type="radio"> 4 <input name="g2" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="h2">h. Was the intern responsible?</label>
  		<div class="col-sm-5 radi">
  			<input name="h2" value="0" type="radio"> 0 
        <input name="h2" value="1" type="radio"> 1 <input name="h2" value="2" type="radio"> 2 
        <input name="h2" value="3" type="radio"> 3 <input name="h2" value="4" type="radio"> 4 <input name="h2" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="i2">i. Do you think the student's motivation could have been increased if some feature of the lab practice or program overall were improved? Please explain.</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="i2" id="i2"></textarea>
  		</div>
  </div>
  

  <div class="form-group">
	<label class="col-sm-5 control-label" for="j2">j. How enthusiastic would you be to have the intern return to the lab in the future?</label>
  		<div class="col-sm-5 radi">
  			<input name="j2" value="0" type="radio"> 0 
        <input name="j2" value="1" type="radio"> 1 <input name="j2" value="2" type="radio"> 2 
        <input name="j2" value="3" type="radio"> 3 <input name="j2" value="4" type="radio"> 4 <input name="j2" value="5" type="radio"> 5
  		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="k2">k. How do you think the intern rated their experience in his/her Intern Evaluation?</label>
  		<div class="col-sm-5 radi">
  			<input name="k2" value="0" type="radio"> 0 
        <input name="k2" value="1" type="radio"> 1 <input name="k2" value="2" type="radio"> 2 
        <input name="k2" value="3" type="radio"> 3 <input name="k2" value="4" type="radio"> 4 <input name="k2" value="5" type="radio"> 5
  		</div>
  </div>
  	<br />

	<h3 class="special">4. Support from PI and Research Lab</h3>
	
   <div class="form-group">
	<label class="col-sm-5 control-label" for="a3">a. How helpful/relevant was the professor in your mentoring experience?</label>
  		<div class="col-sm-5 radi">
  			<input name="a3" value="0" type="radio"> 0 
        <input name="a3" value="1" type="radio"> 1 <input name="a3" value="2" type="radio"> 2 
        <input name="a3" value="3" type="radio"> 3 <input name="a3" value="4" type="radio"> 4 <input name="a3" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="b3">b. How could his/her performance be improved?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="b3" id="b3"></textarea>
       	</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="c3">c. How do you think the PI rated the summer experience in her/his PI Evaluation?</label>
  		<div class="col-sm-5 radi">
  			<input name="c3" value="0" type="radio"> 0 
        <input name="c3" value="1" type="radio"> 1 <input name="c3" value="2" type="radio"> 2 
        <input name="c3" value="3" type="radio"> 3 <input name="c3" value="4" type="radio"> 4 <input name="c3" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="d3">d. How helpful for the intern were your research colleagues in the lab?</label>
  		<div class="col-sm-5 radi">
  			<input name="d3" value="0" type="radio"> 0 
        <input name="d3" value="1" type="radio"> 1 <input name="d3" value="2" type="radio"> 2 
        <input name="d3" value="3" type="radio"> 3 <input name="d3" value="4" type="radio"> 4 <input name="d3" value="5" type="radio"> 5
		</div>
  </div>
  
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="e3">e. How could we improve on this?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="e3" id="e3"></textarea>
       	</div>
  </div>
    	<br />
  
	<h3 class="special">5. The Program</h3>
	
   <div class="form-group">
	<label class="col-sm-5 control-label" for="a4">a. Did the program events (seminars, workshops, discussion groups, tours, recreational trips) that your intern attended interfere with your planned research mentoring?</label>
  		<div class="col-sm-5 radi">
  			<input name="a4" value="0" type="radio"> 0 
        <input name="a4" value="1" type="radio"> 1 <input name="a4" value="2" type="radio"> 2 
        <input name="a4" value="3" type="radio"> 3 <input name="a4" value="4" type="radio"> 4 <input name="a4" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="b4">b. Would you like to be invited to attend these program-related events?</label>
  		<div class="col-sm-5 radi">
  			<input name="b4" value="0" type="radio"> 0 
        <input name="b4" value="1" type="radio"> 1 <input name="b4" value="2" type="radio"> 2 
        <input name="b4" value="3" type="radio"> 3 <input name="b4" value="4" type="radio"> 4 <input name="b4" value="5" type="radio"> 5
		</div>
  </div>

   <div class="form-group">
	<label class="col-sm-5 control-label" for="c4">c. Did you help your intern prepare his/her Undergraduate Research Symposium presentation?</label>
  		<div class="col-sm-5 radi">
  			<input name="c4" value="0" type="radio"> 0 
        <input name="c4" value="1" type="radio"> 1 <input name="c4" value="2" type="radio"> 2 
        <input name="c4" value="3" type="radio"> 3 <input name="c4" value="4" type="radio"> 4 <input name="c4" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="d4">d. Do you think you and others in the lab provided sufficient guidance in developing the intern's presentation?</label>
  		<div class="col-sm-5 radi">
  			<input name="d4" value="0" type="radio"> 0 
        <input name="d4" value="1" type="radio"> 1 <input name="d4" value="2" type="radio"> 2 
        <input name="d4" value="3" type="radio"> 3 <input name="d4" value="4" type="radio"> 4 <input name="d4" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="e4">e. How could we make it easier for you to help with the preparation of the intern's poster and oral presentation?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="e4" id="e4"></textarea>
       	</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="f4">f. Did you think the weekly Progress Reports were worthwhile? Could we improve this?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="f4" id="f4"></textarea>
       	</div>
  </div>
  	<br />
  
	<h3 class="special">6. Other</h3>
	
  <div class="form-group">
	<label class="col-sm-5 control-label" for="comments">If you have other concerns/ideas that you want to include, please feel free to add comments.</label>
  		<div class="col-sm-5 radi">
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