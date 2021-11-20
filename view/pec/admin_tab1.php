<div class="it-list-wrapper">
    <div class="it-header-navbar-wrapper theme-light-desk">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--start nav-->
                    <nav class="navbar navbar-expand-lg has-megamenu">
                    <button class="custom-navbar-toggler" type="button" aria-controls="nav3" aria-expanded="false" aria-label="Toggle navigation" data-target="#nav3">
                        <svg class="icon">
                        <use xlink:href="svg/sprite.svg#it-burger"></use>
                        </svg>
                    </button>
                    <div class="navbar-collapsable" id="nav3" style="display: none;">
                        <div class="overlay" style="display: none;"></div>
                        <div class="close-div sr-only">
                        <button class="btn close-menu" type="button"><span class="it-close"></span>close</button>
                        </div>
                        <div class="menu-wrapper">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                    <span>Filtro Edizione</span>
                                    <svg class="icon icon-xs">
                                        <use xlink:href="svg/sprite.svg#it-expand"></use>
                                    </svg>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="link-list-wrapper">
                                        <ul class="link-list" style="width:max-content;">
                                            <li>
                                                <h3 class="no_toc" id="heading-es-4">Edizione</h3>
                                            </li>
                                            <li><a class="list-item" onclick="showEd(0);"><span>Tutti</span></a></li>
                                        <?php
                                            foreach($edizioni as $ed){?>
                                            <li><a class="list-item" onclick="showEd(<?=$ed['id']?>);"><span><?=$ed['des']?></span></a></li>
                                        <?php }?>
                                                        
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                    <span>Filtro Tipo Documento</span>
                                    <svg class="icon icon-xs">
                                        <use xlink:href="svg/sprite.svg#it-expand"></use>
                                    </svg>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="link-list-wrapper">
                                        <ul class="link-list" style="width:max-content;">
                                            <li>
                                                <h3 class="no_toc" id="heading-es-4">Tipo documento</h3>
                                            </li>
                                            <li><a class="list-item" onclick="showTipo(0,'Tutti');"><span>Tutti</span></a></li>
                                        <?php
                                            foreach($tipiReport as $tr){?>
                                            <li><a class="list-item" onclick="showTipo(<?=$tr['id']?>,'<?=$tr['descrizione']?>');"><span><?=$tr['descrizione']?></span></a></li>
                                        <?php }?>
                                                        
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                    <span>Utente Inserimento</span>
                                    <svg class="icon icon-xs">
                                    <use xlink:href="svg/sprite.svg#it-expand"></use>
                                    </svg>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="link-list-wrapper">
                                        <ul class="link-list" style="width:max-content;">
                                        
                                            <li><a class="list-item" onclick="showUser(0);"><span>Tutti</span></a></li>
                                                        <?php
                                                            foreach($userIns as $ui){
                                                                $classUser=explode('@',$ui);
                                                                ?>
                                                                <li><a class="list-item" onclick="showUser('<?=$classUser[0]?>');" ><span><?=$ui?></span></a></li>
                                                            <?php }?>
                                                        
                                        </ul>
                                    </div>
                                </div>
                            </li>
                             <!-- <li class="nav-item "><a class="nav-link " id="selAll"onclick="unsendCkAll();"><span>Seleziona Tutti </span></a></li>
                        
                          <li class="nav-item"><a class="nav-link" href="#"><span>Elimina richieste Selezionate </span></a></li> -->
                            
                            
                            
                        </ul>
                        </div>
                    </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <em>Tipo documento:</em> <small id="info_tipo">Tutti</small>
        </div>
        <div class="col-3">
            <em>Utente Inserimento:</em> <small id="info_user">Tutti</small>
        </div>                                                       
        
    </div>
  <ul class="it-list">
    
    <?php

    if($pecUnsend){ 
        foreach($pecUnsend as $pa){
            //var_dump($pa);
                $tipo = getInfoReport($pa['tipo_report']);
                //var_dump($tipo);
                $istanza = getIstanza($pa['id_RAM']);
                $classUser=explode('@',$pa['user_ins']);
                $tipo_istanza = getTipoIstanza($istanza['tipo_istanza']);
               
                ?>
            <li class="tiporeport_<?=$pa['tipo_report']?> userins_<?=$classUser[0]?> edizione_<?=$istanza['tipo_istanza']?>">
                <a class="it-has-checkbox" href="#">
                    <div class="form-check">
                        <input id="<?=$pa['id']?>" class="unsend"type="checkbox" >
                    <label for="<?=$pa['id']?>"></label>
                    </div>
                    <div class="it-right-zone">
                        <div class="col-4">
                            <span class="text"><?=$pa['id_RAM']?>/<?=$tipo_istanza['anno']?> - <?=$tipo_istanza['des']?><br><?=$istanza['ragione_sociale']?></span>
                        </div>
                        <div class="col-3">
                            <span class="text"><em><?=$tipo['descrizione']?></em></span>
                        </div>
                        <div class="col-3">
                            <span class="text" style="font-size: 0.7em;"><em style="display:inline;">Inserita da: </em><?=$pa['user_ins']?> <?=date("d/m/Y", strtotime($pa['data_ins']))?></span>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-warning btn-sm" style="padding: 5px 12px;"title="Anteprima Documento" onclick="prevRep(<?=$pa['id']?>,'<?=$tipo['report_dir']?>')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-primary btn-sm" title="Scarica Documento" style="padding: 5px 12px;" onclick="downRep(<?=$pa['id']?>,'<?=$tipo['report_dir']?>')"><i class="fa fa-download" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-success btn-sm" style="padding: 5px 12px;"title="Componi Messaggio " onclick="msgModal(<?=$pa['id']?>,<?=$pa['tipo_report']?>);"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" style="padding: 5px 12px;"title="Elimina Pec" onclick="delRep(<?=$pa['id']?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>

                        </div>

                    </div>
                </a>
            </li>

    <?php   }
    }else{?>
        <li>
            <a class="it-has-checkbox" href="#">
               
                <div class="it-right-zone"><span class="text">Non ci sono pec da convalidare</span>
                </div>
            </a>
        </li>
        <?php }?>
  </ul>
</div>
<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="msgModal">
<div class="modal-dialog modal-lg" role="document" style="max-width:80%">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title">Anteprima Pec
        </h5>
      </div>
        <div class="modal-body">
            <div class="row" > 
                <div class="col-lg-6 col-12">
                    <div class="form-group">
                        <label >Destinatario</label>
                        <input  type="text" id="pec_dest" value=""readonly placeholder=" ">
                    
                    </div>
            
                    <div class="form-group">
                        <input  type="text" id="pec_object" readonly placeholder=" ">
                        <label >Oggetto</label>
                    </div>
                    
                
                    <div class="form-group">
                        <textarea  type="text" rows="6" id="pec_body" readonly placeholder=" "></textarea>
                        <label >Corpo Mail</label>
                    </div>
                    <form method="post"  id="form_allegato_pec"  enctype="multipart/form-data">
                        <input type="hidden" id="id_pec" name="id" value="">
                        <input type="hidden" id="id_ram_pec" name=" id_ram" value="">
                        <input type="hidden" id="tipo" value="">
                    
                        <input type="file" name="upload1" id="upload1" class="upload" onchange="checkDoc();" />
                            <label for="upload1">
                                <svg class="icon icon-sm" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-upload"></use></svg>
                                <span>Upload</span>
                            </label>
                            <ul class="upload-file-list">
                                <li class="upload-file success">
                                <svg class="icon icon-sm" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-file"></use></svg>
                                <p>
                                    <span class="sr-only">File caricato:</span>
                                <span id="name_alle">Allegato</span>  <span class="upload-file-weight"></span>
                                </p>
                                <button disabled>
                                    <span class="sr-only">Caricamento ultimato</span>
                                    <svg class="icon" aria-hidden="true"><use xlink:href="svg/sprite.svg#it-check"></use></svg>
                                </button>
                            
                                </li>
                            </ul>
                    </form>
                </div>
                <div class="col-lg-6 col-12" id="datiAllegato">
                    <h5>Dati Allegato</h5>
                        <div class="row" style="margin-top:30px;" id="row_dati_allegato">
                      
                            <div class="form-group col-lg-6 col-12" >
                                <input  type="text" form="form_allegato_pec" id="protRam_object" name="prot_RAM" placeholder=" ">
                                <label >Protocollo RAM</label>
                            </div>
  
                            <div class="it-datepicker-wrapper col-lg-6 col-12">
                                <div class="form-group">
                                    <input form="form_allegato_pec" class="form-control it-date-datepicker" onkeypress="return event.charCode >= 47 && event.charCode <= 57" id="data_prot_object" name="data_prot" type="text" value="" placeholder="gg/mm/aaaa" >
                                    <label for="data_prot_object">Data Documento</label>
                                    <small class="form-text text-muted">inserisci la data in formato gg/mm/aaaa</small>
                                </div>
                            </div>
       
                            <div class="it-datepicker-wrapper col-lg-6 col-12">
                                <div class="form-group">
                                    <input type="hidden" id="data_verbale_id" value="">
                                    <input form="form_allegato_pec" class="form-control it-date-datepicker dataverbale" onkeypress="return event.charCode >= 47 && event.charCode <= 57" id="data_verbale_object" name="data_verbale" type="text" value="" placeholder="gg/mm/aaaa" >
                                    <label for="data_verbale_object">Data Verbale</label>
                                    <small class="form-text text-muted">inserisci la data in formato gg/mm/aaaa</small>
                                </div>
                            </div>
                        </div>
                    
                   
                </div>    
            </div> 
            
        </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" data-dismiss="modal" type="button">Annulla</button>
        <button class="btn btn-success btn-sm"  id="btnSubmitPec"type="submit" form="form_allegato_pec">Salva Pec</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
      $('.it-date-datepicker').datepicker({
            inputFormat: ["dd/MM/yyyy"],
            outputFormat: 'dd/MM/yyyy',
            
      });


}); 
    function msgModal(id,tipo){
       $('.dataverbale').hide()
        $.ajax({
            type: "POST",
            url: "controller/updateReport.php?action=getReportId",
            data: {id:id},
            dataType: "json",
            success: function(data){
                console.log(data)
                $('#id_pec').val(id)
                console.log(data.data.id_RAM)
                $('#id_ram_pec').val(data.data.id_RAM)
                $('#pec_dest').val(data.istanza.pec_impr)
                $('#pec_object').val(data.type.object+ ' ' + data.info)
                const options = {  year: 'numeric', month: '2-digit', day: '2-digit' };
                dataP = new Date(data.data.data_prot).toLocaleDateString('it-IT', options)
                
                data_prot= dataP;
                $('#tipo').val(tipo)
                html=data.type.body.replaceAll('%*', '\n').replace('%ragSoc%', data.istanza.ragione_sociale)
                $('#pec_body').html(html)
                $('#msgModal').modal('toggle')
                if(tipo == 3){
                    $('.dataverbale').show()
                
                    $.each(data.attr,function(k,v){
                       
                        if(v.tipo === '3'){
                            $('#data_prot_object').val(v.descrizione)
                        }
                        if(v.tipo === '4'){
                           
                            $('#protRam_object').val(v.descrizione)
                        }
                        if(v.tipo === '5'){
                            $('#data_verbale_id').val(v.id)
                            $('#data_verbale_object').val(v.descrizione)
                        }
                   } )

                }else{
                        $('#protRam_object').val(data.data.prot_RAM)
                        $('#data_prot_object').val(data_prot)
                }
            }
        });
         
    }
    function prevRep(id, dir){  
        var url = dir+'?id='+id+'&tipo=P';
        window.open(url,"Stampa");
    }
    function downRep(id, dir){
        var url = dir+'?id='+id+'&tipo=D';
        window.open(url,"Stampa");
    }
    function savePec(){
        var fa = document.getElementById("upload1");
        var f = fa.files[0]
        console.log(f)
    }
    function checkDoc(){
        var fa = document.getElementById("upload1");
        var f = fa.files[0]      
        if (f.type==='application/pdf') {
            if (f.size > 3388608 || f.fileSize > 3388608)
            {
                Swal.fire("Operazione Non Completata!", " L'allegato supera le dimensioni di 3MB", "warning");
                fa.value = null;
            } 
        }else{
            Swal.fire("Operazione Non Completata!", " L'allegato è del tipo errato. Selezionare un file PDF", "warning");
            fa.value = null;
        }
           
           
   }
    $('#form_allegato_pec').submit(function(event){
        var htmltext='<div class="progress"><div class="progress-bar" role="progressbar" id="progress-bar"style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>'
        Swal.fire({ 
                  html:true,
                  title: "Attendere completamento operazione",
                  html:htmltext,
                  icon: "info",
                  allowOutsideClick:false,
                  showConfirmButton:false
            });
        event.preventDefault();
        var fa = document.getElementById("upload1");
        var f = fa.files[0]
        console.log(f)
        formData = new FormData(this);
        idRAM = $('#id_ram_pec').val()
        tipo = $('#tipo').val()
        if(tipo == 1 ){reportDir = 'report/integrazione/integrazione.php'} 
        if(tipo == 2 ){reportDir = 'report/rigetto/rigetto.php'} 
        if(tipo == 3 ){reportDir = 'report/ammissione/ammissione.php'} 
        if(tipo == 4 ){reportDir = 'report/inammissibilita/inammissibilita.php'}  
        console.log(formData.get('id'))
        if(f){
        $.ajax({
            xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                $("#progress-bar").width(percentComplete + '%');
                                
                        }
                    }, false);
                    return xhr;
            },
            url: "controller/updatePec.php?action=newAllegatoPec",
            type:"POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                                    $("#progress-bar").width('0%');
                                    $('#uploadStatus').html('<img src="images/loading.gif"/>');
                              },
            error:function(){ 
                Swal.fire("Operazione Non Completata!", "Allegato non caricato correttamente.", "warning");
            },
            success: function(data){
                if(tipo ==3){
                    data_verbale_id = $('#data_verbale_id').val()
                    data_verbale_des = $('#data_verbale_object').val()
                    $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=upContributo",
                        data: {idRAM:idRAM},
                        dataType: "json",
                        success: function(data){
                        
                            console.log(data)
                        }
                    })
                    $.ajax({
                        type: "POST",
                        url: "controller/updateReport.php?action=upDettaglioReport",
                        data: {data_verbale_id:data_verbale_id,data_verbale_des:data_verbale_des },
                        dataType: "json",
                        success: function(data){
                        
                            console.log(data)
                        }
                    })
                }
                console.log(data)
                Swal.fire({
                    title:"Operazione Completata!",
                    html:"Allegato caricato correttamente.",
                    icon:"success"}).then((result) => {
                        if (result.isConfirmed) {
                                    location.reload()
                        }
                });
            }
        })
        }else{

            $.ajax({
                    url: "controller/updatePec.php?action=upAllegatoPec",
                    type:"POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    error:function(){ 
                        Swal.fire("Operazione Non Completata!", "Allegato non caricato correttamente.", "warning");
                    },
                    success: function(data){

                    $.ajax({
                    
                        url: reportDir+"?id="+formData.get('id')+"&tipo=S",
                        type:"POST",
                        error:function(){ 
                            Swal.fire("Operazione Non Completata!", "Allegato non caricato correttamente.", "warning");
                        },
                        success: function(filename){
                            formData.append('nome_file',filename)
                        
                            $.ajax({
                                url: "controller/updatePec.php?action=newAllegatoPec",
                                type:"POST",
                                data: formData,
                                dataType: 'json',
                                contentType: false,
                                cache: false,
                                processData:false,
                                error:function(){ 
                                    Swal.fire("Operazione Non Completata!", "Allegato non caricato correttamente.", "warning");
                                },
                                success: function(data){
                                    
                                    if(tipo ==3){
                                        data_verbale_id = $('#data_verbale_id').val()
                                        data_verbale_des = $('#data_verbale_object').val()
                                        $.ajax({
                                            type: "POST",
                                            url: "controller/updateIstanze.php?action=upContributo",
                                            data: {idRAM:idRAM},
                                            dataType: "json",
                                            success: function(data){
                                            
                                                console.log(data)
                                            }
                                        })
                                        $.ajax({
                                            type: "POST",
                                            url: "controller/updateReport.php?action=upDettaglioReport",
                                            data: {data_verbale_id:data_verbale_id,data_verbale_des:data_verbale_des },
                                            dataType: "json",
                                            success: function(data){
                                            
                                                console.log(data)
                                            }
                                        })
                                    }
                                    Swal.fire({
                                        title:"Operazione Completata!",
                                        html:"Allegato caricato correttamente.",
                                        icon:"success"}).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                                location.reload()
                                                                    }
                                                                    });
                                }
                            })




                        }
                    })
                }
            })
        }
    })
    $('#upload1').on('click', function(){
        $('#btnSubmitPec').prop('disabled', true);
    })
    $('#upload1').on('change', function(){
        var fa = document.getElementById("upload1");
        var f = fa.files[0]
        $('#name_alle').html(f.name)
        $('#btnSubmitPec').prop('disabled', false);
    })
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
                                url: "controller/updatePec.php?action=delReport",
                                data: {id:id},
                                dataType: "json",
                                success: function(results){
                                    Swal.fire({
                                        title: 'Report eliminato correttamente',
                                        text: "Non potrai più recuperarlo",
                                        icon: 'success',
                                        
                                        }).then((result) => {
                                                        if (result.isConfirmed) {
                                                                    location.reload()
                                                        }
                                                        });     
                                       
                                         
                                }

                            })


                        }
                  })
    }
   
</script>
