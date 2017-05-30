<?php
  
  require('config.db.inc.php');

  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD, DB_DATABASE)
    or die('Could not connect: ' . mysql_error());
  
   
    /*$db = mysqli_select_db($link, DB_DATABASE) or die('Could not select database');

    $db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);} 
	
	
    $link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD) or die('Could not connect: ' . mysql_error());
    $db = mysqli_select_db($link,DB_DATABASE) or die('Could not select database');*/
    
?>


