<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

?>
<!DOCTYPE html>
<html lang="es">
<?php echo $c_funciones->getHeaderNivel2("Creación de usuarios", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Usuarios"); ?>
		<div class="content">
			<p><strong>CREACIÓN DE USUARIOS</strong><br />

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
						<label for="txtCorreo" title="Este será el campo con el que se ingresará en el login de la aplicación.">Correo de usuario</label>
						<input type="text" name="txtCorreo" id="txtCorreo" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>					
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="lstPais" >País del usuario</label>
						<select name="lstPais" id="lstPais">
							<?php 	
							if($strTipoUsuario==1){			
							$result = $c_funciones->getListaPaises();					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
								}
							}
							else{
							$result = $c_funciones->getListaPaisesAsignados();					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
								}								
							}
							?>
						</select>	
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="slcTipoUsuarios" >Tipo de usuario</label>
						<select name="tipoUsuarios" id="slcTipoUsuarios">
							<?php 		
							if($strTipoUsuario==1){		
							$result = $c_funciones->getTipoUsuarios();					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
							}
							}		
							else{
							$result = $c_funciones->getTipoUsuarios2();
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
							}							
							}			
							?>
						</select>	
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtPassword">Password</label>
						<input type="password" name="txtPassword" id="txtPassword" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="txtConfPassword">Confirmar password</label>
						<input type="password" name="txtConfPassword" id="txtConfPassword" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
					</div>
				</div>					
				<!-- nombre, apellido, correo, password -->					
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<p id="respuesta"></p>
				</div>
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<button id="btnCrearUsuario" data-theme="a" name="submit" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Agregar usuario</button>
				</div>
			</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>						
	</div>		

	<script type="text/javascript">

	//on page load = document ready
	$(function(){
		//clic para crear usuarios
		$("#btnCrearUsuario").click(function(){
			CUsr();
		});
	});


	function CUsr(){
		var strNmUsr;
		var strApllUsr;
		var strCorrUsr;
		var strPssUsr;
		var strCnfPssUsr;
		var strTpoUsr;
		var strPais;

		strNmUsr = $("#txtNombre").val();
		strApllUsr = $("#txtApellido").val();
		strCorrUsr = $("#txtCorreo").val();
		strPssUsr = $("#txtPassword").val();
		strCnfPssUsr = $("#txtConfPassword").val();
		strTpoUsr = $("#slcTipoUsuarios option:selected").val();
		strPais = $("#lstPais option:selected").val();

		if(strNmUsr == ""){
			swal("Error", "No debe dejar el nombre vacío.", "error");			
			return false;
		}

		if(strApllUsr == ""){
			swal("Error", "No debe dejar el apellido vacío.", "error");			
			return false;
		}


		if(strCorrUsr == ""){
			swal("Error", "No debe dejar el correo vacío.", "error");
			return false;
		}


		if(strPssUsr == ""){
			swal("Error", "No debe dejar el password vacío.", "error");
			return false;
		}

		if(strCnfPssUsr == ""){
			swal("Error", "No debe dejar la confirmación de password vacío.", "error");			
			return false;
		}

		if(strPssUsr != strCnfPssUsr){
			swal("Error", "Los passwords no coinciden.", "error");			
			return false;
		}


		$.ajax({
			type: "POST",
			url: "../funcionesAjax.php",
			data: {
				nombreMetodo: "CUsr",
				AjxPNombre: strNmUsr,
				AjxPApellido: strApllUsr,
				AjxPCorreo: strCorrUsr,
				AjxPPassword: strPssUsr,
				AjxPTipoUser: strTpoUsr,
				AjxPPais: strPais
			},
			beforeSend: function () {
					//$("#modalCargando").modal("show");
					$("#respuesta").text("Creando usuario...");
				},
				success: function (datos) {
					//$("#modalCargando").modal("hide");
					// $("#target-modal-mod-user").html("");
					// $("#target-modal-mod-user").html(datos);
					// $("#modal-mod-usuarios").modal("show");
					$("#respuesta").text("");					
					swal(datos);
//					$("#respuesta").text(datos);
},
error: function (objeto, error, objeto2) {
					//$("#modalCargando").modal("hide");
					alert(error);
				}
			});
	}
</script>
<?php echo $c_funciones->getFooterNivel2(); ?>		
<!-- FOOTER -->
</body>
</html>