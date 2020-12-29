<?php
function delete(int $id){

    /**
     * @var $conn mysqli
     */

      $conn = $GLOBALS['mysqli'];

        $sql ='DELETE FROM istanza WHERE id = '.$id;

        $res = $conn->query($sql);
        
        return $res && $conn->affected_rows;
    
    
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
function getIstanzaUser($email){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
    $result = [];
      $sql ="SELECT * FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and '$email' = xml.pec and (istanza.eliminata is null or trim(eliminata) = '') and xml.data_invio between '2020-10-01 10:00:00' and '2020-11-16 08:00:00'";
      //echo $sql;
      $res = $conn->query($sql);
      
     
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}
function getIstanzeUser($email){

    /**
     * @var $conn mysqli
     */
  
      $conn = $GLOBALS['mysqli'];
      $records = [];
      $sql ="SELECT * FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and '$email' = xml.pec and (istanza.eliminata is null or trim(eliminata) = '') and xml.data_invio between '2020-10-01 10:00:00' and '2020-11-16 08:00:00'";
        //echo $sql;
        $res = $conn->query($sql);
        
       
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

    return $records;
    
    
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
        if($orderDir !=='ASC' && $orderDir !=='DESC'){
          $orderDir = 'ASC';
        }
        $totalUser = 0;

        

        $sql ="SELECT count(*) as totalUser FROM istanza INNER JOIN xml on istanza.pec_msg_identificativo = xml.identificativo and istanza.pec_msg_id = xml.msg_id and (istanza.eliminata is null or trim(eliminata) = '') and xml.data_invio between '2020-10-01 10:00:00' and '2020-11-16 08:00:00'";
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
function getCatInc(){
  
    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $sql = 'SELECT * FROM categoria_incentivo';
    
    
    $records = [];

    $res = $conn->query($sql);
    if($res) {

      while( $row = $res->fetch_assoc()) {
          $records[] = $row;
          
      }

    }

   return $records;



}
function getCategoria($cod){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = "SELECT * FROM categoria_incentivo where ctgi_codice = '$cod'";
  
  
  $result = [];

  $res = $conn->query($sql);
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;



}
function getTipoVei($cat){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tipo_veicolo where codice_categoria_incentivo='.$cat.' order BY tpvc_codice ASC';
  
  
  $records = [];

  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

 return $records;



}
function checkRend($idRam){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $result=[];
  $sql ='SELECT * FROM rendicontazione WHERE id_RAM = '.$idRam;
  //echo $sql;
  $res = $conn->query($sql);
  
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;

}
function createSrtructure($data){
  /**
   * @var $conn mysqli
   */
    //var_dump($data);
  $conn = $GLOBALS['mysqli'];

  $tip_vei_1=$data['nv1'];
  $tip_vei_2=$data['nv2'];
  $tip_vei_3=$data['nv3'];
  $tip_vei_4=$data['nv4'];
  $tip_vei_5=$data['nv5'];
  $tip_vei_6=$data['nv6'];
  $tip_vei_7=$data['nv7'];
  $tip_vei_8=$data['nv8'];
  $tip_vei_9=$data['nv9'];
  $tip_vei_10=$data['nv10'];
  $tip_vei_11=$data['nv11'];
  $tip_vei_12=min($data['r_nv_1'],$data['r_rott_1']);
  $tip_vei_13=min($data['r_nv_2'],$data['r_rott_2']);
  $tip_vei_14=min($data['r_nv_3'],$data['r_rott_3']);
  $tip_vei_15=$data['nr_1'];
  $tip_vei_16=$data['nr_2'];
  $tip_vei_17=$data['ng_1'];

 for ($i = 1; $i<=17;++$i){
      $tipo = "tip_vei_$i";
      //$tipo = intval($tipo);
      //var_dump($$tipo);
       //echo $$tipo;
       
       //echo "cat ".$i."<br>";
       $vei = intval($$tipo);
       if($vei>0){
            for($v=1;$v<=$vei;++$v){
              $tpvc= getTipoVeicolo($i);
              //var_dump($tpvc['tpvc_codice']);
              $tpvc_codice=$tpvc['tpvc_codice'];
              //echo 'progressivo #'.$v. "tipo ".$tpvc_codice."id_ram ".$data['id_RAM']."<br>";
              insertStrAlle($v,$tpvc_codice,$data['id_RAM']);
            }

       }
      
 }

      $result=0;
      $id_RAM=$data['id_RAM'];
      $user=getUserLoggedEmail();
      $sql ='INSERT INTO rendicontazione (id, id_RAM, aperta,user) ';
      $sql .= "VALUES (NULL, $id_RAM, 1,'$user') ";
      
     // echo $sql;
      $res = $conn->query($sql);
      
      if($res ){
        $result =  $conn->affected_rows;
        $log=[];
        $log['user']['email']=$_SESSION['userData']['email'];
        $log['log_funzione']="Apertura Rendicontazione";
        $log['message']="Primo Accesso";
        $log['success']=true;
        writelog($log);

        
      }else{
        $result -1;  
      }
    return $result;
    //echo($result);die;

 

  

}
function getTipoVeicolo($tipo){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tipo_veicolo WHERE tpvc_codice='.$tipo ;
  
  
  $result = [];

  $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;




}
function insertStrAlle($prog,$tipo,$idram){
    /**
     * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

    $result=0;
    $sql ='INSERT INTO veicolo (id, id_RAM, tipo_veicolo, progressivo) ';
    $sql .= "VALUES (NULL, $idram, '$tipo', $prog) ";
    
    //echo $sql;die;
    $res = $conn->query($sql);
    
    if($res ){
      $result =  $conn->affected_rows;
      
    }else{
      $result -1;  
    }
  return $result;


}
function countCatVei( $cat,$id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $total = 0;

      

      $sql = 'SELECT count(*) as total FROM veicolo';

          $sql .=" WHERE tipo_veicolo = $cat and id_RAM = $id_RAM";
       
    
        //  echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $total = $row['total'];
      }
      return $total;

}
function countCatVeiTipoac( $cat,$id_RAM,$progressivo){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $result = [];

      

      $sql = 'SELECT *  FROM veicolo';

          $sql .=" WHERE tipo_veicolo = $cat and id_RAM = $id_RAM and tipo_acquisizione='01' and progressivo = $progressivo";
       
    
        //  echo $sql;
      
        $res = $conn->query($sql);
      
        if($res && $res->num_rows){
          $result = $res->fetch_assoc();
          
        }
      return $result;

}
function checkTipVei($codice){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

    
  $total = 0;
  
  $sql = 'SELECT tpvc_codice as totalUser FROM tipo_veicolo';

  $sql .=" WHERE codice_categoria_incentivo = $cat ";


 // echo $sql;


  $res = $conn->query($sql);
  if($res) {

  $row = $res->fetch_assoc();
  $totalUser = $row['totalUser'];
  }

}
function getRowVeicolo($tipo,$id_RAM){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM veicolo WHERE tipo_veicolo='.$tipo.' and id_RAM = '.$id_RAM.' Order BY progressivo ASC' ;
  $records = [];
  //echo $sql;
  
  $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

    return $records;



}
function getTipoDocumento($cod){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tv_td where codice_tipo_veicolo='.$cod;
  //echo $sql;
  $records = [];
 
  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
       
       
             
    }

  }
    
  

 return $records;


}
function getTipDocumento($tipo_documento){ 
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tipo_documento where tdoc_codice='.$tipo_documento;
  //echo $sql;
  $records = [];

  $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

    return $records;


}
function getTipDoc($tipo_documento){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT tdoc_descrizione as descrizione FROM tipo_documento where tdoc_codice='.$tipo_documento;
  //echo $sql;
  $des = 0;

  $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $des = $row['descrizione'];
      }
      return $des;


}
function getCampoDoc($tipo_documento){
   /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  
  $sql = 'SELECT * FROM td_campi WHERE cod_documento ='.$tipo_documento;
  //echo $sql;
  $records = [];

  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

 return $records;



}
function getAllegato($tipo_documento,$id_RAM,$id_veicolo){
    /**
    * @var $conn mysqli
    */

  $conn = $GLOBALS['mysqli'];
  
  $sql = 'SELECT * FROM allegato WHERE tipo_documento ='.$tipo_documento.' and id_ram ='.$id_RAM.' and attivo ="s"';
  //echo $sql;
  $result = [];

  $res = $conn->query($sql);
      
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;



}
function getAllegatoID($id){
  /**
  * @var $conn mysqli
  */

    $conn = $GLOBALS['mysqli'];

    $sql = 'SELECT * FROM allegato WHERE id ='.$id;
    //echo $sql;
    $result = [];

    $res = $conn->query($sql);
          
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;



}
function delAllegatoID($id){
  /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $result=0;
  
  $sql ='UPDATE allegato SET ';
  $sql .= "attivo = 'c'";
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
function getAllegati($id_RAM,$tipo_veicolo,$progressivo){
  /**
  * @var $conn mysqli
  */

  $conn = $GLOBALS['mysqli'];
  
  $sql = 'SELECT * FROM allegato WHERE id_ram ='.$id_RAM.' and tipo_veicolo ='.$tipo_veicolo.' and progressivo='.$progressivo.' and attivo="s" ';
  //echo $sql;
  $records = [];

  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

  return $records;



}
function upVeicolo($data){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $id = $conn->escape_string($data['id']);
 
  $targa = $conn->escape_string($data['targa']);
  $marca = $conn->escape_string($data['marca']);
  $modello = $conn->escape_string($data['modello']);
  $tipo_acquisizione = $conn->escape_string($data['tipo']);
  $costo = $conn->escape_string($data['costo']);
  $user = $_SESSION['userData']['email'];
 


  $result=0;
  $sql ='UPDATE veicolo SET ';
  $sql .= "targa = '$targa', marca = '$marca', modello = '$modello', tipo_acquisizione = '$tipo_acquisizione', costo = $costo, user = '$user'";
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
function newAllegato($data){
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $id_ram = $conn->escape_string($data['id_RAM']);
  $tipo_veicolo = $conn->escape_string($data['tipo_veicolo']);
  if(!$tipo_veicolo){
    $tipo_veicolo = 0;
  }
  $progressivo = $conn->escape_string($data['progressivo']);
  if(!$progressivo){
    $progressivo = 0;
  }
  $tipo_documento = $conn->escape_string($data['tipo_documento']);
  $docu_nome_file_origine =  $conn->escape_string($data['docu_nome_file_origine']);
  $path_parts = pathinfo($docu_nome_file_origine);
  $docu_id_file_archivio = $conn->escape_string($data['docu_id_file_archivio']);
  $json_data = array_key_exists('json_data', $data)? $data['json_data']:'';
  
  $note = array_key_exists('note_allegato', $data)? addslashes($data['note_allegato']):' ';
  $attivo ="s";
  $user = $_SESSION['userData']['email'];

  $result=0;
  $sql ='INSERT INTO allegato (id,id_ram,tipo_veicolo,progressivo,tipo_documento,docu_nome_file_origine,docu_id_file_archivio,note,attivo,user,json_data) ';
  $sql .= "VALUES (NULL,$id_ram,$tipo_veicolo,$progressivo,$tipo_documento,'$docu_nome_file_origine','$docu_id_file_archivio','$note','$attivo','$user','$json_data')  ";
  
  //echo $sql;die;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
   // move_uploaded_file($file['tmp_name'],$pathAlle.$docu_id_file_archivio);

    $last_id= mysqli_insert_id($conn);
    
  }else{
    $last_id=0;  
  }
  return $last_id;




}
function getInfoVei($id){ 
  /**
  * @var $conn mysqli
  */

    $conn = $GLOBALS['mysqli'];

    $sql = 'SELECT * FROM veicolo WHERE id ='.$id;
    //echo $sql;
    $result = [];

    $res = $conn->query($sql);
          
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
       
        
      }
    return $result;



}
function getInfoVeiData($data){
  /**
  * @var $conn mysqli
  */

    $conn = $GLOBALS['mysqli'];
    $id_RAM= $data['id_RAM'];
    $tipo_veicolo= $data['tipo_veicolo'];
    $progressivo= $data['progressivo'];

    $sql = "SELECT * FROM veicolo WHERE id_RAM =$id_RAM AND tipo_veicolo=$tipo_veicolo and progressivo=$progressivo";
    //echo $sql;
    $result = [];

    $res = $conn->query($sql);
          
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;



}
function countIstanzaVei($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $total = 0;

      

      $sql = 'SELECT count(*) as total FROM veicolo';

          $sql .=" WHERE id_RAM = $id_RAM";
       
    
        //  echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $total = $row['total'];
      }
      return $total;

}
function countIstanzaVeiInfo($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $total = 0;

      

      $sql = 'SELECT count(*) as total FROM veicolo';

          $sql .=" WHERE id_RAM = $id_RAM AND targa IS NOT NULL";
       
    
        //  echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $total = $row['total'];
      }
      return $total;

}
function countDocIstanza($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $records = [];

      

      $sql = 'SELECT * FROM veicolo';

          $sql .=" WHERE id_RAM = $id_RAM";
       
    
        //  echo $sql;
      
        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

   if($records){
    $total = 0;
     foreach($records as $r){
     

      $codice_tipo_veicolo = $r['tipo_veicolo'];

      $sql = 'SELECT count(*) as total FROM tv_td';

          $sql .=" WHERE codice_tipo_veicolo =".$codice_tipo_veicolo;
       
    
         // echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $totalb = $row['total'];
      }
       $total += $totalb;
     



     }
   }
   return $total;

}
function countDocIstanzaInfo($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $records = [];

      

      $sql = 'SELECT * FROM veicolo';

          $sql .=" WHERE id_RAM = $id_RAM";
       
    
        //  echo $sql;
      
        $res = $conn->query($sql);
        if($res) {

          while( $row = $res->fetch_assoc()) {
              $records[] = $row;
              
          }

        }

   if($records){
    $total = 0;
     foreach($records as $r){
     

      $tipo_veicolo = $r['tipo_veicolo'];
      $progressivo = $r['progressivo'];

     
  $sql = 'SELECT count(DISTINCT tipo_documento) as total FROM allegato';

  $sql .=" WHERE id_ram = $id_RAM and tipo_veicolo = $tipo_veicolo and progressivo = $progressivo";
    
         // echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $totalb = $row['total'];
      }
       $total += $totalb;
     



     }
   }
   return $total;

}
function countDocVeicolo($id){

   /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  

    
  $total = 0;

  

  $sql = 'SELECT count(*) as total FROM tv_td';

      $sql .=" WHERE codice_tipo_veicolo = $id";
   

   //  echo $sql;
  

  $res = $conn->query($sql);
  if($res) {

   $row = $res->fetch_assoc();
   $total = $row['total'];
  }
  return $total;

}
function countDocVeicoloInfo($id_RAM,$tipo_veicolo,$progressivo){

   
  /**
   * @var $conn mysqli
   */

            $conn = $GLOBALS['mysqli'];

              
           
              
            $total = 0;

  
      


     
                $sql = 'SELECT count(DISTINCT tipo_documento) as total FROM allegato';

                $sql .=" WHERE id_ram = $id_RAM and tipo_veicolo = $tipo_veicolo and progressivo = $progressivo and attivo='s'";
                //  echo $sql;
                

                $res = $conn->query($sql);
                if($res) {

                $row = $res->fetch_assoc();
                $total = $row['total'];
                
                return $total;

              }
          
}
function getTipoDich($cod){
   /**
  * @var $conn mysqli
  */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tipo_dichiarante WHERE cod_tipo ='.$cod;
  //echo $sql;
  $result = [];

  $res = $conn->query($sql);
        
    if($res && $res->num_rows){
      $result = $res->fetch_assoc();
      
    }
  return $result;




}
function getTipoImpresa($cod){
  /**
 * @var $conn mysqli
 */

 $conn = $GLOBALS['mysqli'];

 $sql = 'SELECT * FROM tipo_impresa WHERE cod_tipo ='.$cod;
 //echo $sql;
 $result = [];

 $res = $conn->query($sql);
       
   if($res && $res->num_rows){
     $result = $res->fetch_assoc();
     
   }
 return $result;




}
function getInfoCampo($cod){
  
    /**
     * @var $conn mysqli
     */
  
    $conn = $GLOBALS['mysqli'];
  
    $sql = 'SELECT * FROM campi_documento WHERE cod_campo='.$cod ;
    
    $result = [];

  $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;

  
  
  
  
  
}
function checkDocTipoVeicolo($tipo,$idRam){
   
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

              
           
              
  $total = 0;






      $sql = 'SELECT count(DISTINCT tipo_documento) as total FROM allegato';

      $sql .=" WHERE id_ram = $idRam and tipo_veicolo = $tipo  and attivo='s'";
      //  echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

      $row = $res->fetch_assoc();
      $total = $row['total'];
      
      return $total;

    }




}
function checkSelectTipoDoc($data){
   /**
  * @var $conn mysqli
  */
 $id_ram=$data['id_ram'];
 
 $tipo_veicolo=$data['tipo_veicolo'];
 $progressivo=$data['progressivo'];
 $tipo_documento=$data['tipo_documento'];

  $conn = $GLOBALS['mysqli'];

  $sql = "SELECT distinct tipo_documento FROM allegato WHERE id_ram =$id_ram and tipo_veicolo=$tipo_veicolo and progressivo=$progressivo and tipo_documento=$tipo_documento and attivo='s'";
  //echo $sql;
  $result = [];

  $res = $conn->query($sql);
        
    if($res && $res->num_rows){
      $result = $res->fetch_assoc();
      
    }
  return $result;




}
function getXml($pec_msg_identificativo,$pec_msg_id){
  /**
  * @var $conn mysqli
  */

  $conn = $GLOBALS['mysqli'];

  $sql = "SELECT * FROM xml WHERE msg_id='$pec_msg_identificativo' and identificativo='$pec_msg_id'";
  //echo $sql;
  $result = [];

  $res = $conn->query($sql);
        
    if($res && $res->num_rows){
      $result = $res->fetch_assoc();
      
    }
  return $result;



}
function closeRend($id_ram){

  /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $result=0;
  $aperta = 0;
  $data_chiusura = date("Y-m-d H:i:s");
  $sql ='UPDATE rendicontazione SET ';
  $sql .= "aperta = '$aperta'";
  $sql .= ", data_chiusura = '$data_chiusura'";
  $sql .=' WHERE id_RAM = '.$id_ram;
  //print_r($data);
 // echo $sql;die;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
    $log=[];
        $log['user']['email']=$_SESSION['userData']['email'];
        $log['log_funzione']="Chiusura Rendicontazione";
        $log['message']="Chiusura";
        $log['success']=true;
        writelog($log);
    
  }else{
    $result -1;  
  }
  return $result;



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
function getVeicoli($id_RAM){
  
  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM veicolo WHERE id_RAM ='.$id_RAM;
 // echo $sql;
  $records = [];

  $res = $conn->query($sql);
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

  return $records;

}
function countVeiIstanza($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $total = 0;

      

      $sql = 'SELECT count(*) as total FROM veicolo';

          $sql .=" WHERE id_RAM = $id_RAM";
       
    
        //  echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $total = $row['total'];
      }
      return $total;

}
function countDocIst($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $total = 0;

      

      $sql = 'SELECT count(*) as total FROM allegato ';

          $sql .=" WHERE id_ram = $id_RAM  and attivo='s' and tipo_documento<90";
       
    
         // echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $total = $row['total'];
      }
      return $total;

}
function countVeiIstanzaCat($id_RAM,$tipo){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $total = 0;

      

      $sql = 'SELECT count(*) as total FROM veicolo INNER JOIN tipo_veicolo as tp on veicolo.tipo_veicolo = tp.tpvc_codice';

          $sql .=" WHERE veicolo.id_RAM =$id_RAM AND tp.codice_categoria_incentivo=$tipo";
       
    
         // echo $sql;
      
         $res = $conn->query($sql);
         if($res) {
   
          $row = $res->fetch_assoc();
          $total = $row['total'];
         }
         return $total;

}
function countDocIstCat($id_RAM,$tipo){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

    
      $total = 0;

      

      $sql = 'SELECT count(*) as total FROM allegato INNER JOIN tipo_veicolo as tp on allegato.tipo_veicolo = tp.tpvc_codice';

          $sql .=" WHERE allegato.id_ram = $id_RAM  and allegato.attivo='s' and allegato.tipo_documento<90 AND tp.codice_categoria_incentivo=$tipo";
       
    
         // echo $sql;
      

      $res = $conn->query($sql);
      if($res) {

       $row = $res->fetch_assoc();
       $total = $row['total'];
      }
      return $total;

}
function getComunicazioni($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

     
      
      $records = [];

      

      $sql ="SELECT * FROM comunicazioni where id_RAM = $id_RAM";
     
      $sql .= " ORDER BY data_ins  DESC ";
      //echo $sql;

      $res = $conn->query($sql);
      if($res) {

        while( $row = $res->fetch_assoc()) {
            $records[] = $row;
            
        }

      }

  return $records;

}
function getTipoComunicazione($tipo){

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
function getNotificheuser($id_RAM){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

      $records = [];

      
    
      $sql ="SELECT * FROM cron_comunicazioni LEFT JOIN comunicazioni on cron_comunicazioni.id_comunicazioni = comunicazioni.id where cron_comunicazioni.read_msg = 0 and cron_comunicazioni.role='admin' and comunicazioni.id_RAM = $id_RAM";
     
      $res = $conn->query($sql);
      if($res) {

        while( $row = $res->fetch_assoc()) {
            $records[] = $row;
            
        }

      }

  return $records;

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
  
  if($res) {

   $row = $res->fetch_assoc();
   $totalUser = $row['totalConv'];
  }

  return $totalUser;


}


