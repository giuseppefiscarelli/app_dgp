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
     
       require_once 'controller/displayPec.php' ;
          

      ?>
      
</div>    
<!--End Dashboard Content-->

<?php
    require_once 'view/template/footer.php';
?>
<script>
   $(document).ready(function(){
      var currentTab = localStorage.getItem('currentTab');
      console.log(currentTab); 
      if (currentTab) {
            $('a[href="' + currentTab + '"]').tab('show');
      }
   })
 function showTipo(tipo,des){
    $("[class*='tiporeport_']").hide();
     if(tipo ==0){
        $("[class*='tiporeport_']").show(); 
        $('#info_tipo').html(des)
     }else{
        showtipo = 'tiporeport_'+tipo
        $("."+showtipo).show()
        $('#info_tipo').html(des)
     }
    
   

 }
 function showUser(user){
    $("[class*='userins_']").hide();
     if(user ==0){
        $("[class*='userins_']").show(); 
        $('#info_user').html('Tutti')
     }else{
        showuser = 'userins_'+user
        $("."+showuser).show()
        $('#info_user').html(user)
     }

 }
 function unsendCkAll(){

    $('.unsend').prop('checked', true);
    $('#selAll').attr('onclick', 'unsendunCkAll();')
 }
 function unsendunCkAll(){

$('.unsend').prop('checked', false);
$('#selAll').attr('onclick', 'unsendCkAll();')
}
 function showEd(type){
   $("[class*='edizione_']").hide();
   if(type == 0){
      $("[class*='edizione_']").show();
   }else{
      typeEd = 'edizione_'+type;
      $("."+typeEd).show();
   }
 }
</script>
</body>
</html>    