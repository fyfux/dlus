<?php include('config.php') ;
	$output = '';
	if (isset($_POST["export_excel"])) {
		$sql = "SELECT * FROM user";	
		$result = mysqli_query($db, $sql);
		if ($result->num_rows > 0) {
			$output .= '
				<table class="table" bordered="1">
				<tr>
				<th>Hansa ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>email</th>
				</tr>
				';

			while ($row = $result->fetch_assoc()) {
				$output .= '
				<table class="table" bordered="1">
				<tr>
				<td>'.$row["hansa_id"].'</td>
				<td>'.$row["first_name"].'</td>
				<td>'.$row["last_name"].'</td>
				<td>'.$row["email"].'</td>
				</tr>';
			}
			$output .= '</table>';
			header("Content-Type: application/xls");
			header("Content-Disposition:attachment; filename=download.xls");
			echo $output;
		}
		}





?>