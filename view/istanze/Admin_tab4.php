
<div class="it-list-wrapper">
  <ul class="it-list">
    <?php
                                if ($comunicazioni){
                                    foreach ($comunicazioni as $c){
                                       
                                        $tipod = getTipoComunicazione($c['tipo']);?>
                                    <li>
                                        
                                        <a class="it-has-checkbox" href="#">
                                        
                                        <div class="it-right-zone">
                                            <div class="col-2">
                                                <span class="text"><?=$c['id_RAM']?>/2020<em><?=$c['user_ins']?></em></span>
                                            </div>
                                            <div class="col-5">
                                                <span class="text"><?=$tipod['des_msg']?><em><?=$c['testo']?></em></span>
                                            </div>
                                            <div class="col-2">
                                              <?php
                                               if($c['risolto']){?>
                                                <span class="badge badge-success">Chiuso</span>
                                                <br> <span class="text"><em><?=$c['user_risolto']?><br><?=date("d/m/Y H:i",strtotime($c['data_risolto']))?></em></span>
                                              <?php
                                               }else{
                                                   if($c['read_msg']){?>
                                                    <span class="badge badge-warning">In Lavorazione</span>
                                                    <br> <span class="text"><em><?=$c['user_read']?><br><?=date("d/m/Y H:i",strtotime($c['data_read']))?></em></span>
                                                   <?php
                                                   }else{?>
                                                    <span class="badge badge-primary">Richiesta Inviata</span>
                                                   <?php
                                                }
                                               }
                                               ?>

                                            </div>
                                            <div class="col-2">
                                                <?=date("d/m/Y H:i", strtotime($c['data_ins']))?>
                                            </div>
                                            <div class="col-1">
                                            <?php
                                            if(isUserUser()){?>
                                                <button type="button" onclick="document.location='comunicazione.php?id=<?=$c['id']?>'" class="btn btn-success btn-sm" style="padding: 5px 12px;"title="Visualizza Richiesta"><i class="fa fa-info" aria-hidden="true"></i></button>

                                            <?php

                                            }else{?>
                                            <button  type="button" onclick="infomsgAd(<?=$c['id']?>);"class="btn btn-success btn-sm" style="padding: 5px 12px;"title="Visualizza Richiesta"><i class="fa fa-info" aria-hidden="true"></i></button>
                                            <?php
                                            }
                                            ?>
                                            </div>
                                            
                                        </div>
                                        </a>
                                    </li>




                                  <?php
                                     
                                
                                    }
                                }
                                ?>
  </ul>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="msginfoModal">
  <div class="modal-dialog modal-lg" role="document" style="min-width:70%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Info Richiesta
        </h5>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12 ">                    
                <table class="table table-sm">
                    
                    <tbody>
                        <tr><td>n° ticket</td><td id="id_info"></td><td></td><td></td></tr>
                        <tr><td>Data richiesta</td><td id="data_ins_info"></td><td></td><td></td></tr>
                        <tr><td>Tipo Richiesta</td><td id="tipo_info"></td><td></td><td></td></tr>
                       
                        <tr><td>Stato Richiesta</td><td id="stato_info"></td><td></td><td></td></tr>
                        <tr><td>Testo Richiesta</td><td id="testo_info" colspan="3"></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
        <a type="button" class="btn btn-primary btn-sm" id="gotomsg" type="button">Prendi in Carico</a>
       
      </div>
    </div>
  </div>
</div>