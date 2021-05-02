<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">

	var geocoder;
	var map;

	geocoder = new google.maps.Geocoder();
	
	geocoder.geocode( { 'address': '<?=$maps[0]?>' }, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {        
    		latlng = results[0].geometry.location;
    		
        info = "<p>Locazione: <b> <?=$maps[0]?> </b></p>";
        
        str_latlng = new String( results[0].geometry.location );
    		
        lat = str_latlng.substring( 1, str_latlng.indexOf( ',' ) );
        info += "<p>Latitudine: <b>" + lat + "</b></p>";
        
        lon = str_latlng.substring( str_latlng.indexOf( ',' )+2, str_latlng.length-1 );
        info += "<p>Longitudine: <b>" + lon + "</b></p>";				
	  } else {
		    alert("Geocode was not successful for the following reason: " + status);
	  }
	});

	
	function initialize() {
		var myOptions = {
			zoom: 14,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.HYBRID
		}
	
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    
    // Creo un marker personalizzato
    image = '<?=$maps[2]?>';
    image = image.substring( 0, image.length-1 ); 
		var marker = new google.maps.Marker({
			map: map, 
			position: latlng,
      icon: image
		});

    // infowindow è la finestra che si apre insieme al marker, con alcune informazioni del luogo indicato
		var infowindow = new google.maps.InfoWindow({
		  content: info,
		  position: latlng
		});
    infowindow.open(map);
    google.maps.event.addListener(marker, 'click', function() {
		    infowindow.open(map);
    });
	}
	
</script>

<div id="map_canvas"></div>
