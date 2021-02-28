<div class="row">
<?php
 //   require "alleistanza2.php";
?>
</div>
<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Tipo Veicolo</th>
                <th>Prog</th>
                <th>Dati Veicolo</th>
                
                <th>Acquisizione</th>
                <th>Importo</th>
                <th>Stato</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $veicoli = getVeicoli($i['id_RAM']);
        //var_dump($veicoli);
        ?>
            

            <?php
                foreach($veicoli as $v){
                    $tipo = getTipoVeicolo($v['tipo_veicolo']);
                    $categ = getCategoria($tipo['codice_categoria_incentivo']);
                    $countDocVeicolo=countDocVeicolo($v['tipo_veicolo']);
                
                    if(!$v['targa']&&!$v['marca']&&!$v['modello']&&!$v['tipo_acquisizione']&&!$v['costo']){
                        $color="danger";
                        $text="Non Presenti";
                        
                    }else{
                        $color="success";
                        $text="Presenti";
                    }                    
                    if($v['tipo_acquisizione']=='01'){
                        $countDocVeicolo =$countDocVeicolo-1;
                    }
                    $countDocVeicoloInfo=countDocVeicoloInfo($v['id_RAM'],$v['tipo_veicolo'],$v['progressivo']);
                    $alleok = 0;
                    $alleno= 0;
                    $countAlle =0;
                    $alleok = getAlleOk($v['id_RAM'],$v['tipo_veicolo'],$v['progressivo']);
                    $alleok = intval($alleok);
                    //var_dump($alleok);
                    $alleno = getAlleNo($v['id_RAM'],$v['tipo_veicolo'],$v['progressivo']);
                    $alleno = intval($alleno);
                    $countAlle = countAlle($v['id_RAM'],$v['tipo_veicolo'],$v['progressivo']);
                    $countAlle = intval($countAlle);
                    //var_dump($alleok);var_dump($alleno);var_dump($countAlle);
                    $countDocVeicolo = intval($countDocVeicolo);
                    $countDocVeicoloInfo = intval($countDocVeicoloInfo);
                // var_dump($countDocVeicolo);
                    //var_dump($countDocVeicoloInfo);
                    if($alleok==$countAlle){
                       $alleType="success";
                    }else{
                        $alleType="warning";
                    }
                    if($alleno == 0){
                        $allenoType = "success";
                    }else{
                        $allenoType = "danger";
                    }
                    
                    if($countDocVeicoloInfo==$countDocVeicolo){

                        $countType = 'success';
                    }else{
                        $countType = 'warning';
                    }

                    if($v['stato_admin']=='A'||$v['stato_admin']==null){
                        $stato_admin = '<span class="badge badge-warning" style="width: -webkit-fill-available;">In Lavorazione</span>';
                    }
                    if($v['stato_admin']=='B'){
                        $stato_admin = '<span class="badge badge-success" style="width: -webkit-fill-available;">Accettata</span>';
                    }
                    if($v['stato_admin']=='C'){
                        $stato_admin = '<span class="badge badge-danger" style="width: -webkit-fill-available;">Rigettata</span>';
                    }
            ?>
            <tr>
                <td scope="row" style="vertical-align:middle;"><span class="badge badge-danger" style="font-size:20px;"><?=$categ['ctgi_categoria']?></span></td>
                <td style="vertical-align:middle;"><span class="badge badge-secondary" style="font-size:20px;width: -webkit-fill-available;"><?=$tipo['tpvc_descrizione_breve']?></span></td>
                <td style="vertical-align:middle;"><span class="badge badge-success" style="font-size:20px;"><?=$v['progressivo']?></span></td>
                <td style="vertical-align:middle;">Targa <span class="badge badge-primary" style="font-size:20px;"><?=$v['targa']?></span><br>
                                                    Marca <b><?=$v['marca']?></b><br>
                                                    Modello <b><?=$v['modello']?></b></td>
                
                <td style="vertical-align:middle;"><?=$v['tipo_acquisizione']=="01"?'<span class="badge badge-info"  style="width: -webkit-fill-available;">Acquisizione</span>':'<span class="badge badge-warning"  style="width: -webkit-fill-available;">Leasing</span>'?></td>
                <td style="vertical-align:middle;"><?=$v['costo']?'€ '.number_format($v['costo'], 2, ',', '.'):'Non Presente'?></td>
                <td style="vertical-align:middle;">
                <div class="row">
                    <table class="table-sm table-borderless" style="font-size:15px;" class="col-6">
                    <tr>
                        <td>Stato Istruttoria</td><td id="stato_istruttoria_<?=$v['id']?>"><?=$stato_admin?></td>
                        <?php
                            if($v['stato_admin']=='B'||$v['stato_admin']=='C'){?>
                                <td>da</td>
                                <td id="user_istruttoria_<?=$v['id']?>">
                                <?=$v['user_admin']?></td>
                         <?php
                           }else{?>
                           <td> </td> <td id="user_istruttoria_<?=$v['id']?>">______ </td>

                           <?php
                           }?>
                        </tr>
                    <tr>
                        <td rowspan="2">Documenti Veicolo</td><td rowspan="2"><span style="width: -webkit-fill-available;"class="badge badge-<?=$countType?>"><?=$countDocVeicoloInfo?> di <?=$countDocVeicolo?></span></td>
                            <td>Accettati</td><td id="accettati_<?=$v['id']?>"><span style="width: -webkit-fill-available;"class="badge badge-<?=$alleType?>"><?=$alleok?> di <?=$countAlle?></span></td>
                    </tr>
                    <tr>
                        <td>Respinti</td><td id="respinti_<?=$v['id']?>"><span style="width: -webkit-fill-available;"class="badge badge-<?=$allenoType?>"><?=$alleno?> di <?=$countAlle?></span></td>
                    </tr>
                    <tr>
                    <td>Dati Veicolo</td><td id="tot_alle_<?=$v['id']?>"><span class="badge badge-<?=$color?>" style="width: -webkit-fill-available;"><?=$text?></span></td><td colspan="3"></td>
                    </tr>        
                    </table>
                   
                </div>    
                </td>
                <td><button type="button" onclick="infovei(<?=$v['id']?>,'<?=$categ['ctgi_categoria']?>','<?=$tipo['tpvc_descrizione_breve']?>');"class="btn btn-success btn-xs" title="Visualizza Info Veicolo"style="padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>
    </td>

            </tr>


            <?php
                }
            ?>
        
        </tbody>
    </table>
</div>    

<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalinfovei" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width:80%">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Scheda Veicolo<br><small>n° protocollo <?=$i['id_RAM']?>/2020 - <?=$i['ragione_sociale']?></small>
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <svg class="icon">
                  <use xlink:href="/bootstrap-italia/dist/svg/sprite.svg#it-close"></use>
               </svg>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h5 style="font-weight: bold;">Dati Veicolo</h5>
                    <table class="table table-sm">
                        <tbody>
                            <tr><td>Categoria</td><td id="info_cat_veicolo"></td></tr>
                            <tr><td>Tipo Veicolo</td><td id="info_tipo_veicolo"></td></tr>
                            <tr><td>Targa</td><td id="info_targa" style="font-weight:bold;"></td></tr>
                            <tr><td>Marca</td><td id="info_marca" style="font-weight:bold;"></td></tr>
                            <tr><td>Modello</td><td id="info_modello" style="font-weight:bold;"></td></tr>
                            <tr><td>Costo</td><td id="info_costo" style="font-weight:bold;"></td></tr>
                            <tr><td>Acquisizione</td><td id="info_tipo_acquisizione" style="font-weight:bold;"></td></tr>
                            
                        </tbody>
                    </table>
                   
                </div>
               
                <div class="col-12 col-lg-6">
                <h5 style="font-weight: bold;">Dati Istruttoria</h5>
                
                    <table class="table table-sm">
                    <input type="hidden" id="info_contr" value="">
                    <input type="hidden" id="info_contr_pmi" value="">
                    <input type="hidden" id="info_contr_rete" value="">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Calcolato</th>
                            <th>Accordato</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <td>Valore Contributo</td>
                                <td id="contributo"></td>
                                <td><span class="input-number input-number-currency">
                                    <input type="number" id="contr_up" name="contr_up" value="0.00" min="0">
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Maggiorazione PMI</td>
                                <td id="contr_pmi"></td>
                                <td> <span class="input-number input-number-currency">
                                    <input type="number" id="contr_up_pmi" name="contr_up_pmi" value="0.00" min="0">
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Maggiorazione RETE</td>
                                <td id="contr_rete"></td>
                                <td><span class="input-number input-number-currency">
                                    <input type="number" id="contr_up_rete" name="contr_up_rete" value="0.00" min="0">
                                    </span></td></tr>
                            <tr><td>Note</td><td  colspan="2"> <div class="form-group">
                                            <textarea id="info_note_admin" rows="3"></textarea>
                                         
                                            </div></td></tr>
                            <tr><td>Stato Lavorazione</td><td id="info_stato_admin"></td><td></td></tr>
                        </tbody>
                        <tfoot>
                            <tr><td colspan="3"><button type="button" id="btn_istr"class="btn btn-primary" style="float:right;" onclick="infoVeiIstr();">
                                    Aggiorna dati
                            </button></td></tr>
                        </tfoot>
                    </table>
                   
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4>Documentazione</h4>
                    <table class="table table-sm" id="doctab">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Note</th>
                                    <th>Stato</th>
                                    <th>Note Admin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                    </table>        

                </div>            
            </div>
         </div>
         <div class="modal-footer">
            <button class="btn btn-primary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
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
                    <div id="upinfoalle">
                        
                    
                    </div>
                
                </div>
                

                
                
                

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
                <button class="btn btn-primary btn-sm"  onclick="info_alle();" type="button">Salva Modifichce</button>
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="istruttoriaModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Dati Istruttoria
        </h5>
      </div>
      <div class="modal-body">
        <form method="get" action="" id="formIstr">
        <input type="hidden" id="id_veicolo" name= "id_veicolo" value="">
                <div class="form-group" style="margin-bottom:15px;">
                    <input type="text" class="form-control"name="note_istruttoria" placeholder="Scrivi Nota" id="note_istruttoria">
                    <label for="exampleInputText">Note</label>
                </div>
              
          
                

             
          <div class="bootstrap-select-wrapper">
            <label>Stato Lavorazione</label>
                <select title="Seleziona Stato" name="stato_istruttoria" id="stato_istruttoria">
                     <option value="A">In Lavorazione</option><option value="B">Accettata</option><option value="C">Rigettata</option>
                </select>
          </div>      
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Annulla</button>
        <button class="btn btn-primary btn-sm" id="btn_info_istr"onclick="upIstr()"type="button">Aggiorna Informazioni</button>
      </div>
    </div>
  </div>
</div>
