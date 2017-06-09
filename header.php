<!--HEADER-->
<?php  
// no direct access
//defined( '_INDEX' ) or die( 'Restricted access' );

	include 'include/parts/head.php';
	include '/session.php';
defined( '_INDEX' ) or die( 'Restricted access' );
?>

<div id="header">
	<img src="include/images/logo.png">
	<h2 class="active_user" style="float: right; margin-right: 30px; padding-top: 15px;"><?php echo $login_session; ?></h2>
	<!-- Active user Name-->
	
</div>

<?php include 'include/parts/menu.php';?>

