<!-- PROCESS NEW USER -->
<?php
include 'config.php'; 

// create a variable
$project_number=$_POST['project_number'];
$description=$_POST['description'];

 
//Execute the query
if (!empty($project_number) && !empty($description)) {
$insert = mysqli_query($db, "INSERT INTO project(project_number, description)
				VALUES('$project_number', '$description')");
	//make sure, that project number field is not empty
	

		
	if($insert) {
  	
  		header("Location: projects.php");
    }
    }
    else {
 

  	header("Location: new_project.php");
        
    }

    // close the connection to the server
    mysqli_close($db);
