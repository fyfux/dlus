<!--EDIT USER-->


<?php

   $title = 'Edit User';
   include('include/parts/header.php');
   include('sql_calls.php');


if(isset($_GET['user_id']))
{
$user_id = test_input($_GET["user_id"]);

$hansa_id = $first_name = $last_name = $email = $user_role = $active = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $hansa_id = test_input($_POST["hansa_id"]);
  $first_name = test_input($_POST["first_name"]);
  $last_name = test_input($_POST["last_name"]);
  $email = test_input($_POST["email"]);
  $user_role = test_input($_POST["user_role"]);
  $active = test_input($_POST["active"]);


$query3=mysqli_query($db,"UPDATE user SET hansa_id='$hansa_id', first_name='$first_name', last_name='$last_name', email='$email',  user_role='$user_role', active='$active' WHERE user_id='$user_id'");

if($query3)
{
header('location:users.php');
}
else{
  echo "ERROR: this Hansa ID already is registered!";
}
}

$query1=mysqli_query($db,"SELECT * FROM user WHERE user_id='$user_id'");
$query2=mysqli_fetch_array($query1);}
?>



<form method="post" action="">
<label>Hansa ID</label>
<input type="text" name="hansa_id" value="<?php echo $query2['hansa_id']; ?>" required minlength="2" maxlength="5"/>
<br>
<label>First Name</label>
<input type="text" name="first_name" value="<?php echo $query2['first_name']; ?>"required/>
<br>
<label>Last Name</label>
<input type="text" name="last_name" value="<?php echo $query2['last_name']; ?>"required />
<br>
<label>Email</label>
<input type="text" name="email" value="<?php echo $query2['email']; ?>"required minlength="6" />
<br>

<label>User Role</label>
<!-- Dropdown selection for user role -->
<select name="user_role">
  <?php 

  while ($row = $resultrole->fetch_assoc()) {
      echo "<option value='" . $row['role_id'] ."'>" . $row['role_description'] ."</option>";
      print_r($row);
  }
  ?>
</select>
<br>
<label>Active</label>
<!-- Dropdown selection for user role -->
<select name="active">
  <?php 
  while ($row = $resultuser_status->fetch_assoc()) :
      echo "<option value='" . $row['active_id'] ."'>" . $row['active_description'] ."</option>";
      print_r($row);
  endwhile;
  ?>
</select>







<br>
<input type="submit" name="submit" value="Update" />
<a href="users.php" class="cancel">Cancel</a>



</form>
