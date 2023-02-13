<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<form class="form-inline">
<input class="form-control" type="text" id="nik">

<button type="button" class="btn btn-primary" id="submit">CEK</button>
</form>
<div id="loading"></div>
<div class="modal fade" id="absenpulangfu" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Absen Pulang fu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="absenpulang" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Absen Pulang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#submit").click(function(){
	 var nik = $('#nik').val();	
	 $('#loading').html("Harap Tunggu sedang proses cek fu BDC");
	 
	 
		$.ajax({
		type: 'POST',
		processData: false,
		contentType: false,
		url: '//daftarkuliah.my.id/bdc/x_crontab_activity.php?nik='+nik,
		crossDomain: true,
		
		success: function(responseData, textStatus, jqXHR) {
			
			var value = responseData.someKey;
			console.log(responseData);
			var obj = JSON.parse(responseData);
			
			$('#loading').html(obj[1].status);
			if(obj[1].status === 'disabled'){
				$('#absenpulangfu').modal('show');
			}else{
				$('#absenpulang').modal('show');
			}
		},
		error: function (responseData, textStatus, errorThrown) {
			alert('POST failed.');
		}
	});
	
	
	
  });
});
</script>