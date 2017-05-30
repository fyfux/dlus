<?php
	include('config.php');
	
	if(isset($_GET['user_id']))
	{
	$user_id = mysqli_real_escape_string($db,$_GET['user_id']);
		$user_id = stripslashes($user_id);
		//$user_id=$_GET['user_id'];
		$query1=mysqli_query($db,"delete from user where user_id='$user_id'");
		if($query1)
		{
		header('location:users.php');
		}
	}
	?>