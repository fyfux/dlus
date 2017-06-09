<!-- RECORDS -->
<?php
	
	$title = 'Records';
	include 'include/parts/header.php';
    include 'sql_calls.php';

    //VALUES FOR ALL USERS
    $results_per_page = 20; //DEFINE HOW MANY RESULTS SHOWN IN EVERY PAGE
    if (!isset($_GET['page'])) {
        $page=1;
    }
    else{
        $page = $_GET['page'];
    }
    $starting_limit_number=($page-1)*$results_per_page;





    //results per page INST
    if ($permissions == 5) :
        $number_of_resultsINST = mysqli_num_rows($resultINST);
        $number_of_pagesINST = ceil($number_of_resultsINST / $results_per_page);
            
        $sqlINSTp = "SELECT record_id, huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE huser_id = '$user_check' ORDER BY record_id DESC LIMIT " . $starting_limit_number . ',' . $results_per_page; 
        $resultINSTp = $db->query($sqlINSTp);
        if ($number_of_pagesINST>1): ?>
        <p id="page numbers"> Pages: 
        <?php  
            for ($page=1;$page<=$number_of_pagesINST;$page++) {
                echo '<a href="records.php?page=' . $page . '"  ">' . $page . '</a>';
            }
        ?></p> <?php
        endif; 
    endif; 
    
    //results per page PM
    if ($permissions == 4) :
        $number_of_resultsPM = mysqli_num_rows($resultPM);
        $number_of_pagesPM = ceil($number_of_resultsPM / $results_per_page);
        
        $sqlPMp = "SELECT record_id, huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE hproject_manager = '$userrid' ORDER BY record_id DESC LIMIT " . $starting_limit_number . ',' . $results_per_page; 
        $resultPMp = $db->query($sqlPMp);
        if ($number_of_pagesPM>1): ?>
        <p id="page numbers"> Pages: 
        <?php  
            for ($page=1;$page<=$number_of_pagesPM;$page++) {
                echo '<a href="records.php?page=' . $page . '"  ">' . $page . '</a>';
            }
        ?></p> <?php
        endif; 
    endif; 
   
    //results per page MG
    if ($permissions == 3) :
        $number_of_resultsMG = mysqli_num_rows($resultMG);
        $number_of_pagesMG = ceil($number_of_resultsMG / $results_per_page);
        
        $sqlMGp = "SELECT record_id, huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE PM = '1' ORDER BY record_id DESC LIMIT " . $starting_limit_number . ',' . $results_per_page; 
        $resultMGp = $db->query($sqlMGp);
        if ($number_of_pagesMG>1): ?>
        <p id="page numbers"> Pages: 
        <?php  
            for ($page=1;$page<=$number_of_pagesMG;$page++) {
                echo '<a href="records.php?page=' . $page . '"  ">' . $page . '</a>';
            }
        ?></p> <?php
        endif; 
    endif; 

    //results per page ACC
    if ($permissions == 2) :
        $number_of_resultsACC = mysqli_num_rows($resultACC);
        $number_of_pagesACC = ceil($number_of_resultsACC / $results_per_page);
        
        $sqlACCp = "SELECT huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE PM = '1' && MG = '1' ORDER BY record_id DESC LIMIT " . $starting_limit_number . ',' . $results_per_page; 
        $resultACCp = $db->query($sqlACCp);
        if ($number_of_pagesACC>1): ?>
        <p id="page numbers"> Pages: 
        <?php  
            for ($page=1;$page<=$number_of_pagesACC;$page++) {
                echo '<a href="records.php?page=' . $page . '"  ">' . $page . '</a>';
            }
        ?></p> <?php
        endif; 
    endif;

    //results per page ADM
    if ($permissions == 1) :
        $number_of_resultsADM = mysqli_num_rows($resultADM);
        $number_of_pagesADM = ceil($number_of_resultsADM / $results_per_page);
        $starting_limit_number=($page-1)*$results_per_page;
        $sqlADMp = "SELECT record_id, huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record ORDER BY record_id DESC LIMIT " . $starting_limit_number . ',' . $results_per_page; 
        $resultADMp = $db->query($sqlADMp);
        if ($number_of_pagesADM>1): ?>
        <p id="page numbers"> Pages: 
        <?php  
             for ($page=1;$page<=$number_of_pagesADM;$page++) {
                 echo '<a href="records.php?page=' . $page . '"  ">' . $page . '</a>';
             }
            ?></p><?php
        endif;
    endif; ?>

    
<div class="info_grid">
<table>

    <caption>Records
        <?php if ($permissions == 5):?> 
            <button onclick="location.href = 'new_record.php';" id="myButton" class="btn btn-default">New Record</button>
        <?php endif; ?>
    </caption>
        
    <!--Header for table (All users)-->
    <thead>
        <!--Record Author can't Records by other Users-->
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
        <!--Defined Manager doesnt have this Column-->
        <?php if ($permissions != 4):?>
            <th>Manager</th>
            <th>PM</th>
        <?php endif; ?>
        <?php if ($permissions == 4):?><th><?php echo $login_session?></th><?php endif;?>
        <th>MG</th>
        <!--Edit and Delete function only to ADM, ACC and Records Author-->
        <?php if ($permissions == 1 || $permissions == 5):?>
            <th>Edit</th>
            <th>Delete</th>
        <?php endif; ?>
        <!--MG and PM have approve function-->
        <?php if ($permissions == 3 || $permissions == 4):?>
            <th>Approve</th>
            <th>Reject</th>
        <?php endif; ?>
    </thead>

    <!--Table for INST-->
    <?php if ($permissions == 5):?>
        <tbody>
            <?php if ($resultINSTp->num_rows > 0) {
                while( $row = $resultINSTp->fetch_assoc()):?>
                    <tr>
                        <td><?php echo $row["week"]; ?></td>
                        <td id="days"><?php echo $row["mon"]; ?></td>
                        <td id="days"><?php echo $row["tue"]; ?></td>
                        <td id="days"><?php echo $row["wed"]; ?></td>
                        <td id="days"><?php echo $row["thu"]; ?></td>
                        <td id="days"><?php echo $row["fri"]; ?></td>
                        <td id="days"><?php echo $row["sat"]; ?></td>
                        <td id="days"><?php echo $row["sun"]; ?></td>
                        <td id="extra"><?php echo $row["sum"]; ?></td>
                        <td><?php echo "1000-1-675" //$row["hproject_number"]; ?></td>
                        <td><?php echo "Lilita Skudra" //$row["hproject_manager"]; ?></td>

                        <td>
                            <?php if($row["pm"] == 0)
                            echo ' '; 
                            else if($row["pm"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true"></i>';}
                            else {echo '<i class="fa fa-times" aria-hidden="true"></i>'; }
                            ?>
                        </td>
                        <td>
                            <?php if($row["mg"] == 0)
                            echo ' '; 
                            else if($row["mg"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true"></i>';}
                            else {echo '<i class="fa fa-times" aria-hidden="true"></i>';}
                            ?>
                        </td>
                        <td> <?php echo "<a href='edit_record.php?record_id=".$row['record_id']."'>Edit</a>";?></td>
                        <td> <?php echo "<a href='delete_record.php?record_id=".$row['record_id']."'>Delete</a>";?></td>
                    </tr>
                <?php endwhile;       
            } //if ($resultInst->num_rows > 0) ends
            else {
                echo "0 results";
            }
            $db->close();
            ?>
        </tbody>
    <?php endif //if ($permissions == 5) ends ?> 

    <!--Table for PM-->    
    <?php if ($permissions == 4):?>
        <tbody>
            <?php 

            if ($resultPMp->num_rows > 0) {
                while( $row = $resultPMp->fetch_assoc()):?>
                    <tr>
                        <td><?php echo $row["huser_id"]; ?></td>
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

                        <td>
                            <?php if($row["pm"] == 0)
                            echo ' '; 
                            else if($row["pm"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true"></i>';}
                            else {echo '<i class="fa fa-times" aria-hidden="true"></i>'; }
                            ?>
                        </td>
                        <td>
                            <?php if($row["mg"] == 0)
                            echo ' '; 
                            else if($row["mg"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true"></i>';}
                            else {echo '<i class="fa fa-times" aria-hidden="true"></i>';}
                            ?>
                        </td>
                        <td><?php echo "<a href='approve.php?record_id=".$row['record_id']."'>Approve</a>";?></td>
                        <td><?php echo "<a href='reject.php?record_id=".$row['record_id']."'>Reject</a>";?></td>
                    </tr>
                <?php endwhile; 
        } else {
        echo "0 results";
        }
        $db->close();
        ?>
        </tbody>
    <?php endif //if ($permissions == 4) ends  ?>

    <!--Table for MG--> 
    <?php if ($permissions == 3):?>
        <tbody>
        <!--Use a while loop to make a table row for every DB row-->
           <?php if ($resultMGp->num_rows > 0) {
            // output data of each row
            while( $row = $resultMGp->fetch_assoc()):?>
                <tr>
                    <td><?php echo $row["huser_id"]; ?></td>
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
                     <td>
                            <?php if($row["pm"] == 0)
                            echo ' '; 
                            else if($row["pm"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true"></i>';}
                            else {echo '<i class="fa fa-times" aria-hidden="true"></i>'; }
                            ?>
                        </td>
                        <td>
                            <?php if($row["mg"] == 0)
                            echo ' '; 
                            else if($row["mg"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true"></i>';}
                            else {echo '<i class="fa fa-times" aria-hidden="true"></i>';}
                            ?>
                        </td>
                    <td><?php echo "<a href='approve.php?record_id=".$row['record_id']."'>Approve</a>";?></td>
                    <td><?php echo "<a href='reject.php?record_id=".$row['record_id']."'>Reject</a>";?></td>               
                </tr>
            <?php endwhile; 
            } else {
                echo "0 results";
            }
        $db->close();
        ?>
        </tbody>
    <?php endif ?>
    
    <!--Table for ACC--> 
    <?php if ($permissions == 2):?>
        <tbody>
            <!--Use a while loop to make a table row for every DB row-->
            <?php if ($resultACCp->num_rows > 0) {
                // output data of each row
                while( $row = $resultACC->fetch_assoc()):?>
                    <tr>
                        <td><?php echo $row["huser_id"]; ?></td>
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
                         <td>
                            <?php if($row["pm"] == 0)
                            echo ' '; 
                            else if($row["pm"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true"></i>';}
                            else {echo '<i class="fa fa-times" aria-hidden="true"></i>'; }
                            ?>
                        </td>
                        <td>
                            <?php if($row["mg"] == 0)
                            echo ' '; 
                            else if($row["mg"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true"></i>';}
                            else {echo '<i class="fa fa-times" aria-hidden="true"></i>';}
                            ?>
                        </td>
                <?php endwhile; 
            } else {
            echo "0 results";
            }
            $db->close();
            ?>
        </tbody>
    <?php endif ?>

    <!--Table for ADM--> 
    <?php if ($permissions == 1):?>
        <tbody>
            <!--Use a while loop to make a table row for every DB row-->
            <?php if ($resultADMp->num_rows > 0) {
                // output data of each row
                while( $row = $resultADMp->fetch_assoc()):?>
                    <tr>
                        <td><?php echo $row["huser_id"]; ?></td>
                        <td><?php echo $row["week"]; ?></td>
                        <td id="days"><?php echo $row["mon"]; ?></td>
                        <td id="days"><?php echo $row["tue"]; ?></td>
                        <td id="days"><?php echo $row["wed"]; ?></td>
                        <td id="days"><?php echo $row["thu"]; ?></td>
                        <td id="days"><?php echo $row["fri"]; ?></td>
                        <td id="days"><?php echo $row["sat"]; ?></td>
                        <td id="days"><?php echo $row["sun"]; ?></td>
                        <td id="extra"><?php echo $row["sum"]; ?></td>
                        
                        <td><?php //$projnr = $row["hproject_number"];
                            
                                //$prnr = "SELECT project_number FROM project where project_id=$projnr";
                                //$result = $db->query($prnr);
                                //echo $row['project_number'];
                                //to get porject number, not ID
                            echo $row["hproject_number"];
                            ?>

                        </td>

                        <td><?php echo $row["hproject_manager"]; ?></td>
                        
                        <td>
                            <?php if($row["pm"] == 0)
                            echo ' '; 
                            else if($row["pm"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true"></i>';}
                            else {echo '<i class="fa fa-times" aria-hidden="true"></i>'; }
                            ?>
                        </td>
                        <td>
                            <?php if($row["mg"] == 0)
                            echo ' '; 
                            else if($row["mg"] == 1) {
                            echo '<i class="fa fa-check" aria-hidden="true"></i>';}
                            else {echo '<i class="fa fa-times" aria-hidden="true"></i>';}
                            ?>
                        </td>
                        <td> <?php echo "<a href='edit_record.php?record_id=".$row['record_id']."'>Edit</a>";?></td>
                        <td> <?php echo "<a href='delete_record.php?record_id=".$row['record_id']."'>Delete</a>";?></td>
                    </tr>
                <?php endwhile; 
            } else {
            echo "0 results";
            }
            $db->close();
            ?>
        </tbody>
    <?php endif ?>

</table>
</div>
           
<?php include('include/parts/footer.php'); ?>






