<?php
function deleteProprietario(int $id){

    /**
     * @var $conn mysqli
     */

      $conn = $GLOBALS['mysqli'];

        $sql ='DELETE FROM armatore WHERE id = '.$id;

        $res = $conn->query($sql);
        
        return $res && $conn->affected_rows;
    
    
}
function getProprietario(int $id){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $sql ='SELECT * FROM proprietario WHERE id = '.$id;
      //echo $sql;
      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}
function getProprietari(array $params = []){

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

    

    $sql ="SELECT * FROM proprietario ";
    if($search1){
        $sql .=" where";
    }
    if ($search1){
      $sql .=" prp_rag_soc LIKE '%$search1%' ";
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
function getProprietariCSV(array $params = []){

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

    

    $sql ="SELECT * FROM proprietario ";
    if($search1){
        $sql .=" where";
    }
    if ($search1){
      $sql .=" prp_rag_soc LIKE '%$search1%' ";
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
function countProprietari( array $params = []){

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

    $sql ="SELECT count(*) as totalProprietari FROM proprietario ";
    if($search1||$search2){
        $sql .=" where";
    }
    if ($search1){
    $sql .=" prp_rag_soc LIKE '%$search1%' ";
    
    
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
        $totalUser = $row['totalProprietari'];
        }

    return $totalUser;

}
function updateProprietario(array $data, int $id){ 

    /**
     * @var $conn mysqli
     */
  
      $conn = $GLOBALS['mysqli'];
        
        
        
        $prp_rag_soc = array_key_exists('prp_rag_soc', $data) ? $data['prp_rag_soc'] : '';
        $prp_rag_soc= $conn->escape_string($prp_rag_soc);
  
        $prp_cf = array_key_exists('prp_cf', $data) ? $data['prp_cf'] : '';
        $prp_cf= $conn->escape_string($prp_cf);
  
        $prp_indirizzo = array_key_exists('prp_indirizzo', $data) ? $data['prp_indirizzo'] : '';
        $prp_indirizzo= $conn->escape_string($prp_indirizzo);
  
        $prp_cap = array_key_exists('prp_cap', $data) ? $data['prp_cap'] : '';
        $prp_cap= $conn->escape_string($prp_cap);
  
        $prp_citta = array_key_exists('prp_citta', $data) ? $data['prp_citta'] : '';
        $prp_citta= $conn->escape_string($prp_citta);
        
        $prp_prov = array_key_exists('prp_prov', $data) ? $data['prp_prov'] : '';
        $prp_prov= $conn->escape_string($prp_prov);
  
        $prp_cod_naz = array_key_exists('prp_cod_naz', $data) ? $data['prp_cod_naz'] : '';
        $prp_cod_naz= $conn->escape_string($prp_cod_naz);
       
  
        $prp_telefono = array_key_exists('prp_telefono', $data) ? $data['prp_telefono'] : '';
        $prp_telefono= $conn->escape_string($prp_telefono);
  
        $prp_email = array_key_exists('prp_email', $data) ? $data['prp_email'] : '';
        $prp_email= $conn->escape_string($prp_email);
  
        $prp_note = array_key_exists('prp_note', $data) ? $data['prp_note'] : '';
        $prp_note= $conn->escape_string($prp_note);
  
        $data_agg = date("Y-m-d H:i:s");
  
        $user = $_SESSION['userData']['username'];
  
       
  
  
        $result=0;
        $sql ='UPDATE proprietario SET ';
  
  
  
        $sql .= " prp_rag_soc='$prp_rag_soc	',";
        $sql .= " prp_cf='$prp_cf',";
        $sql .= " prp_indirizzo='$prp_indirizzo',";
        $sql .= " prp_cap='$prp_cap',";
        $sql .= " prp_citta='$prp_citta',";
        $sql .= " prp_prov='$prp_prov',";
        $sql .= " prp_cod_naz='$prp_cod_naz',";
        $sql .= " prp_telefono='$prp_telefono',";
        $sql .= " prp_email=' $prp_email',";
        $sql .= " prp_note='$prp_note',";
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
function insertProprietario(array $data, int $id){ 

    /**
     * @var $conn mysqli
     */
  
      $conn = $GLOBALS['mysqli'];
        
        
        
        $prp_rag_soc = array_key_exists('prp_rag_soc', $data) ? $data['prp_rag_soc'] : '';
        $prp_rag_soc= $conn->escape_string($prp_rag_soc);
  
        $prp_cf = array_key_exists('prp_cf', $data) ? $data['prp_cf'] : '';
        $prp_cf= $conn->escape_string($prp_cf);
  
        $prp_indirizzo = array_key_exists('prp_indirizzo', $data) ? $data['prp_indirizzo'] : '';
        $prp_indirizzo= $conn->escape_string($prp_indirizzo);
  
        $prp_cap = array_key_exists('prp_cap', $data) ? $data['prp_cap'] : '';
        $prp_cap= $conn->escape_string($prp_cap);
  
        $prp_citta = array_key_exists('prp_citta', $data) ? $data['prp_citta'] : '';
        $prp_citta= $conn->escape_string($prp_citta);
        
        $prp_prov = array_key_exists('prp_prov', $data) ? $data['prp_prov'] : '';
        $prp_prov= $conn->escape_string($prp_prov);
  
        $prp_cod_naz = array_key_exists('prp_cod_naz', $data) ? $data['prp_cod_naz'] : '';
        $prp_cod_naz= $conn->escape_string($prp_cod_naz);
       
  
        $prp_telefono = array_key_exists('prp_telefono', $data) ? $data['prp_telefono'] : '';
        $prp_telefono= $conn->escape_string($prp_telefono);
  
        $prp_email = array_key_exists('prp_email', $data) ? $data['prp_email'] : '';
        $prp_email= $conn->escape_string($prp_email);
  
        $prp_note = array_key_exists('prp_note', $data) ? $data['prp_note'] : '';
        $prp_note= $conn->escape_string($prp_note);
  
        $data_agg = date("Y-m-d H:i:s");
  
        $user = $_SESSION['userData']['username'];
  
  
       
  
  
        $result=0;
        $sql ='INSERT INTO proprietario (id, prp_rag_soc, prp_cf, prp_indirizzo, prp_cap, prp_citta, prp_prov, prp_cod_naz, prp_telefono, prp_email, prp_note, data_agg, user) ';
        $sql .= "VALUES (NULL, '$prp_rag_soc', '$prp_cf', '$prp_indirizzo', '$prp_cap', '$prp_citta', '$prp_prov', '$prp_cod_naz', '$prp_telefono', '$prp_email', '$prp_note', '$data_agg', '$user' )";

       
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