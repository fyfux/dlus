<!-- NEW PROJECT -->

<?php

   $title = 'New Project';

   include('include/parts/header.php');



?>


<form method="post" action="processnew_project.php">
<label>Project Number</label>
<input type="text" name="project_number" required/>
<br />
<label>Description</label>
<input type="text" name="description" required/>
<br />
<input type="submit" value="Add New Project">
<a href="projects.php" class="cancel">Cancel</a>
</form>
