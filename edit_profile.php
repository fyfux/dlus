<!--EDIT PROFILE-->


<?php

   $title = 'Edit Profile';
   include('include/parts/header.php');

if(isset($_GET['user_id']))
{
$user_id = test_input($_GET["user_id"]);

			//UPDATE INFO
			if(isset($_POST['submit']))
			{
			$first_name = test_input($_POST["first_name"]);
			$last_name = test_input($_POST["last_name"]);
			$email = test_input($_POST["email"]);	

			$query3=mysqli_query($db,"update user set first_name='$first_name', last_name='$last_name', email='$email' where user_id='$user_id'");

			if($query3)
			{
			header('location:profile.php');
			}
			else{
				echo "Something went wrong";
			}
			}
//UPDATE PASSWORDS			
if(isset($_POST['submitpass']))
{
$pass1 = test_input($_POST["pass1"]);
$pass2 = test_input($_POST["pass2"]);	


if ($pass1!= NULL && $pass1 == $pass2) {
	$pass1=md5($pass1);
	$querypass=mysqli_query($db,"update user set password='$pass1' where user_id='$user_id'");
	header('location:profile.php');}
elseif ($pass1==NULL) {
 	echo '<p class="ERROR">ERROR: Please Insert Value</p>';
 } 
 else {echo "Both passwords must be the same";}


}
//DEFAULT INFORMATION FOR FIELDS
$query1=mysqli_query($db,"select * from user where user_id='$user_id'");
$query2=mysqli_fetch_array($query1);

}
?>

<!--CHANGE PROFILE INFO-->
<form method="post" action="">
<label>First Name</label>
<input type="text" name="first_name" required value="<?php echo $query2['first_name']; ?>" />
<br>
<label>Last Name</label>
<input type="text" name="last_name" required value="<?php echo $query2['last_name']; ?>" />
<br>
<label>Email</label>
<input type="text" name="email" required value="<?php echo $query2['email']; ?>" />
<br>
<input type="submit" name="submit" value="Update" />
</form>


		<!--CHANGE PASSWORD-->
		<form method="post" action=""> 
			<label>Password</label>
			<input type="password" minlength="6" name="pass1"/>
			<br>
			<label>Confirm Password</label>
			<input type="password" name="pass2"/>
			<br>
			<input type="submit" minlength="6" name="submitpass" value="Update Password" />
		</form>
	</div>
</div>

 