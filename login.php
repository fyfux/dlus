<!-- BASICS OF CODE AVAILABLE AT https://www.tutorialspoint.com/-->
<?php
   define('_INDEX', 1);
   session_start();

   require 'config.php';

   $userrole = "";


   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      // To protect MySQL injection for Security purpose

      $myusername = stripslashes($myusername);
      $mypassword = stripslashes($mypassword);
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

      $mypassword = md5($mypassword);


   
      $sql1 = "SELECT active FROM user WHERE hansa_id = '$myusername'";
      $result1 = mysqli_query($db,$sql1);
      $row = mysqli_fetch_array($result1);
      $active = $row['active'];
      $count1 = mysqli_num_rows($result1);

      $sql = "SELECT user_id, user_role FROM user WHERE hansa_id = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      //$active = $row['active'];

      $count = mysqli_num_rows($result);
            
      //NOT WORKING, USER REGISTRATION IF ACTIVE IS 0
      if ($count1 = 1 && $active == 0) {
         header("location: set_password.php?user_id=$myusername");
      }

      elseif ($count != 1){
         echo "<p style='color:red; padding-top:30px; align: center'>Your Login Name or Password is invalid</p>";
   
      }

      //USER IS CLOSED
      elseif($count == 1 && $active != 2) {
          $_SESSION['login_user'] = $myusername;
          
          $userrole = $row['user_id'];
         {
         header("location: welcome.php");
         }

                  
      } /*else {

         $error = "ERROR: User account is closed. Please contact your Administratror!";
         echo  "<p style='color:red;'>".($error)."</p>";
      }*/
   }
?>
 


  
      <div align = "center">
         <div style = "width:300px; margin-top:100px; margin-bottom: 20px; border: solid 1px #d52b1e; " align = "left">
            <div style = "background-color:#d52b1e; color:#FFFFFF; padding:3px;"><b>Login</b></div>
        
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><br><input type = "text" name = "username" class = "box" required/><br><br>
                  <label>Password  :</label><br><input type = "password" name = "password" class = "box" /><br><br>
                  <input type = "submit" value = " Submit "/><br>
               </form>
               
 
          
            </div>
        
         </div>
      
      </div>


