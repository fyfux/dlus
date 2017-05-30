<!-- SET PASSWORD-->
<!--THIS FILE IS CALLED IF $username is valid, but $active ==0-->

<?php 
	include('config.php');

if(isset($_GET['user_id']))
	{
	$user_id=$_GET['user_id'];
	if(isset($_POST['submit']))
		{
		
		$pass1 = mysqli_real_escape_string($db,$_POST['pass1']);
		$pass2 = mysqli_real_escape_string($db,$_POST['pass2']);
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];

		if ($pass1 != NULL && $pass1 == $pass2)
			{
			$active=1;
			$pass1=md5($pass1);
			$sql= "UPDATE user SET password='$pass1', active='$active' WHERE hansa_id='$user_id'";
			$result=mysqli_query($db,$sql);

			if($result)
				{
				header('location:index.php');
				}} 
			else {
				echo "ERROR: Passwords Should be the same";
			}
	}}

?>


<h2>Please choose your password!</h2>
<form method="post" action="">

<label>Password</label>
<input type="password" name="pass1" required />
<br>
<label>Confirm Password</label>
<input type="password" name="pass2" required/>
<br>


<input type="submit" name="submit" value="Save Password" />



</form>
