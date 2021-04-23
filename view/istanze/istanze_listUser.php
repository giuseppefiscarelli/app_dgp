

<div class="row">
  <div class="col-12 ">
    <!--start card-->
    <div class="card-wrapper">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Le mie Istanze</h3>
          <p class="card-text">pec impresa: <?=$_SESSION['userData']['email']?></p>

            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Protocollo RAM</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Stato</th>
                    <th scope="col">Data invio</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
               // $ist=getIstanzeUser($_SESSION['userData']['email']);
               // var_dump($ist);
                    foreach($ist as $i){
                      $tipo_istanza = getTipoIstanza($i['tipo_istanza']);
                      $stato_istanza = getStatoIstanza($i['stato']);
                      $status=checkRend($i['id_RAM']);?>
                    <tr>
                    <td><?=$i['id_RAM']?>/<?=$tipo_istanza['anno']?><br></td>
                    <td><b><?=$tipo_istanza['des']?></b></td>
                   
                    <td><span class="badge badge-pill badge-<?=$stato_istanza['style']?>"><?=$stato_istanza['des']?></span>
                                    <?=$i['stato_des']?>
                                      <?php

                                      ?>
                                </td>

                          
                          
                    </td>
                    <td><?php
                      //$xmldata = getXml($i['pec_msg_identificativo'],$i['pec_msg_id']);
                      //var_dump($xmldata);
                   if($ist){
                     echo date("d/m/Y", strtotime($i['data_invio']));

                   }else{

                    echo 'Data non diponibile';
                   }
                    
                    ?></td>
                    <td>
                        <div  class="btn-group btn-group-sm" role="group">
                        <button type="button" onclick="infoIstanza(<?=$i['id_RAM']?>);"class="btn btn-success btn-sm" title="Visualizza Info"><i class="fa fa-info" aria-hidden="true"></i> Info Istanza</button>
                   
                        <a type="button" href="istanza.php"class="btn btn-primary" style="color:white;margin-left:5px;"> Vai a Istanza</a>
                           

                        </div>
                    </td>
                    </tr>
                 <?php
                    }
                    ?>   
                </tbody>
            </table>
        </div>
      </div>
    </div>
    <!--end card-->
  </div>
</div>
<!-- Modal -->

<?php require_once 'infomodal.php'; ?>