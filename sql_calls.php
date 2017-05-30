<!--INCLUDED IN records.php-->
<?php  
    

	$sqlINST = ("SELECT record_id, huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE huser_id = '$user_check' ORDER BY record_id DESC") ; 
    $resultINST = $db->query($sqlINST);

    $sqlPM = ("SELECT huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE hproject_manager = '$userrid' ORDER BY record_id DESC") ; 
    $resultPM = $db->query($sqlPM);

    $sqlMG = ("SELECT huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE PM = '1' ORDER BY record_id DESC") ; 
    $resultMG = $db->query($sqlMG);

    $sqlACC = ("SELECT huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record WHERE PM = '1' && MG = '1' ORDER BY record_id DESC") ; 
    $resultACC = $db->query($sqlACC);
    
    $sqlADM = ("SELECT record_id, huser_id, week, mon, tue, wed, thu, fri, sat, sun, sum, hproject_number, hproject_manager, pm, mg FROM record ORDER BY record_id DESC");
    
    $resultADM = $db->query($sqlADM);

    /*
  	//GET THE LIST OF PROJECTS
    $sqlPROJECTS = ("SELECT project_id, project_number, description, status, status_description FROM project join status where status.status_id=project.status ORDER BY $sql_orderBy") ; 
    $resultPROJECTS = mysqli_query($db,$sqlPROJECTS);
	*/
	


?>
















    ?>