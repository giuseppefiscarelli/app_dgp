<div class="modal fade" tabindex="-1" role="dialog" id="annModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="annInfoTitle">Annullamento Istanza
        </h5>
      </div>
      <div class="modal-body">
       
      
      <div class="card-body">
          <h5 class="card-title">Note Annullamento</h5>
          <p class="card-text" id="note_info"></p>
        </div>
          </form>  
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Chiudi</button>
       
      </div>
    </div>
  </div>
</div>
<script>
 function annInfo(id){
    $('#note_annullamento').val("")
    
   
   $('#annInfoTitle').html('Info Annullamento Istanza - idRAM '+id)
            $.ajax({
                  url: "controller/updateIstanze.php?action=annInfoIstanza",
                  data: {id:id},
                  dataType: "json",
                  success: function(results){    
                        var d = new Date(results.data_annullamento)
                        
                       
                        dataAnn = d.toLocaleString("it-IT")
                        console.log(dataAnn)
                        line= "<b>id RAM:</b> "+id+"<br><b>Annullata il:</b> "+dataAnn+"<br> <b>Note:</b> "+results.note_annullamento
                        $('#note_info').html(line)
                        $('#annModal').modal('show')  
                  }
            })
  }
</script>