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
				F.A.S.T. - CONTACTO
			</div>
			<div style="position: absolute; right:0; top: 0;">
				<img src="img/logo-fit.png" alt="logo" width="100px" />
			</div>
		</div>
		<div class="content" style="padding: 15px 50px 50px 50px;">
			<h1><img src="img/big-logo.png" width="350" height="180" alt="Inicio">&nbsp;&iquest;Hablamos?</h1>
			<p class="normal">Si despu&eacute;s de ver esta web, tienes alg&uacute;n comentario constructivo, quieres que te env&iacute;e mi CV o crees que podr&iacute;a  colaborar con el proyecto que t&uacute; o tu empresa desea llevar a cabo no dudes en rellenar el siguiente <strong>formulario de contacto</strong>.</p>
			<div id="nombre_error" data-role="popup" data-theme="e" data-overlay-theme="b" class="ui-content popups">
				<a href="#" id="nombre_error_c" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-left">Close</a>
				Falta su nombre
			</div>
			<div id="email_error" data-role="popup" data-theme="e" data-overlay-theme="b" class="ui-content popups">
				<a href="#" id="email_error_c" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-left">Close</a>
				Email no v&aacute;lido
			</div>
			<div id="email_vacio" data-role="popup" data-theme="e" data-overlay-theme="b" class="ui-content popups">
				<a href="#" id="email_vacio_c" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-left">Close</a>
				Falta su email
			</div>
			<div id="asunto_error" data-role="popup" data-theme="e" data-overlay-theme="b" class="ui-content popups">
				<a href="#" id="asunto_error_c" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-left">Close</a>
				Falta el asunto
			</div>
			<div id="mensaje_error" data-role="popup" data-theme="e" data-overlay-theme="b" class="ui-content popups">
				<a href="#" id="mensaje_error_c" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-left">Close</a>
				No hay mensaje
			</div>
			<div id="mensaje_no_enviado" data-role="popup" data-theme="e" data-overlay-theme="b" class="ui-content popup_mensaje_correcto">
				<a href="#" id="mensaje_no_enviado_c" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-left">Close</a>
				Mensaje no enviado. Int&eacute;ntelo de nuevo.
			</div>
			<div id="mensaje_enviado" data-role="popup" data-theme="e" data-overlay-theme="b" class="ui-content popup_mensaje_correcto">
				Mensaje enviado correctamente
				<a href="#home" id="mensaje_enviado_c" data-role="button" data-theme="b" data-icon="back" data-direction="reverse">Inicio</a>
			</div>
			<form id="contacto" method="post">
				<div class="ui-body ui-body-a">
					<div data-role="fieldcontain">
						<label for="nombre">Nombre</label>
						<input type="text" name="nombre" id="nombre" placeholder="Nombre y apellidos" />
					</div>
					<div data-role="fieldcontain">
						<label for="email">Email</label>
						<input type="text" name="email" id="email" placeholder="ejemplo@dominio.com" />
					</div>
					<div data-role="fieldcontain">
						<label for="asunto">Asunto</label>
						<input type="text" name="asunto" id="asunto" placeholder="Indique el asunto de su mensaje" />
					</div>
					<div data-role="fieldcontain">
						<label for="mensaje">Mensaje</label>
						<textarea cols="30" rows="5" name="mensaje" id="mensaje" ></textarea>
					</div>
					<button type="submit" id="submit" name="submit" value="submit-value">Enviar</button>
				</div>
			</form>
		</div>
		<nav id="menu">
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="home.php">CRR</a>
					<ul>
						<li><a href="crr/index.php">Evaluar CRR</a></li>
						<li><a href="crr/reportes.php">Reportes CRR</a></li>						
					</ul>
				</li>
				<li><a href="home.php">SRA</a>
					<ul>
						<li><a href="crr/index.php">Evaluar SRA</a></li>
						<li><a href="crr/reportes.php">Reportes SRA</a></li>						
					</ul>
				</li>
				<li><a href="home.php">CSR</a>
					<ul>
						<li><a href="crr/index.php">Evaluar CSR</a></li>
						<li><a href="crr/reportes.php">Reportes CSR</a></li>						
					</ul>
				</li>
				<li><a href="home.php">CRR</a>
					<ul>
						<li><a href="crr/index.php">Evaluar CRR</a></li>
						<li><a href="crr/reportes.php">Reportes CRR</a></li>						
					</ul>
				</li>
				<li><a href="#">Acerca de nosotros</a>
					<ul>
						<li><a href="about/mision.php">Misi&oacute;n</a></li>
						<li><a href="about/vision.php">Visi&oacute;n</a></li>
						<li><a href="about/valores.php">Valores</a></li>
						<li><a href="about/historia.php">Historia</a></li>
					</ul>
				</li>
				<li><a href="#">Acerca de F.A.S.T.</a>
					<ul>
						<li><a href="aboutfast/mision.php">Misi&oacute;n</a></li>
						<li><a href="aboutfast/vision.php">Visi&oacute;n</a></li>
						<li><a href="aboutfast/valores.php">Valores</a></li>
						<li><a href="aboutfast/historia.php">Historia</a></li>
					</ul>
				</li>
				<li><a href="contacto.php">Contacto</a></li>
			</ul>
		</nav>
	</div>
	<!-- FOOTER -->
	<?php $c_funciones->getFooter(); ?>		
</body>
</html>