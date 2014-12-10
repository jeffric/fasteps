<?php 
session_start();
ob_start();
include_once "funciones.php";
$c_funciones = new Funciones();

if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	$strUsuario = $_POST["username"];
	$strPassword = $_POST["password"];
	$strTipoUsuario = $_POST["slcTipoUsuarios"];
	
	if($c_funciones->ValidarLogin($strUsuario, $strPassword, $strTipoUsuario)){
		//el id se setea en la consulta de la validacion del login
		$_SESSION["Usuario"] = $strUsuario;
		$_SESSION["TipoUsuario"] = $strTipoUsuario;		
	}else{		
		header("Location: index.php?errLog=true");
	}
}else{	
	if(!isset($_SESSION["idUsuario"])){
		if($_SESSION["idUsuario"] == ""){
			header("Location: index.php?errLog=true02");
			return;
		}
	}
}
?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeader("Home", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPage("F.A.S.T. Home"); ?>
		<div class="content">
			<div class="ui-grid-c ui-responsive">
				<div class="ui-block-a" style="text-align: center;">
					<a href="crr/crr.php">
						<img src="img/crr-logo.png" alt="crr-section">
						<h2>CRR</h2>
					</a>
				</div>
				<div class="ui-block-b" style="text-align: center;">
					<a href="sra/">
						<img src="img/sra-logo.png" alt="crr-section">
						<h2>SRA</h2>
					</a>
				</div>
				<div class="ui-block-c" style="text-align: center;">
					<a href="#">
						<img src="img/hiss-logo.png" style="width:80%;" alt="crr-section">
						<h2>HISS CAM</h2>
					</a>					
				</div>
				<div class="ui-block-d" style="text-align: center;">
					<a href="#">
						<img src="img/csr-logo.png" style="width:78%;" alt="crr-section">
						<h2>CSR</h2>
					</a>
				</div>
			</div><!-- /grid-b -->
			<div data-role="controlgroup">
				<a href="reportes.php" data-role="button">Reportes</a>
				<a href="configuracion.php" data-role="button">Configuraci&oacute;n</a>
				<a href="historial.php" data-role="button">Historial</a>
			</div>
		</div>
		<?php echo $c_funciones->getMenu(); ?>
	</div>		
	<?php echo $c_funciones->getFooter(); ?>		
	<!-- FOOTER -->
</body>
</html>