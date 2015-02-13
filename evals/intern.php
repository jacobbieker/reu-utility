<?php
include ('../databases.php');
$pwAcc = getPermissions('internEval');
require ('../pw/login.php');
include "../layout/header.php";
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Intern Evaluation" => "",
);
 ?>

<script type="text/javascript" src="../layout/js/evals.js"></script> 
<link rel="stylesheet" type="text/css" href="../layout/css/evals.css">

    <div class="jumbotron">
      <div class="container">
        <h1>Intern Evaluation Form</h1>
        <p>Please evaluate the following issues. When possible please use a scale of 0-5.<br />
(0=absolutely not, poor, very negative; 2-3=ok, moderate; 5=definitely, excellent, very positive)</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>

    <div class="container">
    
    
<form id="eval" class="form-horizontal" role="form" method="post" action="submit.php?db_key=intern_eval">
	<input name="block" value="1" type="hidden" />

	<h3 class="special">Evaluator Info</h3>
  <div class="form-group block">
	<label class="col-sm-5 control-label" for="InternName">Evaluator Name</label>
  		<div class="col-sm-5">
  			<input type="text" class="form-control" id="InternName" name="InternName">
		</div>
  </div><br />
	
	<h3 class="special">1. The Overall Experience</h3>

  <div class="form-group block">
	<label class="col-sm-5 control-label" for="a">a. Would you recommend the program to others?</label>
  		<div class="col-sm-5 radi">
  			<input name="a" value="0" type="radio"> 0 
        <input name="a" value="1" type="radio"> 1 <input name="a" value="2" type="radio"> 2 
        <input name="a" value="3" type="radio"> 3 <input name="a" value="4" type="radio"> 4 <input name="a" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="b">b. Did the program influence your views on research, science, teaching? How?</label>
  		<div class="col-sm-5 radi">
  			<input name="b" value="0" type="radio"> 0 
        	<input name="b" value="1" type="radio"> 1 <input name="b" value="2" type="radio"> 2 
        	<input name="b" value="3" type="radio"> 3 <input name="b" value="4" type="radio"> 4 <input name="b" value="5" type="radio"> 5
        </div>
        <div class="col-sm-5"><p /><br />
        	<textarea class="form-control" rows="2" name="b_p2" id="b_p2"></textarea>
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="c">c. Did the program give you insight regarding your skills and your career and life goals? In what way(s)?</label>
  		<div class="col-sm-5">
  			<textarea class="form-control" rows="2" name="c" id="c"></textarea>
  		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="d">d. How could we improve the overall program experience?</label>
 		<div class="col-sm-5">
  			<textarea class="form-control" rows="2" name="d" id="d"></textarea>
  		</div>
  </div>
  
  
  	<br />
	<h3 class="special">2. Overall Science Education you Received, Please assess:</h3>
	
  <div class="form-group">
	<label class="col-sm-5 control-label" for="a1">a. Your success in learning procedural skills</label>
  		<div class="col-sm-5 radi">
  			<input name="a1" value="0" type="radio"> 0 
        <input name="a1" value="1" type="radio"> 1 <input name="a1" value="2" type="radio"> 2 
        <input name="a1" value="3" type="radio"> 3 <input name="a1" value="4" type="radio"> 4 <input name="a1" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="b1">b. Your education in experimental design and strategies</label>
  		<div class="col-sm-5 radi">
  			<input name="b1" value="0" type="radio"> 0 
        	<input name="b1" value="1" type="radio"> 1 <input name="b1" value="2" type="radio"> 2 
        	<input name="b1" value="3" type="radio"> 3 <input name="b1" value="4" type="radio"> 4 <input name="b1" value="5" type="radio"> 5
        </div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="c1">c. Your mastery of the overall subject</label>
  		<div class="col-sm-5 radi">
  			<input name="c1" value="0" type="radio"> 0 
        <input name="c1" value="1" type="radio"> 1 <input name="c1" value="2" type="radio"> 2 
        <input name="c1" value="3" type="radio"> 3 <input name="c1" value="4" type="radio"> 4 <input name="c1" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="d1">d. How could we improve the program's educational components?</label>
  		<div class="col-sm-5">
  		  	<textarea class="form-control" rows="2" name="d1" id="d1"></textarea>
		</div>
  </div>
  	<br />


	<h3 class="special">3. Support From Mentor</h3>
	
  <div class="form-group">
	<label class="col-sm-5 control-label" for="a2">a. How helpful was your direct mentor?</label>
  		<div class="col-sm-5 radi">
  			<input name="a2" value="0" type="radio"> 0 
        <input name="a2" value="1" type="radio"> 1 <input name="a2" value="2" type="radio"> 2 
        <input name="a2" value="3" type="radio"> 3 <input name="a2" value="4" type="radio"> 4 <input name="a2" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="b2">b. How could his/her performance be improved?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="b2" id="b2"></textarea>
       	</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="c2">c. Did you learn important aspects of mentoring from the support you received?</label>
  		<div class="col-sm-5 radi">
  			<input name="c2" value="0" type="radio"> 0 
        <input name="c2" value="1" type="radio"> 1 <input name="c2" value="2" type="radio"> 2 
        <input name="c2" value="3" type="radio"> 3 <input name="c2" value="4" type="radio"> 4 <input name="c2" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="d2">d. Would you recommend this mentor to another student in the program?</label>
  		<div class="col-sm-5 radi">
  			<input name="d2" value="0" type="radio"> 0 
        <input name="d2" value="1" type="radio"> 1 <input name="d2" value="2" type="radio"> 2 
        <input name="d2" value="3" type="radio"> 3 <input name="d2" value="4" type="radio"> 4 <input name="d2" value="5" type="radio"> 5
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-5 control-label" for="e2">e. How do you think the mentor will rate their experience in her/his Mentor Evaluation?</label>
  		<div class="col-sm-5 radi">
  			<input name="e2" value="0" type="radio"> 0 
        <input name="e2" value="1" type="radio"> 1 <input name="e2" value="2" type="radio"> 2 
        <input name="e2" value="3" type="radio"> 3 <input name="e2" value="4" type="radio"> 4 <input name="e2" value="5" type="radio"> 5
		</div>
  </div>
  <br />

	<h3 class="special">4. Support from Mentoring PI and Research Lab</h3>
	
   <div class="form-group">
	<label class="col-sm-5 control-label" for="a3">a. How helpful/relevant was the professor (PI) in your mentoring experience?</label>
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
	<label class="col-sm-5 control-label" for="c3">c. Would you recommend this professor to another student in the program?</label>
  		<div class="col-sm-5 radi">
  			<input name="c3" value="0" type="radio"> 0 
        <input name="c3" value="1" type="radio"> 1 <input name="c3" value="2" type="radio"> 2 
        <input name="c3" value="3" type="radio"> 3 <input name="c3" value="4" type="radio"> 4 <input name="c3" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="d3">d. How do you think the PI rated the summer experience in her/his PI Evaluation?</label>
  		<div class="col-sm-5 radi">
  			<input name="d3" value="0" type="radio"> 0 
        <input name="d3" value="1" type="radio"> 1 <input name="d3" value="2" type="radio"> 2 
        <input name="d3" value="3" type="radio"> 3 <input name="d3" value="4" type="radio"> 4 <input name="d3" value="5" type="radio"> 5
		</div>
  </div>
    	<br />
  
	<h3 class="special">5. Support from fellow researchers in the same lab</h3>
	
   <div class="form-group">
	<label class="col-sm-5 control-label" for="a4">a. How helpful were your research colleagues in the lab?</label>
  		<div class="col-sm-5 radi">
  			<input name="a4" value="0" type="radio"> 0 
        <input name="a4" value="1" type="radio"> 1 <input name="a4" value="2" type="radio"> 2 
        <input name="a4" value="3" type="radio"> 3 <input name="a4" value="4" type="radio"> 4 <input name="a4" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="b4">b. Did you have a friendly workplace atmosphere?</label>
  		<div class="col-sm-5 radi">
  			<input name="b4" value="0" type="radio"> 0 
        <input name="b4" value="1" type="radio"> 1 <input name="b4" value="2" type="radio"> 2 
        <input name="b4" value="3" type="radio"> 3 <input name="b4" value="4" type="radio"> 4 <input name="b4" value="5" type="radio"> 5
		</div>
  </div>

   <div class="form-group">
	<label class="col-sm-5 control-label" for="c4">c. How could we improve on this?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="c4" id="c4"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="d4">d. Would you recommend this specific lab to another student?</label>
  		<div class="col-sm-5 radi">
  			<input name="d4" value="0" type="radio"> 0 
        <input name="d4" value="1" type="radio"> 1 <input name="d4" value="2" type="radio"> 2 
        <input name="d4" value="3" type="radio"> 3 <input name="d4" value="4" type="radio"> 4 <input name="d4" value="5" type="radio"> 5
		</div>
  </div>
  	<br />
  
	<h3 class="special">6. Support from fellow Interns</h3>
	
   <div class="form-group">
	<label class="col-sm-5 control-label" for="a5">a. How helpful to you were the other interns?</label>
  		<div class="col-sm-5 radi">
  			<input name="a5" value="0" type="radio"> 0 
        <input name="a5" value="1" type="radio"> 1 <input name="a5" value="2" type="radio"> 2 
        <input name="a5" value="3" type="radio"> 3 <input name="a5" value="4" type="radio"> 4 <input name="a5" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="b5">b. How could the program improve interactions among interns?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="b5" id="b5"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="c5">c. Did your interactions with fellow interns influence your performance in the lab?</label>
  		<div class="col-sm-5 radi">
  			<input name="c5" value="0" type="radio"> 0 
        <input name="c5" value="1" type="radio"> 1 <input name="c5" value="2" type="radio"> 2 
        <input name="c5" value="3" type="radio"> 3 <input name="c5" value="4" type="radio"> 4 <input name="c5" value="5" type="radio"> 5
		</div>
  </div>
  

   <div class="form-group">
	<label class="col-sm-5 control-label" for="d5">d. Would you have liked to interact more with students in parallel programs?</label>
  		<div class="col-sm-5 radi">
  			<input name="d5" value="0" type="radio"> 0 
        <input name="d5" value="1" type="radio"> 1 <input name="d5" value="2" type="radio"> 2 
        <input name="d5" value="3" type="radio"> 3 <input name="d5" value="4" type="radio"> 4 <input name="d5" value="5" type="radio"> 5
		</div>
  </div>

   <div class="form-group">
	<label class="col-sm-5 control-label" for="e5">e. Did you observe/experience problems with social interactions among interns? Could we have done something to improve this social side of the program?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="e5" id="e5"></textarea>
		</div>
  </div>

  	<br />
  
	<h3 class="special">7. Support from Program Director</h3>
   <div class="form-group">
	<label class="col-sm-5 control-label" for="a6">a. How helpful/effective was the Program Director for your Summer research experience?</label>
  		<div class="col-sm-5 radi">
  			<input name="a6" value="0" type="radio"> 0 
        <input name="a6" value="1" type="radio"> 1 <input name="a6" value="2" type="radio"> 2 
        <input name="a6" value="3" type="radio"> 3 <input name="a6" value="4" type="radio"> 4 <input name="a6" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="b6">b. How could the performance of the Program Director improve?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="b6" id="b6"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="c6">c. What would you change if you were the Program Director?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="c6" id="c6"></textarea>
		</div>
  </div>
  
  	<br />
  
	<h3 class="special">8. Support from Administrative Coordinator</h3>
   <div class="form-group">
	<label class="col-sm-5 control-label" for="a7">a. How well were travel, recreation, housing, and stipends done?  How could they be improved?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="a7" id="a7"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="b7">b. How helpful was the student activities coordinators for your summer research experience?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="b7" id="b7"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="c7">c. How could the coordinator's performance improve?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="c7" id="c7"></textarea>
		</div>
  </div>
  
  <br />
	<h3 class="special">9. Support from Department and University Officials</h3>
   <div class="form-group">
	<label class="col-sm-5 control-label" for="a8">a. Did you meet and talk with university officials this summer?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="a8" id="a8"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="b8">b. Were your discussions useful? What would you suggest for improvement?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="b8" id="b8"></textarea>
		</div>
  </div>
  
  
  <br />
	<h3 class="special">10. Evaluate Recreation and Living</h3>
   <div class="form-group">
	<label class="col-sm-5 control-label" for="a9">a. Were the weekend trips and other recreational activities helpful?  </label>
  		<div class="col-sm-5 radi">
  			<input name="a9" value="0" type="radio"> 0 
        <input name="a9" value="1" type="radio"> 1 <input name="a9" value="2" type="radio"> 2 
        <input name="a9" value="3" type="radio"> 3 <input name="a9" value="4" type="radio"> 4 <input name="a9" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="b9">b. What would you suggest for improvement?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="b9" id="b9"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="c9">c. Were the university's activities helpful?</label>
  		<div class="col-sm-5 radi">
  			<input name="c9" value="0" type="radio"> 0 
        <input name="c9" value="1" type="radio"> 1 <input name="c9" value="2" type="radio"> 2 
        <input name="c9" value="3" type="radio"> 3 <input name="c9" value="4" type="radio"> 4 <input name="c9" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="d9">d. Did you find events in the area accessible and affordable?</label>
  		<div class="col-sm-5 radi">
  			<input name="d9" value="0" type="radio"> 0 
        <input name="d9" value="1" type="radio"> 1 <input name="d9" value="2" type="radio"> 2 
        <input name="d9" value="3" type="radio"> 3 <input name="d9" value="4" type="radio"> 4 <input name="d9" value="5" type="radio"> 5
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="e9">e. What was your favorite recreational activity provided?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="e9" id="e9"></textarea>
		</div>
  </div>

  
  
  <br />
	<h3 class="special">11. Other</h3>
   <div class="form-group">
	<label class="col-sm-5 control-label" for="a10">a. In the lab and in the program, were you motivated to perform to high standard? Do you think your motivation could have been higher if some Program or lab features were improved? Please explain.</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="a10" id="a10"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="b10">b. Did you find the Professional Development Workshops interesting/helpful? What other workshops could you suggest? Which would you eliminate?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="b10" id="b10"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="c10">c. Did you find the Faculty Seminars informative? Motivating? Interesting? Helpful?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="c10" id="c10"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="d10">d. Was your preparation for your Undergraduate Research Symposium presentation helpful?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="d10" id="d10"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="e10">e. Did your mentor and host lab provide sufficient guidance in developing your oral and poster presentation?  How could we improve on this?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="e10" id="e10"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="f10">f. Did graduate student presentations help you to visualize your final presentation?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="f10" id="f10"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="g10">g. Was housing a comfortable arrangement? Any suggestions for improvement?</label>
  		<div class="col-sm-5">
       		<textarea class="form-control" rows="2" name="g10" id="g10"></textarea>
		</div>
  </div>
  
   <div class="form-group">
	<label class="col-sm-5 control-label" for="comments">If you have other concerns/ideas that you want to include, please feel free to add comments.</label>
  		<div class="col-sm-5">
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