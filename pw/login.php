<?php
	require('hash.php');
	include "../layout/header.php";
	include_once ('../databases.php');
	$db_key = "application";
	
function getFooterPath() {
	global $pwAcc;
	if($pwAcc['Login']) {
		$path = "layout/footer.php";
	} else {
		$path = "../layout/footer.php";
	}
	return $path;
}
	
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login'] = "";
}
if (isset($_POST['password'])) {
	$record = $fm->getRecordById('Setup', 5);
	$password = $_POST['password'];

	$hasher = new PasswordHash(8, false);
	if (strlen($password) > 72) { die("Password must be 72 characters or less"); }
	$stored_hash = "*";
	$check = false;

	// Validation for admin password
	$stored_hash = $record->getField('adminPWHash');
	$check = $hasher->CheckPassword($password, $stored_hash);
	if ($check)
		$_SESSION['login'] = 'Admin';

	// Validation for faculty password
	if ($pwAcc['Faculty'] && !$check) {
		$stored_hash = $record->getField('facultyPWHash');
		$check = $hasher->CheckPassword($password, $stored_hash);
		if ($check) {
			$_SESSION['login'] = 'Faculty';
		}
	}

	// Validation for mentor password
	if ($pwAcc['Mentor'] && !$check) {
		$stored_hash = $record->getField('mentorPWHash');
		$check = $hasher->CheckPassword($password, $stored_hash);
		if ($check) {
			$_SESSION['login'] = 'Mentor';
		}
	}

	// Validation for Intern password
	if ($pwAcc['Intern'] && !$check) {
		$stored_hash = $record->getField('studentPWHash');
		$check = $hasher->CheckPassword($password, $stored_hash);
		if ($check) {
			$_SESSION['login'] = 'Intern';
		}
	}

	if (!$check) {
		$bread = array(
			$pgmAcronym . " Home" => $webFront,
			"Login" => "javascript:location.reload();",
			"Incorrect Password" => ""
		);
		echo '<div class="jumbotron"><div class="container"><h1>Incorrect Password</h1><p>There was an issue with the password you entered, or you are not authorized to view this page. If you believe this is an error, please <a href="mailto:' . $email_to[$db_key] . '">contact us</a> if the issue persists.</p>
		<a class="btn btn-primary btn-md" href="" role="button">Return to the login page</a></div></div><div class="container">';
		include (getFooterPath());
		exit;
	}
    
}

$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Login" => "",
);

if ($_SESSION['login'] != "") {
	foreach ($pwAcc as $key => $val) {
		if ($_SESSION['login'] == $key && !$val) {
			$bread = array(
				$pgmAcronym . " Home" => $webFront,
				"Access Denied" => ""
			);
			echo '<div class="jumbotron"><div class="container"><h1>Access Denied</h1><p>You are not authorized to view this page, as you are current logged in as a <b>' . $_SESSION['login'] . '</b>. To access this page you must logout and use the appropriate password. If you believe this is an error, please <a href="mailto:' . $email_to[$db_key] . '">contact us</a> if the issue persists.</p>
			<a href="javascript:window.history.back()" class="btn btn-primary btn-md" href="" role="button">Return to previous page</a></div></div><div class="container">';
			include (getFooterPath());
			exit;
		}
	}
}

if ($_SESSION['login'] == ""):

 ?>

    <div class="jumbotron">
      <div class="container">
        <h1>Enter Password</h1>
    	<p>Please enter the password that was provided to you to proceed to this page.</p>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>

<div class="container">
    
    
<div class="row">
	<div class="col-md-6 col-md-offset-1">
		<div class="panel panel-default">
  			<div class="panel-heading">
  				<h3 class="panel-title">Sign in</h3>
  			</div>
  			<div class="panel-body" style="padding:30px;">
   				<form role="form" class="form-horizontal" method="post">
   
  					<div class="form-group">
  						<div class="col-sm-9">
    					<label for="password">Password <a href="mailto:<?php echo $email_to[$db_key]; ?>">(forgot password)</a></label>
    					</div>
    					<div class="col-sm-9">
    					<input type="password" class="form-control" id="password" name="password" placeholder="Password">
    					</div>
  					</div>
  					
  					<div class="form-group">
  						<div class="col-sm-9">
  						<button type="submit" class="btn btn btn-primary">Sign in</button>
  						</div>
  					</div>
  
				</form>
  			</div>
		</div>
	</div>
</div>


<?php
	include(getFooterPath());
	exit();
	endif;
?>