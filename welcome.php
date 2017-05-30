<!--WELCOME-->
<?php
	
	$title = 'Welcome ';
	
   
 
   	include('include/parts/header.php');
	
?>


<?php include('last_records.php'); ?>



<?php if ($permissions != 5 )
	include('last_projects.php'); ?>



<?php if ($permissions <3 ) {
	include('last_users.php'); }?>





<?php include('include/parts/footer.php'); ?>









