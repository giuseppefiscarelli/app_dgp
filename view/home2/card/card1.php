<div class="row">
        <div class="col-12 ">
          <div class="card-wrapper card-space">
            <div class="card card-bg">
            
              <div class="card-body">
                <h3 class="card-title" style="align-text:center;">Istanze "<?=$ti['des']?>"</h3>

                <div class="row">
                  <div class="col-lg-4 col-12" style="cursor:pointer;" onclick="location.href='istanze.php';">
                    <div class="card card-teaser rounded shadow" style="background-color: #a6630073;">
                    <div class="icon">
                      <i class="fa fa-list" aria-hidden="true"></i>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">
                          Totali
                        </h5>
                        <div class="card-text" style="margin-top:30px;">
                          <b style="float:right;font-size: xx-large;"><?=$istTotali?> <small>istanze</small></b>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-12" style="cursor:pointer;" onclick="location.href='istanze.php?page=1&search1=&search2=&search3=&search4=A&recordsPerPage=10';">
                    <div class="card card-teaser rounded shadow" style="background-color: #ffc107">
                      <div class="icon">
                        <i class="fa fa-list" aria-hidden="true"></i>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">
                        Attive
                        </h5>
                        <div class="card-text" style="margin-top:30px;">
                          <b style="float:right;font-size: xx-large;"><?=$totalIstanze?> <small>istanze</small></b>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-12" style="cursor:pointer;" onclick="location.href='istanze.php?page=1&search1=&search2=&search3=&search4=C&recordsPerPage=10';">
                    <div class="card card-teaser rounded shadow" style="background-color: #0066ccb5">
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
                  <div class="col-lg-4 col-12" style="margin-top:10px;cursor:pointer;" onclick="location.href='istanze.php?page=1&search1=&search2=&search3=&search4=D&recordsPerPage=10';">
                    <div class="card card-teaser rounded shadow" style="background-color: #0087588f">
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
                  <div class="col-lg-4 col-12" style="margin-top:10px;cursor:pointer;" onclick="location.href='istanze.php?page=1&search1=&search2=&search3=&search4=B&recordsPerPage=10';">
                    <div class="card card-teaser rounded shadow" style="background-color: #d9364fc2">
                      <div class="icon">
                        <i class="fa fa-list" aria-hidden="true"></i>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">Annullate</h5>
                        <div class="card-text" style="margin-top:30px;">
                          <b style="float:right;font-size: xx-large;"><?=$annIstr?> <small>istanze</small></b>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                  if($ti['data_rendicontazione_fine']<date("Y-m-d H:i:s")){?>

                  
                  <div class="col-lg-4 col-12" style="margin-top:10px;cursor:pointer;" onclick="location.href='istanze.php?page=1&search1=&search2=&search3=&search4=E&recordsPerPage=10';">
                    <div class="card card-teaser rounded shadow" style="background-color:#d936b9c2">
                      <div class="icon">
                        <i class="fa fa-list" aria-hidden="true"></i>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title">Scadute</h5>
                        <div class="card-text" style="margin-top:30px;">
                          <b style="float:right;font-size: xx-large;"><?=$scaIstr?> <small>istanze</small></b>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                </div>

                <div class="row" style="margin-top:30px;">
                  <div class="col-12 col-lg-6">
                    <div class="card card-teaser rounded shadow" >
                      <canvas id="myChart" width="400" height="200"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>