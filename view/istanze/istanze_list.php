<?php
$orderDirClass = $orderDir;
$orderDir = $orderDir === 'ASC' ? 'DESC' : 'ASC';

?>


<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form id="searchForm" method="get" action="<?=$pageUrl?>">
          <input type="hidden" name="page" id="page" value="<?=$page?>" >
          <h4 class="form-header text-uppercase"  style="font-size: 12px;margin-bottom: 10px;">
            <i class="fa fa-search"></i>
              Ricerca
          </h4>
          <br>
          <div class="form-group row">
              <div class="form-group col-lg-3">
                <input type="text" class="form-control" id="search1" name="search1" value="<?=$search1?>" >

                <label for="search1">Pec Richedente</label>
              </div>
              <div class="form-group col-lg-2">
                <input type="text" class="form-control" id="search2" name="search2" value="<?=$search2?>" >

                <label for="search2">Protocollo RAM</label>
              </div>
              <div class="form-group col-lg-2 bootstrap-select-wrapper">
                <label for="recordsPerPage" class=" col-form-label">Edizione Istanza</label>
                <div class="col-sm-12">
                  <select  
                  name="search3" 
                  id="search3" 
                  onchange="document.forms.searchForm.submit()">
                        <option value="">Tutti le edizioni</option>
                        <?php foreach ($tipi_istanze as $ti){ ?>
                        
                        <option value="<?=$ti['id']?>" <?=$search3 ==$ti['id']?'selected':''?>><?=$ti['des']?></option>
                        <?php }?>
                    </select>
                </div>
              </div>
              <div class="form-group col-lg-2 bootstrap-select-wrapper">
                <label for="recordsPerPage" class=" col-form-label">Stato Istanza</label>
                <div class="col-sm-12">
                  <select  
                  name="search4" 
                  id="search4" 
                  onchange="document.forms.searchForm.submit()">
                        <option value="">Tutti gli stati</option>
                        <?php foreach ($stati_istanze as $si){ ?>
                        
                        <option value="<?=$si['cod']?>" <?=$search4 ==$si['cod']?'selected':''?>><?=$si['des']?></option>
                        <?php }?>
                    </select>
                </div>
              </div>
              <div class="form-group col-lg-2 bootstrap-select-wrapper">
                <label for="recordsPerPage" class=" col-form-label">Stato Istruttoria</label>
                <div class="col-sm-12">
                  <select  
                  name="search5" 
                  id="search5" 
                  onchange="document.forms.searchForm.submit()">
                        <option value="">Tutti gli stati</option>
                        <?php foreach ($stati_istruttoria as $si){ ?>
                        
                        <option value="<?=$si['cod']?>" <?=$search5 ==$si['cod']?'selected':''?>><?=$si['des']?></option>
                        <?php }?>
                    </select>
                </div>
              </div>
              <div class="form-group col-lg-2 bootstrap-select-wrapper">
                <label for="recordsPerPage" class=" col-form-label">Righe per Pagina</label>
                <div class="col-sm-6">
                  <select  
                  name="recordsPerPage" 
                  id="recordsPerPage" 
                  onchange="document.forms.searchForm.submit().page.value=1">
                        <option value="">Seleziona</option>
                        <?php foreach ($recordsPerPageOptions as $val){ ?>
                        
                        <option value="<?=$val?>" <?=$recordsPerPage ==$val?'selected':''?>><?=$val?></option>
                        <?php }?>
                    </select>
                </div>
              </div>
              <div class="col-lg-6 col-12">
              <div class="form-footer" style="margin-top: 0px;">
              <button type="button" onclick="location.href='<?=$pageUrl?>'" id="resetBtn" class="btn btn-danger"><i class="fa fa-trash"></i> Reset</button>
              
              <button type="submit" onclick="document.forms.searchForm.page.value=1" class="btn btn-success"><i class="fa fa-search"></i> Ricerca</button>
          </div> 
              </div>
          
            
          </div> 
      
        
        </form>
      </div>
    </div>
  </div>
</div>




      
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Lista Istanze</h5>
           
            <small style="float: right;">Totale Istanze <b><?=$totalUsers?></b><br> Pagina <b><?=$page?></b> di <b><?=$numPages?></b></small>
            <br>
                <div class="table-responsive" style="font-size:15px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Edizione</th>
                                <th class="<?=$orderBy === 'id_RAM'?$orderDirClass: '' ?> ">
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=idRAM&orderDir=<?=$orderDir?>">id RAM</a></th>
                                <th class="<?=$orderBy === 'data_invio'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=data_invio&orderDir=<?=$orderDir?>">Data Invio</a></th>
                                <th class="<?=$orderBy === 'ragione_sociale'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=ragione_sociale&orderDir=<?=$orderDir?>">Ragione Sociale</a></th>
                                <th class="<?=$orderBy === 'pec_impr'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=pec_impr&orderDir=<?=$orderDir?>">Pec Impresa</a></th>    
                                <th>Stato Istanza</th>
                                <th>Stato Istruttoria</th>
                                <th style="min-width:170px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($istanze){
                                    foreach ($istanze as $i){
                                     
                                   //var_dump($i);
                                      //$tipo_istanza = getTipoIstanza($i['tipo_istanza']);
                                      $stato_istanza = getStatoIstanza($i['stato']);
                                      //$status=checkRend($i['id_RAM']);
                                      $now=date("Y-m-d H:i:s");
                                      $status_istr= getStatusIstruttoria($i['id_RAM']);
                                      //var_dump($status_istr);
                                      ?>
                            <tr>
                                <td><b><?=$i['des_edizione']?></b></td>      
                                <td><?=$i['id_RAM']?></td>
                                <td><?=date("d/m/Y H:i",strtotime($i['data_invio']))?></td></td>
                                <td><?=$i['ragione_sociale']?></td>
                                <td><?=$i['pec']?></td>
                                <td>
                                    <span class="badge badge-pill badge-<?=$stato_istanza['style']?>"><?=$stato_istanza['des']?></span>
                                      <?=$i['stato_des']?>
                                      
                                </td>
                                <td>
                                <?php
                                        if($status_istr){
                                            if($status_istr['tipo_report'] === '1'){
                                                $text_istr = 'Integrazione';
                                                $type_istr = 'warning';
                                            }
                                            if($status_istr['tipo_report'] === '3'){
                                              $text_istr = 'Ammessa';
                                              $type_istr = 'success';
                                            }
                                            if($status_istr['tipo_report'] === '2'){
                                              $text_istr = 'Preavviso di rigetto';
                                              $type_istr = 'warning';
                                            }
                                            if($status_istr['tipo_report'] === '4'){
                                              $text_istr = 'Rigettata';
                                              $type_istr = 'danger';
                                            }?>
                                             <span class="badge badge-pill badge-<?=$type_istr?>"><?=$text_istr?></span><br>
                                             Pec inviata il <?=date("d/m/Y H:i:s", strtotime($status_istr['data_invio']))?>
                                      <?php   }?>
                                </td>
                               
                                <td>
                                <button type="button" onclick="infoIstanza(<?=$i['id_RAM']?>);"class="btn btn-success btn-xs" title="Visualizza Info" style="width:35px;"><i class="fa fa-info" aria-hidden="true"></i></button>
                                <?php
                                  
                                  if($i['stato']!='A'){?>
                                  <button onclick="window.location.href='istanza.php?id=<?=$i['id_RAM']?>'" type="button" class="btn btn-warning btn-xs" style="width:35px;" title="Visualizza Istanza"><i class="fa fa-list" aria-hidden="true"></i></button>
                                  <?php }
                                  if($i['stato']!='B'){?>
                                    <button type="button" class="btn btn-danger btn-xs" title="Annulla Istanza" onclick="annIst(<?=$i['id_RAM']?>);" style="width:35px;"><i class="fa fa-times" aria-hidden="true"></i></button>
                                  <?php }
                                  if($i['stato']=='B'){?>
                                    <button type="button" class="btn btn-danger btn-xs" title="Info Annullamento Istanza" onclick="annInfo(<?=$i['id_RAM']?>);" style="width:35px;"><i class="fa fa-user-times" aria-hidden="true"></i></button>

                                  <?php }
                                ?>
                                </td>      
                            </tr>
                            <?php
                                    
                                    }
                                }else{
                                    
                                    echo '<tr><td colspan=8>Nessuna Istanza trovata</td></tr>';
                                }?>


                        </tbody>
                        
                        
                    

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
      require_once 'view/template/navigation.php';
      require_once 'infomodal.php';
      require_once 'offmodal.php';
      require_once 'annmodal.php'; ?>
<!-- Modal -->

