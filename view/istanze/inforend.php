<?php
$countdatvei = countIstanzaVei($i['id_RAM']);
$countdatveiinfo = countIstanzaVeiInfo($i['id_RAM']);
$countdocIstanza=countDocIstanza($i['id_RAM']);
$countdocIstanzaInfo=countDocIstanzaInfo($i['id_RAM']);
//var_dump($countdocIstanzaInfo);

?>

<div class="it-header-slim-wrapper theme-light" style="margin-bottom:20px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="it-header-slim-wrapper-content">
            <div class="row" style="width:70%">
                <div class="col-4">
                    <p class="d-none d-lg-block navbar-brand">Stato Rendicontazione</p>
                </div>
                <div class="col-8">
                <p class="d-none d-lg-block navbar-brand">
                <?php
                    if($countdatveiinfo==$countdatvei){?>
                <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>
                <?php
            }else{?>
                <i class="fa fa-ban" aria-hidden="true" style="color:red;"></i>
                <?php
            }?> 
            Dati Veicoli Inseriti <?=$countdatveiinfo?> di <?=$countdatvei?><br>
            <?php
               //     if($countdocIstanzaInfo==$countdocIstanza){?>
               <!-- <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>
                <?php
           // }else{?>
                <i class="fa fa-ban" aria-hidden="true" style="color:red;"></i>-->
                <?php
            //}?> 


                <!-- Documenti Veicoli caricati  <?=$countdocIstanzaInfo?> di <?=$countdocIstanza?></p>
                </p>-->
            
                
                </div>
            </div>
            
            <?php
           // var_dump($rend);
           if(!isUserAdmin()&&$rend['aperta']==1&&$activeIst==true){
            // var_dump($tipo_istanza);
             ?>
          <div class="it-header-slim-right-zone">
            
            <div class="it-access-top-wrapper">
              <button type="button" class="btn btn-primary btn-sm" onclick="closeRend(<?=$i['id_RAM']?>)">Chiudi Rendicontazione</button>
            </div>
          </div>
              <?php
                }
              ?>
        </div>
      </div>
    </div>
  </div>
</div>