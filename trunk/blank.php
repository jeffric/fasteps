<?php 
session_start();
ob_start();
include_once "funciones.php";
$c_funciones = new Funciones();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Page Title</title>

	<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0 user-scalable=yes">

	<!-- Estilos -->
	<link rel="stylesheet" href="css/jquery.mobile-1.4.4.min.css" />
	
	<!-- Estilos para menu -->
	<link type="text/css" rel="stylesheet" href="css/menu/demo.css" />
	
	<link type="text/css" rel="stylesheet" href="css/menu/jquery.mmenu.all.css" />
	

	<!-- Scripts -->
	<script src="js/jquery-2.1.1.js"></script>
	<script src="js/jquery.mobile-1.4.4.min.js"></script>
	<script src="js/jquery.mobile-1.4.4.min.map"></script>

	<!-- Scripts para menu -->
	<script type="text/javascript" src="js/menu/jquery.mmenu.min.all.js"></script>
	<script type="text/javascript">
		$(function() {
			$('nav#menu').mmenu();
		});
	</script>

	<!-- for the fixed header -->
	<style type="text/css">
		.header,
		.footer
		{
			position: fixed;
			width: 100%;

			box-sizing: border-box;
		}
		.footer
		{
			bottom: 0;
		}
	</style>

</head>
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
			<?php $c_funciones->getMenu(); ?>
		</div>
		<!-- FOOTER -->
		<?php $c_funciones->getFooter(); ?>		
	</body>
	</html>