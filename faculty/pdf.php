<?php
/* 
 * Displays the student's info pdf.
 */

require ('../pw/login.php');
require ('../databases.php');


if(!empty( $_GET['name'])){
	$f = $_GET['name'];
	$pdf = $webFront . $f .'.pdf'; // CHANGE THIS LATER.
	$filename = $f . '.pdf'; /* Note: Always use .pdf at the end. */

	header('Content-Transfer-Encoding: binary');
	
	  header( 'Cache-Control: public' );
      header( 'Content-Description: File Transfer' );
      header( "Content-Disposition: inline; filename='". $f . ".pdf'" );
	  header('Content-type: application/pdf');
      header( 'Content-Transfer-Encoding: binary' );
	
	//header('Content-Length: ' . filesize($pdf));
	//header('Accept-Ranges: bytes');

	readfile($pdf);
}


die( "ERROR: You do not have permission to view this file." );
?>