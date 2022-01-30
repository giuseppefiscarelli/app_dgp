<?php
$orderDirClass = $orderDir;
$orderDir = $orderDir === 'ASC' ? 'DESC' : 'ASC';
//var_dump($casellaPec);

?>
<style>
  .card:after {
   
     margin-top: -30px !important; 
  }
</style>

<!--div id="header_menu"class="it-header-navbar-wrapper affix-top" style="z-index:1;">
<div class="container "-->
<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form id="searchForm" method="get" action="<?=$pageUrl?>">
              <input type="hidden" name="page" id="page" value="<?=$page?>" >
                <h4 class="form-header text-uppercase"  style="font-size: 12px;margin-bottom: 10px;">
                  <i class="fa fa-search"></i>
                   REGISTRO
                </h4>

              <div class="form-group row" style="width: 100%; ">

<!--                <div class="bootstrap-selelabelct-wrapper" style="display: inline; width: 250px; "> -->
                <div class="bootstrap-select-wrapper" style="display: inline; width: 150px; ">
                    <select
                      name="search2"
                      id="search2"
                      onchange="document.forms.searchForm.submit()">
                          <option value="RI">Internazionale</option>
                          <option value="RO">Ordinario</option>
                          <option value="RS">Speciale</option>
                          <option value="tutti">tutti i registri</option>
                    </select>
                </div>

                <div class="col-sm-4" style="display: inline; width: 400px; ">
                    <input type="text" class="form-control" id="search1" name="search1" value="<?=$search1?>" placeholder="Inserisci il dato da ricercare">
                    <label for="oggetto">dato da ricercare</label>
                </div>

                <div>
                  <div class="row form-check  form-check-inline">
                    <input id="search4" name="search4" type="checkbox" value=1 <?=$search4 == 1 ?'checked':''?>>
                    <label for="search4">attive</label>
                  </div>
                </div>

                <div class="bootstrap-select-wrapper" style="display: inline; width: 180px;">
                  <label>servizio</label>
<!--                  <select title="Scegli servizio" multiple="true" data-multiple-separator="">   -->
                    <select
                      name="search3"
                      id="search3" >
<!--                      multiple="true" data-multiple-separator=" "-->
                          <option value="999">Tutti</option>
                          <?php foreach ($servizi as $servizi_nave){ ?>

                          <option value="<?=$servizi_nave['codice']?>" <?=$servizi_nave['codice'] == $search3?'selected':''?> ><?=$servizi_nave['codice'].' ('.$servizi_nave['qta'].')'?></option>
                          <?php }?>

<!--                    <option value="1" data-content="<span class='select-pill'><span class='select-pill-text'>Opzione 1</span></span>"></option>
                    <option value="2" data-content="<span class='select-pill'><span class='select-pill-text'>Opzione 2</span></span>"></option>
                    <option value="3" data-content="<span class='select-pill'><span class='select-pill-text'>Opzione 3</span></span>"></option>
                    <option value="4" data-content="<span class='select-pill'><span class='select-pill-text'>Opzione 4</span></span>"></option> -->
                  </select>
                </div>
                <!--div class="col-sm-3" style="display: inline; width: 250px; ">
                    <input type="text" class="form-control" id="search2" name="search2" value="<?=$search2?>" placeholder="Inserisci Pec destinatario">
                </div-->
<!--
                <div class="col-sm-2 it-datepicker-wrapper" style="display: inline; width: 180px; ">
                  <div class="form-group">
                    <input class="form-control" id="search3" name="search3" type="date" value="<?=$search3?>" placeholder="gg/mm/aaaa">
                    <label for="data_dal">dal giorno</label>
                  </div>
                </div>

                <div class="col-sm-2 it-datepicker-wrapper" style="display: inline; width: 180px; ">
                  <div class="form-group">
                    <input class="form-control" id="search4" name="search4" type="date" value="<?=$search4?>" placeholder="gg/mm/aaaa">
                    <label for="data_al">al giorno</label>
                  </div>
                </div>
-->
                <div class="col-sm-1 " style="display: inline; width: 50px; ">
                  <div class="bootstrap-select-wrapper">
                        <label for="recordsPerPage" class="col-sm-8 col-form-label">righe per pag.</label>
                          <select
                          name="recordsPerPage"
                          id="recordsPerPage"
                          onchange="document.forms.searchForm.submit()">
                                <option value="">Seleziona</option>
                                <?php foreach ($recordsPerPageOptions as $val){ ?>

                                <option value="<?=$val?>" <?=$recordsPerPage == $val?'selected':''?>><?=$val?></option>
                                <?php }?>
                          </select>
                  </div>
                </div>




              <div class="form-footer" style="margin-top: 0px;">
                  <button type="button" onclick="location.href='<?=$pageUrl?>'" id="resetBtn" class="btn btn-danger"><i class="fa fa-trash"></i> Reset</button>

                  <button type="submit" onclick="document.forms.searchForm.page.value=1" class="btn btn-success"><i class="fa fa-search"></i> Ricerca</button>
              </div>


              </div>



            </form>
          </div>
        </div>
      </div>
</div>
<!--
  </div>
</div>
-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Elenco NAVI</h5>

            <small style="float: right;">Totale Anagrafiche<b><?=$totalList?></b><br> Pagina <b><?=$page?></b> di <b><?=$numPages?></b></small>
            <br>
            <div class="row">
            <button type="button" class="btn btn-success" onclick="newNave()"><i class="fa fa-plus"></i> Inserimento Nuova Nave</button>

            </div>
                <div class="table-responsive" style="font-size:15px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
<!--                                <th style='text-align: center; '>
                                    <a></a></th>-->
                                <th style='text-align: center; '>
                                    <a>registro</a></th>
<!--                                    <a>in/out</a></th>  -->
                                <th style='text-align: center; ' class="<?=$orderBy === 'nav_nome'?$orderDirClass: '' ?> ">
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=id&orderDir=<?=$orderDir?>">nome nave</a></th>
                                <th style='text-align: center; ' class="<?=$orderBy === 'nav_imo'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=username&orderDir=<?=$orderDir?>">imo</a></th>
                                <th style='text-align: center; ' class="<?=$orderBy === 'nav_call_sign'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=username&orderDir=<?=$orderDir?>">call sign</a></th>
                                <th style='text-align: center; ' class="<?=$orderBy === 'nav_servizio'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=cognome&orderDir=<?=$orderDir?>">servizio</a></th>
                                <th style='text-align: center; ' class="<?=$orderBy === 'capitaneria_nome'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=cognome&orderDir=<?=$orderDir?>">ufficio</a></th>
                                <th style='text-align: center; ' class="<?=$orderBy === 'nav_num_iscrizione'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=cognome&orderDir=<?=$orderDir?>">numero</a></th>
                                <th style='text-align: center; ' class="<?=$orderBy === 'nav_data_iscrizione'?$orderDirClass: '' ?> " >
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=cognome&orderDir=<?=$orderDir?>">data iscrizione</a></th>
                                <th style='text-align: center; '>
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=cognome&orderDir=<?=$orderDir?>">GT</a></th>
                                <th style='text-align: center; '>
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=cognome&orderDir=<?=$orderDir?>">NT</a></th>
                                <th style='text-align: center; '>
                                    <a href="<?=$pageUrl?>?<?=$orderByQueryString ?>&orderBy=cognome&orderDir=<?=$orderDir?>">DWT</a></th>

                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                      <?php

                            if($pecs){
                              foreach($pecs as $p){?>
                                <tr style="height: 10px; ">
                                  <!--td width='5px' style="display: none"><?=$p['id']?></td-->
                                  <td width='80px'><?php
                                    if($p['nav_registro'] == 'RI'){
                                      echo 'Internazionale';
                                    } else {
                                      if($p['nav_registro'] == 'RO'){
                                        echo 'Ordinario';
                                      } else echo 'Speciale';
                                    }?>
                                  </td>


                                  <td width='180px'><?=$p['nav_nome']?></td>
                                  <td width='120px'><?=$p['nav_imo']?></td>
                                  <td style='text-align: center;' width='80px'><?=$p['nav_call_sign']?></td>
                                  <td style='text-align: center;' width='80px'><?=$p['nav_servizio']?></td>

                                  <td style='text-align: center;' width='80px'><?=$p['nome']?></td>
                                  <td style='text-align: center;' width='80px'><?=$p['nav_num_iscrizione']?></td>
                                  <td style='text-align: center;' width='80px'><?=$p['data_iscrizione']?></td>

                                  <td style='text-align: right;' width='80px'><?=$p['gt']?></td>
                                  <td style='text-align: right;' width='80px'><?=$p['nt']?></td>
                                  <td style='text-align: right;' width='80px'><?=$p['dwt']?></td>
                                  <td width='80px'>
                                    <!--a type="button" onclick="getDatiNave(<?= $p['id'] ?>);" class="btn btn-primary btn-xs" style="color:white;"> <i class="fa fa-tag" aria-hidden="true"></i><img onmouseover="bigImg(this)" alt="Smiley"></a-->
                                    <a style="color:gray" type="button" id="selettore_nave" name="selettore_nave" class="fa fa-tag" onclick="getDatiNave(<?= $p['id'] ?>);" onmouseover="style.color='blue';" onmouseout="style.color='gray';"></a>

<!-- <img src="map.gif" alt="Hover to reveal the location on the map"
      onmouseover="this.src='map_location_revealed.gif';"
      onmouseout="this.src='map.gif';"/>Figures for February’s racing.   -->

                                  </td>
                                </tr>




                      <?php }

                            }else{ ?>
                            <tr> <td colspan="12">Non ci sono anagrafiche rispondenti ai parametri di ricerca impostati</td></tr>
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
                           require_once 'view/template/navigation.php';
                                ?>
<!-- Modal -->



<div class="modal fade show" tabindex="-1" role="dialog" id="certModal" data-backdrop="static" data-keyboard="false"  >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width:80%">
      <div class="modal-content">
         <div class="modal-header">
        <h5 class="modal-title" id="naviModalTitle">titolo</h5>
      </div>
      <div class="modal-body">
        <form id="navform" >
          <input type="hidden" name="id" id="idnave"value="">

        <div class="row">
          <div class="col-12">
            <!--start card-->
            <div class="card-wrapper card-space">
              <div class="card card-bg">
                <div class="card-body">
                  <h5 class="card-title" >Identificativi Nave</h5>
                  
                    <div class=" row" style="margin-top:35px;">
                      <div class="form-group col-12">
                          <label for="nav_nome"  >Nome</label>
                          <input type="text" class="form-control" id="nav_nome" name="nav_nome"placeholder="Inserire nome" readonly=""> 
                      </div>  
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-12">
                        <div class="bootstrap-select-wrapper">
                          <label class=" col-form-label">Registro</label>
                            <div class="dropdown bootstrap-select ">
                              <select name="nav_registro" id="nav_registro" disabled >
                              <option value="RI">Internazionale</option>
                              <option value="RO">Ordinario</option>
                              <option value="RS">Speciale</option>
                              </select>
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-12">
                        <div class="bootstrap-select-wrapper">
                          <label class=" col-form-label">Sezione</label>
                            <div class="dropdown bootstrap-select ">
                              <select name="nav_sezione" id="nav_sezione" disabled >
                                <option value="1">I</option>
                                <option value="2">II</option>
                                <option value="3">III</option>
                              </select>
                            </div>
                        </div>
                      </div>
                      <div class="form-group col-lg-3 col-12">
                        <input type="text" class="form-control" id="nav_call_sign" name="nav_call_sign" placeholder="Inserire Call Sign" readonly=""> 
                        <label >Call Sign</label>
                      </div>
                      <div class="form-group col-lg-3 col-12">  
                        <input type="text" class="form-control" id="nav_imo" name="nav_imo"placeholder="Inserire IMO" readonly=""> 
                        <label >IMO</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-2 col-12">
                        <label >Anno Costruzione</label>
                        <input type="number" class="form-control" id="nav_anno_costruzione" name="nav_anno_costruzione" value="0" min="0" max="2999" readonly="">
                      </div>
                      <div class="form-group col-lg-6 col-12">
                        <label >Cantiere</label>
                        <input type="text" class="form-control" id="nav_cantiere" name="nav_cantiere" value="" maxlength="100" placeholder="Inserire Cantiere" readonly="">
                      </div>
                      <div class="col-lg-2 col-12">
                        <div class="bootstrap-select-wrapper">
                          <label class=" col-form-label">Nazione</label>
                            <div class="dropdown bootstrap-select">
                              <select name="nav_cantiere_nazione" id="nav_cantiere_nazione" disabled
                                >
                                <option></option>
                                <?php foreach($nazioni as $n){?>
                                      <option value="<?=$n['isoAlpha2']?>"><?=$n['isoAlpha2']?> - <?=$n['name']?></option>
                              <?php }?>
                              </select>
                                                          
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-12">
                        <div class="bootstrap-select-wrapper">
                          <label class=" col-form-label">Servizio</label>
                            <div class="dropdown bootstrap-select">
                              <select name="nav_servizio" id="nav_servizio" disabled
                                >
                                <option></option>
                                <?php foreach($dropServizi as $s){?>
                                      <option value="<?=$s['codice']?>"><?=$s['descrizione']?></option>
                              <?php }?>
                              </select>                            
                            </div>
                        </div>
                      </div>
                    </div>
                    
                               
                </div>
              </div>
            </div>
            <!--end card-->
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-4">
            <!--start card-->
            <div class="card-wrapper card-space">
              <div class="card card-bg">
                <div class="card-body">
                  <h5 class="card-title">Dati Tecnici</h5>
                    <div class="row" style="margin-top:35px;">

                      <div class="form-group col-lg-6 col-12">
                        <label >GT / TST</label>
                        <input type="number" class="form-control" id="nav_gt" name="nav_gt" value="0" min="0" max="300000" readonly="">
                      </div>
                      <div class="form-group col-lg-2 col-12">

                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <label >Lunghezza</label>
                        <input type="number" class="form-control" id="nav_lung" name="nav_lung" value="0" min="0" max="300000" readonly="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-6 col-12">
                        <label >NT / TSN</label>
                        <input type="number" class="form-control" id="nav_nt" name="nav_nt" value="0" min="0" max="300000" readonly="">
                      </div>
                      <div class="form-group col-lg-2 col-12">
                        
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <label >Larghezza</label>
                        <input type="number" class="form-control" id="nav_larg" name="nav_larg" value="0" min="0" max="300000" readonly="">
                      </div>
                      </div>
                    <div class="row">
                      <div class="form-group col-lg-6 col-12">
                        <label >DWT</label>
                        <input type="number" class="form-control" id="nav_dwt" name="nav_dwt" value="0" min="0" max="300000" readonly="">
                      </div>
                      <div class="form-group col-lg-2 col-12">
                        
                      </div>
                      <div class="form-group col-lg-4 col-12">
                        <label >Potenza Motori</label>
                        <input type="number" class="form-control" id="nav_power" name="nav_power" value="0" min="0" max="300000" readonly="">
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <!--end card-->
          </div>
          <div class="col-12 col-lg-4">
            <div class="card-wrapper card-space">
              <div class="card card-bg">
                <div class="card-body">
                  <h5 class="card-title">Dati Iscrizione</h5>
                    <div class="row" style="margin-top:35px;">

                      <div class=" col-12">
                        <div class="bootstrap-select-wrapper">
                          <label class=" col-form-label">Ufficio Iscrizione</label>
                            <div class="dropdown bootstrap-select">
                              <select name="nome" id="nome" disabled
                                >
                                <option></option>
                                <?php foreach($capitanerie as $c){?>
                                      <option value="<?=$c['cod']?>"><?=$c['nome']?></option>
                              <?php }?>
                              </select>
                                                          
                            </div>
                        </div>
                      </div>
                      <div class="form-group  col-12" style="margin-top:55px;">
                        <label >Numero Iscrizione</label>
                        <input type="text" class="form-control" id="nav_num_iscrizione" name="nav_num_iscrizione" value="" maxlength="100" placeholder="Numero Iscrizione" readonly="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="it-datepicker-wrapper col-12">
                        <div class="form-group">
                          <input class="form-control it-date-datepicker" id="nav_data_iscrizione" name="nav_data_iscrizione"type="text" placeholder="inserisci la data in formato gg/mm/aaaa" readonly>
                          <label for="nav_data_iscrizione">Data Iscrizione</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="it-datepicker-wrapper col-12">
                        <div class="form-group">
                          <input class="form-control it-date-datepicker" id="nav_data_cancellazione"  name="nav_data_cancellazione"type="text" placeholder="inserisci la data in formato gg/mm/aaaa" readonly>
                          <label for="nav_data_cancellazione">Data Cancellazione</label>
                        </div>
                      </div>
                    </div>


                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <!--start card-->
            <div class="card-wrapper card-space">
              <div class="card card-bg">
                <div class="card-body">
                  <h5 class="card-title">Provenienza</h5>
                    <div class="row" style="margin-top:35px;">
                      <div class="form-group  col-12">
                        <label >Ufficio Precedente</label>
                        <input type="text" class="form-control" id="nav_uffico_prec" name="nav_uffico_prec" value="" maxlength="100" placeholder="Inserire Ufficio Precedente" readonly="">
                      </div>
                      
                      <div class="form-group  col-12">
                        <label >Provenienza</label>
                        <input type="text" class="form-control" id="nav_provenienza" name="nav_provenienza" value="" maxlength="100" placeholder="Inserire provenienza" readonly="">
                      </div>
                      <div class="form-group  col-12">
                        <label >Nome Precedente</label>
                        <input type="text" class="form-control" id="nav_nome_prec" name="nav_nome_prec" value="" maxlength="100" placeholder="Inserire Nome Precedente" readonly="">

                      </div>
                      <div class=" col-6">
                        <div class="bootstrap-select-wrapper">
                          <label class=" col-form-label">Bandiera prec</label>
                            <div class="dropdown bootstrap-select">
                              <select name="nav_bandiera_prec" id="nav_bandiera_prec" disabled
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
                </div>
              </div>
            </div>
            <!--end card-->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card-wrapper card-space">
              <div class="card card-bg">
                <div class="card-body">
                  <h5 class="card-title">Atto Nazionalità / passavanti provvisorios</h5>
                  <div class="row" style="margin-top:35px;">
                    <div class="col-lg-5 col-12">
                      <div class="form-check form-check-inline">
                        <input name="nav_tipo_atto" type="radio" value="N" id="radio1" disabled>
                        <label for="radio1">Atto nazionalità</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="nav_tipo_atto" type="radio" value="P" id="radio2" disabled>
                        <label for="radio2">Passo avanti</label>
                      </div>
                    </div>  
                    <div class="form-group col-lg-3 col-12">
                      <label >Atto Nazionalità</label>
                      <input type="text" class="form-control" id="nav_atto_naz" name="nav_atto_naz" value=" " placeorder="Atto di nazionalità" readonly="">
                    </div>
                    <div class="it-datepicker-wrapper col-lg-3 col-12" id="passavantiDiv" style="display:none">
                      <div class="form-group">
                        <input class="form-control it-date-datepicker" id="nav_data_scad_passavanti"  name="nav_data_scad_passavanti"type="text" placeholder="inserisci la data in formato gg/mm/aaaa" readonly>
                        <label for="nav_data_scad_passavanti">Data Scadenza passavanti</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-4 col-12">
                      <label >Luogo di Rilascio</label>
                      <input type="text" class="form-control" id="nav_luogo_rilascio" name="nav_luogo_rilascio" value=" " placeorder="Luogo rilascio" readonly="">
                    </div>
                    <div class="it-datepicker-wrapper col-lg-3 col-12" >
                      <div class="form-group">
                        <input class="form-control it-date-datepicker" id="nav_data_rilascio"  name="nav_data_rilascio"type="text" placeholder="inserisci la data in formato gg/mm/aaaa" readonly="readonly">
                        <label for="nav_data_rilascio">Data Rilascio</label>
                      </div>
                    </div>
                    <div class="form-group col-lg-5 col-12">
                      <label >Motivo Rilascio</label>
                      <input type="text" class="form-control" id="nav_motivo_rilascio" name="nav_motivo_rilascio" value=" " placeorder="Motivo rilascio" readonly="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-6">
            <!--start card-->
            <div class="card-wrapper card-space">
              <div class="card card-bg">
                <div class="card-body">
                  <h5 class="card-title">Armatore</h5>
                    <div class="row" style="margin-top:35px;">
                        <div class="form-group col-lg-8 col-12">
                          <div class="bootstrap-select-wrapper">
                            <label class=" col-form-label">Ragione Sociale</label>
                              <div class="dropdown bootstrap-select">
                                <select name="nav_id_armatore" id="nav_id_armatore" disabled
                                  >
                                  <option></option>
                                  <?php foreach($armatori as $a){?>
                                        <option value="<?=$a['id']?>"><?=$a['arm_rag_soc']?></option>
                                <?php }?>
                                </select>
                                                            
                              </div>
                          </div>
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
                </div>
              </div>
            </div>
            <!--end card-->
          </div>
          <div class="col-12 col-lg-6">
            <!--start card-->
            <div class="card-wrapper card-space">
              <div class="card card-bg">
                <div class="card-body">
                  <h5 class="card-title">Proprietario</h5>
                  <div class="row" style="margin-top:35px;">
                        <div class="form-group col-lg-8 col-12">
                          <div class="bootstrap-select-wrapper">
                            <label class=" col-form-label">Ragione Sociale</label>
                              <div class="dropdown bootstrap-select">
                                <select name="nav_id_proprietario" id="nav_id_proprietario" disabled
                                  >
                                  <option></option>
                                  <?php foreach($proprietari as $p){?>
                                        <option value="<?=$p['id']?>"><?=$p['prp_rag_soc']?></option>
                                <?php }?>
                                </select>
                                                            
                              </div>
                          </div>
                        </div>
                       
                        <div class="form-group col-lg-4 col-12">
                          <label >Codice Fiscale</label>
                          <input type="text" class="form-control" id="prp_cf" name="prp_cf" value=" "placeorder="Codice Fiscale" readonly="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-9 col-12">
                          <label >Indirizzo</label>
                          <input type="text" class="form-control" id="prp_indirizzo" name="prp_indirizzo" value=" " placeorder="Indirizzo" readonly="">
                        </div>
                        <div class="form-group col-lg-3 col-12">
                          <label >Cap</label>
                          <input type="text" class="form-control" id="prp_cap" name="prp_cap" value=" " placeorder="Cap" readonly="">
                        </div>

                    </div>
                    <div class="row">
                       
                        
                        <div class="form-group col-lg-4 col-12">
                          <label >Città</label>
                          <input type="text" class="form-control" id="prp_citta" name="prp_citta" value=" " placeorder="Città" readonly="">
                        </div>
                        <div class="col"></div>
                        <div class="form-group col-lg-2 col-12">
                          <label >PR</label>
                          <input type="text" class="form-control" id="prp_prov" name="prp_prov" value=" " placeorder="Provincia" readonly="">
                        </div>
                        <div class="col"></div>
                        <div class="form-group col-lg-4 col-12">
                          <div class="bootstrap-select-wrapper">
                            <label class=" col-form-label">Nazione</label>
                              <div class="dropdown bootstrap-select">
                                <select name="prp_cod_naz" id="prp_cod_naz" disabled
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
                          <input type="text" class="form-control" id="prp_telefono" name="prp_telefono" value=" " placeorder="Numero Telefonico" readonly="">

                        </div>
                        <div class="form-group col-lg-8 col-12">
                        <label >Indirizzo email pec</label>
                          <input type="text" class="form-control" id="prp_email" name="prp_email" value=" " placeorder="Indirizzo email pec" readonly="">

                        </div>

                    </div>
                </div>
              </div>
            </div>
            <!--end card-->
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <!--start card-->
            <div class="card-wrapper card-space">
              <div class="card card-bg">
                <div class="card-body">
                  <h5 class="card-title">Note</h5>
                    <div class="row" style="margin-top:35px;">
                      <div class="form-group col-12">
                        <textarea id="note" name="note" maxlength="2000" placeorder="eventuali note o appunti" rows="3" readonly></textarea>      
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <!--end card-->
          </div>
          
        </div>


        <!--table class="table table-responsive" id="certTab">
          <p>
          </p>
          <textarea id="datinavex" name="datinavex"  value="nave" disabled="true">
          </textarea>
        </table-->
        </form>  
      </div>
      <div class="modal-footer">
        <button class="btn btn-success btn-sm" id="upModal"type="button">Abilita Modifica Dati</button>
        <button class="btn btn-success btn-sm" id="saveModal" type="submit" form="navform" style="display:none;">Salva Dati</button>
        <button class="btn btn-primary btn-sm" id="closeModal"data-dismiss="modal" type="button">Chiudi</button>
      </div>
    </div>
  </div>
</div>
