<?php

session_start();

require_once 'functions.php';

if(!isUserLoggedin()) {
	header('Location:index.php');
	exit;
}

require_once 'model/proprietari.php';

require_once 'headerInclude.php';

?>

<div class="container my-4" style="max-width:90%">



      <?php

       require_once 'controller/displayProprietari.php' ;


      ?>

</div>
<!--End Dashboard Content-->


<?php
    require_once 'view/template/footer.php';
?>

<script>
    function getDatiProprietario(id){
       
       $.ajax({
               type: "POST",
               url: "controller/updateNavi.php?action=getProprietario",
               data: {id:id},
               dataType: "json",
               success: function(data){
                   $('#id_proprietario').val(id)
                   $('#prp_rag_soc').val(data.prp_rag_soc)
                   $('#prp_cf').val(data.prp_cf)
                   $('#prp_indirizzo').val(data.prp_indirizzo)
                   $('#prp_cap').val(data.prp_cap)
                   $('#prp_citta').val(data.prp_citta)
                   $('#prp_prov').val(data.prp_prov)
                   $('#prp_cod_naz').val(data.prp_cod_naz.toUpperCase()).selectpicker("refresh");
                   $('#prp_telefono').val(data.prp_telefono)
                   $('#prp_email').val(data.prp_email)
                   $('#modalTitle').html('Dati proprietario')
                   $('#modalProprietario').modal('show')
                   $('#prp_rag_soc,#prp_cf,#prp_indirizzo,#prp_cap,#prp_citta,#prp_prov,#prp_telefono,#prp_email').attr("readonly", true);
                   $('#prp_cod_naz').attr("disabled",true)
                   $('#prp_cod_naz').selectpicker("refresh");
                   $('#closeModal').html('Chiudi')
                   $('#upModal').show()
                   $('#saveModal').hide()

               }
           })
   }
   $('#upModal').on('click', function(){

        $('#prp_rag_soc,#prp_cf,#prp_indirizzo,#prp_cap,#prp_citta,#prp_prov,#prp_telefono,#prp_email').attr("readonly", false);
        $('#prp_cod_naz').attr("disabled",false)
        $('#prp_cod_naz').selectpicker("refresh");
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
                url: "controller/updateProprietari.php?action=updateProprietario",
                data: formData,
                dataType: "json",
               success: function(data){

                 if(data){
                  Swal.fire({
                    title:"Operazione Completata!",
                    html:"Dati Proprietario aggiornati correttamente.",
                    icon:"success"}).then((result) => {
                        if (result.isConfirmed) {
                                    location.reload()
                        }
                    });
                 }else{
                  Swal.fire({
                    title:"Operazione Non Completata!",
                    html:"Dati Proprietario non aggiornati.",
                    icon:"warning"}).then((result) => {
                        if (result.isConfirmed) {
                                    location.reload()
                        }
                    });
                 }
               }
            })

    })
    function newProprietario(){
        $('#id_proprietario').val("")
        $('#prp_rag_soc').val("")
        $('#prp_cf').val("")
        $('#prp_indirizzo').val("")
        $('#prp_cap').val("")
        $('#prp_citta').val("")
        $('#prp_prov').val("")
        $('#prp_cod_naz').val("").selectpicker("refresh");
        $('#prp_telefono').val("")
        $('#prp_email').val("")
        $('#modalTitle').html('Inserimento Nuovo Proprietario')
        $('#modalProprietario').modal('show')
        $('#prp_rag_soc,#prp_cf,#prp_indirizzo,#prp_cap,#prp_citta,#prp_prov,#prp_telefono,#prp_email').attr("readonly", false);
        $('#prp_cod_naz').attr("disabled",false)
        $('#prp_cod_naz').selectpicker("refresh");
        $('#closeModal').html('Esci senza salvare')
        $('#upModal').hide()
        $('#saveModal').show()
    }
function downCsv(){     
    search1 = $('#search1').val()
    var fileTitle = 'proprietari';
        $.ajax({
            type: "POST",
            data:{search1:search1},
            url: "controller/updateProprietari.php?action=getProprietari",
            dataType: "json",
            success: function(data) {
                var headers = {
                    id: 'id',
                    prp_rag_soc: 'Ragione Sociale'.replace(/,/g, ''), // remove commas to avoid errors
                    prp_cf: "Codice Fiscale",
                    prp_indirizzo: 'Indirizzo'.replace(/,/g, ''),
                    prp_cap: "Cap",
                    prp_citta: "Città",
                    prp_prov: "Provincia",
                    prp_cod_naz: "Nazione",
                    prp_telefono: "Telefono",
                    prp_email: "Email",
                    prp_note: "Telefono",
                    data_agg:"Data Inserimento"       
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
            if (line != '') line += ';'

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