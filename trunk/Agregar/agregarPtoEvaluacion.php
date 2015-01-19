<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

$idUsuario = $c_funciones->getIdUsuario($strUsuario);

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Agregar Punto De Evaluación", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); 
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
                  icon: '../css/images/PtoEvaluacion.png',
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
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. MAPAS"); ?>
		<div class="content" >
			<p><strong>Click sobre el pin y arrastre para posicionarlo</strong><br />	
	        <div id="mapCanvas" class="content" style="height:375px; border:10px solid #a0a0a0;">                
	        </div> 
	        <p><strong>Seleccione el Pais, al cual pertenecerá dicho Punto de Evaluación</strong><br /> 
            <select name="selectPais" id="selectPais">     
				<?php 				
        if($strTipoUsuario==1){
      				$result = $c_funciones->getListaPaises();					
      				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
      				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
      				}					
         }
        else{
            $result = $c_funciones->getListaPaisesAsignados($idUsuario);          
            while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
            echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
            }
        }         
				?>
            </select> 
            
            <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">            
            <label for="Nombre">Nombre Punto De Evaluación:</label> 
            <input type="text" name="Nombre" id="txtNombre" style="font-weight:Bold; font-size:20;"> 
            </div>

            <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
            <label for="Descripcion">Descripcion:</label> 
            <input type="text" name="Descripcion" id="txtDescripcion" style="font-weight:Bold; font-size:20;"> 
            </div>

            <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
            <label for="name">Latitud:</label> 
            <input type="text" name="latitud" id="txtLatitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 
            </div>

            <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
            <label for="longitud">Longitud:</label> 
            <input type="text" name="longitud" id="txtLongitud" disabled="true" style="font-weight:Bold; color:red; font-size:20; text-align:center;"> 
			      </div>

            <div id="ajax_loader">
            <img id="loader_gif" src="../css/images/ajax-loader.gif" style=" display:none;"/>
            </div> 

            <a href="#"  data-role="button" id="botonAgregar" data-theme="b">Agregar Punto de Evaluación</a></center> 
            



		</div>

			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>	


		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
      <script>
       $(document).ready(function(){
            
            $('#botonAgregar').click(function(){
                
                  validar();

            });

            function validar(){
              var nombre = $('#txtNombre').val();
              var descripcion = $('#txtDescripcion').val();
              var latitud = $('#txtLatitud').val();
              var longitud = $('#txtLongitud').val();

              if(nombre.indexOf(' ') >=0 || nombre == ""){
                swal("","No debes dejar campos vacios","warning");          
              }
              if(descripcion.indexOf(' ') >=0 || descripcion == ""){
                swal("","No debes dejar campos vacios","warning");          
              }
              if(latitud.indexOf(' ') >=0 || latitud == ""){
                swal("","No debes dejar campos vacios","warning");          
              }
              if(longitud.indexOf(' ') >=0 || longitud == ""){
                swal("","No debes dejar campos vacios","warning");          
              }                            

            }
           /*     $.ajax({
                  type: "POST",
                  url: "../funcionesAjax.php",
                  data: {nombreMetodo: "agregarPtoEvaluacion", nombrePtoEvaluacion: $('#textPtoDeEval').val(), latitud:$('#textLatitud').val(), longitud:$('#textLongitud').val(), descripcion:$('#textDescripcion').val(), pais:$('#selectPais').val()},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){


                  },
                  dataType: "html",
                  success: function(msg){
                     swal(msg);



                  }              


                });*/            
                    
        });
    </script>
	</html>