<!-- LAST USERS -->
<!-- $result1 IN session.php -->
<div class="preview">
<table>
    <caption>Last Users
        <button onclick="location.href = 'users.php';" id="myButton" class="btn btn-default">All Users</button>
        <button onclick="location.href = 'new_user.php';" id="myButton" class="btn btn-default">New User</button>
    </caption>

    <thead>
        <th>Hansa ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Role</th>
    </thead> 

    <tbody>
        <!--Use a while loop to make a table row for every DB row-->
        <?php if ($result1->num_rows > 0) {
        // output data of each row
            while( $row = $result1->fetch_assoc()):?>
            <tr>
                <td><?php echo $row["hansa_id"]; ?></td>
                <td><?php echo $row["first_name"]; ?></td>
                <td><?php echo $row["last_name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["role_description"]; ?></td>
            </tr>
            <?php endwhile;  

        } else {
        echo "0 results";
        }
        ?>
    </tbody>

</table>
</div>
