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
    $sql .= " ORDER BY data_ins  $orderDir LIMIT $start, $limit";
   

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
function getPecData(){
  
  /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];
  $result=[];
  $sql ='SELECT * FROM pec_indirizzo WHERE env = 1';
  //echo $sql;
  $res = $conn->query($sql);
  
  if($res && $res->num_rows){
    $result = $res->fetch_assoc();
    
  }
  return $result;
}
function sendMail($data){

  include 'Mail.php';
  include 'Mail/mime.php' ;
 
    $from    = "ram.investimenti2020@legalmail.it";
    $text = 'Text version of email';
    $html = '<html><body>'.$data['body'].'</body></html>';
    $file =  $data['file'];
    $to = "fiscarelli.giu@gmail.com, n.salvatore@gmail.com";
     
    $crlf = "\n";
    $hdrs = array(
        'From' => $from,
        'Subject' => $data['Subject'],
        "To"=>$to
    );
    
   
  $host    = "ssl://sendm.cert.legalmail.it";
    $port    = "465";
    $user    = "ram.investimenti2020@legalmail.it";
    $pass    = "RII2020@atr";
    $pass    = "NicAruba@1959";
  
   
  
  $mime = new Mail_mime(array('eol' => $crlf));
  $mime->setTXTBody($text);
  $mime->setHTMLBody($html);
  $mime->addAttachment($file, 'application/pdf');
  $body = $mime->get();
  $attachmentheaders  = $mime->headers($hdrs);
  //var_dump($attachmentheaders);
  //var_dump($file);

  $smtp    = @Mail::factory("smtp", array("host"=>$host, "port"=>$port, "auth"=> true, "username"=>$user, "password"=>$pass));
  $mail = $smtp->send($to, $attachmentheaders , $body);

  echo json_encode($mail);

  
}
function sendMail2($data){
  require "Mail.php";
  require_once "Mail/mime.php";
  $host    = "ssl://smtps.pec.aruba.it";
    $port    = "465";
    $user    = "n.salvatore@pec.it";
    $pass    = "NicAruba@1959";
  $smtp    = @Mail::factory("smtp", array(
                                          "host"=>$host, 
                                          "port"=>$port, 
                                          "auth"=> true, 
                                          "username"=>$user, 
                                          "password"=>$pass));
  $from    = "<n.salvatore@pec.it>";


 
  $to = '<fiscarelli.giu@gmail.com>';
  $file =  $data['file'];
  $subject = $data['Subject'];
  $body = '<html><body>'.$data['body'].'</body></html>';
  
  
  $mime = new Mail_mime();
  $mime->addAttachment($file,'application/pdf');

  $headers = array(
                    "From"=> $from,
                    "To"=>$to,
                    "Subject"=>$subject,
                    "MIME-Version"=>"1.0",
                   "Content-Type"=>"text/html; charset=ISO-8859-1"
                );
  
  $mail =@$smtp->send($to, $headers, $body);
  echo json_encode($mail);

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