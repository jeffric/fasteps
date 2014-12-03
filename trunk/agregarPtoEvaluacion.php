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

	<div id="page" data-role="page">
		<?php $c_funciones->getHeaderPage("F.A.S.T. MAPAS"); ?>
		<div class="content" >
			<p><strong>Click sobre el pin y arrastre para posicionarlo</strong><br />	
	        <div id="mapCanvas" class="content" style="height:375px; border:10px solid #a0a0a0;">                
	        </div> 
	        <p><strong>Seleccione el Pais, al cual pertenecerá dicho Punto de Evaluación</strong><br /> 
            <select name="selectPais" id="selectPais">     
				<?php 				
				$result = $c_funciones->getListaPaises();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
				}					
				?>
            </select> 

            <label for="nombrePuntoDeEvaluacion">Nombre Punto De Evaluación:</label> 
            <input type="text" name="namePuntoDeEvaluacion" id="textPtoDeEval" style="font-weight:Bold; font-size:20;"> 

            <label for="name">Latitud:</label> 
            <input type="text" name="namelatitud" id="textLatitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 

            <label for="direccion">Longitud:</label> 
            <input type="text" name="namelongitud" id="textLongitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 
			     <a href=""  data-role="button" id="botonAgregar" data-theme="b">Agregar Punto de Evaluación</a></center> 
            
            <div id="resultado">
            </div> 


		</div>

			<?php echo $c_funciones->getMenu(); ?>
	</div>	


		
		<?php echo $c_funciones->getFooter(); ?>		
		<!-- FOOTER -->

    <script>
      $(document).ready(function(){
            $('#botonAgregar').click(function(){

                
                $.ajax({
                  type: "POST",
                  url: "funcionesAjax.php",
                  data: {nombreMetodo: "agregar"},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){
                  //  $('#loader_gif').fadeIn("slow");
                  

                  },
                  dataType: "html",
                  success: function(msg){
                    //  $("#loader_gif").fadeOut("slow");                    
                      $('#resultado').html(msg);
             

                  }              


                });

                      

            });
      });      
    </script>
	</body>
	</html>