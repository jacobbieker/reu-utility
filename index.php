<?php
include_once ('databases.php');
$index = 1;
include "layout/header.php";


$bread = array(
    $pgmAcronym . " Home" => "",
);

?>

    <div class="jumbotron">
      <div class="container">
        <h1><?php echo $pgmAcronym; ?></h1>
    	<p>
    	
    	<!-- REPLACE THE SLOGAN LINE IF NECESSARY -->
    	
    	This is a temporary homepage for the <?php echo $pgmName; ?> set up by IRO (Interface for Research Opportunities).
    	
    	<!-- END OF SLOGAN LINE -->

    	
    	</p>
    	<p><a href="application" class="btn btn-primary btn-md" role="button">Apply for <?php echo $pgmAcronym; ?> &raquo;</a></p>
    	
      </div>
    </div>
    
    <div class="container">

<!-- REPLACE TEXT BELOW IF NECESSARY -->

		<h3>Interface for Research Opportunities</h3>
		<hr />

    <p>Undergraduate research programs provide a unique avenue for training and empowering our next generation of researchers and mentors to pursue meaningful and productive careers in STEM areas. Administering such programs can be quite complex, involving many stakeholders and organizational tasks. To administer undergraduate research programs more efficiently, we have developed an Interface for Undergraduate Opportunities (IRO) which provides web-based interfaces for the following utilities:</p>
    
    <ul>
    	<li><b>Application form</b> - for interested students to submit their information and qualifications to become a possible intern.</li>
    	<li><b>Applicant review center</b> - where PIs can view the application information of prospective interns in pdf form.</li>
    	<li><b>Abstracts</b> - where interns can submit or update their own project abstract, or view the other students' abstracts.</li>
    	<li><b>Progress Reports</b> - where interns can post their weekly updates on the program and lab experience.</li>
    	<li><b>Presentations</b> - interns can view and upload their slideshow presentations and posters for a symposium at the end of the program.</li>
    	<li><b>Evaluations</b> - survey forms for interns, mentors, and faculty to reflect on their experience in the program.</li>
    </ul>


	<p>IRO is a system powered by a <a href="http://filemaker.com/">Filemaker</a> database, and web applications written in the Filemaker PHP API. IRO automates and simplifies many key functions related to these tasks, reducing the workload for program administrators. It enables individual program related management by program interns, mentors, faculty, and administrators each having separate password protected accounts. To make it available for all colleagues interested in adopting such a system, we have developed an open source utility that leads interested program administrators through the assembly and customization of a similar system on their own servers. IRO was designed with administrators in mind, the system is ready-made and requires no further programming knowledge to set up or maintain. However, further customization of the applications provided may require familiarity with HTML, CSS, or PHP.</p>

	<p>This work was developed for use by the University of Oregon <a href="http://spur.uoregon.edu/">Summer Program for Undergraduate Research (SPUR)</a> and the NSF BIO REU Site Program in Molecular Biosciences at the University of Oregon.</p>

    
    <br />
    
    <h3>Getting Started - Home Page</h3>
    <hr />
    <p>If you have not already, please refer to the <a href="">user manual</a> for assistance with setting up IRO. If you do not already have a home page set up, please delete the text on this page and replace it with your home page message. If you already have a website for your program, please delete this file (index.php) or change the name of this file and keep it as a reference. In this case you should also add a link to the application form as well as the login page. If you are unsure how to add these links, copy and paste the code below into the HTML for your home page.</p>
    
    
    <p><b>Link to the Application Form:</b><br />
    <code>&lt;a href="application"&gt;Application Form&lt;/a&gt;</code></p>
    

    
    <p><b>Link to the Login Page:</b><br />
    <code>&lt;a href="login.php"&gt;Sign In&lt;/a&gt;</code></p>
    
    <p>Check your links once you've saved your index file. If you find that these links when clicked, do not go to the right location, try replacing the <code>href</code> element with the direct location of the page. For example, if my website URL is <b>mywebsite.edu</b>. The code for the link to the application form could be written as: <code>&lt;a href="http://mywebsite.edu/application"&gt;Application Form&lt;/a&gt;</code></p>
    
    
    <p>For full instructions on getting started with IRO, please refer to the <a href="">user manual</a>. For further assistance, technical support, or to report a problem please contact <a href="http://spur.uoregon.edu/">SPUR</a>.</p>
    
    
<!-- DO NOT DELETE ANYTHING FURTHER -->


<?php include "layout/footer.php"; ?>