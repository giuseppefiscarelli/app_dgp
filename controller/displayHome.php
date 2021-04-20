<?php

//var_dump($_SESSION);
if(!empty($_SESSION['message'])){
 
    $message = $_SESSION['message'];
    $alertType = $_SESSION['loggedin'] ? 'success':'danger';
    
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

         // $totalUsers= countUsers($params);
         // $numPages= ceil($totalUsers/$recordsPerPage);
         // $users = getUsers($params);
          //var_dump($users);
          if(isUserSuadmin()){
            require_once 'model/istanze.php';
            $totalIstanze= countIstanze($params);
            $istTotali =countTotIstanze($params);
             $istanze = getIstanze($params);
             $istRend =countRendicontazione(1);
             $istIstr =countRendicontazione(0);


            require 'view/home/homeSuadmin.php';
          }
          if(isUserAdmin()){
            require_once 'model/istanze.php';
            //require_once 'model/comunicazioni.php';
           
/*
             $totalMsg = countTicket(); 
            
             $unreadMsg= countnewTicket();
             $readMsg= countreadTicket();
             $closedMsg= countcloseTicket();

*/
            require 'view/home/homeAdmin.php';
          }
          if(isUserUser()){
            require 'view/home/homeUser.php';

          }
       