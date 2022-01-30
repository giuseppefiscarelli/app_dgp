<?php

session_start();

require_once 'functions.php';

if(!isUserLoggedin()) {
	header('Location:index.php');
	exit;
}

require_once 'model/navi.php';

require_once 'headerInclude.php';

?>

<div class="container my-4" style="max-width:90%">



      <?php

       require_once 'controller/displayNavi.php' ;


      ?>

</div>
<!--End Dashboard Content-->


<?php
    require_once 'view/template/footer.php';
?>

<script>
 $(document).ready(function() {
            $('.it-date-datepicker').datepicker({
              inputFormat: ["dd/MM/yyyy"],
            outputFormat: 'dd/MM/yyyy',
            
            });
  
      });
$('#certModal').on('shown.bs.modal', function() { 
  $('#nav_nome,#nav_call_sign, #nav_imo,#nav_anno_costruzione,#nav_cantiere,#nav_num_iscrizione,#nav_uffico_prec,#note,#nav_provenienza,#nav_nome_prec,#nav_gt,#nav_lung,#nav_nt,#nav_larg,#nav_dwt,#nav_power,#note,#nav_atto_naz,#nav_luogo_rilascio,#nav_data_rilascio,#nav_motivo_rilascio').attr("readonly", true);
  $('#nav_registro,#nav_servizio,#nav_sezione,#nome,#nav_bandiera_prec,#nav_id_armatore,#nav_id_proprietario,#radio1,#radio2').attr("disabled",true)
  $('#nav_registro,#nav_servizio,#nav_sezione,#nome,#nav_bandiera_prec,#nav_id_armatore,#nav_id_proprietario,#radio1,#radio2').selectpicker("refresh")
  $('#closeModal').html('Chiudi')
  $('#upModal').show()
  $('#saveModal').hide()
});
function getDatiNave(id){
    $('#certTab >tbody').empty()
    $.ajax({
        type: "POST",
        url: "controller/updateNavi.php?action=getDatiNave",
        data: {id:id},
        dataType: "json",
        success: function(data){
           // console.log(data)
            $('#certModal').modal('toggle');
            $('#naviModalTitle').text('Scheda Anagrafica Nave '+data.nav_nome);
         /*   $.each(data, function(k,v){
              $(k).val(v)
            
            })*/
            $('#idnave').val(id)
            $('#nav_nome').val(data.nav_nome)
            $('#nav_call_sign').val(data.nav_call_sign)
            $('#nav_imo').val(data.nav_imo)
            $('#nav_anno_costruzione').val(data.nav_anno_costruzione)
            $('#nav_cantiere').val(data.nav_cantiere)
            $('#nav_registro').val(data.nav_registro).selectpicker("refresh");
            $('#nav_sezione').val(data.nav_sezione).selectpicker("refresh");
            $('#nav_cantiere_nazione').val(data.nav_cantiere_nazione.toUpperCase()).selectpicker("refresh");
            $('#nav_servizio').val(data.nav_servizio).selectpicker("refresh");
            
            $('#nome').val(data.nome).selectpicker("refresh");
            $('#nav_num_iscrizione').val(data.nav_num_iscrizione)
            
            $('#nav_bandiera_prec').val(data.nav_bandiera_prec).selectpicker("refresh");
            $('#nav_uffico_prec').val(data.nav_uffico_prec)
            $('#nav_provenienza').val(data.nav_provenienza)
            $('#nav_nome_prec').val(data.nav_nome_prec)

            $('#nav_gt').val(data.nav_gt)
            $('#nav_lung').val(data.nav_lung)
            $('#nav_nt').val(data.nav_nt)
            $('#nav_larg').val(data.nav_larg)
            $('#nav_dwt').val(data.nav_dwt)
            $('#nav_power').val(data.nav_power)
            $('#nav_atto_naz').val(data.nav_atto_naz)
           
            $('#nav_id_armatore').val(data.nav_id_armatore).selectpicker("refresh");
            $('#nav_id_proprietario').val(data.nav_id_proprietario).selectpicker("refresh");
            

            $('#note').text(data.note)
            const options = {  year: 'numeric', month: '2-digit', day: '2-digit' };
            datacancellazione = data.nav_data_cancellazione ? new Date(data.nav_data_cancellazione).toLocaleDateString('it-IT', options) : null;           
            dataiscrizione =  data.nav_data_iscrizione ?  new Date(data.nav_data_iscrizione).toLocaleDateString('it-IT', options) : null;
            $('#nav_data_cancellazione').val(datacancellazione)
            $('#nav_data_iscrizione').val(dataiscrizione)
            selectArmatore()
            selectProprietario()
            $("input[name=nav_tipo_atto][value=" + data.nav_tipo_atto + "]").prop('checked', true);
            if(data.nav_tipo_atto == 'N'){
              $('#passavantiDiv').hide()
            }else{
              $('#passavantiDiv').show()
            }
            $('#nav_luogo_rilascio').val(data.nav_luogo_rilascio)
            datarilascio = data.nav_data_rilascio ? new Date(data.nav_data_rilascio).toLocaleDateString('it-IT', options) : null;
            $('#nav_data_rilascio').val(datarilascio)
            $('#nav_motivo_rilascio').val(data.nav_motivo_rilascio)
           



        }
    })
}

$('#nav_id_proprietario').on('change' , function(){
  
  selectProprietario()
})
$('#nav_id_armatore').on('change' , function(){
  selectArmatore()
})

$(':radio[name="nav_tipo_atto"]').change(function() {
  var type = $(this).filter(':checked').val();
  if(type == 'N'){
    $('#passavantiDiv').hide()
  }else{
    $('#passavantiDiv').show()
  }
});
function selectProprietario(){
  val = $('#nav_id_proprietario option:selected').val()
  console.log(val)
  if(val){
      $.ajax({
            type: "POST",
            url: "controller/updateNavi.php?action=getProprietario",
            data: {id:val},
            dataType: "json",
            success: function(data){
              
              
                $('#prp_cf').val(data.prp_cf)
                $('#prp_indirizzo').val(data.prp_indirizzo)
                $('#prp_cap').val(data.prp_cap)
                $('#prp_citta').val(data.prp_citta)
                $('#prp_prov').val(data.prp_prov)
                $('#prp_cod_naz').val(data.prp_cod_naz).selectpicker("refresh");
                $('#prp_telefono').val(data.prp_telefono)
                $('#prp_email').val(data.prp_email)
            }
      })
  }
}
function selectArmatore(){
  val = $('#nav_id_armatore option:selected').val()
  console.log(val)
  $.ajax({
        type: "POST",
        url: "controller/updateNavi.php?action=getArmatore",
        data: {id:val},
        dataType: "json",
        success: function(data){
           
            $('#arm_cf').val(data.arm_cf)
            $('#arm_indirizzo').val(data.arm_indirizzo)
            $('#arm_cap').val(data.arm_cap)
            $('#arm_citta').val(data.arm_citta)
            $('#arm_prov').val(data.arm_prov)
            $('#arm_cod_naz').val(data.arm_cod_naz.toUpperCase()).selectpicker("refresh");
            $('#arm_telefono').val(data.arm_telefono)
            $('#arm_email').val(data.arm_email)
        }
      })
}

$('#upModal').on('click', function(){
  $('#nav_nome,#nav_call_sign, #nav_imo,#nav_anno_costruzione,#nav_cantiere,#nav_num_iscrizione,#nav_uffico_prec,#note,#nav_provenienza,#nav_nome_prec,#nav_gt,#nav_lung,#nav_nt,#nav_larg,#nav_dwt,#nav_power,#nav_atto_naz,#nav_luogo_rilascio,#nav_data_rilascio,#nav_motivo_rilascio').attr("readonly", false);
  $('#nav_registro,#nav_servizio,#nav_sezione,#nome,#nav_bandiera_prec,#nav_id_armatore,#nav_id_proprietario,#radio1,#radio2').attr("disabled",false)
  $('#nav_registro,#nav_servizio,#nav_sezione,#nome,#nav_bandiera_prec,#nav_id_armatore,#nav_id_proprietario,#radio1,#radio2').selectpicker("refresh")
  $('#closeModal').html('Esci senza salvare')
  $('#upModal').hide()
  $('#saveModal').show()
})

$('#navform').on('submit',function(e){
  e.preventDefault();
            formData = $(this).serialize();
            console.log(formData)
            $.ajax({
                type: "POST",
                url: "controller/updateNavi.php?action=updateNave",
                data: formData,
                dataType: "json",
               success: function(data){

                 if(data){
                  Swal.fire({
                    title:"Operazione Completata!",
                    html:"Dati Nave aggiornati correttamente.",
                    icon:"success"}).then((result) => {
                        if (result.isConfirmed) {
                                    location.reload()
                        }
                    });
                 }else{
                  Swal.fire({
                    title:"Operazione Non Completata!",
                    html:"Dati Nave non aggiornati .",
                    icon:"warning"}).then((result) => {
                        if (result.isConfirmed) {
                                    location.reload()
                        }
                    });
                 }
               }
            })


})

function newNave(){
  $('#certModal').modal('toggle');
            $('#naviModalTitle').text('Inserimento Anagrafica Nave ');
            /*   $.each(data, function(k,v){
              $(k).val(v)
            
            })*/
            $('#idnave').val("")
            $('#nav_nome').val("")
            $('#nav_call_sign').val("")
            $('#nav_imo').val("")
            $('#nav_anno_costruzione').val("")
            $('#nav_cantiere').val("")
            $('#nav_registro').val("").selectpicker("refresh");
            $('#nav_sezione').val("").selectpicker("refresh");
            $('#nav_cantiere_nazione').val("").selectpicker("refresh");
            $('#nav_servizio').val("").selectpicker("refresh");
            $('#nome').val("").selectpicker("refresh");
            $('#nav_num_iscrizione').val("")
            $('#nav_bandiera_prec').val("").selectpicker("refresh");
            $('#nav_uffico_prec').val("")
            $('#nav_provenienza').val("")
            $('#nav_nome_prec').val("")
            $('#nav_gt').val("")
            $('#nav_lung').val("")
            $('#nav_nt').val("")
            $('#nav_larg').val("")
            $('#nav_dwt').val("")
            $('#nav_power').val("")
            $('#nav_atto_naz').val("")
            $('#nav_id_armatore').val("").selectpicker("refresh");
            $('#nav_id_proprietario').val("").selectpicker("refresh");
            $('#note').text("")
            $('#nav_data_cancellazione').val("")
            $('#nav_data_iscrizione').val("")
            $('#nav_luogo_rilascio').val("")
            $('#nav_data_rilascio').val("")
            $('#nav_motivo_rilascio').val("")
              setTimeout(() => {
                $('#nav_nome,#nav_call_sign, #nav_imo,#nav_anno_costruzione,#nav_cantiere,#nav_num_iscrizione,#nav_uffico_prec,#note,#nav_provenienza,#nav_nome_prec,#nav_gt,#nav_lung,#nav_nt,#nav_larg,#nav_dwt,#nav_power,#nav_atto_naz,#nav_luogo_rilascio,#nav_data_rilascio,#nav_motivo_rilascio').attr("readonly", false);
  $('#nav_registro,#nav_servizio,#nav_sezione,#nome,#nav_bandiera_prec,#nav_id_armatore,#nav_id_proprietario,#radio1,#radio2').attr("disabled",false)
  $('#nav_registro,#nav_servizio,#nav_sezione,#nome,#nav_bandiera_prec,#nav_id_armatore,#nav_id_proprietario,#radio1,#radio2').selectpicker("refresh")
  $('#closeModal').html('Esci senza salvare')
  $('#upModal').hide()
  $('#saveModal').show()
              }, 500);

        
}

function enableAdd(){

  
}


/*
  function getServiziNave(){

    $.ajax({
          type: "POST",
          url: "controller/updateNavi.php?action=getServizi",
          dataType: "json",
          success: function(data){
            console.log(data);
            $('#msginfoModal').modal('toggle');
            $('#id_info').html(data.id);
            $('#data_ins_info').html(data.data_ins);
            $('#tipo_info').html(data.tipo);
            $('#testo_info').html(data.testo);
            $('#stato_info').html(data.stato+' da '+data.user_info+' il '+data.data_info);

            $('#gotomsg').attr('href','comunicazione.php?id='+data.id);
            if(data.read_msg == 0){
              $('#gotomsg').html('Prendi in carico');

            }else{
              $('#gotomsg').html('Vedi dettaglio');
            }



          }


    })


}

*/


$("#selettorenave").on('change','click', function() {
  var nave_scelta = $("#selettorenave option:selected").val();
  alert ('selezionata: '+ nave_scelta);// do something...
})
/*
$('#Mailbox').on("click", function () {
  var mailbox_scelta = $('#Mailbox').val();
  alert ('selezionata: '+ mailbox_scelta);// do something...
})
*/




</script>
</body>
</html>
