
<?php  
    
    //INCLUDED IN records.php

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


    //FOR DRODOWN MENUS

    $status ="SELECT * FROM status";
    $resultstatus = mysqli_query($db, $status);

    $project = "SELECT * FROM project where status = 1 ORDER BY project_number";
    $resultproject = mysqli_query($db, $project);

    $manager = "SELECT * FROM user where user_role = 4 ORDER BY first_name";
    $resultmanager = mysqli_query($db, $manager);

    $role = "SELECT * FROM user_role";
    $resultrole = mysqli_query($db, $role);

    $user_status = "SELECT * FROM user_status";
    $resultuser_status = mysqli_query($db, $user_status);

    $inst = "SELECT * FROM user where user_role = 5 ORDER BY first_name";
    $resultinst = mysqli_query($db, $inst);


    //FOR LAST...
    
    $last_projects = ("SELECT project_number, description, status, status_description FROM project JOIN status WHERE status.status_id=project.status ORDER BY project_id DESC LIMIT 3");
    $resultlast_projects = $db->query($last_projects);
    
    $last_users = ("SELECT hansa_id, first_name, last_name, email, role_description FROM user join user_role on user.user_role = user_role.role_id ORDER BY user_id DESC LIMIT 3") ; 
    $resultlast_users = $db->query($last_users);







    //FIND WHERE THEY ARE NEEDED
   $sql2 = ("SELECT hansa_id, first_name, last_name, email, role_description FROM user
       WHERE hansa_id = $user_check"); 
   $result2 = mysqli_query($db, $sql2);





    ?>