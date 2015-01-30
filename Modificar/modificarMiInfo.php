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
<?php echo $c_funciones->getHeaderNivel2("Modificar Info Usuario", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});

</script> <script src="../js/jquery-validate.js"></script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); ?>
<body>
	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Modificación"); ?>
		<div class="content">

			<p><strong>MODIFICACIÓN INFORMACION USUARIO</strong><br />
			<div class="ui-body ui-body-a ui-corner-all">

					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtNombre" >Nombre(s) de usuario</label>
						<input type="text" name="txtNombre" id="txtNombre" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtApellido" >Apellido(s) de usuario</label>
						<input type="text" name="txtApellido" id="txtApellido" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtCorreo" title="Este será el campo con el que se ingresará en el login de la aplicación.">Correo de usuario/Usuario</label>
						<input type="text" name="txtCorreo" id="txtCorreo" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>	
													
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtPassword">Nuevo Password</label>
						<input  type="password" name="txtPassword" id="txtPassword" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtConfPassword">Confirmar Nuevo password</label>
						<input type="password" name="txtConfPassword" id="txtConfPassword" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>	
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<button id="botonGuardar" data-theme="a" name="submit" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Guardar Cambios</button>
					</div>					
									

			</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>	
		</div>
		<?php echo $c_funciones->getFooterNivel2(); ?>			
	</body>
	<script type="text/javascript">
	$(function(){

                $.ajax({
                  type: "POST",
                  url: "../funcionesAjax.php",
                  data: {nombreMetodo: "obtenerInfoUsuario", AjxPUser: <?php echo $idUsuario?>},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){

                  },
                  dataType: "html",
                  success: function(msg){
                  	 var recoge=msg.split(",");

                    	$('#txtNombre').val(recoge[1]);
						$('#txtApellido').val(recoge[2]);
						$('#txtCorreo').val(recoge[3]);
						
						  

                  }              


                });			

		$("#botonGuardar").click(function(){
			Validar();
		});

		function Validar(){
			if($('#txtNombre').val() == ""){
				swal("", "Debes ingresar el nombre de usuario", "warning");
			}
			else if($('#txtApellido').val() == ""){
				swal("", "Debes ingresar el apellido de usuario", "warning");
			}
			else if($('#txtCorreo').val() == ""){
				swal("", "Debes ingresar el correo/usuario", "warning");
			}	
			else if($('#txtPassword').val() == ""){
				swal("", "Debes ingresar password de usuario", "warning");
			}			
			else if($('#txtConfPassword').val() == ""){
				swal("", "Debes ingresar la confirmacion de password de usuario", "warning")
			}	
			else if($('#txtPassword').val() != $('#txtConfPassword').val()){
				swal("", "Los Password No coinciden", "warning");
			}
			else{

				//va a insertar
                      $.ajax({
                        type: "POST",
                        url: "../funcionesAjax.php",
                        data: {nombreMetodo: "modificarMiInfo", AjxNombre: $('#txtNombre').val(), AjxApellido:$('#txtApellido').val() , AjxCorreo: $('#txtCorreo').val(), AjxPassword:$('#txtPassword').val(), AjxUsuario:<?php echo $idUsuario?>},
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