<?php
date_default_timezone_set("Asia/Bangkok");
include("koneksi_db.php");
foreach ($_REQUEST as $name => $value) {
	$$name = $value;
	//echo "$name : $value;<br />\n";
}

$userid = $_POST['userid'];
if ($aksi == "add") {
	$userid = 0;
}
?>

<!-- Modal -->
<div class="modal fade" id="ModalEdit" role="dialog" style=" ">
	<div class="modal-dialog">
		<div class="modal-content ">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal">
					<span class="glyphicon glyphicon-remove-circle text-white"></span>
				</button>
				<h4 class="modal-title "><?php echo $judul; ?> </h4>
			</div>
			<div class="modal-body ">
				<?php


				$sql = "select * FROM rwd_data_ms_b  where rwd_id = '$id' ";

				$result = mysql_query($sql);
				while ($row = mysql_fetch_array($result)) {
					$id   = $row['rwd_id'];
					$nama = $row['rwd_nm'];

					$arrrwd = explode(",", $row['rwd_datatext3']);
					reset($arrrwd);

					$subarrrwd = explode("#", $arrrwd[$arrmhs]);
					reset($subarrrwd);

					$ubah = array(3 => "_StatusUpdate_");
					$updatemhs = implode('#', array_replace($subarrrwd, $ubah));

					$arrmhs = array($arrmhs => $updatemhs);
					$updateready = implode(',', array_replace($arrrwd, $arrmhs));
					// print_r($updateready);


					$namamhs = $subarrrwd[6];
					$status = $subarrrwd[3];
					$insentif = explode(";", $subarrrwd[5])[1];
				}

				$disabled = "";
				if ($aksi == "list" || $aksi == "delete") {
					$disabled = "disabled";
				}


				?>

				<div class="table-responsive">


					<fieldset <?php echo $disabled; ?>>

						<table class="table table-border">
							<tbody>


								<tr>
									<td width="15%" style="vertical-align:middle">Nama MS</td>
									<td width="1%" style="vertical-align:middle">:</td>
									<td width="50%">
										<input name="rwd_nama" class="form-control" style=" font-weight: bold; " value="<?php echo $nama; ?>" disabled="disabled" required>
										</input>
									</td>

								<tr>

								<tr>
									<td style="vertical-align:middle">Mahasiswa</td>
									<td style="vertical-align:middle">:</td>
									<td>
										<input name="rwd_namamhs" class="form-control" value="<?php echo $namamhs; ?>" disabled="disabled"></input>
									</td>

								<tr>

								<tr>
									<td style="vertical-align:middle">Insentif</td>
									<td style="vertical-align:middle">:</td>
									<td>
										<input name="rwd_namamhs" class="form-control" value="<?php echo $insentif; ?>" disabled="disabled"></input>
									</td>

								<tr>

								<tr>
									<td style="vertical-align:middle">Status</td>
									<td style="vertical-align:middle">:</td>
									<td>
										<?php
										$selected0 = "";
										if ($status == "") {
											$selected0 = "selected";
										}
										$selected1 = "";
										if ($status == "B") {
											$selected1 = "selected";
										}
										?>
										<select class="form-control" name="rwd_status">
											<option value="" <?php echo $selected0; ?>>Belum Bayar</option>
											<option value="B" <?php echo $selected1; ?>>Bayar</option>
										</select>
									</td>

								<tr>
									<textarea name="updateready" style="display:none" readonly><?php echo $updateready; ?></textarea>

							</tbody>

						</table>
						<?php
						if ($aksi <> "list" and $aksi <> "delete") {
						?>
							<div class="modal-footer">
								<input type="hidden" name="id" value="<?php echo $id; ?>" /></input>
								<input type="hidden" name="act" value="<?php echo $aksi; ?>" /></input>
								<button class="btn btn-primary SAVEDATA "><i class="fa fa-save"></i> Simpan</button>
								<button class="btn btn-danger pull-right" data-dismiss="modal">Batalkan</button>
							</div>

						<?php } ?>
					</fieldset>
					<?php
					if ($aksi == "delete") {
					?>
						<div class="modal-footer">
							<input type="hidden" name="id" value="<?php echo $id; ?>" /></input>
							<input type="hidden" name="act" value="<?php echo $aksi; ?>" /></input>
							<button class="btn btn-primary SAVEDATA "><i class="fa fa-trash"></i> Delete </button>
							<button class="btn btn-danger pull-right" data-dismiss="modal">Batalkan</button>
						</div>

					<?php } ?>

				</div> <!-- table-responsive !-->







			</div> <!-- body !-->
			<!--
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
!-->
		</div>
		<div>
		</div>



		<script>
			function validateForm() {
				if (confirm("Mau di Simpan ?") == false) {
					return false;
				}

			}

			$(function() {
				$('.fetched-date input').datepicker({
					format: "yyyy-mm-dd",
					//  calendarWeeks: true,
					todayHighlight: true,
					autoclose: true
				});
			});
			$(function() {
				//  alert('xxx');			   	 

				$('#xxx_f_user_save_edit').submit(function(e) {
					alert('f_user_save_edit');
					$('#empModalEdit').modal('hide');


					$.ajax({
						type: 'POST',
						url: 'test/rwd_act.php',
						enctype: 'multipart/form-data',
						data: new FormData(this),
						processData: false,
						contentType: false,
						success: function(data) {
							//alert(data);
							if (data == 1) {
								//table.ajax.reload();

								//var page = "mod_emp/data.php";
								//$('#myMainMenu').load(page);

								//$('#empModalEdit').modal('hide');
								$('#f_save_edit').trigger("reset");

								var page = $("#__page").data('mod');
								var menu = $("#__page").data('menu');
								var aksi = $("#__page").data('aksi');
								var title = $("#__page").text();
								var limit = $("#__page").data('limit');
								alert(page + ' ' + aksi + ' ' + title + ' ' + limit);

								$('#myMainMenu').load(page, {
									page: page,
									menu: menu,
									aksi: aksi,
									title: title,
									limit: limit
								});
								//location.reload(true); 				

							} else {
								alert(json.msg);
							}
							return false;
						}
					});

					return false;
				});

			});
		</script>