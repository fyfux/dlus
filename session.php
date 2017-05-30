<!-- PARTLY FROM https://www.tutorialspoint.com/ WITH login.php -->
<?php

   include('config.php');
   define('_INDEX', 1); //IZLABOT
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select first_name, user_role, user_id from user where hansa_id = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $userthings = 'user_id';
   $login_session = $row['first_name'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
   $permissions = $row["user_role"];
   $my_staff = $row["user_id"];

?>



<!--SQL CALLS -->

<?php

   $sql = ("SELECT project_number, description, status, status_description FROM project JOIN status WHERE status.status_id=project.status ORDER BY project_id DESC LIMIT 5");
   $result = $db->query($sql);
	
	
	$sql1 = ("SELECT hansa_id, first_name, last_name, email, role_description FROM user join user_role on user.user_role = user_role.role_id ORDER BY user_id DESC LIMIT 3") ; 
	$result1 = $db->query($sql1);


   $sql2 = ("SELECT hansa_id, first_name, last_name, email, role_description FROM user
       WHERE hansa_id = $user_check"); 
   $result2 = mysqli_query($db, $sql2);

   $selectuserrole=("SELECT user_id FROM user WHERE hansa_id = '$user_check'") ; 
   $resultuserrole = $db->query($selectuserrole);
   $userrid = $row['user_id'];


?>