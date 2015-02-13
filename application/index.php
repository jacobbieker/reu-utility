<?php
	include "../layout/header.php";
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Application Form" => "",
);
 ?>

<style type="text/css">

label {
	font-weight: normal;
}

</style>

    <div class="jumbotron">
      <div class="container">
        <h1>Application Form</h1>
        <p>The following is the application form for <?php echo $pgmName; ?>. For more information about applying visit our main website <a href="<?php echo $webFront;?>">here</a>.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>

    <div class="container">
    
    
<form id="app" class="form-horizontal" role="form" method="post" action="submit.php?db_key=d2005cc206ccbfdedf2be43a200cb050c538bdb5">
	<input type="hidden" name="referencecorr" value= "true" />
	<input name="block" value="1" type="hidden" />
	<div class="form-group">
		<label for="NameFirst" class="col-sm-4 control-label">Name</label>
	<div class="row-fluid">
	<div class="col-sm-3">
      		<input type="text" class="form-control" id="NameFirst" name="NameFirst" placeholder="First">
    </div>
	<div class="col-sm-3">
          		<input type="text" class="form-control" id="NameLast" name="NameLast" placeholder="Last">
    </div>
	</div>
  	</div>
  
  	
  <div class="form-group">
    <label for="College" class="col-sm-4 control-label">Your College or University</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="College" id="College">
    </div>
  </div>
  
  <div class="form-group">
    <label for="Class" class="col-sm-4 control-label">Class (as of Spring term/semester)</label>
    <div class="col-sm-6">
    	<select class="form-control" name="Class" id="Class">
            <option selected="selected" value="no selection"></option>
            <option value="Freshman">Freshman</option>
            <option value="Sophomore">Sophomore</option>
            <option value="Junior">Junior</option>
            <option value="Senior">Senior</option>
            <option value="Postbac">Postbac</option>
            <option value="Non-student">Not a student</option>
        </select>
    </div>
  </div>
  
  
  <div class="form-group">
    <label for="Excepted Graduation" class="col-sm-4 control-label">When do you plan to graduate?</label>
    <div class="col-sm-6">
   		<select class="form-control" name="Expected Graduation" id="Expected Graduation">
        </select>
    </div>
  </div>
  
  <div class="form-group">
    <label for="PgmDates" class="col-sm-4 control-label">What dates would you be available for the program?</label>
    <div class="col-sm-6">
   		<input type="text" class="form-control" name="PgmDates" id="PgmDates">
    </div>
  </div>
  
  
  <div class="form-group">
    <label for="Major" class="col-sm-4 control-label">What is your Major?</label>
    <div class="col-sm-6">
   		<input type="text" class="form-control" name="Major" id="Major">
    </div>
  </div>
  
  <div class="form-group">
    <label for="Transfer" class="col-sm-4 control-label">If you transferred from another institution, please list</label>
    <div class="col-sm-6">
   		<input type="text" class="form-control" name="Transfer" id="Transfer">
    </div>
  </div>
  
  <div class="form-group">
    <label for="email" class="col-sm-4 control-label">Email Address</label>
    <div class="col-sm-6">
   		<input type="text" class="form-control" id="email" name="email">
    </div>
  </div>
  
	<div class="form-group">
		<label for="CPhone" class="col-sm-4 control-label">Phone Numbers</label>
	<div class="row-fluid">
	<div class="col-sm-3">
      		<input type="text" class="form-control" id="CPhone" name="CPhone" placeholder="Cell">
    </div>
	<div class="col-sm-3">
          		<input type="text" class="form-control" id="SPhone" name="SPhone" placeholder="Other (if preferred)">
    </div>
	</div>
  	</div>
  	
<hr />


	<div class="form-group">
		<label for="CurrentStreet" class="col-sm-4 control-label">Current Address</label>
	<div class="row-fluid">
	<div class="col-sm-3">
      		<input type="text" class="form-control" id="CurrentStreet" name="CurrentStreet" placeholder="Street">
    </div>
	<div class="col-sm-3">
          		<input type="text" class="form-control" id="CurrentCity" name="CurrentCity" placeholder="City">
    </div>
	</div>
	</div>
	
	<div class="form-group">
	<div class="row-fluid">
	<div class="col-sm-offset-4 col-sm-3">
      		<input type="text" class="form-control" id="CurrentState" name="CurrentState" placeholder="State">
    </div>
	<div class="col-sm-3">
          		<input type="text" class="form-control" id="CurrentZip" name="CurrentZip" placeholder="ZIP Code">
    </div>
	</div>
	</div><br />
  	

	<div class="form-group">
		<label for="PermanentStreet" class="col-sm-4 control-label">Permanent Address</label>
	<div class="row-fluid">
	<div class="col-sm-3">
      		<input type="text" class="form-control" id="PermanentStreet" name="PermanentStreet" placeholder="Street">
    </div>
	<div class="col-sm-3">
          		<input type="text" class="form-control" id="PermanentCity" name="PermanentCity" placeholder="City">
    </div>
	</div>
	</div>
	
	<div class="form-group">
	<div class="row-fluid">
	<div class="col-sm-offset-4 col-sm-3">
      		<input type="text" class="form-control" id="PermanentState" name="PermanentState" placeholder="State">
    </div>
	<div class="col-sm-3">
          		<input type="text" class="form-control" id="PermanentZip" name="PermanentZip" placeholder="ZIP Code">
    </div>
	</div>
	</div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
   		<input type="text" class="form-control" id="HPhone" name="HPhone" placeholder="Home Phone">
    </div>
  </div>
  
  <hr />
  
  <div class="form-group">
    <label for="DOB" class="col-sm-4 control-label">Date of Birth (MM/DD/YY)</label>
    <div class="col-sm-6">
   		<input type="text" class="form-control" name="DOB" id="DOB">
    </div>
  </div>
  
  
  <div class="form-group">
    <label for="Citizenship" class="col-sm-4 control-label">Citizenship</label>
    <div class="col-sm-6">
    	<select class="form-control" name="Citizenship" id="Citizenship">
            <option selected="selected" value="no selection"></option>
            <option value="US Citizen">US Citizen</option>
            <option value="Permanent Resident with Green Card">Permanent Resident with Green Card</option>
            <option value="Permanent Resident awaiting Green Card">Permanent Resident awaiting Green Card</option>
            <option value="Not US Citizen">Not US Citizen</option>
        </select>
    </div>
  </div>
  

  <div class="form-group">
    <label for="Gender" class="col-sm-4 control-label">Gender</label>
    <div class="col-sm-6">
	<label class="radio-inline">
  		<input type="radio" id="Gender" name="Gender" value="Male"> Male</label>
	<label class="radio-inline">
  		<input type="radio" id="Gender" name="Gender" value="Female"> Female</label>
    </div>
  </div>
  

  <div class="form-group">
    <label for="Race Ethnic Background" class="col-sm-4 control-label">Race/Ethnic Background</label>
    <div class="col-sm-6">
    	<select class="form-control" name="Race Ethnic Background" id="Race Ethnic Background">
			<option selected="selected" value="no selection"></option>
			<option value="African American">African American</option>
			<option value="Alaska Native">Alaska Native</option>
			<option value="Asian">Asian</option>
			<option value="Hispanic">Hispanic</option>
			<option value="Native American">Native American</option>
			<option value="Pacific Islander">Pacific Islander</option>
			<option value="White">White</option>
			<option value="Multiracial">Multiracial</option>
			<option value="Other">Other</option>
			<option value="Decline response">Decline response</option>
		</select>
		</div>
	</div>
	
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
   		<input type="text" class="form-control" id="RaceOther" name="RaceOther" placeholder="If 'Multiracial or Other', please explain">
    </div>
  </div>
  
  
  <div class="form-group">
    <label for="Disadvantaged" class="col-sm-4 control-label">Do you claim disadvantaged status?</label>
     <div class="col-sm-6">
    	<select class="form-control" name="Disadvantaged" id="Disadvantaged">
        	<option selected="selected" value="no selection"></option>
            <option value="No">No</option>
            <option value="FirstGen">First generation to attend college</option>
            <option value="LowIncome">Low Income</option>
            <option value="Other">Other or multiple - Please explain</option>
        </select>
	 </div>
	</div>
	
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
   		<input type="text" class="form-control" id="DisadvantagedOther" name="DisadvantagedOther" placeholder="If 'Other or multiple', please explain">
    </div>
  </div>
  
  <hr />
  
  
  <div class="form-group">
  	<label for="LearnedofSPUR" class="col-sm-4 control-label">How did you learn about this program?</label>
  		<div class="col-sm-6">
              <select class="form-control" name="LearnedofSPUR" id="LearnedofSPUR">
                <option selected="selected" value=" "> </option>
                <option value="Internet search">Internet search </option>
                <option value="ABRCMS meeting">ABRCMS meeting </option>
                <option value="SACNAS meeting">SACNAS meeting</option>
                <option value="AISES meeting">AISES meeting</option>    
                <option value="College advisor">College advisor</option>
                <option value="Mailing or poster">Mailing or poster</option>        
                <option value="Other">Other </option>
              </select>
        </div>
    </div>


  <div class="form-group">
    <label for="PreviousPgm" class="col-sm-4 control-label">Have you participated previously in a summer undergraduate research program at another institution?</label>
    <div class="col-sm-6">
	<label class="radio-inline">
  		<input type="radio" id="PreviousPgm" name="PreviousPgm" value="Yes"> Yes</label>
	<label class="radio-inline">
  		<input type="radio" id="PreviousPgm" name="PreviousPgm" value="No"> No</label>
    </div>
    <div class="col-sm-6">
    <input style="margin-top: 10px;" name="OtherPgmName" id="OtherPgmName" class="form-control" placeholder="If so, list name of the Program &amp; Institution" type="text" />
    </div>
  </div>
  
  
<div class="form-group">
    <label for="MARCcurrent" class="col-sm-4 control-label">Are you currently a MARC scholar?</label>
    <div class="col-sm-6">
	<label class="radio-inline">
  		<input type="radio" id="MARCcurrent" name="MARCcurrent" value="Yes"> Yes</label>
	<label class="radio-inline">
  		<input type="radio" id="MARCcurrent" name="MARCcurrent" value="No"> No</label>
  		<span class="help-block"><i>MARC: Minority Access to Research Careers</i></span>
    </div>
  </div>
  
  
  <div class="form-group">
    <label for="MARCpast" class="col-sm-4 control-label">Have you been a MARC scholar in the past?</label>
    <div class="col-sm-6">
	<label class="radio-inline">
  		<input type="radio" id="MARCpast" name="MARCpast" value="Yes"> Yes</label>
	<label class="radio-inline">
  		<input type="radio" id="MARCpast" name="MARCpast" value="No"> No</label>
    </div>
  </div>
  

  <div class="form-group">
	<label class="col-sm-4 control-label" for="AdvDegree">Do your career goals inlude an advanced degree?</label>
  		<div class="col-sm-6">
        <select class="form-control" name="AdvDegree" id="AdvDegree">
        	<option selected="selected" value="no selection"></option>
            <option value="PhDonly">Yes, PhD</option>
            <option value="MDonly">Yes, MD</option>
            <option value="MDPhD">Yes, MD and PhD</option>
            <option value="Unsure">Unsure, possibly PhD</option>
            <option value="OtherProf">Other Professional Degree, e.g., DDS, DVM, etc</option>
            <option value="Unsure">Unsure</option>
            <option value="No">No</option>
        </select>
      </div>
    </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
   		<input type="text" class="form-control" id="AdvDegreeOther" name="AdvDegreeOther" placeholder="If 'Other', please specify">
    </div>
  </div>
  
  
  <div class="form-group">
    <label for="ResearchCareer" class="col-sm-4 control-label">Do your career goals include research in life sciences?</label>
    <div class="col-sm-6">
	<label class="radio-inline">
  		<input type="radio" id="ResearchCareer" name="ResearchCareer" value="Yes"> Yes</label>
	<label class="radio-inline">
  		<input type="radio" id="ResearchCareer" name="ResearchCareer" value="No"> No</label>
	<label class="radio-inline">
  		<input type="radio" id="ResearchCareer" name="ResearchCareer" value="Unsure"> Unsure</label>
    </div>
  </div>
  


  <div class="form-group">
	<label class="col-sm-4 control-label" for="GREorMCAT">Do you plan to take the GRE, MCAT or other graduate/professional school admissions standardized exam?</label>
  		<div class="col-sm-6">
        <select class="form-control" name="GREorMCAT" id="GREorMCAT">
            <option selected="selected" value=""></option>
            <option value="No">No</option>
            <option value="GRE">GRE</option>
            <option value="MCAT">MCAT</option>
            <option value="DAT">DAT</option>
            <option value="VCAT">VCAT</option>
            <option value="LSAT">LSAT</option>
            <option value="GMAT">GMAT</option>
            <option value="Other">Other</option>
        </select>
   		<input style="margin-top:10px;" type="text" class="form-control" id="TESTdate" name="TESTdate" placeholder="If so, when do you plan to take the exam?">
    </div>
    </div>

	<div class="form-group">
		<label for="GPAcum" class="col-sm-4 control-label">What is your approximate GPA?</label>
	<div class="row-fluid">
	<div class="col-sm-3">
      		<input type="text" class="form-control" id="GPAcum" name="GPAcum" placeholder="Cumulative GPA">
    </div>
	<div class="col-sm-3">
          		<input type="text" class="form-control" id="GPAstem" name="GPAstem" placeholder="Science/Math GPA">
    </div>
	</div>
  	</div>
  	
  	<hr />
  	

  <div class="form-group">
	<label class="col-sm-4 control-label" for="Statement A Background">Describe your academic background, scientific interests, goals, and past research experience (if any).  Include significant science courses you have taken and specific laboratory techniques you may have used. (Note: prior research experience is not required)</label>
  		<div class="col-sm-6">
  			<textarea class="form-control" rows="6"  name="Statement A Background" id="Statement A Background"></textarea>
		</div>
  </div>
  

  <div class="form-group">
	<label class="col-sm-4 control-label" for="Statement B Goals">Why do you want to participate in a Summer research experience? Explain what you hope to gain from the Summer experience and how it will help you pursue your career and personal goals.</label>
  		<div class="col-sm-6">
  			<textarea class="form-control" rows="6"  name="Statement B Goals" id="Statement B Goals"></textarea>
		</div>
  </div>
  
  
  <div class="form-group">
    <label class="col-sm-4 control-label" for="ResearchChoice1">Indicate your area(s) of research interest</label>
    <div class="row-fluid">
    <div class="col-sm-4">
              <select class="form-control" name="ResearchChoice1" id="ResearchChoice1" class="choice">
                <option value="No selection" selected="selected">1st Choice:</option>
                <option value="Biochemistry">Biochemistry</option>
                <option value="Bioinformatics">Bioinformatics</option>
                <option value="Biology">Biology</option>
                <option value="Biophysics">Biophysics</option>
                <option value="Cell Biology">Cell Biology</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Cognitive Neuroscience">Cognitive Neuroscience</option>
                <option value="Computer and Information Science">Computer Science</option>
                <option value="Genetics">Genetics</option>
                <option value="Developmental Biology">Developmental Biology</option>
                <option value="Ecology">Ecology</option>
                <option value="Environmental Studies">Environmental Studies/Sciences</option>
                <option value="Evolutionary Biology">Evolutionary Biology</option>
                <option value="Exercise/Movement Studies">Exercise</option>
                <option value="General Science">General Science </option>
                <option value="Human Biology">Human Biology</option>
                <option value="Human Physiology">Human Physiology</option>
                <option value="Marine Biology">Marine Biology</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Microbiology">Microbiology</option>
                <option value="Molecular Biology">Molecular Biology</option>
                <option value="Neurobiology">Neurobiology</option>
                <option value="Physics">Physics</option>
                <option value="Physiology">Physiology</option>
                <option value="Psychology">Psychology </option>
                <option value="Structural Biology">Structural Biology</option>
                <option value="Other">Other</option>
              </select>
        </div>
		<div class="col-sm-2">
              <select class="form-control" name="ResearchChoice1importance" id="ResearchChoice1importance" class="imp">
                <option value="No selection" selected="selected">Importance:</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
              </select>
        </div>
    </div>
    </div>
  

  <div class="form-group">
    <div class="row-fluid">
    <div class="col-sm-offset-4 col-sm-4">
              <select class="form-control" name="ResearchChoice2" id="ResearchChoice2" class="choice">
                <option value="No selection" selected="selected">2nd Choice:</option>
                <option value="Biochemistry">Biochemistry</option>
                <option value="Bioinformatics">Bioinformatics</option>
                <option value="Biology">Biology</option>
                <option value="Biophysics">Biophysics</option>
                <option value="Cell Biology">Cell Biology</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Cognitive Neuroscience">Cognitive Neuroscience</option>
                <option value="Computer and Information Science">Computer Science</option>
                <option value="Genetics">Genetics</option>
                <option value="Developmental Biology">Developmental Biology</option>
                <option value="Ecology">Ecology</option>
                <option value="Environmental Studies">Environmental Studies/Sciences</option>
                <option value="Evolutionary Biology">Evolutionary Biology</option>
                <option value="Exercise/Movement Studies">Exercise</option>
                <option value="General Science">General Science </option>
                <option value="Human Biology">Human Biology</option>
                <option value="Human Physiology">Human Physiology</option>
                <option value="Marine Biology">Marine Biology</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Microbiology">Microbiology</option>
                <option value="Molecular Biology">Molecular Biology</option>
                <option value="Neurobiology">Neurobiology</option>
                <option value="Physics">Physics</option>
                <option value="Physiology">Physiology</option>
                <option value="Psychology">Psychology </option>
                <option value="Structural Biology">Structural Biology</option>
                <option value="Other">Other</option>
              </select>
        </div>
		<div class="col-sm-2">
              <select class="form-control" name="ResearchChoice2importance" id="ResearchChoice2importance" class="imp">
                <option value="No selection" selected="selected">Importance:</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
              </select>
        </div>
    </div>
    </div>
  
  
  <div class="form-group">
    <div class="row-fluid">
    <div class="col-sm-offset-4 col-sm-4">
              <select class="form-control" name="ResearchChoice3" id="ResearchChoice3" class="choice">
                <option value="No selection" selected="selected">3rd Choice:</option>
                <option value="Biochemistry">Biochemistry</option>
                <option value="Bioinformatics">Bioinformatics</option>
                <option value="Biology">Biology</option>
                <option value="Biophysics">Biophysics</option>
                <option value="Cell Biology">Cell Biology</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Cognitive Neuroscience">Cognitive Neuroscience</option>
                <option value="Computer and Information Science">Computer Science</option>
                <option value="Genetics">Genetics</option>
                <option value="Developmental Biology">Developmental Biology</option>
                <option value="Ecology">Ecology</option>
                <option value="Environmental Studies">Environmental Studies/Sciences</option>
                <option value="Evolutionary Biology">Evolutionary Biology</option>
                <option value="Exercise/Movement Studies">Exercise</option>
                <option value="General Science">General Science </option>
                <option value="Human Biology">Human Biology</option>
                <option value="Human Physiology">Human Physiology</option>
                <option value="Marine Biology">Marine Biology</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Microbiology">Microbiology</option>
                <option value="Molecular Biology">Molecular Biology</option>
                <option value="Neurobiology">Neurobiology</option>
                <option value="Physics">Physics</option>
                <option value="Physiology">Physiology</option>
                <option value="Psychology">Psychology </option>
                <option value="Structural Biology">Structural Biology</option>
                <option value="Other">Other</option>
              </select>
        </div>
		<div class="col-sm-2">
              <select class="form-control" name="ResearchChoice3importance" id="ResearchChoice3importance" class="imp">
                <option value="No selection" selected="selected">Importance:</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
              </select>
        </div>
    </div>
    </div>
    
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
   		<input type="text" class="form-control" id="ResearchChoiceOther" name="ResearchChoiceOther" placeholder="If 'Other', please explain">
    </div>
  </div>

  <div class="form-group">
	<label class="col-sm-4 control-label" for="Statement D Detail"><i>(Optional)</i> Please give a more detailed description of your research interests: Are your interests broad? Have you narrowed them? Do you have defined interests in several areas?</label>
  		<div class="col-sm-6">
  			<textarea class="form-control" rows="6"  name="Statement D Detail" id="Statement D Detail"></textarea>
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-4 control-label" for="Statement E LabPrefs">After viewing the participating laboratories listed on our website, please list a few laboratories for which you might have a preference (if any).</label>
  		<div class="col-sm-6">
  			<textarea class="form-control" rows="6"  name="Statement E LabPrefs" id="Statement E LabPrefs"></textarea>
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-4 control-label" for="Statement F Activities"><i>(Optional)</i> Describe your outside interests and activities.</label>
  		<div class="col-sm-6">
  			<textarea class="form-control" rows="6"  name="Statement F Activities" id="Statement F Activities"></textarea>
		</div>
  </div>
  
  <div class="form-group">
	<label class="col-sm-4 control-label" for="Unofficial transcript">Paste or type your classes and grades here -- (as neatly as possible; no official transcripts or images; please include courses you're currently taking)</label>
  		<div class="col-sm-6">
  			<textarea class="form-control" rows="6" name="Unofficial transcript" id="Unofficial transcript"></textarea>
		</div>
  </div>
  
  
  <hr />
  
  <p align="center" style="font-size:15px;">Please arrange for two letters of recommendation from faculty at your home institution to be uploaded via our LOR upload application or sent by <a href="mailto:<?php echo $emails; ?>">email</a>.</p><br />
  
  	<div class="form-group">
		<label for="Faculty1 name" class="col-sm-4 control-label">Faculty reference 1</label>
	<div class="row-fluid">
		<div class="col-sm-3">
 			<input class="form-control" name="Faculty1 name" id="Faculty1 name" placeholder="Name;  Department;  Institution" type="text" />
 		</div>
	<div class="col-sm-3">
			<input class="form-control" name="Faculty1 email" id="Faculty1 email" placeholder="Email" type="text" />
    </div>
	</div>
  	</div>
  	
  	
    <div class="form-group">
		<label for="Faculty2 name" class="col-sm-4 control-label">Faculty reference 2</label>
	<div class="row-fluid">
		<div class="col-sm-3">
 			<input class="form-control" name="Faculty2 name" id="Faculty2 name" placeholder="Name;  Department;  Institution" type="text" />
 		</div>
	<div class="col-sm-3">
			<input class="form-control" name="Faculty2 email" id="Faculty2 email" placeholder="Email" type="text" />
    </div>
	</div>
  	</div>
  
  
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="notifyLetters" id="notifyLetters"> Would you like us to send an email to your letter writers, giving them the link to the page where they can upload their letters?
			(NOTE: This selection is highly preferred)
        </label>
      </div>
    <span class="help-block"><i>If you do not select this box, you are expected to contact your writers personally, and have them email us their letter.</i></span>
    </div>
  </div>
  <div class="form-group">
    <div style="text-align:center;">
      <button type="button" id="btn" style="margin-right:15px;" class="btn btn-success">Submit Application</button>
      <button type="reset" class="btn btn-danger">Clear Form</button>
    </div>
  </div>
</form>


<script type="text/javascript" src="../layout/js/validate.js"></script>
<script type="text/javascript" src="../layout/js/gradDate.js"></script>  

<?php include "../layout/footer.php"; ?>