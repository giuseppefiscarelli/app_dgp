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
                <label for="recordsPerPage" class=" col-form-label">Righe per Pagina</label>
                <div class="col-sm-6">
                  <select  
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($istanze){
                                    foreach ($istanze as $i){
                                     
                                    
                                      $tipo_istanza = getTipoIstanza($i['tipo_istanza']);
                                      $stato_istanza = getStatoIstanza($i['stato']);
                                      $status=checkRend($i['id_RAM']);
                                      $now=date("Y-m-d H:i:s");?>
                            <tr>
                                <td><b><?=$tipo_istanza['des']?></b></td>      
                                <td><?=$i['id_RAM']?></td>
                                <td><?=date("d/m/Y H:i",strtotime($i['data_invio']))?></td></td>
                                <td><?=$i['ragione_sociale']?></td>
                                <td><?=$i['pec']?></td>
                                <td>
                                    <span class="badge badge-pill badge-<?=$stato_istanza['style']?>"><?=$stato_istanza['des']?></span>
                                      <?=$i['stato_des']?>
                                      <?php

                                      ?>
                                </td>
                               
                                <td>
                                <button type="button" onclick="infoIstanza(<?=$i['id_RAM']?>);"class="btn btn-success btn-sm" title="Visualizza Info"><i class="fa fa-info" aria-hidden="true"></i></button>
                                <?php
                                  
                                  if($i['stato']!='A'){?>
                                  <button onclick="window.location.href='istanza.php?id=<?=$i['id_RAM']?>'" type="button" class="btn btn-warning btn-sm" title="Visualizza Istanza"><i class="fa fa-list" aria-hidden="true"></i></button>
                                  <?php }
                                  if($i['stato']!='B'){?>
                                    <button type="button" class="btn btn-danger btn-sm" title="Annulla Istanza" onclick="annIst(<?=$i['id_RAM']?>);"><i class="fa fa-times" aria-hidden="true"></i></button>
                                  <?php }
                                  if($i['stato']=='B'){?>
                                    <button type="button" class="btn btn-danger btn-sm" title="Info Annullamento Istanza" onclick="annInfo(<?=$i['id_RAM']?>);"><i class="fa fa-user-times" aria-hidden="true"></i></button>

                                  <?php }
                                ?>
                                </td>      
                            </tr>
                            <?php
                                    
                                    }
                                }else{
                                    
                                    echo '<tr><td colspan=7>Nessuna Istanza trovata</td></tr>';
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
<div class="modal fade" tabindex="-1" role="dialog" id="infoModal">
  <div class="modal-dialog modal-lg" role="document" style="min-width: 98%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Informazioni Istanza
        </h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Chiudi">
          <svg class="icon" style="width:70px;height:70px">
              <use xlink:href="svg/sprite.svg#it-close"></use>
          </svg>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 col-lg-4">
            <!--start card-->
            <div class="card-wrapper">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Dati richiedente</h5>
                  <table class="table table-sm">
          
                    <tbody>
                        <tr>
                        <th scope="row">Cognome</th>
                        <td id="info_cognome"></td>
                        
                        </tr>
                        <tr>
                        <th scope="row">Nome</th>
                        <td id="info_nome"></td>
                        
                        </tr>
                        <tr>
                        <th scope="row">Data di Nascita</th>
                        <td id="info_data_nascita"></td>
                    
                        </tr>
                        <tr>
                        <th scope="row">Luogo di Nascita</th>
                        <td id="info_luogo_nascita"></td>
                    
                        </tr>
                        <tr>
                        <th scope="row">Indirizzo Residenza</th>
                        <td id="info_indirizzo_residenza"></td>
                    
                        </tr>
                        <tr>
                        <th scope="row">Comune Residenza</th>
                        <td id="info_comune_residenza"></td>
                    
                        </tr>
                        <tr>
                        <th scope="row">email</th>
                        <td id="info_email_richiedente"></td>
                    
                        </tr>
                        
                        <tr>
                        <th scope="row">Tipo</th>
                        <td id="info_tipo"></td>
                    
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!--end card-->
          </div>
          <div class="col-12 col-lg-8">
            <!--start card-->
            <div class="card-wrapper">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Dati Impresa</h5>
                  <div class="row">
                    <div class="col-lg-6 col-12">
                        <table class="table table-sm">
                
                            <tbody>
                                <tr>
                                <th scope="row">Ragione Sociale</th>
                                <td id="info_ragione_sociale"></td>
                                
                                </tr>
                                <tr>
                                <th scope="row">Partita IVA</th>
                                <td id="info_piva"></td>
                            
                                </tr>
                                <tr>
                                <th scope="row">Codice Fiscale</th>
                                <td id="info_cf"></td>
                            
                                </tr>
                                
                                
                                
                                <tr>
                                <th scope="row">Indirizzo Impresa</th>
                                <td id="info_indirizzo_impresa"></td>
                            
                                </tr>
                                <tr>
                                <th scope="row">Comune Impresa</th>
                                <td id="info_comune_impresa"></td>
                            
                                </tr>
                                
                                <tr>
                                <th scope="row">Email Impresa</th>
                                <td id="info_email_impr"></td>
                            
                                </tr>
                                <tr>
                                <th scope="row">Pec Impresa</th>
                                <td id="info_pec_impr"></td>
                            
                                </tr>
                                <tr>
                                <th scope="row">Telefono Impresa</th>
                                <td id="info_tel_impr"></td>
                            
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 col-12"> 
                        <table class="table table-sm">
                            <tbody>
                            
                                <tr>
                                <th scope="row">Tipo Impresa</th>
                                <td id="info_tipo_impresa"></td>
                                </tr>
                                <tr>
                                <th scope="row">Codice Albo</th>
                                <td id="info_codice_albo"></td>
                                </tr>
                                <tr>
                                <th scope="row">Codice Ren</th>
                                <td id="info_codice_ren"></td>
                                </tr>
                                <tr>
                                <th scope="row">CCIAA</th>
                                <td id="info_cciaa"></td>
                                </tr>
                                <tr>
                                <th scope="row">Codice A.TE.CO</th>
                                <td id="info_codice_ateco"></td>
                                </tr>
                                <tr>
                                <th scope="row">Banca</th>
                                <td id="info_banca"></td>
                                </tr>
                                <tr>
                                <th scope="row">Maggiorazione PMI</th>
                                <td id="info_pmi"></td>
                                </tr>
                                <tr>
                                <th scope="row">Maggiorazione Contratto rete d'imprese</th>
                                <td id="info_rete"></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                  </div>

                  
                </div>
              </div>
            </div>
            <!--end card-->
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <table class="table table-sm table-bordered" style="font-size:smaller;">
              <thead >
                <tr >
                  <th colspan="5" style="text-align:center;">
                  Acquisizione dei veicoli a trazione alternativa a metano CNG e gas naturale liquefatto LNG, nonché a trazione elettrica - art. 1, comma 5, lett. a  
                  </th>      
                </tr>
                <tr >
                  <th style="text-align:center;">alimentazione
                  </th>
                  <th style="text-align:center;">massa<br> complessiva
                  </th>
                  <th style="text-align:center;">numero<br> veicoli
                  </th>
                  <th style="text-align:center;">spesa prevista<br> (IVA esclusa)
                  </th>
                  <th style="text-align:center;">eventuale<br> rottamazione
                  </th>      
                </tr>
              </thead>
              <tbody>
              <tr>
                <td rowspan="3" style="vertical-align:middle;text-align:center;">CNG</td>
                <td>DA 3,5 A 7 T.</td>
                <td id="info_nv1"></td>
                <td id="info_sp1"></td>
                <td id="info_rott1"></td>                  
              </tr>

              <tr>
               
                <td>OLTRE 7 E MENO DI 16 T.</td>
                <td id="info_nv2"></td>
                <td id="info_sp2"></td>
                <td id="info_rott2"></td>
              </tr>

              <tr>
               
                <td>DA 16 T.</td>
                <td id="info_nv3"></td>
                <td id="info_sp3"></td>
                <td id="info_rott3"></td>
              </tr>

              <tr>
                <td rowspan="2" style="vertical-align:middle;text-align:center;">LNG</td>
                <td>DA 7 E MENO DI 16 T.</td>
                <td id="info_nv4"></td>
                <td id="info_sp4"></td>
                <td id="info_rott4"></td>
              </tr>

              <tr>
                
                <td>DA 16 T.</td>
                <td id="info_nv5"></td>
                <td id="info_sp5"></td>
                <td id="info_rott5"></td>
              </tr>

              <tr>
                <td rowspan="3" style="vertical-align:middle;text-align:center;">IBRIBA<br>(diesel/elettrico)</td>
                <td>DA 3,5 A 7 T.</td>
                <td id="info_nv6"></td>
                <td id="info_sp6"></td>
                <td id="info_rott6"></td>
              </tr>

              <tr>
                
                <td>OLTRE 7 E MENO DI 16 T.</td>
                <td id="info_nv7"></td>
                <td id="info_sp7"></td>
                <td id="info_rott7"></td>
              </tr>

              <tr>
                
                <td>DA 16 T.</td>
                <td id="info_nv8"></td>
                <td id="info_sp8"></td>
                <td id="info_rott8"></td>
              </tr>

              <tr>
                <td rowspan="2" style="vertical-align:middle;text-align:center;">ELETTRICA</td>
                <td>DA 3,5 A 7 T.</td>
                <td id="info_nv9"></td>
                <td id="info_sp9"></td>
                <td id="info_rott9"></td>
              </tr>

              <tr>
               
                <td>OLTRE 7 T.</td>
                <td id="info_nv10"></td>
                <td id="info_sp10"></td>
                <td id="info_rott10"></td>
              </tr>

              <tr>
                <td style="vertical-align:middle;text-align:center;">Dispositivi per la<br>riconversione a<br>trazione elettrica</td>
                <td>3,5 T.</td>
                <td id="info_nv11"></td>
                <td id="info_sp11"></td>
                <td ></td>
              </tr>

              </tbody>          
            </table>
          
          </div>
          <div class="col-6">
          <table class="table table-sm table-bordered" style="font-size:smaller;">
              <thead>
                <tr>
                  <th colspan="4" style="text-align:center;">Radiazione per rottamazione di veicoli pesanti di massa complessiva a pieno carico pari o superiore a 11,5 tonnellate, con contestuale acquisizione di veicoli nuovi di fabbrica art. 1, comma 5, lett. b</th>
                </tr>
                <tr>
                  <th style="vertical-align:middle;text-align:center;">Tipo veicolo</th>
                  <th style="vertical-align:middle;text-align:center;">numero veicoli<br>per tipologia</th>
                  <th style="vertical-align:middle;text-align:center;">spesa prevista<br>(IVA esclusa)</th>
                  <th style="vertical-align:middle;text-align:center;">Numero veicoli<br>rottamati</th>
                </tr>
              </thead>
              <tbody>
              <tr>
                <td  style="vertical-align:middle;text-align:center;">VEICOLI EURO 6 DI MASSA<br>COMPRESA FRA 7 E 16 T.</td>
                <td id="info_r_nv_1"></td>
                <td id="info_r_sp_1"></td>
                <td id="info_r_rott_1"></td>
              </tr>
              <tr>
                <td  style="vertical-align:middle;text-align:center;">VEICOLI EURO 6 DI MASSA<br>SUPERIORE A 16 T.</td>
                <td id="info_r_nv_2"></td>
                <td id="info_r_sp_2"></td>
                <td id="info_r_rott_2"></td>
              </tr>
              <tr>
                <td  style="vertical-align:middle;text-align:center;">VEICOLI EURO 6 DTEMP DI MASSA<br>DA 3,5 E INFERIORE A 7 T.</td>
                <td id="info_r_nv_3"></td>
                <td id="info_r_sp_3"></td>
                <td id="info_r_rott_3"></td>
              </tr>

              </tbody>
          </table>

          <table class="table table-sm table-bordered" style="font-size:smaller;">
              <thead>
                <tr>
                  <th colspan="4" style="text-align:center;">ACQUISIZIONE ANCHE MEDIANTE LOCAZIONE FINANZIARIA, DI RIMORCHI E SEMIRIMORCHI, NUOVI DI FABBRICA, PER IL TRASPORTO COMBINATO – ART. 1, COMMA 5, LETT. C</th>
                </tr>
               
              </thead>
              <tbody>
              <tr>
                <td  colspan="2" rowspan="2"style="vertical-align:middle;text-align:center;">Rimorchi o semirimorchi UIC e IMO ciascuno<br>dotato di almeno uno dei dispositivi innovativi di cui<br>all’allegato 1 del D.M. 203 - 12 maggio 2020</td>
                <th style="vertical-align:middle;text-align:center;">Nr. rimorchi o<br>semirimorchi:</th>
                <th style="vertical-align:middle;text-align:center;">Spesa prevista<br>(IVA esclusa)</th>
              </tr>
              <tr>
                <td id="info_nr_1"></td>
                <td id="info_spr_1"></td>


              </tr>

              </tbody>
          </table> 

          <table class="table table-sm table-bordered" style="font-size:smaller;">
              <thead>
                <tr>
                  <th colspan="4" style="text-align:center;">RIMORCHI, SEMIRIMORCHI E EQUIPAGGIAMENTI PER AUTOVEICOLI SPECIFICI SUPERIORI A 7 TONNELLATE ALLESTITI PER TRASPORTI IN REGIME ATP E SOSTITUZIONE DELLE UNITÀ FRIGORIFERE/CALORIFERE ART. 1, COMMA 5, LETT. C</th>
                </tr>
               
              </thead>
              <tbody>
              <tr>
                <td  colspan="2" rowspan="2"style="vertical-align:middle;text-align:center;width:63%;">Rimorchi, semirimorchi e equipaggiamenti, sostituzione delle unità frigorifere/calorifere installate, per veicoli superiori a 7 t.</td>
                <th style="vertical-align:middle;text-align:center;">Nr. rimorchi, semirimorchi<br> ed equipaggiamenti</th>
                <th style="vertical-align:middle;text-align:center;">Spesa prevista<br>(IVA esclusa)</th>
              </tr>
              <tr>
                <td id="info_nr_2"></td>
                <td id="info_spr_2"></td>


              </tr>

              </tbody>
          </table> 

          <table class="table table-sm table-bordered" style="font-size:smaller;">
              <thead>
                <tr>
                  <th colspan="4" style="text-align:center;">ACQUISIZIONE DI GRUPPI DI CASSE MOBILI E RIMORCHI O SEMIRIMORCHI PORTACASSE ART. 1, COMMA 5, LETT. D</th>
                </tr>
               
              </thead>
              <tbody>
              <tr>
                <td  colspan="2" rowspan="2"style="vertical-align:middle;text-align:center;width:63%;">Gruppo costituito da 8 (otto) casse mobili ed un rimorchio o semirimorchio portacasse</td>
                <th style="vertical-align:middle;text-align:center;">Nr. gruppi</th>
                <th style="vertical-align:middle;text-align:center;">Spesa prevista<br>(IVA esclusa)</th>
              </tr>
              <tr>
                <td id="info_ng_1"></td>
                <td id="info_spg_1"></td>


              </tr>

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
<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="offModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="annTitle">Annullamento Istanza
        </h5>
      </div>
      <div class="modal-body">
        <form id="annForm">
        <input type="hidden" id="annId"name="id_RAM" value="">
          <div class="form-group">
            <textarea id="note_annullamento"  name="note_annullamento" rows="3" maxlenght=500 placeholder="Inserisci riferimenti annullamento" required></textarea>
            <label for="note_annullamento">Note Annullamento</label>
          </div>
          </form>  
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Esci senza annullare</button>
        <button class="btn btn-success btn-sm" type="submit" form="annForm" type="button">Esegui Annullamento</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="annModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="annInfoTitle">Annullamento Istanza
        </h5>
      </div>
      <div class="modal-body">
       
      
      <div class="card-body">
          <h5 class="card-title">Note Annullamento</h5>
          <p class="card-text" id="note_info"></p>
        </div>
          </form>  
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
       
      </div>
    </div>
  </div>
</div>