<?php
	/* 
	 * Main header file for the utility layout. Theme color
	 * can be set using the "AccentColor" field in the setup
	 * layout of the filemaker database. Uses Jumbotron template
	 * for bootstrap.
	 */
	include_once ('../databases.php');
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
	
	<?php if ($color != "Default (Gray)" && $color != "") { ?> 
		<link href="<?php echo $webFront; ?>layout/css/<?php echo $color; ?>.css" rel="stylesheet">
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
        		<a href="<?php echo $webFront ?>"> <img style="margin-top:7px;" class="brand" src="img.php?url=<?php echo urlencode($rec->getField('Logo2')); ?>"></a>
   		</div>
          <!--<a class="navbar-brand" href="<?php echo $webFront ?>"><?php echo $pgmName; ?></a>-->
        </div>
        <div class="navbar-collapse collapse">
        <?php 
        	session_start();
        	if($_SESSION['login'] && substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) != "logout.php") { ?>
        		<ul class="nav navbar-nav pull-right"><li class="active"><a href="<?php echo $webFront; ?>pw/logout.php">Logout</a></li></ul>
        <?php } ?>
        
        <!--  <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>-->
        </div><!--/.navbar-collapse -->
        
      </div>
    </div>