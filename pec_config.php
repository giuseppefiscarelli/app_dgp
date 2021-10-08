<?php
session_start();
require_once 'functions.php';

if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}

require_once 'model/pec.php';
$updateUrl = 'controller/updatePec.php';
//$deleteUrl = 'controller/updateIstanze.php';
require_once 'headerInclude.php';
?>

<div class="container my-4" style="max-width:90%">
 

    
      <?php
     
       require_once 'controller/displayConfig_pec.php' ;
          

      ?>
      
</div>    
<!--End Dashboard Content-->

<?php
    require_once 'view/template/footer.php';
?>

</body>
</html>    