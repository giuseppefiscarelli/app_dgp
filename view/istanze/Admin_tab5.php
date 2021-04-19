
<?php
$tipi_integrazione =getRichInt();
$tipi_report = getTipoReport();
$reports = getReportIdRam($i['id_RAM']);



?>
<!-- Button trigger modal
<button type="button" class="btn btn-primary" onclick="newInt();">
 <i class="fa fa-plus" aria-hidden="true"> </i> Nuova Richiesta di Integrazione
</button>
 -->

<div class="row">
    <div class="col-12 col-lg-6">
    <!--start card-->
        <div class="card-wrapper">
            <div class="card">
                <div class="card-body">  
                    <div class="categoryicon-top">
                        <svg class="icon">
                            <use xlink:href="svg/sprite.svg#it-file"></use>
                        </svg>
                         <span class="text">Inserimento<br>Nuovo Ducumento</span>
                    </div>
                    <div class="col-12" style="margin-top:45px;">
                        <div class="bootstrap-select-wrapper " >
                            <label>Tipo Report</label>
                            <select title="Scegli una opzione" name="tipo_report" id="tipo_report">
                                <?php
                                    foreach ($tipi_report as $tr ) {?>
                                    <option value="<?=$tr['id']?>"><?=$tr['descrizione']?></option>
                                    <?php    
                                    }?>
                    
                            </select>
                        </div>
                    </div>
                </div>   
            </div>  
        </div> 
    </div> 
</div> 

<div class="row">
                                <?php
                                    //var_dump($reports);
                                    if($reports){?>
                                        <table class="table table-striped" id="reportTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Data/user Creazione</th>
                                                    <th scope="col">Tipo Richiesta</th>
                                                    <th scope="col">Stato Invio</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php foreach($reports as $rep){?>
                                                <tr id="row_<?=$rep['id']?>">
                                                    <td><?=date("d/m/Y H:i", strtotime($rep['data_ins']))?><br><?=$rep['user_ins']?></td>
                                                    <td><?=getTipoRep($rep['tipo_report'])?></td>
                                                    <td><?=$rep['stato']=="I"?'Richiesta inviata':'Richiesta non inviata'?></td>
                                                    <td>
                                                    <div class="row">
                                                       <button type="button" onclick="newMail(<?=$rep['id']?>);"class="btn btn-warning btn-xs" title="componi pec" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                                                        <?php if($rep['tipo_report']==1){?>
                                                        <button type="button" onclick="prevRep(<?=$rep['id']?>);"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                                        <button type="button" onclick="downRep(<?=$rep['id']?>);"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>

                                                        <?php }elseif($rep['tipo_report']==2){?>
                                                        <button type="button" onclick="prevRep2(<?=$rep['id']?>);"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                                        <button type="button" onclick="downRep2(<?=$rep['id']?>);"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>

                                                        <?php }elseif($rep['tipo_report']==3){?>

                                                        <?php }elseif($rep['tipo_report']==4){?>

                                                        <?php }?>
                                                        <button type="button" onclick="delRep(<?=$rep['id']?>);"class="btn btn-danger btn-xs" title="Elimina documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </div>


                                                    </td>
                                                </tr>                         
                                                    <?php
                                                    }
                                                    ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    }else{?>
                                    Non ci sono documenti generati
                                    <?php
                                    }
                                    ?>
</div>

<script>

    function showRep(id){
        alert(id)
    }

    function prevRep(id){
        
    
        var url = 'report/integrazione/integrazione.php?id='+id+'&tipo=P';
        window.open(url,"Stampa");
        //setTimeout(function(){ location.reload(); }, 2000);
    
    }
    function prevRep2(id){
        
    
        var url = 'report/rigetto/rigetto.php?id='+id+'&tipo=P';
        window.open(url,"Stampa");
        //setTimeout(function(){ location.reload(); }, 2000);
    
    }
    function prevRep3(id){
        
    
        var url = 'report/ammissione/ammissione.php?id='+id+'&tipo=P';
        window.open(url,"Stampa");
        //setTimeout(function(){ location.reload(); }, 2000);
    
    }
    function prevRep4(id){
        
    
        var url = 'report/inammissibilita/inammissibilita.php?id='+id+'&tipo=P';
        window.open(url,"Stampa");
        //setTimeout(function(){ location.reload(); }, 2000);
    
    }

    function downRep(id){
        var url = 'report/integrazione/integrazione.php?id='+id+'&tipo=D';
        window.open(url,"Stampa");
    }
    function downRep2(id){
        var url = 'report/rigetto/rigetto.php?id='+id+'&tipo=D';
        window.open(url,"Stampa");
    }
    function downRep3(id){
        var url = 'report/ammissione/ammissione.php?id='+id+'&tipo=D';
        window.open(url,"Stampa");
    }
    function downRep4(id){
        var url = 'report/inammissibilita/inammissibilita.php?id='+id+'&tipo=D';s
        window.open(url,"Stampa");
    }

    function delRep(id){
        
        Swal.fire({
                  title: 'Vuoi eliminare il report?',
                  text: "Non potrai più recuperarlo",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'SI Eliminalo!',
                  cancelButtonText: 'NO, Annulla!'
                  }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "controller/updateIstanze.php?action=delReport",
                                data: {id:id},
                                dataType: "json",
                                success: function(results){
                                         
                                          if(results)
                                          {
                                            $('#row_'+id).remove();
                                                Swal.fire(
                                                      'Eliminato!',
                                                      'il Report è stato eliminato correttamente.',
                                                      'success'
                                                )
                                          }
                                         
                                }

                            })


                        }
                  })
    }
    function removeRep(id){
        $("#defaultreportId").val("");
        $('#rep_row_'+id).remove();
        $('#new_report_mail').show();
    }
    function newMail(id){
        $("#list_mail_report >tbody").empty();
        $("#file_allegato_mail").val('');
        $("#new_report_mail").hide();
        $.ajax({
                            type: "POST",
                            url: "controller/updateIstanze.php?action=getReport",
                            data: {id:id},
                            dataType: "json",
                            success: function(data){
                               console.log(data)
                            obj = 'Contributi ai sensi del D.D. 11 ottobre 2019 per le finalità di cui al D.M. 22 luglio 2019 n. 336 -"Incentivi agli investimenti nel settore dell\'autotrasporto".'       
                            $('#oggetto_mail').html(obj);
                            $('#mail_lab_des').addClass("active");
                            $('#mail_lab_des').css("width","auto");
                            $('#tipo_report_mail').val(data.tipo_report);
                            if(data.tipo_report==1){
                                    td4='<button type="button" onclick="prevRep('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                }else if(data.tipo_report==2){
                                    td4='<button type="button" onclick="prevRep2('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep2('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                              }else if(data.tipo_report==3){
                                    td4='<button type="button" onclick="prevRep3('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep3('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'

                              }else if(data.tipo_report==4){
                                    td4='<button type="button" onclick="prevRep4('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep4('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'

                              }
                              td4+='<button type="button" onclick="removeRep('+data.id+');"class="btn btn-danger btn-xs" title="Elimina documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                            tr='<tr id="rep_row_'+data.id+'"><td>'+data.descrizione_rep+'</td><td>'+td4+'</td></tr>';
                            $("#list_mail_report >tbody").append(tr);
                            $("#defaultreportId").val(data.id);
                            }
                }) 
        $('#reportMail').modal('toggle');
    }
    function saveMail(event){
       
      
    }
  
   
</script>



<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="reportMail" name='modal'>
  <div class="modal-dialog modal-lg" role="document" style="max-width:80%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Genera Pec per l'invio
        </h5>
      </div>
      <div class="modal-body">
      <form method="post" id="form_allegato_mail" enctype="multipart/form-data" novalidate>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">
                    <input type="text" class="form-control" id="dest_mail"  name="dest_mail" placeholder="" readonly value="<?=$i['pec_impr']?>">
                    <label for="dest_mail">Destinatario Pec</label>
                </div>
                <div style="margin-top:45px;">
                    <div class="form-group ">
                    <label id="mail_lab_des"for="oggetto_mail"  class="active" style="width: auto;">Oggetto</label>
                        <textarea type="text "class="form-control" id="oggetto_mail" name="oggetto_mail"  rows="3"value="Contributi ai sensi del D.D. 11 ottobre 2019 per le finalità di cui al D.M. 22 luglio 2019 n. 336 -\"Incentivi agli investimenti nel settore dell\'autotrasporto\"."></textarea>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                    <label>Allegati</label>
                    <table class="table" id="list_mail_report">
                        <input type="hidden" id="defaultreportId"  name="defaultreportId" value="">
                        <input type="hidden" id="id_RAM_mail"  name="id_RAM" value="<?=$i['id_RAM']?>">
                        <input type="hidden" id="tipo_report_mail"  name="tipo_mail" value="">
                        <tbody>
                        </tbody>
                       
                    </table> 
                    <div class="form-group" style="margin-top:30px;display:none" id="new_report_mail">
                                <label for="file_allegato" class="active">Aggiungi Nuovo Documento</label>
                                <input type="file" accept="application/pdf" class="form-control-file" id="file_allegato_mail" onchange="checkAlleMail();" name="file_allegato_mail" required="">
                                <small>dimensioni max 3MB  - accettati solo PDF</small>
                                </div>   
                
            </div>
        </div>
      </form>      
       
       
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Annulla</button>
        <button class="btn btn-primary btn-sm" id="savemailBtn"  type="submit" form="form_allegato_mail">Salva</button>
        <button class="btn btn-success btn-sm"  type="button">Anteprima</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="reportModal" name='modal'>
  <div class="modal-dialog modal-lg" role="document" style="max-width:80%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuova Richiesta di Integrazione
        </h5>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_report" id="id_report" value="">
        <div class="row">
            <div class="col-6">
                <div class="bootstrap-select-wrapper " >
                    <label>Tipo Richiesta</label>
                    <select title="Scegli una opzione" name="tipo_integrazione" id="tipo_integrazione">
                    <?php
                        foreach ($tipi_integrazione as $ti ) {?>
                        <option value="<?=$ti['id']?>"><?=$ti['descrizione']?></option>
                        <?php    
                        }?>
                        
                    </select>
                </div>
                <div class="form-group" style="margin-top:30px;">
                    <input type="text" class="form-control" name="prot_RAM" id="prot_RAM" placeholder="se disponibile, inserire numero protocollo documento" value="">
                    <label for="prot_RAM">Protocollo Documento</label>
                </div>
                <div class="it-datepicker-wrapper">
                    <div class="form-group">
                        <input class="form-control it-date-datepicker" onkeypress="return event.charCode >= 47 && event.charCode <= 57" id="data_prot" name="data_prot" type="text" value="" placeholder="inserisci la data in formato gg/mm/aaaa">
                        <label for="data_prot">Data Documento</label>
                    </div>
                </div>
            </div>
            <div class="col-6" id="veiNonConf" style="display:none;">
            <label>Veicoli con elementi non accettati</label>
            <div >
                <table class="table table-sm" id="tabVeiNonConf">
                        <thead>
                            <tr>
                                <th>Targa</th>
                                <th>Tipo documento</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                </table>            
            </div>   
               

            </div>
            <div class="col-6">
                <table class="table table-responsive table-borderless" id="docRtable">
                        
                </table>
            </div>
        </div>
        <div style="margin-top:45px;display:none;" id="des_int" >
            <div class="form-group">
            <label id="lab_des"for="descrizione_integrazione"  class="active" style="width: auto;">Descrizione</label>
                <textarea class="form-control" id="descrizione_integrazione" name="descrizione_integrazione" rows="3"></textarea>
                
            </div>
        </div>

        <div class="row" id="div_btn_add_int" style="justify-content: center;display:none;">
            <button type="button" id="btn_add_int" onclick="addInt()"class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> Inserisci richiesta</button>
        </div>

        <div class="row" id="div_tab_int"  style="display:none;">
            <table class="table" id="tab_int">
                <thead>
                    <tr><td>Tipo</td>
                        <td>Descrizione</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Annulla</button>
        <button class="btn btn-primary btn-sm" id="saveRepBtn1" onclick="saveReport();" type="button">Salva</button>
        <button class="btn btn-success btn-sm" id="prev_btn"onclick="prevRep();" type="button">Anteprima</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="reportModal3">
  <div class="modal-dialog modal-lg" role="document" style="max-width:80%">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Chiusura del procedimento con ammissione al finanaziamento
            </h5>
        </div>
        <div class="modal-body">
        <input type="hidden" name="id_report3" id="id_report3" value="">
            <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="num_prot"  name="num_prot"placeholder="Inserire Numero protocollo Domanda Ammissione" value="">
                            <label for="num_prot">Numero protocollo Domanda Ammissione</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control it-date-datepicker" id="dat_prot"  name="dat_prot" placeholder="inserisci la data in formato gg/mm/aaaa" value="">
                            <label for="dat_prot">Data protocollo Domanda Ammissione</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control it-date-datepicker" id="data_verbale"  name="data_verbale" placeholder="inserisci la data in formato gg/mm/aaaa" value="">
                            <label for="data_verbale">Data verbale</label>
                        </div>
                        <button type="button" id="btn_add_int3" onclick="addInt3()"class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> Inserisci dati al documento</button>

                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <input type="text" class="form-control" name="prot_RAM3" id="prot_RAM3" placeholder="se disponibile, inserire numero protocollo documento" value="">
                            <label for="prot_RAM">Protocollo Documento</label>
                        </div>
                        <div class="it-datepicker-wrapper">
                            <div class="form-group">
                                <input class="form-control it-date-datepicker" onkeypress="return event.charCode >= 47 && event.charCode <= 57" id="data_prot3" name="data_prot3" type="text" value="" placeholder="inserisci la data in formato gg/mm/aaaa">
                                <label for="data_prot3">Data Documento</label>
                            </div>
                        </div>

                    </div>
            
            
            </div>
            <div class="row" id="div_tab_int3"  style="display:none;">
                <table class="table" id="tab_int3">
                    <thead>
                        <tr><td>Tipo</td>
                            <td>Descrizione</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>    
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Annulla</button>
            <button class="btn btn-primary btn-sm" id="saveRepBtn3" onclick="saveReport3();" type="button">Salva</button>
            <button class="btn btn-success btn-sm" id="prev_btn3"onclick="prevRep3();" type="button">Anteprima</button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="reportModal4">
  <div class="modal-dialog modal-lg" role="document" style="max-width:80%">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Chiusura del procedimento con inammissibilità
            </h5>
        </div>
        <div class="modal-body">
        <input type="hidden" name="id_report4" id="id_report4" value="">
            <div class="row">
                    <div class="col-6">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="num_prot_in"  name="num_prot_in"placeholder="Ins N. prot Domanda Ammissione" value="">
                                <label for="num_prot_in">Numero protocollo Domanda Ammissione</label>
                            </div>
                            
                            <div class="form-group col-md-6">
                            <div class="it-datepicker-wrapper" style="margin-top:0px;">
                                <input type="text" onkeypress="return event.charCode >= 47 && event.charCode <= 57" class="form-control it-date-datepicker" id="dat_prot_in"  name="dat_prot_in" placeholder=" formato gg/mm/aaaa" value="">
                                <label for="dat_prot_in">Data protocollo Domanda Ammissione</label>
                                </div>
                            </div>
                        </div>   
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="it-datepicker-wrapper" style="margin-top:0px;">
                                <input type="text" onkeypress="return event.charCode >= 47 && event.charCode <= 57"class="form-control it-date-datepicker" id="data_verbale_in"  name="data_verbale_in" placeholder="formato gg/mm/aaaa" value="">
                                <label for="data_verbale_in">Data verbale</label>
                                </div>
                            </div>
                        </div>   
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="num_prot_rig"  name="num_prot_rig"placeholder="Ins N. prot  Preavviso di rigetto" value="">
                                <label for="num_prot_rig">Numero protocollo Preavviso di rigetto</label>
                            </div>
                            <div class="form-group col-md-6">
                            <div class="it-datepicker-wrapper" style="margin-top:0px;">
                                <input type="text"onkeypress="return event.charCode >= 47 && event.charCode <= 57"class="form-control it-date-datepicker" id="dat_prot_rig"  name="dat_prot_rig" placeholder=" formato gg/mm/aaaa" value="">
                                <label for="dat_prot_rig">Data protocollo Preavviso di rigetto</label>
                                </div>
                            </div>
                        </div>   
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="it-datepicker-wrapper" style="margin-top:0px;">
                            <input type="text" onkeypress="return event.charCode >= 47 && event.charCode <= 57"class="form-control it-date-datepicker" id="dat_prot_pre"  name="dat_prot_pre" placeholder="formato gg/mm/aaaa" value="">
                            <label for="dat_prot_pre">Data nota Preavviso</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6 ">
                                <input type="text" class="form-control" id="mot_ina"  name="mot_ina"placeholder="Scrivi motivazione inammissibilità" value="">
                                <label for="mot_ina">Motivazione di Inassibilità</label>
                            </div>

                            </div>
                        <button type="button" id="btn_add_int4" onclick="addInt4()"class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> Inserisci dati al documento</button>

                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <input type="text" class="form-control" name="prot_RAM4" id="prot_RAM4" placeholder="se disponibile, inserire numero protocollo documento" value="">
                            <label for="prot_RAM">Protocollo Documento</label>
                        </div>
                        <div class="it-datepicker-wrapper">
                            <div class="form-group">
                                <input class="form-control it-date-datepicker" onkeypress="return event.charCode >= 47 && event.charCode <= 57" id="data_prot4" name="data_prot4" type="text" value="" placeholder="inserisci la data in formato gg/mm/aaaa">
                                <label for="data_prot4">Data Documento</label>
                            </div>
                        </div>

                    </div>
            
            
            </div>
            <div class="row" id="div_tab_int4"  style="display:none;">
                <table class="table" id="tab_int4">
                    <thead>
                        <tr><td>Tipo</td>
                            <td>Descrizione</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>    
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Annulla</button>
            <button class="btn btn-primary btn-sm" id="saveRepBtn4" onclick="saveReport4();" type="button">Salva</button>
            <button class="btn btn-success btn-sm" id="prev_btn4"onclick="prevRep4();" type="button">Anteprima</button>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="reportModal2">
  <div class="modal-dialog modal-lg" role="document" style="max-width:80%">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Preavviso al Rigetto
            </h5>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id_report2" id="id_report2" value="">
            <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="motivazione"  name="motivazione"placeholder="Scrivere motivazione" value="">
                            <label for="prot_RAM">Motivazione rigetto</label>
                        </div>
                        <button type="button" id="btn_add_int2" onclick="addInt2()"class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> Inserisci motivazione</button>

                    </div>
                    <div class="col-6">

                        <div class="form-group">
                            <input type="text" class="form-control" name="prot_RAM2" id="prot_RAM2" placeholder="se disponibile, inserire numero protocollo documento" value="">
                            <label for="prot_RAM">Protocollo Documento</label>
                        </div>
                        <div class="it-datepicker-wrapper">
                            <div class="form-group">
                                <input class="form-control it-date-datepicker" onkeypress="return event.charCode >= 47 && event.charCode <= 57" id="data_prot2" name="data_prot2" type="text" value="" placeholder="inserisci la data in formato gg/mm/aaaa">
                                <label for="data_prot2">Data Documento</label>
                            </div>
                        </div>

                    </div>
            
            
            </div>
            <div class="row" id="div_tab_int2"  style="display:none;">
                <table class="table" id="tab_int2">
                    <thead>
                        <tr><td>Tipo</td>
                            <td>Descrizione</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>    
            </div>
        </div> 
        <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Annulla</button>
            <button class="btn btn-primary btn-sm" id="saveRepBtn2" onclick="saveReport2();" type="button">Salva</button>
            <button class="btn btn-success btn-sm" id="prev_btn2"onclick="prevRep2();" type="button">Anteprima</button>
        </div>
    </div>
  </div>
</div>


