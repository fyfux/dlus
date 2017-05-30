<!--USERS-->
<?php
	
	$title = 'Users';
	include 'include/parts/header.php';

	//$sql = ("SELECT user_id, hansa_id, first_name, last_name, email, role_description, active FROM user
       // join user_role on user.user_role = user_role.role_id

       //                              ORDER BY hansa_id ASC"); 
	//$result = $db->query($sql);



//IF THE FLAG HASN'T BEEN SET YET, SET THE DEFAULT
if(!isset($_GET['orderBy'])) {
     $_GET['orderBy'] = 'hansa_id';
}

//FIGURE OUT HOW TO SORT THE TABLE
switch($_GET['orderBy']) {
     case 'hansa_id':
     case 'first_name':
     case 'last_name':
     case 'email':
     case 'role_description':
     case 'active':
          $sql_orderBy = $_GET['orderBy'];
          break;
    case 'hansa_id_desc':
    case 'first_name_desc':
    case 'last_name_desc':    
    case 'email_desc':
    case 'role_description_desc':
    case 'active_desc':
          $sql_orderBy = substr($_GET['orderBy'], 0, -5) . ' DESC';
          break;
     default:
          $_GET['orderBy'] = 'hansa_id';
          $sql_orderBy     = 'hansa_id ASC';
}

//GET THE LIST OF USERS
  $userList = '';
        
        $sqlUSER = "
        SELECT user_id, hansa_id, first_name, last_name, email,  role_description, active
        FROM user

        inner join user_role on user.user_role = user_role.role_id

                                     ORDER BY $sql_orderBy";
    
        $resultUSER = mysqli_query($db,$sqlUSER);



 
//RESULTS PER PAGE
    $results_per_page = 20; //DEFINE HOW MANY RESULTS SHOWN IN EVERY PAGE
    if (!isset($_GET['page'])) {
        $page=1;
    }
    else{
        $page = $_GET['page'];
    }
    $starting_limit_number=($page-1)*$results_per_page;
    $number_of_results = mysqli_num_rows($resultUSER);
    $number_of_pages = ceil($number_of_results / $results_per_page);
            
        $sqlUSERp = "SELECT user_id, hansa_id, first_name, last_name, email,  role_description, active
        FROM user join user_role on user.user_role = user_role.role_id ORDER BY $sql_orderBy LIMIT " . $starting_limit_number . ',' . $results_per_page ; 
        $resultUSERp = mysqli_query($db,$sqlUSERp);
        
        if ($number_of_pages>1): ?>
        <p id="page numbers"> Pages: 
        <?php  
            for ($page=1;$page<=$number_of_pages;$page++) {
                echo '<a href="users.php?page=' . $page . '"  ">' . $page . '</a>';
            }
        ?></p> <?php
            endif; 


?>






<div class="info_grid">
<table>
<caption>Users <button onclick="location.href = 'new_user.php';" id="myButton" class="btn btn-default" >New User</button></caption>

 <thead>
    <tr>
      <th>
        <?php 
          if($_GET['orderBy'] == 'hansa_id') {print '<a href="users.php?orderBy=hansa_id_desc">Hansa ID <i class="fa fa-arrow-down" aria-hidden="true" alt="Descending Order (A to Z)"></i></a>';}

          elseif($_GET['orderBy'] == 'hansa_id_desc') {print '<a href="users.php?orderBy=hansa_id">Hansa ID <i class="fa fa-arrow-up" aria-hidden="true" alt="Descending Order (Z to A)"></i></a>'; }
          else { print '<a href="users.php?orderBy=hansa_id">Hansa ID</a>'; }
        ?>
      </th>
      <th>
        <?php 
          if($_GET['orderBy'] == 'first_name') {print '<a href="users.php?orderBy=first_name_desc">First Name <i class="fa fa-arrow-down" aria-hidden="true" alt="Descending Order (A to Z)"></i></a>';}

          elseif($_GET['orderBy'] == 'first_name_desc') {print '<a href="users.php?orderBy=first_name">First  Name <i class="fa fa-arrow-up" aria-hidden="true" alt="Descending Order (Z to A)" ></i></a>'; }
          else { print '<a href="users.php?orderBy=first_name">First Name</a>'; }
        ?>
      </th>
      <th>
        <?php 
          if($_GET['orderBy'] == 'last_name') {print '<a href="users.php?orderBy=last_name_desc">Last Name <i class="fa fa-arrow-down" aria-hidden="true" alt="Descending Order (A to Z)"></i></a>';}
          
          elseif($_GET['orderBy'] == 'last_name_desc') { print '<a href="users.php?orderBy=last_name">Last Name <i class="fa fa-arrow-up" aria-hidden="true" alt="Descending Order (Z to A)" ></i></a>'; }
          else { print '<a href="users.php?orderBy=last_name">Last Name</a>'; }
        ?>
      </th>


    <th>
        <?php 
          if($_GET['orderBy'] == 'email') {print '<a href="users.php?orderBy=email_desc">Email <i class="fa fa-arrow-down" aria-hidden="true" alt="Descending Order (A to Z)"></i></a>';}
          
          elseif($_GET['orderBy'] == 'email_desc') { print '<a href="users.php?orderBy=email">Email <i class="fa fa-arrow-up" aria-hidden="true" alt="Descending Order (Z to A)" ></i></a>'; }
          else { print '<a href="users.php?orderBy=email">Email</a>'; }
        ?>
      </th>
        <th>
        <?php 
          if($_GET['orderBy'] == 'role_description') {print '<a href="users.php?orderBy=role_description_desc">Role <i class="fa fa-arrow-down" aria-hidden="true" alt="Descending Order (A to Z)"></i></a>';}
          
          elseif($_GET['orderBy'] == 'role_description_desc') { print '<a href="users.php?orderBy=role_description">Role <i class="fa fa-arrow-up" aria-hidden="true" alt="Descending Order (Z to A)" ></i></a>'; }
          else { print '<a href="users.php?orderBy=role_description">Role</a>'; }
        ?>
      </th>
              <th>
        <?php 
          if($_GET['orderBy'] == 'active') {print '<a href="users.php?orderBy=active_desc">Status <i class="fa fa-arrow-down" aria-hidden="true" alt="Descending Order (A to Z)"></i></a>';}
          
          elseif($_GET['orderBy'] == 'active_desc') { print '<a href="users.php?orderBy=active">Status <i class="fa fa-arrow-up" aria-hidden="true" alt="Descending Order (Z to A)" ></i></a>'; }
          else { print '<a href="users.php?orderBy=active">Status</a>'; }
        ?>
      </th>

      <th>Edit</th>

      <?php if ($permissions == 1): ?>
        <th>Delete</th>
      <?php endif ?>

    </tr>
  </thead> 




        <tbody>
            <?php if ($resultUSERp->num_rows > 0) {
                while( $row = $resultUSERp->fetch_assoc()):?>
                    <tr>
                        <td><?php echo $row["hansa_id"]; ?></td>
                        <td><?php echo $row["first_name"];?></td>
                        <td><?php echo $row["last_name"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["role_description"]; ?></td>
                        <td><?php if ($row["active"] == 1) {
                            echo "Active";}
                            elseif ($row["active"] == 0) {
                            echo "Inactive";
                        } else{
                            echo "Closed";
                        } ?>
                        </td>
                        <td> <?php echo "<a href='edit_user.php?user_id=".$row['user_id']."'>Edit</a>";?></td>
                        <?php if ($permissions == 1):?>
                        <td> <?php echo "<a href='delete_user.php?user_id=".$row['user_id']."'>Delete</a>";?></td>
                    <?php endif; ?>
                    </tr>
                <?php endwhile;       
            } //if ($result3->num_rows > 0) ends
            else {
                echo "0 results";
            }
            $db->close();
            ?>
        </tbody>



</table>

</div>





<?php
	include('include/parts/footer.php');
?>
