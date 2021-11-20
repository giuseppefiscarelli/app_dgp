<?php

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;


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
      $orderDir = 'DESC';
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
   // $sql .= " ORDER BY data_ins  $orderDir LIMIT $start, $limit";
    $sql .= " ORDER BY data_ins  $orderDir ";
   

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
function getReportId($id){
    /**
     * @var $conn mysqli
     */
  
    $conn = $GLOBALS['mysqli'];
    $result=[];
    $sql ='SELECT * FROM report WHERE id = '.$id;
    //echo $sql;
    $res = $conn->query($sql);
    
    if($res && $res->num_rows){
      $result = $res->fetch_assoc();
      
    }
  return $result;
}
function getInfoReport($tipo){

  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];

  $sql = 'SELECT * FROM tipo_report WHERE id='.$tipo ;
  
  $result = [];

  $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
      
        
      }
    return $result;


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
function convMail($data){
  /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $result=0;
  $id = $data['id'];
  $nome_file = $data['nome_file'];
  $user_conv = $_SESSION['userData']['email'];
  $data_conv = date("Y-m-d H:i:s");
  
  $sql ='UPDATE report SET ';
  $sql .= "stato = 'A', nome_file = '$nome_file', user_conv ='$user_conv', data_conv='$data_conv'   ";
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
function getPecData($env){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $result=[];
  $sql ="SELECT * FROM pec_indirizzo WHERE env = $env";
 // echo $sql;
  $res = $conn->query($sql);
  
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;
}
function getInfoPecIstanza($id_RAM){
  $conn = $GLOBALS['mysqli'];
  $result=[];
  $sql ="SELECT pec, tipo_istanza,ragione_sociale FROM istanze_view WHERE id_RAM  =$id_RAM";
  //secho $sql;
  $res = $conn->query($sql);
  
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;

}
function sendMail($data){
  require '../vendor/autoload.php';
  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
  try {
      //Server settings
      //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = $data['pecData']['host'];  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = $data['pecData']['user'];// SMTP username
      $mail->Password = $data['pecData']['pass'];// SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = $data['pecData']['port'];  // TCP port to connect to
      //Recipients
      $mail->setFrom($data['pecData']['user']);
      //$mail->addAddress($data['to']);
      $mail->addAddress($data['To']);     // Add a recipient
      //Attachments
      $mail->addAttachment($data['file']);         // Add attachments
      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $data['Subject'];
      $mail->Body    = $data['body'];
      //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      $mail->send();
      return true;
  } catch (Exception $e) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  }

    
}
function sendMail2($data){
  require '../vendor/autoload.php';
  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
  try {
      //Server settings
      //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = $data['pecData']['host'];//'smtp.gmail.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = $data['pecData']['user'];//'fiscarelli.giu@gmail.com';                 // SMTP username
      $mail->Password = $data['pecData']['pass'];//'01735583';                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = $data['pecData']['port'];                                    // TCP port to connect to

      //Recipients
      $mail->setFrom($data['pecData']['user']);
      //$mail->addAddress($data['to']);
      $mail->addAddress('n.salvatore@gmail.com');     // Add a recipient
      $mail->addAddress('fiscarelli.giu@gmail.com');               // Name is optional
    

      //Attachments
      $mail->addAttachment($data['file']);         // Add attachments
      
      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $data['Subject'];
      $mail->Body    = $data['body'];
      //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      return true;
  } catch (Exception $e) {
   
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
      return false;
  }

    
}
function updateDataPec($data){
  /*
  * @var $conn mysqli
  */

  $conn = $GLOBALS['mysqli'];
  $result=0;
  $id = $data['id'];
  $user = $data['user'];
  $pass = $data['pass'];
  $host = $data['host'];
  $port = $data['port'];
  $sql ='UPDATE pec_indirizzo SET ';
  $sql .= "user = '$user', pass = $pass, host ='$host', port='$port' ";
  $sql .=' WHERE id = '.$id;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
    
  }else{
    $result -1;  
  }
  return $result;
}
function upReportSendMail($data){
  /*
  * @var $conn mysqli
  */

  $conn = $GLOBALS['mysqli'];
  $result=0;
  $id = $data['id'];
  $user_invio = $data['user_invio'];
  $data_invio = $data['data_invio'];
  $stato = $data['stato'];
  $rif_invio = $data['rif_invio'];
  
  $sql ='UPDATE report SET ';
  $sql .= "stato = '$stato', rif_invio = $rif_invio, user_invio ='$user_invio', data_invio='$data_invio'   ";
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
function delReport($id){
  /**
  * @var $conn mysqli
  */
  $conn = $GLOBALS['mysqli'];
  $result=0;
 
  


  $sql ='UPDATE report SET ';
  $sql .= "attivo = 0 ";
  
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
function upReportConfMail($data){
  /*
  * @var $conn mysqli
  */

  $conn = $GLOBALS['mysqli'];
  $result=0;
  $id = $data['id'];
  $prot_RAM = $data['prot_RAM'];
  
  if($data['data_prot']){
    $date_prot = $data['data_prot'];
    $date = str_replace('/', '-', $date_prot);
    $data_prot=date("Y-m-d", strtotime( $date));
  }
  
  $sql ='UPDATE report SET ';
  $sql .= "data_prot = '$data_prot', prot_RAM = '$prot_RAM' ";
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
function getDettagliReport($id){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $records=[];
  $sql ="SELECT * FROM dettaglio_report where id_report = $id";
  //echo $sql;
  $res = $conn->query($sql);
        
       
  if($res) {

    while( $row = $res->fetch_assoc()) {
        $records[] = $row;
        
    }

  }

  return $records;
}

function upDettaglioReport($data){
  /*
  * @var $conn mysqli
  */

  $conn = $GLOBALS['mysqli'];
  $result=0;
  $id= $data['id'];
  $descrizione = $data['des'];
  
  $sql ='UPDATE dettaglio_report SET ';
  $sql .= "descrizione = '$descrizione' ";
  $sql .=" WHERE id = '$id' ";
  //print_r($data);
  echo $sql;die;
  $res = $conn->query($sql);
  
  if($res ){
    $result =  $conn->affected_rows;
    
  }else{
    $result -1;  
  }
  return $result;

}