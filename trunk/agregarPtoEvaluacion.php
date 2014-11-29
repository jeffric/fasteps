<?php 
session_start();
ob_start();
include_once "funciones.php";
$c_funciones = new Funciones();
?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeader("Agregar Punto De Evaluación", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
          <script type="text/javascript">

              var map,
                  currentPosition,
                  directionsDisplay, 
                  directionsService

              var geocoder = new google.maps.Geocoder();

              function geocodePosition(pos) {
                     geocoder.geocode({
                       latLng: pos
                     },
                     function(responses) {

                     });
              }

              function updateMarkerPosition(latLng) {

                   $("#textLatitud").val(latLng.lat());
                   $("#textLongitud").val(latLng.lng());
              }   

              function iniciarMapa(lat, lon){
                  directionsDisplay = new google.maps.DirectionsRenderer(); 
                  currentPosition = new google.maps.LatLng(lat, lon);
                  map = new google.maps.Map(document.getElementById('mapCanvas'), {
                  zoom: 7,
                  center: currentPosition,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                  });

                  directionsDisplay.setMap(map);

              var currentPositionMarker = new google.maps.Marker({
                  position: currentPosition,
                  animation: google.maps.Animation.DROP,
                  map: map,
                  title: "Posicion Actual",
                  draggable: true
                  });

                  // Update current position info.
                 updateMarkerPosition(currentPosition);
                 geocodePosition(currentPosition);
                  
                 // Add dragging event listeners.
                 google.maps.event.addListener(currentPositionMarker, 'dragstart', function() {
                 });
  
                 google.maps.event.addListener(currentPositionMarker, 'drag', function() {
                 updateMarkerPosition(currentPositionMarker.getPosition());
                 });
  
                 google.maps.event.addListener(currentPositionMarker, 'dragend', function() {
                 geocodePosition(currentPositionMarker.getPosition());
                 });
                
              }

            function locError(error) {
               // the current position could not be located
            }

            function locSuccess(position) {
                // initialize map with current position 
                iniciarMapa(position.coords.latitude, position.coords.longitude);
            }

            $(document).on("ready", function() {
                // find current position and on success initialize map and calculate the route
                navigator.geolocation.getCurrentPosition(locSuccess, locError);

            });

         </script>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPage("F.A.S.T. MAPAS"); ?>
		<div class="content">
			<p><strong>CONTENIDO ACA</strong><br />	
        <div id="mapCanvas" class="content" style="height:375px; border:10px solid #a0a0a0;">                
        </div>  

		</div>
			<?php echo $c_funciones->getMenu(); ?>
	</div>		
		<?php echo $c_funciones->getFooter(); ?>		
		<!-- FOOTER -->
	</body>
	</html>