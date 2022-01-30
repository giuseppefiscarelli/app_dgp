<?php


if(!empty($_SESSION['message'])){
    $message = $_SESSION['message'];
    $alertType = $_SESSION['success'] ? 'success':'danger';
    $iconType = $_SESSION['success'] ? 'check':'exclamation-triangle';
    require 'view/template/message.php';
    unset($_SESSION['message'],$_SESSION['success']);
  }
                  

          $params =[
            'orderBy' => $orderBy, 
            'orderDir'=> $orderDir,
            'recordsPerPage' =>$recordsPerPage,
            'search1' => $search1,
            'page' => $page
          ];

          $orderByParams = $orderByNavigatorParams = $params;
          unset($orderByParams['orderBy']);
          unset($orderByParams['orderDir']);
          unset($orderByNavigatorParams['page']);
          $orderByQueryString = http_build_query($orderByParams,'&amp;');
          $navOrderByQueryString = http_build_query($orderByNavigatorParams,'&amp;');

          $totalUsers= countArmatori($params);
          $numPages= ceil($totalUsers/$recordsPerPage);
          $armatori = getArmatori($params);
          $nazioni = getNazioni();
         // var_dump($armatori);
         require_once 'view/armatori/armatoriList.php';