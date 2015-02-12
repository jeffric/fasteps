<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

if($_SESSION["Usuario"] == ""){
	header("Location: ../index.php");
	return;
}

$strTipoUsuario=$_SESSION["TipoUsuario"];
try {
	unset($_SESSION['arrAmenazasSRAActual']);
	unset($_SESSION["idEvalSraActual"]);
	unset($_SESSION["JsonPaso1SRA"]);
} catch (Exception $e) {
	
}
?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("SRA - Inicio", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
$(document).bind("mobileinit", function () {

	$.mobile.ajaxEnabled = false;

});

</script>
<link src="../css/jquery-ui.structure.css" rel="stylesheet">	
<link src="../css/jquery-ui.css" rel="stylesheet">	
<link src="../css/jquery-ui.theme.css" rel="stylesheet">	
<script src="../css/jquery-ui.js"></script>

<script>
	$( document ).bind( "mobileinit", function() {
		$.mobile.hashListeningEnabled = false;
		$.mobile.pushStateEnabled = false;
		$.mobile.changePage.defaults.changeHash = false;
	});
</script>

</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
'); 

?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. SRA"); ?>
		<div class="content">
			<div style="height: 100%; text-align: center;">
				<h1>Elegir objeto a evaluar</h1>
			</div>
			<div >
					<a href="indexPunto.php" data-ajax="false" data-role="button">Punto de evaluaci&oacute;n</a>
					<a href="indexEvento.php" data-ajax="false" data-role="button">Evento</a>					
			</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($_SESSION["TipoUsuario"]); ?>
	</div>		
	<?php echo $c_funciones->getFooterNivel2(); ?>		
	<!-- FOOTER -->
</body>
</html>