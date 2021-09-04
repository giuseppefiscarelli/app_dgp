
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

      $res2 = upAlleAdmin($data);
      $id = $data['id'];
      $v =  getAllegatoID($id);
      //var_dump($v);die;
      $alleok = getAlleOk($v['id_ram'],$v['tipo_veicolo'],$v['progressivo']);
      $alleno = getAlleNo($v['id_ram'],$v['tipo_veicolo'],$v['progressivo']);
      $countAlle = countAlle($v['id_ram'],$v['tipo_veicolo'],$v['progressivo']);
      $vei=getVeicolo($v['id_ram'],$v['tipo_veicolo'],$v['progressivo']);

      //var_dump( $vei);die;
      $res = array(
              'response' => intVal($res2),
              'accettati' =>  intVal($alleok),
              'respinti' => intVal($alleno),
              'totali' => intVal($countAlle),
              'id_veicolo'=> $vei['id']
      );
              //var_dump($res);

      //die;
      echo json_encode($res);

    break;
    case 'upAlleAdminIstanza':
      $data=$_REQUEST;
      //var_dump($data);
      $id = $data['id'];
      $v =  getAllegatoID($id);
      $istanza = getIstanza($v['id_ram']);
      $tipo_impresa = $istanza['tipo_impresa'];
      $tipo = getTipDocumento($data['tipo_documento']);
      $tipo_doc = $tipo[0]['tdoc_dichiarazioni'];
      
      //var_dump($findInstanza);die;
      //die;
      $res = upAlleAdmin($data);
      if($res){
        $findInstanza = findCheckIstanza($v['id_ram']);
        $find = $findInstanza?$findInstanza:0;
        if($find){
          $res2 = upCheckIstanza($v['id_ram'],$tipo_impresa,$tipo_doc);
        }else{
          $res2 = newCheckIstanza($v['id_ram'],$tipo_impresa,$tipo_doc);
        }
       
      }
     
      
     // var_dump($v);die;
      
      

      //die;
      echo json_encode($v);

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
      //var_dump($res);die;
      //$ckrott =getIstanza($id_RAM);
      $checkRott = checkRott($id_RAM,$data);
      
      if($checkRott){
        $doc11 = array(
          'codice_tipo_documento' => "11"
        );
        $doc14 = array(
          'codice_tipo_documento' => "14"
        );
        array_push($res,$doc11,$doc14);
      }



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
      $c_i = checkIstanza($res['id_RAM']);
      $c_iCheck = false;
      if($c_i){
        if($c_i['pec']&&$c_i['firma']&&$c_i['doc']&&$c_i['contratto']&&$c_i['delega']&&$c_i['dim_impresa']){
            $c_iCheck = true;
        }
      }
      
      $contr= calcolaContributo($res);
      
      if($contr === '{"result":"KO"}'){
        $contr = false;
      }
      //var_dump($contr);
      if(!$contr){
        $res['val_contributo']=0;
        $res['val_pmi']=0;
        $res['val_rete']=0;
      }else{
        $res['val_contributo']=$contr[0]['contributo'];
        $res['val_pmi']=$contr[0]['pmi']?$contr[0]['pmi']:'0.00';
        $res['val_rete']=$contr[0]['rete']?$contr[0]['rete']:0.00;
      }
     

      $res['check_istruttoria'] = $c_iCheck;

      
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
    case 'getAllegatoIstanza':
      $id=$_REQUEST['id'];
      $res =getAllegatoID($id);
      $tipo = getTipDocumento($res['tipo_documento']);
      $res['tipo_doc']=$tipo[0]['tdoc_descrizione'];
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
    case 'getAllegatiCheck':
      $data=$_REQUEST;
      $res =getAllegati($data['id_RAM'],$data['tipo_veicolo'],$data['progressivo']);
      $alleok = getAlleOk($data['id_RAM'],$data['tipo_veicolo'],$data['progressivo']);
      $alleno = getAlleNo($data['id_RAM'],$data['tipo_veicolo'],$data['progressivo']);
      $countAlle = countAlle($data['id_RAM'],$data['tipo_veicolo'],$data['progressivo']);
      $ok = ($alleok + $alleno) == $countAlle??false;
      $json = array(
        'res' => $res,
        'ok' => $ok
      );
      //$tipo = getTipDoc($res['tipo_documento']);
      //var_dump($res);
      if($res){
       
        
        echo json_encode($json); 
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
      $checkRott = checkRott($id_RAM,$tipo_veicolo);
      
      $res =countDocVeicoloInfo($id_RAM,$tipo_veicolo,$progressivo);
      $res2 = countDocVeicolo($tipo_veicolo);
      $rott=false;
      
      $n_R=0;
      $of_R=2;
      if($checkRott){
        $n_R=countDocVeicoloRottInfo($id_RAM,$tipo_veicolo,$progressivo);
        $res2 = $res2;
        $res = $res-$n_R;
        $res<0?$res=0:$res;
        $rott=true;
      }
      $json= array(
        "rott"=>$rott,
        "n_R"=>intval($n_R),
        "of_R"=>$of_R,
        "n"=>$res,
        "of"=>intval($res2)
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
    case 'upCostoIstr':
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
    case 'saveReport':
      $data = $_REQUEST;
      //var_dump($data);die;
      $res = saveReport($data);
      $res2 =getReportId($data['id']);
      $res3 = getTipoRep($res2['tipo_report']);
     
      
      $res2['descrizione'] = $res3;
      $res2['data_inserimento'] = date("d/m/y H:i", strtotime($res2['data_ins']));
      //var_dump($res2);
      //die;
      echo json_encode($res2);
    break; 
      
    case 'delReport': 
      $data = $_REQUEST;
      $res= delReport($data['id']);
      $status_istr= getStatusIstruttoria_test($data['id_RAM']);
      $check_stato_istruttoria= getStatusIstruttoria($data['id_RAM']);
      if($status_istr && $check_stato_istruttoria){
        if($check_stato_istruttoria['tipo_report'] == $status_istr['tipo_report']){
          $status_istr = $check_stato_istruttoria;
        }
      }elseif($check_stato_istruttoria){
        $status_istr = $check_stato_istruttoria;
      }
     
      $json = array(
        'res' => $res,
        'status' => $status_istr
      );

      echo json_encode($json);
    break;
    case 'getReport': 
      $id = $_REQUEST['id'];
      $res= getReportId($id);
      $res2 = getTipoRep($res['tipo_report']);
      $res['descrizione_rep'] = $res2;
      echo json_encode($res);
    break;
    case 'newMail':
        $file=$_FILES['file_allegato_mail']?$_FILES['file_allegato_mail']:'';
        $data=$_POST;
        //var_dump($file);
        //var_dump($data);

        $defaultRep = $data['defaultreportId'];
        if($defaultRep){
          //var_dump($data);die;
          $tipo_mail = $data['tipo_mail'];
          
          if($tipo_mail ==1){
            $id=$data['defaultreportId'];

            header('Location:../report/integrazione/int.php?id='.$id.'&tipo=D');
            $rep= getReportId($id);
            


          }
          if($tipo_mail ==2){
           
          }
          if($tipo_mail ==3){
            
          }
          if($tipo_mail ==4){
            
          }
          $data['allegato'] = $rep['nome_file'];
          $res = newMail($data);


        }elseif($file['size']>0){
        $tipo_mail = $data['tipo_mail'];
        $id_RAM = $data['id_RAM'];
        $docu_nome_file_origine =  $file['name'];
        $path_parts = pathinfo($docu_nome_file_origine);
        $docu_id_file_archivio = $id_RAM."_".$tipo_mail."_".strtotime("now").".".$path_parts['extension'];
        move_uploaded_file($file['tmp_name'],$pathMail.$docu_id_file_archivio);
        if(file_exists($pathMail.$docu_id_file_archivio)){
          $data['allegato'] = $docu_id_file_archivio;
          $res = newMail($data);
  
         }
        }

        echo json_encode($res);
    break;

    case 'checkCert':
      $data = $_REQUEST;
      $res = checkIstanza($data['id_ram']);
    
      if($res){
        $tipo = $data['tipo'];
        $note =  $res['note_'.$tipo]?$res['note_'.$tipo]:'';
        $sel = $res[$tipo];
        
        if($tipo == 'dim_impresa'){
          if(is_null($sel)){
            $select = "";
          }else{
            $select = $sel;
          }
        }else{
          if(is_null($sel)){
            $select = "A";
          }
          if($sel==1){
            $select = "B";
          }
          if($sel=='0'){
            $select = "C";
          }
        }
        $json = array(
          "note" => $note,
          "select" => $select
        );
      }else{
        $json = array(
          "note" => '',
          "select" => ''
        );
      }
    
      echo json_encode($json);
    break;  
    case 'upCert':
      $data = $_REQUEST;
      $findInstanza = findCheckIstanza($data['id_ram']);
      
      $find = $findInstanza?$findInstanza:0;
        if($find){
          $res= upCert($data);
        }else{
          $istanza = getIstanza($data['id_ram']);
          $tipo_impresa = $istanza['tipo_impresa'];
          $res = newCheckIstanzaB($data['id_ram'],$tipo_impresa);
        }
       
      $res= upCert($data);
      
      
        $c = getcheckIstanza($data);
      
        $n = $c['note_'.$data['tipo']];
        $tipo = $c[$data['tipo']];
        //var_dump($tipo);die;
        $stato_tipo='';
        if(is_null($tipo)){
          $stato_tipo ='<span class="badge badge-warning" >In Lavorazione</span>';
        }
        if ($tipo==1){
          $stato_tipo ='<span class="badge badge-success" >Accettato</span>';
        }
        if($tipo =='0'){
          $stato_tipo ='<span class="badge badge-danger" >Respinto</span>';
        }
        $json = array(

          "note"=> $n,
          "stato_tipo"=>$stato_tipo,
          "tipo"=> $data['tipo']
        );
        echo json_encode($json);
      
     
    break;  

    case 'getDocR':
      $id_RAM =$_REQUEST['id_RAM'];

      $veicoli = getVeicoli($id_RAM);
      $arr =array();
      foreach ($veicoli as $v){
      
        $tipo_veicolo = $v['tipo_veicolo'];
        $progressivo =$v['progressivo'];
        $allegati = getAllegatiR($id_RAM,$tipo_veicolo,$progressivo);
        //var_dump($allegati);
        
        foreach ($allegati as $a){
          $a['id_RAM']= $a['id_ram'];
         // var_dump($a);die; 
          $res=getInfoVeiData($a);       
            $a['tipo_documento'] = getTipDoc($a['tipo_documento']);           
           
            $a['targa']=$res['targa'];
            array_push($arr,$a);
          }
         
         
        }
     
      echo json_encode($arr);
    break;

    case 'annIstanza':
        $data = $_REQUEST;

        $res=annullaIstanza($data);
        echo json_encode($res);

    break;

    case 'annInfoIstanza':
      $id_RAM = $_REQUEST['id'];

      $res=infoannIstanza($id_RAM);
      echo json_encode($res);
      break;
    case 'getRiepilogo':
      $id_RAM = $_REQUEST['idRAM'];
      $veiRiep = getVeicoli($id_RAM);
      $datavei = array();
      $totcosto=0;
      $totcontr =0;
      $totpmi = 0;
      $totrete = 0;
      $tottotale=0;
      foreach($veiRiep as $v){
       
            $tipo = getTipoVeicolo($v['tipo_veicolo']);
            $categ = getCategoria($tipo['codice_categoria_incentivo']);
            if($v['stato_admin'] == 'B'){
                $totale = $v['valore_contr']+$v['pmi_istr']+$v['rete_istr'];
                $totcosto += $v['costo_istr'];
                $totcontr  +=  $v['valore_contr'];
                $totpmi +=$v['pmi_istr'];
                $totrete +=$v['rete_istr'];
                $tottotale += $totale;
              }

            $veicolo = array(
              'stato_admin' =>$v['stato_admin'],
              'categoria' => $categ['ctgi_categoria'],
              'tipologia' =>$tipo['tpvc_descrizione_breve'],
              'prog' => $v['progressivo'],
              'targa' => $v['targa'],
              'costo' => $v['costo_istr'],
              'contributo' => $v['valore_contr'],
              'pmi' => $v['pmi_istr'],
              'rete' =>$v['rete_istr'],
              'totale' =>$v['valore_contr']+$v['pmi_istr']+$v['rete_istr'],
              'note' => $v['note_admin']??'' 
            );
            array_push($datavei,$veicolo); 
      }
     
      $json= array(
        'datavei' => $datavei,
        'totcosto' => $totcosto,
        'totcontr'=> $totcontr,
        'totpmi' => $totpmi,
        'totrete' => $totrete,
        'tottotale' => $tottotale
      );
     echo json_encode($json);
      break;
    }