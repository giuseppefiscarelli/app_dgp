<div class="row">
        <div class="col-12 col-lg-6">
          <!--start card-->
          <div class="card-wrapper">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Dati richiedente</h5>
                <table class="table table-sm">
         
                  <tbody>
                      <tr>
                      <th scope="row">Cognome</th>
                      <td><?=$i['cognome']?></td>
                      
                      </tr>
                      <tr>
                      <th scope="row">Nome</th>
                      <td><?=$i['nome']?></td>
                      
                      </tr>
                      <tr>
                      <th scope="row">Data di Nascita</th>
                      <td><?=date("d/m/Y",strtotime($i['data_nascita']))?></td>
                  
                      </tr>
                      <tr>
                      <th scope="row">Luogo di Nascita</th>
                      <td><?=$i['luogo_nascita']?> (<?=$i['prov_nascita']?>)</td>
                  
                      </tr>
                      <tr>
                      <th scope="row">Indirizzo Residenza</th>
                      <td><?=$i['indirizzo_residenza']?>, <?=$i['civico_residenza']?></td>
                  
                      </tr>
                      <tr>
                      <th scope="row">Comune Residenza</th>
                      <td><?=$i['cap_residenza']?> - <?=$i['comune_residenza']?> (<?=$i['prov_residenza']?>)</td>
                  
                      </tr>
                      <tr>
                      <th scope="row">email</th>
                      <td><?=$i['email_richiedente']?></td>
                  
                      </tr>
                      <?php
                       $dichiarante  =getTipoDich($i['tipo_dichiarante']);
                       $dich = $dichiarante['descrizione_tipo'];
                       ?> 
                      <tr>
                      <th scope="row">Tipo</th>
                      <td><?=$dich?></td>
                  
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!--end card-->
        </div>
</div>
<div class="row">    
    <div class="col-12 col-lg-12">
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
                          <td><?=$i['ragione_sociale']?></td>
                          
                          </tr>
                          <tr>
                          <th scope="row">Partita IVA</th>
                          <td><?=$i['piva']?></td>
                      
                          </tr>
                          <tr>
                          <th scope="row">Codice Fiscale</th>
                          <td><?=$i['cf']?></td>
                      
                          </tr>
                          
                          
                          
                          <tr>
                          <th scope="row">Indirizzo Impresa</th>
                          <td><?=$i['indirizzo_impr']?>, <?=$i['civico_impr']?></td>
                      
                          </tr>
                          <tr>
                          <th scope="row">Comune Impresa</th>
                          <td><?=$i['cap_impr']?> - <?=$i['comune_impr']?> (<?=$i['prov_impr']?>)</td>
                      
                          </tr>
                          
                          <tr>
                          <th scope="row">Email Impresa</th>
                          <td><?=$i['email_impr']?></td>
                      
                          </tr>
                          <tr>
                          <th scope="row">Pec Impresa</th>
                          <td><?=$i['pec_impr']?></td>
                      
                          </tr>
                          <tr>
                          <th scope="row">Telefono Impresa</th>
                          <td><?=$i['pref_tel_impr']?> / <?=$i['num_tel_impr']?></td>
                      
                          </tr>
                      </tbody>
                  </table>
              </div>
              <div class="col-lg-6 col-12"> 
                  <table class="table table-sm">
                      <tbody>
                      <?php
                      $tipoimpresa = getTipoImpresa($i['tipo_impresa']);
                      $tipImr = $tipoimpresa['descrizione_tipo'];
                      ?>
                          <tr>
                          <th scope="row">Tipo Impresa</th>
                          <td><?=$tipImr?></td>
                          </tr>
                          <tr>
                          <th scope="row">Codice Albo</th>
                          <td><?=$i['codice_albo']?></td>
                          </tr>
                          <tr>
                          <th scope="row">Codice Ren</th>
                          <td><?=$i['codice_ren']?></td>
                          </tr>
                          <tr>
                          <th scope="row">CCIAA</th>
                          <td>Provincia <?=$i['cciaa_prov']?><br>Codice <?=$i['cciaa_codice']?><br>Data <?=date("d/m/Y",strtotime($i['cciaa_data']))?></td>
                          </tr>
                          <tr>
                          <th scope="row">Codice A.TE.CO</th>
                          <td><?=$i['codice_ateco']?></td>
                          </tr>
                          <tr>
                          <th scope="row">Banca</th>
                          <td>Istituto <?=$i['banca_istituto']?><br>
                              Agenzia <?=$i['banca_agenzia']?><br>
                              IBAN <?=$i['iban_it']?> <?=$i['iban_num_chk']?> <?=$i['iban_cin']?> <?=$i['iban_abi']?> <?=$i['iban_cab']?> <?=$i['iban_cc']?></td>
                          </tr>
                          <tr>
                          <th scope="row">Maggiorazione PMI</th>
                          <td><?=$i['pmi']=='Off'?'Non Presente':'Presente'?></td>
                          </tr>
                          <tr>
                          <th scope="row">Maggiorazione Contratto rete d'Imprese</th>
                          <td><?=$i['rete']=='Off'?'Non Presente':'Presente'?></td>
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

<?php if($status['aperta']!=1){
    require "alleistanza3.php";
}
?>

