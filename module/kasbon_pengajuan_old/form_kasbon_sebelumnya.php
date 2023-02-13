
<?php
 error_reporting(0);
 session_start();
?>
<div class="box-body">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="kantor">Jenis Kasbon</label>
				<select class="form-control selectpicker" style="width: 100%;" name="jeniskasbon" 
					id="jeniskasbon"
					data-live-search="true" onchange="#check_kasbon(this);" >
					<option value="">- PILIH -</option>
					<option value="1" data-opr="1">Kasbon oprasional</option>
					<option value="2" data-opr="2">Kasbbon kuliah perdana</option>
					<option value="3" data-opr="3">Kasbon properties marketing</option>
					<option value="4" data-opr="4">Refund</option>										
				</select>
			</div>
		</div>	
		<div class="col-md-4">
			<div class="form-group">
				<label for="">Jumlah Rp</label>
				<input type="text" class="form-control"  name="nominal">
			</div>
		</div>						
   </div>	
	<div class="row">
		<div class="col-md-6">

			<div class="form-group">

				<label for="">Kantor / Kampus</label>

				<select class="form-control selectpicker" style="width: 100%;" name="kantor" data-live-search="true">

					<option value="">- PILIH -</option>

					<?php

						foreach($list_kantor as $k => $v) {

							echo '<option value="'. $v['value'] .'">'. $v['label'] .'</option>';

						}

					?>

				</select>

			</div>

		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="">NoRek Pembayaran </label>
				<select class="form-control selectpicker" style="width: 100%;"  name="kodebank" data-live-search="true" >
					<option value="">- PILIH -</option>
					<?php
						foreach($list_kliring as $k => $v) {
							echo '<option value="'. $v['value'] .'">'. $v['label'] .'</option>';
						}
					?>
				</select>
			</div>
		</div>					
	</div>

	

	<div class="row">

		<div class="col-md-12">

			<div class="form-group">

				<label for="exampleInputEmail1">Keperluan</label>

				<textarea class="form-control" rows="2" name="keperluan" placeholder=""></textarea>

			</div>

		</div>

	</div>



	
</div> <!-- box-body !-->
<div class="box-footer" align="center">
	<input type="hidden" name="mode" value="simpan">
	<button type="submit" class="btn btn-primary">Ajukan</button>
  	<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button> 
	<!--
	 <button type="reset" value="reset" type="reset" class="btn btn-danger" onclick="window.location.reload()">Reset</button>
	!-->   
</div>