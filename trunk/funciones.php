<?php 
/**
	Author: Jeffric Alexander Fuentes Heiz.
	Author: Luis Roberto Barrios Galdamez

	Project: EPS, Ciencias y Sistemas, USAC. 2014-2015	

	CLASE QUE CONTIENE TODAS LAS FUNCIONES NECESARIAS PARA LA CONSTRUCCION 
	DE LAS DISTINTAS SECCIONES DE LAS PAGINAS

*/
class Funciones{

	/**
		Constructor
	*/
		function __construct(){			
		}

	/**
		Funcion para obtener todos los imports de librerias de javascript necesarios en la pagina
	*/
		function getJavascriptImports(){
			echo '<script src="' . substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT'])). '\js\jquery.js"></script>';
			echo '<script src="' . substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT']))  . '\_assets\js\index.js"></script>';
			echo '<script src="' . substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT']))  . '\js\jquery.mobile-1.4.3.min.js"></script>';
		}
	
	/**
		Funcion para obtener todos los imports de librerias CSS necesarias para la pagina.	
	*/
		function getCssImports(){
			echo '<link rel="stylesheet" href="' . substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT'])) . '\css\jquery.mobile-1.4.3.min.css">';
			echo '<link rel="stylesheet" href="' . substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT'])) . '\css\jqm-demos.css">';
		}

	/**
		Funcion para construir el menu superior y lateral
	*/
		function getMenu($TituloHeader,$carpeta){
			echo '	<!-- Menu -->
					<div data-role="header" data-theme="b" style="position:fixed; width:100%;">
						<h1>F.A.S.T. ' . $TituloHeader . '</h1>
						<a href="#left-panel" data-theme="d" data-icon="arrow-r" data-iconpos="notext" data-shadow="false" data-iconshadow="false" class="ui-icon-nodisc">Open left panel</a>						
					</div>

					<div data-role="panel" id="left-panel" data-theme="b">
						<ul data-role="listview">
							<li data-icon="back"><a href="#" data-rel="close">Close</a></li>
							<li> External panel</li>
							<li><a href="' . substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT'])) . "\\" . $carpeta .'\home.php" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-star">Home</a></li>
							<li><a href="#" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-star">Favoritos</a></li>
							<li> <a href="#" class="ui-btn ui-shadow ui-corner-all ui-btn-icon-left ui-icon-location">PDA\'s</a> 
								<ul data-role="listview">
									<li> External panel</li>
									<li> External panel</li>
									<li> External panel</li>
								</ul>
							</li>
						</ul>			
					</div><!-- /Menu -->';
		}

	/**
		Funcion para construir el footer de cada pagina.
	*/
		function getFooter(){
			echo '	<div data-role="footer" data-theme="a">
					<h4>Visi&oacute;n Mundial Guatemala,';
			echo date("Y"); 
			echo '	<img src="img/logo-fit.png" style="width:76px; height:25px; padding-left:10px;"/></h4>
					</div><!-- /footer -->';

		}
}
?>