<!-- NEW USER -->


<?php

  $title = 'New User';

  include('include/parts/header.php');
  include('sql_calls.php'); 
 
?>


<title>Add Employee</title>
</head>
<body>

<form method="post" action="processnew_user.php">
<label>Hansa ID</label>
<input type="text" name="hansa_id" required minlength="2" maxlength="5"/>
<br />
<label>First Name</label>
<input type="text" name="first_name" required maxlength="50"/>
<br />
<label>Last Name</label>
<input type="text" name="last_name" required maxlength="50"/>
<br />
<label>Email Address</label>
<input type="email" name="email" required minlength="6"/>
<br />


<label>User Role</label>
<!-- Dropdown selection for user role -->
<select name="user_role" id="soflow">
  <?php 
  while ($row = $resultrole->fetch_assoc()) {
      echo "<option value='" . $row['role_id'] . "'selected = 3>" . $row['role_name'] . "</option>";
      print_r($row);
  }
  ?>
</select>

<br>
<input type="submit" value="Add New User">
<a href="users.php" class="cancel">Cancel</a>


</form>

