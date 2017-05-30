<!--APPROVE FOR MG AND PM-->
<?php
	include('session.php');

	if(isset($_GET['record_id']))
	{
		// For Security reasons
		$record_id = mysqli_real_escape_string($db, $_GET['record_id']);
		$record_id = stripslashes($record_id);
		//Check user permissions (PM)
		if ($permissions == 4) {
			$pm = 1; 
			$pmupdate=mysqli_query($db,"update record set PM='$pm' WHERE record_id='$record_id'");
		}
		if($pmupdate)
		{
			header('location:records.php');
		}

		//Check user permissions (MG)
		if ($permissions == 3) {
			$mg = 1;
			$mgupdate=mysqli_query($db,"update record set MG='$mg' WHERE record_id='$record_id'");
		}
		if($mgupdate)
		{
			header('location:records.php');
		}
		else echo "ERROR";
	}
?>



