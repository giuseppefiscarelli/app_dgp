<?php
function countIstanze( array $params = []){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

      $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'id';
      $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
      $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
      $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
      $search1 = $conn->escape_string($search1);
      $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
      $search2 = $conn->escape_string($search2);
      $search3 = array_key_exists('search3', $params) ? $params['search3'] : '';
      $search3 = $conn->escape_string($search3);
      $search4 = array_key_exists('search4', $params) ? $params['search4'] : '';
      $search4 = $conn->escape_string($search4);
      $search5 = array_key_exists('search5', $params) ? $params['search5'] : '';
      $search5 = $conn->escape_string($search5);
      if($orderDir !=='ASC' && $orderDir !=='DESC'){
        $orderDir = 'ASC';
      }
      $now=date("Y-m-d H:i:s");
      $totalUser = 0;
      if ($search3){
        $tipo= getTipoIstanza($search3);
        $data_inizio = $tipo['data_invio_inizio'];
        $data_fine = $tipo['data_invio_fine'];
        $data_rend_inizio = $tipo['data_rendicontazione_inizio'];
        $data_rend_fine = $tipo['data_rendicontazione_fine'];

      
       }
      if($search4){

        if($search4=='A'&&$data_rend_fine>$now){
          $parA = ' and istanza.id_RAM not in( SELECT id_RAM FROM `rendicontazione`)';
        }
        if($search4=='B'){
          $parA = ' and istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE data_annullamento IS NOT NULL)';
        }
        /*
        if($search4=='B'&&$data_rend_fine<$now){
          $parA = ' and istanza.id_RAM  not in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=0 and data_chiusura IS NOT NULL)';
        }
        */
        if($search4=='C'&&$data_rend_fine>$now){
          $parA = ' and istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=1 and data_chiusura IS NULL and data_annullamento IS NULL)';
        }
        if(($search4=='A'||$search4=='C')&&$data_rend_fine<$now){
           $parA = ' and istanza.id_RAM =0';

        }
        if($search4=='D'){
          $parA = ' and istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=0 and data_chiusura IS NOT NULL and data_annullamento IS NULL)';
        }
        if($search4=='E'&&$data_rend_fine>$now){
          $parA = ' and istanza.id_RAM =0';
        }
        if($search4=='E'&&$data_rend_fine<$now){
          $parA = ' and (istanza.id_RAM in( SELECT id_RAM FROM `rendicontazione` WHERE aperta=1 and data_chiusura IS NULL and data_annullamento IS NULL) OR istanza.id_RAM not in( SELECT id_RAM FROM `rendicontazione`))';

        }

      }
      if($search5){
        if($search5 === 'A'){
          $parB = " and istanza.id_RAM in( SELECT id_RAM FROM `report` WHERE id_RAM=istanza.id_RAM and tipo_report=1 and  data_invio = (select max(data_invio)  FROM report WHERE id_RAM = istanza.id_RAM and stato = 'C'))";
        }
        if($search5 === 'B'){
          $parB = " and istanza.id_RAM in( SELECT id_RAM FROM `report` WHERE id_RAM=istanza.id_RAM and tipo_report=2 and  data_invio = (select max(data_invio)  FROM report WHERE id_RAM = istanza.id_RAM and stato = 'C'))";

        }
        if($search5 === 'C'){
          $parB = " and istanza.id_RAM in( SELECT id_RAM FROM `report` WHERE id_RAM=istanza.id_RAM and tipo_report=3 and  data_invio = (select max(data_invio)  FROM report WHERE id_RAM = istanza.id_RAM and stato = 'C'))";

        }
        if($search5 === 'D'){
          $parB = " and istanza.id_RAM in( SELECT id_RAM FROM `report` WHERE id_RAM=istanza.id_RAM and tipo_report=4 and  data_invio = (select max(data_invio)  FROM report WHERE id_RAM = istanza.id_RAM and stato = 'C'))";

        }
      }
      
      
      
     // $sql ="SELECT count(*) as totalUser FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and  istanza.eliminata !='1' ";
     $sql ="SELECT count(*) as totalUser FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id  ";

     //$sql ="SELECT count(*) as totalUser, istanza.id_RAM FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and (istanza.eliminata is null or trim(eliminata) = '' or istanza.eliminata='2') ";
     $sql .=" and istanza.eliminata != '1'"; 
     if ($search1){
        $sql .=" AND xml.pec LIKE '%$search1%' ";
        
      }
      if ($search2){
          $sql .=" AND istanza.id_RAM LIKE '%$search2%' ";
          
        }
        if ($search3){
          $sql .=" and xml.data_invio between '$data_inizio' and '$data_fine'";
          $sql .=" AND istanza.tipo_istanza = $search3 ";
          
        }
        if($search4){
          $sql .= $parA;
        }
        if($search5){
          $sql .= $parB;
        }
        //echo $sql;
      
      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $totalUser = $row['totalUser'];
      }

  return $totalUser;

}

function countTotIstanze( array $params = []){

    /**
     * @var $conn mysqli
     */
  
        $conn = $GLOBALS['mysqli'];
  
        $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'id';
        $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
        $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
        $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
        $search1 = $conn->escape_string($search1);
        $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
        $search2 = $conn->escape_string($search2);
        if($orderDir !=='ASC' && $orderDir !=='DESC'){
          $orderDir = 'ASC';
        }
        $totalUser = 0;
  
        
  
        $sql ="SELECT count(*) as totalUser FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id ";
        if ($search1){
          $sql .=" AND xml.pec LIKE '%$search1%' ";
          
        }
        if ($search2){
            $sql .=" AND istanza.id_RAM LIKE '%$search2%' ";
            
          }
        
  
        $res = $conn->query($sql);
        if($res) {
  
         $row = $res->fetch_assoc();
         $totalUser = $row['totalUser'];
        }
  
    return $totalUser;
  
}

function getIstanze( array $params = []){

    /**
     * @var $conn mysqli
     */

        $conn = $GLOBALS['mysqli'];

        $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'data_invio';
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

        

        $sql ="SELECT * FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and (istanza.eliminata is null or trim(eliminata) = '') and xml.data_invio between '2020-10-01 10:00:00' and '2020-11-16 08:00:00'";
        if ($search1){
          $sql .=" AND xml.pec LIKE '%$search1%' ";
          
        }
        if ($search2){
            $sql .=" AND istanza.id_RAM LIKE '%$search2%' ";
            
          }
        $sql .= " ORDER BY xml.data_invio  $orderDir LIMIT $start, $limit";
        //echo $sql;

        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

    return $records;

}
function countRendicontazione($stato){

    /**
     * @var $conn mysqli
     */
  
        $conn = $GLOBALS['mysqli'];
  
      
        $total = 0;
  
        
  
        $sql = 'SELECT count(*) as total FROM rendicontazione';
  
            $sql .=" WHERE aperta = $stato ";
         
      
           // echo $sql;
        
  
        $res = $conn->query($sql);
        if($res) {
  
         $row = $res->fetch_assoc();
         $total = $row['total'];
        }
        return $total;
  
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
    //$search3 = array_key_exists('search3', $params) ? $params['search3'] : '';
    $search3 = $conn->escape_string($search3);
    $search4 = array_key_exists('search4', $params) ? $params['search4'] : '';
    $search4 = $conn->escape_string($search4);
    var_dump($search3);
    if($orderDir !=='ASC' && $orderDir !=='DESC'){
      $orderDir = 'ASC';
    }
    $records = [];

    $totalUser=0;

    $sql ="SELECT count(*) as totalMsg FROM comunicazioni ";
    if($search1||$search2||$search3 ||$search4){
        $sql .=" where";
    }
    if ($search1){
      $sql .=" user_ins LIKE '%$search1%' ";
      if($search2||$search3 ||$search4 ){
          $sql .="AND";
      }
      
    }
    if ($search2){
        $sql .=" id_RAM LIKE '%$search2%' ";
        if($search3 ||$search4 ){
            $sql .="AND";
        }
        
      }
      if ($search3 ){
        $sql .=" read_msg = '$search3' ";
        if($search4 ){
            $sql .="AND";
        }
        
      }
      if ($search4 ){
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
function countTicket(){

    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $totalUser=0;

    $sql ="SELECT count(*) as totalMsg FROM comunicazioni ";
  

        $res = $conn->query($sql);
        if($res) {

         $row = $res->fetch_assoc();
         $totalUser = $row['totalMsg'];
        }

    return $totalUser;

}
function countnewTicket(){

    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $totalUser=0;

    $sql ="SELECT count(*) as totalMsg FROM comunicazioni where read_msg=false";
  

        $res = $conn->query($sql);
        if($res) {

         $row = $res->fetch_assoc();
         $totalUser = $row['totalMsg'];
        }

    return $totalUser;

}
function countreadTicket(){

    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $totalUser=0;

    $sql ="SELECT count(*) as totalMsg FROM comunicazioni where read_msg=true and risolto=false ";
  

        $res = $conn->query($sql);
        if($res) {

         $row = $res->fetch_assoc();
         $totalUser = $row['totalMsg'];
        }

    return $totalUser;

}
function countcloseTicket(){

    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $totalUser=0;

    $sql ="SELECT count(*) as totalMsg FROM comunicazioni where risolto = true";
  

        $res = $conn->query($sql);
        if($res) {

         $row = $res->fetch_assoc();
         $totalUser = $row['totalMsg'];
        }

    return $totalUser;

}
function getTipoIstanza($tipo_istanza){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $result=[];
  $sql ='SELECT * FROM tipo_istanza WHERE id = '.$tipo_istanza;
  //echo $sql;
  $res = $conn->query($sql);
  
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;
}
function getTipiIstanza(){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $records=[];
  $sql ='SELECT * FROM tipo_istanza ';
  //echo $sql;
  $res = $conn->query($sql);
        
       
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

  return $records;
}