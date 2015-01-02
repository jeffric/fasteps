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
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Creación"); ?>
		<div class="content">
			<p><strong>CREACIÓN DE USUARIOS</strong><br />
			</div>

		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>			
	</body>
	<?php echo $c_funciones->getFooterNivel2(); ?>		
	</html>