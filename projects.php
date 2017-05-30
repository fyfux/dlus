<!-- PROJECTS -->
<?php
	
	$title = 'Projects';
	include 'include/parts/header.php';


//IF THE FLAG HASN'T BEEN SET YET, SET THE DEFAULT
if(!isset($_GET['orderBy'])) {
     $_GET['orderBy'] = 'project_number';
}

//FIGURE OUT HOW TO SORT THE TABLE
switch($_GET['orderBy']) {
     case 'project_number':
     case 'description':
     case 'status_description':
          $sql_orderBy = $_GET['orderBy'];
          break;
    case 'project_number_desc':
    case 'description_desc':
    case 'status_description_desc':
          $sql_orderBy = substr($_GET['orderBy'], 0, -5) . ' DESC';
          break;
     default:
          $_GET['orderBy'] = 'project_number';
          $sql_orderBy     = 'project_number';
}

//GET THE LIST OF PROJECTS
	$sqlPROJECTS = ("SELECT project_id, project_number, description, status, status_description FROM project join status where status.status_id=project.status ORDER BY $sql_orderBy") ; 
  $resultPROJECTS = mysqli_query($db,$sqlPROJECTS);
 
//RESULTS PER PAGE
    $results_per_page = 20; //DEFINE HOW MANY RESULTS SHOWN IN EVERY PAGE
    if (!isset($_GET['page'])) {
        $page=1;
    }
    else{
        $page = $_GET['page'];
    }
    $starting_limit_number=($page-1)*$results_per_page;
    $number_of_results = mysqli_num_rows($resultPROJECTS);
    $number_of_pages = ceil($number_of_results / $results_per_page);
            
        $sqlPROJECTSp = "SELECT project_id, project_number, description, status, status_description FROM project join status where status.status_id=project.status ORDER BY $sql_orderBy LIMIT " . $starting_limit_number . ',' . $results_per_page ; 
        $resultPROJECTSp = mysqli_query($db,$sqlPROJECTSp);
        
        if ($number_of_pages>1): ?>
        <p id="page numbers"> Pages: 
        <?php  
            for ($page=1;$page<=$number_of_pages;$page++) {
                echo '<a href="projects.php?page=' . $page . '"  ">' . $page . '</a>';
            }
        ?></p> <?php
            endif; 


?>

<div class="info_grid">
<table>

<caption>Projects 
  <button onclick="location.href = 'new_project.php';" id="myButton" class="btn btn-default" >New Project</button>
</caption>

  <thead>
    <tr>
      <th>
        <?php 
          if($_GET['orderBy'] == 'project_number') {print '<a href="projects.php?orderBy=project_number_desc">Project Number <i class="fa fa-arrow-down" aria-hidden="true" alt="Descending Order (A to Z)"></i></a>';}

          elseif($_GET['orderBy'] == 'project_number_desc') {print '<a href="projects.php?orderBy=project_number">Project Number <i class="fa fa-arrow-up" aria-hidden="true" alt="Descending Order (Z to A)"></i></a>'; }
          else { print '<a href="projects.php?orderBy=project_number">Project Number</a>'; }
        ?>
      </th>
      <th>
        <?php 
          if($_GET['orderBy'] == 'description') {print '<a href="projects.php?orderBy=description_desc">Description <i class="fa fa-arrow-down" aria-hidden="true" alt="Descending Order (A to Z)"></i></a>';}

          elseif($_GET['orderBy'] == 'description_desc') {print '<a href="projects.php?orderBy=description">Description <i class="fa fa-arrow-up" aria-hidden="true" alt="Descending Order (Z to A)" ></i></a>'; }
          else { print '<a href="projects.php?orderBy=description">Description</a>'; }
        ?>
      </th>
      <th>
        <?php 
          if($_GET['orderBy'] == 'status_description') {print '<a href="projects.php?orderBy=status_description_desc">Status <i class="fa fa-arrow-down" aria-hidden="true" alt="Descending Order (A to Z)"></i></a>';}
          
          elseif($_GET['orderBy'] == 'status_description_desc') { print '<a href="projects.php?orderBy=status_description">Status <i class="fa fa-arrow-up" aria-hidden="true" alt="Descending Order (Z to A)" ></i></a>'; }
          else { print '<a href="projects.php?orderBy=status_description">Status</a>'; }
        ?>
      </th>

      <th>Edit</th>

      <?php if ($permissions <3): ?>
        <th>Delete</th>
      <?php endif ?>

    </tr>
  </thead> 

  <tbody>
 
            <?php if ($resultPROJECTSp->num_rows > 0) {
                while( $row = $resultPROJECTSp->fetch_assoc()):?>
                    <tr>
                        <td><?php echo $row["project_number"]; ?></td>
                        <td><?php echo $row["description"]; ?></td>
                        <td><?php echo $row["status_description"]; ?></td>
                        <td> 
                          <?php echo "<a href='edit_project.php?project_id=".$row['project_id']."'>Edit</a>"?>
                        </td>
                        <?php if ($permissions < 3): ?> 
                          <td> 
                          <?php echo "<a href='delete_project.php?project_id=".$row['project_id']."'>Delete</a>"?>
                          </td>          
            <?php endif ?>


                        

                <?php endwhile;       
            } //if ($resultInst->num_rows > 0) ends
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
