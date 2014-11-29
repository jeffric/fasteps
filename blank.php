<?php 
session_start();
ob_start();
include_once "funciones.php";
$c_funciones = new Funciones();
?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeader("Master page", 
	'<script type="text/javascript">
		$(function() {
			$("nav#menu").mmenu();
		});
	</script>'); ?>
<body>

	<div id="page">
		<div class="header">
			<a href="#menu"></a>
			<div style="text-align:center;">
				F.A.S.T.
			</div>
			<div style="position: absolute; right:0; top: 0;">
				<img src="img/logo-fit.png" alt="logo" width="100px" />
			</div>
		</div>
		<div class="content">
			<p><strong>CONTENIDO ACA</strong><br />				
			</div>
			<?php echo $c_funciones->getMenu(); ?>
		</div>
		<!-- FOOTER -->
		<?php echo $c_funciones->getFooter(); ?>		
	</body>
	</html>