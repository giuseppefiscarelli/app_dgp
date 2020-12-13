<div class="collapse-header " id="heading1-sc<?=$ca['ctgi_codice']?>">
                    <button data-toggle="collapse" data-target="#collapse1-sc<?=$ca['ctgi_codice']?>" aria-expanded="<?=$ca['ctgi_codice']==1?'true':'false'?>" aria-controls="collapse1-sc<?=$ca['ctgi_codice']?>">
                       Categoria <?=utf8_decode($ca['ctgi_categoria'])?><br> <small><?=$ca['ctgi_descrizione']?></small>
                    </button>
                  </div>
                  <div id="collapse1-sc<?=$ca['ctgi_codice']?>" class="collapse" role="tabpanel" aria-labelledby="heading1-sc<?=$ca['ctgi_codice']?>" data-parent="#collapseDiv1-sc1">
                    <div class="collapse-body">

                        <div class="bd-example-tabs">
                          <div class="row">
                            <?php
                              $tipVei =getTipoVei($ca['ctgi_codice']);
                              //var_dump($tipVei);    
                              $countTip =1;
                              $countTip2 =1;

                              ?>
                            <div class="col-4 col-md-3">
                              <div class="nav nav-tabs nav-tabs-vertical nav-tabs-vertical-background" id="nav-vertical-tab-bg" role="tablist" aria-orientation="vertical">
                                <?php
                                  foreach($tipVei as $tve){
                                    $countCatVei=countCatVei($tve['tpvc_codice'],$i['id_RAM']);
                                   
                                    if($countCatVei==!0){
                                      $totalDoc = 0;
                                      $checkVei=0;
                                      $b= intval($countCatVei);
                                      $iii=1;
                                      for ($iii; $iii <=$b; $iii++) { 
                                        $check = countDocVeicolo($tve['tpvc_codice']);//numero tipi documento
                                       // var_dump($check);
                                        $checkb =countDocVeicoloInfo($i['id_RAM'],$tve['tpvc_codice'],$iii);
                                       // var_dump($tve['tpvc_codice']);
                                        $checktipoac = countCatVeiTipoac($tve['tpvc_codice'],$i['id_RAM'],$iii);
                                        $checkb = intval($checkb);
                                       if($checktipoac){
                                          $totvei = $check-1;
                                        }else{
                                          $totvei=intval($check);
                                        }
                                        $totalDoc = $totalDoc + $checkb;
                                       //var_dump($checkb);var_dump($totvei);
                                      //var_dump($totvei);
                                        if($checkb==$totvei&&$checkb>0){
                                         //var_dump('ok');
                                       
                                          $checkVei = $checkVei+1;
                                          
                                        }else{
                                        //  var_dump('no');
                                        }
                                       
                                      }
                                      //var_dump($totalDoc);
                                      //var_dump($checkVei);
                                     $complete= '<i id="ch_i_'.$tve['tpvc_codice'].'"class="fa fa-check" style="color:green;" aria-hidden="true"></i>';
                                     $incomplete='<i id="ch_i_'.$tve['tpvc_codice'].'" class="fa fa-ban" style="color:red;" aria-hidden="true"></i>';
                                  
                                ?>
                                <a class="nav-link <?=$countTip ==1?'active':''?>" id="nav-vertical-tab-bg<?=$tve['codice_categoria_incentivo'].'-'.$countTip?>-tab" data-toggle="tab" href="#nav-vertical-tab-bg<?=$tve['codice_categoria_incentivo'].'-'.$countTip?>" role="tab" aria-controls="nav-vertical-tab-bg<?=$tve['codice_categoria_incentivo'].'-'.$countTip?>" aria-selected="true">
                                    <table style="width: -webkit-fill-available;">
                                        <tr>
                                            <td><?=$tve['tpvc_descrizione']?></td>
                                            <td style="width: 30%;text-align: right"><span><?=$countCatVei?> <?=$countCatVei>1?'veicoli':'veicolo'?></span></td>
                                        </tr>
                                        
                                        <tr><td colspan="2" style="font-size: 13px;text-align: right;"><?=$checkVei==$countCatVei&&$countCatVei>0?$complete:$incomplete?> Completate Informazioni di <b id="ch_p_<?=$tve['tpvc_codice']?>"><?=$checkVei?></b> di <b id="ch_t_<?=$tve['tpvc_codice']?>"><?=$countCatVei?></b> veicoli</td></tr>
                                    </table>
                                </a>

                                <?php
                                ++$countTip;
                                  }
                                }?>
                               

                              </div>
                            </div>

                            <div class="col-8 col-md-9">
                              <div class="tab-content" id="nav-vertical-tab-bgContent">
                                <?php
                                  foreach($tipVei as $tvei){
                                    $countCatVei2=countCatVei($tvei['tpvc_codice'],$i['id_RAM']);
                                    if($countCatVei2==!0){
                                ?>

                                <div class="tab-pane p-3 fade <?=$countTip2 ==1?'show active':''?>" id="nav-vertical-tab-bg<?=$tvei['codice_categoria_incentivo'].'-'.$countTip2?>" role="tabpanel" aria-labelledby="nav-vertical-tab-bg<?=$tvei['codice_categoria_incentivo'].'-'.$countTip2?>-tab">

                                      <?php
                                      require 'tabveicolo2.php';
                                      ?>        
                                           
                                            
                                           

                                </div>
                                <?php
                                ++$countTip2;
                                            }
                                }?>
                               
                                                         


                                
                              </div>
                            </div>

                          </div>
                        </div>

                                              
                    </div>
                  </div>