<?php

error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../../class.php');
require('../../object.php');

$db->koneksi();


foreach($_REQUEST as $name=>$value)
{
		$$name=$value;
		//echo "$name : $value;<br />\n";
}
	


$sSQL1 = "
		SELECT 
		a.*,b.rec_sasaran,b.rec_ke,c.kar_nik,c.kar_nm,d.ktr_nm,f.jbt_nm,g.div_nm
		FROM review_perform a
		LEFT JOIN review_kode b ON b.rec_kd=a.rev_kd
		LEFT JOIN kar_master c ON c.kar_id=a.kar_id 
		LEFT JOIN ktr_master d ON d.ktr_id=c.ktr_id
		LEFT JOIN jbt_master f ON f.jbt_id=c.jbt_id
		LEFT JOIN div_master g ON g.div_id=c.div_id
		WHERE 1=1  and a.rev_nomor = '$id' 
		LIMIT 1
		";

   //echo $sSQL1 ; return;
					
	$query1 		= mysql_query($sSQL1);
	$kar_data__		= mysql_fetch_assoc($query1); 
	$nopo   		= $kar_data__['rev_nomor'];
	$tgl    	  	= date('d-m-Y',strtotime($r1['tgl']));
	$tgl_mulai    	= date('d-m-Y',strtotime($r1['rev_start']));
	$tgl_akhir    	= date('d-m-Y',strtotime($r1['rev_end']));
	$file_xls 		= $nopo;
	
	//echo $file_xls; return;
?>

<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- Bootstrap 3.3.4 -->
<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Font Awesome Icons -->
<link href="../../plugins/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap 3.3.2 JS --> 
<script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 




<div style=" margin-left:5mm;  margin-top:5mm" align="left">

	 <input type="button" value="Print"  style="cursor:pointer;font-size:18px" onclick="printDiv('printableArea')" />

</div>

<div id="printableArea" style=" margin-left:5mm"   >
 <style>

 </style>

     <!-- Main content -->

    <!--    <section class="invoice col-xs-12"> !-->
     <section class="invoice" style="width:200mm"> 
          <!-- title row -->

          <div class="row">

            <div class="col-xs-12">

              <h2 class="page-header">

                <img src="../../dist/img/logo_gg_small130.JPG" width="80"> PT. Gilland Ganesha

                <small class="pull-right">
				  <br>

				</small>

                <center>
				<small>
					Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.
				</small>
				</center>

              </h2>

            </div><!-- /.col -->

          </div>

          <!-- info row -->

          <div class="row invoice-info">

          <center>
		   <h3><u>KEY PERFORMANCE REVIEW</u><font size="+1"><br />Nomor : <?php echo $nopo;?></font></h3>
		   <br />
		  </center>

            <div class="col-sm-8 invoice-col">

              <address>

                <strong><?php echo $kar_data__['kar_nm'];?></strong><br>

                NIK: <?php echo $kar_data__['kar_nik'];?><br>

                Divisi: <?php echo $kar_data__['div_nm'];?> / <?php echo $kar_data__['jbt_nm'];?><br>

                Location: <?php echo $kar_data__['div_nm'];?> / <?php echo $kar_data__['ktr_nm'];?><br>

              </address>

            </div><!-- /.col -->

            

          </div><!-- /.row -->



          <!-- Table row -->

  <div class="row">

	<div class="col-xs-12 table-responsive">

	 <input type="hidden" id="kar_nik" value="<?php echo $kar_data_['kar_nik']; ?>">

<table  class=" table table-striped table-bordered table-condensed" style="font-size: 14px;">

	<thead>
		<tr  >

			<th rowspan="1" style=" width:50px;vertical-align: middle;text-align: center; ">NO</th>

			<th rowspan="1" colspan="1" style="vertical-align: middle;text-align: left">SASARAN</th>
			<th rowspan="1" colspan="1" ><div align="center">POIN CUT OFF</div></th>

			<th rowspan="1" style="vertical-align: middle;text-align: center">ACTUAL</th>

		</tr>

	 </thead>

	  <tbody>

	  <?php

	  	$no=1;
		$sSQL2 = "
				SELECT 
				a.*,b.rec_sasaran,b.rec_ke,c.kar_nik,c.kar_nm,d.ktr_nm,f.jbt_nm,g.div_nm,b.rec_sasaran
				FROM review_perform a
				LEFT JOIN review_kode b ON b.rec_kd=a.rev_kd
				LEFT JOIN kar_master c ON c.kar_id=a.kar_id 
				LEFT JOIN ktr_master d ON d.ktr_id=c.ktr_id
				LEFT JOIN jbt_master f ON f.jbt_id=c.jbt_id
				LEFT JOIN div_master g ON g.div_id=c.div_id
				WHERE 1=1  and a.rev_nomor = '$id' 
				ORDER BY a.rev_id
				
				";
			
		$query2		= mysql_query($sSQL2);
		while ($row=mysql_fetch_assoc($query2)) {
		  $tgl_1 = date('d/m/Y',strtotime($row['rev_start']));
		  $tgl_2 = date('d/m/Y',strtotime($row['rev_end']));
		  $periode = $tgl_1.' - '.$tgl_2;
		 // if ($no > 5 ){
		 //   $periode= '-';
		 // }
		  $rec_ke = "Ke-".$row['rev_ke'];
		  $xke    = $row['rev_ke'];
          if ($xke == "" ){
		     $rec_ke = "";
			 $periode= '-';
		  }
	  ?>

	  <tr >

		  <td align="center"><?php echo $row['rev_kd'];?></td>

		  <td><?php echo $row['rec_sasaran'].' '. $rec_ke;?></td>

		  <td align="center">
		  <div style="width:170px">
		  	<?php echo $periode ;?>
		  </div>
		  </td>

		  <td style="text-align: center"><?php echo $row['rev_actual'];?></td>



	  </tr>

	  <?php $no++; } ?>

	  </tbody>

</table>


      <br />
       <div class="row">
	    <div class="col-xs-4">
	   		 Bogor , <?php echo date('d-m-Y');?>
			 <br />
			 Dibuat Oleh:
			 <br />
			 <br />
			 <br />
			( HRD )
			 <br />
			 <br />		</div>
	    <div class="col-xs-4">&nbsp;</div>
	    <div class="col-xs-4">
	   		&nbsp;
			 <br />
			 <br />
			 <br />
			 <br />
			&nbsp;
			 <br />
			 <br />
		 </div>
	   </div> 
	   
	</div><!-- /.col -->

   
  </div><!-- /.row -->

 


	  

          <!-- this row will not appear when printing -->

	  

        </section><!-- /.content -->

        <div class="clearfix"></div>

    
</div>

<!--
<script type="text/javascript" 
	src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js">
</script>
<script type="text/javascript"
	 src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js">
</script>
!-->

<script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script> 
<script type="text/javascript" src="../../lib/pdfmake.min.js"></script>
<script type="text/javascript" src="../../lib/html2canvas.min.js"></script>

<script type="text/javascript">

	function printDiv(divName) {
	
	     //alert('Printer...'); return false;
		 
	     var printContents = document.getElementById(divName).innerHTML;
	     var originalContents = document.body.innerHTML;

	     document.body.innerHTML = printContents;

	     window.print();

	     document.body.innerHTML = originalContents;
	}


        function Export_pdf() {
            html2canvas(document.getElementById('printableArea'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
					   //  pageOrientation: 'landscape',
					     pageOrientation: 'portraid',
                        content: [{
  							image: data,
                        //    width: 780,
                            }]
                    };
//                    pdfMake.createPdf(docDefinition).download("Tabel.pdf");
					pdfMake.createPdf(docDefinition).open();					
                }
            });
        }

	function exportTableToExcel(tableID, filename = ''){
	    let dataType = 'application/vnd.ms-excel';
	    let extension = '.xls';

	    let base64 = function(s) {
	        return window.btoa(unescape(encodeURIComponent(s)))
	    };


	    let template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';

	    let render = function(template, content) {
	        return template.replace(/{(\w+)}/g, function(m, p) { return content[p]; });
	    };

	    let tableElement = document.getElementById(tableID);

	    let tableExcel = render(template, {
	        worksheet: filename,
	        table: tableElement.innerHTML
	    });

	    filename = filename + extension;

	    if (navigator.msSaveOrOpenBlob)
	    {
	        let blob = new Blob(
	            [ '\ufeff', tableExcel ],
	            { type: dataType }
	        );

	        navigator.msSaveOrOpenBlob(blob, filename);
	    } else {
	        let downloadLink = document.createElement("a");

	        document.body.appendChild(downloadLink);

	        downloadLink.href = 'data:' + dataType + ';base64,' + base64(tableExcel);

	        downloadLink.download = filename;

	        downloadLink.click();
	    }

	}


        
</script>

