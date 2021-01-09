
 <h3>Dettaglio Ticket n° <?=$c['id']?></h3>
        <div class="row">
           
            <div class="col-12 col-lg-6">                    
                <table class="table table-sm">
                    
                    <tbody>
                        <tr><td>n° ticket</td><td ><?=$c['id']?></td><td></td><td></td></tr>
                        <tr><td>Utente</td><td ><?=$c['user_ins']?></td><td></td><td></td></tr>
                        <tr><td>Protocollo RAM</td><td ><?=$c['id_RAM']?>/2020</td><td></td><td></td></tr>
                        <tr><td>Data richiesta</td><td ><?=date("d/m/Y H:i", strtotime($c['data_ins']))?></td><td></td><td></td></tr>
                        <tr><td>Tipo Richiesta</td><td ><?=$tipo['des_msg']?></td><td></td><td></td></tr>
                       
                        <tr><td>Stato Richiesta</td><td ><?=$stato?></td><td></td><td></td></tr>
                        <tr><td>Testo Richiesta</td><td  colspan="3"><?=$c['testo']?></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

<h4>Dettaglio Comunicazione</h4>
<?php
 if(!isUserUser()){?>
    <a href="istanza.php?id=<?=$c['id_RAM']?>"type="button" class="btn btn-primary">Vai a Gestione Istanza</a>
<?php
 }else{?>
<a href="istanza.php?id=<?=$c['id_RAM']?>"type="button" class="btn btn-primary">Torna a Istanza</a>
 <?php
 }
 ?>
<br><br>
<div class="it-list-wrapper" style="margin-left: 10%;margin-right: 10%;">
  <ul class="it-list">
    <li>
      
       
        <div class="row">
            <div class="col-1">
                <div class="avatar size-xl"><img src="https://via.placeholder.com/120x120.png?text=<?=$c['id_RAM']?>" alt="image alt" title="image title"></div>
                <br><small><?=date("d/m/Y H:i", strtotime($c['data_ins']))?></small>
            </div>
            <div class="col-10 ">
                <!--start card-->
                <div class="card-wrapper">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title"><?=$tipo['des_msg']?></h5>
                        <p class="card-text"><?=$c['testo']?></p>
                        </div>
                    </div>
                    </div>
                <!--end card-->
            </div>
            <div class="col-1"></div>
        </div>
       
    </li>
   

    <?php
        if($conv){

            foreach ($conv as $co) {
               if($co['role']!=='user'){?>
                <hr>
                <li>  
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10 ">
                            <!--start card-->
                            <div class="card-wrapper">
                                <div class="card" style="text-align:right;">
                                    <div class="card-body">
                                    <div class="card-title"><?=$co['risolto']=='1'?'<span class="badge badge-primary">Chiuso</span>':''?></div>
                                    <p class="card-text"><?=$co['testo']?></p>
                                    </div>
                                </div>
                                </div>
                            <!--end card-->
                        </div>
                        <div class="col-1">
                            <div class="avatar size-xl" style="float:right;"><img src="images/avatar.png"  alt="image alt" title="image title"></div>
                            <br><small><?=date("d/m/Y H:i", strtotime($co['data_ins']))?></small>
                        </div>
                    </div>
                    
                </li>


               <?php
               }else{?>
                <hr>
               <li>  
                    <div class="row">
                        <div class="col-1">
                        <div class="avatar size-xl"><img src="https://via.placeholder.com/120x120.png?text=<?=$c['id_RAM']?>" alt="image alt" title="image title"></div>
                            <br><small><?=date("d/m/Y H:i", strtotime($co['data_ins']))?></small>
                        </div>
                        
                        <div class="col-10 ">
                            <!--start card-->
                            <div class="card-wrapper">
                                <div class="card" >
                                    <div class="card-body">
                                        <p class="card-text"><?=$co['testo']?></p>
                                    </div>
                                </div>
                                </div>
                            <!--end card-->
                        </div>
                        <div class="col-1">
                        </div>
                    </div>
                    
                </li>

               <?php
                }
            }
        }
    ?>



    
    
  </ul>
</div>
<hr>
<div class="row" style="justify-content: center;">
<?php
    if(isUserUser()&&$c['read_msg']!=='0'){
        if(!$c['risolto']){?>        
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#answerModal" title="Rispondi"><i class="fa fa-plus-circle" aria-hidden="true"></i> Rispondi</button>
<?php
        }
    }
if(!isUserUser()){?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#answerModal" title="Rispondi"><i class="fa fa-plus-circle" aria-hidden="true"></i> Rispondi</button>
<!--
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#supportoModal" style="margin-left:10px;"title="Richiedi supporto Tecnico"><i class="fa fa-wrench" aria-hidden="true"></i> Supporto Tecnico</button>
-->
<?php
}
?>
</div>
<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="answerModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Risposta
        </h5>
      </div>
      <div class="modal-body">
      <form id="msgform" action="<?=$updateUrl?>" method="post">
            <input type="hidden" name="action"value="newConv">
            <input type="hidden" name="id_comunicazioni"value="<?=$c['id']?>">
                
               
                    <div class="form-group" style="top:30px;">
                        <textarea id="testo" name="testo" maxlength="400" rows="6" placeholder="Scrivi qui...(max 400 caratteri)"></textarea>
                        <label >Testo Risposta</label>
                    </div>
                    <?php
                    if(!isUserUser()){?>
                    <div class="bootstrap-select-wrapper">
                    <label>Stato ticket</label>
                        <select id="risolto" name="risolto"title="Scegli un'opzione">
                        
                                    <option value="0">Aperto</option>
                                    <option value="1">Chiuso</option>
                        
                                                          
                        </select>
                    </div>
                    <?php
                    }
                    ?>
    
                
            </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Chiudi</button>
        <button class="btn btn-primary btn-sm"  form="msgform" type="submit">Invia Risposta</button>
      </div>
    </div>
  </div>
</div>
