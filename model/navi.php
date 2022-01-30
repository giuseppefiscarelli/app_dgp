<?php

function getNavi($params){

	/*
	 * @var $conn mysqli
     */
    if(!isUserLoggedin()){

      header('Location:index.php');
      exit;
    }



    $conn = $GLOBALS['mysqli'];

  //        $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'data_invio';
    $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
    $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
    $page = (int)array_key_exists('page', $params) ? $params['page'] : 0;
    $start =$limit * ($page -1);
    if($start<0){
      $start = 0;
    }
    $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
    $search1 = $conn->escape_string(trim($search1));

    $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
    $search2 = $conn->escape_string($search2);

    $search3 = array_key_exists('search3', $params) ? $params['search3'] : '';
    $search3 = $conn->escape_string($search3);

    $search4 = array_key_exists('search4', $params) ? $params['search4'] : null;

    if($orderDir !=='ASC' && $orderDir !=='DESC'){
      $orderDir = 'ASC';
    }

//    $orderDir = 'ASC';          //--------- forzo ordinamento ASC
    $records = [];

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------VEDI USER
//    $user = "";
    $user = getUserLoggedEmail();

//    $tutte = " mailbox in (SELECT mailbox FROM user_mailbox WHERE cod_user = '".$user."' ) ";

    $sql ="SELECT nave.*, DATE_FORMAT(nav_data_iscrizione, '%d/%m/%Y') as data_iscrizione, capitaneria.nome, FORMAT(nav_gt, 2,'de_DE') AS gt, FORMAT(nav_nt, 2,'de_DE') AS nt, FORMAT(nav_dwt, 2,'de_DE') AS dwt,  arm_rag_soc, prp_rag_soc FROM nave LEFT JOIN armatore ON armatore.id = nav_id_armatore LEFT JOIN proprietario ON proprietario.id = nav_id_proprietario LEFT JOIN capitaneria ON capitaneria.cod = nav_ufficio_iscrizione";
    $where = "";

    if ($search1){
      $where .=" WHERE (nav_nome LIKE '%$search1%' or arm_rag_soc LIKE '%$search1%' or prp_rag_soc LIKE '%$search1%' ) ";
    }

/*    if (trim($search3) > ''){
     var_dump($search3); die;
    }
*/
    if ($search2 == "tutti"){
//      $caselle = getCaselle();
      $elenco_registri = "'RI', 'RO', 'RS'";
      if ($where){
        $where .= " AND nav_registro IN ( ".$elenco_registri." ) ";
      } else {
        $where .= " WHERE nav_registro IN ( ".$elenco_registri." ) ";
      }

    } else {
      if ($where){
        $where .= " AND nav_registro = '".$search2."' ";
      } else {
        $where .= " WHERE nav_registro = '".$search2."' ";
      }
    }

    if ($search3 <> '999') {
      if ($where){
        $where .= " AND nav_servizio = '".$search3."' ";
      } else {
        $where .= " WHERE nav_servizio = '".$search3."' ";
      }
    }
    if ($search4) {
      if ($where){
        $where .= " AND (nave.nav_data_cancellazione IS NULL OR nave.nav_data_cancellazione ='' )";
      } else {
        $where .= " WHERE (nave.nav_data_cancellazione IS NULL OR trim(nave.nav_data_cancellazione) ='' )";
      }
    }




    $sql .= $where." ORDER BY nav_nome $orderDir LIMIT $start, $limit";

/*
    $ricerca_per_date = "";
    if (trim($search3) && trim($search4)){
      $ricerca_per_date = " giorno BETWEEN '".$search3."' AND '".$search4."' ";
    } else {
      if (trim($search3)) {
        $ricerca_per_date = " NOT giorno < '".$search3."' ";
      } else {
        if (trim($search4)) {
          $ricerca_per_date = " NOT giorno > '".$search4."' ";
        }
      }
    }
    if ($ricerca_per_date){
      if ($where){
        $where .= " AND (".$ricerca_per_date.") ";
      } else {
        $where = " WHERE (".$ricerca_per_date.") ";
      }
    }
*/
/*
    $sql .= $where." ORDER BY giorno, ora $orderDir LIMIT $start, $limit";

    $GLOBALS['where'] = $where;
*/
   //echo $sql;  die;

    $res = $conn->query($sql);
    if($res) {

      while( $row = $res->fetch_assoc()) {
          $records[] = $row;

      }

    }
//    echo "<br>".$sql; die;

//    var_dump($sql);

//    var_dump($records); die;

    return $records;

}


function countNavi($params){

  /**
   * @var $conn mysqli
     */

    $conn = $GLOBALS['mysqli'];

//        $orderBy = array_key_exists('orderBy', $params) ? $params['orderBy'] : 'data_invio';
    $orderDir = array_key_exists('orderDir', $params) ? $params['orderDir'] : 'ASC';
    $limit = (int)array_key_exists('recordsPerPage', $params) ? $params['recordsPerPage'] : 10;
    $page = (int)array_key_exists('page', $params) ? $params['page'] : 0;
    $start =$limit * ($page -1);
    if($start<0){
      $start = 0;
    }

    $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
    $search1 = $conn->escape_string(trim($search1));

    $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
    $search2 = $conn->escape_string($search2);

    $search3 = array_key_exists('search3', $params) ? $params['search3'] : '';
    $search3 = $conn->escape_string($search3);

    $search4 = array_key_exists('search4', $params) ? $params['search4'] : null;








/*
    $search1 = array_key_exists('search1', $params) ? $params['search1'] : '';
    $search1 = $conn->escape_string(trim($search1));

    $search2 = array_key_exists('search2', $params) ? $params['search2'] : '';
    $search2 = $conn->escape_string($search2);

    if($orderDir !=='ASC' && $orderDir !=='DESC'){
      $orderDir = 'ASC';
    }
*/
//    $orderDir = 'ASC';          //--------- forzo ordinamento ASC
    $records = [];


    $user = "";
//    $tutte = " mailbox in (SELECT mailbox FROM user_mailbox WHERE cod_user = '".$user."' ) ";
    $sql ="SELECT COUNT(*) as totalList FROM nave LEFT JOIN armatore ON armatore.id = nav_id_armatore LEFT JOIN proprietario ON proprietario.id = nav_id_proprietario LEFT JOIN capitaneria ON capitaneria.cod = nav_ufficio_iscrizione";

    $where = "";

    if ($search1){
      $where .=" WHERE (nav_nome LIKE '%$search1%' or arm_rag_soc LIKE '%$search1%' or prp_rag_soc LIKE '%$search1%' ) ";
    }

    if ($search2 == "tutti"){
//      $caselle = getCaselle();
      $elenco_registri = "'RI', 'RO', 'RS'";
      if ($where){
        $where .= " AND nav_registro IN ( ".$elenco_registri." ) ";
      } else {
        $where .= " WHERE nav_registro IN ( ".$elenco_registri." ) ";
      }

    } else {
      if ($where){
        $where .= " AND nav_registro = '".$search2."' ";
      } else {
        $where .= " WHERE nav_registro = '".$search2."' ";
      }
    }


    if ($search3 <> '999') {
      if ($where){
        $where .= " AND nav_servizio = '".$search3."' ";
      } else {
        $where .= " WHERE nav_servizio = '".$search3."' ";
      }
    }
    if ($search4) {
      if ($where){
        $where .= " AND (nav_data_cancellazione IS NULL OR nav_data_cancellazione ='' )";
      } else {
        $where .= " WHERE (nav_data_cancellazione IS NULL OR trim(nav_data_cancellazione) ='' )";
      }
    }

//    $sql .= $where. $GLOBALS['where'];
    $sql .= $where;


//    echo $sql; die;

    $res = $conn->query($sql);
    if($res) {

//      while( $row = $res->fetch_assoc()) {
//          $records[] = $row;

//      }
       $row = $res->fetch_assoc();
       $totalList = $row['totalList'];

    } else $totalList = 0;
//    echo "<br>".$sql;

    return $totalList;
}


function getDatiNave($id){

    $conn = $GLOBALS['mysqli'];

    $campo = "";
    $result = "";
    $txt = "";
    $result=[];
    $sql = "SELECT * FROM nave LEFT JOIN armatore ON armatore.id = nav_id_armatore LEFT JOIN proprietario ON proprietario.id = nav_id_proprietario LEFT JOIN capitaneria ON capitaneria.cod = nav_ufficio_iscrizione WHERE nave.id = ".$id;
   
    $res = $conn->query($sql);
    if($res && $res->num_rows){
//        $result = $res->fetch_assoc();
        $result = $res->fetch_assoc();
       
    }


    return $result;

}

function updateNave(array $data, int $id){ 

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      
      
      
      $nav_nome = array_key_exists('nav_nome', $data) ? $data['nav_nome'] : '';
      $nav_nome= $conn->escape_string($nav_nome);

      $nav_registro = array_key_exists('nav_registro', $data) ? $data['nav_registro'] : '';
      $nav_registro= $conn->escape_string($nav_registro);

      $nav_sezione = array_key_exists('nav_sezione', $data) ? $data['nav_sezione'] : '';
      $nav_sezione= $conn->escape_string($nav_sezione);

      $nav_tipo = array_key_exists('nav_tipo', $data) ? $data['nav_tipo'] : '';
      $nav_tipo= $conn->escape_string($nav_tipo);

      $nav_anno_costruzione = array_key_exists('nav_anno_costruzione', $data) ? $data['nav_anno_costruzione'] : '';
      $nav_anno_costruzione= $conn->escape_string($nav_anno_costruzione);
      
      $nav_cantiere = array_key_exists('nav_cantiere', $data) ? $data['nav_cantiere'] : '';
      $nav_cantiere= $conn->escape_string($nav_cantiere);

      $nav_cantiere_nazione = array_key_exists('nav_cantiere_nazione', $data) ? $data['nav_cantiere_nazione'] : '';
      $nav_cantiere_nazione= $conn->escape_string($nav_cantiere_nazione);
     

      $nav_call_sign = array_key_exists('nav_call_sign', $data) ? $data['nav_call_sign'] : '';
      $nav_call_sign= $conn->escape_string($nav_call_sign);

      $nav_imo = array_key_exists('nav_imo', $data) ? $data['nav_imo'] : '';
      $nav_imo= $conn->escape_string($nav_imo);

      $nav_servizio = array_key_exists('nav_servizio', $data) ? $data['nav_servizio'] : '';
      $nav_servizio= $conn->escape_string($nav_servizio);

      $nav_viaggi_int = array_key_exists('nav_viaggi_int', $data) ? $data['nav_viaggi_int'] : '';
      $nav_viaggi_int= $conn->escape_string($nav_viaggi_int);

      $nav_cabotaggio = array_key_exists('nav_cabotaggio', $data) ? $data['nav_cabotaggio'] : '';
      $nav_cabotaggio= $conn->escape_string($nav_cabotaggio);

      $nav_pers_extra = array_key_exists('nav_pers_extra', $data) ? $data['nav_pers_extra'] : 0;

      $nav_pers_comun = array_key_exists('nav_pers_comun', $data) ? $data['nav_pers_comun'] : 0;

      $nav_gt = array_key_exists('nav_gt', $data) ? $data['nav_gt'] : 0;

      $nav_nt = array_key_exists('nav_nt', $data) ? $data['nav_nt'] : 0;

      $nav_dwt = array_key_exists('nav_dwt', $data) ? $data['nav_dwt'] : 0;

      $nav_lung = array_key_exists('nav_lung', $data) ? $data['nav_lung'] : 0;

      $nav_larg = array_key_exists('nav_larg', $data) ? $data['nav_larg'] : 0;

      $nav_power = array_key_exists('nav_power', $data) ? $data['nav_power'] : 0;

      $nav_prov_causale = array_key_exists('nav_prov_causale', $data) ? $data['nav_prov_causale'] : '';
      $nav_prov_causale= $conn->escape_string($nav_prov_causale);

      $nav_prov_nome = array_key_exists('nav_prov_nome', $data) ? $data['nav_prov_nome'] : '';
      $nav_prov_nome= $conn->escape_string($nav_prov_nome);

      $nav_prov_bandiera = array_key_exists('nav_prov_bandiera', $data) ? $data['nav_prov_bandiera'] : '';
      $nav_prov_bandiera= $conn->escape_string($nav_prov_bandiera);

      $nav_tipo_atto = array_key_exists('nav_tipo_atto', $data) ? $data['nav_tipo_atto'] : '';
      $nav_tipo_atto= $conn->escape_string($nav_tipo_atto);

      $nav_atto_naz = array_key_exists('nav_atto_naz', $data) ? $data['nav_atto_naz'] : '';
      $nav_atto_naz= $conn->escape_string($nav_atto_naz);

      $nav_luogo_rilascio = array_key_exists('nav_luogo_rilascio', $data) ? $data['nav_luogo_rilascio'] : '';
      $nav_luogo_rilascio= $conn->escape_string($nav_luogo_rilascio);

      $nav_data_rilascio = array_key_exists('nav_data_rilascio', $data) ? $data['nav_data_rilascio'] : '';
      $nav_data_rilascio= $conn->escape_string($nav_data_rilascio);

      $nav_motivo_rilascio = array_key_exists('nav_motivo_rilascio', $data) ? $data['nav_motivo_rilascio'] : '';
      $nav_motivo_rilascio= $conn->escape_string($nav_motivo_rilascio);

      $nav_data_scad_passavanti = array_key_exists('nav_data_scad_passavanti', $data) ? $data['nav_data_scad_passavanti'] : '';
      $nav_data_scad_passavanti= $conn->escape_string($nav_data_scad_passavanti);

      $nav_id_armatore = array_key_exists('nav_id_armatore', $data) ? $data['nav_id_armatore'] : 0;
     
      $nav_id_proprietario = array_key_exists('nav_id_proprietario', $data) ? $data['nav_id_proprietario'] : 0;

      $nav_note = array_key_exists('nav_note', $data) ? $data['seanav_noterch1'] : '';
      $nav_note= $conn->escape_string($nav_note);

      $nav_istreg_id = array_key_exists('nav_istreg_id', $data) ? $data['nav_istreg_id'] : '';
      $nav_istreg_id= $conn->escape_string($nav_istreg_id);

      $nav_ufficio_iscrizione = array_key_exists('nav_ufficio_iscrizione', $data) ? $data['nav_ufficio_iscrizione'] : '';
      $nav_ufficio_iscrizione= $conn->escape_string($nav_ufficio_iscrizione);

      $nav_num_iscrizione = array_key_exists('nav_num_iscrizione', $data) ? $data['nav_num_iscrizione'] : '';
      $nav_num_iscrizione= $conn->escape_string($nav_num_iscrizione);

      $nav_data_iscrizione = array_key_exists('nav_data_iscrizione', $data) ? $data['nav_data_iscrizione'] : '';
      $nav_data_iscrizione= $conn->escape_string($nav_data_iscrizione);

      $nav_data_cancellazione = array_key_exists('nav_data_cancellazione', $data) ? $data['nav_data_cancellazione'] : '';
      $nav_data_cancellazione= $conn->escape_string($nav_data_cancellazione);

      $nav_uffico_prec = array_key_exists('nav_uffico_prec', $data) ? $data['nav_uffico_prec'] : '';
      $nav_uffico_prec= $conn->escape_string($nav_uffico_prec);

      $nav_provenienza = array_key_exists('nav_provenienza', $data) ? $data['nav_provenienza'] : '';
      $nav_provenienza= $conn->escape_string($nav_provenienza);

      $nav_nome_prec = array_key_exists('nav_nome_prec', $data) ? $data['nav_nome_prec'] : '';
      $nav_nome_prec= $conn->escape_string($nav_nome_prec);

      $nav_bandiera_prec = array_key_exists('nav_bandiera_prec', $data) ? $data['nav_bandiera_prec'] : '';
      $nav_bandiera_prec= $conn->escape_string($nav_bandiera_prec);

      $data_agg = array_key_exists('data_agg', $data) ? $data['data_agg'] : 0;
      $data_agg= $conn->escape_string($data_agg);

      $user = array_key_exists('user', $data) ? $data['user'] : '';
      $user= $conn->escape_string($user);


     


      $result=0;
      $sql ='UPDATE nave SET ';



      $sql .= " nav_nome='$nav_nome',";
      $sql .= " nav_registro='$nav_registro',";
      $sql .= " nav_sezione='$nav_sezione',";
      $sql .= " nav_tipo='$nav_tipo',";
      $sql .= " nav_anno_costruzione='$nav_anno_costruzione',";
      $sql .= " nav_cantiere='$nav_cantiere',";
      $sql .= " nav_cantiere_nazione='$nav_cantiere_nazione',";
      $sql .= " nav_call_sign='$nav_call_sign',";
      $sql .= " nav_imo=' $nav_imo',";
      $sql .= " nav_servizio='$nav_servizio',";
      $sql .= " nav_viaggi_int=' $nav_viaggi_int',";
      $sql .= " nav_cabotaggio='$nav_cabotaggio',";
      $sql .= " nav_pers_extra=$nav_pers_extra,";
      $sql .= " nav_pers_comun=$nav_pers_comun,";
      $sql .= " nav_gt=$nav_gt,";
      $sql .= " nav_nt=$nav_nt,";
      $sql .= " nav_dwt=$nav_dwt,";
      $sql .= " nav_lung=$nav_lung,";
      $sql .= " nav_larg=$nav_larg,";
      $sql .= " nav_power=$nav_power,";
      $sql .= " nav_prov_causale='$nav_prov_causale',";
      $sql .= " nav_prov_nome='$nav_prov_nome',";
      $sql .= " nav_prov_bandiera='$nav_prov_bandiera',";
      $sql .= " nav_tipo_atto='$nav_tipo_atto',";
      $sql .=  " nav_atto_naz='$nav_atto_naz',";
      $sql .=  " nav_luogo_rilascio='$nav_luogo_rilascio',";
      $sql .=  " nav_data_rilascio='$nav_data_rilascio',";
      $sql .=  " nav_motivo_rilascio='$nav_motivo_rilascio',";
      $sql .=  " nav_data_scad_passavanti='$nav_data_scad_passavanti',";
      $sql .=  " nav_id_armatore=$nav_id_armatore,";
      $sql .= " nav_id_proprietario=$nav_id_proprietario,";
      $sql .=  " nav_note='$nav_note',";
      $sql .=  " nav_istreg_id=' $nav_istreg_id',";
      $sql .=  " nav_ufficio_iscrizione='$nav_ufficio_iscrizione',";
      $sql .= " nav_num_iscrizione='$nav_num_iscrizione',";
      $sql .= " nav_data_iscrizione='$nav_data_iscrizione',";
      $sql .= " nav_data_cancellazione='$nav_data_cancellazione',";
      $sql .=  " nav_uffico_prec='$nav_uffico_prec',";
      $sql .= " nav_provenienza='$nav_provenienza',";
      $sql .= " nav_nome_prec='$nav_nome_prec',";
      $sql .= " nav_bandiera_prec='$nav_bandiera_prec',";
      $sql .= " data_agg=$data_agg,";
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


function serviziNavi(){
/*
   * @var $conn mysqli
     */
//    $user = getUserLoggedEmail();

    $conn = $GLOBALS['mysqli'];

    $servizi = [];

    $sql = "SELECT count(nav_servizio) as qta, nav_servizio as codice FROM nave group by nav_servizio order by nav_servizio";
   
  
    $res = $conn->query($sql);
    //echo $sql."<br>";
    if($res){
      while($row = $res->fetch_assoc()){
        $servizi[]=$row;
      }
//      array_push($caselle, "TUTTE");
    }
//    if (count($caselle) > 1) $caselle += $tutte;
//    if (count($caselle) > 1){
//      array_push($caselle, $tutte);
//    }

//    $caselle[count($caselle)] = $tutte;
//$comuni_istanze += [$istanza => $comune];
//    echo $sql."<br>";
//    var_dump($servizi);

    return $servizi;

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
function getServizi(){

  /**
   * @var $conn mysqli
   */
    $conn = $GLOBALS['mysqli'];
    $records = [];
    $sql ="SELECT * FROM servizio";
      //echo $sql;
      $res = $conn->query($sql);
      
     
      if($res) {

        while( $row = $res->fetch_assoc()) {
            $records[] = $row;
            
        }

      }

  return $records;
  
  
}
function getCapitanerie(){

  /**
   * @var $conn mysqli
   */
    $conn = $GLOBALS['mysqli'];
    $records = [];
    $sql ="SELECT * FROM capitaneria";
      //echo $sql;
      $res = $conn->query($sql);
      
     
      if($res) {

        while( $row = $res->fetch_assoc()) {
            $records[] = $row;
            
        }

      }

  return $records;
  
  
}
function getArmatori(){

  /**
   * @var $conn mysqli
   */
    $conn = $GLOBALS['mysqli'];
    $records = [];
    $sql ="SELECT * FROM armatore";
      //echo $sql;
      $res = $conn->query($sql);
      
     
      if($res) {

        while( $row = $res->fetch_assoc()) {
            $records[] = $row;
            
        }

      }

  return $records;
  
  
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
function getProprietari(){

  /**
   * @var $conn mysqli
   */
    $conn = $GLOBALS['mysqli'];
    $records = [];
    $sql ="SELECT * FROM proprietario";
      //echo $sql;
      $res = $conn->query($sql);
      
     
      if($res) {

        while( $row = $res->fetch_assoc()) {
            $records[] = $row;
            
        }

      }

  return $records;
  
  
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


