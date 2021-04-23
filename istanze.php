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

<div class="container my-4" style="max-width:90%">
<?php require_once 'controller/displayIstanze.php' ;?>
</div>    
<!--End Dashboard Content-->
<?php  require_once 'view/template/footer.php'; ?>

</body>
</html>    