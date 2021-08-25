
<?php

//$alleMag = getAllegati($i['id_RAM'],0,0);
$pmi=90;
$rete=91;
$ampl=92;
$pmidoc =getTipDoc($pmi);
$retedoc =getTipDoc($rete);
$ampldoc =getTipDoc($ampl);
$allepmi = getAllegato($pmi,$i['id_RAM'],0);
$allerete = getAllegato($rete,$i['id_RAM'],0);
$alleampl = getAllegato($ampl,$i['id_RAM'],0);
$testData['id_RAM']= $i['id_RAM'];
$calcContributo=calcolaContributo($testData);
//var_dump($calcContributo);

//var_dump($pmidoc);
//var_dump($retedoc);
///var_dump($ampldoc);
//var_dump($allepmi);
//var_dump($allerete);
//var_dump($alleampl);
$c_iCheck = false;
$c_i = checkIstanza($i['id_RAM']);
/*$checkAlle = getAllegatiCheck($i['id_RAM']);
if($c_i){
    if($c_i['pec']&&$c_i['firma']&&$c_i['doc']&&$c_i['contratto']&&$c_i['delega']&&$c_i['dim_impresa']){
        $c_iCheck = true;
    }
}
/*var_dump($c_iCheck);
var_dump($checkAlle);*/
?>
        <div class="row"  style="margin-bottom:10px;">
            <div class="col-12">
               


                    <div id="accordionalle" class="collapse-div collapse-background-active" role="tablist">
                        <div class="collapse-header" id="headingAlle">
                            <button data-toggle="collapse" data-target="#accordionAllegati" aria-expanded="true" aria-controls="accordionAllegati">
                            <i class="fa fa-paperclip" aria-hidden="true"></i> Verifica Allegati Dichiarazioni e Certificazioni
                            </button>
                        </div>
                        <div id="accordionAllegati" class="collapse show" role="tabpanel" aria-labelledby="headingAlle" data-parent="#accordionalle">
                            <div class="collapse-body">
                                <div class="row">
                                    <div class=" col-12">
                                        <table class="table table-borderless table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width:65%">Tipo</th>
                                                    <th style="width:10%">Data Caricamento</th>
                                                    <th style="width:10%">Stato</th>
                                                    <th style="width:15%"></th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size:15px;">
                                            <?php
                                         

                                                
                                                    if($i['pmi']=="Yes"){
                                                        $descrizione=$pmidoc;
                                                        $alle=0;
                                                        $file=0;
                                                        $tipo="pmi";
                                                        $tipo_doc= $pmi;
                                                        if($allepmi){
                                                            
                                                            $alle=$allepmi;
                                                            $data_alle = date("d/m/Y",strtotime($alle['data_agg']));
                                                            $file = file_exists($pathAlle.$alle['docu_id_file_archivio']);
                                                            //var_dump($file);
                                                        }
                                                        $checkFile='';
                                                        if($file==0){ $checkFile='Documento non caricato';};
                                                        
                                                        
                                                        require "allegatoistanza2.php";

                                                   
                                                    }
                                                    if($i['rete']=="Yes"){
                                                        $descrizione=$retedoc;
                                                        $alle=0;
                                                        $file=0;
                                                        $tipo="rete";
                                                        $tipo_doc= $rete;
                                                        if($allerete){
                                                      
                                                            $alle=$allerete;
                                                            $data_alle = date("d/m/Y",strtotime($alle['data_agg']));
                                                            $file = file_exists($pathAlle.$alle['docu_id_file_archivio']);
                                                        }
                                                        $checkFile='';
                                                        if($file==0){ $checkFile='Documento non caricato';};
                                                        require "allegatoistanza2.php";
                                                   
                                                    }
                                                    if($i['nr_1']>0||$i['nr_2']>0){
                                                        $descrizione=$ampldoc;
                                                        $alle=0;
                                                        $file=0;
                                                        $tipo="ampl";
                                                        $tipo_doc= $ampl;
                                                        if($alleampl){
                                                          
                                                            $alle=$alleampl;
                                                            $data_alle = date("d/m/Y",strtotime($alle['data_agg']));
                                                            $file = file_exists($pathAlle.$alle['docu_id_file_archivio']);
                                                        }
                                                        $checkFile='';
                                                        if($file==0){ $checkFile='Documento non caricato';};
                                                        require "allegatoistanza2.php";
                                                                                                      
                                                    }
                                                

                                                    ?>
                                          
                                           

                                            
                                              


                                            </tbody>

                                        </table>
                                        <?php

                                                    
                                                    
                                                    if(!$c_i){
                                                      $c_i = [
                                                        'dim_impresa' => null,
                                                        'note_dim_impresa'=> null,
                                                        'pec'=>null,
                                                        'note_pec'=>'',
                                                        'firma'=>null,
                                                        'note_firma'=>'',
                                                        'doc'=>null,
                                                        'note_doc'=>'',
                                                        'contratto'=>null,
                                                        'note_contratto'=>'',
                                                        'delega'=>null,
                                                        'note_delega'=>''
                                                      ];
                                                    }
                                                      
                                                          
                                                      
                                                    
                                        ?>
                                        <table class="table table-borderless table-sm">
                                            <thead>
                                            <tr>
                                                    <th style="width:25%">Tipo</th>
                                                    <th style="width:60%">Note</th>
                                                    <th style="width:10%">Stato</th>
                                                    <th style="width:5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Verifica Pec</td>
                                                    <td id="note_pec"><?=$c_i['note_pec']?$c_i['note_pec']:''?></td>
                                                    <td id="stato_pec">
                                                        <?php
                                                       
                                                        if(is_null($c_i['pec'])){?>
                                                            <span class="badge badge-warning" >In Lavorazione</span>
                                                        <?php
                                                         }
                                                         if($c_i['pec']==1){?>
                                                            <span class="badge badge-success" >Accettato</span>

                                                        <?php
                                                        } if($c_i['pec']=='0'){?>
                                                        <span class="badge badge-danger" >Respinto</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php if(!$disable_istr){?>
                                                    <button type="button" onclick="infoCert(<?=$i['id_RAM']?>,'pec','Verifica Pec');"class="btn btn-warning btn-xs" title="Aggiorna Stato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>
                                                    <?php } ?>
                                                    </td>
                                                </tr>  
                                                <tr>
                                                    <td>Verifica Firma Digitale</td>
                                                    <td id="note_firma"><?=$c_i['note_firma']?$c_i['note_firma']:''?></td>
                                                    <td id="stato_firma">
                                                        <?php
                                                        
                                                        if(is_null($c_i['firma'])){?>
                                                            <span class="badge badge-warning" >In Lavorazione</span>
                                                        <?php
                                                         }
                                                         if($c_i['firma']==1){?>
                                                            <span class="badge badge-success" >Accettato</span>

                                                        <?php
                                                        } if($c_i['firma']=='0'){?>
                                                        <span class="badge badge-danger" >Respinto</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php if(!$disable_istr){?>
                                                    <button type="button" onclick="infoCert(<?=$i['id_RAM']?>,'firma','Verifica Firma Digitale');"class="btn btn-warning btn-xs" title="Aggiorna Stato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>
                                                    <?php } ?>
                                                    </td>
                                                </tr>  
                                                <tr>
                                                    <td>Verifica Documento d'Identità</td>
                                                    <td id="note_doc"><?=$c_i['note_doc']?$c_i['note_doc']:''?></td>
                                                    <td id="stato_doc">
                                                        <?php
                                                        if(is_null($c_i['doc'])){?>
                                                            <span class="badge badge-warning" >In Lavorazione</span>
                                                        <?php
                                                         }
                                                         if($c_i['doc']==1){?>
                                                            <span class="badge badge-success" >Accettato</span>

                                                        <?php
                                                        } if($c_i['doc']=='0'){?>
                                                        <span class="badge badge-danger" >Respinto</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php if(!$disable_istr){?>
                                                        <button type="button" onclick="infoCert(<?=$i['id_RAM']?>,'doc','Verifica Documento d\'Identità');"class="btn btn-warning btn-xs" title="Aggiorna Stato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="certTitle">Verifica Contratto con Firma Digitale</td>
                                                    <td id="note_contratto"><?=$c_i['note_contratto']?$c_i['note_contratto']:''?></td>
                                                    <td id="stato_contratto">
                                                        <?php
                                                        if(is_null($c_i['contratto'])){?>
                                                            <span class="badge badge-warning" >In Lavorazione</span>
                                                        <?php
                                                         }
                                                         if($c_i['contratto']==1){?>
                                                            <span class="badge badge-success" >Accettato</span>

                                                        <?php
                                                        } if($c_i['contratto']=='0'){?>
                                                        <span class="badge badge-danger" >Respinto</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php if(!$disable_istr){?>
                                                        <button type="button" onclick="infoCert(<?=$i['id_RAM']?>,'contratto','Verifica Contratto con Firma Digitale');"class="btn btn-warning btn-xs" title="Aggiorna Stato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                if( $dichiarante['cod_tipo']=="2"){
                                                    echo $dichiarante['descrizione_tipo'];
                                                }?>
                                                <tr>
                                                    <td>Verifica Delega con Firma Digitale</td>
                                                    <td id="note_delega"><?=$c_i['note_delega']?$c_i['note_delega']:''?></td>
                                                    <td id="stato_delega">
                                                        <?php
                                                        if(is_null($c_i['delega'])){?>
                                                            <span class="badge badge-warning" >In Lavorazione</span>
                                                        <?php
                                                         }
                                                         if($c_i['delega']==1){?>
                                                            <span class="badge badge-success" >Accettato</span>

                                                        <?php
                                                        } if($c_i['delega']=='0'){?>
                                                        <span class="badge badge-danger" >Respinto</span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php if(!$disable_istr){?>
                                                    <button type="button" onclick="infoCert(<?=$i['id_RAM']?>,'delega','Verifica Delega con Firma Digitale');"class="btn btn-warning btn-xs" title="Aggiorna Stato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>
                                                    <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Verifica Dimensioni Impresa</td>
                                                    <td id="note_dim_impresa"><?=$c_i['note_dim_impresa']?$c_i['note_dim_impresa']:''?></td>
                                                    <td id="stato_dim_impresa">
                                                    <?php
                                                        if(is_null($c_i['dim_impresa'])){?>
                                                          <span class="badge badge-warning" >In Lavorazione</span>
                                                        <?php
                                                         }
                                                         if($c_i['dim_impresa']==1){?>
                                                            <span class="badge badge-success" >Piccola</span>
                                                        <?php
                                                        } if($c_i['dim_impresa']==2){?>
                                                        <span class="badge badge-success" >Media</span>
                                                        <?php
                                                        } if($c_i['dim_impresa']==3){?>
                                                          <span class="badge badge-success" >Grande</span>
                                                        <?php }?>
                                                        </td>
                                                    <td>
                                                    <?php if(!$disable_istr){?>
                                                    <button type="button" onclick="infoCert(<?=$i['id_RAM']?>,'dim_impresa','Verifica Dimensioni Impresa');"class="btn btn-warning btn-xs" title="Aggiorna Stato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>
                                                    <?php } ?>
                                                    </td>
                                                </tr>      

                                            </tbody>
                                        
                                        </table>
                                    </div>
                                </div>
                            </div>            
                        
                        </div>
                    </div>

                
            </div>
        </div>
 



 <!-- modals -->
 <div class="modal fade" tabindex="-1" role="dialog" id="infoDichiarazioni">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">info Allegato Dichiarazioni
                </h5>
            </div>
            <div class="modal-body">
            
                <div class="container">
                    <table class="table table-sm"  id="info_tab_alle_istanza">
                    
                    <tbody>
                        
                    </tbody>
                    </table>
                    <div id="upinfoalle_istanza">
                        
                    
                    </div>
                
                </div>
                

                
                
                

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
                <button class="btn btn-primary btn-sm"  onclick="info_alle_istanza();" type="button">Salva Modifichce</button>
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="certModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aggiorna stato
                </h5>
            </div>
            <div class="modal-body">
            
                <div id="upCheck_cert">
                <input type="hidden" name="tipo_cert" id="tipo_cert" value="">
                    <div class="bootstrap-select-wrapper col-4" style="margin-top:30px;" id="select_all">
                    
                        <label>Stato Controllo</label>
                        <select id="stato_check_cert" nome="stato_check_cert "title="Seleziona Stato">
                            <option value="A" style="background: #ffda73; color: #fff;">In Lavorazione</option>
                            <option value="B" style="background: #5cb85c; color: #fff;">Accettato</option>
                            <option value="C"style="background: #d9364f; color: #fff;">Respinto</option>
                        </select>
                    </div>
                    <div class="bootstrap-select-wrapper col-4" style="margin-top:30px;display:none;" id="select_dim_impresa" >
                    
                        <label>Dimensione Impresa</label>
                        <select id="sel_dim_impresa" nome="sel_dim_impresa "title="Seleziona Dimensione">
                            <option value="1" >Piccola</option>
                            <option value="2" >Media</option>
                            <option value="3">Grande</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-top:30px;">
                        <textarea rows="4" class="form-control" id="note_check_cert" nome="note_check_cert" maxlength="150" placeholder="inserire note"></textarea>
                        <label for="note_check_cert" class="active">Note</label>
                    </div>
                </div>
                

                
                
                

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
                <button class="btn btn-primary btn-sm" id="btnSaveCert" onclick="saveCert();" type="button">Salva Modifichce</button>
                
            </div>
        </div>
    </div>
</div>




<script>
    function infoCert(idRam,tipo,title){
        $('#note_check_cert').html('');
                if(tipo == 'dim_impresa'){
                    $('#select_dim_impresa').show();
                    $('#select_all').hide()
                }else{
                    $('#select_dim_impresa').hide();
                    $('#select_all').show()
                }
            
                $('#certModal')
                .find('.modal-title').text(title).end()  
                .modal('toggle');
                $.ajax({
                    type: "POST",
                    url: "controller/updateIstanze.php?action=checkCert",
                    data: {id_ram:idRam,tipo:tipo},
                    dataType: "json",
                    success: function(data){

                            console.log(data);
                            $('#tipo_cert').val(tipo)
                            $('#note_check_cert').text(data.note)
                            if(tipo == 'dim_impresa'){
                                $('#sel_dim_impresa').val(data.select);
                                $('#sel_dim_impresa').selectpicker('render');
                            }else{
                                $('#stato_check_cert').val(data.select);
                                $('#stato_check_cert').selectpicker('render');
                            }
                        
                            $('#btnSaveCert').attr('onclick','saveCert('+idRam+',\''+tipo+'\');')
                            
                    
                                
                            
                            

                            
                            
                    }
                })
    }
    function saveCert(idRam,tipo){
    
        if(tipo == 'dim_impresa'){
            
            select=$('#sel_dim_impresa option:selected').val() 
                }else{
                    select=$('#stato_check_cert option:selected').val() 
                }

        note = $('#note_check_cert').val()

        $.ajax({
            type: "POST",
            url: "controller/updateIstanze.php?action=upCert",
            data: {id_ram:idRam,tipo:tipo,select:select,note:note},
            dataType: "json",
            success: function(data){
                   
                    if(tipo == 'dim_impresa'){
                        if(select == 1){text = 'Piccola'}
                        if(select == 2){text = 'Media'}
                        if(select == 3){text = 'Grande'}
                        html = '<span class="badge badge-success" >'+text+'</span>';
                    }else{
                        html  = data.stato_tipo;
                    }
                    $('#note_'+tipo).html(data.note)
                    $('#stato_'+tipo).html(html)
                
                    if(data){
                        $('#certModal').modal('toggle')

                    }
            
            }
        })


    }

</script>