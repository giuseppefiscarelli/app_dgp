 <style>
   .card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  
  .card-counter.warning{
    background-color: #ff9800;
    color: #FFF;
  }

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
  }
 </style>      

<!--
      <div class="row">
        <div class="col-12 ">
          <div class="card-wrapper card-space">
            <div class="card card-bg">
            
              <div class="card-body">
                <h3 class="card-title" style="align-text:center;">Istanze "Investimenti VII"</h3>
                      <!--
                      <div class="row">
                        <div class="col-lg-3 col-12">
                          <div class="card card-teaser rounded shadow" style="background-color: #96ceff">
                            <div class="icon">
                              <i class="fa fa-list" aria-hidden="true"></i>
                            </div>
                            <div class="card-body">
                              <h5 class="card-title">Totali</h5>
                              <div class="card-text" style="margin-top:30px;">
                                <b style="float:right;font-size: xx-large;"><?=$totalIstanze?> <small>istanze</small></b>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-12">
                          <div class="card card-teaser rounded shadow" style="background-color: #ff9c9c">
                            <div class="icon">
                              <i class="fa fa-list" aria-hidden="true"></i>
                            </div>
                            <div class="card-body">
                              <h5 class="card-title">
                              Attive
                              </h5>
                              <div class="card-text" style="margin-top:30px;">
                                <b style="float:right;font-size: xx-large;"><?=$istAttive?> <small>istanze</small></b>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-12">
                          <div class="card card-teaser rounded shadow" style="background-color: #ffe196">
                            <div class="icon"><i class="fa fa-list" aria-hidden="true"></i>
                            </div>
                            <div class="card-body">
                              <h5 class="card-title">In Rendicontazione</h5>
                              <div class="card-text" style="margin-top:30px;">
                                <b style="float:right;font-size: xx-large;"><?=$istRend?> <small>istanze</small></b>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-12">
                          <div class="card card-teaser rounded shadow" style="background-color: #96ffa1">
                            <div class="icon">
                              <i class="fa fa-list" aria-hidden="true"></i>
                            </div>
                            <div class="card-body">
                              <h5 class="card-title">In Istruttoria</h5>
                              <div class="card-text" style="margin-top:30px;">
                                <b style="float:right;font-size: xx-large;"><?=$istIstr?> <small>istanze</small></b>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-12">
                          <div class="card card-teaser rounded shadow" style="background-color: #96ffa1">
                            <div class="icon">
                              <i class="fa fa-list" aria-hidden="true"></i>
                            </div>
                            <div class="card-body">
                              <h5 class="card-title">Scadute</h5>
                              <div class="card-text" style="margin-top:30px;">
                                <b style="float:right;font-size: xx-large;"><?=$istScadute?> <small>istanze</small></b>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-12">
                          <div class="card card-teaser rounded shadow" style="background-color: #96ffa1">
                            <div class="icon">
                              <i class="fa fa-list" aria-hidden="true"></i>
                            </div>
                            <div class="card-body">
                              <h5 class="card-title">Annullate</h5>
                              <div class="card-text" style="margin-top:30px;">
                                <b style="float:right;font-size: xx-large;"><?=$istAnnullate?> <small>istanze</small></b>
                              </div>
                            </div>
                          </div>
                        </div>
                      
                      </div>
     
                      <div class="row" style="margin-top:30px;">
                        <div class="col-12 col-lg-6">
                          <div class="card card-teaser rounded shadow" >
                            <canvas id="myChart" width="400" height="200"></canvas>
                          </div>
                        </div>
                      </div>
                       -->
                       <!--
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-12 ">
          <div class="card-wrapper card-space">
            <div class="card card-bg">
            
              <div class="card-body">
                <h3 class="card-title" style="align-text:center;">Ticket Supporto</h3>

                <div class="row">
                  <div class="col-lg-3 col-12">
                    <div class="card card-teaser rounded shadow" style="background-color: #96ceff">
                    <div class="icon">
                     <i class="fa fa-paper-plane" aria-hidden="true"></i>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">
                          Totali
                        </h5>
                        <div class="card-text" style="margin-top:30px;">
                        <b style="float:right;font-size: xx-large;"><?=$totalMsg?> <small>ticket</small></b>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-12">
                    <div class="card card-teaser rounded shadow" style="background-color: #ff9c9c">
                    <div class="icon">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">
                        Nuovi
                        </h5>
                        <div class="card-text" style="margin-top:30px;">
                        <b style="float:right;font-size: xx-large;"><?=$unreadMsg?> <small> ticket</small></b>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-12">
                    <div class="card card-teaser rounded shadow" style="background-color: #ffe196">
                      <div class="icon">
                      <i class="fa fa-paper-plane" aria-hidden="true"></i>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">
                      In Lavorazione
                        </h5>
                        <div class="card-text" style="margin-top:30px;">
                    

                        <b style="float:right;font-size: xx-large;"><?=$readMsg?> <small>ticket</small></b>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-12">
                    <div class="card card-teaser rounded shadow" style="background-color: #96ffa1">
                      <div class="icon">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">Chiusi</h5>
                        <div class="card-text" style="margin-top:30px;">
                          <b style="float:right;font-size: xx-large;"><?=$closedMsg?> <small>ticket</small></b>
                        </div>
                      </div>
                    </div>
                  </div>
                
                </div>

              
              </div>
            </div>
          </div>
        </div>
      </div>
      -->
<?php
  $tipi_istanze=getTipiIstanza();

  foreach ($tipi_istanze as $ti){
    $title= $ti['des'];
    $params['search4']='';
    $params['search3']=intval($ti['id']);
    $totalIstanze= countIstanze($params);
   
    $params['search4']='A';
    $istAttive =countIstanze($params);
    $params['search4']='B';
    $istAnnullate =countIstanze($params);
    $params['search4']='C';
    $istRend =countIstanze($params);
    $params['search4']='D';
    $istIstr =countIstanze($params);
    $params['search4']='E';
    $istScadute =countIstanze($params);
    ?>
  <div class="row">
    <div class="col-12 ">
      <div class="card-wrapper card-space">
        <div class="card card-bg">
          <div class="card-body">
            <h3 class="card-title" style="align-text:center;">Istanze "<?=$title?>"</h3>
            <!--
            <div class="row">

              <div class="col-lg-2 col-12">
                <div class="card card-teaser rounded shadow" style="background-color: #96ceff">
                  <div class="icon">
                    <i class="fa fa-list" aria-hidden="true"></i>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Totali</h5>
                    <div class="card-text" style="margin-top:30px;">
                      <b style="float:right;font-size: xx-large;"><?=$totalIstanze?> <small>istanze</small></b>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-2 col-12">
                <div class="card card-teaser rounded shadow" style="background-color: #ff9c9c">
                  <div class="icon">
                    <i class="fa fa-list" aria-hidden="true"></i>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">
                    Attive
                    </h5>
                    <div class="card-text" style="margin-top:30px;">
                      <b style="float:right;font-size: xx-large;"><?=$istAttive?> <small>istanze</small></b>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-2 col-12">
                <div class="card card-teaser rounded shadow" style="background-color: #ffe196">
                  <div class="icon"><i class="fa fa-list" aria-hidden="true"></i>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">In Rendicontazione</h5>
                    <div class="card-text" style="margin-top:30px;">
                      <b style="float:right;font-size: xx-large;"><?=$istRend?> <small>istanze</small></b>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-2 col-12">
                <div class="card card-teaser rounded shadow" style="background-color: #96ffa1">
                  <div class="icon">
                    <i class="fa fa-list" aria-hidden="true"></i>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">In Istruttoria</h5>
                    <div class="card-text" style="margin-top:30px;">
                      <b style="float:right;font-size: xx-large;"><?=$istIstr?> <small>istanze</small></b>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-2 col-12">
                <div class="card card-teaser rounded shadow" style="background-color: #96ffa1">
                  <div class="icon">
                    <i class="fa fa-list" aria-hidden="true"></i>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Scadute</h5>
                    <div class="card-text" style="margin-top:30px;">
                      <b style="float:right;font-size: xx-large;"><?=$istScadute?> <small>istanze</small></b>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-2 col-12">
                <div class="card card-teaser rounded shadow" style="background-color: #96ffa1">
                  <div class="icon">
                    <i class="fa fa-list" aria-hidden="true"></i>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Annullate</h5>
                    <div class="card-text" style="margin-top:30px;">
                      <b style="float:right;font-size: xx-large;"><?=$istAnnullate?> <small>istanze</small></b>
                    </div>
                  </div>
                </div>
              </div>

            </div>
  -->

            <div class="row">
              <div class="col-md-2 col-12">
                <div class="card-counter primary">
                  <i class="fa fa-list"></i>
                  <span class="count-numbers"><?=$totalIstanze?> <small>Istanze</small></span>
                  <span class="count-name">Totali</span>
                </div>
              </div>

              <div class="col-md-2 col-12">
                <div class="card-counter success">
                  <i class="fa fa-ticket"></i>
                  <span class="count-numbers"><?=$istAttive?> <small>istanze</small></span>
                  <span class="count-name">Attive</span>
                </div>
              </div>

              <div class="col-md-2 col-12">
                <div class="card-counter warning">
                  <i class="fa fa-pencil"></i>
                  <span class="count-numbers"><?=$istRend?> <small>istanze</small></span>
                  <span class="count-name">In Rendicontazione</span>
                </div>
              </div>

              <div class="col-md-2 col-12">
                <div class="card-counter info">
                  <i class="fa fa-users"></i>
                  <span class="count-numbers"><?=$istIstr?> <small>istanze</small></span>
                  <span class="count-name">In Istruttoria</span>
                </div>
              </div>
              <div class="col-md-2 col-12">
                <div class="card-counter danger">
                  <i class="fa fa-calendar-times-o"></i>
                  <span class="count-numbers"><?=$istScadute?> <small>istanze</small></span>
                  <span class="count-name">Scadute</span>
                </div>
              </div>
              <div class="col-md-2 col-12">
                <div class="card-counter danger">
                  <i class="fa fa-times"></i>
                  <span class="count-numbers"><?=$istAnnullate?> <small>istanze</small></span>
                  <span class="count-name">Annullate</span>
                </div>
              </div>
            </div>



          </div>  
        </div>  
      </div>  
    </div>  
  </div>  

  
    <?php
  }

?>