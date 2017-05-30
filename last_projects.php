<!-- LAST PROJECTS -->
<!-- $result IN session.php -->
<div class="preview">
<table>

    <caption>Last Projects        
        <button onclick="location.href = 'projects.php';" id="myButton" class="btn btn-default">All Projects</button>
        <button onclick="location.href = 'new_project.php';" id="myButton" class="btn btn-default">New Project</button>
    </caption>
    <thead>
        <th>Project Number</th>
        <th>Description</th>
        <th>Status</th>
    </thead> 

    <tbody>
        <!--Use a while loop to make a table row for every DB row-->
        <?php if ($result->num_rows > 0) {
        // output data of each row
            while( $row = $result->fetch_assoc()):?>
            <tr>
                <td><?php echo $row["project_number"]; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td><?php echo $row["status_description"]; ?></td>
            </tr>
            <?php endwhile;  

        } else {
        echo "0 results";
        }

        ?>  
    </tbody>

</table>
</div>