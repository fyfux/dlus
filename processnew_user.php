<!-- PROCESS NEW USER -->
<?php
include 'config.php'; 

//code from w3schools
// define variables and set to empty values
$hansa_id = $email = $first_name = $last_name = $user_role = "";
$p="SELECT hansa_id from user";
$pr = mysqli_query($db,$p);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $hansa_id = test_input($_POST["hansa_id"]);
  $email = test_input($_POST["email"]);
  $first_name = test_input($_POST["first_name"]);
  $last_name = test_input($_POST["last_name"]);
  $user_role = test_input($_POST["user_role"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


/*
// create a variable
$hansa_id=$_POST['hansa_id'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$user_role=$_POST['user_role'];*/

//Execute the query
 
if ($hansa_id != $row['$pr']) {

	$insert = mysqli_query($db, "INSERT INTO user (hansa_id, first_name, last_name, email, user_role)
				VALUES('$hansa_id', '$first_name','$last_name','$email', '$user_role')");
	
	if($insert) {

  		//$_SESSION['message'] = 'Success!';
  		header("Location: users.php");
}
    }
    else {

  	header("Location: new_user.php");
        
    }

    // close the connection to the server
    mysqli_close($db);	


