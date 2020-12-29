<?php
session_start();
require_once 'functions.php';

if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}

require_once 'model/comunicazioni.php';
$updateUrl = 'controller/updateComunicazioni.php';
$deleteUrl = 'controller/updateComunicazioni.php';
require_once 'headerInclude.php';
?>
<style>
.it-datepicker-wrapper {
    position: relative;
    margin-top: 50px;
}
.avatar{
    background: #979899;
}
</style>
<div class="container my-4" style="max-width:90%">
 

    
      <?php
     
       require_once 'controller/displayComunicazione.php' ;
          

      ?>
      
</div>    
<!--End Dashboard Content-->

<?php
    require_once 'view/template/footer.php';
?>



</body>
</html>    