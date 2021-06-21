<tr>
                                                    <td id="tipo_magg_<?=$tipo?>"><?=$descrizione?></td>
                                                    <td id="data_<?=$tipo?>"><?=$alle?$data_alle:'Allegato non Caricato'?></td>
                                                    <td id="stato_<?=$tipo?>">
                                                      
                                                        <?php
                                                                if($alle){
                                                                if($alle['stato_admin']=='A'||$alle['stato_admin']==null){
                                                                    $stato_admin = '<span class="badge badge-warning" style="width: -webkit-fill-available;">In Lavorazione</span>';
                                                                }
                                                                if($alle['stato_admin']=='B'){
                                                                    $stato_admin = '<span class="badge badge-success" style="width: -webkit-fill-available;">Accettato</span>';
                                                                }
                                                                if($alle['stato_admin']=='C'){
                                                                    $stato_admin = '<span class="badge badge-danger" style="width: -webkit-fill-available;">Rigettato</span>';
                                                                }
                                                                echo $stato_admin;
                                                            }
                                                        ?>
                                                        
                                                        
                                                        </td>
                                                        <?php
                                                            if(!isUserAdmin()&&$rend['aperta']==1&&$activeIst==true){?> 

                                                        <div id="upload_<?=$tipo?>"style="display:<?=$alle?'none':''?>"    >
                                                            <button type="button" onclick="docmagmodal('<?=$tipo?>',<?=$tipo_doc?>);"class="btn btn-primary btn-xs" title="Carica Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-archive-o" aria-hidden="true"></i> Carica Allegato</button>
                                                        </div>
                                                        <?php
                                                        }?>
                                                        <div id="download_<?=$tipo?>"style="display:<?=$file?'':'none'?>"  >
                                                        
                                                            
                                                            <button id="open_<?=$tipo?>"type="button" onclick="window.open('allegato.php?id=<?=$alle['id']?>', '_blank')"class="btn btn-primary btn-xs" title="Visualizza Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-file-archive-o" aria-hidden="true"></i></button>
                                                            <a d="down_<?=$tipo?>"type="button" href="download.php?id=<?=$alle['id']?>" download class="btn btn-success btn-xs" title="Download Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <?php
                                                                   if(!isUserAdmin()&&$rend['aperta']==1&&$activeIst==true){?>
                                                            <button id="del_<?=$tipo?>" type="button" onclick="delAlle(<?=$alle['id']?>,this);"class="btn btn-danger btn-xs" title="Elimina Allegato"style="padding-left:12px;padding-right:12px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            <?php
                                                        }?>
                                                        </div>

                                                    </td>
                                                   
                                                </tr>