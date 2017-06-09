<!--DELETE RECORD-->
<?php

	include('session.php');

	$record_id =""; 
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$record_id = test_input($_GET["record_id"]);

		
	$query1=mysqli_query($db,"delete from record where record_id='$record_id'");

	if($query1)
		{
		header('location:records.php');
		}
	}
?>