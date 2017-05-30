<!-- LAST PROJECTS -->

<?php   

    include_once('config.php');

    $sql = ("SELECT huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE huser_id = '$user_check' ORDER BY record_id DESC LIMIT 5") ; 
    $result3 = $db->query($sql);

    $sqlPM = ("SELECT huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE hproject_manager = '$userrid' ORDER BY record_id DESC LIMIT 5") ; 
    $resultPM = $db->query($sqlPM);

    $sqlMG = ("SELECT huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE PM = '1' ORDER BY record_id DESC") ; 
    $resultMG = $db->query($sqlMG);

    $sqlACC = ("SELECT huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE PM = '1' && MG = '1' ORDER BY record_id DESC LIMIT 5") ; 
    $resultACC = $db->query($sqlACC);

    $sqlADM = ("SELECT huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record ORDER BY record_id DESC LIMIT 5") ; 
    $resultADM = $db->query($sqlADM);

    $project_name = "SELECT project_number from project where project_id = hproject_number";
    $resultproject_name = $db->query($project_name);

?>
    


<div class="preview">
<table>

    <caption>Last Records
        <button onclick="location.href = 'records.php';" id="myButton" class   ="btn btn-default">All Records</button>
        <?php if ($permissions == 5):?> 
        <button     onclick="location.href = 'new_record.php';" id="myButton" class="btn btn-default">New Record</button>
        <?php endif; ?>
    </caption>

    <!--Header for table (All users)-->
    <thead>
        <?php if ($permissions != 5):?><th>Author</th><?php endif; ?>
        <th>Week</th>
        <!--Record Author can't Records by other Users-->
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
    </thead>

    <!--Table for INST-->
    <?php if ($permissions == 5):?>
        <tbody>
            <!--Use a while loop to make a table row for every DB row-->
            <?php if ($result3->num_rows > 0) {
            // output data of each row
                while( $row = $result3->fetch_assoc()):?>
                <tr>
                    <td ><?php echo $row["week"]; ?></td>
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
                </tr>
                <?php endwhile; 
            } //if ($result3->num_rows > 0) ends
            else {
            echo "0 results";
            }
            $db->close();
            ?>
        </tbody>
    <?php endif //if ($permissions == 5) ends?>

    <!--Table for PM-->           
    <?php if ($permissions == 4):?>
        <tbody>
            <!--Use a while loop to make a table row for every DB row-->
            <?php if ($resultPM->num_rows > 0) {
                // output data of each row
                while( $row = $resultPM->fetch_assoc()):?>
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
                        <td><?php if ($row) {
                            # code...
                        }
                        echo $row["hproject_number"]; ?></td>

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
                    </tr>
                <?php endwhile; 
        } else {
        echo "0 results";
        }
        $db->close();
        ?>
        </tbody>
    <?php endif //if ($permissions == 4) ends ?>

    <!--Table for MG--> 
    <?php if ($permissions == 3):?>
        <tbody>
            <!--Use a while loop to make a table row for every DB row-->
            <?php if ($resultMG->num_rows > 0) {
                // output data of each row
                while($row = $resultMG->fetch_assoc()):?>
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
            <?php if ($resultACC->num_rows > 0) {
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
                    </tr>
                <?php endwhile; 
            } else {
            echo "0 results";
            }
            $db->close();
            ?>
        </tbody>
    <?php endif ?>
    
    <!--Table for ADM and ACC--> 
    <?php if ($permissions == 1):?>
        <tbody>
            <?php if ($resultADM->num_rows > 0) {
                while( $row = $resultADM->fetch_assoc()):?>
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