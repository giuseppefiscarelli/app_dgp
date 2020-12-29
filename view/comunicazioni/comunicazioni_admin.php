<?php
$orderDirClass = $orderDir;
$orderDir = $orderDir === 'ASC' ? 'DESC' : 'ASC';

?>

    <div class="row">
        <div class="col-4 col-md-3">
        <div class="nav nav-tabs nav-tabs-vertical nav-tabs-vertical-background" id="nav-vertical-tab-bg" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="nav-vertical-tab-bg1-tab" data-toggle="tab" href="#nav-vertical-tab-bg1" role="tab" aria-controls="nav-vertical-tab-bg1" aria-selected="true">
                <table style="width:100%">
                <tr><td style="width:90%">Nuove Richieste</td><td><span class="badge badge-primary"><?=$unreadMsg?></span></td></tr>
                </table> 
            </a>
            <a class="nav-link" id="nav-vertical-tab-bg2-tab" data-toggle="tab" href="#nav-vertical-tab-bg2" role="tab" aria-controls="nav-vertical-tab-bg2" aria-selected="false">
                 
                <table style="width:100%">
                <tr><td style="width:90%">Richieste In lavorazione</td><td><span class="badge badge-primary"><?=$readMsg?></span></td></tr>
                <?php
                    if($checkConv){?>
                <tr><td><small>Messaggi non Letti</small> <span class="badge badge-danger"><?=$checkConv?></span></td></tr>
                <?php
                }
                ?>
                </table> 
            </a>
            <a class="nav-link" id="nav-vertical-tab-bg3-tab" data-toggle="tab" href="#nav-vertical-tab-bg3" role="tab" aria-controls="nav-vertical-tab-bg3" aria-selected="false">
            <table style="width:100%">
                <tr><td style="width:90%"> Richieste Chiuse</td><td> <span class="badge badge-primary"><?=$closedMsg?></span></td></tr>
            </table> 
            </a>
           
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
                        <tr><td>Data Richiesta</td><td id="data_ins_info"></td><td></td><td></td></tr>
                        <tr><td>Tipo Richiesta</td><td id="tipo_info"></td><td></td><td></td></tr>
                       
                        <tr><td>Stato Richiesta</td><td id="stato_info"></td><td id="user_info"></td><td id="data_info"></td></tr>
                        

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