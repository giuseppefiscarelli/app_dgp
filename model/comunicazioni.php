<?php

function getComunicazioni(array $params = []){

    /**
     * @var $conn mysqli
     */

        $conn = $GLOBALS['mysqli'];

        $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'data_ins';
        $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
        $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
        $page = (int)array_key_exists('page', $params) ? $params['page'] : 0;
        $start =$limit * ($page -1);
        if($start<0){
          $start = 0;
        }
        $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
        $search1 = $conn->escape_string($search1);
        $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
        $search2 = $conn->escape_string($search2);
        if($orderDir !=='ASC' && $orderDir !=='DESC'){
          $orderDir = 'ASC';
        }
        $records = [];

        

        $sql ="SELECT * FROM comunicazioni ";
        if($search1||$search2){
            $sql .=" where";
        }
        if ($search1){
          $sql .=" user_ins LIKE '%$search1%' ";
          if($search2){
              $sql .="AND";
          }
          
        }
        if ($search2){
            $sql .=" id_RAM LIKE '%$search2%' ";
            
          }
        $sql .= " ORDER BY data_ins  $orderDir LIMIT $start, $limit";
        //echo $sql;

        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

    return $records;

}
function countComunicazioni( array $params = []){

    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'data_ins';
    $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
    $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
    $page = (int)array_key_exists('page', $params) ? $params['page'] : 0;
    $start =$limit * ($page -1);
    if($start<0){
      $start = 0;
    }
    $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
    $search1 = $conn->escape_string($search1);
    $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
    $search2 = $conn->escape_string($search2);
    $search3 = array_key_exists('search3', $params) ? $params['search3'] : '';
    $search3 = $conn->escape_string($search3);
    $search4 = array_key_exists('search4', $params) ? $params['search4'] : '';
    $search4 = $conn->escape_string($search4);
    
    if($orderDir !=='ASC' && $orderDir !=='DESC'){
      $orderDir = 'ASC';
    }
    $records = [];

    $totalUser=0;

    $sql ="SELECT count(*) as totalMsg FROM comunicazioni ";
    if($search1||$search2||$search3 >=0||$search4 >= 0){
        $sql .=" where";
    }
    if ($search1){
      $sql .=" user_ins LIKE '%$search1%' ";
      if($search2||$search3 >=0||$search4 >= 0){
          $sql .="AND";
      }
      
    }
    if ($search2){
        $sql .=" id_RAM LIKE '%$search2%' ";
        if($search3 >=0||$search4 ){
            $sql .="AND";
        }
        
      }
      if ($search3 >= 0){
        $sql .=" read_msg = '$search3' ";
        if($search4 >= 0){
            $sql .="AND";
        }
        
      }
      if ($search4 >= 0){
        $sql .=" risolto = '$search4' ";
       
        
      }
    $sql .= " ORDER BY data_ins  $orderDir LIMIT $start, $limit";
    
    //echo $sql;    

        $res = $conn->query($sql);
        if($res) {

         $row = $res->fetch_assoc();
         $totalUser = $row['totalMsg'];
        }

    return $totalUser;

}
function getTipi(){
  
    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $sql = 'SELECT * FROM tipo_comunicazione';
    
    
    $records = [];

    $res = $conn->query($sql);
    if($res) {

      while( $row = $res->fetch_assoc()) {
          $records[] = $row;
          
      }

    }

   return $records;



}
function getTipo($tipo){

    /**
     * @var $conn mysqli
     */
  
      $conn = $GLOBALS['mysqli'];
        $result=[];
        $sql ="SELECT * FROM tipo_comunicazione WHERE cod_msg = '$tipo'";
        //echo $sql;
        $res = $conn->query($sql);
        
        if($res && $res->num_rows){
          $result = $res->fetch_assoc();
          
        }
      return $result;
    
    
}
function newMsg(array $data){

    /**
     * @var $conn mysqli
     */
  
      $conn = $GLOBALS['mysqli'];
        $testo = $conn->escape_string($data['testo']);
        $tipo = $conn->escape_string($data['tipo']);
        $data_ins = date("Y-m-d H:i:s");
        $user_ins = $_SESSION['userData']['email'];
        $data_instanza = getIstanzaUser($user_ins);
        $id_RAM = $data_instanza['id_RAM'];
        $result=0;
        $sql ='INSERT INTO comunicazioni (id, data_ins, user_ins, tipo, testo, id_RAM) ';
        $sql .= "VALUES (NULL, '$data_ins', '$user_ins', '$tipo', '$testo', $id_RAM) ";
        
        //echo $sql;die;
        $res = $conn->query($sql);
        
        if($res ){
          $result =  $conn->affected_rows;
          
        }else{
          $result -1;  
        }
      return $result;
    
    
}
function newConv(array $data){

    /**
     * @var $conn mysqli
     */
  
      $conn = $GLOBALS['mysqli'];
      $id_comunicazioni = $conn->escape_string($data['id_comunicazioni']);
        $testo = $conn->escape_string($data['testo']);
        $risolto = $conn->escape_string($data['risolto']);
        //risolto = array_key_exists('risolto', $data) ? $data['risolto'] : '0';
        $data_ins = date("Y-m-d H:i:s");
        $user_ins = $_SESSION['userData']['email'];
        $role = $_SESSION['userData']['roletype'];
       
        $result=0;
        $sql ='INSERT INTO cron_comunicazioni (id,id_comunicazioni, data_ins, user_ins, risolto, testo,role) ';
        $sql .= "VALUES (NULL,$id_comunicazioni, '$data_ins', '$user_ins', '$risolto', '$testo','$role') ";
        
        //echo $sql;die;
        $res = $conn->query($sql);
        
        if($res ){
          $result =  $conn->affected_rows;
          
        }else{
          $result -1;  
        }
      return $result;
    
    
}
function getMsg($id){

    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];
    $result=[];
    $sql ="SELECT * FROM comunicazioni WHERE id = $id";
    //echo $sql;
    $res = $conn->query($sql);
    
    if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
    }
    return $result;


} 
function getConv($id){

    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];
    $records=[];
    $sql ="SELECT * FROM cron_comunicazioni WHERE id_comunicazioni = $id";
    //echo $sql;
    $res = $conn->query($sql);
    if($res) {

      while( $row = $res->fetch_assoc()) {
          $records[] = $row;
          
      }

    }

    return $records;


} 
function getIstanzaUser($email){

    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];
    $result = [];
    $sql ="SELECT * FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and '$email' = xml.pec and (istanza.eliminata is null or trim(eliminata) = '')";
    //echo $sql;
    $res = $conn->query($sql);
    
    
    if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
    }
    return $result;


}
function  setReadmsg($id){
      /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $result=0;
  $user_read=$_SESSION['userData']['email'];
  $data_read = date("Y-m-d H:i:s");
  
  $sql ='UPDATE comunicazioni SET ';
  $sql .= "read_msg = true , user_read='$user_read', data_read='$data_read'";
  $sql .=' WHERE id = '.$id;
  //print_r($data);
  //echo $sql;die;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
    
  }else{
    $result -1;  
  }
  return $result;


}
function checkConv(){
    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];
    $totalUser=0;
    $sql ="SELECT count(*) as totalConv FROM cron_comunicazioni WHERE role = 'user' and read_msg = 0";
    //echo $sql;
    $res = $conn->query($sql);
    $res = $conn->query($sql);
    if($res) {

     $row = $res->fetch_assoc();
     $totalUser = $row['totalConv'];
    }

    return $totalUser;

}
function setReadConv($id,$role){
       /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $result=0;
  
  $sql ='UPDATE cron_comunicazioni SET ';
  $sql .= "read_msg = true ";
  $sql .=" WHERE id_comunicazioni = $id and role ='$role'";
  //print_r($data);
  //echo $sql;die;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
    
  }else{
    $result -1;  
  }
  return $result;


}
function checkUnreadConv($id,$role){
    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];
    $totalUser=0;
    $sql ="SELECT count(*) as totalConv FROM cron_comunicazioni WHERE role = '$role' and read_msg = 0 and id_comunicazioni =$id";
    //echo $sql;
    $res = $conn->query($sql);
    $res = $conn->query($sql);
    if($res) {

     $row = $res->fetch_assoc();
     $totalUser = $row['totalConv'];
    }

    return $totalUser;


}
function closeTicket($id){
         /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $result=0;
  $user_risolto=$_SESSION['userData']['email'];
  $data_risolto = date("Y-m-d H:i:s");
  
  $sql ='UPDATE comunicazioni SET ';
  $sql .= "user_risolto='$user_risolto', data_risolto='$data_risolto', risolto = true";
  $sql .=' WHERE id = '.$id;
  //print_r($data);
  //echo $sql;die;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
    
  }else{
    $result -1;  
  }
  return $result;



}  