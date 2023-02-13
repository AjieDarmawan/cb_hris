
<?php
 error_reporting(0);
 session_start();
?>
<div class="box-body">
	<div class="row">
		<div class="col-md-6">

			<div class="form-group">

				<label for="">Kantor / Kampus</label>

				<select class="form-control selectpicker" style="width: 100%;"  id="umu_kantor" 
					name="kantor" data-live-search="true">

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
				<select class="form-control selectpicker" style="width: 100%;"  id="umu_kodebank" 
					name="kodebank" data-live-search="true" >
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

				<textarea class="form-control" rows="2"  id="umu_keperluan" name="keperluan" placeholder=""></textarea>

			</div>

		</div>

	</div>

	

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="">Jumlah Rp</label>
				<input type="text" class="form-control"  id="umu_nominal" name="nominal">
			</div>
		</div>
	</div>


	
</div> <!-- box-body !-->
<div class="box-footer" align="center">
	<input type="hidden" name="mode" value="simpan">
	<input type="hidden" name="jeniskasbon">
	<button type="submit" class="btn btn-primary">Ajukan</button>
  	<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button> 
	<!--
	 <button type="reset" value="reset" type="reset" class="btn btn-danger" onclick="window.location.reload()">Reset</button>
	!-->   
</div>