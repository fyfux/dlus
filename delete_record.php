<!--DELETE RECORD-->
<?php
	include('config.php');
	
	if(isset($_GET['record_id']))
	{
		$record_id = mysqli_real_escape_string($db,$_GET['record_id']);
		$record_id = stripslashes($record_id);
		//$record_id=$_GET['record_id'];
		
		$query1=mysqli_query($db,"delete from record where record_id='$record_id'");

		if($query1)
		{
		header('location:records.php');
		}
	}
?>