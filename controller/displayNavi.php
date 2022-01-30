<?php

//var_dump($_SESSION);
if(!empty($_SESSION['message'])){

    $message = $_SESSION['message'];
    $alertType = $_SESSION['loggedin'] ? 'success':'danger';

    require 'view/template/message.php';
    unset($_SESSION['message'],$_SESSION['success']);
  }

      $search2 = getParam('search2',' ');
      $search3 = getParam('search3',' ');
      $search4 = getParam('search4',null);
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

//      var_dump($search2);
//      var_dump($search3);

      $orderByParams = $orderByNavigatorParams = $params;
      unset($orderByParams['orderBy']);
      unset($orderByParams['orderDir']);
      unset($orderByNavigatorParams['page']);
      $orderByQueryString = http_build_query($orderByParams,'&amp;');
      $navOrderByQueryString = http_build_query($orderByNavigatorParams,'&amp;');

      $pecs = getNavi($params);
      $totalList = countNavi($params);
//      echo "<br> numero = ".$totalList;
//      if (!$totalList > 0) $totalList = 0;
      $numPages = ceil($totalList / $recordsPerPage);

      $servizi = serviziNavi();

      $nazioni = getNazioni();
      $dropServizi = getservizi();
      $capitanerie = getCapitanerie();
      $armatori = getArmatori();
      $proprietari = getproprietari();
      //var_dump($pecs);die;
      //var_dump($nazioni);
      require_once 'view/navi/navi_list.php';

//          var_dump($pecs);

