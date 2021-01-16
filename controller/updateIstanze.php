
<?php
session_start();
require_once '../functions.php';
$action = getParam('action','');
require '../model/istanze.php';
$params = $_GET;
switch ($action){
    
    case 'store':
      
    break; 
    case 'getTipDoc':

      $tipo_documento=$_REQUEST['tipo'];
      $res = getCampoDoc($tipo_documento);
      //echo json_encode($res);
     // var_dump($res);
      if ($res){
        $res2 = array();
        
            foreach($res as $r){
              $cod = getInfoCampo($r['cod_campo']);

              array_push($res2,$cod);
            }
            
            echo json_encode($res2);
      }
      
    break;

    case 'upVeicolo':
      $data=$_REQUEST;

      $res = upVeicolo($data);

      echo json_encode($res);

    break;

    case 'newAllegato':
       $file=$_FILES['file_allegato'];
       $data=$_POST;
       $json = $data;
      
       array_splice($json,0,3);

       $data['json_data'] = addslashes(json_encode($json));
      /* var_dump($data['json_data']);
       
       die;
     */
      // $data['json_data'] = $json;
      
       //upload file

      $data['docu_nome_file_origine']=$file['name'];
      $id_ram = $data['id_RAM'];
      //$id_veicolo = $data['doc_idvei'];
      //$infovei =  getInfoVei($id_veicolo);
      $tipo_veicolo= $data['tipo_veicolo'];
      $progressivo = $data['progressivo'];

      $tipo_documento = $data['tipo_documento'];
      $docu_nome_file_origine =  $file['name'];
      $path_parts = pathinfo($docu_nome_file_origine);

      $docu_id_file_archivio = $id_ram."_".$tipo_veicolo."_".$progressivo."_".strtotime("now").".".$path_parts['extension'];
      $data['docu_id_file_archivio']=$docu_id_file_archivio;
      $data['docu_nome_file_origine']=$docu_nome_file_origine;
       move_uploaded_file($file['tmp_name'],$pathAlle.$docu_id_file_archivio);
       if(file_exists($pathAlle.$docu_id_file_archivio)){
        $data['tipo_veicolo'] = $tipo_veicolo;
        $data['progressivo'] = $progressivo;
        $res= newAllegato($data);

       }
       if($res){
        $res2=getAllegatoID($res);
       }
       
       echo json_encode($res2);
        

    break; 
    
    case 'newAllegatoMag':
      $file=$_FILES['file_allegato'];
      $data=$_POST;
      //var_dump($file);var_dump($data);die;
      //upload file
     $data['docu_nome_file_origine']=$file['name'];
     $id_ram = $data['id_RAM'];
     
     $data['doc_idvei']= 0;
     $id_veicolo = 0;
     $data['tipo_documento'] = $data['tipo_doc_mag'];
     $tipo_documento=$data['tipo_documento'];
     $docu_nome_file_origine =  $file['name'];
     $path_parts = pathinfo($docu_nome_file_origine);
     $docu_id_file_archivio = $id_ram."_".$tipo_documento."_".strtotime("now").".".$path_parts['extension'];
     $data['docu_id_file_archivio']=$docu_id_file_archivio;
     $data['docu_nome_file_origine']=$docu_nome_file_origine;
      move_uploaded_file($file['tmp_name'],$pathAlle.$docu_id_file_archivio);
      if(file_exists($pathAlle.$docu_id_file_archivio)){
        $data['tipo_veicolo']=0;
        $data['progressivo']=0;
       $res= newAllegato($data);

      }
      if($res){
       $res2=getAllegatoID($res);
      }
      
      echo json_encode($res2);
       

    break; 
    case 'upAlleAdmin':
      $data=$_REQUEST;

      $res = upAlleAdmin($data);

      echo json_encode($res);

    break;  
    case 'delAllegato':
      $id=$_REQUEST['id'];
      //var_dump($id);
      $res=delAllegatoID($id);
      echo json_encode($res);


    break;
    
    case 'getDocVei':
      $data=$_REQUEST['tipovei'];
      $id_RAM = $_REQUEST['id_RAM'];
      //var_dump($data);
      $res = getTipoDocumento($data);
     // var_dump($res);
      /*  if($res){
        $check = array();
          foreach($res as $r){
            $datas['tipo_documento']=$r['codice_tipo_documento'];
            $datas['id_ram']=$id_RAM;
            $datas['tipo_veicolo']=$data;
            $datas['progressivo']=$_REQUEST['progressivo'];

            $res2= checkSelectTipoDoc($datas);
          // var_dump($res2);
            if($res2){
              
              //echo "ok tipo veicolo".$res2['tipo_veicolo'];
              //echo "ok progressivo".$res2['progressivo'];
              //echo "ok tipo_documento".$res2['tipo_documento'];
            // array_push
            }

          }
        }
      */


      echo json_encode($res);

    break  ;
    case 'getDocVei':
      $data=$_REQUEST['tipovei'];
      $id_RAM = $_REQUEST['id_RAM'];
      //var_dump($data);
      $res = getTipoDocumento($data);
     // var_dump($res);
      /*  if($res){
        $check = array();
          foreach($res as $r){
            $datas['tipo_documento']=$r['codice_tipo_documento'];
            $datas['id_ram']=$id_RAM;
            $datas['tipo_veicolo']=$data;
            $datas['progressivo']=$_REQUEST['progressivo'];

            $res2= checkSelectTipoDoc($datas);
          // var_dump($res2);
            if($res2){
              
              //echo "ok tipo veicolo".$res2['tipo_veicolo'];
              //echo "ok progressivo".$res2['progressivo'];
              //echo "ok tipo_documento".$res2['tipo_documento'];
            // array_push
            }

          }
        }
      */


      echo json_encode($res);

    break  ;

    case 'getTipoDoc': 
      $data=$_REQUEST['tipo'];
      $res =getTipDocumento($data);


      echo json_encode($res);
    break;  

    case 'getInfoVei':
      $id=$_REQUEST['id'];
      $res =getInfoVei($id);

      
      
      echo json_encode($res);


    break;  

    case 'getAllegato':
      $id=$_REQUEST['id'];
      $res =getAllegatoID($id);
      $tipo = getTipDocumento($res['tipo_documento']);
      $res['tipo_documento']=$tipo[0]['tdoc_descrizione'];
      $json = array(
        "allegato" => $res,
        //"test" =>$res
        
      );
      
      echo json_encode($json);
      //echo json_encode($res);
    break;
    case 'getAllegati':
      $data=$_REQUEST;
      $res =getAllegati($data['id_RAM'],$data['tipo_veicolo'],$data['progressivo']);
      
      //$tipo = getTipDoc($res['tipo_documento']);
      //var_dump($res);
      if($res){
       
        
        echo json_encode($res); 
      }
       // var_dump($res);
       // var_dump($res);
        
     // echo json_encode($res);
     // echo json_encode($res);
    break;    
    case 'getInfoCampo':
      $cod=$_REQUEST['cod'];
      $res = getInfoCampo($cod);
      echo json_encode($res);


    break;

    case 'checkDoc':
      $data=$_REQUEST;
      $id_RAM =$data['id_RAM'];
      $tipo_veicolo=$data['tipo_veicolo'];
      $progressivo=$data['progressivo'];
      $res =countDocVeicoloInfo($id_RAM,$tipo_veicolo,$progressivo);
      $res2 = countDocVeicolo($tipo_veicolo);
      $json= array(

        "n"=>$res,
        "of"=>$res2
      );



      echo json_encode($json);
    
    
    
    break;
      
    case 'closeRend':

      $id_ram = $_REQUEST['id_ram'];

      $res = closeRend($id_ram);

      echo json_encode($res);
    break;
    case 'countDocVeicolo':
      $tipo_veicolo = $_REQUEST['tipo_veicolo'];
      $res = countDocVeicolo($tipo_veicolo);
      echo  json_encode($res);
    break;

    case 'getIstanza':
    
      $id = $_REQUEST['id'];
      //var_dump($id);
      $res=getIstanza($id);
      $res['data_nascita']= date("d/m/Y",strtotime($res['data_nascita']));
      $res['luogo_nascita']=$res['luogo_nascita']."(".$res['prov_nascita'].")";

      $res['indirizzo_residenza']= $res['indirizzo_residenza'].", ".$res['civico_residenza'];
      $res['indirizzo_impr']= $res['indirizzo_impr'].", ".$res['civico_impr'];

      $res['comune_residenza']= $res['cap_residenza']." - ".$res['comune_residenza']."(".$res['prov_residenza'].")";
      $res['comune_impr']= $res['cap_impr']." - ".$res['comune_impr']."(".$res['prov_impr'].")";
      $res['tel_impr'] = $res['pref_tel_impr']."/".$res['num_tel_impr'];  
      $tipod=getTipoDich($res['tipo_dichiarante']);
      $res['tipo']=$tipod['descrizione_tipo'];
      $res['cciaa']="Provincia ".$res['cciaa_prov']." <br>Codice ".$res['cciaa_codice']."<br>Data ".date("d/m/Y",strtotime($res['cciaa_data']));
      $res['banca']="Istituto ".$res['banca_istituto']."<br>Agenzia ".$res['banca_agenzia']."<br>IBAN ".$res['iban_it']." ".$res['iban_num_chk']." ".$res['iban_cin']." ".$res['iban_abi']." ".$res['iban_cab']." ".$res['iban_cc'];

      echo json_encode($res);
      
    break;

    case 'upIstruttoria':
      $data=$_REQUEST;
      $res =upIstruttoria($data);
      echo json_encode($res);


    break;

    case 'getTipoInt':
      $id=$_REQUEST['tipo'];
      $res =getTipoInt($id);

      
      
      echo json_encode($res);
    
    break;

    case 'newInt':
      $data = $_REQUEST;
      $res = newInt($data);
      echo json_encode($res);
      break;
    case 'newIntDett': 
      $data = $_REQUEST;
      $res = newIntDett($data);
      echo json_encode($res);

      break;
   }