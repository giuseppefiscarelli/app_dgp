<?php

//var_dump($_SESSION);
if(!empty($_SESSION['message'])){
 
    $message = $_SESSION['message'];
    $alertType = $_SESSION['loggedin'] ? 'success':'danger';
    
    require 'view/template/message.php';
    unset($_SESSION['message'],$_SESSION['success']);
  }
                  
          $search2 = getParam('search2','');
          $search3 = getParam('search3','');
          $search4 = getParam('search4','');
          $search5 = getParam('search5','');
          $params =[
            'orderBy' => $orderBy, 
            'orderDir'=> $orderDir,
            'recordsPerPage' =>$recordsPerPage,
            'search1' => $search1,
            'search2' => $search2,
            'search3' => $search3,
            'search4' => $search4,
            'search5' => $search5,
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
          if(isUserSuadmin() || isUserAdmin()){
          /*  require_once 'model/home.php';
            $params['search3']=1;
            $totalIstanze= countIstanze($params);

            $params['search4']='A';
            $istAttive =countIstanze($params);


           
             $params['search4']='C';
             $istRend =countIstanze($params);

             $params['search4']='D';
             $istIstr =countIstanze($params);

             $params['search4']='B';
             $istAnnullate =countIstanze($params);

             $params['search4']='E';
             $istScadute =countIstanze($params);

            require 'view/home/homeAdmin.php';*/
          }
           
          if(isUserUser()){
            require 'view/home/homeUser.php';

          }
       