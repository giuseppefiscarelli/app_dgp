<?php
$orderDirClass = $orderDir;
$orderDir = $orderDir === 'ASC' ? 'DESC' : 'ASC';

?>

    <div class="row">
        <div class="col-4 col-md-3">
        <div class="nav nav-tabs nav-tabs-vertical nav-tabs-vertical-background" id="nav-vertical-tab-bg" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="nav-vertical-tab-bg1-tab" data-toggle="tab" href="#nav-vertical-tab-bg1" role="tab" aria-controls="nav-vertical-tab-bg1" aria-selected="true">
                Richieste Inviate<span class="badge badge-primary"><?=$unreadMsg?></span>
            </a>
            <a class="nav-link" id="nav-vertical-tab-bg2-tab" data-toggle="tab" href="#nav-vertical-tab-bg2" role="tab" aria-controls="nav-vertical-tab-bg2" aria-selected="false">
                Richieste In lavorazione <span class="badge badge-primary"><?=$readMsg?></span>
            </a>
            <a class="nav-link" id="nav-vertical-tab-bg3-tab" data-toggle="tab" href="#nav-vertical-tab-bg3" role="tab" aria-controls="nav-vertical-tab-bg3" aria-selected="false">
                Richieste Chiuse <span class="badge badge-primary"><?=$closedMsg?></span>
            </a>
            <button type="button" data-toggle="modal" data-target="#msgModal"class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuova Richiesta</button>
            
        </div> 
        </div>
        <div class="col-8 col-md-9">
        <div class="tab-content" id="nav-vertical-tab-bgContent">
            <div class="tab-pane p-3 fade show active" id="nav-vertical-tab-bg1" role="tabpanel" aria-labelledby="nav-vertical-tab-bg1-tab"><?php require 'admin_tab1.php';?></div>
            <div class="tab-pane p-3 fade" id="nav-vertical-tab-bg2" role="tabpanel" aria-labelledby="nav-vertical-tab-bg2-tab"><?php require 'admin_tab2.php';?></div>
            <div class="tab-pane p-3 fade" id="nav-vertical-tab-bg3" role="tabpanel" aria-labelledby="nav-vertical-tab-bg3-tab"><?php require 'admin_tab3.php';?></div>
        </div>
        </div>
    </div>
                                

<div class="modal fade" tabindex="-1" role="dialog" id="msgModal">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Info Richiesta
        </h5>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12 ">                    
                
                    <form  id="msgform" method="post" action="<?=$updateUrl?>">
                        <input type="hidden" name="action" value="newMsg">
                        <div class="bootstrap-select-wrapper">
                        <label>Tipo Richiesta</label>
                        <select title="Scegli una opzione" id="tipo" name="tipo"required="required">
                           <?php
                               foreach ($tipi as $tipo){?>
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