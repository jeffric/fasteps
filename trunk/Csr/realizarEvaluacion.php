<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

$idUsuario = $c_funciones->getIdUsuario($strUsuario);

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$idUsuario = $_SESSION["idUsuario"];
	$idPais = $_POST["lstPais"];
	$idPuntoEvaluacion = $_POST["lstPuntoEvaluacion"];
	$FechaElaboracion = $_POST["txtFecha"];
	$strElaboradoPor = $_POST["txtCreador"];

	$idEvaluacion = $c_funciones->CrearEvaluacionSra($idUsuario, $FechaElaboracion, $strElaboradoPor, $idPuntoEvaluacion);	
	$_SESSION["idEvalSraActual"] = $idEvaluacion;
}*/

$idPtoEvaluacion = $_GET['idPtoEvaluacion'];

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Evaluacion CSR", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); ?>
<body>
	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. CSR"); ?>
		<div class="content">
			<p><strong>EVALUACIÓN CSR</strong><br />
		<fieldset data-role="controlgroup">
	    <label>
	        <input type="checkbox" name="checkbox1"> Cumple con requerimiento de seguridad 1?
	    </label>	
	    
	    <label>
	        <input type="checkbox" name="checkbox2">Cumple con requerimiento de seguridad 2?
	    </label>	

	    <label>
	        <input type="checkbox" name="checkbox3">Cumple con requerimiento de seguridad 3?
	    </label>
		</fieldset>
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>			

		</div>
		<?php echo $c_funciones->getFooterNivel2(); ?>	
	</body>
	</html>