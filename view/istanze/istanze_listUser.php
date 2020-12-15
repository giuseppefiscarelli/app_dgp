<?php

  
  ?>

<div class="row">
  <div class="col-8 ">
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
                $ist=getIstanzeUser($_SESSION['userData']['email']);
                //var_dump($test);
                    foreach($ist as $i){?>
                    <tr>
                    <td><?=$i['id_RAM']?>/2020</td>
                    <td>Investimenti 2020</td>
                    <td> 
                    <?php
                      $status= checkRend($i['id_RAM']);

                      if($status){

                        if($status['aperta']==true){?>
                          <span class="badge badge-primary">In Rendicontazione</span>
                        <?php
                        }else{?>
                          <span class="badge badge-success">In Istruttoria</span><br>
                          Rendicondazione chiusa il <?=date("d/m/Y",strtotime($status['data_chiusura']))?>
                        <?php
                        }

                      }else{?>
                        <span class="badge badge-warning">Attiva</span>
                      <?php
                      }
                      ?>

                          
                          
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
                        <?php
                          if($status){

                              if($status['aperta']==true){?>
                        <a type="button" href="istanza.php"class="btn btn-primary" style="color:white;"> Vai a Istanza</a>
                            <?php
                            }else{?>
                              <a type="button" href="istanza.php"class="btn btn-primary" style="color:white;"> Vai a Istanza</a>

                          <?php    
                            }
                        }else{?>
                        <a type="button" href="istanza.php"class="btn btn-primary" style="color:white;"> vai a Istanza</a>
                        <?php

                        }
                        ?>

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