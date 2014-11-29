<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();
?>
<!DOCTYPE html>
<html lang="es">
<?php echo $c_funciones->getHeaderNivel2("Creaci&oacute;n de usuarios", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Creaci&oacute;n de usuarios"); ?>
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
					<!-- nombre, apellido, correo, password -->
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<label for="slcTipoUsuarios" >Tipo de usuario</label>
						<select name="tipoUsuarios" id="slcTipoUsuarios">
							<?php 				
							$result = $c_funciones->getTipoUsuarios();					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
							}					
							?>
						</select>	
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<button type="submit" data-theme="a" name="submit" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Agregar usuario</button>
					</div>
				</div>						
			</div>
			<?php echo $c_funciones->getMenuNivel2(); ?>						
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	</html>