<?php
	include_once ('../databases.php');
	global $pnmName, $webFront, $rec, $color;
?>



<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title><?php echo $pgmName; ?></title>
    
    <link href="<?php echo $webFront; ?>layout/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $webFront; ?>layout/css/jumbotron.css" rel="stylesheet">

    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style type="text/css">
		blockquote p {
			font-size: 15px;
		}
	</style>
	
	<?php 
	 if ($color != "Default (Gray)" && $color != "") { ?> 
	<link href="<?php echo $webFront; ?>layout/css/<?php echo strtolower ($color); ?>.css" rel="stylesheet">
	
	<?php } ?>
	
  </head>

  <body>
  


    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="navbar-inner">
          <?php if ($rec->getField('Logo2') == "") { ?>
          	<a class="navbar-brand" href="<?php echo $webFront ?>"><?php echo $pgmName; ?></a>
          <?php } else { ?>
        		<a href="<?php echo $webFront ?>"> <img style="margin-top:7px;" class="brand" src="<?php echo $webFront ?>layout/img.php?-url=<?php echo urlencode($rec->getField('Logo2')); ?>"></a>
          <?php } ?>
   		</div>
        </div>
        <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav pull-right">
        <?php 
        	session_start();
        	if($_SESSION['login'] != "" && substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) != "logout.php") { ?>
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo $_SESSION['login']; ?> <span class="caret"></span></a>
					<ul class="dropdown-menu inverse-dropdown" role="menu">
				<?php
				
					$user = $_SESSION['login'];

					echo '<li><a href="' . $webFront . 'application">Application</a></li>';
					
					$n = getPermissions('applicantReview');
					if ($n[$user]) {
						echo '<li><a href="' . $webFront . 'faculty">Review Applicants</a></li>';
					}
					echo '<li class="divider"></li>';
					
					$n = getPermissions('abstractsView');
					if ($n[$user]) {
						echo '<li><a href="' . $webFront . 'abstracts">Abstracts</a></li>';
					}
					
					$n = getPermissions('prView');
					if ($n[$user]) {
						echo '<li><a href="' . $webFront . 'pr">Progress Reports</a></li>';
					}

					$n = getPermissions('presentationView');
					if ($n[$user]) {
						echo '<li><a href="' . $webFront . 'presentations">Presentations</a></li>';
					}

					$n = getPermissions('posterUpload');
					if ($n[$user]) {
						echo '<li><a href="' . $webFront . 'presentations/poster.php">Upload Poster</a></li>';
					}
					
					$n = getPermissions('presentationUpload');
					if ($n[$user]) {
						echo '<li><a href="' . $webFront . 'presentations/presentation.php">Upload Presentation</a></li>';
					}
					echo '<li class="divider"></li>';


					$n = getPermissions('piEval');
					if ($n[$user]) {
						echo'<li><a href="' . $webFront . 'evals/pi.php">PI Evaluation</a></li>';
					}

					$n = getPermissions('mentorEval');
					if ($n[$user]) {
						echo'<li><a href="' . $webFront . 'evals/mentor.php">Mentor Evaluation</a></li>';
					}

					$n = getPermissions('internEval');
					if ($n[$user]) {
						echo'<li><a href="' . $webFront . 'evals/intern.php">Intern Evaluation</a></li>';
					} 
					
					?>
					</ul>
				  </li>
        			<li><a href="<?php echo $webFront; ?>pw/logout.php">Logout</a></li>
        <?php } elseif ($_SESSION['login'] == "" && $index ) { ?>
 			<li><a href="<?php echo $webFront; ?>login.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Sign in</a>
  			<li><a href="<?php echo $webFront; ?>application">Apply</a>
        <?php } ?>
        </ul>
        </div>
      </div>
    </div>