<!--DELETE PROJECT-->
<?php

include('session.php');

$project_id =""; 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $project_id = test_input($_GET["project_id"]);

	$query1=mysqli_query($db,"delete from project where project_id='$project_id'");
	if($query1)
	{
	header('location:projects.php');
	}
}
?>