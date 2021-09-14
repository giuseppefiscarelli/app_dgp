
<?php
session_start();
require_once '../functions.php';
$action = getParam('action','');
require '../model/user.php';
$params = $_GET;
switch ($action){

    case 'delete':
        
        unset($params['action']);
        unset($params['id']);
        
        $queryString = http_build_query($params);

        $id= getParam('id', 0);
        $res = delete($id);
        $message = $res ? 'Record Eliminato' : 'Errore Eliminazione Record!';
        $_SESSION['message'] = $message;
        $_SESSION['success'] = $res;
        header('Location:../users.php?'.$queryString);
        break;
    case 'save':
        $data = $_POST;
        $res = saveUser($data); 
        $message = $res ? 'Record Inserito' : 'Errore Inserimento Record!';
        $_SESSION['message'] = $message;
        $_SESSION['success'] = $res;
        //die;
        header('Location:../users.php?'.$queryString);
    break;
    
    case 'store':
        $data = $_POST;
        //var_dump($data);die;
        $id = getParam('id',0);
        $res = storeUser($data,$id); 
        $message = $res ? 'Record Aggiornato' : 'Errore Aggiornamento Record!';
        $_SESSION['message'] = $message;
        $_SESSION['success'] = $res;
        
        header('Location:../users.php?'.$queryString);
    break; 
    case 'getUser';
    $data = $_REQUEST;
    $id = $data['id'];
    $res = getUser($id);
    echo json_encode($res);

    break;
      
   }