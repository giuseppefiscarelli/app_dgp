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
                <th style="min-width:150px;">Importo</th>
                <th>Stato</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $veicoli = getVeicoli($i['id_RAM']);
        //var_dump($veicoli);
       
            $check_ammissione = 0;
                foreach($veicoli as $v){
                    if($v['stato_admin']=='A'||$v['stato_admin']==null){
                        $check_ammissione++;
                    }
                    $tipo = getTipoVeicolo($v['tipo_veicolo']);
                    //var_dump($v['tipo_veicolo']);
                    //var_dump($tipo);
                    $checkRott = checkRott($i['id_RAM'],$v['tipo_veicolo']);
                   // var_dump($checkRott);
                    /*$rottamazione = false;
                    if($tipo['tpvc_codice'] == 1){
                        $check_string_rottamazione = 'rott'.$v['tipo_veicolo'];
                        if($i[$check_string_rottamazione]){
                           $rottamazione = true;
                        }
                    }
                    var_dump($rottamazione);*/
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
                    if($checkRott){
                                                       
                        $countDocVeicoloRottInfo=countDocVeicoloRottInfo($v['id_RAM'],$v['tipo_veicolo'],$v['progressivo']);
                       // var_dump($countDocVeicoloRottInfo);
                        $countDocVeicolo = $countDocVeicolo +$countDocVeicoloRottInfo;
                        //$countDocVeicoloInfo=$countDocVeicoloInfo-$countDocVeicoloRottInfo;
                        //$countDocVeicoloInfo<0?$countDocVeicoloInfo=0:$countDocVeicoloInfo;
                    }
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
                           <td> </td> <td id="user_istruttoria_<?=$v['id']?>"> </td>

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
                <td>
                <?php
               
                if(!$disable_actions){?>
                    <button type="button" onclick="infovei(<?=$v['id']?>,'<?=$categ['ctgi_categoria']?>','<?=$tipo['tpvc_descrizione_breve']?>');"class="btn btn-success btn-xs" title="Visualizza Info Veicolo"style="padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>
                <?php }?>
                </td>

            </tr>


            <?php
                }
            ?>
        
        </tbody>
    </table>
</div>    
<style>
  .blink {
      animation: blink 2s steps(5, start) infinite;
      -webkit-animation: blink 1s steps(5, start) infinite;
    }
    @keyframes blink {
      to {
        visibility: hidden;
      }
    }
    @-webkit-keyframes blink {
      to {
        visibility: hidden;
      }
    }
</style>
<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalinfovei" data-backdrop="static" data-keyboard="false" style="max-height:fit-content;overflow: auto;">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width:80%;">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Scheda Veicolo<br><small>n° protocollo <?=$i['id_RAM']?>/2020 - <?=$i['ragione_sociale']?></small>
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <svg class="icon">
                  <use xlink:href="svg/sprite.svg#it-close"></use>
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
                    <div class="row" id="istr_table" style="display:none;">
                    
                   
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
                                    <td style="vertical-align:middle;">Costo Veicolo</td>
                                    <td style="vertical-align:middle;"id="info_costo_istr"></td>
                                    <td><span class="input-number input-number-currency">
                                        <input type="number" id="costo_istr" name="costo_istr" value="0" min="0">
                                        </span></td>

                                </tr>
                            
                                <tr>
                                    <td style="vertical-align:middle;">Valore Contributo</td>
                                    <td style="vertical-align:middle;"id="contributo"></td>
                                    <td ><span class="input-number input-number-currency">
                                        <input type="number" id="contr_up" name="contr_up" value="0" min="0">
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:middle;">Maggiorazione PMI</td>
                                    <td style="vertical-align:middle;" id="contr_pmi"></td>
                                    <td> <span class="input-number input-number-currency">
                                        <input type="number" id="contr_up_pmi" name="contr_up_pmi" value="0" min="0">
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:middle;">Maggiorazione RETE</td>
                                    <td style="vertical-align:middle;" id="contr_rete"></td>
                                    <td><span class="input-number input-number-currency">
                                        <input type="number" id="contr_up_rete" name="contr_up_rete" value="0" min="0">
                                        </span></td>
                                </tr>
                                <tr id="tr_contr_rottamazione" style="display:none;">
                                    <td style="vertical-align:middle;">Maggiorazione Rottamazione</td>
                                    <td style="vertical-align:middle;" colspan="2" id="contr_rottamazione"></td>
                                    
                                </tr>
                                <tr><td>Note</td>
                                    <td  colspan="2"> <div class="form-group">
                                                <textarea id="info_note_admin" rows="3" readonly></textarea>
                                            
                                                </div></td></tr>
                                <tr><td>Stato Lavorazione</td><td id="info_stato_admin"></td><td></td></tr>
                            </tbody>
                            <tfoot id="istruttoria_btn" style="<?=$disableIstruttoriafoot?'display:none;':''?>">
                                <tr><td colspan="2" id="info_aggiorna_dati"></td>
                                <!--<button type="button" id="btn_calc_contr"class="btn btn-primary" style="float:left;" onclick="calcolaContr();">
                                        Calcola Contributo
                                </button>-->
                                <td >
                                <button type="button" id="btn_istr"class="btn btn-primary" style="float:right;" onclick="infoVeiIstr();">
                                        Aggiorna dati
                                </button></td></tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row" id="alert_istr" style="display:none;">
                    <i class="fa fa-3x fa-exclamation-circle blink"></i>
                     
                     <br>Allegati dichiarazioni e certificazioni non completi
                    </div>
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
                <div class="form-group" style="margin-bottom:30px;">
                    <input type="text" class="form-control"name="note_istruttoria" placeholder="Scrivi Nota" id="note_istruttoria">
                    <label for="exampleInputText">Note</label>
                </div>
              
          
                

             
          <div class="bootstrap-select-wrapper">
            <label>Stato Lavorazione</label>
                <select title="Seleziona Stato" name="stato_istruttoria" id="stato_istruttoria">
                     <option value="A">In Lavorazione</option>
                     <option value="B">Accettata</option>
                     <option value="C">Rigettata</option>
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


<script>

        function getInfoVeicolo2(id,cat,tipvei){

        }
        function infovei(id,cat,tipo){
             status_istanza = <?=$status['aperta']?> ;
             $('#info_aggiorna_dati').html('')
            $("#stato_istruttoria option[value='B']").attr('disabled', false);
            $('#stato_istruttoria').selectpicker('refresh')
            const formatter = new Intl.NumberFormat('it-IT', {
                  style: 'currency',
                  currency: 'EUR',
                  minimumFractionDigits: 2
            })
                  $('#doctab tbody').empty();
                  $('#modalinfovei').modal('toggle');
                  $('#contributo').html("")
                  $('#contr_pmi').html("")
                  $('#contr_rete').html("")
                  $('#info_contr').val("")
                  $('#info_contr_pmi').val("")
                  $('#info_contr_rete').val("")
                  $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getInfoVei",
                        data: {id:id},
                        dataType: "json",
                        success: function(data){
                            console.log(data)
                            if(data.check_istruttoria){
                                $('#istr_table').show()
                                $('#alert_istr').hide()
                            }else{
                                $('#istr_table').hide()
                                $('#alert_istr').show()
                            }
                            if(data.check_rottamazione){
                                $('#tr_contr_rottamazione').show();
                                 $('#contr_rottamazione').text('Prevista')

                            }else{
                                $('#tr_contr_rottamazione').hide();
                                 $('#contr_rottamazione').text('')
                            }
                              $('#id_veicolo').val(data.id)
                              contr = parseFloat(data.val_contributo).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                              val_pmi = parseFloat(data.val_pmi).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                              val_rete = parseFloat(data.val_rete).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                              $('#info_contr').val(data.val_contributo)
                              $('#info_contr_pmi').val(data.val_pmi)
                              $('#info_contr_rete').val(data.val_rete)
                              $('#contributo').html(contr)
                              contr_up = data.valore_contr??0
                              $('#contr_up').val(contr_up)
                              $('#contr_pmi').html(val_pmi)
                              pmi_istr = data.pmi_istr??0;
                              $('#contr_up_pmi').val(pmi_istr)
                             
                              $('#contr_rete').html(val_rete)
                              rete_istr = data.rete_istr??0
                              $('#contr_up_rete').val(rete_istr)

                              $('#info_targa').html(data.targa)
                              $('#info_marca').html(data.marca)
                              $('#info_modello').html(data.modello)
                              $('#info_note_admin').html(data.note_admin??'')
                              $('#btn_istr').attr('onclick','infoVeiIstr('+data.id+')');
                              if(data.stato_admin=='A'||data.stato_admin==null){
                                    stato='<span class="badge badge-warning">In Lavorazione</span>';
                                    stato_alle = false;
                              }
                              if(data.stato_admin=='B'){
                                    stato='<span class="badge badge-success">Accettata</span>';
                                    stato_alle = true;
                                    $('#costo_istr,#contr_up,#contr_up_pmi,#contr_up_rete').prop('disabled', true)
                              }
                              if(data.stato_admin=='C'){
                                   stato='<span class="badge badge-danger">Rigettata</span>';
                                   $('#costo_istr,#contr_up,#contr_up_pmi,#contr_up_rete').prop('disabled', true)
                                   stato_alle = true;
                              }
                              $('#info_stato_admin').html(stato);
                              v = formatter.format(data.costo);
                              $('#info_costo,#info_costo_istr').html(v)
                              imp_costo = data.costo_istr !== null?data.costo_istr:data.costo;
                              $('#costo_istr').val(imp_costo)
                              
                              if(data.tipo_acquisizione =="01"){
                                    tipoac="Acquisto";
                              }
                              if(data.tipo_acquisizione =="02"){
                                    tipoac="Leasing";
                              }
                              $('#info_tipo_acquisizione').html(tipoac);
                             cat='<span class="badge badge-danger" style="font-size:20px;width: -webkit-fill-available;">'+cat+'</span>';
                             tipo ='<span class="badge badge-secondary" style="font-size:20px;width: -webkit-fill-available;">'+tipo+'</span>';
                              $('#info_tipo_veicolo').html(tipo)
                              $('#info_cat_veicolo').html(cat)
                              $('#btn_calc_contr').attr('onclick', 'calcolaContr('+id+');')
                            
                             $.ajax({
                                    type: "POST",
                                    url: "controller/updateIstanze.php?action=getAllegatiCheck",
                                    data: {id_RAM:data.id_RAM,tipo_veicolo:data.tipo_veicolo,progressivo:data.progressivo},
                                    dataType: "json",
                                    success: function(response){
                                        alle = response.res
                                        validalle =response.ok
                                        if(validalle == false){
                                            $('#info_aggiorna_dati').html('Verificare Documentazione veicolo<br>Accettazione istruttoria disabilitata')
                                            $("#stato_istruttoria option[value='B']").attr('disabled', true);
                                            $('#stato_istruttoria').selectpicker('refresh')
                                        }
                                        //console.log(alle)
                                        //console.log(validalle)
                                        //console.log('stato allegato '+stato_alle)
                                         $.each(alle, function (k,v){
                                               if(v.stato_admin=='A'){
                                                stato='<span class="badge badge-warning">In Lavorazione</span>';
                                               }
                                               if(v.stato_admin=='B'){
                                                stato='<span class="badge badge-success">Accettato</span>';
                                               }
                                               if(v.stato_admin=='C'){
                                                stato='<span class="badge badge-danger">Rigettato</span>';
                                               }
                                               note_ad ='';
                                               if(v.note_admin){
                                               note_ad=v.note_admin.length > 20?v.note_admin.substr(0, 20) + '...':v.note_admin;
                                                }
                                               note = v.note.length > 20?v.note.substr(0, 20) + '...':v.note;
                                                if(status_istanza){
                                                    buttonA='';
                                                }else{
                                                    buttonA='<button type="button" onclick="infoAlle('+v.id+');"class="btn btn-warning btn-xs workbtn" title="Visualizza Info Allegato"style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>'
                                                }
                                                buttonB='<button type="button" onclick="window.open(\'allegato.php?id='+v.id+'\', \'_blank\')"title="Vedi Documento"class="btn btn-xs btn-primary " style="padding-left:12px;padding-right:12px;margin-right:10px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                                buttonC='<a type="button" href="download.php?id='+v.id+'" download title="Scarica Documento"class="btn btn-xs btn-success " style="padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i> </a>'
                                               
                                              
                                            row = '<tr><td>'+v.tdoc_descrizione+'</td><td data-toggle="tooltip" data-placement="right" title="'+v.note+'">'+note+'</td><td id="stato_admin_'+v.id+'">'+stato+'</td><td id="note_admin_'+v.id+'" data-toggle="tooltip" data-placement="right" title="'+v.note_admin+'">'+note_ad+'</td><td>'+buttonA+''+buttonB+''+buttonC+'</td></tr>'            
                                                $('#doctab> tbody:last-child').append(row);
                                                if(stato_alle){
                                                    $('.workbtn').hide()
                                                }
                                                if(v.tipo_documento == 14 && v.stato_admin=='B'){
                                                        $('#contr_rottamazione').text('Calcolata')
                                                }

                                         })
                                          
                                    
                                                                  
                                    }
                              })
                              
                                $('[data-toggle="tooltip"]').tooltip()
                                $('[data-toggle="popover"]').popover()
                            
                                                          
                        }
                  })


        } 
        function infoVeiIstr(id){
            note = $('#info_note_admin').html();
            stato =$('#info_stato_admin').text();

            contr=$('#info_contr').val()
            pmi=$('#info_contr_pmi').val()
            rete=$('#info_contr_rete').val()

            up_contr =$('#contr_up').val()
            contr_up_pmi= $('#contr_up_pmi').val()
            contr_up_rete= $('#contr_up_rete').val()

            contr = parseFloat(contr).toFixed(2);
            pmi = parseFloat(pmi).toFixed(2);
            rete = parseFloat(rete).toFixed(2);
            up_contr = parseFloat(up_contr).toFixed(2);
            contr_up_pmi = parseFloat(contr_up_pmi).toFixed(2);
            contr_up_rete = parseFloat(contr_up_rete).toFixed(2);
            //console.log(contr,up_contr)
            //console.log(pmi,contr_up_pmi)
            //console.log(rete,contr_up_rete)
            if(contr != up_contr||contr_up_pmi!=pmi||contr_up_rete!=rete){
                Swal.fire({                  
                    title: "I valori calcolati sono differenti da quelli accordati",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Prosegui!',
                    cancelButtonText: 'Torna Indietro'
                }).then(
                    (result) => {
                        if (result.isConfirmed) {
                            $('#note_istruttoria').val(note);
                            if(stato=="In Lavorazione"){
                                stato='A';
                            }
                            if(stato=="Accettata"){
                                stato='B';
                            }
                            if(stato=="Rigettata"){
                                stato='C';
                            }
                            

                            //console.log(stato);
                        
                            $('#stato_istruttoria').val(stato);
                            $('.bootstrap-select-wrapper select').selectpicker('refresh');
                            $('#istruttoriaModal').modal('toggle');
                            $('#istruttoriaModal').css("z-index", parseInt($('.modal-backdrop').css('z-index'))+100);
                            $('.modal-backdrop').css('z-index',1050);
                            $('.modal-backdrop').css('opacity', 0.4)
                            $('#id_veicolo').val(id);
                        
                            $('#btn_info_istr').attr('onclick','upIstr('+id+')');
                        }
               
            
                    })
                }else{
                    $('#note_istruttoria').val(note);
                            if(stato=="In Lavorazione"){
                                stato='A';
                            }
                            if(stato=="Accettata"){
                                stato='B';
                            }
                            if(stato=="Rigettata"){
                                stato='C';
                            }
                            

                            //console.log(stato);
                        
                            $('#stato_istruttoria').val(stato);
                            $('.bootstrap-select-wrapper select').selectpicker('refresh');
                            $('#istruttoriaModal').modal('toggle');
                            $('#istruttoriaModal').css("z-index", parseInt($('.modal-backdrop').css('z-index'))+100);
                            $('.modal-backdrop').css('z-index',1050);
                            $('.modal-backdrop').css('opacity', 0.4)
                            $('#id_veicolo').val(id);
                        
                            $('#btn_info_istr').attr('onclick','upIstr('+id+')');
                }


            //$('#contr_up').val(contr)
            //$('#contr_up_pmi').val(pmi)

            //$('#contr_up_rete').val(rete)
           
        } 
        function info_alle(){ 
           /*Swal.fire({ 
                 html:true,
                 title: "Caricamento in Corso",
                 type: "info"
           });*/
           note_ad = $('#note_admin').val();
           id = $('#id_allegato').val();
           stato_ad=$('#stato_allegato_admin').val()
           //console.log(note_ad);
           $('#infoAllegato').modal('toggle');
           $.ajax({
                                   type: "POST",
                                   url: "controller/updateIstanze.php?action=upAlleAdmin",
                                   data: {id:id,note_admin:note_ad,stato_admin:stato_ad},
                                   dataType: "json",
                                   success: function(data){

                                        
                                         if(data.response){
                                         /*Swal.fire({ 
                                               
                                               title: "Dati Veicolo Aggiornati",
                                               type: "info"
                                         });*/
                                   
                                                if(stato_ad=='A'){
                                               stato='<span class="badge badge-warning">In Lavorazione</span>';
                                              }
                                              if(stato_ad=='B'){
                                               stato='<span class="badge badge-success">Accettato</span>';
                                              }
                                              if(stato_ad=='C'){
                                               stato='<span class="badge badge-danger">Respinto</span>';
                                              }
                                              if(data.tipo_documento == 14){
                                                if(stato_ad=='A'){
                                                    $('#contr_rottamazione').text('Prevista')
                                              }
                                              if(stato_ad=='B'){
                                                $('#contr_rottamazione').text('Calcolata')
                                              }
                                              if(stato_ad=='C'){
                                                $('#contr_rottamazione').text('Non Calcolata')
                                              }

                                              }
                                              newstato= '#stato_admin_'+id;
                                         $('#stato_admin_'+id).html(stato);
                                         $('#note_admin_'+id).html(note_ad);
                                         }

                                         id = data.id_veicolo;
                                         ok= data.accettati;
                                         no= data.respinti;
                                         tot= data.totali;
                                         totIstr = false;
                                         difftot = tot - no - ok;
                                         if( difftot == 0){
                                            totIstr = true;
                                            //alert ('ok');
                                            $('#info_aggiorna_dati').html('')
                                            $("#stato_istruttoria option[value='B']").attr('disabled', false);
                                            $('#stato_istruttoria').selectpicker('refresh')
                                         }else{
                                            $('#info_aggiorna_dati').html('Verificare Documentazione veicolo<br>Accettazione istruttoria disabilitata')
                                            $("#stato_istruttoria option[value='B']").attr('disabled', true);
                                            $('#stato_istruttoria').selectpicker('refresh')
                                         }
                                         console.log(totIstr,difftot)
                                         if(ok==tot){     
                                               badgeA=' <span style="width: -webkit-fill-available;"class="badge badge-success">'+data.accettati+' di '+data.totali+'</span>';                                              
                                         }else{
                                            
                                               badgeA=' <span style="width: -webkit-fill-available;"class="badge badge-warning">'+data.accettati+' di '+data.totali+'</span>';
                                         }
                                         if(no == 0){
                                              
                                               badgeB=' <span style="width: -webkit-fill-available;"class="badge badge-success">'+data.respinti+' di '+data.totali+'</span>'; 
                                         }else{
                                            
                                               badgeB=' <span style="width: -webkit-fill-available;"class="badge badge-danger">'+data.respinti+' di '+data.totali+'</span>';
                                         }
                                         $('#accettati_'+id).html( badgeA);
                                         $('#respinti_'+id).html( badgeB);
                                        
                                    }
           })
           
        }
        function upIstr(id){
            costo_istr = $('#costo_istr').val()
            valore_contr = $('#contr_up').val();
            pmi_istr=$('#contr_up_pmi').val()
            rete_istr=$('#contr_up_rete').val()
            note_istr=$('#info_note_admin').val()
        
            note=$('#note_istruttoria').val()
            stato=$('#stato_istruttoria option:selected').val();
           
            if(valore_contr == 0 && stato=='B'){
                Swal.fire({ 
                    
                    title: "Attenzione!",
                    text:  'Si prega di inserire un valore del contributo diverso da zero.',
                    icon: "warning"
                });

                $('#istruttoriaModal').modal('toggle');
                return false;
            }
            $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=upIstruttoria",
                        data: {
                                id:id,
                                note_admin:note,
                                stato_admin:stato,
                                costo_istr:costo_istr,
                                valore_contr:valore_contr,
                                pmi_istr:pmi_istr,
                                rete_istr:rete_istr,
                                note_istr:note_istr
                            },
                        dataType: "json",
                        success: function(data){
                              Swal.fire({ 
                                                
                                                title: "Dati Contributo Veicolo Aggiornati",
                                                icon: "info"
                                          });
                              $('#info_note_admin').html(note)
                                if(stato=='A'){
                                    stato='<span class="badge badge-warning">In Lavorazione</span>';
                                    $('.workbtn').show()
                                    $('#costo_istr,#contr_up,#contr_up_pmi,#contr_up_rete').prop('disabled', false)

                                }
                                if(stato=='B'){
                                    stato='<span class="badge badge-success">Accettata</span>';
                                    $('#costo_istr,#contr_up,#contr_up_pmi,#contr_up_rete').prop('disabled', true)
                                    $('.workbtn').hide()
                                }
                                if(stato=='C'){
                                    stato='<span class="badge badge-danger">Rigettata</span>';
                                    $('.workbtn').hide()
                                    $('#costo_istr,#contr_up,#contr_up_pmi,#contr_up_rete').prop('disabled', true)
                                }
                                $('#info_stato_admin').html(stato)
                                $('#stato_istruttoria_'+id).html(stato)
                                $('#istruttoriaModal').modal('toggle');
                        }
            })

        }
        function calcolaContr(id){

            costo_istr = $('#costo_istr').val();

            $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=upCostoIstr",
                        data: {id:id, costo_istr: costo_istr},
                        dataType: "json",
                        success: function(data){
                          
                            $.ajax({
                                type: "POST",
                                url: "controller/updateIstanze.php?action=getInfoVei",
                                data: {id:id},
                                dataType: "json",
                                success: function(data){
                                    contr = parseFloat(data.val_contributo).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                                    val_pmi = parseFloat(data.val_pmi).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});
                                    val_rete = parseFloat(data.val_rete).toLocaleString('it-IT', {style: 'currency', currency: 'EUR'});

                                    $('#info_contr').val(data.val_contributo)
                                    $('#info_contr_pmi').val(data.val_pmi)
                                    $('#info_contr_rete').val(data.val_rete)

                                    $('#contributo').html(contr)
                                    contr_up = data.valore_contr??0
                                    $('#contr_up').val(contr_up)

                                    $('#contr_pmi').html(val_pmi)
                                    pmi_istr = data.pmi_istr??0;
                                    $('#contr_up_pmi').val(pmi_istr)
                                    
                                    $('#contr_rete').html(val_rete)
                                    rete_istr = data.rete_istr??0
                                    $('#contr_up_rete').val(rete_istr)
                                }

                            })
                        }
            })

          
        }   
</script>