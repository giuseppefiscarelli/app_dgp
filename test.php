<?php
session_start();
require_once 'functions.php';

if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}

require_once 'model/test.php';
//$updateUrl = 'userUpdate.php';
//$deleteUrl = 'controller/updateIstanze.php';
require_once 'headerInclude.php';
?>
<style>
.btn, .btn-icon{


}
</style>
<div class="container my-4" style="max-width:90%">
 

    
      <?php
     
    //   require_once 'controller/displayIstanze.php' ;
    require_once 'controller/displayTest.php' ;
          

      ?>
      
</div>    
<!--End Dashboard Content-->

<?php
    require_once 'view/template/footer.php';
?>

</body>
</html>    