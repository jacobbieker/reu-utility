<?php

include ('../databases.php');
$pwAcc = getPermissions('applicantReview');

// Check that we have an url in the query string 
if (isset($_GET['-url'])){ 

	$con = $fm->getContainerData($_GET['-url']);
	file_put_contents('applicant.pdf', $con);


	header('Content-Transfer-Encoding: binary');
	header( 'Cache-Control: public' );
	header( 'Content-Description: File Transfer' );
	header( "Content-Disposition: inline; filename='applicant.pdf'" );
	header('Content-type: application/pdf');
	header( 'Content-Transfer-Encoding: binary' );



    // Show the contents of the container field
    echo $con; 

} 

?>