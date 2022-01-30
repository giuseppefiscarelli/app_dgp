<?php

session_start();

require_once 'functions.php';

if(!isUserLoggedin()) {
	header('Location:index.php');
	exit;
}

require_once 'model/armatori.php';

require_once 'headerInclude.php';

?>

<div class="container my-4" style="max-width:90%">



      <?php

       require_once 'controller/displayArmatori.php' ;


      ?>

</div>
<!--End Dashboard Content-->


<?php
    require_once 'view/template/footer.php';
?>

<script>


    function getDatiArmatore(id){
       
        $.ajax({
                type: "POST",
                url: "controller/updateNavi.php?action=getArmatore",
                data: {id:id},
                dataType: "json",
                success: function(data){
                    $('#id_armatore').val(id)
                    $('#arm_rag_soc').val(data.arm_rag_soc)
                    $('#arm_cf').val(data.arm_cf)
                    $('#arm_indirizzo').val(data.arm_indirizzo)
                    $('#arm_cap').val(data.arm_cap)
                    $('#arm_citta').val(data.arm_citta)
                    $('#arm_prov').val(data.arm_prov)
                    $('#arm_cod_naz').val(data.arm_cod_naz.toUpperCase()).selectpicker("refresh");
                    $('#arm_telefono').val(data.arm_telefono)
                    $('#arm_email').val(data.arm_email)
                    $('#modalTitle').html('Dati armatore')
                    $('#modalArmatore').modal('show')
                    $('#arm_rag_soc,#arm_cf,#arm_indirizzo,#arm_cap,#arm_citta,#arm_prov,#arm_telefono,#arm_email').attr("readonly", true);
                    $('#arm_cod_naz').attr("disabled",true)
                    $('#arm_cod_naz').selectpicker("refresh");
                    $('#closeModal').html('Chiudi')
                    $('#upModal').show()
                    $('#saveModal').hide()

                }
            })
    }
    $('#upModal').on('click', function(){

        $('#arm_rag_soc,#arm_cf,#arm_indirizzo,#arm_cap,#arm_citta,#arm_prov,#arm_telefono,#arm_email').attr("readonly", false);
        $('#arm_cod_naz').attr("disabled",false)
        $('#arm_cod_naz').selectpicker("refresh");
        $('#closeModal').html('Esci senza salvare')
        $('#upModal').hide()
        $('#saveModal').show()
    });
    $('#upForm').on('submit',function(e){
        e.preventDefault();
        formData = $(this).serialize();
        console.log(formData)
        $.ajax({
                type: "POST",
                url: "controller/updateArmatori.php?action=updateArmatore",
                data: formData,
                dataType: "json",
               success: function(data){

                 if(data){
                  Swal.fire({
                    title:"Operazione Completata!",
                    html:"Dati Armatore aggiornati correttamente.",
                    icon:"success"}).then((result) => {
                        if (result.isConfirmed) {
                                    location.reload()
                        }
                    });
                 }else{
                  Swal.fire({
                    title:"Operazione Non Completata!",
                    html:"Dati Armatore non aggiornati.",
                    icon:"warning"}).then((result) => {
                        if (result.isConfirmed) {
                                    location.reload()
                        }
                    });
                 }
               }
            })

    })
    function newArmatore(){
        $('#id_armatore').val("")
        $('#arm_rag_soc').val("")
        $('#arm_cf').val("")
        $('#arm_indirizzo').val("")
        $('#arm_cap').val("")
        $('#arm_citta').val("")
        $('#arm_prov').val("")
        $('#arm_cod_naz').val("").selectpicker("refresh");
        $('#arm_telefono').val("")
        $('#arm_email').val("")
        $('#modalTitle').html('Inserimento Nuovo armatore')
        $('#modalArmatore').modal('show')
        $('#arm_rag_soc,#arm_cf,#arm_indirizzo,#arm_cap,#arm_citta,#arm_prov,#arm_telefono,#arm_email').attr("readonly", false);
        $('#arm_cod_naz').attr("disabled",false)
        $('#arm_cod_naz').selectpicker("refresh");
        $('#closeModal').html('Esci senza salvare')
        $('#upModal').hide()
        $('#saveModal').show()
    }

function downCsv(){
          
    search1 = $('#search1').val()
    var fileTitle = 'armatori';
    $.ajax({
        type: "POST",
        data:{search1:search1},
        url: "controller/updateArmatori.php?action=getArmatori",
        dataType: "json",
        success: function(data) { 
            var headers = {
                id: 'id',
                arm_rag_soc: 'Ragione Sociale'.replace(/,/g, ''), // remove commas to avoid errors
                arm_cf: "Codice Fiscale",
                arm_indirizzo: "Indirizzo".replace(/,/g, ''),
                arm_cap: "Cap",
                arm_citta: "Città",
                arm_prov: "Provincia",
                arm_cod_naz: "Nazione",
                arm_telefono: "Telefono",
                arm_email: "Email",
                arm_note: "Telefono",
            };
            exportCSVFile(headers, data, fileTitle);
        }
    });

}
function convertToCSV(objArray) {
var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
var str = '';

for (var i = 0; i < array.length; i++) {
    var line = '';
    for (var index in array[i]) {
        if (line != '') line += ','

        line += array[i][index];
    }

    str += line + '\r\n';
}

return str;
}
headers = null;
function exportCSVFile(headers, items, fileTitle) {
if (headers) {
    items.unshift(headers);
}

// Convert Object to JSON
var jsonObject = JSON.stringify(items);

var csv = this.convertToCSV(jsonObject);

var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
if (navigator.msSaveBlob) { // IE 10+
    navigator.msSaveBlob(blob, exportedFilenmae);
} else {
    var link = document.createElement("a");
    if (link.download !== undefined) { // feature detection
        // Browsers that support HTML5 download attribute
        var url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", exportedFilenmae);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
       
    }
}
}
</script>
</body>
</html>
