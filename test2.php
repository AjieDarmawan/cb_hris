<!DOCTYPE html>
<html>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>






.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}

.tooltip:active .tooltiptext {
  visibility: visible;
}
</style>
<body>
	<div class="video_wrap update">
		<div class="content">
			
			<a class="tooltip" onclick=""> aaaa
				<span class="tooltiptext">Tooltip text</span>
			</a>
			<br /><br />
			<a class="tooltip" onclick=""> bbbb
				<span class="tooltiptext">Tooltip text 2</span>
			</a>
			<br /><br />
			<a class="tooltip" onclick=""> cccc
				<span class="tooltiptext">Tooltip text 3</span>
			</a>
			
			<br /><br />
			
			<div class="tooltip-wrapper"><ul style="margin:0; padding:0;"><li>&nbsp; 13.
					<span class="z528" tabindex="0" data-toggle="tooltip" data-html="true" data-placement="right" data-trigger="focus" title="" data-original-title="<table><tr><td class='custom-width text-left'><a href='http://stikom-bali.web.id' class='z529' target='_blank'><strong>stikom-bali.web.id</strong></a></td><td class='custom-width text-right'><a href='http://m.stikom-bali.web.id/c/1-2514-2411/zzpts-z-selamat-datang-stikom-bali__stikom-bali.html' class='z529' target='_blank'>tampilan di <strong>HP</strong></a></td></tr><tr><td class='custom-width text-left'><a href='http://stmik-bali.web.id' class='z529' target='_blank'><strong>stmik-bali.web.id</strong></a></td><td class='custom-width text-right'><a href='http://m.stmik-bali.web.id/c/1-2515-2412/zzpts-z-selamat-datang-stikom-bali__stmik-bali.html' class='z529' target='_blank'>tampilan di <strong>HP</strong></a></td></tr><tr><td class='custom-width text-left'><a href='http://stikom-stmik-bali.web.id' class='z529' target='_blank'><strong>stikom-stmik-bali.web.id</strong></a></td><td class='custom-width text-right'><a href='http://m.stikom-stmik-bali.web.id/c/1-2516-2413/zzpts-z-selamat-datang-stikom-bali__stikom-stmik-bali.html' class='z529' target='_blank'>tampilan di <strong>HP</strong></a></td></tr><tr><td class='custom-width text-left'><a href='http://stmik-stikom-bali.web.id' class='z529' target='_blank'><strong>stmik-stikom-bali.web.id</strong></a></td><td class='custom-width text-right'><a href='http://m.stmik-stikom-bali.web.id/c/1-2517-2414/zzpts-z-selamat-datang-stikom-bali__stmik-stikom-bali.html' class='z529' target='_blank'>tampilan di <strong>HP</strong></a></td></tr><tr><td class='custom-width text-left'><a href='http://stikom.web.id' class='z529' target='_blank'><strong>stikom.web.id</strong></a></td><td class='custom-width text-right'><a href='http://m.stikom.web.id/c/1-2518-2415/zzpts-z-selamat-datang-stikom-bali__stikom.html' class='z529' target='_blank'>tampilan di <strong>HP</strong></a></td></tr><tr><td class='custom-width text-left'><a href='http://stmik.web.id' class='z529' target='_blank'><strong>stmik.web.id</strong></a></td><td class='custom-width text-right'><a href='http://m.stmik.web.id/c/1-1152-1049/zzpts-z-selamat-datang-stikom-bali__stmik.html' class='z529' target='_blank'>tampilan di <strong>HP</strong></a></td></tr></table>">
						stikom-bali.web.id - <b>6</b>
					</span>
					</li>
					</ul>
				</div>
		</div>
	</div>
	
	
	<script>var clickEvent = "click";
		if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
			var isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
			
			
			if (isIOS) {
				clickEvent = "tap";
			}			
			
			
		}	

var clickEvent = "click";
			$('.tooltip-wrapper').on(clickEvent, function (e) {
			  var checkAttr = $(e.target).attr('data-toggle');
			  if(checkAttr == "tooltip"){
				$(e.target).tooltip("show");
				return;
			  }
			  $('[data-toggle="tooltip"]').tooltip("hide");
			});		
	</script>
</body>
</html>
