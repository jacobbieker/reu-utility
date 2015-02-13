
<?php 

// Include the FileMaker API
include ('../databases.php');
$pwAcc = getPermissions('applicantReview');
require ('../pw/login.php');
include "../layout/header.php";

if (isset($_GET['recid'])){ 
	$student = $fm->getRecordById($db_layout[$db_key], $_GET['recid']);

	$url =  $webFront . "faculty/getPDF.php?-url=" . urlencode($student->getField('PDF'));

	echo "<object data='" . $url . "' type='application/pdf' width='100%' height='100%'>
 
  	<p>It appears you don't have a PDF plugin for this browser.
 	 No biggie... you can <a href='myfile.pdf'>click here to
  	download the PDF file.</a></p>
  
	</object>";
}

?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?php echo $webFront; ?>layout/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $webFront ?>layout/js/display.js"></script>

  </body>
  
<style>
html, body{
   height: 100%;
   min-height: 100%;
   margin-bottom: 0px;
   padding-bottom: 0px;
}


object {
	display: block;
}


</style>

</html>