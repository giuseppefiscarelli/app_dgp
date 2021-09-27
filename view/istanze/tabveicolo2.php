                                    <div id="accordionDivVeicoli_<?=$tvei["tpvc_codice"]?>" class="collapse-div " role="tablist">
                                            <?php
                                                $veicolo = getRowVeicolo($tvei["tpvc_codice"],$i['id_RAM']);
                                                foreach($veicolo as $rv ){
                                                    $checkRott = checkRott($i['id_RAM'],$rv['tipo_veicolo']);
                                                    //var_dump($checkRott);
                                                    $allegatiIntegrazione =intval(getAllegatiIntegrazione($i['id_RAM'], $status['data_chiusura'],$rv['tipo_veicolo'],$rv['progressivo']));
                                                    
                                                    $countDocVeicolo=countDocVeicolo($rv['tipo_veicolo']);
                                                    $countDocVeicolo= $countDocVeicolo?$countDocVeicolo:0;
                                                    $countDocVeicoloInfo=countDocVeicoloInfo($rv['id_RAM'],$rv['tipo_veicolo'],$rv['progressivo']);
                                                    if($rv['tipo_acquisizione']=='01'){
                                                        $countDocVeicolo =$countDocVeicolo-1;
                                                    }
                                                    if($checkRott){
                                                       
                                                        $countDocVeicoloRottInfo=countDocVeicoloRottInfo($rv['id_RAM'],$rv['tipo_veicolo'],$rv['progressivo']);
                                                        $countDocVeicoloInfo=$countDocVeicoloInfo-$countDocVeicoloRottInfo;
                                                        $countDocVeicoloInfo<0?$countDocVeicoloInfo=0:$countDocVeicoloInfo;
                                                    }
                                                   
                                            ?>
                                            
                                            <div class="collapse-header" id="headingA<?=$rv['progressivo']?>_<?=$rv['id']?>">
                                                <button data-toggle="collapse" data-target="#accordion<?=$rv['progressivo']?>_<?=$rv['id']?>" aria-expanded="false" aria-controls="accordion<?=$rv['progressivo']?>_<?=$rv['id']?>">
                                                Veicolo #<?=$rv['progressivo']?> <?=$rv['targa']?' - Targa '.$rv['targa']:''?>
                                                </button>
                                                <?php
                                                        if(!$rv['targa']&&!$rv['marca']&&!$rv['modello']&&!$rv['tipo_acquisizione']&&!$rv['costo']){
                                                            $color="red";
                                                            $text=" non";
                                                            $icon="ban";
                                                        }else{
                                                            $color="green";
                                                            $text="";
                                                            $icon="check";

                                                        }?>
                                                        <div class="row">
                                                <small class="form-text text-muted" id="ckeck_info_vei_<?=$rv['progressivo']?>_<?=$rv['id']?>" style="padding-left:50px"><i class="fa fa-<?=$icon?>" style="color:<?=$color?>;"aria-hidden="true"></i> Dati Veicolo<?=$text?> presenti</small>
                                                <?php
                                                        $colorDoc="red";
                                                        $iconDoc="ban";
                                                        if($countDocVeicoloInfo==$countDocVeicolo){
                                                            $colorDoc="green";
                                                            $iconDoc="check";
                                                        }
                                                ?>
                                                <small id="check_vei_<?=$rv['tipo_veicolo'].'_'.$rv['progressivo']?>" class="form-text text-muted" style="padding-left:50px">
                                                    <i class="fa fa-<?=$iconDoc?>" style="color:<?=$colorDoc?>;"aria-hidden="true"></i> 
                                                    Documenti veicoli caricati <b id="c_p_d_<?=$rv['tipo_veicolo'].'_'.$rv['progressivo']?>"><?=$countDocVeicoloInfo?></b> 
                                                    di <b id="c_t_d_<?=$rv['tipo_veicolo'].'_'.$rv['progressivo']?>"><?=$countDocVeicolo?></b>
                                                </small>
                                                <?php 
                                                if($checkRott){
                                                ?>
                                                    <small id="check_vei_R_<?=$rv['tipo_veicolo'].'_'.$rv['progressivo']?>" class="form-text text-muted" style="padding-left:50px">
                                                     
                                                    Documenti Rottamazione caricati <b id="c_p_d_R_<?=$rv['tipo_veicolo'].'_'.$rv['progressivo']?>"><?=$countDocVeicoloRottInfo?></b> 
                                                    di <b id="c_t_d_R_<?=$rv['tipo_veicolo'].'_'.$rv['progressivo']?>">2</b>
                                                </small>
                                                <?php }
                                                if($status_integrazione && $rv['stato_admin'] !== 'B'){?>
                                                    <div><badge class="badge badge-warning blink" style="margin-left:100%;">Abilitato per Integrazione</badge></div>
                                                <?php }
                                                ?>            
                                              
                                            </div>
                                                                
                                            </div>
                                            <div id="accordion<?=$rv['progressivo']?>_<?=$rv['id']?>" class="collapse " role="tabpanel" aria-labelledby="headingA<?=$rv['progressivo']?>_<?=$rv['id']?>" data-parent="#accordionDivVeicoli_<?=$tvei["tpvc_codice"]?>">
                                                <div class="collapse-body">
                                            
                                                    <div class="row">
                                                            <div class="col-lg-6 col-12">
                                                                <table class="table table-borderless table-sm">
                                                                    <caption style="font-size: 25px;caption-side: top;padding-bottom: 0px;">Dati Veicolo</caption>
                                                                    <thead>
                                                                        <tr >
                                                                        <th>
                                                                        <?php
                                                                            if((!isUserAdmin()&&$rend['aperta']==1&&$activeIst==true) || ($status_integrazione && !$rv['targa']) ){
                                                                        
                                                                                if(!$rv['targa']&&!$rv['marca']&&!$rv['modello']&&!$rv['tipo_acquisizione']&&!$rv['costo']){?>
                                                                            <button type="button" id="btn_up_<?=$rv['progressivo']?>_<?=$rv['id']?>"class="btn btn-success btn-sm" onclick="infomodal(<?=$rv['progressivo']?>,<?=$rv['id']?>);" ><i class="fa fa-info" aria-hidden="true"></i> Inserisci dati veicolo</button>

                                                                                <?php 
                                                                            }else{?>
                                                                                                                                                    
                                                                            <button type="button"  id="btn_up_<?=$rv['progressivo']?>_<?=$rv['id']?>"class="btn btn-success btn-sm" onclick="infomodalup(<?=$rv['progressivo']?>,<?=$rv['id']?>);" ><i class="fa fa-info" aria-hidden="true"></i> Aggiorna dati veicolo</button>


                                                                            <?php }
                                                                            }?>
                                                                        
                                                                            </th></tr>   
                                                                    </thead>
                                                                    <tbody style="font-size:15px;">
                                                                    <tr>
                                                                            <td>Targa</td>
                                                                            <td id="targa_<?=$rv['id']?>"><?=$rv['targa']?$rv['targa']:'Non Presente'?></td>
                                                                    
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Marca</td>
                                                                            <td id="marca_<?=$rv['id']?>"><?=$rv['marca']?$rv['marca']:'Non Presente'?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Modello</td>
                                                                            <td id="modello_<?=$rv['id']?>"><?=$rv['modello']?$rv['modello']:'Non Presente'?></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td>Tipo Acquisizione</td>
                                                                            <td id="tipo_acquisizione_<?=$rv['id']?>"><?php if($rv['tipo_acquisizione']){
                                                                                if($rv['tipo_acquisizione']=='01'){
                                                                                    echo 'Acquisto';
                                                                                }elseif($rv['tipo_acquisizione']=='02'){
                                                                                    echo 'Leasing';
                                                                                }
                                                                            }else{echo 'Non Presente';}?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Costo</td>
                                                                        
                                                                            <td id="costo_<?=$rv['id']?>"><?=$rv['costo']?'€ '.number_format($rv['costo'], 2, ',', '.'):'Non Presente'?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                        </div>
                                            
                                                    </div>    
                                                    <div class="row">   
                                                        <div class="col-lg-12">
                                                                <div class="card">   
                    
                                                                    <table class="table table-borderless table-sm" id="tab_doc_<?=$rv['tipo_veicolo']?>_<?=$rv['progressivo']?>">
                                                                        <caption style="font-size: 25px;caption-side: top;">Documenti Veicolo</caption>

                                                                        <thead>
                                                                        <?php
                                                                       
                                                                           if((!isUserAdmin()&&$rend['aperta']==1&&$activeIst==true) || ($status_integrazione && $rv['stato_admin'] !== 'B')){?>
                                                                        <tr>
                                                                            <th colspan="5">
                                                                                    <button type="button" id="btn_docmodal_<?=$rv['id']?>" class="btn btn-success btn-sm" onclick="docmodal(<?=$rv['progressivo']?>,<?=$rv['tipo_veicolo']?>,<?=$rv['id_RAM']?>,'<?=$rv['tipo_acquisizione']?>');" ><i class="fa fa-upload" aria-hidden="true"></i> Carica documento</button>
                                                                            </th>
                                                                        
                                                                        </tr>
                                                                        <?php
                                                                            }
                                                                            ?>
                                                                            <tr style="font-size:15px;">
                                                                                <th>Tipo Documento</th>
                                                                                <th>Data Upload</th>
                                                                                
                                                                                <th>Note</th>
                                                                                <th></th>
                                                                            </tr>   
                                                                        </thead>
                                                                        <tbody style="font-size:15px;">
                                                                                <?php
                                                                                
                                                                                $allegati=getAllegati($i['id_RAM'],$rv['tipo_veicolo'],$rv['progressivo']);
                                                                                if($allegati){
                                                                                    foreach ($allegati as $alle) {
                                                                                        $tipoDoc = getTipDoc($alle['tipo_documento']);
                                                                                        $campoDoc = getCampoDoc($alle['tipo_documento']);
                                                                                        //var_dump($campoDoc);
                                                                                        

                                                                                        ?>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <?php
                                                                                            if($alle['data_agg'] > $rend['data_chiusura']){ ?>
                                                                                        <i class="fa fa-repeat " aria-hidden="true" style="color:#ffc107;"></i>
                                                                                         <?php } ?> 
                                                                                            <?=$tipoDoc?>
                                                                                        </td>
                                                                                        <td><?=date("d/m/Y H:i", strtotime($alle['data_agg']))?></td>
                                                                                        <td><?=$alle['note']?></td>
                                                                                        <td>
                                                                                            <button type="button" onclick="infoAlle(<?=$alle['id']?>);"class="btn btn-warning btn-xs" title="Visualizza Info Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-list" aria-hidden="true"></i></button>

                                                                                            <button type="button" onclick="window.open('allegato.php?id=<?=$alle['id']?>', '_blank')"title="Vedi Documento"class="btn btn-xs btn-primary " style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                                                                            <a type="button" href="download.php?id=<?=$alle['id']?>" download title="Scarica Documento"class="btn btn-xs btn-success " style="padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i> </a>
                                                                                            <?php
                                                                                                    if((!isUserAdmin()&&$rend['aperta']==1&&$activeIst==true) || ($alle['data_agg'] > $rend['data_chiusura'])){?>
                                                                                            <button type="button" onclick="delAll(<?=$alle['id']?>,<?=$rv['tipo_veicolo']?>,<?=$rv['progressivo']?>,this)"title="Elimina Documento"class="btn btn-xs btn-danger " style="padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                            </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                    }
                                                                                }else{?>

                                                                                <tr id="tr_not"><td>Non ci sono Documenti Caricati</td></tr> 
                                                                                <?php
                                                                                }?>
                                                                        </tbody>
                                                                    </table>
                                                                                    
                                                                </div>                     
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        

                                            <?php
                                                    }
                                                    ?>
                                        </div>
