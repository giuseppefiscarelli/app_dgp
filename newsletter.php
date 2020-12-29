<?php
session_start();
require_once 'functions.php';

if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}

require_once 'model/comunicazioni.php';
$updateUrl = 'controller/updateComunicazioni.php';
//$deleteUrl = 'controller/updateIstanze.php';
require_once 'headerInclude.php';
?>

<div class="container my-4" style="max-width:90%">
 

    
      <?php
     
       require_once 'controller/displayComunicazioni.php' ;
          

      ?>
      
</div>    
<!--End Dashboard Content-->

<?php
    require_once 'view/template/footer.php';
?>
<script type="text/javascript">
  function infomsg(id){

    $.ajax({
          type: "POST",
          url: "controller/updateComunicazioni.php?action=getMsg",
          data: {id:id},
          dataType: "json",
          success: function(data){
            console.log(data);
            $('#msginfoModal').modal('toggle');
            $('#id_info').html(data.id);
            $('#data_ins_info').html(data.data_ins);
            $('#tipo_info').html(data.tipo);
            $('#testo_info').html(data.testo);
            $('#stato_info').html(data.stato);


               
          }
                                  
          
    })


  }
  function infomsgAd(id){

    $.ajax({
          type: "POST",
          url: "controller/updateComunicazioni.php?action=getMsg",
          data: {id:id},
          dataType: "json",
          success: function(data){
            console.log(data);
            $('#msginfoModal').modal('toggle');
            $('#id_info').html(data.id);
            $('#data_ins_info').html(data.data_ins);
            $('#tipo_info').html(data.tipo);
            $('#testo_info').html(data.testo);
            $('#stato_info').html(data.stato);
            $('#gotomsg').attr('href','comunicazione.php?id='+data.id);
            if(data.read_msg == 0){
              $('#gotomsg').html('Prendi in carico');

            }else{
              $('#gotomsg').html('Vedi dettaglio');
            }


              
          }
                                  
          
    })


}
</script>
</body>
</html>    