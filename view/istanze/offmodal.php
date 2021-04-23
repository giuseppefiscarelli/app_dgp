<div class="modal fade" tabindex="-1" role="dialog" id="offModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="annTitle">Annullamento Istanza
        </h5>
      </div>
      <div class="modal-body">
        <form id="annForm">
        <input type="hidden" id="annId"name="id_RAM" value="">
          <div class="form-group">
            <textarea id="note_annullamento"  name="note_annullamento" rows="3" maxlenght=500 placeholder="Inserisci riferimenti annullamento" required></textarea>
            <label for="note_annullamento">Note Annullamento</label>
          </div>
          </form>  
        
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger btn-sm" data-dismiss="modal" type="button">Esci senza annullare</button>
        <button class="btn btn-success btn-sm" type="submit" form="annForm" type="button">Esegui Annullamento</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
 

  function annIst(id){
    $('#note_annullamento').val("")
    $('#annId').val(id)
    $('#offModal').modal('show')
    $('#annTitle').html('Annullamento Istanza - idRAM '+id)
  } 
  
  $('#annForm').on('submit',function(e){
            e.preventDefault();
            formData = $(this).serialize();
                Swal.fire({
                  title: 'Vuoi annullare l\'istanza?',
                  text: "Non potrai più riattivarla",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'SI Conferma annullamento!',
                  cancelButtonText: 'NO, Esci senza Annullare!'
                  }).then((result) => {
                        if (result.isConfirmed) {
                              $.ajax({
                                    url: "controller/updateIstanze.php?action=annIstanza",
                                    data: formData,
                                    dataType: "json",
                                    success: function(results){      
                                          if(results==true)
                                          {
                                                Swal.fire({
                                                      title:  'Annullata!',
                                                      text:  'L\'istanza è stata annullata correttamente.',
                                                      icon: 'success'
                                                }).then(()=>{
                                                      location.reload();
                                                })       
                                          }
                                    }
                              })
                        }else{
                              $('#offModal').modal('toggle')
                        }
                  })

      })         


</script>