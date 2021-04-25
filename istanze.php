<?php
session_start();
require_once 'functions.php';

if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}

require_once 'model/istanze.php';
$deleteUrl = 'controller/updateIstanze.php';
require_once 'headerInclude.php';
?>
<div id="loadSpin">
          <div class="d-flex justify-content-center" >
              <p style="position:absolute;"><strong>Caricamento in corso...</strong></p>
                <div class="progress-spinner progress-spinner-active" style="margin-top:30px;">
                <span class="sr-only">Caricamento...</span>
                </div>
            </div>
        </div>


<div class="container my-4" style="max-width:90%">
<?php require_once 'controller/displayIstanze.php' ;?>
</div>    
<!--End Dashboard Content-->
<?php  require_once 'view/template/footer.php'; ?>
<script>

$( document ).ready(function() {
  $('#loadSpin').fadeOut("slow")
});
</script>
</body>
</html>    