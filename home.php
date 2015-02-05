<?php 
session_start();
ob_start();
include_once "funciones.php";
$c_funciones = new Funciones();


		if($_SESSION["Usuario"] == ""){
			header("Location: index.php");
			return;
		}

		$strUsuario=$_SESSION["Usuario"];
		$strTipoUsuario=$_SESSION["TipoUsuario"];

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeader("Home", 
	'<script type="text/javascript">
			$(function() {
				$("nav#menu").mmenu();
			});
		</script>'); 

?>

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
								<a href="sra/index.php" data-ajax="false">
								<img src="img/sra-logo.png" style="width:62%;" alt="sra-section">
								<h2>SRA</h2>
								</a>
						</div>
						<div class="ui-block-c" style="text-align: center;">
								<a href="#">
								<img src="img/hiss-logo.png" style="width:63%;" alt="crr-section">
								<h2>HISS CAM</h2>
								</a>					
						</div>
						<div class="ui-block-d" style="text-align: center;">
								<a href="#">
								<img src="img/csr-logo.png" style="width:62%;" alt="crr-section">
								<h2>CSR</h2>
								</a>
						</div>
			</div><!-- /grid-b -->
			<div >
					<a href="reportes.php" data-role="button">Reportes</a>
					<a href="configuracion.php" data-role="button">Configuración</a>
					<a href="historial.php" data-role="button">Historial</a>
			</div>

	</div>

		<?php echo $c_funciones->getMenu($strTipoUsuario); ?>

	
		<?php echo $c_funciones->getFooter(); ?>		
		<!-- FOOTER -->		
		
</div>	

	
<script>



</script>

	
</body>
</html>