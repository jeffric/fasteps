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
			$db_name = "fastdbvm";
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
							<li><a href="about/mision.php">Misión</a></li>
							<li><a href="about/vision.php">Visión</a></li>
							<li><a href="about/valores.php">Valores</a></li>
							<li><a href="about/historia.php">Historia</a></li>
						</ul>
					</li>
					<li><a href="#">Acerca de F.A.S.T.</a>
						<ul>
							<li><a href="aboutfast/mision.php">Misión</a></li>
							<li><a href="aboutfast/vision.php">Visión</a></li>
							<li><a href="aboutfast/valores.php">Valores</a></li>
							<li><a href="aboutfast/historia.php">Historia</a></li>
						</ul>
					</li>
					<li><a href="contacto.php">Contacto</a></li>
				</ul>
			</nav>
			<!-- /Menu -->';					
		}

		function getHeader($tituloPagina = "", $CodigoDentroDeHeader = ""){
			echo '<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
			<title>' . $tituloPagina . '</title>

			<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0 user-scalable=yes">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<!-- Estilos -->
			<link rel="stylesheet" href="css/jquery.mobile-1.4.4.min.css" />

			<!-- Estilos para menu -->
			<link type="text/css" rel="stylesheet" href="css/menu/demo.css" />

			<link type="text/css" rel="stylesheet" href="css/menu/jquery.mmenu.all.css" />
			
			<!-- scripts para mapas -->
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBY7goEfXlTGN5O4NfL03gzRtTyZoyZMmw&sensor=true&language=en"></script>

			<!-- Scripts -->
			<script src="js/jquery-2.1.1.js"></script>
			<script src="js/jquery.mobile-1.4.4.min.js"></script>
			<script src="js/jquery.mobile-1.4.4.min.map"></script>

			<!-- Scripts para menu -->
			<script type="text/javascript" src="js/menu/jquery.mmenu.min.all.js"></script>
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
			' . $CodigoDentroDeHeader . '
		</head>';
	}

		function getMenuNivel2(){
			echo '	<!-- Menu -->
			<nav id="menu">
				<ul>
					<li><a href="../home.php">Home</a></li>
					<li><a href="../home.php">CRR</a>
						<ul>
							<li><a href="../crr/index.php">Evaluar CRR</a></li>
							<li><a href="../crr/reportes.php">Reportes CRR</a></li>						
						</ul>
					</li>
					<li><a href="../home.php">SRA</a>
						<ul>
							<li><a href="../crr/index.php">Evaluar SRA</a></li>
							<li><a href="../crr/reportes.php">Reportes SRA</a></li>						
						</ul>
					</li>
					<li><a href="../home.php">CSR</a>
						<ul>
							<li><a href="../crr/index.php">Evaluar CSR</a></li>
							<li><a href="../crr/reportes.php">Reportes CSR</a></li>						
						</ul>
					</li>
					<li><a href="../home.php">CRR</a>
						<ul>
							<li><a href="../crr/index.php">Evaluar CRR</a></li>
							<li><a href="../crr/reportes.php">Reportes CRR</a></li>						
						</ul>
					</li>
					<li><a href="#">Acerca de nosotros</a>
						<ul>
							<li><a href="../about/mision.php">Misión</a></li>
							<li><a href="../about/vision.php">Visión</a></li>
							<li><a href="../about/valores.php">Valores</a></li>
							<li><a href="../about/historia.php">Historia</a></li>
						</ul>
					</li>
					<li><a href="#">Acerca de F.A.S.T.</a>
						<ul>
							<li><a href="../aboutfast/mision.php">Misión</a></li>
							<li><a href="../aboutfast/vision.php">Visión</a></li>
							<li><a href="../aboutfast/valores.php">Valores</a></li>
							<li><a href="../aboutfast/historia.php">Historia</a></li>
						</ul>
					</li>
					<li><a href="../contacto.php">Contacto</a></li>
				</ul>
			</nav>
			<!-- /Menu -->';	
		}

		function getHeaderNivel2($tituloPagina = "", $CodigoDentroDeHeader = ""){
			echo '<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
			<title>' . $tituloPagina . '</title>

			<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0 user-scalable=yes">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<!-- Estilos -->
			<link rel="stylesheet" href="../css/jquery.mobile-1.4.4.min.css" />

			<!-- Estilos para menu -->
			<link type="text/css" rel="stylesheet" href="../css/menu/demo.css" />

			<link type="text/css" rel="stylesheet" href="../css/menu/jquery.mmenu.all.css" />

			<!-- Scripts -->
			<script src="../js/jquery-2.1.1.js"></script>
			<script src="../js/jquery.mobile-1.4.4.min.js"></script>
			<script src="../js/jquery.mobile-1.4.4.min.map"></script>

			<!-- scripts para mapas -->
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBY7goEfXlTGN5O4NfL03gzRtTyZoyZMmw&sensor=true&language=en"></script>						

			<!-- Scripts para menu -->
			<script type="text/javascript" src="../js/menu/jquery.mmenu.min.all.js"></script>
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
			' . $CodigoDentroDeHeader . '
		</head>';
	}

	function getHeaderPage($TituloDePagina = ""){
		echo '<div class="header" style="z-index: 100;>
			<a href="#menu"></a>
			<div style="text-align:center; ">
				' . $TituloDePagina . '
			</div>
			<div style="position: absolute; right:0; top: 0; z-index:-2;">
				<img src="img/logo-fit.png" alt="logo" width="100px" />
			</div>
		</div>';
	}

	function getHeaderPageNivel2($TituloDePagina = ""){
		echo '<div class="header" style="z-index: 100;>
			<a href="#menu"></a>
			<div style="text-align:center; ">
				' . $TituloDePagina . '
			</div>
			<div style="position: absolute; right:0; top: 0; z-index:-2;">
				<img src="../img/logo-fit.png" alt="logo" width="100px" />
			</div>
		</div>';
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

		function getFooterNivel2(){
				echo '	<div class="footer FixedBottom"  style="z-index: 100;">
							<span>Visi&oacute;n Mundial Guatemala,';
				echo date("Y"); 
				echo '			<img src="../img/logo-fit.png" style="width:76px; height:25px; margin-top:5px;"/>
							</span>
						</div><!-- /footer -->';

		}

		/**
		FUNCIONES PARA USUARIOS
		*/
		
		function getTipoUsuarios(){
			//tablas,campos,restricciones,agrupacion, ordenamiento
			try {
				$result = $this->db->Consultar("tipo_usuario", " * ");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}
	}
	?>