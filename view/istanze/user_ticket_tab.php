<div class="row">
<button type="button" data-toggle="modal" data-target="#msgModal"class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuova Richiesta</button>

</div>
<div class="it-list-wrapper">
  <ul class="it-list">
    <?php
                                if ($comunicazioni){
                                    foreach ($comunicazioni as $c){
                                        $unreadConv=checkUnreadConv($c['id'],'admin');
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
                                              <?php
                                               }else{
                                                   if($c['read_msg']){?>
                                                    <span class="badge badge-warning">In Lavorazione</span>
                                                   <?php
                                                   }else{?>
                                                    <span class="badge badge-primary">Richiesta Inviata</span>
                                                   <?php
                                                }
                                               }
                                        
                                                        if($unreadConv){?>
                                                        <br>
                                                        Messaggi non letti <span class="badge badge-danger"><?=$unreadConv?></span>

                                                    <?php    }
                                                    ?>

                                            </div>
                                            <div class="col-2">
                                                <?=date("d/m/Y H:i", strtotime($c['data_ins']))?>
                                            </div>
                                            <div class="col-1">
                                            
                                                <button type="button" onclick="document.location='comunicazione.php?id=<?=$c['id']?>'" class="btn btn-success btn-sm" style="padding: 5px 12px;"title="Visualizza Richiesta"><i class="fa fa-info" aria-hidden="true"></i></button>

                                          
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

<div class="modal fade" tabindex="-1" role="dialog" id="msgModal">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuova Richiesta
        </h5>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12 ">                    
                
                    <form  id="msgform" method="post" action="controller/updateComunicazioni.php">
                        <input type="hidden" name="action" value="newMsg">
                        <div class="bootstrap-select-wrapper">
                        <label>Tipo Richiesta</label>
                        <select title="Scegli una opzione" id="tipo" name="tipo"required="required">
                           <?php
                               foreach ($tipiCom as $tipo){?>
                               <<option value="<?=$tipo['cod_msg']?>"><?=$tipo['des_msg']?></option>
                            <?php       
                               }           
                           ?>
                        </select>
                        </div>
                        <div class="form-group" style="margin-top:30px;">
                            <textarea id="testo" name="testo" maxlength="400" placeholder="Scivi qui la tua richiesta (max 400 caratteri)..."rows="4"></textarea>
                            <label for="testo">Testo Richiesta</label>
                        </div>
  
                        
                    </form>
               
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
        <button type="submit" form="msgform" class="btn btn-primary btn-sm"  >Invia richiesta</button>
       
      </div>
    </div>
  </div>
</div>