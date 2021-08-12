<?php
 $activeIst = true;
/*if(date("Y-m-d",strtotime($tipo_istanza['data_rendicontazione_fine']))<date("Y-m-d")){
  $span='<span class="badge badge-success">In Istruttoria</span><br>Termine per la rendicondazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
  $activeIst = false;
  

}else{*/



 $status= checkRend($i['id_RAM']);

 /*
 if($status){

  if($status['aperta']==1){
    $stato= getStatoIstanza('C');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span>';
   
  }elseif($status['aperta']==0){
    $stato= getStatoIstanza('D');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Rendicondazione chiusa il '.date("d/m/Y",strtotime($status['data_chiusura']));
    $activeIst = false;
  }
  if($status['data_annullamento']){
    $stato= getStatoIstanza('B');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Annullata da Impresa ';

    $activeIst = false;
  }
  if(($tipo_istanza['data_rendicontazione_fine']<date("Y-m-d H:i:s")&&$status['aperta']==1)){
    $stato= getStatoIstanza('B');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Tempi di rendicontazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
    $activeIst = false;
  } 
}else{
  $span='<span class="badge badge-warning">Attiva</span>';
}*/
//}
//var_dump($status);
if($tipo_istanza['data_rendicontazione_fine']<date("Y-m-d")){
  if($status){
    if($status['aperta']==1){
      $stato= getStatoIstanza('C');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span>';
     
    }elseif($status['aperta']==0){
      $stato= getStatoIstanza('D');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Rendicondazione chiusa il '.date("d/m/Y",strtotime($status['data_chiusura']));
      $activeIst = false;
    }
    if($status['data_annullamento']){
      $stato= getStatoIstanza('B');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Annullata da Impresa ';
  
      $activeIst = false;
    }
    if(($tipo_istanza['data_rendicontazione_fine']<date("Y-m-d H:i:s")&&$status['aperta']==1)){
      $stato= getStatoIstanza('E');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Tempi di rendicontazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
      $activeIst = false;
    }
  }else{
    $stato= getStatoIstanza('E');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Tempi di rendicontazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
    $activeIst = false;
  }
}
$status_istr= getStatusIstruttoria($i['id_RAM']);
//var_dump($status_istr);
if($status_istr && $status_istr['id']){
  $add_span='';
  if($status_istr['tipo_report'] === '1'){
      $text_istr = 'Integrazione';
      $type_istr = 'warning';
      $date_scad =  date("d/m/Y", strtotime($status_istr['data_invio'].' + 20 days'));
      $add_span = '<br>Inviare documentazione entro e non oltre il '.$date_scad;
  }
  if($status_istr['tipo_report'] === '3'){
    $text_istr = 'Ammessa';
    $type_istr = 'success';
   
  }
  if($status_istr['tipo_report'] === '2'){
    $text_istr = 'Preavviso di rigetto';
    $type_istr = 'warning';
  }
  if($status_istr['tipo_report'] === '4'){
    $text_istr = 'Rigettata';
    $type_istr = 'danger';
  }
  $span_istr='<span class="badge badge-'.$type_istr.'">'.$text_istr.'</span><br>Pec inviata il '.date("d/m/Y",strtotime($status_istr['data_invio'])).$add_span;
   }?>


<h3 class="card-title">Istanza n° <?=$i['id_RAM']?>/<?=$tipo_istanza['anno']?> - <span style="font-size:17px;"><?=$i['ragione_sociale']?></span></h3>
<div class="row">
  <div class="col-lg-4 col-12">
  Stato Istanza <?=$span?>
  </div>
  <?php if($status_istr){?>
  <div class="col-lg-4 col-12">
    Stato Istruttoria <?=$span_istr?>
  </div>
  <?php }?>
</div>




  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-tab1-tab" data-toggle="tab" href="#nav-tab1" role="tab" aria-controls="nav-tab1" aria-selected="true">Dati della Domanda</a>
      <a class="nav-item nav-link" id="nav-tab2-tab" data-toggle="tab" href="#nav-tab2" role="tab" aria-controls="nav-tab2" aria-selected="false">Investimento / Rendicontazione</a>
     <a class="nav-item nav-link" id="nav-tab3-tab" data-toggle="tab" href="#nav-tab3" role="tab" aria-controls="nav-tab3" aria-selected="false">Comunicazioni
    <?php
      if($notifiche){
        if(count($notifiche)>1){
          $textnot = 'nuove notifiche';
        }else{
        $textnot = 'nuova notifica';
        }
        ?>                 
    <br><span class="badge badge-warning"> <?=count($notifiche)?></span> <small> <?=$textnot?></small>
    <?php
      }
    ?></a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane p-4 fade show active" id="nav-tab1" role="tabpanel" aria-labelledby="nav-tab1-tab">
      <div class="row">
        <div class="col-12 col-lg-4">
          <!--start card-->
          <div class="card-wrapper">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Dati richiedente</h5>
                <table class="table table-sm">
        
                  <tbody>
                      <tr>
                      <th scope="row">Cognome</th>
                      <td><?=$i['cognome']?></td>
                      
                      </tr>
                      <tr>
                      <th scope="row">Nome</th>
                      <td><?=$i['nome']?></td>
                      
                      </tr>
                      <tr>
                      <th scope="row">Data di Nascita</th>
                      <td><?=date("d/m/Y",strtotime($i['data_nascita']))?></td>
                  
                      </tr>
                      <tr>
                      <th scope="row">Luogo di Nascita</th>
                      <td><?=$i['luogo_nascita']?> (<?=$i['prov_nascita']?>)</td>
                  
                      </tr>
                      <tr>
                      <th scope="row">Indirizzo Residenza</th>
                      <td><?=$i['indirizzo_residenza']?>, <?=$i['civico_residenza']?></td>
                  
                      </tr>
                      <tr>
                      <th scope="row">Comune Residenza</th>
                      <td><?=$i['cap_residenza']?> - <?=$i['comune_residenza']?> (<?=$i['prov_residenza']?>)</td>
                  
                      </tr>
                      <tr>
                      <th scope="row">email</th>
                      <td><?=$i['email_richiedente']?></td>
                  
                      </tr>
                      <?php
                       $dichiarante  =getTipoDich($i['tipo_dichiarante']);
                       $dich = $dichiarante['descrizione_tipo'];
                       ?> 
                      <tr>
                      <th scope="row">Tipo</th>
                      <td><?=$dich?></td>
                  
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!--end card-->
        </div>
        <div class="col-12 col-lg-8">
          <!--start card-->
          <div class="card-wrapper">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Dati Impresa</h5>
                <div class="row">
                  <div class="col-lg-6 col-12">
                      <table class="table table-sm">
              
                          <tbody>
                              <tr>
                              <th scope="row">Ragione Sociale</th>
                              <td><?=$i['ragione_sociale']?></td>
                              
                              </tr>
                              <tr>
                              <th scope="row">Partita IVA</th>
                              <td><?=$i['piva']?></td>
                          
                              </tr>
                              <tr>
                              <th scope="row">Codice Fiscale</th>
                              <td><?=$i['cf']?></td>
                          
                              </tr>
                              
                              
                              
                              <tr>
                              <th scope="row">Indirizzo Impresa</th>
                              <td><?=$i['indirizzo_impr']?>, <?=$i['civico_impr']?></td>
                          
                              </tr>
                              <tr>
                              <th scope="row">Comune Impresa</th>
                              <td><?=$i['cap_impr']?> - <?=$i['comune_impr']?> (<?=$i['prov_impr']?>)</td>
                          
                              </tr>
                              
                              <tr>
                              <th scope="row">Email Impresa</th>
                              <td><?=$i['email_impr']?></td>
                          
                              </tr>
                              <tr>
                              <th scope="row">Pec Impresa</th>
                              <td><?=$i['pec_impr']?></td>
                          
                              </tr>
                              <tr>
                              <th scope="row">Telefono Impresa</th>
                              <td><?=$i['pref_tel_impr']?> / <?=$i['num_tel_impr']?></td>
                          
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  <div class="col-lg-6 col-12"> 
                      <table class="table table-sm">
                          <tbody>
                          <?php
                           $tipoimpresa = getTipoImpresa($i['tipo_impresa']);
                           $tipImr = $tipoimpresa['descrizione_tipo'];
                           ?>
                              <tr>
                              <th scope="row">Tipo Impresa</th>
                              <td><?=$tipImr?></td>
                              </tr>
                              <tr>
                              <th scope="row">Codice Albo</th>
                              <td><?=$i['codice_albo']?></td>
                              </tr>
                              <tr>
                              <th scope="row">Codice Ren</th>
                              <td><?=$i['codice_ren']?></td>
                              </tr>
                              <tr>
                              <th scope="row">CCIAA</th>
                              <td>Provincia <?=$i['cciaa_prov']?><br>Codice <?=$i['cciaa_codice']?><br>Data <?=date("d/m/Y",strtotime($i['cciaa_data']))?></td>
                              </tr>
                              <tr>
                              <th scope="row">Codice A.TE.CO</th>
                              <td><?=$i['codice_ateco']?></td>
                              </tr>
                              <tr>
                              <th scope="row">Banca</th>
                              <td>Istituto <?=$i['banca_istituto']?><br>
                                  Agenzia <?=$i['banca_agenzia']?><br>
                                  IBAN <?=$i['iban_it']?> <?=$i['iban_num_chk']?> <?=$i['iban_cin']?> <?=$i['iban_abi']?> <?=$i['iban_cab']?> <?=$i['iban_cc']?></td>
                              </tr>
                              <tr>
                              <th scope="row">Maggiorazione PMI</th>
                              <td><?=$i['pmi']=='Off'?'Non Presente':'Presente'?></td>
                              </tr>
                              <tr>
                              <th scope="row">Maggiorazione Contratto rete d'Imprese</th>
                              <td><?=$i['rete']=='Off'?'Non Presente':'Presente'?></td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--end card-->
        </div>
      </div>
      
    
    </div>
    <div class="tab-pane p-4 fade" id="nav-tab2" role="tabpanel" aria-labelledby="nav-tab2-tab">
                    

        
           <?php
            require "inforend.php";

            

            require "alleistanza2.php";
            ?>
       
        <div class="row">
          <div class="col-12">
            <div id="collapseDiv1-sc1" class="collapse-div collapse-background-active " role="tablist">
              <?php
              $cat=getCatInc();
              $accord=1; 

              $catA=$i['nv1']||$i['nv2']||$i['nv3']||$i['nv4']||$i['nv5']||$i['nv6']||$i['nv7']||$i['nv8']||$i['nv9']||$i['nv10']||$i['nv11'];
              $catB=$i['r_nv_1']||$i['r_nv_2']||$i['r_nv_3'];
              $catC=$i['nr_1']||$i['nr_2'];
              $catD=$i['ng_1'];


              foreach($cat as $ca){
                  if($ca['ctgi_categoria']=='A'&&$catA){
                    

                      require "tabcat.php";
                  }elseif($ca['ctgi_categoria']=='B'&&$catB){
                   
                    require "tabcat.php";  
                  }elseif($ca['ctgi_categoria']=='C'&&$catC){
                   
                    require "tabcat.php";    
                  }elseif($ca['ctgi_categoria']=='D'&&$catD){
                   
                      require "tabcat.php";   
                  }
                }?>  

            </div>
          </div>
        </div>
                                              
    </div>
    <div class="tab-pane p-4 fade" id="nav-tab3" role="tabpanel" aria-labelledby="nav-tab3-tab">
                <?php require 'user_ticket_tab.php'?>
    </div>
    
    
  </div>
  <!-- Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="docModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Inserimento Documenti Veicolo
          </h5>
        </div>
        <div class="modal-body">
          <form method="post" id="form_allegato" enctype="multipart/form-data">
          <input type="hidden" name="id_RAM" value="<?=$i['id_RAM']?>">
          
          
          <input type="hidden" name="tipo_veicolo" id="tipo_veicolo" value="">
          <input type="hidden" name="progressivo" id="progressivo" value="">
            <div class="bootstrap-select-wrapper seldoc">
                <label>Tipo Documento</label>
                <select id="tipo_documento" name="tipo_documento"title="Scegli un tipo di documento">
              
              </select>
            </div>
            <div id="campi_allegati" style="margin-top:50px;">
            </div>
          </form> 

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
          <button class="btn btn-primary btn-sm" form="form_allegato"type="submit">Salva Allegato Veicolo</button>
        </div>
      </div>
    </div>
  </div> 
  <div class="modal fade" tabindex="-1" role="dialog" id="infoModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Info dati Veicolo
          </h5>
        </div>
        <div class="modal-body">
        
          <div class="container">
            <form method="post" id="form_infovei">
              <input type="hidden" id="info_idvei" value="" >
              <input type="hidden"id="info_prog" value="">
              <input type="hidden" id="info_tipo_veicolo" value="">
              <div class="form-group">
                  <input type="text" required placeholder="Inserire targa" oninput="this.value = this.value.toUpperCase();"value="<?=$rv['targa']?>" class="form-control" id="targa" name="targa" required>
              
                <label for="username" >Targa</label>
                <div class="invalid-feedback">Per favore scegli un username.</div>
              </div>
              <div class="form-group">
                  <input type="text" required placeholder="Inserire marca" value="" oninput="this.value = this.value.toUpperCase();"class="form-control" id="marca" name="marca" required>
              
                <label for="username" >Marca</label>
              </div>
              <div class="form-group">
                  <input type="text" required placeholder="Inserire modello" oninput="this.value = this.value.toUpperCase();"value="" class="form-control" id="modello" name="modello" required>
              
                <label for="username" >Modello</label>
              </div>
              <label for="costo" class="input-number-label" style="margin-top: -25px;">Costo</label>
              <span class="input-number input-number-currency">
                <input type="number" id="costo" name="costo" value="0.00" step="any"min="1.00" required>
                
              </span>
            
              <div class="bootstrap-select-wrapper selinfo" style="margin-top:50px;">
                  <label for="roletype" >Tipo Acquisizione</label>
                  <select title="Scegli una opzione"  class="selectpicker required" id="tipo_acquisizione" name="tipo_acquisizione"  >
                      
                      <option value="01">Acquisto</option>
                      <option value="02">Leasing</option>
                      
                  </select>
                
              </div>
            </form>
          </div>
          
        
          

            
            
          

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
          <button class="btn btn-primary btn-sm" form="form_infovei"type="submit">Salva Dati Veicolo</button>
        </div>
      </div>
    </div>
  </div> 
  <div class="modal fade" tabindex="-1" role="dialog" id="docMaggiorazione">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Inserimento Allegati per Maggiorazione
          </h5>
        </div>
        <div class="modal-body">
          <form method="post" id="form_allegato_mag" enctype="multipart/form-data">
            <input type="hidden" name="id_RAM" value="<?=$i['id_RAM']?>">
            <input type="hidden" name="tipo_doc_mag" id="tipo_doc_mag" value="">
            <input type="hidden" name="tipo_alle" id="tipo_alle" value="">
            <label>Tipo Allegato</label>
              <div class="form-group">
                <textarea rows="3" style="text-align: justify;"class="form-control" type="text" id="tipo_documento_magg" name="tipo_documento" readonly></textarea>
                
              </div>

              <div class="form-group">
                <label for="file_allegato" class="active">Allegato</label>
                <input type="file" accept="application/pdf" class="form-control-file" onchange="checkAlle();" id="file_allegato" name="file_allegato"required><small>Dimensioni Max 3MB - accettati solo PDF</small>
              </div>

            
          </form> 

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
          <button class="btn btn-primary btn-sm" form="form_allegato_mag"type="submit">Salva Allegato per Maggiorazione</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog" id="infoAllegato">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Info Allegato
          </h5>
        </div>
        <div class="modal-body">
        
          <div class="container">
          <table class="table table-sm" id="info_tab_alle">
            
            <tbody>
              
            </tbody>
          </table>
            
          </div>
          
        
          

            
            
          

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
          
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
                                                
                                          