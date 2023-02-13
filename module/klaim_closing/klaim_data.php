<?php require('module/klaim_closing/klaim_act.php');?>
<?php
if($kar_data['kar_logika'] == 1 OR
$kar_id == 36 OR
$kar_id == 56 OR
$kar_id == 61){
?>
<style>table th,table td {
  padding:5px }
  table td {
    color: blue }
  .text-red {
    color: red }
  .text-green {
    color: green }
  .text-purple {
    color: purple }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> 
    <?php echo $title;?> 
    <small>
    </small> 
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="media.php">
        <i class="fa fa-dashboard">
        </i> Dashboard
      </a>
    </li>
    <li class="active">
      <?php echo $title;?>
    </li>
  </ol>
</section>
<!-- Main content -->
<section class="content"> 
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-body">
          <form action="" method="post">
            <div class="row">
              <!--<div class="col-sm-4">
<div class="form-group">
<label>Tanggal Pendaftaran</label>
<div class="input-group">
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
<input type="text" class="form-control" name="klm_tgl_daftar" id="klm_tgl_daftar" value="<?php echo $klm_date;?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
</div>
</div>
</div>-->
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Email Mahasiswa Baru
                  </label>
                  <input type="text" name="klm_email_maba" id="klm_email_maba" class="form-control" placeholder="Email"/>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Program
                  </label>
                  <select class="form-control" name="klm_program" id="klm_program">
                    <option value="" selected>--Pilih--
                    </option>
                    <option value="p2k">P2K
                    </option>
                    <option value="p2r">P2R
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                  <label>Kampus
                  </label>
                  <select class="form-control select" name="klm_kampus" id="klm_kampus" style="width: 100%;">
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div id="klaimdata">
                </div>
              </div>
            </div>
            <div class="row" id="klm_username_kontent" style="display: none">
              <div class="col-md-12">
                <hr>
                <div class="form-group">
                  <label>Di Klaim Oleh
                  </label>
                  <select class="form-control select" name="klm_username" id="klm_username" style="width: 100%; display: none;" disabled>
                    <?php
if($kar_id == 53 ||
$kar_id == 37 ||
$kar_id == 38 ||
$kar_id == 15 ||
$kar_id == 447 ||
$kar_id == 542 ||
$kar_id == 35 ||
$kar_id == 54 ||
$kar_id == 61 ||
$kar_id == 36 ||
$kar_id == 100 ||
$kar_id == 551 ||
$kar_id == 56){
$_karID = "all";
}else{
$_arrID = array($kar_data['kar_nik']);
$_karID = implode("','", $_arrID);
}
$kar_tampil_akses=$kar->kar_tampil_akses($_karID);
while($data=mysql_fetch_array($kar_tampil_akses)){
if($data['kar_nik'] == $kar_data['kar_nik']){
$selected = "selected";
}else{
$selected = "";
}
?>
                    <option value="<?php echo $data['kar_nik'];?>" 
                            <?php echo $selected;?>>
                    <?php echo $data['kar_nik'];?> - 
                    <?php echo $data['kar_nm'];?>
                    </option>
                  <?php }?>
                  </select>
              </div>
            </div>
            </div>
          <!--<input type="hidden" id="klm_username" value="<?php //echo $_kar_nik;?>">-->
          </form>
      </div>
      <div class="box-footer">
        <?php						
		if($kar_id == 36 || $kar_id == 56 || $kar_id == 551 || $kar_id == 447 || $kar_id == 542 || $kar_id == 61){					
		?>
        <button type="button" name="btncekklaim_closing" id="btncekklaim_closing" class="btn btn-success" disabled>Cek Data Klaim
        </button>		
        <?php }else{?>										
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"> Cek Data Klaim 
        </button>					
        <!-- Modal -->					
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">					  
          <div class="modal-dialog" role="document">						
            <div class="modal-content">						  
              <div class="modal-header">							
                <h5 class="modal-title" id="exampleModalLabel">Info
                </h5>							
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">							  
                  <span aria-hidden="true">&times;
                  </span>							
                </button>						  
              </div>						  
              <div class="modal-body">	untuk klaim data di harapkan menghubungi pak harto atau pak irwan thanks !!!						  
              </div>						
            </div>					  
          </div>					
        </div>										
        <?php }?>
        <button type="button" name="btnklaim" id="btnklaim" class="btn btn-danger" style="display: none" disabled>Klaim Data MHS Ini!
        </button>
      </div>
    </div>
  </div>
  </div>
</section>
<?php }else{ echo"<script>document.location='?p=not_found';</script>";}?>
