
<?php

	require('../../class.php');
	require('../../object.php');
	$db->koneksi();

  $aksi 	 = $_REQUEST['aksi'];
  $edit 	 = $_REQUEST['edit'];
  $id 	   = $_REQUEST['id'];
	if (isset($_REQUEST['id'])) {
    $sql     = "
                SELECT * FROM 
                pos_master,
                mrk_master,
                kar_master
                WHERE 
                pos_master.mrk_id=mrk_master.mrk_id AND 
                pos_master.kar_id=kar_master.kar_id 
                AND pos_master.pos_id='$id'
                ORDER BY pos_id DESC 
                ";

//    echo $sql; return;

		$query   = mysql_query($sql);
		$row	   = mysql_fetch_array($query);
 	}


 
?>


<div class="modal-dialog"  tabindex="-1" role="dialog" 
    aria-labelledby="myModalLabel" aria-hidden="true" >

    <div class="modal-content">
      <div class="modal-header bg-blue">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">
          <i class="glyphicon glyphicon-edit"></i> 
          <?php echo $edit ?> - Data Posting
        </h4>
      </div>

	  
      <div class="modal-body">
        <form id="form-update-brg-xx" method="POST" name="modal_popup" enctype="multipart/form-data" >
           <input type="hidden" name="aksi" id="aksi" value="<?php echo  $aksi;?>" >
           <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
           <div class="row">       
                  <div class="col-xs-12">
                    <label for="kode">Nama</label>
                    <input type="text" class="form-control" name="kar_nm"  
					           value="<?php echo $row[kar_nm]; ?>" placeholder="" readonly required >
                  </div>  
                  <div class="col-xs-12">
                    <label for="nama">Keterangan / Pesan</label>
                     <textarea class="form-control" name="pos_msg" rows="3"  placeholder="Posting Pesan ..."><?php echo  $row[pos_msg];?></textarea>   
                  </div>



          </div>
		  
          <div class="modal-footer">
            <input type="submit"  class="btn btn-success btn-submit" name="bEditPost" value="Simpan" >
            <button type="reset" class="btn btn-danger btn-reset" data-dismiss="modal" aria-hidden="true">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
 
  
  <script type="text/javascript">
    $(document).ready(function(){

        $.fn.modal.Constructor.prototype.enforceFocus = function() {};  

        $('.date-input').datepicker({
            //your config..
            format: "yyyy-mm-dd",

        }).on('show.bs.modal', function(event) {
            event.stopPropagation();
        });
        
        $('.select').select2();
     
    })

  </script>
