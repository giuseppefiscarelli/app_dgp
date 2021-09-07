<?php
  require_once 'connection.php';

  function verifyLogin($token, $email, $password){
    require_once 'model/user.php';

    $result=[
      'message' => 'Login corretto',
      'success' => true
    ];

    if($token !== $_SESSION['csrf']){

      $result=[
        'message' => 'Token Mismatch',
        'success' => false
      ];

      return $result;
    }

    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if(!$email){
      $result=[
        'message' => 'Credenziali non corrette',
        'success' => false
      ];
     
      return $result;
    }

    
    if(strlen($password)<6){
      $result=[
        'message' => 'Credenziali non corrette',
        'success' => false
      ];
      return $result;
    }

    $resEmail = getUserbyEmail($email);
    if(!$resEmail){
      $result=[
        'message' => 'Credenziali non corrette',
        'success' => false
      ];
    return $result;

    }
      
    if(!password_verify($password, $resEmail['password'])){
      $result=[
        'message' => 'Credenziali non corrette',
        'success' => false
      ];
      $result['log_funzione']= 'Procedura Login';
      $result['user']['email'] = $email;
      writelog($result);
      return $result;  
    }

    $result['user'] = $resEmail;
    return $result;
    
  }
  function isUserLoggedin(){

    return $_SESSION['loggedin'] ?? false;
  }
  function getUserLoggedInFullname(){
    return $_SESSION['userData']['username'] ?? '';
  }
  function getUserLoggedInId(){
    return $_SESSION['userData']['id'] ?? '';
  }
  function getUserRole(){
    return $_SESSION['userData']['roletype'] ?? '';
  } 
  function isUserAdmin(){
    return getUserRole() === 'admin';
  }
  function isUserSuadmin(){
    return getUserRole() === 'suadmin';
  }
  function isUserUser(){
    return getUserRole() === 'user';
  } 
  function isUserEditor(){
    return getUserRole() === 'editor';
  }
  function getUserLoggedInName(){

    $extName = $_SESSION['userData']['nome'].' '.$_SESSION['userData']['cognome'];
    return $extName ?? '';
  }
  function getUserLoggedEmail(){
    return $_SESSION['userData']['email'] ?? '';
  }
  function getConfig($param, $default = null){

      $config = require 'config.php';

      return array_key_exists($param, $config) ? $config[$param] : $default;
  }
  function getUsers( array $params = []){

      /**
       * @var $conn mysqli
       */

          $conn = $GLOBALS['mysqli'];

          $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'id';
          $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
          $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
          $page = (int)array_key_exists('page', $params) ? $params['page'] : 0;
          $start =$limit * ($page -1);
          if($start<0){
            $start = 0;
          }
          $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
          $search1 = $conn->escape_string($search1);
          if($orderDir !=='ASC' && $orderDir !=='DESC'){
            $orderDir = 'ASC';
          }
          $records = [];

          

          $sql = 'SELECT * FROM users';
          if ($search1){
            $sql .=" WHERE email LIKE '%$search1%' ";
            //$sql .=" OR roletype LIKE '%$search1%' ";
          }
          $sql .= " ORDER BY $orderBy $orderDir LIMIT $start, $limit";
          

          $res = $conn->query($sql);
          if($res) {

            while( $row = $res->fetch_assoc()) {
                $records[] = $row;
                
            }

          }

      return $records;

  }
  function statusUsers($status,$user){

    /**
     * @var $conn mysqli
     */

        $conn = $GLOBALS['mysqli'];

               
        $records = [];

        

        $sql = 'UPDATE users SET';
        $sql .= " status = '$status'";
        $sql .=" WHERE username = '$user' ";
          
        

        $res = $conn->query($sql);
        
      
      if($res ){
        $result =  $conn->affected_rows;
        
      }else{
        $result -1;  
      }
    return $result;

  }
  function countUsers( array $params = []){

    /**
     * @var $conn mysqli
     */

        $conn = $GLOBALS['mysqli'];

        $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'id';
        $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
        $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
        $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
        $search1 = $conn->escape_string($search1);
        if($orderDir !=='ASC' && $orderDir !=='DESC'){
          $orderDir = 'ASC';
        }
        $totalUser = 0;

        

        $sql = 'SELECT COUNT(*) as totalUser FROM users';
        if ($search1){
          $sql .=" WHERE username LIKE '%$search1%' ";
          $sql .=" OR roletype LIKE '%$search1%' ";
        }
        

        $res = $conn->query($sql);
        if($res) {

         $row = $res->fetch_assoc();
         $totalUser = $row['totalUser'];
        }

    return $totalUser;

  }
  function getParam ($param, $default = null){

    return !empty($_REQUEST[$param])? $_REQUEST[$param]: $default;
  
  } 
  function getSubMenu1($subParMenu){

    /**
     * @var $conn mysqli
     */

        $conn = $GLOBALS['mysqli'];
      
        
        $records = [];

        
        $sql = "SELECT * FROM sidebar WHERE menu = '$subParMenu' AND sub2 = 0";
        

        $res = $conn->query($sql);
        if($res) {

        while( $row = $res->fetch_assoc()) {
            $records[] = $row;
              
        }

        }

    return $records;

  } 
  function checkAuthPage($authPage,$authThisPage){

    /**
     * @var $conn mysqli
     */

        $conn = $GLOBALS['mysqli'];

        
        $records = [];

        
        $sql = "SELECT * FROM sidebar WHERE ambiente = '$authPage' AND funzione = '$authThisPage'";
        

        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

    return $records;

  }   
  function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
  }
  function countNotifiche(){

        /**
         * @var $conn mysqli
         */

        $conn = $GLOBALS['mysqli'];

        $total = 0;
        $user = $_SESSION['userData']['username'];
        

        $sql = "SELECT COUNT(*) as total FROM notifiche  WHERE a = '$user' AND stato = 'N' ";
        
         
         
        //echo $sql;
        

        $res = $conn->query($sql);
        if($res) {

        $row = $res->fetch_assoc();
        $total = $row['total'];
        }

    return $total;


  }
  function getNotifiche(){

    /**
     * @var $conn mysqli
     */

        $conn = $GLOBALS['mysqli'];
      
        
        $records = [];
        $user = $_SESSION['userData']['username'];
        
        $sql = "SELECT * FROM notifiche WHERE a = '$user' AND stato = 'N' limit 5";
        

        $res = $conn->query($sql);
        if($res) {

        while( $row = $res->fetch_assoc()) {
            $records[] = $row;
              
        }

        }

    return $records;

  }
  function writelog($result){
    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];
    
      //var_dump($result);die;
     $log_cod_user = $result['user']['email'];
     $log_funzione = $result['log_funzione'];
     $log_descrizione = $result['message'];
     $log_ok = $result['success'];
     $log_IP = $_SERVER['REMOTE_ADDR'];

    $result=0;
    //$id_RAM=$data['id_RAM'];
    $sql ='INSERT INTO log (id,  log_cod_user,log_funzione,log_descrizione,log_IP,log_ok) ';
    $sql .= "VALUES (NULL, '$log_cod_user','$log_funzione','$log_descrizione','$log_IP','$log_ok') ";
    
    //echo $sql;
    $res = $conn->query($sql);
    
    if($res ){
      $result =  $conn->affected_rows;
      
    }else{
      $result -1;  
    }
    return $result;
  }
  