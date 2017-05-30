<!--DELETE PROJECT-->
<?php

include('config.php');

if(isset($_GET['project_id']))
{
	$project_id = mysqli_real_escape_string($db,$_GET['project_id']);
    $project_id = stripslashes($project_id);
      
	//$project_id=$_GET['project_id'];
	$query1=mysqli_query($db,"delete from project where project_id='$project_id'");
	if($query1)
	{
	header('location:projects.php');
	}
}
?>