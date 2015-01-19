<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Agregar Eventos", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); ?>


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
                  icon: '../css/images/Evento.png',
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
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Agregar"); ?>
		<div class="content">
			<p><strong>AGREGAR EVENTO</strong><br />
					<div class="ui-body ui-body-a ui-corner-all">

						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="txtNombre" >Nombre del Evento</label>
							<input type="text" name="txtNombre" id="txtNombre" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
						</div>
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="txtLocalidad" >Localidad (Lugar donde se realizará el evento)</label>
							<input type="text" name="txtLocalidad" id="txtLocalidad" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
						</div>			

						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="txtDescripcion" >Descripción del Evento</label>						
							<textarea cols="40" rows="8" name="txtDescripcion" id="txtDexcripcion"></textarea>
						</div>
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">						
							<label for="txtFecha">Fecha</label>
							<input type="date" data-clear-btn="false" id="txtfecha" value="">	
						</div>


                    
					</div>

			

			<p><strong>Click sobre el pin y arrastre para posicionarlo</strong><br />	
	        <div id="mapCanvas" class="content" style="height:375px; border:10px solid #a0a0a0;">                
	        </div>

            <label for="name">Latitud:</label> 
            <input type="text" name="namelatitud" id="textLatitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 

            <label for="direccion">Longitud:</label> 
            <input type="text" name="namelongitud" id="textLongitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 



		<a href=""  data-role="button" id="botonAgregar" data-theme="b">Agregar Evento</a></center> 
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
		</div>
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->					
	</body>


	</html>