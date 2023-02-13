
<?php
 error_reporting(0);
 session_start();
?>
<div class="row">
	<div class="col-md-6">

		<div class="form-group">

			<label for="kantor">Kantor / Kampus</label>

			<select class="form-control selectpicker" style="width: 100%;" 
				id="mar_kantor" name="kantor" data-live-search="true">

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
			<label for="kodebank">NoRek Pembayaran</label>
			<select class="form-control selectpicker" style="width: 100%;"
				  id="mar_kodebank" name="kodebank" data-live-search="true" >
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

			<textarea class="form-control" rows="2" id="mar_keperluan" name="keperluan" placeholder=""></textarea>

		</div>

	</div>

</div>



<div class="row">

<!--
	<div class="col-md-6">
		<div class="form-group">
			<label for="kantor">Jenis Kasbon</label>
			<select class="form-control selectpicker" style="width: 100%;" name="jeniskasbon" 
				id="jeniskasbon"
				data-live-search="true" onchange="check_kasbon(this);" >
				<option value="">- PILIH -</option>
				<option value="1" data-opr="1">Kasbon oprasional</option>
				<option value="2" data-opr="2">Kasbbon kuliah perdana</option>
				<option value="3" data-opr="3">Kasbon properties marketing</option>
				<option value="4" data-opr="4">Refund</option>										
			</select>
		</div>
	</div>					
!-->
	<div class="col-md-3">
		<div class="form-group">
			<label for="kantor">Semester</label>
			<?php 
			  $xth1 = date("Y")-1;
			  $xth2 = date("Y");
			  $smt_11 = "1.$xth1";
			  $smt_12 = "2.$xth1";
			  $smt_21 = "1.$xth2";
			  $smt_22 = "2.$xth2";
			?>
			<select class="form-control " style="width: 100%;" name="semester" 
				id="semester"
				data-live-search="true" onchange="#;" >
				<option value="">- PILIH -</option>
				<option value="<?php echo $smt_11;?>" > <?php echo $smt_11;?></option>
				<option value="<?php echo $smt_12;?>" > <?php echo $smt_12;?></option>
				<option value="<?php echo $smt_21;?>" > <?php echo $smt_21;?></option>
				<option value="<?php echo $smt_22;?>" > <?php echo $smt_22;?></option>										
			</select>
		</div>
	</div>	
	<div class="col-md-3">
		<div class="form-group">
			<label for="kantor">Tahap</label>
			<select class="form-control " style="width: 100%;" name="tahap" 
				id="tahap"
				data-live-search="true" onchange="#;" >
				<option value="">- PILIH -</option>
				<option value="Tahap I"   > <?php echo 'Tahap I';?></option>
				<option value="Tahap II"  > <?php echo 'Tahap II';?></option>
				<option value="Tahap III" > <?php echo 'Tahap III';?></option>
				<option value="Tahap IV"  > <?php echo 'Tahap IV';?></option>										
			</select>
		</div>
	</div>				
				
	<div class="col-md-4">
		<div class="form-group">
			<label for="nominal">Jumlah Rp</label>
			<input type="text" class="form-control" id="nominal_properti" name="nominal" readonly="">
		</div>
	</div>
</div>


<div id="item-barang"  style="display:block">

				   <div class="row" >
							<div class="col-md-1"  style="width:5px">
								<div class="form-group" align="right">
									<label for="kantor">#</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="kantor">KdBrg</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="kantor">Nama Barang</label>
								</div>
							</div>
							<div class="col-md-1" >
								<div class="form-group" style="width:40px">
									<label for="kantor">QTY</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="kantor">Harga</label>
								</div>
							</div>
					</div>	
	<?php				
	$x = 0 ;
	$qty = 1 ; 
	for ($i=0; $i< 10; $i++){ 
		$x++;
	?>
	   <div class="row" >
				<div class="col-md-1"  style="width:5px">
					<div class="form-group" align="right" ><?php echo ($i+1);?></div>
				</div>	
				
				<div class="col-md-3">
					<div class="form-group">
				<select class="form-control selectpicker" style="width: 100%;"  id="mar_kodebrg_<?php echo $x; ?>" 
						name="kode_barang_p[]"
						data-live-search="true" onchange="check_harga_properti(this);"  >
				  <option value="">-- Pilih --</option>
				  <?php
		  
		          $filter_barang = " and kdklp = '2' ";
				  $sqlproduk   =" SELECT * FROM barang_master WHERE 1=1 $filter_barang  ORDER BY nama_barang ";      				      
				  $pro_tampil  = mysql_query($sqlproduk);							  
				  $data_jml    = mysql_num_rows($pro_tampil);
				 // $x=1;
				  while($data=mysql_fetch_array($pro_tampil)){
					$kdbrg = $data['kode_barang'];
					$nmbrg   = $data['nama_barang'];;
				  ?>
				  <option  data="<?php echo $data['harga1']; ?>" 
						   data-urut="<?php echo $x; ?>" 
						   data-kode="<?php echo $kdbrg; ?>" 
						   data-nmbrg="<?php echo $nmbrg; ?>" 
						  value="<?php echo $kdbrg;?>">
				  <?php echo $kdbrg.' '.$nmbrg.' : [Rp.'.$data['harga1']." ... ".$data['harga2']."]";?>
				  </option>
				  <?php }?>
				</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" id="nmbrg_p<?php echo $x; ?>" 
							name="nama_barang_p[]"  placeholder="Nama Barang" readonly=""  >
					</div>
				</div>					

				<div class="col-md-1" >
					<div class="form-group" style=" text-align:left;width:40px">
						<input type="text" class="form-control"  
						value = "<?php echo $qty; ?>"  name="qty_p[]" 
						id="qty_p<?php echo $x; ?>"
						placeholder="Qty"  onchange="check_total_properti(this);" >
					</div>
				</div>					
				<div class="col-md-3">
					<div class="form-group">
						<input type="text" class="form-control" id="harga_p<?php echo $x; ?>" 
						 name="harga_p[]" placeholder="Harga"  
						 onchange="check_total_properti(this);" readonly="">
					</div>
				</div>					

		</div>
				
<?php } ?>

</div>

</div>

<div class="box-footer" align="center">
<input type="hidden" name="mode" value="simpan">
<input type="hidden" name="aksi" value="save_properti">
<input type="hidden" name="jeniskasbon">
<button type="submit" class="btn btn-primary">Ajukan</button>
<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button> 
<!--
	 <button type="reset" value="reset" type="reset" class="btn btn-danger" onclick="window.location.reload()">Reset</button>
!-->
</div>

