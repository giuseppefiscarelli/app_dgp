<?php
//var_dump($tipo_istanza);
/*
 $activeIst = true;
 $status= checkRend($i['id_RAM']);
if(date("Y-m-d",strtotime($tipo_istanza['data_rendicontazione_fine']))<date("Y-m-d")){
  $span='<span class="badge badge-success">In Istruttoria</span><br>Termine per la rendicondazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
  $activeIst = false;
  

}else{
  if($status){

  if($status['aperta']==1){
    $stato= getStatoIstanza('C');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span>';
   
  }elseif($status['aperta']==0){
    $stato= getStatoIstanza('D');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Rendicondazione chiusa il '.date("d/m/Y",strtotime($status['data_chiusura']));
    $activeIst = false;
  }
  if($status['data_annullamento']){
    $stato= getStatoIstanza('B');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Annullata da Impresa ';

    $activeIst = false;
  }
  if(($tipo_istanza['data_rendicontazione_fine']<date("Y-m-d H:i:s")&&$status['aperta']==1)){
    $stato= getStatoIstanza('B');
    $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Tempi di rendicontazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
    $activeIst = false;
  } 
}else{
  $span='<span class="badge badge-warning">Attiva</span>';
}
}
*/
$activeIst = true;
$status= checkRend($i['id_RAM']);

if($tipo_istanza['data_rendicontazione_fine']<date("Y-m-d")){
 
  if($status){
    if($status['aperta']==1){
      $stato= getStatoIstanza('C');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span>';
     
    }elseif($status['aperta']==0){
      $stato= getStatoIstanza('D');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Rendicondazione chiusa il '.date("d/m/Y",strtotime($status['data_chiusura']));
      $activeIst = false;
    }
    if($status['data_annullamento']){
      $stato= getStatoIstanza('B');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Annullata da Impresa ';
  
      $activeIst = false;
    }
    if(($tipo_istanza['data_rendicontazione_fine']<date("Y-m-d H:i:s")&&$status['aperta']==1)){
      $stato= getStatoIstanza('E');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Termini di rendicontazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
      $activeIst = false;
    }
  }
}else{
  if($status){
    if($status['aperta']==1){
      $stato= getStatoIstanza('C');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span>';
     
    }elseif($status['aperta']==0){
      $stato= getStatoIstanza('D');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Rendicondazione chiusa il '.date("d/m/Y",strtotime($status['data_chiusura']));
      $activeIst = false;
    }
    if($status['data_annullamento']){
      $stato= getStatoIstanza('B');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Annullata da Impresa ';
  
      $activeIst = false;
    }
    if(($tipo_istanza['data_rendicontazione_fine']<date("Y-m-d H:i:s")&&$status['aperta']==1)){
      $stato= getStatoIstanza('E');
      $span='<span class="badge badge-'.$stato['style'].'">'.$stato['des'].'</span><br>Termini di rendicontazione scaduti il '.date("d/m/Y",strtotime($tipo_istanza['data_rendicontazione_fine']));
      $activeIst = false;
    }
  }else{
    $status['data_annullamento']= false;
    $span='<span class="badge badge-warning">Attiva</span>';
    $activeIst = true;
  }
}



 
?>
<div class="row">
  <div class="col-lg-8 col-12">
    <h3 class="card-title">Istanza n° <?=$i['id_RAM']?>/<?=$tipo_istanza['anno']?>  <span style="font-size:17px;"><?=$i['ragione_sociale']?></span></h3>
  </div>
  <div class="col-lg-2 col-12">
    Stato Istanza <?=$span?>
  </div>
<?php
if(!$status['data_annullamento']&&$activeIst){?>
<div class="col-lg-2 col-12">
  <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#offModal">
  Annulla Istanza
</button>
  </div>

<?php } ?>
  


</div>




<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="offModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Annullamento Istanza
        </h5>
      </div>
      <div class="modal-body">
        <form id="annForm">
        <input type="hidden" name="id_RAM" value="<?=$i['id_RAM']?>">
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

  <div class="row">
    <div class="col-5 col-md-4 col-lg-2">
      <div class="nav nav-tabs nav-tabs-vertical" id="nav-admin" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="nav-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Dati Impresa</a>
        <a class="nav-link" id="nav-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Dati Veicoli </a>
        <!--<a class="nav-link" id="nav-3" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Riepilogo </a>-->
        <a class="nav-link" id="nav-4" data-toggle="tab" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false">Comunicazioni </a>
        <a class="nav-link" id="nav-5" data-toggle="tab" href="#tab-5" role="tab" aria-controls="tab-5" aria-selected="false">Report </a>


      </div>
    </div>
    <div class="col-7 col-md-8 col-lg-10">
      <div class="tab-content" id="nav-tab-admin">
        <div class="tab-pane p-3 fade show active" id="tab-1" role="tabpanel" aria-labelledby="nav-1"><?php require_once 'Admin_tab1.php'; ?> </div>
        <div class="tab-pane p-3 fade" id="tab-2" role="tabpanel" aria-labelledby="nav-2"><?php require_once 'Admin_tab2.php'; ?></div>
       <!-- <div class="tab-pane p-3 fade" id="tab-3" role="tabpanel" aria-labelledby="nav-3"><?php //require_once 'Admin_tab3.php'; ?></div>-->
        <div class="tab-pane p-3 fade" id="tab-4" role="tabpanel" aria-labelledby="nav-4"><?php require_once 'Admin_tab4.php'; ?></div>
        <div class="tab-pane p-3 fade" id="tab-5" role="tabpanel" aria-labelledby="nav-5"><?php require_once 'Admin_tab5.php'; ?></div>
      
      </div>
    </div>
  </div>
                                             
