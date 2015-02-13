<?php
	include ('../databases.php');
	include "../layout/header.php";
	$_SESSION['login'] = "";
	

$bread = array(
    $pgmAcronym . " Home" => $webFront,
    "Logout" => "",
);
?>

    <div class="jumbotron">
      <div class="container">
        <h1>Logout Successful</h1>
    	<p>Thank you for logging out. To start a new session you will need to login again.</p>
    	<a class="btn btn-primary btn-md" href="<?php echo $webFront; ?>" role="button">Return to the home page</a>
        <!--<p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>-->
      </div>
    </div>
    
  <div class="container">

<?php include "../layout/footer.php"; ?>