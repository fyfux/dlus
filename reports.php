<!--REPORTS-->
<?php

   $title = 'Report';
   include('include/parts/header.php');

   //FOR DROPDOWN MENUS
   $project = "SELECT project_id, project_number, description FROM project where status = 1 ORDER BY project_number";
   $resultproject = mysqli_query($db, $project);

   $manager = "SELECT user_id, hansa_id, first_name, last_name FROM user where user_role = 4 ORDER BY first_name";
   $resultmanager = mysqli_query($db, $manager);

   $inst = "SELECT user_id, hansa_id, first_name, last_name FROM user where user_role = 5 ORDER BY first_name";
   $resultinst = mysqli_query($db, $inst);

?>

<div>
<form class="report" method="post" name="" action="reports.php">
  
 <!--<label for="month">Month</label>
  <select name="month"> 
							<?php 
							/*echo '<option value=""></option>';
							for ($i = 1; $i <= 12; $i++) { ?> 
							<option value="<?php echo $i; ?>" <?php if ($i == date(' ')) { echo 'selected="selected"';} ?>><?php echo $i; ?></option> 
							<?php }*/ ?> 
						</select>-->

    <!--WEEK-->
    <label for="month">Week</label>
    <select name="week_no"> 
              <?php 
              echo '<option value=""></option>';
              for ($i = 1; $i <= 52; $i++) { ?> 
              <option value="<?php echo $i; ?>" <?php if ($i == date('')) { echo 'selected="selected"';} ?>><?php echo $i; ?></option> 
              <?php } ?> 
            </select><br>

    <!--PROJECT NUMBER-->
    <label for="project_number">Project Number</label>
      <select name="project_number">
    					<?php 
    					echo '<option value=""></option>';
    					while ($row = $resultproject->fetch_assoc()) {
    					echo "<option value='" . $row['project_id'] .  "'>" . $row['project_number'] . " - " . $row['description'] ."</option>";

    					print_r($row);
    					}
    					?>
    					</select><br>

    <!--PROJECT MANAGER-->
    <?php if ($permissions!=4): ?>
    <label for="project_manager">Project Manager</label>
    					<!-- Dropdown selection for user role -->
    					<select name="project_manager">
    					<?php 
    					echo '<option value=""></option>';
    					while ($row = $resultmanager->fetch_assoc()) {
    					echo "<option value='" . $row['user_id'] .  "'>" . $row['first_name'] . " " . $row['last_name'] ."</option>";

    					print_r($row);
    					}
    					?></select><br>
    <?php endif ?>
    <?php if ($permissions!=5): ?>
	
    <!--INSTALLER-->
    <label for="installer">Installer</label>
    					<!-- Dropdown selection for user role -->
    					<select name="installer">
    					<?php 
    					echo '<option value=""></option>';
    					while ($row = $resultinst->fetch_assoc()) {
    					echo "<option value='" . $row['hansa_id'] .  "'>" . $row['first_name'] . " " . $row['last_name'] ."</option>";

    					print_r($row);
    					}
    					?></select>
    <?php endif ?>
</div>

  <input type="submit" name="search" value="<?php echo "Calculate"; ?>" />
  </form>
  <button>Export to Excel</button><!--ADD FUNCTION-->
<?php 


if (isset($_POST['search']))
{
  //$month = $_POST ['month'];
  $week_no = $_POST ['week_no'];
  $project_number = $_POST ['project_number'];
  if ($permissions!=4){
  $project_manager = $_POST ['project_manager'];}
  if ($permissions!=5){
  $installer = $_POST ['installer'];}
?>
  

<div>

	<table>

    <caption>Records</caption>
        
      <thead>
        <?php if ($permissions != 5):?><th>Author</th><?php endif; ?>
        <th>Week</th>
        <th id="days">Mon</th>
        <th id="days">Tue</th>
        <th id="days">Wed</th>
        <th id="days">Thu</th>
        <th id="days">Fri</th>
        <th id="days">Sat</th>
        <th id="days">Sun</th>
        <th id="extra">Sum</th>
        <th>Project Number</th>
        <?php if ($permissions != 4):?>
            <th>Manager</th>
        <?php endif; ?>
    </thead>

<?php  
      
      //ACCOUNTING REPORT
      if ($permissions < 4) {
      $q="SELECT * FROM record";
      if ($week_no!="") {
          $q .=" WHERE week = '$week_no'";}
      if ($project_number!="") {
        	$q .=" WHERE hproject_number = '$project_number'";}
      if ($project_manager!=""){
      	$q .=" WHERE hproject_manager = '$project_manager'";}
      if ($installer!=""){
      	$q .=" WHERE huser_id = '$installer'";}
      $search = mysqli_query($db,$q);
      }

      //PERSON REPORT
      if ($permissions == 5) {

      $q="SELECT * FROM record WHERE huser_id = '$user_check'";

      if ($week_no!="") {
          $q .=" and week = '$week_no'";}

      if ($project_number!="") {
          $q .=" and hproject_number = '$project_number'";}

      if ($project_manager!=""){
        $q .=" and hproject_manager = '$project_manager'";}
    $search = mysqli_query($db,$q);
      }

      //PROJECT REPORT
      if ($permissions == 4) {

      $q="SELECT * FROM record WHERE hproject_manager = '$userrid'";

      if ($week_no!="") {
          $q .=" and week = '$week_no'";}

      if ($project_number!="") {
          $q .=" and hproject_number = '$project_number'";}

      if ($installer!=""){
          $q .=" and huser_id = '$installer'";}
                 
      $search = mysqli_query($db,$q);
      }

 ?>

		<tbody>
            <?php if ($search->num_rows > 0) {
                while( $row = $search->fetch_assoc()):?>
                    <tr>
                    <?php if ($permissions!=5): ?>
                    <td>
                                      
                    <?php echo $row["huser_id"]; ?></td>
                    <?php endif ?>
                        <td><?php echo $row["week"]; ?></td>
                        <td id="days"><?php echo $row["mon"]; ?></td>
                        <td id="days"><?php echo $row["tue"]; ?></td>
                        <td id="days"><?php echo $row["wed"]; ?></td>
                        <td id="days"><?php echo $row["thu"]; ?></td>
                        <td id="days"><?php echo $row["fri"]; ?></td>
                        <td id="days"><?php echo $row["sat"]; ?></td>
                        <td id="days"><?php echo $row["sun"]; ?></td>
                        <td id="extra"><?php echo $row["sum"]; ?></td>
                        <td><?php echo $row["hproject_number"]; ?></td>
                        <td><?php echo $row["hproject_manager"]; ?></td>
                        
                <?php endwhile;       
            } //if ($resultInst->num_rows > 0) ends
            else {
                echo "0 results";
            }
            $db->close();
            ?>
        </tbody>


<?php


 	


}



?>

