<?php
include_once ('databases.php');
$pwAcc = getPermissions('login');
include "layout/header.php";
require ('pw/login.php');
include "layout/header.php";



$bread = array(
    $pgmAcronym . " Home" => "",
);

?>

    <div class="jumbotron">
      <div class="container">
        <h1><?php echo $pgmAcronym; ?></h1>
    	<p>Welcome! You have successfully logged in as <b><?php echo $_SESSION['login']; ?></b>. The following is a list of utilities that are available to you.</p>
        <!--<p><a href="<?php echo $webFront; ?>application" class="btn btn-primary btn-md" role="button">Apply Now!</a></p>-->
      </div>
    </div>
    
    <div class="container">
    
    <h3>Navigation Options</h3>
    <hr />

    
    
    
    
    <?php
					$user = $_SESSION['login'];
					$list = [];
					$x = 1;

				 	$list[0] = '<a href="' . $webFront . 'application" class="list-group-item">
				 				<h4 class="list-group-item-heading">Application</h4>
   								<p class="list-group-item-text">Apply to be an intern for the upcoming program session.</p>
								</a>';
				 						
					$n = getPermissions('applicantReview');
					if ($n[$user]) {
						$list[$x] = '<a class="list-group-item" href="' . $webFront . 'faculty">
									<h4 class="list-group-item-heading">Review Applicants</h4>
   									<p class="list-group-item-text">View suggested applicant information for your lab.</p>
   									</a>';
						$x++;
					}
					
					$n = getPermissions('abstractsView');
					if ($n[$user]) {
						$list[$x] = '<a class="list-group-item" href="' . $webFront . 'abstracts">
									<h4 class="list-group-item-heading">Abstracts</h4>
   									<p class="list-group-item-text">View the abstracts of the current interns, or edit your own abstract.</p>
   									</a>';
						$x++;
					}
					
					$n = getPermissions('prView');
					if ($n[$user]) {
						$list[$x] = '<a class="list-group-item" href="' . $webFront . 'pr">
									<h4 class="list-group-item-heading">Progress Reports</h4>
   									<p class="list-group-item-text">View the progress reports of the current interns, or submit your own progress report.</p>
   									</a>';
						$x++;
					}

					$n = getPermissions('presentationView');
					if ($n[$user]) {
						$list[$x] = '<a class="list-group-item" href="' . $webFront . 'presentations">
									<h4 class="list-group-item-heading">Presentations</h4>
   									<p class="list-group-item-text">View the presenations of the current interns.</p>
   									</a>';
						$x++;
					}

					$n = getPermissions('posterUpload');
					if ($n[$user]) {
						$list[$x] = '<a class="list-group-item" href="' . $webFront . 'presentations/poster.php">
									<h4 class="list-group-item-heading">Upload Poster</h4>
   									<p class="list-group-item-text">Upload and submit your poster for the yearly symposium.</p>
   									</a>';
						$x++;
					}
					
					$n = getPermissions('presentationUpload');
					if ($n[$user]) {
						$list[$x] = '<a class="list-group-item" href="' . $webFront . 'presentations/presentation.php">
									<h4 class="list-group-item-heading">Upload Presentation</h4>
   									<p class="list-group-item-text">Upload and submit your slideshow presentation for the yearly symposium.</p>
   									</a>';
						$x++;
					}

					$n = getPermissions('piEval');
					if ($n[$user]) {
						$list[$x] = '<a class="list-group-item" href="' . $webFront . 'evals/pi.php">
									<h4 class="list-group-item-heading">PI Evaluation</h4>
   									<p class="list-group-item-text">Evaluate your program experience as a faculty member.</p>
   									</a>';
						$x++;
					}

					$n = getPermissions('mentorEval');
					if ($n[$user]) {
						$list[$x] = '<a class="list-group-item" href="' . $webFront . 'evals/mentor.php">
									<h4 class="list-group-item-heading">Mentor Evaluation</h4>
   									<p class="list-group-item-text">Evaluate your program experience as a mentor.</p>
   									</a>';
						$x++;
					}

					$n = getPermissions('internEval');
					if ($n[$user]) {
						$list[$x] = '<a class="list-group-item" href="' . $webFront . 'evals/intern.php">
									<h4 class="list-group-item-heading">Intern Evaluation</h4>
   									<p class="list-group-item-text">Evaluate your program experience as an intern.</p>
   									</a>';
						$x++;
					} 
					
					?>
					
					
    
<div class="bs-example">
<div class="row">
<div class="col-sm-5 col-sm-offset-1">
<div class="list-group">
<?php
	$t = floor(count($list)/2);
	if (count($list) > 2) {
		if (count($list) % 2 != 0) {
			$t = floor(count($list)/2)+1;
		}
	} else {
		if ($t == 0) $t = 1;
	}
	for($i=0; $i<$t; $i++) {
  		$link = $list[$i];
    	echo $link;
	}
?>
</div>
</div>

<div class="col-sm-5">
<div class="list-group">
<?php
	if (count($list) >= 2) {
	for($i=$t; $i<count($list); $i++) {
  		$link = $list[$i];
    	echo $link;
	}
	}
?>
</div>
</div>
</div>
</div>					





<!--    
	<div class="row">
	<div class="col-sm-5 col-sm-offset-1">
	<div class="list-group">
		<a class="list-group-item" href="">Testing</a>
	</div>
	</div>

	<div class="col-sm-5">
	<div class="list-group">
		<a class="list-group-item" href="">Testing2</a>
	</div>
	</div>
	</div>-->



<?php include "layout/footer.php"; ?>