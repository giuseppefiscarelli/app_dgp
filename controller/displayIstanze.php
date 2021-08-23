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
          $tipi_istanze = getTipiIstanza();
          $stati_istanze = getStatiIstanza();
          $stati_istruttoria = getStatiIstruttoria();
         
          //var_dump($users);
         
         if(isUserUser()){
            $params['search1']= $_SESSION['userData']['email'];
            $totalUsers= countIstanze($params);
            $numPages= ceil($totalUsers/$recordsPerPage);
            $params['search1'] =  $_SESSION['userData']['email'];
          
            $ist =[];

            $ist = getIstanzeUser($params);
/*

           foreach($tipi_istanze as $ti){
             
            $params['search3'] = $ti['id'];
            
           
            if($res){
              foreach($res as $r){
                array_push($ist,$r);
              }
            }
          

           }
          */
          
          //var_dump($istanze);
          require_once 'view/istanze/istanze_listUser.php';
         }else{
         
          
          $email=$_SESSION['userData']['email'];
          /*if(!$search3){
            $istanze=[];
            $totalUsers =0;
            foreach($tipi_istanze as $ti){
              $params['search3'] = $ti['id'];
              $ist = getIstanze($params);
              foreach($ist as $is){
                array_push($istanze,$is);
              }
              $totalUsers+= countIstanze($params);
             
            }
          }else{*/
            $istanze = getIstanze($params);
            $totalUsers= countIstanze($params);
         // }
          $numPages= ceil($totalUsers/$recordsPerPage);
         // var_dump($istanze);die;
          

          require_once 'view/istanze/istanze_list.php';
         }