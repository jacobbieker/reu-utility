<?php 
/*
 * The the url of the container image.
 * (Field name provided by $_GET['url']
 */

// Include the FileMaker API
require_once 'FileMaker.php'; 
include ('databases.php');

// Check that we have an url in the query string 
if (isset($_GET['url'])){ 

    // Put the url in a variable 
    $url = $_GET['url']; 
   
    // Search for the extension of the file 
    $url = substr($url, 0, strpos($url, "?")); 
    $url = substr($url, strrpos($url, ".") + 1); 
   
    // Send the correct Content-Type header 
    if($url == "jpg"){ 
        header('Content-type: image/jpeg'); 
    } else if($url == "gif"){ 
        header('Content-type: image/gif'); 
    } else{ 
        header('Content-type: application/octet-stream'); 
    } 
   
    // Show the contents of the container field
    echo $fm->getContainerData($_GET['url']); 

} 
    
?>