
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
      ?>
      <div class="container my-4">

      <h3>Benvenuto Ragione Sociale S.r.l</h3>
      <h4>Per visualizzare Le Istanze, Clicca su "Le Mie Istanze"</h4>
        <div class="it-carousel-wrapper it-carousel-landscape-abstract">
          <div class="it-carousel-all owl-carousel" >
            <div class="it-single-slide-wrapper" >
              <a href="#">
                <div class="img-responsive-wrapper">
                  <div class="img-responsive">
                    <div class="img-wrapper"><img src="images/img1.jpg" title="img title" alt="ima1"></div>
                  </div>
                </div>
              </a>
              <div class="it-text-slider-wrapper-outside">
                <div class="card-wrapper">
                  <div class="card">
                    <div class="card-body">
                      <div class="category-top" style="display:none;">
                        <!-- category heading--><a class="category" href="#">Category</a>
                        <!-- category data--><span class="data">10/12/2018</span>
                      </div>
                      <h5 class="card-title big-heading">Decreto del Ministero delle infrastrutture e dei trasporti n. 203 del 12 maggio 2020</h5>
                      <h4 class="card-title big-heading">       Incentivo agli investimenti nel settore dell’autotrasporto</h4>
                      <p style="text-align:justify;"class="card-text">Il D.M. 12 maggio 2020 n. 203, recante modalità di erogazione dei contributi a favore degli investimenti delle imprese di autotrasporto, per l'annualità 2020, è stato pubblicato nella Gazzetta Ufficiale Serie Generale n. 187 del 27 luglio 2020. Il connesso Decreto direttoriale prot. 145 del 07 agosto 2020 recante disposizioni di attuazione del suddetto D.M. 203/2020 è stato pubblicato nella Gazzetta Ufficiale Serie Generale n. 206 del 19 agosto 2020.</p>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
          </div>
        </div>

<button type="button" onclick="prova();" class="btn btn-primary btn-lg btn-block"></button>



<script>
function prova(){
 
  Swal.fire(
                                                                  'Rendicontazione Chiusa!',
                                                                  'La rendicontazione è stata chiusa correttamente.',
                                                                  'success'
                                                            ).then((result) => {
                                                                               if (result.isConfirmed) {
                                                                                          location.href='home.php'
                                                                              }
                                                                  })
    

}
</script>


<form id="test">
<div class="bootstrap-select-wrapper">
  <label>Etichetta</label>
  <select title="Scegli una opzione" id="testselect"required="required">
    <option value="Value 1">Opzione 1</option>
    <option value="Value 2">Opzione 2</option>
    <option value="Value 3">Opzione 3</option>
    <option value="Value 4">Opzione 4</option>
    <option value="Value 5">Opzione 5</option>
  </select>
</div>


<button type="submit" name="" id="testbtn" onclick="testbtn();"class="btn btn-primary btn-lg btn-block"></button>
</form>

      </div>
      
     
   <!-- JS -->
<script src="assets/js/bootstrap-italia.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

<script type="text/javascript">
        $( document ).ready(function() {
            $('#message').delay(3000).fadeOut();
        });
   
$('#testbtn').on('click', function(){

val= $('#testselect option:selected').val()

if(val==""){
  alert(val);
  return false;
  break;
}

})
</script> 
  </body>
  <script>
  
  
$(document).ready(function() {

  $(".owl-carousel").owlCarousel();
  var owl = $('.owl-carousel');

owl.trigger('play.owl.autoplay',[8000])

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu','Lug','Ago','Set','Ott','Nov','Dic'],
        datasets: [{
            label: 'Fondo Residuo (dimostrativo)',
            data: [12000000, 11800000, 11600000, 11000000, 10800000, 10800000,10800000, 10700000, 10700000, 10200000, 10200000, 10000000],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


});
  </script>
</html>