  $(document).ready(function(){
  
        var tgl_sekarang = Date.now();
		
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; 
		var yyyy = today.getFullYear();
		if(dd<10) 
		{
			dd='0'+dd;
		} 
		
		if(mm<10) 
		{
			mm='0'+mm;
		} 
		today = yyyy+'-'+mm+'-'+dd;

		
		var dataTable = $('#tb_marketing').DataTable({
			"processing":true,
			"serverSide":true,
			"ajax":{
				"url":"module/po_marketing_support/data_server.php",
				"type":"POST",
				"data":function(data){
						data.mode='list';
						data.tanggal=$('#filter_day').val();
						//data.paket_tool=$('#id_paket_tool').val();
						//data.nm_barang=$('#nm_barang').val();

					}
			 },
			"iDisplayLength": 10,
			"aLengthMenu": [[10, 20, 50, 100,-1], [10, 20, 50, 100,'All']],
		//	"order": [[ 1, 'asc' ],[ 2, 'asc' ]],	
		//	"order": [[ 0, 'asc' ]],
			"order": [],
			"aoColumnDefs": [
				  {"bSortable": false,"bVisible": true,"aTargets": [ 0 ]},
				  {"bSortable": false,"aTargets": [ -1 ]},
				  {"targets": '_all',
				   "defaultContent": "-", //////datatables.net/tn/4/////////
	               "createdCell": function (td, cellData, rowData, row, col) {
	                	///////set-panding/////////
	                   // $(td).css('padding', '0px 5px 0px 0px');
	               }},				  
			 ],		  		
			"displayLength": 50,
			"oLanguage": {
				"sProcessing": "...sedang proses...",
				//"sProcessing": "...",
			 },

//		    dom: 'l-B-f-r-t-i-p',
		    dom: 'l-B-f-r-t-i-p',
			buttons: [
				 {
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel-o"></i> Excel ',
					title:'data-marketing-freelance '+today,
	                //orientation: 'landscape',
/*					
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                        customize: function ( xlsx ) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('c[r=A2] t', sheet).text( 'Custom text' );
                        }
					}
*/
											
				 },	
	 
			  ],		

			

		});		

	   
///////////////////////////////////////////////////
	   function myAlert(title,type){
				setTimeout(function () { 	
					swal({
						title: title,
						text:  '',
						type: type,
						timer: 30000,
						showConfirmButton: true
					});		
				},10);	
	   }
	   
	 //////////////////////////////////////////////////////////////
	      //////////////////////////////////////////////////////////////
		doMyEDIT = function(id,data) {
					var userid = data;
					var page = "module/po_marketing_support/form_edit.php";
					var aksi = "edit";
					var judul = "Edit Data";
					
					//alert(userid);
					
					$.ajax({
						url: page,
						type: 'post',
						data: {id: id, aksi:aksi, judul : judul },
						success: function(data){ 
						   	$('.div_modal_2').html(data); 
							$('#ModalEdit').modal('show'); 
						}
					});
			 /////////////////////////		 
		};  
     //////////////////////////////////////////////////////////////
		doMyDELETE = function(id,data) {
		  bootbox.confirm("<h4>Yakin Hapus <strong>"+data+"</strong> ?</h4>", function(result) {
			    if (result) {   
				   	var userid = data;
					var page = "module/po_marketing_support/data_server.php";
					var aksi = "delete";
					var judul = "Delete Data";
					$.ajax({
						url: page,
						type: 'post',
						data: {id: id, aksi:aksi, judul:judul },
						success: function(data){ 
						     dataTable.ajax.reload(); ///////all-page//////
							 // dataTable.ajax.reload(null,false); ///////////
							myAlert('Data Berhasil di Hapus','success');
						}
					});					
					return true;                                                                    
				} else {
					show: false ;                      
				}

		  }); 					
		  					
			 /////////////////////////		 
		};




   /////////////////////////////////////////////////////////////////////////////////////////	
	$('#save_update_konten').submit(function(e) {
	   
        var status   = $('select[name=mfc_status]').val();
		//alert(status);return false;
		if (status != undefined ){
		    if (status == "" ){
				//$('select[name=mfc_status]').focus();
			   // myAlert('Nama Tidak Boleh Kosong !...','error');return false;
				
			}   
		}   
		//$('#empModalEdit').modal('hide');
		$.ajax({
			type: 'POST',
			//url: 'mod_user/data_user_act.php',
			url: 'module/po_marketing_support/data_server.php',
			enctype: 'multipart/form-data',
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(data) {
				    //var obj = $.parseJSON(data);
			        //var obj = JSON.parse(this.data);
			       	//alert(obj[0]); 
					//var obj = jQuery.parseJSON( '{ "status": "John" }' );
					$('#ModalEdit').modal('hide');
					var obj = jQuery.parseJSON(data);
					if (obj.status === "0" ){
					 // alert( obj.status );
					  myAlert('Data Error !...','error');
					  return false;
					}
					var aksi = $('input[name=act]').val();
					$('#save_update_konten').trigger("reset");
					//dataTable.ajax.reload(); ///////all-page///////
					if (aksi=="delete"){
					  dataTable.ajax.reload(); ///////all-page///////
					  myAlert('Data Berhasil di Hapus','success');
					}else{
					  dataTable.ajax.reload(null,false);
					  myAlert('Data Berhasil di Simpan','success');
					} 
					// window.location.reload();

			},
			error: function(data) {
			
			  myAlert('File Not Found !...','error');
			}	
		});
					
		return false;
	});
	
//////////////////////////////////////////

});		
  
  
////////////////////////////////////////////////////////////////  

