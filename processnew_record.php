<!-- PROCESS NEW RECORD -->
<?php
include 'session.php'; 

// create a variable
$huser_id=$_SESSION['login_user'];
$week_no=$_POST['week_no'];
$mon=$_POST['mon'];
$tue=$_POST['tue'];
$wed=$_POST['wed'];
$thu=$_POST['thu'];
$fri=$_POST['fri'];
$sat=$_POST['sat'];
$sun=$_POST['sun'];
$hproject_number=$_POST['hproject_number'];
$hproject_manager=$_POST['hproject_manager'];
$sum=$mon+$tue+$wed+$thu+$fri+$sat+$sun;

 
//Execute the query
 
$insert = mysqli_query($db, "INSERT INTO record(huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager)
				VALUES('$huser_id', '$week_no', '$mon', '$tue', '$wed', '$thu', '$fri', '$sat', '$sun', '$sum', '$hproject_number','$hproject_manager')");
echo $_SESSION['login_user'];
echo $huser_id;
echo $week_no;
echo $mon;
echo $tue;
echo $wed;
echo $thu;
echo $fri;
echo $sat;
echo $sun;
echo $hproject_number;
echo $hproject_manager;
echo $sum;
	if (!empty($week_no) && !empty($hproject_number) && !empty($hproject_manager)) {
	
	if($insert) {

  		//$_SESSION['message'] = 'Success!';
  		header("Location: records.php");
}
    }
    else {
 
  	//$_SESSION['message'] = 'Error!';
  	header("Location: new_record.php");
        
    }

    // close the connection to the server
    mysqli_close($db);	