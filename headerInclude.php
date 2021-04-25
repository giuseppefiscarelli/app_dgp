<?php

require_once 'view/template/top.php';
 
$pageUrl= $_SERVER['PHP_SELF'];


$orderDir = getParam('orderDir', 'DESC');
$orderBy = getParam('orderBy', 'id');
$recordsPerPage = getParam('recordsPerPage', getConfig('recordsPerPage'));
$recordsPerPageOptions = getConfig ('recordsPerPageOptions',[5,10,15,20,50]);
$roletype = getConfig ('roletype'.'');
//$ambMenu = getAmbiente();
$search1 = getParam ('search1','');
$page =getParam ('page',1);


    require_once 'view/template/topbar_header.php';
?>


<?php
    if(isUserSuadmin()){
      require_once 'view/template/sidebar.php';
    }
    
    if(isUserAdmin()){
      require_once 'view/template/sidebarAdmin.php';
    }
    if(isUserUser()){
      require_once 'view/template/sidebarUser.php';
    }
    
?>
      
   
<!--End topbar header-->

 