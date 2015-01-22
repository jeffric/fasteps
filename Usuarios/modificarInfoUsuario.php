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
<?php echo $c_funciones->getHeaderNivel2("Modificar Infor Usuario", 
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
						<label for="txtusuario" >Usuario</label>
						<select name="lstUsuario" id="lstUsuario">
							<option value="-2">Elegir un usuario</option>
							<?php 	
							if($strTipoUsuario==1){			
							$result = $c_funciones->getListaUsuarios($idUsuario);					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
								}
							}
							else{
							$result = $c_funciones->getListaUsuarios2($idUsuario);					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
								}						
							}
							?>
						</select>
					</div>

					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtNombre" >Nombre(s) de usuario</label>
						<input type="text" name="txtNombre" id="txtNombre" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtApellido" >Apellido(s) de usuario</label>
						<input type="text" name="txtApellido" id="txtApellido" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtCorreo" title="Este será el campo con el que se ingresará en el login de la aplicación.">Correo de usuario</label>
						<input type="text" name="txtCorreo" id="txtCorreo" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>	
						<label for="slcTipoUsuarios" >Tipo de usuario</label>			
						<select name="tipoUsuarios" id="slcTipoUsuarios" >
							<?php 		
							if($strTipoUsuario==1){		
							$result = $c_funciones->getTipoUsuarios();					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>
								';
							}
							}		
							else{
							$result = $c_funciones->getTipoUsuarios2();
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>
								';
							}							
							}			
							?>							
						</select>														
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
		
		$("#lstUsuario").change(function(){
			CargarInfo();
		});

		function CargarInfo(){

			strUsr = $("#lstUsuario option:selected").val();
			if(strUsr==-2){
				swal("Debe elegir un usuario valido");
				$('#txtNombre').val("");
				$('#txtApellido').val("");
				$('#txtCorreo').val("");
				$('#txtPassword').val("");
				$('#txtConfPassword').val("");


			}
			else{

                $.ajax({
                  type: "POST",
                  url: "../funcionesAjax.php",
                  data: {nombreMetodo: "obtenerInfoUsuario", AjxPUser: strUsr},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){

                  },
                  dataType: "html",
                  success: function(msg){
                  	 var recoge=msg.split(",");

                    	$('#txtNombre').val(recoge[1]);
						$('#txtApellido').val(recoge[2]);
						$('#txtCorreo').val(recoge[3]);
						$("#slcTipoUsuarios").val(recoge[5]);
						$('#slcTipoUsuarios').selectmenu('refresh');

						
						  

                  }              


                });				



			}

		}

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
			}									

		}







	});

	</script>
	</html>