<!-- NEW RECORD -->
<?php

   $title = 'Add New Project';

   include('include/parts/header.php');
   include('sql_calls.php'); 

?>

<form method="post" class="record" action="processnew_record.php">
	<div class="info_grid">
		<table>
			<thead>
				<th>Week</th>
				<th>Mon</th>
				<th>Tue</th>
				<th>Wed</th>
				<th>Thu</th>
				<th>Fri</th>
				<th>Sat</th>
				<th>Sun</th>

				<th>Project Number</th>
				<th>Project Manager</th>
			</thead>

			<tbody>
				<tr>
					<td>

						<select name="week_no" id="week_no"> 
							<?php for ($i = 1; $i <= 52; $i++) { ?> 
							<option value="<?php echo $i; ?>" <?php if ($i == date('W')) { echo 'selected="selected"';} ?>><?php echo $i; ?></option> 
							<?php } ?> 
						</select>

					</td>

					<td><input class="hours" type="number" min="0" step="0.5" name="mon" value="0"/></td>
					<td><input class="hours" type="number" min="0" step="0.5" name="tue" value="0"/></td>
					<td><input class="hours" type="number" min="0" step="0.5" name="wed" value="0"/></td>
					<td><input class="hours" type="number" min="0" step="0.5" name="thu" value="0"/></td>
					<td><input class="hours" type="number" min="0" step="0.5" name="fri" value="0"/></td>
					<td><input class="hours" type="number" min="0" step="0.5" name="sat" value="0"/></td>
					<td><input class="hours" type="number" min="0" step="0.5" name="sun" value="0"/></td>

					<td>

					<!-- Dropdown selection for project number -->
					<select name="hproject_number" required>
					<?php 
					echo '<option value=""></option>';
					while ($row = $resultproject->fetch_assoc()) {
					echo "<option value='" . $row['project_id'] .  "'>" . $row['project_number'] . " - " . $row['description'] ."</option>";
					print_r($row);
					}
					?>
					</select></td>

					<td>
					<!-- Dropdown selection for user role -->
					<select name="hproject_manager" required>
					<?php 
					echo '<option value=""></option>';
					while ($row = $resultmanager->fetch_assoc()) {
					echo "<option value='" . $row['user_id'] .  "'>" . $row['first_name'] . " " . $row['last_name'] ."</option>";
					print_r($row);
					}
					?>
					</select></td>

					</td>

				</tr>

			</tbody>
		</table>

		<br>
		
		<input type="submit" value="Add New Record">
		<a href="records.php" class="cancel">Cancel</a>

	</div>

</form>




<?php include('include/parts/footer.php'); ?>






