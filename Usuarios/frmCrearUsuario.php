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
			</div>
			<?php echo $c_funciones->getMenuNivel2(); ?>						
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	</html>