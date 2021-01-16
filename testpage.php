
<?php

session_start();
require_once 'functions.php';
require_once 'view/template/top.php';

?>
  <body>
        <div class="it-header-slim-wrapper">
            <div class="container">
              <div class="row">
                  <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                   
                        <a class="d-none d-lg-block navbar-brand" href="#"></a>
                        <div class="nav-mobile">
                          <nav>
                              <a class="it-opener d-lg-none" data-toggle="collapse" href="#menu1" role="button" aria-expanded="false" aria-controls="menu1">
                                <span>Ente appartenenza/Owner</span>
                                <svg class="icon">
                                    <use xlink:href="svg/sprite.svg#it-expand"></use>
                                </svg>
                              </a>
                              
                          </nav>
                        </div>
                        <div class="it-header-slim-right-zone">
                          <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                            <span>Ita</span>
                            <svg class="icon d-none d-lg-block">
                                <use xlink:href="svg/sprite.svg#it-expand"></use>
                            </svg>
                            </a>
                            <div class="dropdown-menu">
                              <div class="row">
                                  <div class="col-12">
                                    <div class="link-list-wrapper">
                                        <ul class="link-list">
                                        <li><a class="list-item" href="#"><span>ITA</span></a></li>
                                        <li><a class="list-item" href="#"><span>ENG</span></a></li>
                                        </ul>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="it-access-top-wrapper">
                              <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalLong">Accedi</a>
                          </div>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
           
  
                  <!-- Modal -->
 
                  <div class="modal fade" tabindex="-1" role="dialog" id="exampleModalLong">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Accedi ad area riservata</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <svg class="icon">
                                <use xlink:href="svg/sprite.svg#it-close"></use>
                            </svg>
                          </button>
                        </div>
                        <form style="margin-top:40px" action="verify-login.php" method="post">
                        <div class="modal-body">
                       
                              <input type="hidden" name="_csrf" value="<?=$token?>">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Email</label>
                                  <input type="email" class="form-control" id="email" name="email"aria-describedby="emailHelp" placeholder="Inserisci email">
                                  <small id="emailHelp" class="form-text text-muted">PEC utilizzata per la richiesta.</small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                              
                                
                          
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-outline-primary btn-sm" type="button" data-dismiss="modal">Annulla</button>
                          <button class="btn btn-primary btn-sm" type="submit">Accedi</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
        </div>
        <div class="it-header-center-wrapper ">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <div class="it-header-center-content-wrapper" >
                    <div class="it-brand-wrapper" style="min-width: -webkit-fill-available;">
                      <div class="row">
                        <a href="#">
                          <img src="images/logo.svg" alt="Home" style="max-height: -webkit-fill-available;    padding: 7px;">
                          <div class="it-brand-text">
                            <h2 class="no_toc">Ministero
                            </h2>
                            <h3 class="no_toc  d-md-block"> delle Infrastrutture e dei Trasporti</h3>
                          </div>
                          <div style="padding: 20px;">
                           <img src="images/logo-ram-2018.png" alt="Home" style="max-height: -webkit-fill-available;">
                          </div>
                        </a>
                      
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
        </div>
        <?php

//var_dump($_SESSION);
if(!empty($_SESSION['message'])){
    
    $message = $_SESSION['message'];
    $alertType ='danger';
    
    require 'view/template/message.php';
    unset($_SESSION['message'],$_SESSION['success']);
  } 

  require_once $_SERVER['DOCUMENT_ROOT'] . '/test/vendor/autoload.php';
  use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
 // require 'vendor/autoload.php';
 $html2pdf = new Html2Pdf();
 $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
 $html2pdf->output();
      ?>
  
      
     
   <!-- JS -->
<script src="assets/js/bootstrap-italia.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>


  </body>
  
</html>