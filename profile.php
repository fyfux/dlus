<!-- PROFILE -->


<?php
	
	$title = 'Profile';
	include 'include/parts/header.php';

	//SELECT FROM USER TABLE
	$sql3 = ("SELECT user_id, hansa_id, first_name, last_name, email, role_description FROM user
        join user_role on user.user_role = user_role.role_id WHERE hansa_id = '$user_check'") ; 
	$result3 = $db->query($sql3);


if ($result3)
{

    while($row = $result3->fetch_assoc()):?>
    	<div class="profile">
    		
   	
    	<div class="info_box">

				<table class="profile_info">
			    <tbody>
			        <tr>
			          <th>Hansa ID</th>
			            <td><?php echo $row["hansa_id"];?></td>
			        </tr>
			        <tr>
			          <th>First Name</th>
			            <td><?php echo $row['first_name'];?></td>
			        </tr>
			        <tr>
			          <th>Last Name</th>
			            <td><?php echo $row['last_name'];?></td>
			        </tr>
			      <tr>
			          <th>Email</th>
			          	<td><?php echo $row['email'];?></td>
			        </tr>
			        <tr>
			          <th>User Role</th>
			          	<td><?php echo $row['role_description'];?></td>
			        </tr>
			    </tbody>
			</table>
			

			
		</div>
		<button class="edit_profile"><?php echo "<a href='edit_profile.php?user_id=".$row['user_id']."' >Edit</a>";?></button>
		
		</div>
	<?php endwhile; 
	    $result->free();
}
else
{
    echo "No results found";
}

?>




