<!--EDIT RECORD-->

<!--POST DROŠĪBA-->
<?php

   $title = 'Edit Record';

   include('include/parts/header.php');

  //FOR DRODOWN MENUS
  $role = "SELECT status_id, status_description FROM status";
  $resultrole = mysqli_query($db, $role);

   $project = "SELECT project_id, project_number, description FROM project where status = 1 ORDER BY project_number";
   $resultproject = mysqli_query($db, $project);
   $manager = "SELECT user_id, hansa_id, first_name, last_name FROM user where user_role = 4 ORDER BY first_name";
   $resultmanager = mysqli_query($db, $manager);

  if(isset($_GET['record_id']))
  {
    $record_id = mysqli_real_escape_string($db,$_GET['record_id']);
    $record_id = stripslashes($record_id);
    //$record_id=$_GET['record_id'];
      if(isset($_POST['submit']))
        {
        $week=$_POST['week'];
        $mon=$_POST['mon'];
        $tue=$_POST['tue'];
        $wed=$_POST['wed'];
        $thu=$_POST['thu'];
        $fri=$_POST['fri'];
        $sat=$_POST['sat'];
        $sun=$_POST['sun'];
        $hproject_number=$_POST['hproject_number'];
        $hproject_manager=$_POST['hproject_manager'];
        $sum=$mon+$tue+$wed+$thu+$fri+$sat+$sun;
        $pm=0;
        $mg=0;

      $query3=mysqli_query($db,"update record set week='$week', mon='$mon', tue='$tue', wed='$wed', thu='$thu', fri='$fri', sat='$sat', sun='$sun', sum='$sum', hproject_number='$hproject_number', hproject_manager='$hproject_manager', PM='$pm', MG='$mg' where record_id='$record_id'");


      if($query3)
      {
      header('location:records.php');
      }
      }

      //DEFAULT INFORMATION FOR FIELDS
      $query1=mysqli_query($db,"select * from record where record_id='$record_id'");
      $query2=mysqli_fetch_array($query1);}
      ?>


<form method="post" action="">

<label>Week</label>
<select name="week">
  <?php for ($i = 1; $i <= 52; $i++) { ?> 
<option value="<?php echo $i; ?>" <?php if ($i == date('W')) { echo 'selected="selected"';} ?>><?php echo $i; ?></option> 
	<?php } ?> 
</select><br>

<label>Mon</label>
<input type="number" min="0" step="0.5" name="mon" value="<?php echo $query2['mon']; ?>" />
<br>
<label>Tue</label>
<input type="number" min="0" step="0.5" name="tue" value="<?php echo $query2['tue']; ?>" />
<br>
<label>Wed</label>
<input type="number" min="0" step="0.5" name="wed" value="<?php echo $query2['wed']; ?>" />
<br>
<label>Thu</label>
<input type="number" min="0" step="0.5" name="thu" value="<?php echo $query2['thu']; ?>" />
<br>
<label>Fri</label>
<input type="number" min="0" step="0.5" name="fri" value="<?php echo $query2['fri']; ?>" />
<br>
<label>Sat</label>
<input type="number" min="0" step="0.5" name="sat" value="<?php echo $query2['sat']; ?>" />
<br>
<label>Sun</label>
<input type="number" min="0" step="0.5" name="sun" value="<?php echo $query2['sun']; ?>" />
<br>



<label>Project Number</label>
<!-- Dropdown selection for user role -->
<select name="hproject_number">
  <?php 
  while ($row = $resultproject->fetch_assoc()) {
      echo "<option value='" . $row['project_id'] ."'>" . $row['project_number'] ."</option>";
      print_r($row);
  }
  ?>
</select><br>

<label>Project Manager</label>
<!-- Dropdown selection for user role -->
<select name="hproject_manager">
  <?php 
  while ($row = $resultmanager->fetch_assoc()) {
      echo "<option value='" . $row['user_id'] ."'>" . $row['first_name'] . " " . $row['last_name'] ."</option>";
      print_r($row);
  }
  ?>
</select>


<br>
<input type="submit" name="submit" value="Update" />
<a href="records.php" class="cancel">Cancel</a>



</form>
