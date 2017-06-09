<!-- PARTLY FROM https://www.tutorialspoint.com/ WITH login.php -->
<?php

   include('config.php');
   define('_INDEX', 1); //IZLABOT
   session_start();
   

   $selectuserrole=("SELECT user_id FROM user WHERE hansa_id = '$user_check'") ; 
   $resultuserrole = $db->query($selectuserrole);
   $userrid = $row['user_id'];
    
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



