<?php require('module/absen/map_act.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> - Check Position <?php echo $chc_;?>
  <small>
    <?php 
        echo $tgl->tgl_indo($chc_tgl_masuk);
    ?>
  </small>
  <style>
    #map {
	  height: 600px;
	  width: 100%;
	  margin-top: 10px;
    }
    #content {
      width: 230px;
    }
  </style>  
  </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard </a></li>
    <li class="active"><?php echo $title;?> </li>
  </ol>
</section>   
<!-- Main content -->

<input type="hidden" class="form-control" id="latitude" value="<?php echo $latlongnya[2];?>">
<input type="hidden" class="form-control" id="longitude" value="<?php echo $latlongnya[3];?>">
<input type="hidden" class="form-control" id="max_radius" value="<?php echo $latlongnya[4];?>">
<input type="hidden" class="form-control" id="imageptorhome" value="<?php echo $imagekar;?>">

<input type="hidden" class="form-control" id="latitude1" value="<?php echo $latlongnya[0];?>">
<input type="hidden" class="form-control" id="longitude1" value="<?php echo $latlongnya[1];?>">
<input type="hidden" class="form-control" id="radius1" value="<?php echo $radiusnya;?>">

<section class="content"> 
  <!-- Your Page Content Here -->                 
  <div class="row">
    <div class="col-lg-8">
      <div class="box">
	<div class="box-body">        							  
	  <div class="col-md-12">
	    <div class="row">
	      <div class="col-md-8">
		Nama: <strong><?php echo $maps_data_id['nik'];?></strong> - <strong><?php echo $maps_data_id['nama'];?></strong><br>
		Jam: <strong><?php echo $jamnya;?></strong> - Jadwal Masuk: <strong><?php echo $latlongnya[5];?></strong><br>
		Status: <strong class="text-<?php echo $text_color;?>"><?php echo $statusny;?></strong>
	      </div>
	      <div class="col-md-4">
		Longitude: <strong><?php echo $latlongnya[1];?></strong><br>
		Latitude: <strong><?php echo $latlongnya[0];?></strong><br>
		Anda berada di radius: <strong><?php echo round($radiusnya,3);?> km</strong>
	      </div>
	    </div>
	    <div class="row">
	      <div class="col-lg-12">
		<div id="map"></div>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- /.box-body --> 
      </div>
      <!-- /.box --> 
    </div>
    <!-- /.col --> 
  </div>
  <!-- /.row --> 
  
  <!-- Optional JavaScript -->

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $API_KEY;?>&callback" async defer></script>

  <script>

      $(document).ready(function(){
	showPosition_maps()
      });
	      
      function showPosition_maps() {
	
	var imgkar = "/module/profile/img/<?php echo $acc_data_['acc_img'];?>";
	var imageptorhome = '<?php echo $imagekar;?>';
        
        var radius = document.getElementById("max_radius").value;  

	n1 = document.getElementById("longitude").value;
	t1 = document.getElementById("latitude").value;
		//alert('<?php echo $kar_latlong['kar_long'];?>');
	n12 = document.getElementById("longitude1").value;
	t12 = document.getElementById("latitude1").value;        

	if (n1.length > 0 && t1.length > 0 && n12.length > 0 && t12.length > 0) {
	  
	  lon = parseFloat(n1);
	  lat = parseFloat(t1);
	  lon12 = parseFloat(n12);
	  lat12 = parseFloat(t12);

	  var uluru = {lat: lat12, lng: lon12};
	  var uluru_center = {lat: lat, lng: lon};
	  var map = new google.maps.Map(
	      document.getElementById('map'), {zoom: 14, center: uluru});

	  var iconxptorhome = {
	      url: imageptorhome, // url
	      scaledSize: new google.maps.Size(40, 40), // scaled size
	      origin: new google.maps.Point(0,0), // origin
	      anchor: new google.maps.Point(0, 0) // anchor
	  };

	  var marker1 = new google.maps.Marker({
	      position: uluru_center,
	      map: map,
	      icon: iconxptorhome,
	  });
	  
	  const content1 =
	    '<div id="content">' +
	    '<div id="siteNotice">' +
	    "</div>" +
	    '<h4 id="firstHeading" class="firstHeading"><?php echo $latlongnya[5];?></h4>' +
	    '<div id="bodyContent">' +
	    '<p><?php echo $adds_json->results[0]->formatted_address;?></p>' +
	    "</div>" +
	    "</div>";
	  const infowindow1 = new google.maps.InfoWindow({
	    content: content1,
	  });
	  
	  marker1.addListener("click", () => {
	    infowindow1.open(map, marker1);
	  });
		      
	  var iconkar = {
	      url: imgkar, // url
	      scaledSize: new google.maps.Size(40, 40), // scaled size
	      origin: new google.maps.Point(0,0), // origin
	      anchor: new google.maps.Point(0, 0) // anchor
	  };

	  var marker2 = new google.maps.Marker({
	      position: uluru,
	      map: map,
	      icon: iconkar,
	  });
	  
	  const content2 =
	    '<div id="content">' +
	    '<div id="siteNotice">' +
	    "</div>" +
	    '<h4 id="firstHeading" class="firstHeading"><?php echo $maps_data_id['nik'];?><br><strong><?php echo $maps_data_id['nama'];?></strong></h4>' +
	    '<div id="bodyContent">' +
	    "<p>" +
	    "<img src='"+imgkar+"' width='200'>" +
	    "</p>" +
	    '<p><?php echo $adds1_json->results[0]->formatted_address;?></p>' +
	    "</div>" +
	    "</div>";
	  const infowindow2 = new google.maps.InfoWindow({
	    content: content2,
	  });
	  
	  marker2.addListener("click", () => {
	    infowindow2.open(map, marker2);
	  });

	  var meters = parseFloat(radius * 1000);
	  
	  const circle = new google.maps.Circle({
	      strokeColor: "#007bff",
	      strokeOpacity: 0.8,
	      strokeWeight: 2,
	      fillColor: "#007bff",
	      fillOpacity: 0.35,
	      map,
	      center: uluru_center,
	      radius: meters
	  });

	}
      }
  </script>

