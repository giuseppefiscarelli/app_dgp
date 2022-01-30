<?php
function deleteArmatore(int $id){

    /**
     * @var $conn mysqli
     */

      $conn = $GLOBALS['mysqli'];

        $sql ='DELETE FROM armatore WHERE id = '.$id;

        $res = $conn->query($sql);
        
        return $res && $conn->affected_rows;
    
    
}
function getArmatore(int $id){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $sql ='SELECT * FROM armatore WHERE id = '.$id;
      //echo $sql;
      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}
function getArmatori(array $params = []){

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
      $orderDir = 'DESC';
    }
    $records = [];

    

    $sql ="SELECT * FROM armatore ";
    if($search1){
        $sql .=" where";
    }
    if ($search1){
      $sql .=" arm_rag_soc LIKE '%$search1%' ";
      if($search2){
          $sql .="AND";
      }
      
    }
  
   // $sql .= " ORDER BY data_ins  $orderDir LIMIT $start, $limit";
    $sql .= " ORDER BY data_agg  $orderDir LIMIT $start, $limit ";
   

    $res = $conn->query($sql);
    if($res) {

      while( $row = $res->fetch_assoc()) {
          $records[] = $row;
          
      }

    }

    return $records;

}
function getArmatoriCSV(array $params = []){

    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'data_ins';
    $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
   
    $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
    $search1 = $conn->escape_string($search1);
    $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
    $search2 = $conn->escape_string($search2);
    if($orderDir !=='ASC' && $orderDir !=='DESC'){
      $orderDir = 'DESC';
    }
    $records = [];

    

    $sql ="SELECT * FROM armatore ";
    if($search1){
        $sql .=" where";
    }
    if ($search1){
      $sql .=" arm_rag_soc LIKE '%$search1%' ";
      if($search2){
          $sql .="AND";
      }
      
    }
  
   // $sql .= " ORDER BY data_ins  $orderDir LIMIT $start, $limit";
    $sql .= " ORDER BY data_agg  $orderDir ";
   

    $res = $conn->query($sql);
    if($res) {

      while( $row = $res->fetch_assoc()) {
          $records[] = $row;
          
      }

    }

    return $records;

}
function countArmatori( array $params = []){

    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'data_agg';
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

    $totalUser=0;

    $sql ="SELECT count(*) as totalArmatori FROM armatore ";
    if($search1||$search2){
        $sql .=" where";
    }
    if ($search1){
    $sql .=" arm_rag_soc LIKE '%$search1%' ";
    
    
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
    $sql .= " ORDER BY data_agg  $orderDir LIMIT $start, $limit";

   // echo $sql;    

        $res = $conn->query($sql);
        if($res) {

        $row = $res->fetch_assoc();
        $totalUser = $row['totalArmatori'];
        }

    return $totalUser;

}
function updateArmatore(array $data, int $id){ 

    /**
     * @var $conn mysqli
     */
  
      $conn = $GLOBALS['mysqli'];
        
        
        
        $arm_rag_soc = array_key_exists('arm_rag_soc', $data) ? $data['arm_rag_soc'] : '';
        $arm_rag_soc= $conn->escape_string($arm_rag_soc);
  
        $arm_cf = array_key_exists('arm_cf', $data) ? $data['arm_cf'] : '';
        $arm_cf= $conn->escape_string($arm_cf);
  
        $arm_indirizzo = array_key_exists('arm_indirizzo', $data) ? $data['arm_indirizzo'] : '';
        $arm_indirizzo= $conn->escape_string($arm_indirizzo);
  
        $arm_cap = array_key_exists('arm_cap', $data) ? $data['arm_cap'] : '';
        $arm_cap= $conn->escape_string($arm_cap);
  
        $arm_citta = array_key_exists('arm_citta', $data) ? $data['arm_citta'] : '';
        $arm_citta= $conn->escape_string($arm_citta);
        
        $arm_prov = array_key_exists('arm_prov', $data) ? $data['arm_prov'] : '';
        $arm_prov= $conn->escape_string($arm_prov);
  
        $arm_cod_naz = array_key_exists('arm_cod_naz', $data) ? $data['arm_cod_naz'] : '';
        $arm_cod_naz= $conn->escape_string($arm_cod_naz);
       
  
        $arm_telefono = array_key_exists('arm_telefono', $data) ? $data['arm_telefono'] : '';
        $arm_telefono= $conn->escape_string($arm_telefono);
  
        $arm_email = array_key_exists('arm_email', $data) ? $data['arm_email'] : '';
        $arm_email= $conn->escape_string($arm_email);
  
        $arm_note = array_key_exists('arm_note', $data) ? $data['arm_note'] : '';
        $arm_note= $conn->escape_string($arm_note);
        
        $data_agg = date("Y-m-d H:i:s");
  
        $user = $_SESSION['userData']['username'];
  
        $result=0;
        $sql ='UPDATE armatore SET ';
  
  
  
        $sql .= " arm_rag_soc='$arm_rag_soc	',";
        $sql .= " arm_cf='$arm_cf',";
        $sql .= " arm_indirizzo='$arm_indirizzo',";
        $sql .= " arm_cap='$arm_cap',";
        $sql .= " arm_citta='$arm_citta',";
        $sql .= " arm_prov='$arm_prov',";
        $sql .= " arm_cod_naz='$arm_cod_naz',";
        $sql .= " arm_telefono='$arm_telefono',";
        $sql .= " arm_email=' $arm_email',";
        $sql .= " arm_note='$arm_note',";
        $sql .= " data_agg='$data_agg',";
        $sql .= " user='$user'";
        $sql .=' WHERE id = '.$id;
      
        $res = $conn->query($sql);
     
        if($res ){
          $result =  $conn->affected_rows;
          
        }else{
          $result -1;  
        }
      return $result;
    
    
}
function insertArmatore(array $data, int $id){ 

    /**
     * @var $conn mysqli
     */
  
      $conn = $GLOBALS['mysqli'];
        
        
        
        $arm_rag_soc = array_key_exists('arm_rag_soc', $data) ? $data['arm_rag_soc'] : '';
        $arm_rag_soc= $conn->escape_string($arm_rag_soc);
  
        $arm_cf = array_key_exists('arm_cf', $data) ? $data['arm_cf'] : '';
        $arm_cf= $conn->escape_string($arm_cf);
  
        $arm_indirizzo = array_key_exists('arm_indirizzo', $data) ? $data['arm_indirizzo'] : '';
        $arm_indirizzo= $conn->escape_string($arm_indirizzo);
  
        $arm_cap = array_key_exists('arm_cap', $data) ? $data['arm_cap'] : '';
        $arm_cap= $conn->escape_string($arm_cap);
  
        $arm_citta = array_key_exists('arm_citta', $data) ? $data['arm_citta'] : '';
        $arm_citta= $conn->escape_string($arm_citta);
        
        $arm_prov = array_key_exists('arm_prov', $data) ? $data['arm_prov'] : '';
        $arm_prov= $conn->escape_string($arm_prov);
  
        $arm_cod_naz = array_key_exists('arm_cod_naz', $data) ? $data['arm_cod_naz'] : '';
        $arm_cod_naz= $conn->escape_string($arm_cod_naz);
       
  
        $arm_telefono = array_key_exists('arm_telefono', $data) ? $data['arm_telefono'] : '';
        $arm_telefono= $conn->escape_string($arm_telefono);
  
        $arm_email = array_key_exists('arm_email', $data) ? $data['arm_email'] : '';
        $arm_email= $conn->escape_string($arm_email);
  
        $arm_note = array_key_exists('arm_note', $data) ? $data['arm_note'] : '';
        $arm_note= $conn->escape_string($arm_note);
  
        
        $data_agg = date("Y-m-d H:i:s");
  
        $user = $_SESSION['userData']['username'];

  
        $result=0;
        $sql ='INSERT INTO armatore (id, arm_rag_soc, arm_cf, arm_indirizzo, arm_cap, arm_citta, arm_prov, arm_cod_naz, arm_telefono, arm_email, arm_note, data_agg, user) ';
        $sql .= "VALUES (NULL, '$arm_rag_soc', '$arm_cf', '$arm_indirizzo', '$arm_cap', '$arm_citta', '$arm_prov', '$arm_cod_naz', '$arm_telefono', '$arm_email', '$arm_note', '$data_agg', '$user' )";

      
        $res = $conn->query($sql);
     
        if($res ){
          $result =  $conn->affected_rows;
          
        }else{
          $result -1;  
        }
      return $result;
    
    
}
function getNazioni(){

    /**
     * @var $conn mysqli
     */
      $conn = $GLOBALS['mysqli'];
      $records = [];
      $sql ="SELECT * FROM paese";
        //echo $sql;
        $res = $conn->query($sql);
        
       
        if($res) {
  
          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }
  
        }
  
    return $records;
    
    
  }