
<?php
$tipi_integrazione =getRichInt();
$tipi_report = getTipoReport();
$reports = getReportIdRam($i['id_RAM']);
if($check_ammissione==0){ // && $new_stato_istruttoria['stato']=='C'
    array_push($ena_report,1,2,3); 
}else{
    array_push($ena_report,1,2); 
}
//var_dump($disable_istr);

/*
$ena_report = [];
if($enable_status == 'D'){
    array_push($ena_report, 1,2);
}
if($enable_status == 'B' || $enable_status == 'E'){
    array_push($ena_report, 4);
}
if($disable_istr){
    $ena_report = [];
}
if($report_status){
    $ena_report = [];
    if($report_status == 'A'){
        array_push($ena_report, 2);
        if($enable_int_report){
            array_push($ena_report, 1);
        }
    }
    
    if($report_status == 'C'){
        array_push($ena_report, 4);  
    }
}
$check_ammissione = 0;
foreach($veicoli as $v){
   
    if($v['stato_admin']=='A'||$v['stato_admin']==null){
        $check_ammissione++;
    }
    
    
}
if($check_ammissione==0){
    array_push($ena_report, 3);
}
if($check_stato_istruttoria){
    $ena_report = [];
    $disable_istr  = true;
}
//var_dump($check_ammissione);
//var_dump($ena_report);

//var_dump($enable_status);
*/
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
                         <span class="text">Predisponi<br>Nuova Comunicazione</span>
                    </div>
                    <div class="col-12" style="margin-top:45px;">
                        <div class="bootstrap-select-wrapper " >
                            <label>Tipo Report</label>
                            <select title="Scegli una opzione" name="tipo_report" id="tipo_report">
                            <option>Chiudi finestra</option>
                            <?php
                                    foreach ($tipi_report as $tr ) {?>
                                    <option value="<?=$tr['id']?>"
                                    
                                   
                                    ><?=$tr['descrizione']?></option>
                                   <?php } ?>
                    
                            </select>
                        </div>
                    </div>
                </div>   
            </div>  
        </div> 
    </div> 
    <div class="col-12 col-lg-6">
        <div class="card-wrapper">
            <div class="card">
                <div class="card-body">
                <div class="categoryicon-top">
                    <svg class="icon">
                    <use xlink:href="svg/sprite.svg#it-file"></use>
                    </svg>
                    <span class="text">Report<br>Disponibili</span>
                </div>
                
                    <ul class="it-list" id="lista_report">
                   
                    </ul>
                

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
                                                    <td><?=$rep['stato']=="A"?'Pec da inviare':''?>
                                                        <?=$rep['stato']=="B"?'Pec da convalidare':''?>
                                                        <?=$rep['stato']=="C"?'Pec inviata':''?></td>
                                                    <td>
                                                    <div class="row">
                                                       <!--<button type="button" onclick="newMail(<?=$rep['id']?>);"class="btn btn-warning btn-xs" title="componi pec" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-envelope" aria-hidden="true"></i></button>-->
                                                        <?php if($rep['tipo_report']==1){?>
                                                        <button type="button" onclick="prevRep(<?=$rep['id']?>);"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                                        <button type="button" onclick="downRep(<?=$rep['id']?>);"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>

                                                        <?php }elseif($rep['tipo_report']==2){?>
                                                        <button type="button" onclick="prevRep2(<?=$rep['id']?>);"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                                        <button type="button" onclick="downRep2(<?=$rep['id']?>);"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>

                                                        <?php }elseif($rep['tipo_report']==3){?>
                                                        <button type="button" onclick="prevRep3(<?=$rep['id']?>);"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                                        <button type="button" onclick="downRep3(<?=$rep['id']?>);"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>

                                                        <?php }elseif($rep['tipo_report']==4){?>
                                                        <button type="button" onclick="prevRep4(<?=$rep['id']?>);"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                                        <button type="button" onclick="downRep4(<?=$rep['id']?>);"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>

                                                        <?php }?>
                                                        <?php if($rep['stato'] !=='C'){?>    
                                                        <button type="button" onclick="delRep(<?=$rep['id']?>,<?=$rep['id_RAM']?>);"class="btn btn-danger btn-xs" title="Elimina documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        <?php }?>
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
                                    <table class="table table-striped" id="reportTable" style="display:none;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Data/user Creazione</th>
                                                    <th scope="col">Tipo Richiesta</th>
                                                    <th scope="col">Stato Invio</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                    </table>
                                    <?php
                                    }
                                    ?>
</div>

<script>
 $('#nav-5').on('shown.bs.tab', function (e) {
    
     $.ajax({
            type: "POST",
            url: "controller/updateIstanze.php?action=getComunicazioni",
            data: {id_RAM:<?=$i['id_RAM']?>},
            dataType: "json",
            success: function(data){
                console.log(data)
                    console.log(data.check_ammissione)
                    $("#tipo_report option[value='1']").attr('disabled', true);
                    $("#tipo_report option[value='2']").attr('disabled', true);
                    $("#tipo_report option[value='3']").attr('disabled', true);
                    $("#tipo_report option[value='4']").attr('disabled', true);  
                    $('#lista_report > li').remove();
                    if(data.check_ammissione == 0 ){
                        $("#tipo_report option[value='1']").attr('disabled', false);
                        $("#lista_report").append('<li>Richiesta Integrazioni</li>');
                        $("#tipo_report option[value='2']").attr('disabled', false);
                        $("#lista_report").append('<li>Preavviso al Rigetto</li>');
                        $("#tipo_report option[value='3']").attr('disabled', false);
                        $("#lista_report").append('<li>Chiusura del procedimento con ammissione al finanziamento</li>');

                    }else if (data.check_ammissione > 0){
                        $("#tipo_report option[value='1']").attr('disabled', false);
                        $("#lista_report").append('<li>Richiesta Integrazioni</li>');
                        $("#tipo_report option[value='2']").attr('disabled', false);
                        $("#lista_report").append('<li>Preavviso al Rigetto</li>');
                    }
                    if(data.stato_istruttoria){
                        if(data.stato_istruttoria.stato !='C'){
                            $("#tipo_report option[value='1']").attr('disabled', true);
                            $("#tipo_report option[value='2']").attr('disabled', true);
                            $("#tipo_report option[value='3']").attr('disabled', true);
                            $("#tipo_report option[value='4']").attr('disabled', true);  
                            $('#lista_report > li').remove();
                            $("#lista_report").append('<li>Nessun Report Disponibile</li>');
                        }else{
                            if(data.stato_istruttoria.tipo_report==1){

                            }
                            if(data.stato_istruttoria.tipo_report==2){
                                $("#tipo_report option[value='1']").attr('disabled', true);
                                $("#tipo_report option[value='2']").attr('disabled', true);
                                $("#tipo_report option[value='3']").attr('disabled', true);
                                $("#tipo_report option[value='4']").attr('disabled', false); 
                                $('#lista_report > li').remove();
                            $("#lista_report").append('<li>Chiusura del procedimento con inammissibilità</li>');
                            }
                            if(data.stato_istruttoria.tipo_report==3){
                             $("#tipo_report option[value='1']").attr('disabled', true);
                            $("#tipo_report option[value='2']").attr('disabled', true);
                            $("#tipo_report option[value='3']").attr('disabled', true);
                            $("#tipo_report option[value='4']").attr('disabled', true);  
                            $('#lista_report > li').remove();
                            $("#lista_report").append('<li>Nessun Report Disponibile</li>')
                            }
                            if(data.stato_istruttoria.tipo_report==4){
                                $("#tipo_report option[value='1']").attr('disabled', true);
                            $("#tipo_report option[value='2']").attr('disabled', true);
                            $("#tipo_report option[value='3']").attr('disabled', true);
                            $("#tipo_report option[value='4']").attr('disabled', true);  
                            $('#lista_report > li').remove();
                            $("#lista_report").append('<li>Nessun Report Disponibile</li>')
                            }
                        }
                       
                    }


                    $('#tipo_report').selectpicker('refresh')
                   
            }
        })
 })
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
        var url = 'report/inammissibilita/inammissibilita.php?id='+id+'&tipo=D';
        window.open(url,"Stampa");
    }
    function delRep(id, id_RAM){
        
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
                                data: {id:id,id_RAM:id_RAM},
                                dataType: "json",
                                success: function(results){
                                         
                                          if(results.res)
                                          {
                                            $('#row_'+id).remove();
                                                Swal.fire(
                                                      'Eliminato!',
                                                      'il Report è stato eliminato correttamente.',
                                                      'success'
                                                )
                                          }
                                          console.log(results.status.length)
                                          if(results.status){
                                            text_data = ''
                                                
                                                $("#tipo_report option[value='1']").attr('disabled', true);
                                                $("#tipo_report option[value='2']").attr('disabled', true);
                                                $("#tipo_report option[value='3']").attr('disabled', true);
                                                $("#tipo_report option[value='4']").attr('disabled', true);  
                                                $('#lista_report > li').remove();
                                              if(results.status.tipo_report == 1){
                                                text_istr = 'Integrazione';
                                                type_istr = 'warning';
                                                if(results.status.data_invio){
                                                    var d = new Date( results.status.data_invio)
                                                    data_invio= d.toLocaleDateString("it-IT")
                                                    text_data = '<br>Pec inviata il '+ data_invio
                                                    $("#tipo_report option[value='1']").attr('disabled', false);
                                                    $("#lista_report").append('<li>Richiesta di integrazione</li>');
                                                }
                                                $("#tipo_report option[value='2']").attr('disabled', false);
                                                $("#lista_report").append('<li>Preavviso al Rigetto</li>');
                                                if(results.check == 0 ){
                                                    $("#tipo_report option[value='3']").attr('disabled', false);
                                                    $("#lista_report").append('<li>Chiusura del procedimento con ammissione al finanziamento</li>');
                                                }

                                              }
                                              if(results.status.tipo_report == 2){
                                                text_istr = 'Preavviso di rigetto';
                                                type_istr = 'danger';
                                                if(results.status.data_invio){
                                                    
                                                    
                                                   var d = new Date( results.status.data_invio)
                                                    data_invio= d.toLocaleDateString("it-IT")
                                                    text_data = '<br>Pec inviata il '+ data_invio
                                                }
                                               
                                                $("#tipo_report option[value='4']").attr('disabled', false);
                                                $("#lista_report").append('<li>Chiusura del procedimento con inammissibilità</li>');

                                              }
                                              if(results.status.tipo_report == 3){
                                                text_istr = 'Ammessa';
                                                type_istr = 'success'; 
                                                $("#lista_report").append('<li>Nessun Report Disponibile</li>');
  
                                               
                                              }
                                              if(results.status.tipo_report == 4){
                                                text_istr = 'Rigettata';
                                                type_istr = 'danger'; 
                                                $("#lista_report").append('<li>Nessun Report Disponibile</li>');

                                                  
                                              }
                                              span_istr = '<span class="badge badge-'+type_istr+'">'+text_istr+'</span>'+text_data;
                                                //console.log(span_istr);
                                                $('#status_istruttoria').html('Stato istruttoria '+span_istr)
                                                $('#tipo_report').selectpicker('refresh')
                                          }else{
                                            $("#tipo_report option[value='4']").attr('disabled', true);  
                                                $('#lista_report > li').remove();
                                            $("#tipo_report option[value='1']").attr('disabled', false);
                                                $("#lista_report").append('<li>Richiesta Integrazioni</li>');
                                                
                                                $("#tipo_report option[value='2']").attr('disabled', false);
                                                $("#lista_report").append('<li>Preavviso al Rigetto</li>');
                                                if(results.check_ammissione == 0){
                                                    $("#tipo_report option[value='3']").attr('disabled', false);
                                                    $("#lista_report").append('<li>Chiusura del procedimento con ammissione al finanziamento</li>');
                                                }else{
                                                    $("#tipo_report option[value='3']").attr('disabled', true);  
                                                }
                                                   
                                                    $('#tipo_report').selectpicker('refresh')
                                                    $('#status_istruttoria').html('')
                                                
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
    function saveReport(id){
                prot_RAM=$('input[name="prot_RAM"]').val();
                data_prot=$('input[name="data_prot"]').val();
                $.ajax({
                            type: "POST",
                            url: "controller/updateIstanze.php?action=saveReport",
                            data: {id:id,prot_RAM:prot_RAM,data_prot:data_prot},
                            dataType: "json",
                            success: function(data){
                                //console.log(data)
                                Swal.fire("Operazione Completata!", "Pec da convalidare", "info");
                                $('div[id^="reportModal"]').modal('hide');
                                td1=data.data_inserimento+'<br>'+data.user_ins;
                                td2=data.descrizione;
                                td3='Richiesta non inviata';
                                $("#tipo_report option[value='1']").attr('disabled', true);
                                $("#tipo_report option[value='2']").attr('disabled', true);
                                $("#tipo_report option[value='3']").attr('disabled', true);
                                $("#tipo_report option[value='4']").attr('disabled', true);
                               
                                $('#lista_report > li').remove();
                                $("#lista_report").append('<li>Nessun Report Disponibile</li>');
                                if(data.tipo_report==1){
                                    td4='<button type="button" onclick="prevRep('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Integrazione';
                                    type_istr = 'warning';
                                    /*$("#tipo_report option[value='2']").attr('disabled', false);
                                    $("#lista_report").append('<li>Preavviso al Rigetto</li>');
                                    $("#tipo_report option[value='3']").attr('disabled', false);
                                    $("#lista_report").append('<li>Chiusura del procedimento con ammissione al finanziamento</li>');*/


                                }else if(data.tipo_report==2){
                                    td4='<button type="button" onclick="prevRep2('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep2('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Preavviso di rigetto';
                                    type_istr = 'warning';
                                   /* $("#tipo_report option[value='4']").attr('disabled', false);
                                    $("#lista_report").append('<li>Chiusura del procedimento con inammissibilità</li>');*/

                              }else if(data.tipo_report==3){
                                    td4='<button type="button" onclick="prevRep3('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep3('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Ammessa';
                                    type_istr = 'success';
                                    //$("#lista_report").append('<li>Nessun Report Disponibile</li>');

                              }else if(data.tipo_report==4){
                                    td4='<button type="button" onclick="prevRep4('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep4('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Rigettata';
                                    type_istr = 'danger';
                                    //$("#lista_report").append('<li>Nessun Report Disponibile</li>');

                              }
                              td4+='<button type="button" onclick="delRep('+data.id+', '+data.id_RAM+');"class="btn btn-danger btn-xs" title="Elimina documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                                
                                
                                
                                
                                html= '<tr id="row_'+data.id+'"><td>'+td1+'</td><td>'+td2+'</td><td>'+td3+'</td><td>'+td4+'</td></tr>'
                                span_istr = '<span class="badge badge-'+type_istr+' blink">'+text_istr+'</span> <br> <b class="blink">Pec da inviare</b>';
                                //console.log(span_istr);
                                $('#status_istruttoria').html('Stato istruttoria '+span_istr)
                                $("#reportTable > tbody").prepend(html);
                                $("#reportTable").show();
                                $('#tipo_report').selectpicker('refresh')
                            }
                }) 

    }
    function saveReport2(id){
     
                prot_RAM=$('input[name="prot_RAM2"]').val();
                data_prot=$('input[name="data_prot2"]').val();
                $.ajax({
                            type: "POST",
                            url: "controller/updateIstanze.php?action=saveReport",
                            data: {id:id,prot_RAM:prot_RAM,data_prot:data_prot},
                            dataType: "json",
                            success: function(data){
                                console.log(data)
                                Swal.fire("Operazione Completata!", "Pec da convalidare", "info");
                                $('div[id^="reportModal"]').modal('hide');
                                td1=data.data_inserimento+'<br>'+data.user_ins;
                                td2=data.descrizione;
                                td3='Richiesta non inviata';
                                $("#tipo_report option[value='1']").attr('disabled', true);
                                $("#tipo_report option[value='2']").attr('disabled', true);
                                $("#tipo_report option[value='3']").attr('disabled', true);
                                $("#tipo_report option[value='4']").attr('disabled', true);
                               
                                $('#lista_report > li').remove();
                                $("#lista_report").append('<li>Nessun Report Disponibile</li>');
                                if(data.tipo_report==1){
                                    td4='<button type="button" onclick="prevRep('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Integrazione';
                                    type_istr = 'warning';
                                    /*$("#tipo_report option[value='2']").attr('disabled', false);
                                    $("#lista_report").append('<li>Preavviso al Rigetto</li>');
                                    $("#tipo_report option[value='3']").attr('disabled', false);
                                    $("#lista_report").append('<li>Chiusura del procedimento con ammissione al finanziamento</li>');*/


                                }else if(data.tipo_report==2){
                                    td4='<button type="button" onclick="prevRep2('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep2('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Preavviso di rigetto';
                                    type_istr = 'warning';
                                   /* $("#tipo_report option[value='4']").attr('disabled', false);
                                    $("#lista_report").append('<li>Chiusura del procedimento con inammissibilità</li>');*/

                              }else if(data.tipo_report==3){
                                    td4='<button type="button" onclick="prevRep3('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep3('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Ammessa';
                                    type_istr = 'success';
                                    //$("#lista_report").append('<li>Nessun Report Disponibile</li>');

                              }else if(data.tipo_report==4){
                                    td4='<button type="button" onclick="prevRep4('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep4('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Rigettata';
                                    type_istr = 'danger';
                                    //$("#lista_report").append('<li>Nessun Report Disponibile</li>');

                              }
                              td4+='<button type="button" onclick="delRep('+data.id+', '+data.id_RAM+');"class="btn btn-danger btn-xs" title="Elimina documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                                
                                
                                
                                
                                html= '<tr id="row_'+data.id+'"><td>'+td1+'</td><td>'+td2+'</td><td>'+td3+'</td><td>'+td4+'</td></tr>'
                                span_istr = '<span class="badge badge-'+type_istr+' blink">'+text_istr+'</span> <br> <b class="blink">Pec da convalidare</b>';
                                //console.log(span_istr);
                                $('#status_istruttoria').html('Stato istruttoria '+span_istr)
                                $('#status_istruttoria').show()
                                $("#reportTable > tbody").prepend(html);
                                $("#reportTable").show();
                                $('#tipo_report').selectpicker('refresh')
                            }
                }) 

    }
    function saveReport3(id){
     
     prot_RAM=$('input[name="prot_RAM3"]').val();
     data_prot=$('input[name="data_prot3"]').val();
     data_verbale=$('input[name="data_verbale3"]').val();
     $.ajax({
                 type: "POST",
                 url: "controller/updateIstanze.php?action=saveReport",
                 data: {id:id,prot_RAM:prot_RAM,data_prot:data_prot, data_verbale:data_verbale},
                 dataType: "json",
                 success: function(data){
                     console.log(data)
                     Swal.fire("Operazione Completata!", "Pec da convalidare", "info");
                     $('div[id^="reportModal"]').modal('hide');
                     td1=data.data_inserimento+'<br>'+data.user_ins;
                     td2=data.descrizione;
                     td3='Richiesta non inviata';
                     $("#tipo_report option[value='1']").attr('disabled', true);
                     $("#tipo_report option[value='2']").attr('disabled', true);
                     $("#tipo_report option[value='3']").attr('disabled', true);
                     $("#tipo_report option[value='4']").attr('disabled', true);
                    
                     $('#lista_report > li').remove();
                     $("#lista_report").append('<li>Nessun Report Disponibile</li>');
                     if(data.tipo_report==1){
                         td4='<button type="button" onclick="prevRep('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                         td4+='<button type="button" onclick="downRep('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                         text_istr = 'Integrazione';
                         type_istr = 'warning';
                         /*$("#tipo_report option[value='2']").attr('disabled', false);
                         $("#lista_report").append('<li>Preavviso al Rigetto</li>');
                         $("#tipo_report option[value='3']").attr('disabled', false);
                         $("#lista_report").append('<li>Chiusura del procedimento con ammissione al finanziamento</li>');*/


                     }else if(data.tipo_report==2){
                         td4='<button type="button" onclick="prevRep2('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                         td4+='<button type="button" onclick="downRep2('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                         text_istr = 'Preavviso di rigetto';
                         type_istr = 'warning';
                        /* $("#tipo_report option[value='4']").attr('disabled', false);
                         $("#lista_report").append('<li>Chiusura del procedimento con inammissibilità</li>');*/

                   }else if(data.tipo_report==3){
                         td4='<button type="button" onclick="prevRep3('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                         td4+='<button type="button" onclick="downRep3('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                         text_istr = 'Ammessa';
                         type_istr = 'success';
                         //$("#lista_report").append('<li>Nessun Report Disponibile</li>');

                   }else if(data.tipo_report==4){
                         td4='<button type="button" onclick="prevRep4('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                         td4+='<button type="button" onclick="downRep4('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                         text_istr = 'Rigettata';
                         type_istr = 'danger';
                         //$("#lista_report").append('<li>Nessun Report Disponibile</li>');

                   }
                   td4+='<button type="button" onclick="delRep('+data.id+', '+data.id_RAM+');"class="btn btn-danger btn-xs" title="Elimina documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                     
                     
                     
                     
                     html= '<tr id="row_'+data.id+'"><td>'+td1+'</td><td>'+td2+'</td><td>'+td3+'</td><td>'+td4+'</td></tr>'
                     span_istr = '<span class="badge badge-'+type_istr+' blink">'+text_istr+'</span> <br> <b class="blink">Pec da convalidare</b>';
                     //console.log(span_istr);
                     $('#status_istruttoria').html('Stato istruttoria '+span_istr)
                     $("#reportTable > tbody").prepend(html);
                     $("#reportTable").show();
                     $('#tipo_report').selectpicker('refresh')
                 }
     }) 

    }
    function saveReport4(id){
                prot_RAM=$('input[name="prot_RAM4"]').val();
                data_prot=$('input[name="data_prot4"]').val();
                $.ajax({
                            type: "POST",
                            url: "controller/updateIstanze.php?action=saveReport",
                            data: {id:id,prot_RAM:prot_RAM,data_prot:data_prot},
                            dataType: "json",
                            success: function(data){
                                //console.log(data)
                                Swal.fire("Operazione Completata!", "Pec da convalidare", "info");
                                $('div[id^="reportModal"]').modal('hide');
                                td1=data.data_inserimento+'<br>'+data.user_ins;
                                td2=data.descrizione;
                                td3='Richiesta non inviata';
                                $("#tipo_report option[value='1']").attr('disabled', true);
                                $("#tipo_report option[value='2']").attr('disabled', true);
                                $("#tipo_report option[value='3']").attr('disabled', true);
                                $("#tipo_report option[value='4']").attr('disabled', true);
                               
                                $('#lista_report > li').remove();
                                $("#lista_report").append('<li>Nessun Report Disponibile</li>');
                                if(data.tipo_report==1){
                                    td4='<button type="button" onclick="prevRep('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Integrazione';
                                    type_istr = 'warning';
                                    /*$("#tipo_report option[value='2']").attr('disabled', false);
                                    $("#lista_report").append('<li>Preavviso al Rigetto</li>');
                                    $("#tipo_report option[value='3']").attr('disabled', false);
                                    $("#lista_report").append('<li>Chiusura del procedimento con ammissione al finanziamento</li>');*/


                                }else if(data.tipo_report==2){
                                    td4='<button type="button" onclick="prevRep2('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep2('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Preavviso di rigetto';
                                    type_istr = 'warning';
                                   /* $("#tipo_report option[value='4']").attr('disabled', false);
                                    $("#lista_report").append('<li>Chiusura del procedimento con inammissibilità</li>');*/

                              }else if(data.tipo_report==3){
                                    td4='<button type="button" onclick="prevRep3('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep3('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Ammessa';
                                    type_istr = 'success';
                                    //$("#lista_report").append('<li>Nessun Report Disponibile</li>');

                              }else if(data.tipo_report==4){
                                    td4='<button type="button" onclick="prevRep4('+data.id+');"class="btn btn-success btn-xs" title="Visualizza Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>'
                                    td4+='<button type="button" onclick="downRep4('+data.id+');"class="btn btn-primary btn-xs" title="Scarica Documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></button>'
                                    text_istr = 'Rigettata';
                                    type_istr = 'danger';
                                    //$("#lista_report").append('<li>Nessun Report Disponibile</li>');

                              }
                              td4+='<button type="button" onclick="delRep('+data.id+', '+data.id_RAM+');"class="btn btn-danger btn-xs" title="Elimina documento" style="margin-right:10px;padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                                
                                
                                
                                
                                html= '<tr id="row_'+data.id+'"><td>'+td1+'</td><td>'+td2+'</td><td>'+td3+'</td><td>'+td4+'</td></tr>'
                                span_istr = '<span class="badge badge-'+type_istr+' blink">'+text_istr+'</span> <br> <b class="blink">Pec da convalidare</b>';
                                //console.log(span_istr);
                                $('#status_istruttoria').html('Stato istruttoria '+span_istr)
                                $("#reportTable > tbody").prepend(html);
                                $("#reportTable").show();
                                $('#tipo_report').selectpicker('refresh')
                            }
                }) 

    }
    function newInt(tipo){
                
                id_RAM = <?=$i['id_RAM']?>;
                $.ajax({
                            type: "POST",
                            url: "controller/updateIstanze.php?action=newInt",
                            data: {id_RAM:id_RAM,tipo:tipo},
                            dataType: "json",
                            success: function(id){
                                $('#id_report').val(id);
                                $('#prev_btn').attr('onclick','prevRep('+id+');');
                                //btn = 'saveRepBtn'+tipo;
                                //$('#'+btn).attr('onclick','saveReport('+id+');');
                                

                            }
                }) 
            
    }
    
    function newRig(tipo){
                
                id_RAM = <?=$i['id_RAM']?>;
                $.ajax({
                            type: "POST",
                            url: "controller/updateIstanze.php?action=newInt",
                            data: {id_RAM:id_RAM,tipo:tipo},
                            dataType: "json",
                            success: function(id){
                                $('#id_report2').val(id);
                                $('#prev_btn2').attr('onclick','prevRep2('+id+');');
                               // btn = 'saveRepBtn'+tipo;
                                //$('#'+btn).attr('onclick','saveReport2('+id+');');
                                

                            }
                }) 
            
    }
    function newVer(tipo){
                
                id_RAM = <?=$i['id_RAM']?>;
                $.ajax({
                            type: "POST",
                            url: "controller/updateIstanze.php?action=newInt",
                            data: {id_RAM:id_RAM,tipo:tipo},
                            dataType: "json",
                            success: function(id){
                                $('#id_report3').val(id);
                                $('#prev_btn3').attr('onclick','prevRep3('+id+');');
                                btn = 'saveRepBtn'+tipo;
                                $('#'+btn).attr('onclick','saveReport3('+id+');');
                                

                            }
                }) 
            
    }
    function newIna(tipo){
                
                id_RAM = <?=$i['id_RAM']?>;
                $.ajax({
                            type: "POST",
                            url: "controller/updateIstanze.php?action=newInt",
                            data: {id_RAM:id_RAM,tipo:tipo},
                            dataType: "json",
                            success: function(id){
                                $('#id_report4').val(id);
                                $('#prev_btn4').attr('onclick','prevRep4('+id+');');
                                //btn = 'saveRepBtn'+tipo;
                                //$('#'+btn).attr('onclick','saveReport4('+id+');');
                                

                            }
                }) 
            
    }
    function delInt(id){
        $.ajax({
            type: "POST",
            url: "controller/updateIstanze.php?action=delIntDettId",
            data: {id:id},
            dataType: "json",
            success: function(data){
             
                    $('table#tab_int tr#row_dett_1_'+id).remove();
            }
        })
    }
    function delInt2(id){
        $.ajax({
            type: "POST",
            url: "controller/updateIstanze.php?action=delIntDettId",
            data: {id:id},
            dataType: "json",
            success: function(data){
                  
                    $('table#tab_int2 tr#row_dett_2_'+id).remove();
                    var rowCount = $("#tab_int2 tr").length -1
                              
                    if(rowCount == 0){
                        $("#div_tab_int2").hide();
                            $("#saveRepBtn2,#prev_btn2").prop('disabled', true)
                    }
                   
            }
        })
        
    }
   
    progtr=1;
    function addInt(){
        id_RAM= <?=$i['id_RAM']?>;
        id_report= $('#id_report').val();
        tipo = $('#tipo_integrazione option:selected').text()
        tipocod = $('#tipo_integrazione option:selected').val()
        //desc =  $('#descrizione_integrazione').html();
        desc =  $('#descrizione_integrazione').val();

      
        $("#div_tab_int").show();
        $('#des_int,#div_btn_add_int').hide();
        $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:tipocod,descrizione:desc},
                    dataType: "json",
                    success: function(data){
                            console.log(data)
                           
                            btn_del = '<button type="button" class="btn btn-danger btn-sm" onclick="delInt('+data+')"> <i class="fa fa-trash" aria-hidden="true"></i> </button>'
                            html= '<tr id="row_dett_1_'+data+'"><td>'+tipo+'</td><td id="desc_'+progtr+'">'+desc+'</td><td>'+btn_del+'</td></tr>'
                            $("#tab_int > tbody").append(html);
                            $('#saveRepBtn1,#prev_btn').prop('disabled',false)

                    }
        })  
        $("#div_tab_int").show();
        $('#des_int,#div_btn_add_int').hide();
        progtr++;    
        
        //alert(desc);
    }
    progtr2=1;
    function addInt2(){
        id_RAM= <?=$i['id_RAM']?>;
        id_report= $('#id_report2').val();
        tipo = 'Preavviso al Rigetto'
        tipocod = 2
        //desc =  $('#descrizione_integrazione').html();
        desc =  $('#motivazione').val();

        
       
        //$('#des_int,#div_btn_add_int').hide();
        $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:tipocod,descrizione:desc},
                    dataType: "json",
                    success: function(data){
                            console.log(data)
                            $('#motivazione').val("");
                            btn_del = '<button type="button" class="btn btn-danger btn-sm" onclick="delInt2('+data+');"> <i class="fa fa-trash" aria-hidden="true"></i> </button>'
                            html= '<tr id="row_dett_2_'+data+'"><td>'+tipo+'</td><td id="desc_'+progtr2+'">'+desc+'</td><td>'+btn_del+'</td></tr>'
                            $("#tab_int2 > tbody").append(html);
                            
                            $("#div_tab_int2").show();
                            $("#saveRepBtn2,#prev_btn2").prop('disabled', false)

                    }
        })  
        //$("#div_tab_int").show();
        //$('#des_int,#div_btn_add_int').hide();
        progtr2++;    
        
        //alert(desc);
    }
    
    function addInt3(){
        progtr3=1;
        id_RAM= <?=$i['id_RAM']?>;
        id_report= $('#id_report3').val();
        
        tipocod = 3
        //desc =  $('#descrizione_integrazione').html();
        //desc =  $('#motivazione').val();
        //num_prot=$('#num_prot3').val()
        //=$('#dat_prot3').val()
        data_verbale=$('#data_verbale3').val()
        prot = $('#prot_RAM3').val()
        data_doc = $('#data_prot3').val()

       
       
        
        $("#div_tab_int3").show();
        $("#tab_int3").show();
        //$('#des_int,#div_btn_add_int').hide();
       /* $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:1,descrizione:num_prot},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            $('#num_prot3').val("");
                            tipo = 'Numero protocollo Domanda Ammissione'
                            html= '<tr><td>'+tipo+'</td><td id="desc3_1">'+num_prot+'</td></tr>'
                              $("#tab_int3 > tbody").append(html);
                              
                              
                              progtr3++;  
                    }
        })
        
        $.ajax({
              
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:2,descrizione:dat_prot},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            $('#dat_prot3').val("");
                            tipo='Data protocollo Domanda Ammissione';
                            html= '<tr><td>'+tipo+'</td><td id="desc3_2">'+dat_prot+'</td></tr>'
                              $("#tab_int3 > tbody").append(html);
                              progtr3++; 
                    }
        }) 
        */
        $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:3,descrizione:data_verbale},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            tipo='Data verbale'
                            $('#data_verbale3').val("");
                            html= '<tr><td>'+tipo+'</td><td id="desc3_3">'+data_verbale+'</td></tr>'
                            $("#tab_int3 > tbody").append(html);
                            progtr3++;
                    }
        }) 
        
        $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:4,descrizione:prot},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            tipo='Protocollo RAM'
                            $('#prot_RAM3').val("");
                            html= '<tr><td>'+tipo+'</td><td id="desc3_4">'+prot+'</td></tr>'
                            $("#tab_int3 > tbody").append(html);
                            progtr3++;
                    }
        }) 
    
        $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:5,descrizione:data_doc},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            tipo='Data documento'
                            $('#data_prot3').val("");
                            html= '<tr><td>'+tipo+'</td><td id="desc3_5">'+data_doc+'</td></tr>'
                            $("#tab_int3 > tbody").append(html);
                            progtr3++; 
                    }
        }) 
        

        $('#saveRepBtn3,#prev_btn3').prop('disabled', false)
        $('#btn_add_int3,#dati_report_3').hide();
        $('#btn_up_int3').attr('onclick','modInt3('+id_report+')');
        $('#btn_up_int3').show();






        //$("#div_tab_int").show();
        //$('#des_int,#div_btn_add_int').hide();
        
        
        //alert(desc);
    }
   
    function addInt4(){
        progtr4=1;
        id_RAM= <?=$i['id_RAM']?>;
        id_report= $('#id_report4').val();
        
        tipocod = 4
        //desc =  $('#descrizione_integrazione').html();
        //desc =  $('#motivazione').val();

        
        $("#div_tab_int4").show();
        //$('#des_int,#div_btn_add_int').hide();
        /*
        num_prot=$('#num_prot_in').val()
        $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:1,descrizione:num_prot},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            $('#num_prot_in').val("");
                            tipo = 'Numero protocollo Domanda Ammissione'
                            html= '<tr><td>'+tipo+'</td><td id="desc_'+progtr4+'">'+num_prot+'</td></tr>'
                              $("#tab_int4 > tbody").append(html);
                              

                    }
        })
        progtr4++;  
        dat_prot=$('#dat_prot_in').val()
        $.ajax({
              
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:2,descrizione:dat_prot},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            $('#dat_prot_in').val("");
                            tipo='Data protocollo Domanda Ammissione';
                            html= '<tr><td>'+tipo+'</td><td id="desc_'+progtr4+'">'+dat_prot+'</td></tr>'
                              $("#tab_int4 > tbody").append(html);

                    }
        }) 
        progtr4++; 
        */
        data_verbale=$('#data_verbale_in').val()
        $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:3,descrizione:data_verbale},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            tipo='Data verbale'
                            $('#data_verbale_in').val("");
                            html= '<tr><td>'+tipo+'</td><td id="desc_4_'+progtr4+'">'+data_verbale+'</td></tr>'
                            $("#tab_int4 > tbody").append(html);
                            progtr4++;

                    }
        }) 
       
        num_prot_rig = $('#num_prot_rig').val()
        $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:4,descrizione:num_prot_rig},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            $('#num_prot_rig').val("");
                            tipo = 'Numero protocollo Preavviso di rigetto'
                            html= '<tr><td>'+tipo+'</td><td id="desc_4_'+progtr4+'">'+num_prot_rig+'</td></tr>'
                              $("#tab_int4 > tbody").append(html);
                              progtr4++;
                              

                    }
        })
        
        data_prot_rig = $('#dat_prot_rig').val()
        $.ajax({
              
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:5,descrizione:data_prot_rig},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            $('#dat_prot_rig').val("");
                            tipo='Data protocollo Preavviso di rigetto';
                            html= '<tr><td>'+tipo+'</td><td id="desc_4_'+progtr4+'">'+data_prot_rig+'</td></tr>'
                              $("#tab_int4 > tbody").append(html);
                              progtr4++;

                    }
        }) 
        
        data_prot_pre = $('#dat_prot_pre').val()
        
        $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:6,descrizione:data_prot_pre},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            tipo='Data nota Preavviso'
                            $('#dat_prot_pre').val("");
                            html= '<tr><td>'+tipo+'</td><td id="desc_4_'+progtr4+'">'+data_prot_pre+'</td></tr>'
                            $("#tab_int4 > tbody").append(html);
                            progtr4++;

                    }
        }) 
       
        
        mot_ina=$('#mot_ina').val()
        $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=newIntDett",
                    data: {id_RAM:id_RAM,id_report:id_report,prog:progtr,tipo:7,descrizione:mot_ina},
                    dataType: "json",
                    success: function(data){
                            //console.log(data)
                            tipo='Motivazione di Inassibilità'
                            $('#mot_ina').val("");
                            html= '<tr><td>'+tipo+'</td><td id="desc_4_'+progtr4+'">'+mot_ina+'</td></tr>'
                            $("#tab_int4 > tbody").append(html);
                            progtr4++;

                    }
        }) 
        
        $('#btn_up_int4').attr('onclick','modInt4('+id_report+')');
        $('#btn_up_int4').show()
        $('#dati_report_4,#btn_add_int4').hide()
        $('#saveRepBtn4,#prev_btn4').prop('disabled', false)





        //$("#div_tab_int").show();
        //$('#des_int,#div_btn_add_int').hide();
       
        
        //alert(desc);
    }
    $('#tipo_report').change(function(){
      $('#veiNonConf').hide()
      $('#tabVeiNonConf >tbody').empty()
        tipo=$('#tipo_report option:selected').val()
        
        console.log(tipo);
        if(tipo ==1){
                $('#reportModal').modal('toggle');
                newInt(tipo);
                id_RAM = <?=$i['id_RAM']?>;
                  $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=getDocR",
                    data: {id_RAM:id_RAM},
                    dataType: "json",
                    success: function(data){
                            console.log(data)
                            $.each(data , function (k,v){
                                 targa= v.targa
                                 tdoc= v.tipo_documento
                                 badge='<span class="badge badge-primary">'+targa+'</span><br>'
                                 tr='<tr><td>'+badge+'</td><td>'+tdoc+'</td></tr>'
                                 $('#veiNonConf').show()
                                 $('#tabVeiNonConf >tbody').append(tr)

                            })
                          

                    }
                  })         
        }
        if(tipo ==2){
                $('#reportModal2').modal('toggle');
                newRig(tipo);
        }
        if(tipo ==3){
                $('#reportModal3').modal('toggle');
                newVer(tipo);
               
        }
        if(tipo ==4){
                $('#reportModal4').modal('toggle');
                $("#tab_int4 > tbody").empty();
                newIna(tipo);
        }
        $('#tipo_report').val("")
        $('.bootstrap-select-wrapper select').selectpicker('refresh');

    });
    function modInt3(idreport){
        num_prot = $('#desc3_1').text()
        dat_prot=$('#desc3_2').text()
        data_verbale=$('#desc3_3').text()
        prot = $('#desc3_4').text()
        data_doc = $('#desc3_5').text()
        $('#saveRepBtn3,#prev_btn3').prop('disabled', true)
       


        $.ajax({
            type: "POST",
            url: "controller/updateIstanze.php?action=delIntDett",
            data: {id_report:idreport},
            dataType: "json",
            success: function(data){
                    console.log(data)
                    $('#num_prot3').val(num_prot)
                    $('#dat_prot3').val(dat_prot)
                    $('#data_verbale3').val(data_verbale)
                    $('#prot_RAM3').val(prot)
                    $('#data_prot3').val(data_doc)
                    $("#tab_int3 > tbody").empty();
                    $("#tab_int3").hide();
                    $('#btn_add_int3,#dati_report_3').show();
                    $('#btn_up_int3').attr('onclick','modInt3()');
                    $('#btn_up_int3').hide();
            }
        })
    }
    function modInt4(idreport){
        data_verbale_in = $('#desc_4_1').text()
        num_prot_rig=$('#desc_4_2').text()
        dat_prot_rig=$('#desc_4_3').text()
        dat_prot_pre = $('#desc_4_4').text()
        mot_ina = $('#desc_4_5').text()
        $('#saveRepBtn4,#prev_btn4').prop('disabled', true)
       


        $.ajax({
            type: "POST",
            url: "controller/updateIstanze.php?action=delIntDett",
            data: {id_report:idreport},
            dataType: "json",
            success: function(data){
                    console.log(data)
                    $('#data_verbale_in').val(data_verbale_in)
                    $('#num_prot_rig').val(num_prot_rig)
                    $('#dat_prot_rig').val(dat_prot_rig)
                    $('#dat_prot_pre').val(dat_prot_pre)
                    $('#mot_ina').val(mot_ina)
                    $("#tab_int4 > tbody").empty();
                    $("#div_tab_int4").hide();
                    $('#btn_add_int4,#dati_report_4').show();
                    $('#btn_up_int4').attr('onclick','modInt4('+idreport+')');
                    $('#btn_up_int4').hide();
            }
        })
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
        <form id="modal1">
            <div class="row">
                <div class="col-6">
                    <div class=" col-12 bootstrap-select-wrapper " >
                        <label>Tipo Richiesta</label>
                        <select title="Scegli una opzione" name="tipo_integrazione" id="tipo_integrazione">
                        <?php
                            foreach ($tipi_integrazione as $ti ) {?>
                            <option value="<?=$ti['id']?>"><?=$ti['descrizione']?></option>
                            <?php    
                            }?>
                            
                        </select>
                    
                    </div>
                    <div class="row">
                        <div class=" col-12 col-lg-6 form-group" style="margin-top:50px;">
                            <input type="text" class="form-control" name="prot_RAM" id="prot_RAM" placeholder="numero protocollo" value="" required>
                            <label for="prot_RAM">Protocollo Documento</label>
                            <small class="form-text text-muted">se disponibile, inserire numero protocollo documento</small>
                        </div>
                        <div class="col-12 col-lg-6 it-datepicker-wrapper">
                            <div class="form-group">
                                <input class="form-control it-date-datepicker" onkeypress="return event.charCode >= 47 && event.charCode <= 57" id="data_prot" name="data_prot" type="text" value="" placeholder="gg/mm/aaaa" required>
                                <label for="data_prot">Data Documento</label>
                                <small class="form-text text-muted">inserisci la data in formato gg/mm/aaaa</small>

                            </div>
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
        </form>
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
        <button class="btn btn-primary btn-sm" id="saveRepBtn1"  type="submit" form="modal1" disabled>Salva</button>
        <button class="btn btn-success btn-sm" id="prev_btn"onclick="prevRep();" type="button" disabled>Anteprima</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="reportModal3">
  <div class="modal-dialog modal-lg" role="document" style="max-width:90%">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Chiusura del procedimento con ammissione al finanaziamento
            </h5>
        </div>
        <div class="modal-body">
        <input type="hidden" name="id_report3" id="id_report3" value="">
        <form id="modal3">
            <div class="row" id="dati_report_3">
           
                   <!--
                        <div class="col-12 col-lg-3 form-group">
                            <input type="text" class="form-control" id="num_prot3"  name="num_prot"placeholder="numero protocollo" value="">
                            <label for="num_prot">Numero protocollo Domanda Ammissione</label>
                            <small class="form-text text-muted">se disponibile, inserire numero protocollo Domanda Ammissione</small>

                            
                        </div>
                        <div class="col-12 col-lg-2 form-group">
                            <input type="text" class="form-control it-date-datepicker" id="dat_prot3"  name="dat_prot3" placeholder="gg/mm/aaaa" value="">
                            <label for="dat_prot3">Data protocollo Domanda Ammissione</label>
                            <small class="form-text text-muted">inserisci la data in formato gg/mm/aaaa</small>
                        </div>
                    -->
                        <div class="col-12 col-lg-2 form-group">
                            <input type="text" class="form-control it-date-datepicker" id="data_verbale3"  name="data_verbale3" placeholder="gg/mm/aaaa" value="" required>
                            <label for="data_verbale3">Data verbale</label>
                            <small class="form-text text-muted">inserisci la data in formato gg/mm/aaaa</small>

                        </div>

                   

                        <div class="col-12 col-lg-3 form-group">
                            <input type="text" class="form-control" name="prot_RAM3" id="prot_RAM3" placeholder="numero protocollo" value="" required>
                            <label for="prot_RAM">Protocollo Documento</label>
                            <small class="form-text text-muted">se disponibile, inserire numero protocollo documento</small>

                        </div>
                      
                        <div class="col-12 col-lg-2 form-group">
                                <input class="form-control it-date-datepicker" onkeypress="return event.charCode >= 47 && event.charCode <= 57" id="data_prot3" name="data_prot3" type="text" value="" placeholder="gg/mm/aaaa" required>
                                <label for="data_prot3">Data Documento</label>
                                <small class="form-text text-muted">inserisci la data in formato gg/mm/aaaa</small>

                        </div>
                       
                   
            
                       
            </div>
            </form>
            <div class="row">
               
                <button type="submit" form="modal3" id="btn_add_int3" class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> Inserisci dati al documento</button>
                <button type="button" id="btn_up_int3" onclick="modInt3()"class="btn btn-warning" style="display:none;"> <i class="fa fa-edit" aria-hidden="true" ></i> Modifica dati al documento</button>
            </div>
            <div class="row" id="div_tab_int3"  style="display:none;">
                <table class="table" id="tab_int3">
                    <thead>
                        <tr><td>Tipo</td>
                            <td>Descrizione</td>
                           
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>    
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Annulla</button>
            <button class="btn btn-primary btn-sm" id="saveRepBtn3" onclick="saveReport3();" type="button" disabled>Salva</button>
            <button class="btn btn-success btn-sm" id="prev_btn3"onclick="prevRep3();" type="button" disabled>Anteprima</button>
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
        <form id="modal4">
        <div class="row">
                <div class="form-group col-12 col-lg-3">
                    <input type="text" class="form-control" name="prot_RAM4" id="prot_RAM4" placeholder="numero protocollo" value="" required>
                    <label for="prot_RAM">Protocollo Documento</label>
                    <small class="form-text text-muted">se disponibile, inserire numero protocollo documento</small>
                </div>
                
                <div class="form-group col-12 col-lg-3">
                    <input class="form-control it-date-datepicker" onkeypress="return event.charCode >= 47 && event.charCode <= 57" id="data_prot4" name="data_prot4" type="text" value="" placeholder="formato gg/mm/aaaa" required>
                    <label for="data_prot4">Data Documento</label>
                    <small class="form-text text-muted">inserisci la data in formato gg/mm/aaaa</small>
                </div>
        </div>
        </form>
        <div id="dati_report_4">
            <form id="modal4b">   
                <div class="row" style="margin-top:10px;"> 
                    <div class="form-group col-12 col-lg-3">
                        
                            <input type="text" onkeypress="return event.charCode >= 47 && event.charCode <= 57"class="form-control it-date-datepicker" id="data_verbale_in"  name="data_verbale_in" placeholder="formato gg/mm/aaaa" value="" required>
                            <label for="data_verbale_in">Data verbale</label>
                            <small class="form-text text-muted">inserisci la data in formato gg/mm/aaaa</small>
                        
                    </div>          
                    <div class="form-group col-12 col-lg-3">
                        <input type="text" class="form-control" id="num_prot_rig"  name="num_prot_rig"placeholder="numero protocollo" value="" required>
                        <label for="num_prot_rig">Numero protocollo Preavviso di rigetto</label>
                        <small class="form-text text-muted">inserisci numero protocollo Preavviso di rigetto</small>
                        
                    </div>
                    <div class="form-group col-12 col-lg-3">
                    
                        <input type="text"onkeypress="return event.charCode >= 47 && event.charCode <= 57"class="form-control it-date-datepicker" id="dat_prot_rig"  name="dat_prot_rig" placeholder=" formato gg/mm/aaaa" value="" required>
                        <label for="dat_prot_rig">Data protocollo Preavviso di rigetto</label>
                        <small class="form-text text-muted">inserisci la data in formato gg/mm/aaaa</small>
                        
                    </div>
                            
                        
                    <div class="form-group col-12 col-lg-3">
                        
                        <input type="text" onkeypress="return event.charCode >= 47 && event.charCode <= 57"class="form-control it-date-datepicker" id="dat_prot_pre"  name="dat_prot_pre" placeholder="formato gg/mm/aaaa" value="" required>
                        <label for="dat_prot_pre">Data nota Preavviso</label>
                        <small class="form-text text-muted">inserisci la data in formato gg/mm/aaaa</small>
                        
                    </div>
                </div>   
                <div class="row" style="margin-top:10px;"> 
                
                    <div class="form-group col-12 col-lg-6 ">
                            <textarea type="text" class="form-control" maxlength="500" id="mot_ina"  name="mot_ina"placeholder="Motivazione inammissibilità" value="" required></textarea>
                            <label for="mot_ina">Motivazione di Inassibilità</label>
                            <small class="form-text text-muted">Scrivi motivazione inammissibilità</small>
                    </div>
                        
                
                        
                        
                
                
                </div>
            </form> 
        </div>
            <div class="row">
            <button type="button" id="btn_up_int4" onclick="modInt4()"class="btn btn-warning" style="display:none;"> <i class="fa fa-edit" aria-hidden="true" ></i> Modifica dati al documento</button>
                <button type="submit"  form="modal4b"id="btn_add_int4"class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> Inserisci dati al documento</button>

            </div>
            <div class="row" id="div_tab_int4"  style="display:none;">
                <table class="table" id="tab_int4">
                    <thead>
                        <tr><td>Tipo</td>
                            <td>Descrizione</td>
                           
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>    
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Annulla</button>
            <button class="btn btn-primary btn-sm" id="saveRepBtn4"  type="submit" form="modal4" disabled>Salva</button>
            <button class="btn btn-success btn-sm" id="prev_btn4"onclick="prevRep4();" type="button" disabled>Anteprima</button>
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
            <form id="modal2">
            <div class="row">
                    
                        <div class="col-12 col-lg-6 form-group">
                            <input type="text" class="form-control" id="motivazione"  name="motivazione"placeholder="Scrivere motivazione" value="" >
                            <label for="prot_RAM">Motivazione rigetto</label>
                        </div>

                    

                        <div class="col-12 col-lg-3 form-group">
                            <input type="text" class="form-control" name="prot_RAM2" id="prot_RAM2" placeholder="numero protocollo" value="" required>
                            <label for="prot_RAM">Protocollo Documento</label>
                            <small class="form-text text-muted">se disponibile, inserire numero protocollo documento</small>

                        </div>
                        <div class="col-12 col-lg-3 it-datepicker-wrapper" style="margin-top: 0px;">
                            <div class="form-group">
                                <input class="form-control it-date-datepicker" onkeypress="return event.charCode >= 47 && event.charCode <= 57" id="data_prot2" name="data_prot2" type="text" value="" placeholder="gg/mm/aaaa" required>
                                <label for="data_prot2">Data Documento</label>
                                <small class="form-text text-muted">inserisci la data in formato gg/mm/aaaa</small>

                            </div>
                        </div>
            
                    
            
            
            </div>
            </form>

            <div class="row">
            <button type="button" id="btn_add_int2" onclick="addInt2()"class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> Inserisci motivazione</button>

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
            <button class="btn btn-primary btn-sm" id="saveRepBtn2"  type="submit" form="modal2" disabled>Salva</button>
            <button class="btn btn-success btn-sm" id="prev_btn2"onclick="prevRep2();" type="button" disabled>Anteprima</button>
        </div>
    </div>
  </div>
</div>


<script>
     $("#modal3").on('submit', function( event ) {
        event.preventDefault();
  
        addInt3()
     })
     $("#modal1").on('submit', function( event ) {
        event.preventDefault();
        id=$('#id_report').val()
        saveReport(id)
     })
     $("#modal2").on('submit', function( event ) {
        event.preventDefault();
        id=$('#id_report2').val()
        saveReport2(id)
     })
     $("#modal4").on('submit', function( event ) {
        event.preventDefault();
        id=$('#id_report4').val()
        saveReport4(id)
     })
     $("#modal4b").on('submit', function( event ) {
        event.preventDefault();
        addInt4()
     })
     $('#reportModal').on('shown.bs.modal', function (e) {
        $('#tipo_integrazione').val('').selectpicker("refresh");
        $('#prot_RAM, #data_prot').val('');
        $("#tab_int > tbody").html("");
        $("#div_tab_int").hide();
    })
    $('#reportModal2').on('shown.bs.modal', function (e) {
        
        $('#prot_RAM2,#motivazione, #data_prot2').val('');
        $("#tab_int2 > tbody").html("");
        $("#div_tab_int2").hide();
    })
    $('#reportModal3').on('shown.bs.modal', function (e) {
        
        $('#prot_RAM3,#data_verbale3, #data_prot3').val('');
        $("#tab_int3 > tbody").html("");
        $("#div_tab_int3").hide();
    })

$('#tipo_integrazione').change(function(){
        $('#descrizione_integrazione').val('')
        tipo=$('#tipo_integrazione option:selected').val()
        $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=getTipoInt",
                    data: {tipo:tipo},
                    dataType: "json",
                    success: function(data){
                            console.log(data.frase)
                            $('#descrizione_integrazione').val(data.frase);
                            
                            $('#lab_des').addClass("active");
                            $('#lab_des').css("width","auto");
                            $('#des_int,#div_btn_add_int').show();

                    }
        })          
    });
</script>