<!--EDIT PROFILE-->


<!--POST DROŠĪBA-->


<!--<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
 	
 	<script type="text/javascript">  
  
     $(document) .ready(function(){
     	$(".open").click(function(){
     		$('.pop-outer').fadeIn('slow');
     	});
     	$(".close").click(function(){
     		$('.pop-outer').fadeOut('slow');
     	});
     });
          
    </script>  -->

<?php
   $title = 'Edit Profile';
   include('include/parts/header.php');


if(isset($_GET['user_id']))
{
$user_id = mysqli_real_escape_string($db,$_GET['user_id']);
$user_id = stripslashes($user_id);
//$user_id=$_GET['user_id'];
			//UPDATE INFO
			if(isset($_POST['submit']))
			{
			$first_name=$_POST['first_name'];
			$last_name=$_POST['last_name'];
			$email=$_POST['email'];
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
$pass1=$_POST['pass1'];
$pass2=$_POST['pass2'];

if ($pass1!= NULL && $pass1 == $pass2) {
	$pass1=md5($pass1);
	$querypass=mysqli_query($db,"update user set password='$pass1' where user_id='$user_id'");
	header('location:profile.php');}
elseif ($pass1==NULL) {
 	echo "ERROR: Please Insert Value";
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


<!--
    <style type="text/css">  
 		.pop-outer{
 			background-color: rgba(0,0,0,0.5);
 			position: fixed;
 			top: 0;
 			left: 0;
 			width: 100%;
 			height: 100%;

 		}
 		.pop-inner
 			{
 				background-color: #fff;
 				width: 500px;
 				height: 300px;
 				padding: 25px;
 				margin: 15% auto;
 			}
    </style> 
<button class="open">Click to open password change</button>
	<div style="display: none;" class="pop-outer">
	<div class="pop-inner">
		<button class="close">X</button>-->

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

 