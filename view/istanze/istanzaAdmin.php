<h3 class="card-title">Istanza n° <?=$i['id_RAM']?>/<?=date("Y")?></h3>



  <div class="row">
    <div class="col-5 col-md-4 col-lg-2">
      <div class="nav nav-tabs nav-tabs-vertical" id="nav-admin" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="nav-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Dati Impresa</a>
        <a class="nav-link" id="nav-vertical-tab-ico2-tab" data-toggle="tab" href="#nav-vertical-tab-ico2" role="tab" aria-controls="nav-vertical-tab-ico2" aria-selected="false">Dati Veicoli </a>
        <a class="nav-link" id="nav-vertical-tab-ico3-tab" data-toggle="tab" href="#nav-vertical-tab-ico3" role="tab" aria-controls="nav-vertical-tab-ico3" aria-selected="false">Riepilogo </a>
        <a class="nav-link" id="nav-vertical-tab-ico4-tab" data-toggle="tab" href="#nav-vertical-tab-ico4" role="tab" aria-controls="nav-vertical-tab-ico4" aria-selected="false">Comunicazioni </a>

      </div>
    </div>
    <div class="col-7 col-md-8 col-lg-10">
      <div class="tab-content" id="nav-tab-admin">
        <div class="tab-pane p-3 fade show active" id="tab-1" role="tabpanel" aria-labelledby="nav-1"><?php require_once 'Admin_tab1.php'; ?> </div>
        <div class="tab-pane p-3 fade" id="nav-vertical-tab-ico2" role="tabpanel" aria-labelledby="nav-vertical-tab-ico2-tab"><?php require_once 'Admin_tab2.php'; ?></div>
        <div class="tab-pane p-3 fade" id="nav-vertical-tab-ico3" role="tabpanel" aria-labelledby="nav-vertical-tab-ico3-tab"><?php require_once 'Admin_tab3.php'; ?></div>
        <div class="tab-pane p-3 fade" id="nav-vertical-tab-ico4" role="tabpanel" aria-labelledby="nav-vertical-tab-ico4-tab"><?php require_once 'Admin_tab4.php'; ?></div>

      </div>
    </div>
  </div>
                                             
