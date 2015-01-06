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
<?php echo $c_funciones->getHeaderNivel2("Creación de usuarios", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); ?>
<body>
	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Desasignación"); ?>
		<div class="content">
			<p><strong>DESASIGNAR USUARIO-PAIS</strong><br />
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
							$idUsuario = $c_funciones->getIdUsuario($strUsuario);
							$result = $c_funciones->getListaPaisesAsignados($idUsuario);
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
								}							
							}
							?>
						</select>	
					</div>
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<p id="respuesta"></p>
				</div>					
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<button id="btnAsignarUsuario" data-theme="a" name="submit" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Asignar usuario</button>
				</div>					
				</div>													
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>	
		</div>
		<?php echo $c_funciones->getFooterNivel2(); ?>		
	</body>
	</html>