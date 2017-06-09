<!-- PROCESS NEW USER -->


<?php
include 'config.php'; 

//code from w3schools
// define variables and set to empty values
$hansa_id = $email = $first_name = $last_name = $user_role = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $hansa_id = test_input($_POST["hansa_id"]);
  $email = test_input($_POST["email"]);
  $first_name = test_input($_POST["first_name"]);
  $last_name = test_input($_POST["last_name"]);
  $user_role = test_input($_POST["user_role"]);
}

$pr = mysqli_query($db,"SELECT hansa_id from user");


//Execute the query
if ($pr > 0) {

    header("Location: new_user.php");
}
if ($hansa_id != $row['$pr']) {

	$insert = mysqli_query($db, "INSERT INTO user (hansa_id, first_name, last_name, email, user_role)
				VALUES('$hansa_id', '$first_name','$last_name','$email', '$user_role')");
	
	if($insert) {

  		//$_SESSION['message'] = 'Success!';
  		header("Location: users.php");
}
    }
   
    // close the connection to the server
    mysqli_close($db);	


