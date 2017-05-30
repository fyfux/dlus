<!--EDIT PROJECT-->

<!--POST DROŠĪBA-->

<?php

   $title = 'Edit Project';

   include('include/parts/header.php');


	$role = "SELECT status_id, status_description FROM status";
	$resultrole = mysqli_query($db, $role);

	if(isset($_GET['project_id']))
	{
	$project_id = mysqli_real_escape_string($db,$_GET['project_id']);
	$project_id = stripslashes($project_id);
	//$project_id=$_GET['project_id'];

	if(isset($_POST['submit']))
	{
	$project_number=$_POST['project_number'];
	$description=$_POST['description'];
	$status=$_POST['status'];
	$query3=mysqli_query($db,"update project set project_number='$project_number', description='$description', status='$status' where project_id='$project_id'");

	if($query3)
	{
	header('location:projects.php');
	}
	else{
		//NESTRĀDĀ
	  echo "ERROR: This Project Number already is registered!";
	}
	}
	//DEFAULT INFORMATION FOR FIELDS
	$query1=mysqli_query($db,"select * from project where project_id='$project_id'");
	$query2=mysqli_fetch_array($query1);}
	?>


	<form method="post" action="">
	<label>Project Number</label>
	<input type="text" name="project_number" value="<?php echo $query2['project_number']; ?>" required/>
	<br>
	<label>Description</label>
	<input type="text" name="description" value="<?php echo $query2['description']; ?>" required/>
	<br>

	<label>Status</label>
	<!-- Dropdown selection for user role -->
	<select name="status">
		  <?php 
		  while ($row = $resultrole->fetch_assoc()) {
		      echo "<option value='" . $row['status_id'] ."'>" . $row['status_description'] ."</option>";
		      print_r($row);
		  }
		  ?>
	</select>



	<br>
	<input type="submit" name="submit" value="Update" />
	<a href="projects.php" class="cancel">Cancel</a>


	</form>
