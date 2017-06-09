<!--DELETE USER-->
<?php

	include('session.php');

	$user_id =""; 
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$user_id = test_input($_GET["user_id"]);

	$query1=mysqli_query($db,"delete from user where user_id='$user_id'");
		if($query1)
		{
		header('location:users.php');
		}
	}
	?>