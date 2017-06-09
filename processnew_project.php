<!-- PROCESS NEW USER -->


<?php
include 'config.php'; 

// define variables and set to empty values
$project_number = $description = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $project_number = test_input($_POST["project_number"]);
  $description = test_input($_POST["description"]);



$projectcheck = mysqli_query($db,"SELECT project_number FROM project WHERE project_number = '$project_number'");


if ($projectcheck > 0) {
   //echo "User id exists already.";
    header("Location: new_project.php");
}

//Execute the query
if (!empty($project_number) && !empty($description)) {
$insert = mysqli_query($db, "INSERT INTO project(project_number, description)
				VALUES('$project_number', '$description')");
	//make sure, that project number field is not empty
			
	if($insert) {
  	
  		header("Location: projects.php");
    }

    }

}
    // close the connection to the server
    mysqli_close($db);
