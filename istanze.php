<?php
session_start();
require_once 'functions.php';

if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}

require_once 'model/istanze.php';
//$updateUrl = 'userUpdate.php';
$deleteUrl = 'controller/updateIstanze.php';
require_once 'headerInclude.php';
?>

<div class="container my-4" style="max-width:90%">
 

    
      <?php
     
       require_once 'controller/displayIstanze.php' ;
          

      ?>
      
</div>    
<!--End Dashboard Content-->

<?php
    require_once 'view/template/footer.php';
?>
<script type="text/javascript">
  const formatter = new Intl.NumberFormat('it-IT', {
                  style: 'currency',
                  currency: 'EUR',
                  minimumFractionDigits: 2
            })
  function infoIstanza(id){

    $('#infoModal').modal('toggle');
    $.ajax({
                        type: "POST",
                        url: "controller/updateIstanze.php?action=getIstanza",
                        data: {id:id},
                        dataType: "json",
                        success: function(data){
                          console.log(data);
                          $('#info_cognome').html(data.cognome);
                          $('#info_nome').html(data.nome);
                          $('#info_data_nascita').html(data.data_nascita);
                          $('#info_luogo_nascita').html(data.luogo_nascita);
                          $('#info_indirizzo_residenza').html(data.indirizzo_residenza);
                          $('#info_comune_residenza').html(data.comune_residenza);
                          $('#info_email_richiedente').html(data.email_richiedente);
                          $('#info_tipo').html(data.tipo);

                          $('#info_ragione_sociale').html(data.ragione_sociale);
                          $('#info_piva').html(data.piva); 
                          $('#info_cf').html(data.cf);
                          $('#info_indirizzo_impresa').html(data.indirizzo_impr);
                          $('#info_comune_impresa').html(data.comune_impr);
                          $('#info_email_impr').html(data.email_impr);
                          $('#info_pec_impr').html(data.pec_impr);
                          $('#info_tel_impr').html(data.tel_impr); 
                          
                          $('#info_tipo_impresa').html(data.tipo_impresa);
                          $('#info_codice_albo').html(data.codice_albo);
                          $('#info_codice_ren').html(data.codice_ren);
                          $('#info_cciaa').html(data.cciaa);
                          $('#info_codice_ateco').html(data.codice_ateco);
                          $('#info_banca').html(data.banca);
                          if(data.pmi=="Yes"){data.pmi="Presente"}else{data.pmi="Non Presente"}
                          if(data.rete=="Yes"){data.rete="Presente"}else{data.rete="Non Presente"}
                          $('#info_pmi').html(data.pmi);
                          $('#info_rete').html(data.rete);
                          formatter.format(data.costo)
                          $('#info_nv1').html(data.nv1);
                          $('#info_sp1').html(formatter.format(data.sp1));
                          if(data.rott1=="Off"){data.rott1=" Non Presente"}
                          $('#info_rott1').html(data.rott1);
                          $('#info_nv2').html(data.nv2);
                          $('#info_sp2').html(formatter.format(data.sp2));
                          if(data.rott2=="Off"){data.rott2=" Non Presente"}
                          $('#info_rott2').html(data.rott2);
                          $('#info_nv3').html(data.nv3);
                          $('#info_sp3').html(formatter.format(data.sp3));
                          if(data.rott3=="Off"){data.rott3=" Non Presente"}
                          $('#info_rott3').html(data.rott3);
                          $('#info_nv4').html(data.nv4);
                          $('#info_sp4').html(formatter.format(data.sp4));
                          if(data.rott4=="Off"){data.rott4=" Non Presente"}
                          $('#info_rott4').html(data.rott4);
                          $('#info_nv5').html(data.nv5);
                          $('#info_sp5').html(formatter.format(data.sp5));
                          if(data.rott5=="Off"){data.rott5=" Non Presente"}
                          $('#info_rott5').html(data.rott5);
                          $('#info_nv6').html(data.nv6);
                          $('#info_sp6').html(formatter.format(data.sp6));
                          if(data.rott6=="Off"){data.rott6=" Non Presente"}
                          $('#info_rott6').html(data.rott6);
                          $('#info_nv7').html(data.nv7);
                          $('#info_sp7').html(formatter.format(data.sp7));
                          if(data.rott7=="Off"){data.rott7=" Non Presente"}
                          $('#info_rott7').html(data.rott7);
                          $('#info_nv8').html(data.nv8);
                          $('#info_sp8').html(formatter.format(data.sp8));
                          if(data.rott8=="Off"){data.rott8=" Non Presente"}
                          $('#info_rott8').html(data.rott8);
                          $('#info_nv9').html(data.nv9);
                          $('#info_sp9').html(formatter.format(data.sp9));
                          if(data.rott9=="Off"){data.rott9=" Non Presente"}
                          $('#info_rott9').html(data.rott9);
                          $('#info_nv10').html(data.nv10);
                          $('#info_sp10').html(formatter.format(data.sp10));
                          if(data.rott10=="Off"){data.rott10=" Non Presente"}
                          $('#info_rott10').html(data.rott10);
                          $('#info_nv11').html(data.nv11);
                          $('#info_sp11').html(formatter.format(data.sp11));

                          $('#info_r_nv_1').html(data.r_nv_1);
                          $('#info_r_sp_1').html(formatter.format(data.r_sp_1));
                          $('#info_r_rott_1').html(data.r_rott_1);
                          $('#info_r_nv_2').html(data.r_nv_2);
                          $('#info_r_sp_2').html(formatter.format(data.r_sp_2));
                          $('#info_r_rott_2').html(data.r_rott_2);
                          $('#info_r_nv_3').html(data.r_nv_3);
                          $('#info_r_sp_3').html(formatter.format(data.r_sp_3));
                          $('#info_r_rott_3').html(data.r_rott_3);
                          $('#info_nr_1').html(data.nr_1);
                          $('#info_spr_1').html(formatter.format(data.spr_1));
                          $('#info_nr_2').html(data.nr_2);
                          $('#info_spr_2').html(formatter.format(data.spr_2));
                          $('#info_ng_1').html(data.ng_1);
                          $('#info_spg_1').html(formatter.format(data.spg_1));


                           
                        }
                                                          
                        
                  })


  }

</script>
</body>
</html>    