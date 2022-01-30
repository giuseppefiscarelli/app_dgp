<?php
$orderDirClass = $orderDir;
$orderDir = $orderDir === 'ASC' ? 'DESC' : 'ASC';

?>


<div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <form id="searchForm" method="get" action="<?=$pageUrl?>">
              <input type="hidden" name="page" id="page" value="<?=$page?>" >
                <h4 class="form-header text-uppercase"  style="font-size: 12px;margin-bottom: 10px;">
                  <i class="fa fa-search"></i>
                   Ricerca
                </h4>
                <div class="form-group row">
                  <label for="search1" class="col-sm-6 col-form-label">Globale</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="search1" name="search1" value="<?=$search1?>" placeholder="Cerca per Ragione sociale">
                  </div>
                </div>    


                <div class="form-group row">
                  <label for="recordsPerPage" class="col-sm-8 col-form-label">Record per Pagina</label>
                  <div class="col-sm-4">
                  <select class="form-control"  
                  name="recordsPerPage" 
                  id="recordsPerPage" 
                  onchange="document.forms.searchForm.submit()">
                        <option value="">Seleziona</option>
                        <?php foreach ($recordsPerPageOptions as $val){ ?>
                        
                        <option value="<?=$val?>" <?=$recordsPerPage ==$val?'selected':''?>><?=$val?></option>
                        <?php }?>
                    </select>
                  </div>
                </div>
                
                <div class="form-footer" style="margin-top: 0px;">
                    <button type="button" onclick="location.href='<?=$pageUrl?>'" id="resetBtn" class="btn btn-danger"><i class="fa fa-trash"></i> Reset</button>
                    
                    <button type="submit" onclick="document.forms.searchForm.page.value=1" class="btn btn-success"><i class="fa fa-search"></i> Ricerca</button>
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
                <h5 class="card-title">Lista Armatori</h5>
                <small style="float: right;">Totale Armatori <b><?=$totalUsers?></b><br> Pagina <b><?=$page?></b> di <b><?=$numPages?></b></small>
                <div class="row">
                    <button type="button" class="btn btn-success" onclick="newArmatore()"><i class="fa fa-plus"></i> Inserimento Nuovo Armatore</button>
                </div>
                <div class="table-responsive" style="font-size:15px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Ragione Sociale</th>
                                <th>Codice Fiscale</th>
                                <th style="min-width:350px">Indirizzo</th>
                                <th >Contatti</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                if($armatori){
                                    foreach ($armatori as $a){
                                    ?>
                                    <tr>
                                        <td><?=$a['arm_rag_soc']?></td>
                                        <td><?=$a['arm_cf']?></td>
                                        <td><?=$a['arm_indirizzo']?> <?=$a['arm_cap']?>  - <?=$a['arm_citta']?> (<?=$a['arm_prov']?>) - <?=$a['arm_cod_naz']?></td>
                                        <td><?=$a['arm_email']?><br><?=$a['arm_telefono']?></td>
                                        <td><a style="color:gray" type="button" class="fa fa-tag" onclick="getDatiArmatore(<?=$a['id']?>);" onmouseover="style.color='blue';" onmouseout="style.color='gray';"></a></td>
                                    </tr>
                               <?php 
                            }
                            }else{?>
                                   <tr> <td colspan="5">Non ci sono anagrafiche rispondenti ai parametri di ricerca impostati</td></tr>

                                <?php }?>



                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
                
<?php
                           require_once 'view/template/navigation.php';
                                ?>
<div class="modal fade show" tabindex="-1" role="dialog" id="modalArmatore" data-backdrop="static" data-keyboard="false"  >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width:80%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Armatore</h5>
            </div>
            <div class="modal-body">
                <form id="upForm">
                    <input type="hidden" name="id" id="id_armatore" value="">
                    <div class="row" style="margin-top:35px;">
                        <div class="form-group col-lg-8 col-12">
                            <label >Ragione Sociale</label>
                            <input type="text" class="form-control" id="arm_rag_soc" name="arm_rag_soc" value=" " placeorder="Ragione Sociale" readonly="">
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label >Codice Fiscale</label>
                            <input type="text" class="form-control" id="arm_cf" name="arm_cf" value=" " placeorder="Codice Fiscale" readonly="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-9 col-12">
                        <label >Indirizzo</label>
                        <input type="text" class="form-control" id="arm_indirizzo" value=" " name="arm_indirizzo"  placeorder="Indirizzo" readonly="">
                        </div>
                        <div class="form-group col-lg-3 col-12">
                        <label >Cap</label>
                        <input type="text" class="form-control" id="arm_cap" name="arm_cap" value=" " placeorder="Cap" readonly="">
                        </div>

                    </div>
                    <div class="row">
                    
                        
                        <div class="form-group col-lg-4 col-12">
                        <label >Città</label>
                        <input type="text" class="form-control" id="arm_citta" name="arm_citta"value=" "  placeorder="Città" readonly="">
                        </div>
                        <div class="col"></div>
                        <div class="form-group col-lg-2 col-12">
                        <label >PR</label>
                        <input type="text" class="form-control" id="arm_prov" name="arm_prov" value=" " placeorder="Provincia" readonly="">
                        </div>
                        <div class="col"></div>
                        <div class="form-group col-lg-4 col-12">
                        <div class="bootstrap-select-wrapper">
                            <label class=" col-form-label">Nazione</label>
                            <div class="dropdown bootstrap-select">
                                <select name="arm_cod_naz" id="arm_cod_naz" disabled
                                >
                                <option></option>
                                <?php foreach($nazioni as $n){?>
                                        <option value="<?=$n['isoAlpha2']?>"><?=$n['isoAlpha2']?> - <?=$n['name']?></option>
                                <?php }?>
                                </select>
                                                            
                            </div>
                        </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-12">
                        <label >Numero Telefonico</label>
                        <input type="text" class="form-control" id="arm_telefono" name="arm_telefono"value=" "  placeorder="Numero Telefonico" readonly="">

                        </div>
                        <div class="form-group col-lg-8 col-12">
                        <label >Indirizzo email pec</label>
                        <input type="text" class="form-control" id="arm_email" name="arm_email"value=" " placeorder="Indirizzo email pec" readonly="">

                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-sm" id="upModal"type="button">Abilita Modifica Dati</button>
                <button class="btn btn-success btn-sm" id="saveModal" type="submit" form="upForm" style="display:none;">Salva Dati</button>
                <button class="btn btn-primary btn-sm" id="closeModal"data-dismiss="modal" type="button">Chiudi</button>
            </div>
        </div>
    </div>
</div>