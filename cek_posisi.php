<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Simulasi Cek Posisi - WFH</title>
    
    <style>
      #map {
        height: 400px;
        width: 100%;
       }
    </style>

  </head>
  <body>
    
    <div class="container-fluid pt-3">
        <h3>Simulasi<br> Cek Posisi - WFH</h3>
        <br>
        <h5>Posisi tempat tinggal</h5>
        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Longitude</span>
            </div>
            <input type="text" class="form-control" id="longitude" value="106.8262637">
        </div>
        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Latitude</span>
            </div>
            <input type="text" class="form-control" id="latitude" value="-6.5061041">
        </div>
        
        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="max_radius">Maksimal Radius</label>
            </div>
            <select class="custom-select" id="max_radius">
              <option value="1" selected>1km</option>
              <option value="2">2km</option>
              <option value="3">3km</option>
              <option value="4">4km</option>
              <option value="5">5km</option>
            </select>
        </div>
        
        <button type="button" class="btn btn-block btn-primary" onclick="getLocation()">Laporkan posisi Anda sekarang!</button>
        <hr>
            
        <h5>Cek posisi saat ini:</h5>
        <div id="posisi"></div>
        <br>
        <h5>Status:</h5>
        <div id="status"></div>
        <br><br>
        <div id="map"></div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTWSk-Yipimvagi0FeEtgRqvG-cXV8NhU&callback=initMap"></script>
    
    <script>
        
        var x = document.getElementById("posisi");
        var s = document.getElementById("status");
        
        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
          } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }
        
        function showPosition(position) {
            
          var radius = document.getElementById("max_radius").value;
          
          n1 = document.getElementById("longitude").value;
          t1 = document.getElementById("latitude").value;
          
          if (n1.length > 0 && t1.length > 0) {

            lon = parseFloat(n1);
            lat = parseFloat(t1);
            
            //alert(lat);
              
            var jarak = distance(position.coords.longitude, position.coords.latitude, lon, lat);
            if (jarak > radius) {
              s.innerHTML = "<h5>Peringatan!, Anda diluar radius</h5>";
            }else{
              s.innerHTML = "<h5>Terima Kasih, Anda masih dalam radius</h5>";
            }
              
            x.innerHTML = "Longitude: <strong>" + position.coords.longitude + "</strong><br>" +
            "Latitude: <strong>" + position.coords.latitude + "</strong><br>" +
            "Anda berada di radius: <strong>" + jarak + "km</strong>"
            
            var uluru = {lat: position.coords.latitude, lng: position.coords.longitude};
            var uluru_center = {lat: lat, lng: lon};
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 14, center: uluru});
            
            
            var marker = new google.maps.Marker({
                position: uluru_center,
                map: map,
                icon: 'https://img.icons8.com/color/1x/avengers.png',
            });
            
            var marker = new google.maps.Marker({
                position: uluru,
                map: map,
                icon: 'https://img.icons8.com/color/1x/iron-man.png',
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

            
          }else{
            x.innerHTML = "Silahkan isi Longitude & Latitude"
            s.innerHTML = "-"
          }
        }
        
        function showError(error) {
          switch(error.code) {
            case error.PERMISSION_DENIED:
              x.innerHTML = "Pengguna menolak permintaan untuk GPS."
              break;
            case error.POSITION_UNAVAILABLE:
              x.innerHTML = "Informasi lokasi tidak tersedia."
              break;
            case error.TIMEOUT:
              x.innerHTML = "Waktu permintaan untuk mendapatkan lokasi pengguna habis."
              break;
            case error.UNKNOWN_ERROR:
              x.innerHTML = "Terjadi kesalahan yang tidak diketahui."
              break;
          }
        }
        
        
        function distance(lon1, lat1, lon2, lat2) {
          var R = 6371; // Radius bumi dalam km
          var dLat = (lat2-lat1).toRad();  // Fungsi javascript dalam radians
          var dLon = (lon2-lon1).toRad(); 
          var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                  Math.cos(lat1.toRad()) * Math.cos(lat2.toRad()) * 
                  Math.sin(dLon/2) * Math.sin(dLon/2); 
          var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
          var d = R * c; // Jarak dalam km
          return round(d);
        }
        
        if (typeof(Number.prototype.toRad) === "undefined") {
          Number.prototype.toRad = function() {
            return this * Math.PI / 180;
          }
        }
        
        function deg2rad(deg) {
		rad = deg * Math.PI/180; // radians = degrees * pi/180
		return rad;
	}
        
        function round(x) {
            return Math.round( x * 1000) / 1000;
        }
    </script>
  </body>
</html>