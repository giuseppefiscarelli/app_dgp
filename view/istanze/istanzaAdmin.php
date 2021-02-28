<h3 class="card-title">Istanza n° <?=$i['id_RAM']?>/<?=date("Y")?></h3>



  <div class="row">
    <div class="col-5 col-md-4 col-lg-2">
      <div class="nav nav-tabs nav-tabs-vertical" id="nav-admin" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="nav-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Dati Impresa</a>
        <a class="nav-link" id="nav-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Dati Veicoli </a>
        <a class="nav-link" id="nav-3" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Riepilogo </a>
        <a class="nav-link" id="nav-4" data-toggle="tab" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false">Comunicazioni </a>
        <a class="nav-link" id="nav-5" data-toggle="tab" href="#tab-5" role="tab" aria-controls="tab-5" aria-selected="false">Report </a>

      </div>
    </div>
    <div class="col-7 col-md-8 col-lg-10">
      <div class="tab-content" id="nav-tab-admin">
        <div class="tab-pane p-3 fade show active" id="tab-1" role="tabpanel" aria-labelledby="nav-1"><?php require_once 'Admin_tab1.php'; ?> </div>
        <div class="tab-pane p-3 fade" id="tab-2" role="tabpanel" aria-labelledby="nav-2"><?php require_once 'Admin_tab2.php'; ?></div>
        <div class="tab-pane p-3 fade" id="tab-3" role="tabpanel" aria-labelledby="nav-3"><?php require_once 'Admin_tab3.php'; ?></div>
        <div class="tab-pane p-3 fade" id="tab-4" role="tabpanel" aria-labelledby="nav-4"><?php require_once 'Admin_tab4.php'; ?></div>
        <div class="tab-pane p-3 fade" id="tab-5" role="tabpanel" aria-labelledby="nav-5"><?php require_once 'Admin_tab5.php'; ?></div>
      </div>
    </div>
  </div>
                                             
