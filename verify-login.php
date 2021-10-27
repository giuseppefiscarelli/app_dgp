<?php
session_start();
require_once 'functions.php';

if(!empty($_POST)){

    if(!empty($_POST['action']) && $_POST['action'] === 'logout'){
        $status = 'offline';
        statusUsers($status,$_SESSION['userData']['username']);
        //var_dump($_SESSION);die;
        $_SESSION = [];
        
        header('Location: index.php');
        exit;
    }

    $token = $_POST['_csrf'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $homeAmb = $_POST['ambiente'] ?? '';

    $result = verifyLogin($token, $email, $password);
   
    //var_dump($result);
    //die;
    $result['log_funzione']='procedura Login';
    writelog($result);
    
    unset($_SESSION['csrf']);
    if($result['success']){
        $status = 'online';
        statusUsers($status,$result['user']['username']);
        
        session_regenerate_id();
        
        $_SESSION['userData']['status'] = $status;
        
        $_SESSION['loggedin'] = true;
        unset($result['user']['password']);
        $_SESSION['userData'] = $result['user'];
        //$homePage = $result['user']['ambiente'];
        $result['user']['status'] = 'online';
        if(!isUserUser()){
            $enableAccess = isset($_SESSION['userData']['network']);
            //var_dump($enableAccess);die;
            if($enableAccess){
              
                $ip_abilitati = explode(",", $_SESSION['userData']['network']);
               
                if( in_array($_SERVER['REMOTE_ADDR'], $ip_abilitati)){
                    $_SESSION['message'] = $result['message'];
                    header('Location: home.php');
                }else{
                    $_SESSION['loggedin']= false;
                    $_SESSION['message'] = 'Network non abilitato';
                    header('Location: index.php');
                    exit;
                }
               
               
            }
        }

       
            $_SESSION['message'] = $result['message'];
            header('Location: home.php');
        
        
           
        
        
        
        exit;
    }else{

        $_SESSION['message'] = $result['message'];
        header('Location: index.php');
    }

}else{
    header('Location: index.php');
}