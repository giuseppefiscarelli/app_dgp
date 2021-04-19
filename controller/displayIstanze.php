<?php


if(!empty($_SESSION['message'])){
    $message = $_SESSION['message'];
    $alertType = $_SESSION['success'] ? 'success':'danger';
    $iconType = $_SESSION['success'] ? 'check':'exclamation-triangle';
    require 'view/template/message.php';
    unset($_SESSION['message'],$_SESSION['success']);
  }
                  
         $search2 = getParam('search2','');
         $search3 = getParam('search3','');
         $search4 = getParam('search4','');
          $params =[
            'orderBy' => $orderBy, 
            'orderDir'=> $orderDir,
            'recordsPerPage' =>$recordsPerPage,
            'search1' => $search1,
            'search2' => $search2,
            'search3' => $search3,
            'search4' => $search4,
            'page' => $page
          ];

          $orderByParams = $orderByNavigatorParams = $params;
          unset($orderByParams['orderBy']);
          unset($orderByParams['orderDir']);
          unset($orderByNavigatorParams['page']);
          $orderByQueryString = http_build_query($orderByParams,'&amp;');
          $navOrderByQueryString = http_build_query($orderByNavigatorParams,'&amp;');
          $tipi_istanze = getTipiIstanza();
          $stati_istanze = getStatiIstanza();
         
          //var_dump($users);
         
         if(isUserUser()){
           $params['search1']= $_SESSION['userData']['email'];
          $totalUsers= countIstanze($params);
          $numPages= ceil($totalUsers/$recordsPerPage);
           $email =  $_SESSION['userData']['email'];
          $istanze = getIstanzeUser($email);
          
          //var_dump($istanze);
          require_once 'view/istanze/istanze_listUser.php';
         }else{
          $totalUsers= countIstanze($params);
          $numPages= ceil($totalUsers/$recordsPerPage);
          $email=$_SESSION['userData']['email'];
          $istanze = getIstanze($params);
          //var_dump($istanze);
          

          require_once 'view/istanze/istanze_list.php';
         }