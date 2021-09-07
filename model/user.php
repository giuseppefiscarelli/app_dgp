<?php
function delete(int $id){

    /**
     * @var $conn mysqli
     */

      $conn = $GLOBALS['mysqli'];

        $sql ='DELETE FROM users WHERE id = '.$id;

        $res = $conn->query($sql);
        
        return $res && $conn->affected_rows;
    
    
}
function getUser(int $id){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $sql ='SELECT * FROM users WHERE id = '.$id;
      //echo $sql;
      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}

function getUserByemail(string $email){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $result=[];
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      if(!$email){
        $result;
      }
      $email = mysqli_escape_string($conn,$email);

      $sql ="SELECT * FROM users WHERE email = '$email'";
      //echo $sql;
      $res = $conn->query($sql);
      
      if($res && $res->num_rows){
        $result = $res->fetch_assoc();
        
      }
    return $result;
  
  
}

function storeUser(array $data, int $id){ 

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $username = $conn->escape_string($data['username']);
      $cognome = $conn->escape_string($data['cognome']);
      $nome = $conn->escape_string($data['nome']);
      $email = $conn->escape_string($data['email']);
      $pec_enable = $conn->escape_string($data['pec_enable']);
      $network = $conn->escape_string($data['network']);
      $pec_enable == 'on'?$pec_enable=true:$pec_enable=false;
      
     
      


      $roletype = in_array($data['roletype'], getConfig('roletype',[]))? $data['roletype']:'user';
      $result=0;
      $sql ='UPDATE users SET ';
      $sql .= "username = '$username', cognome = '$cognome', nome = '$nome', email = '$email', pec_enable = $pec_enable, network = '$network'";
      if($data['password']){
        $data['password']=$data['password']?? 'password';
        
        $password = addslashes(password_hash($data['password'], PASSWORD_ARGON2I));
        $sql.= ", password = '$password'";
      } 
      if ($data['roletype']){
        $roletype = in_array($data['roletype'], getConfig('roletype',[]))? $data['roletype']:'user';
        $sql .=", roletype = '$roletype'";
      }
      
      $sql .=' WHERE id = '.$id;
      //print_r($data);
      //cho $sql;die;
      $res = $conn->query($sql);
      
      if($res ){
        $result =  $conn->affected_rows;
        
      }else{
        $result -1;  
      }
    return $result;
  
  
}

function saveUser(array $data){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $username = $conn->escape_string($data['username']);
      $cognome = $conn->escape_string($data['cognome']);
      $nome = $conn->escape_string($data['nome']);
      $email = $conn->escape_string($data['email']);
      $ragione_sociale = $conn->escape_string($data['ragione_sociale']);
      $piva = $conn->escape_string($data['piva']);
      $note = $conn->escape_string($data['note']);
      
      $roletype = in_array($data['roletype'], getConfig('roletype',[]))? $data['roletype']:'user';
      $data['password']= $data['password']?$data['password']:'testuser';
      $password = addslashes(password_hash($data['password'], PASSWORD_ARGON2I));
      $result=0;
      $sql ='INSERT INTO users (id, password, username, cognome, nome, email,  roletype,ragione_sociale,piva,note) ';
      $sql .= "VALUES (NULL, '$password', '$username', '$cognome', '$nome', '$email', '$roletype','$ragione_sociale','$piva','$note') ";
      
      //echo $sql;die;
      $res = $conn->query($sql);
      
      if($res ){
        $result =  $conn->affected_rows;
        
      }else{
        $result -1;  
      }
    return $result;
  
  
} 
function saveUserP(array $data){

  /**
   * @var $conn mysqli
   */

    $conn = $GLOBALS['mysqli'];
      $username = $conn->escape_string($data['username']);
      $cognome = $conn->escape_string($data['cognome']);
      $nome = $conn->escape_string($data['nome']);
      $email = $conn->escape_string($data['email']);
      $ragione_sociale = $conn->escape_string($data['ragione_sociale']);
      $piva = $conn->escape_string($data['piva']);
      $note = $conn->escape_string($data['note']);
      
      $roletype = in_array($data['roletype'], getConfig('roletype',[]))? $data['roletype']:'user';
      $password=  $conn->escape_string($data['password']);
     
      $result=0;
      $sql ='INSERT INTO users (id, password, username, cognome, nome, email,  roletype,ragione_sociale,piva,note) ';
      $sql .= "VALUES (NULL, '$password', '$username', '$cognome', '$nome', '$email', '$roletype','$ragione_sociale','$piva','$note') ";
      
      //echo $sql;die;
      $res = $conn->query($sql);
      
      if($res ){
        $result =  $conn->affected_rows;
        
      }else{
        $result -1;  
      }
    return $result;
  
  
}     
function getUsersP( array $params = []){

  /**
   * @var $conn mysqli
   */

      $conn = $GLOBALS['mysqli'];

      $records = [];

      

      $sql = 'SELECT * FROM user_parameter';
     
      

      $res = $conn->query($sql);
      if($res) {

        while( $row = $res->fetch_assoc()) {
            $records[] = $row;
            
        }

      }

  return $records;

}
function saveCred($p){
   /**
   * @var $conn mysqli
   */

  $conn = $GLOBALS['mysqli'];




}