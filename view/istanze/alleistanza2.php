
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

//var_dump($pmidoc);
//var_dump($retedoc);
///var_dump($ampldoc);
//var_dump($allepmi);
//var_dump($allerete);
//var_dump($alleampl);


?>
        <div class="row"  style="margin-bottom:10px;">
            <div class="col-12">
               


                    <div id="accordionalle" class="collapse-div collapse-background-active" role="tablist">
                        <div class="collapse-header" id="headingAlle">
                            <button data-toggle="collapse" data-target="#accordionAllegati" aria-expanded="false" aria-controls="accordionAllegati">
                            <i class="fa fa-paperclip" aria-hidden="true"></i>Allegati Dichiarazioni 
                            </button>
                        </div>
                        <div id="accordionAllegati" class="collapse" role="tabpanel" aria-labelledby="headingAlle" data-parent="#accordionalle">
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
                                         

                                                
                                                    if($i['pmi']=="Yes"||$i['nr_1']>0||$i['nr_2']>0){//aggiungere 3 condizione 
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
                                                        
                                                        
                                                        
                                                        require "allegatoistanza.php";

                                                   
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
                                                        require "allegatoistanza.php";
                                                   
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
                                                        require "allegatoistanza.php";
                                                                                                      
                                                    }
                                                

                                                    ?>
                                            
                                              


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