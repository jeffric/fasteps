<?php 
/**
	Author: Jeffric Alexander Fuentes Heiz.
	Author: Luis Roberto Barrios Galdamez

	Project: EPS, Ciencias y Sistemas, USAC. 2014-2015	

	CLASE QUE CONTIENE TODAS LAS FUNCIONES NECESARIAS PARA LA CONSTRUCCION 
	DE LAS DISTINTAS SECCIONES DE LAS PAGINAS

*/

	include_once("dbMng.php");
	class Funciones extends DataBaseManager{

	/**
		Constructor
	*/
		// constructor


// $link = mysql_connect('creativesolitcom.ipagemysql.com', 'vm_user_fast', '*password*'); 
// if (!$link) { 
//     die('Could not connect: ' . mysql_error()); 
// } 
// echo 'Connected successfully'; 
// mysql_select_db(dbfast_vm); 

		function __construct(){
		//$serverName, $port, $db_name, $username, $password
			$serverName = "localhost";
			$port = "3306";
			$db_name = "dbfast_vm";
			// $username = "vm_user_fast";
			$username = "root";
			$password = "admin";
			// $password = "u$3r_*F@$t";
			parent::__construct($serverName, $port, $db_name, $username, $password);		
		}

	/**
		Funcion para obtener todos los imports de librerias de javascript necesarios en la pagina
	*/
		function getJavascriptImports(){
			
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
		function getMenu(){
			echo '	<!-- Menu -->
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
			<!-- /Menu -->';					
		}


		function getMenuNivel2(){
			echo '	<!-- Menu -->
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
			<!-- /Menu -->';	
		}

	/**
		Funcion para construir el footer de cada pagina.
	 */
		function getFooter(){
				echo '	<div class="footer FixedBottom"  style="z-index: 100;">
							<span>Visi&oacute;n Mundial Guatemala,';
				echo date("Y"); 
				echo '			<img src="img/logo-fit.png" style="width:76px; height:25px; margin-top:5px;"/>
							</span>
						</div><!-- /footer -->';

		}

		/**
		FUNCIONES PARA USUARIOS
		*/
		
	}
	?>