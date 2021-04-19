<?php
function getReport(array $params = []){

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

    

    $sql ="SELECT * FROM report where attivo=1 ";
    if($search1||$search2){
        $sql .=" and";
    }
    if ($search1){
      $sql .=" stato = '$search1' ";
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
function countReport( array $params = []){

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

    $sql ="SELECT count(*) as totalMsg FROM report where attivo=1 ";
    if($search1||$search2||$search3 >=0||$search4 >= 0){
        $sql .=" and";
    }
    if ($search1){
    $sql .=" stato = '$search1' ";
    //if($search2||$search3 >=0||$search4 >= 0){
     //   $sql .="AND";
   // }
    
    }
    /*
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
    */
    $sql .= " ORDER BY data_ins  $orderDir LIMIT $start, $limit";

   // echo $sql;    

        $res = $conn->query($sql);
        if($res) {

        $row = $res->fetch_assoc();
        $totalUser = $row['totalMsg'];
        }

    return $totalUser;

}

function getTipoReport($tipo){

    /**
     * @var $conn mysqli
     */
  
    $conn = $GLOBALS['mysqli'];
  
    $sql = 'SELECT descrizione FROM tipo_report WHERE id='.$tipo ;
    
    $result = [];

  $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        $result = $result['descrizione'];
        
      }
    return $result;


}
function getTipiReport(){
    /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tipo_report';


  $records = [];

  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

  return $records;



}
function getIstanza(int $id){

    /**
     * @var $conn mysqli
     */
  
      $conn = $GLOBALS['mysqli'];
        $result=[];
        $sql ='SELECT * FROM istanza WHERE id_RAM = '.$id;
        //echo $sql;
        $res = $conn->query($sql);
        
        if($res && $res->num_rows){
          $result = $res->fetch_assoc();
          
        }
      return $result;
    
    
}
function getUserIns(){
        /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT distinct(user_ins) FROM report where attivo=1';


  $records = [];

  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row['user_ins'];
        
    }

  }

  return $records;


}