<?php
/* 
 * Login Page which starts a session as
 * a student, professor, or mentor and 
 * provides access to these pages based on
 * their permissions.
 */

	require('hash.php');
	include ('../layout/header.php');
	require_once ('FileMaker.php');
	include_once ('../databases.php');
	$db_key = "application";

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login'] = false;
}
if (isset($_POST['password'])) {
	$record = $fm->getRecordById('Setup', 1);
	$password = $_POST['password'];

	$hasher = new PasswordHash(8, false);
	if (strlen($password) > 72) { die("Password must be 72 characters or less"); }
	$stored_hash = "*";
		//if ($pwAcc['faculty']) {
			$stored_hash = $record->getField('facultyPWHash');
			$check = $hasher->CheckPassword($password, $stored_hash);
		//}
/*		if ($pwAcc['mentors']) {
			$stored_hash = $record->getField('mentorPWHash');
			$check = $hasher->CheckPassword($password, $stored_hash);
		}
		if ($pwAcc['students']) {
			$stored_hash = $record->getField('studentPWHash');
			$check = $hasher->CheckPassword($password, $stored_hash);
		}*/
	
    if ($check) {
        $_SESSION['login'] = true;
    } else {
        echo '<div class="jumbotron"><div class="container"><h1>Incorrect Password</h1><p>There was an issue with the password you entered, or you are not authorized to view this page. If you believe this is an error, please <a href="mailto:' . $email_to[$db_key] . '">contact us</a> if the issue persists.</p>
        <a class="btn btn-primary btn-md" href="" role="button">Return to the login page</a></div></div>';
        exit;
        
    }
    
}
// Footer Breadcrumbs
$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Login" => "",
);

if (!$_SESSION['login']):
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
	include "../layout/footer.php";
	exit();
	endif;
?>