
<?php
$tipi_integrazione =getRichInt();
$tipi_report = getTipoReport();


?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" onclick="newInt();">
 <i class="fa fa-plus" aria-hidden="true"> </i> Nuova Richiesta di Integrazione
</button>
<div class="col-6" style="margin-top:45px;">
<div class="bootstrap-select-wrapper " >
                <label>Tipo Report</label>
                <select title="Scegli una opzione" name="tipo_report" id="tipo_report">
                <?php
                    foreach ($tipi_report as $tr ) {?>
                    <option value="<?=$tr['id']?>"><?=$tr['descrizione']?></option>
                    <?php    
                    }?>
                    
                </select>
            </div>
            </div>
<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="reportModal">
  <div class="modal-dialog modal-lg" role="document" style="max-width:80%">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuova Richiesta di Integrazione
        </h5>
      </div>
      <div class="modal-body">
      <input type="hidden" name="id_report" id="id_report" value="">
        <div class="row">
            <div class="col-6">
                <div class="bootstrap-select-wrapper " >
                    <label>Tipo Richiesta</label>
                    <select title="Scegli una opzione" name="tipo_integrazione" id="tipo_integrazione">
                    <?php
                        foreach ($tipi_integrazione as $ti ) {?>
                        <option value="<?=$ti['id']?>"><?=$ti['descrizione']?></option>
                        <?php    
                        }?>
                        
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control" name="prot_RAM" id="prot_RAM" placeholder="se disponibile, inserire numero protocollo documento">
                    <label for="prot_RAM">Protocollo Documento</label>
                </div>
                <div class="it-datepicker-wrapper">
                    <div class="form-group">
                        <input class="form-control it-date-datepicker" id="data_prot" name="data_prot" type="text" placeholder="inserisci la data in formato gg/mm/aaaa">
                        <label for="data_prot">Data Documento</label>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top:45px;display:none;" id="des_int" >
            <div class="form-group">
            <label id="lab_des"for="descrizione_integrazione"  class="active" style="width: auto;">Descrizione</label>
                <textarea class="form-control" id="descrizione_integrazione" name="descrizione_integrazione" rows="3"></textarea>
                
            </div>
        </div>

        <div class="row" id="div_btn_add_int" style="justify-content: center;display:none;">
            <button type="button" id="btn_add_int" onclick="addInt()"class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> Inserisci richiesta</button>
        </div>

        <div class="row" id="div_tab_int"  style="display:none;">
            <table class="table" id="tab_int">
                <thead>
                    <tr><td>Tipo</td>
                        <td>Descrizione</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>    
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Annulla</button>
        <button class="btn btn-primary btn-sm" data-dismiss="modal" type="button">Salva</button>
        <button class="btn btn-success btn-sm" data-dismiss="modal" type="button">Anteprima</button>
      </div>
    </div>
  </div>
</div>