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
<?php echo $c_funciones->getHeaderNivel2("Modificar Eventos", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); 

 $idEvento = $_GET['idEvento'];

$result = $c_funciones->getInfoEvento($idEvento);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					$nombreEvento=$row[1];
					$localidad=$row[2];
					$descripcion=$row[3];
					$fecha=$row[4];
					$latitud = $row[5];
					$longitud = $row[6];
				}

?>


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

                   $("#txtLatitud").val(latLng.lat());
                   $("#txtLongitud").val(latLng.lng());
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
                iniciarMapa(<?php echo $latitud?>, <?php echo $longitud?>);
            }

            $(document).on("ready", function() {
                // find current position and on success initialize map and calculate the route
                navigator.geolocation.getCurrentPosition(locSuccess, locError);

            });

         </script>
<body>
	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Modificar"); ?>
		<div class="content">
			<p><strong>MODIFICAR EVENTO</strong><br />
					<div class="ui-body ui-body-a ui-corner-all">

						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="txtNombre" >Nombre del Evento</label>
							<input type="text" name="txtNombre" id="txtNombre" value="<?php echo $nombreEvento; ?>" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
						</div>
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="txtLocalidad" >Localidad (Lugar donde se realizará el evento)</label>
							<input type="text" name="txtLocalidad" id="txtLocalidad" value="<?php echo $localidad; ?>" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
						</div>			

						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="txtDescripcion" >Descripción del Evento</label>						
							<textarea cols="40" rows="5" name="txtDescripcion" id="txtDescripcion" style="resize:none;"><?php echo $descripcion; ?></textarea>
						</div>
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">						
							<label for="txtFecha">Fecha</label>
							<input type="date" data-clear-btn="false" id="txtFecha" value="<?php echo $fecha; ?>">	
						</div>                
					</div>	

			<p><strong>Click sobre el pin y arrastre para posicionarlo</strong><br />	
	        <div id="mapCanvas" class="content" style="height:375px; border:10px solid #a0a0a0;">                
	        </div>

            <label for="txtLatitud">Latitud:</label> 
            <input type="text" name="namelatitud" id="txtLatitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 

            <label for="txtLongitud">Longitud:</label> 
            <input type="text" name="namelongitud" id="txtLongitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 



		<a href=""  data-role="button" id="botonGuardar" data-theme="b">Guardar Cambios</a></center> 
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
		</div>
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->					
	</body>
  <script type="text/javascript">

       $(function(){

        $("#botonGuardar").click(function(){
          validar();
        });

        function validar(){
          var nombre = $('#txtNombre').val();
          var localidad = $('#txtLocalidad').val();
          var descripcion = $('#txtDescripcion').val();
          var latitud = $('#txtLatitud').val();
          var longitud = $('#txtLongitud').val();
          var fecha = $('#txtFecha').val();

            if(nombre == ""){
              swal("","No debes dejar campos vacios1","warning");          
            }
            else if(localidad.indexOf(' ') >=0 || localidad == ""){
              swal("","No debes dejar campos vacios2","warning");          
            }                  
            else if(latitud.indexOf(' ') >=0 || latitud == ""){
              swal("","No debes dejar campos vacios5","warning");          
            }         
            else if(longitud.indexOf(' ') >=0 || longitud == ""){
              swal("","No debes dejar campos vacios6","warning");          
            }                       
            else{

                      $.ajax({
                        type: "POST",
                        url: "../funcionesAjax.php",
                        data: {nombreMetodo: "modificarEvento", AjxNombre: nombre, AjxLocalidad: localidad, AjxDescripcion: descripcion, AjxFecha: fecha, AjxLatitud: $('#txtLatitud').val(), AjxLongitud:$('#txtLongitud').val(), AjxEvento: <?php echo $idEvento; ?>},
                        contentType: "application/x-www-form-urlencoded",
                        beforeSend: function(){
                        $('#loader_gif').fadeIn("slow");

                        },
                        dataType: "html",
                        success: function(msg){
                          $("#loader_gif").fadeOut("slow");         
                          swal(msg);                                  

                        }              


                      });


            }

        }


        });

  </script>

	</html>