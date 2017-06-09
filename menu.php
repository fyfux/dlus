<!--MENU FROM BOOTSTRAP-->
<link rel="stylesheet" type="text/css" href="include/css/style.css">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "welcome.php")?"active":""; ?>" href="welcome.php">Home</a></li>

        <li><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "records.php")?"active":""; ?>" href="records.php">Records</a></li>
        
        <!--REPORTS-->
        <?php if ($permissions != 1):?>
          <li><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "reports.php")?"active":""; ?>" href="reports.php">Reports</a></li>
        <?php endif; ?>
        
        <!--PROJECT MENU-->
        <?php if ($permissions < 5):?>
          <li><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "projects.php")?"active":""; ?>" href="projects.php">Projects</a></li>            
        <?php endif; ?>
        
        <!--USERS-->
        <?php if ($permissions < 3):?>
          <li><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "users.php")?"active":""; ?>" href="users.php">Users</a></li>    
        <?php endif; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a class="<?php echo (basename($_SERVER['PHP_SELF']) == "profile.php")?"active":""; ?>" href="profile.php">Profile</a></li>
        <li><a href = "include/logout.php"><span class="glyphicon glyphicon-log-out"></span> </a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

