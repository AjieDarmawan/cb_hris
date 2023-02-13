<!-- jQuery 2.1.4 --> 
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.2 -->
<script src="plugins/jQuery/jquery-ui.min.js" type="text/javascript"></script> 
<!-- Bootstrap 3.3.2 JS --> 
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
<!-- DATA TABES SCRIPT --> 
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script> 
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.js"></script> 
<!-- Morris.js charts -->
<script src="js/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- SlimScroll --> 
<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
<!-- FastClick --> 
<script src='plugins/fastclick/fastclick.min.js'></script> 
<!-- AdminLTE App --> 
<script src="dist/js/app.min.js" type="text/javascript"></script>  
<!-- bootbox script --> 
<script src="js/bootbox.min.js" type="text/javascript"></script> 
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<!-- date-range-picker -->
<script src="js/moment.min.js" type="text/javascript"></script>
<script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- bootstrap color picker -->
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- Easy Ticker -->
<script type="text/javascript" src="plugins/jquery-easy-ticker-master/test/jquery.easing.min.js"></script>
<script type="text/javascript" src="plugins/jquery-easy-ticker-master/jquery.easy-ticker.js"></script>
<!-- CK Editor -->
<!-- <script src="plugins/ckeditor/ckeditor.js"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script> 
<!-- Filter Select -->
<script src="plugins/filterSelect/bootstrap-formhelpers.min.js"></script>
<!-- IsotopeSearchFilter -->
<script src="plugins/isotopeSearchFilter-master/jquery.imagesloaded.min.js"></script>
<script src="plugins/isotopeSearchFilter-master/vendor/isotope.pkgd.js"></script>
<script src="plugins/isotopeSearchFilter-master/isotopeSearchFilter.jquery.js"></script>

<!-- SimpleCropper -->
<!-- Js files-->
<!-- <script type="text/javascript" src="plugins/SimpleCropper/scripts/jquery.Jcrop.js"></script>
<script type="text/javascript" src="plugins/SimpleCropper/scripts/jquery.SimpleCropper.js"></script> -->

<!-- PowerTip -->
<!-- <script type="text/javascript" src="plugins/jquery.powertip-1.2.0/jquery.powertip.js"></script> -->

<!-- jQuery Knob -->
<script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>

<!-- Add IntroJs styles -->
<!-- <script type="text/javascript" src="plugins/intro.js-1.0.0/intro.js"></script> -->
<?php
if(empty($_GET['p'])){
if(empty($acc_data['acc_sts'])){
?>
<script type="text/javascript">
  var tour = introJs()
      tour.setOption('showProgress', true);
      tour.setOption('tooltipPosition', 'auto');
      tour.setOption('positionPrecedence', ['left', 'right', 'bottom', 'top'])
      tour.start()
  </script>
<?php }}?>
<script type="text/javascript">

        // LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: [
          <?php
          	$abs_tampil_acc=$abs->abs_tampil_acc($kar_id);
			      while($data=mysql_fetch_array($abs_tampil_acc)){ 
           ?>
            { month: '<?php echo $data['abs_tgl_masuk']; ?>', value: <?php echo $data['abs_point']; ?> },
          <?php }?>  
        ],
          xkey: 'month',
          ykeys: ['value'],
          labels: ['Point'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto',
      /*parseTime:false*/
        }); 

</script>

<!-- <script src="js/bootstro.js" type="text/javascript"></script> -->
<!--Chosen-->
<!--<script src="plugins/chosen-1.4.2/public/chosen.jquery.js" type="text/javascript"></script>-->
<!--FakeCrop-->
<script src="js/jquery.fakecrop.js"></script>
<script src="dist/js/bootstrap-select.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<!-- Typeahead -->
<script src="js/bootstrap-typeahead.js"></script>
<script src="js/hogan-2.0.0.js"></script>
<!-- Barcode -->
<script type="text/javascript" src="plugins/barcode/jquery-barcode-2.0.2.min.js"></script>
<!-- WebCam -->
<script src="plugins/webcam/webcam.js"></script>
<!-- AddForm -->
<script src="plugins/addform/addform.js"></script> 
<!-- page script --> 
<script src="js/custom.js" type="text/javascript"></script>

<script type="text/javascript">
/* Loop Ajax Penilaian */
<?php for ($i = 1; $i < 19; $i++) {?>
$('#fpk_huruf<?php echo $i;?>').change(function() { 
	  var div = $(this).val(); 
	  $.ajax({
			  type: 'POST', 
			  url: 'module/nla_ajx.php', 
			  data: 'fpk_huruf<?php echo $i;?>=' + div,
			  success: function(response) { 
			  $('#fpk_nilai<?php echo $i;?>').html(response);
		      }
		    });
});
<?php }?>
</script>

<script type="text/javascript">
/* Calendar Master */

$('#master_calendar').fullCalendar({
  header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
  },
  buttonText: {
    today: 'today',
    month: 'month',
    week: 'week',
    day: 'day'
  },
  //Random default events
  events: [
  <?php
  $kar_id_=$_SESSION['kar_id_jwd'];
  if(!empty($_SESSION['kar_id_jwd'])){
    $jwd_tampil_id=$jwd->jwd_tampil_id($kar_id_); 
  }else{
    $jwd_tampil_id=$jwd->jwd_tampil(); 
  }
  
  while($jwd_data_id=mysql_fetch_array($jwd_tampil_id)){
    $end=explode('-', $jwd_data_id['jwd_end']);
    $end_y=$end[0];
    $end_m=$end[1];
    $end_d=$end[2]+1;
    $end_cek=strlen($end_d);
    if($end_cek == "1"){
      $end_hari="0".$end_d;
    }else{
      $end_hari=$end_d;
    }

    $merah=array("Libur","Cuti");

    if($jwd_data_id['jwd_nm']==is_array($merah)){
        if(($jwd_data_id['jwd_start'] < $date) && ($jwd_data_id['jwd_end'] < $date)){
          $backgroundColor="#F4F4F4"; //default
          $borderColor="#DDD"; //default
          $textColor="#444";
        }else{
          $backgroundColor="#C9302C"; //red
          $borderColor="#AC2925"; //red
          $textColor="#FFF";
        }
    }elseif($jwd_data_id['jwd_nm']=="hh"){
        if(($jwd_data_id['jwd_start'] < $date) && ($jwd_data_id['jwd_end'] < $date)){
          $backgroundColor="#F4F4F4"; //default
          $borderColor="#DDD"; //default
          $textColor="#444";
        }else{
          $backgroundColor="#C9302C"; //red
          $borderColor="#AC2925"; //red
          $textColor="#FFF";
        }
    }else{
        $backgroundColor=""; //red
        $borderColor=""; //red
        $textColor="";
    }
  ?>  
    {
      title: '<?php echo $jwd_data_id[jwd_nm]. " - " .$jwd_data_id[kar_nm]; ?>',
      start: '<?php echo $jwd_data_id[jwd_start]; ?>',
      end: '<?php echo $end_y.'-'.$end_m.'-'.$end_hari; ?>',
      description: '<?php echo  $jwd_data_id[kar_nik]. " - " .$jwd_data_id[kar_nm]; ?>',
      backgroundColor: "<?php echo $backgroundColor; ?>", 
      borderColor: "<?php echo $borderColor; ?>",
      textColor: "<?php echo $textColor; ?>"
    },
  <?php }?>  
  ],
  eventClick:function(event, jsEvent, view) {
      $('#modalTitle').html(event.title);
      $('#modalBody').html(event.description);
      //$('#eventUrl').attr('href',event.url);
      $('#fullCalModal').modal();
  },
  editable: false,
  droppable: true, // this allows things to be dropped onto the calendar !!!

});


/* Calendar USER */

$('#user_calendar').fullCalendar({
  header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
  },
  buttonText: {
    today: 'today',
    month: 'month',
    week: 'week',
    day: 'day'
  },
  //Random default events
  events: [
  <?php
  $jwd_tampil_id=$jwd->jwd_tampil_id($kar_id); 
  while($jwd_data_id=mysql_fetch_array($jwd_tampil_id)){
    $end=explode('-', $jwd_data_id['jwd_end']);
    $end_y=$end[0];
    $end_m=$end[1];
    $end_d=$end[2]+1;
    $end_cek=strlen($end_d);
    if($end_cek == "1"){
      $end_hari="0".$end_d;
    }else{
      $end_hari=$end_d;
    }

    $merah=array("Libur","Cuti");

    if($jwd_data_id['jwd_nm']==is_array($merah)){
        if(($jwd_data_id['jwd_start'] < $date) && ($jwd_data_id['jwd_end'] < $date)){
          $backgroundColor="#F4F4F4"; //default
          $borderColor="#DDD"; //default
          $textColor="#444";
        }else{
          $backgroundColor="#C9302C"; //red
          $borderColor="#AC2925"; //red
          $textColor="#FFF";
        }
    }elseif($jwd_data_id['jwd_nm']=="hh"){
        if(($jwd_data_id['jwd_start'] < $date) && ($jwd_data_id['jwd_end'] < $date)){
          $backgroundColor="#F4F4F4"; //default
          $borderColor="#DDD"; //default
          $textColor="#444";
        }else{
          $backgroundColor="#C9302C"; //red
          $borderColor="#AC2925"; //red
          $textColor="#FFF";
        }
    }else{
        $backgroundColor=""; //red
        $borderColor=""; //red
        $textColor="";
    }
  ?>  
    {
      title: '<?php echo $jwd_data_id[jwd_nm]; ?>',
      start: '<?php echo $jwd_data_id[jwd_start]; ?>',
      end: '<?php echo $end_y.'-'.$end_m.'-'.$end_hari; ?>',
      description: '<?php echo  $jwd_data_id[kar_nik]. " - " .$jwd_data_id[kar_nm]; ?>',
      backgroundColor: "<?php echo $backgroundColor; ?>", 
      borderColor: "<?php echo $borderColor; ?>",
      textColor: "<?php echo $textColor; ?>"
    },
  <?php }?>  
  ],
  eventClick:function(event, jsEvent, view) {
      $('#modalTitle').html(event.title);
      $('#modalBody').html(event.description);
      //$('#eventUrl').attr('href',event.url);
      $('#fullCalModal').modal();
  },
  editable: false,
  droppable: true, // this allows things to be dropped onto the calendar !!!

});
</script>


<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js" type="text/javascript"></script> -->

