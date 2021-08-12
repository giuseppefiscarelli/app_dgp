<div class="it-list-wrapper">








<ul class="it-list">
    
    <?php

    if($pecSend){
        foreach($pecSend as $pa){
            $tipo = getInfoReport($pa['tipo_report']);
            $istanza = getIstanza($pa['id_RAM']);
            $classUser=explode('@',$pa['user_ins']);
            $tipo_istanza = getTipoIstanza($istanza['tipo_istanza']);
            ?>
                <li class="tiporeport_<?=$pa['tipo_report']?> userins_<?=$classUser[0]?>">
                    <a class="it-has-checkbox" href="#">
                        
                        <div class="it-right-zone">
                            <div class="col-4">
                                <span class="text"><?=$pa['id_RAM']?>/<?=$tipo_istanza['anno']?> - <?=$tipo_istanza['des']?> <br><?=$istanza['ragione_sociale']?></span>
                            </div>
                            <div class="col-2">
                                <span class="text"><em><?=$tipo['descrizione']?></em></span>
                            </div>
                            <div class="col-4">
                                <span class="text" style="font-size: 0.7em;"><em style="display:inline;">Inserita da:</em> <?=$pa['user_ins']?> <?=date("d/m/Y H:i", strtotime($pa['data_ins']))?></span>
                                <span class="text" style="font-size: 0.7em;"><em style="display:inline;">Convalidata da:</em> <?=$pa['user_conv']?> <?=date("d/m/Y H:i", strtotime($pa['data_conv']))?></span>
                                <span class="text" style="font-size: 0.7em;"><em style="display:inline;">Inviata da:</em> <?=$pa['user_invio']?> <?=date("d/m/Y H:i", strtotime($pa['data_invio']))?></span>
                            </div>
                            

                        </div>
                    </a>
                </li>

    <?php }
}else{?>
                <li>
                    <a class="it-has-checkbox" href="#">
                    
                        <div class="it-right-zone"><span class="text">Non ci sono pec inviate</span>
                        </div>
                    </a>
                </li>
<?php }?>
  </ul>
</div>