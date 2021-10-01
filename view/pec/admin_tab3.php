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
                            <!--
                            <li class="nav-item "><a class="nav-link " id="selAll"onclick="unsendCkAll();"><span>Seleziona Tutti </span></a></li>
                            <?php  if(getEnablePec()){?>
                            <li class="nav-item"><a class="nav-link" href="#"><span>Invia Pec Selezionate</span></a></li>
                                <?php } ?>
                            <li class="nav-item"><a class="nav-link" href="#"><span>Elimina richieste Selezionate </span></a></li>-->
                            
                            
                            
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

    if($pecConv){
        foreach($pecConv as $pa){ //var_dump($pa);
            //var_dump($pa);
            $tipo = getInfoReport($pa['tipo_report']);
            $istanza = getIstanza($pa['id_RAM']);
            $classUser=explode('@',$pa['user_ins']);
            $tipo_istanza = getTipoIstanza($istanza['tipo_istanza']);
            ?>
                <li id="tosend_<?=$pa['id']?>"class="tiporeport_<?=$pa['tipo_report']?> userins_<?=$classUser[0]?>">
                    <a class="it-has-checkbox" href="#">
                        <div class="form-check">
                            <input id="<?=$pa['id']?>" class="unsend"type="checkbox" >
                        <label for="<?=$pa['id']?>"></label>
                        </div>
                        <div class="it-right-zone">
                            <div class="col-4">
                                <span class="text"><?=$pa['id_RAM']?>/<?=$tipo_istanza['anno']?> - <?=$tipo_istanza['des']?> <br><?=$istanza['ragione_sociale']?></span>
                            </div>
                            <div class="col-2">
                                <span class="text"><em><?=$tipo['descrizione']?></em></span>
                            </div>
                            <div class="col-4">
                                <span class="text" style="font-size: 0.7em;"><em style="display:inline;">Inserita da:</em> <?=$pa['user_ins']?> <?=date("d/m/Y", strtotime($pa['data_ins']))?></span>
                                <span class="text" style="font-size: 0.7em;"><em style="display:inline;">Convalidata da:</em> <?=$pa['user_conv']?> <?=date("d/m/Y", strtotime($pa['data_conv']))?></span>
                            </div>
                            <div class="col-2">
                            <button type="button" class="btn btn-warning btn-sm" style="padding: 5px 12px;"onclick="window.open('allepec.php?id=<?=$pa['id']?>','_blank')"title="Anteprima Documento"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-primary btn-sm" title="Scarica Documento"  style="padding: 5px 12px;" onclick="window.open('downpec.php?id=<?=$pa['id']?>','_blank')"><i class="fa fa-download" aria-hidden="true"></i></button>
<?php  if(getEnablePec()){?>
                                <button type="button" class="btn btn-success btn-sm" style="padding: 5px 12px;"title="Invia Pec " onclick="msgModalPec(<?=$pa['id']?>, <?=$pa['id_RAM']?>);"><i class="fa fa-envelope" aria-hidden="true"></i></button>
<?php } ?>
<button type="button" class="btn btn-danger btn-sm" style="padding: 5px 12px;"title="Elimina Pec" onclick="delRep(<?=$pa['id']?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>

                            </div>

                        </div>
                    </a>
                </li>

    <?php }
}else{?>
                <li>
                    <a class="it-has-checkbox" href="#">
                    
                        <div class="it-right-zone"><span class="text">Non ci sono pec da inviare</span>
                        </div>
                    </a>
                </li>
<?php }?>
  </ul>
</div>
<script>

function msgModalPec(id, idRAM){    
    
    Swal.fire({
                  title: 'Invio Pec',
                  text: "Vuoi inviare la comunicazione?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'SI Inviala!',
                  cancelButtonText: 'NO, Annulla!'
                  }).then((result) => {
                        if (result.isConfirmed) {
                            var htmltext='<div class="progress"><div class="progress-bar" role="progressbar" id="progress-bar2"style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>'
                            Swal.fire({ 
                                    html:true,
                                    title: "Attendere completamento operazione",
                                    html:htmltext,
                                    icon: "info",
                                    allowOutsideClick:false,
                                    showConfirmButton:false
                                });


                        $.ajax({
                            xhr: function() {
                              var xhr = new window.XMLHttpRequest();
                              xhr.upload.addEventListener("progress", function(evt) {
                                    if (evt.lengthComputable) {
                                          var percentComplete = ((evt.loaded / evt.total) * 100);
                                          $("#progress-bar2").width(percentComplete + '%');
                                          
                                    }
                              }, false);
                              return xhr;
                        },
                            type: "POST",
                            url: "controller/updatePec.php?action=testSendMail",
                            data: {id:id, id_RAM:idRAM},
                            dataType: "json",
                            beforeSend: function(){
                                    $("#progress-bar").width('0%');
                                    $('#uploadStatus').html('<img src="images/loading.gif"/>');
                              },
                              error:function(){ 
                                    Swal.fire("Operazione Non Completata!", "Pec non inviata correttamente.", "warning");
                                    Swal.fire({
                                            title:"Operazione Non Completata!",
                                            html:"Pec non inviata correttamente.",
                                            icon:"warning"}).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                                return false;
                                                                        }
                                                                        });

                                },
                            success: function(data){
                                console.log(data)
                                localStorage.setItem('currentTab','nav-vertical-tab-bg3');
                                Swal.fire({
                                            title:"Operazione Completata!",
                                            html:"Pec inviata correttamente.",
                                            icon:"success"}).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                                    location.reload()
                                                                        }
                                                                        });
                            }
                        });
                        }
                  })
}
</script>
