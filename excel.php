<?php 
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition:attachment; filename=download.xls');

	echo $_GET["data"];

 ?>