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
<?php echo $c_funciones->getHeaderNivel2("Agregar Plan de Prevencion", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); ?>
<body>
	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Agregar"); ?>
		<div class="content">
			<p><strong>AGREGAR PLAN DE PREVENCIÓN</strong><br />
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
		</div>
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->					

	</body>
	</html>