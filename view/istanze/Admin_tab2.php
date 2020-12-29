<div class="row">
<?php
        

            

            require "alleistanza2.php";
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
                    
                    $countDocVeicolo = intval($countDocVeicolo);
                    $countDocVeicoloInfo = intval($countDocVeicoloInfo);
                // var_dump($countDocVeicolo);
                    //var_dump($countDocVeicoloInfo);
                    if($countDocVeicoloInfo==$countDocVeicolo){

                        $countType = 'success';
                    }else{
                        $countType = 'warning';
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
                    <table class="table-sm table-borderless" style="font-size:15px;">
                    <tr><td>Check Veicolo</td><td><span class="badge badge-primary" style="width: -webkit-fill-available;">Stato a</span></td></tr>
                    <tr><td>Dati Veicolo</td><td><span class="badge badge-<?=$color?>" style="width: -webkit-fill-available;"><?=$text?></span></td></tr>
                    <tr><td>Documenti Veicolo</td><td><span style="width: -webkit-fill-available;"class="badge badge-<?=$countType?>"><?=$countDocVeicoloInfo?> di <?=$countDocVeicolo?></span></td></tr>
                    </table>
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
            <h5 class="modal-title">Scheda Veicolo
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
                    <h5>Dati Istanza</h5>
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td>n° protocollo</td><td style="font-weight:bold;"><?=$i['id_RAM']?>/2020</td>
                              
                            </tr>
                             <tr>
                               
                                <td>Ragione Sociale</td><td style="font-weight:bold;"><?=$i['ragione_sociale']?></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
               
                <div class="col-12 col-lg-6">
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
            
            </div>
            
        
            

            
            
            

        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
            
        </div>
        </div>
    </div>
</div>