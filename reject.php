<!-- REJECT -->
<?php
  	include('session.php');


  	$record_id = "";
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
  	$record_id = test_input($_GET["record_id"]);

		
		//Check user permissions (PM)
		if ($permissions == 4) {
	   	$pm = 2;
	   	$mg = 0; // IF PM rejects by MG already approved record, MG is reset
	   	$pmupdate=mysqli_query($db,"update record set PM='$pm', MG='$mg' WHERE record_id='$record_id'");
	   	}
		if($pmupdate)
		{
			header('location:records.php');
		}

		//Check user permissions (MG)
		if ($permissions == 3) {
	   	$mg = 2;
	   	$mgupdate=mysqli_query($db,"update record set MG='$mg' WHERE record_id='$record_id'");
	   	}
		if($mgupdate)
		{
		header('location:records.php');
		}
		else echo "ERROR";
	}

?>



