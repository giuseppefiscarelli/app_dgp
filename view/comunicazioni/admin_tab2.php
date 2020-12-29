<div class="it-list-wrapper">
  <ul class="it-list">
    <?php
                                if ($comunicazioni){
                                    $checkmsg=0;
                                    foreach ($comunicazioni as $c){
                                       
                                        if($c['read_msg']=='1'&& $c['risolto']=='0'){
                                            $checkmsg++;
                                        $tipod = getTipo($c['tipo']);
                                        if(isUserUser()){
                                            $rolecheck = 'admin';
                                        }else{
                                            $rolecheck = 'user';
                                        }
                                        $unreadConv=checkUnreadConv($c['id'],$rolecheck);
                                       ?>
                                    <li>
                                        
                                        <a class="it-has-checkbox" href="#">
                                       
                                        <div class="it-right-zone">
                                            <div class="col-2">
                                                <span class="text"><?=$c['id_RAM']?>/2020<em><?=$c['user_ins']?></em></span>
                                            </div>
                                            <div class="col-5">
                                                <span class="text"><?=$tipod['des_msg']?><em><?=$c['testo']?></em></span>
                                            </div>
                                            <div class="col-2">
                                                
                                                    <?=$c['risolto']?'<span class="badge badge-success">Chiuso</span>':'<span class="badge badge-warning">Richiesta In Lavorazione</span>'?>
                                                    <?php
                                                        if($unreadConv){?>
                                                        <br>
                                                        Messaggi non letti <span class="badge badge-danger"><?=$unreadConv?></span>

                                                    <?php    }
                                                    ?>
                                                
                                            </div>
                                            <div class="col-2">
                                                <?=date("d/m/Y H:i", strtotime($c['data_ins']))?>
                                            </div>
                                            <div class="col-1">
                                                <?php
                                                if(isUserUser()){?>
                                                <button type="button" onclick="document.location='comunicazione.php?id=<?=$c['id']?>'" class="btn btn-success btn-sm" style="padding: 5px 12px;"title="Visualizza Richiesta"><i class="fa fa-info" aria-hidden="true"></i></button>

                                                <?php

                                                }else{?>
                                                <button  type="button" onclick="infomsgAd(<?=$c['id']?>);"class="btn btn-success btn-sm" style="padding: 5px 12px;"title="Visualizza Richiesta"><i class="fa fa-info" aria-hidden="true"></i></button>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        </a>
                                    </li>






                                    <?php
                                     }
                                
                                    }
                                    if($checkmsg==0){?>
                                    Non ci sono Ticket Aperti
                                   <?php
                                    }
                                }
                                ?>
  </ul>
</div>