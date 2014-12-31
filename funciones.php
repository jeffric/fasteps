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
		function getMenu($strTipoUsuario){
			if($strTipoUsuario==1)
			{
							echo '	<!-- Menu -->
							<nav id="menu" >
								<ul>
									<li><a href="home.php"><center>F.A.S.T. MENU</center></a></li>
									<li><a href="home.php">MOFIFICAR MI INFORMACION</a>
									</li>	
									<li><a href="home.php">USUARIOS</a>
										<ul>
											<li><a href=Usuarios/blank.php?TipoUsuario='.md5($strTipoUsuario).' data-ajax="false">CREAR USUARIO</a></li>
											<li><a href="home.php">ASIGNAR USUARIO A PAIS</a></li>	
											<li><a href="home.php">DESASIGNAR USUARIO A PAIS</a></li>
											<li><a href="home.php">ASIGNAR USUARIO A EVENTO</a></li>		
											<li><a href="home.php">DESASIGNAR USUARIO A EVENTO</a></li>																						
											<li><a href="home.php">MODIFICAR INFORMACION USUARIO</a></li>
											<li><a href="home.php">ELIMINAR USUARIO </a></li>					
										</ul>									
									</li>	
									<li><a href="home.php">AGREGAR INFORMACION A FAST</a>
										<ul>
											<li><a href="home.php">AGREGAR PAIS</a></li>
											<li><a href="home.php">AGREGAR REGION</a></li>	
											<li><a href="home.php">AGREGAR PUNTO DE EVALUACION</a></li>	
											<li><a href="home.php">AGREGAR EVENTO</a></li>																												
										</ul>
									</li>	
									<li><a href="home.php">MODIFICAR INFORMACION DE FAST</a>
										<ul>
											<li><a href="home.php">MODIFICAR PAIS</a></li>
											<li><a href="home.php">MODIFICAR REGION</a></li>			
											<li><a href="home.php">MODIFICAR PUNTO DE EVALUACION</a></li>
											<li><a href="home.php">MODIFICAR EVENTO</a></li>																											
										</ul>
									</li>									
									<li><a href="home.php">ELIMINAR INFORMACION DE FAST</a>
										<ul>
											<li><a href="home.php">ELIMINAR PAIS</a></li>
											<li><a href="home.php">ELIMINAR REGION</a></li>			
											<li><a href="home.php">ELIMINAR PUNTO DE EVALUACION</a></li>
											<li><a href="home.php">ELIMINAR EVENTO</a></li>																											
										</ul>
									</li>																																																						
									<li><a href="home.php">CRR</a>
										<ul>
											<li><a href="home.php">EVALUAR CRR</a></li>
											<li><a href="home.php">REPORTES CRR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">SRA</a>
										<ul>
											<li><a href="sra/index.php">EVALUAR SRA</a></li>
											<li><a href="home.php">REPORTES SRA</a>
												<ul>
												<li><a href="home.php">PUNTOS DE EVALUACION</a></li>
												<li><a href="home.php">EVENTOS</a></li>
												</ul>
											</li>						
										</ul>
									</li>
									<li><a href="home.php">CSR</a>
										<ul>
											<li><a href="home.php">EVALUAR CSR</a></li>
											<li><a href="home.php">REPORTES CSR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">HISS-CAM</a>
										<ul>
											<li><a href="home.php">EVALUAR HISS-CAM</a></li>
											<li><a href="home.php">REPORTES HISS-CAM</a></li>						
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
									<li><a href="#">Acerca de F.A.S.T. Menu Super Admin</a>
										<ul>
											<li><a href="aboutfast/mision.php">Misión</a></li>
											<li><a href="aboutfast/vision.php">Visión</a></li>
											<li><a href="aboutfast/valores.php">Valores</a></li>
											<li><a href="aboutfast/historia.php">Historia</a></li>
										</ul>
									</li>
									<li><a href="contacto.php">Contacto</a></li>
									<li><a href="logOut.php">Log Out</a></li>
								</ul>
							</nav>
							<!-- /Menu -->';					
			}
			else if($strTipoUsuario==2)
			{
							echo '	<!-- Menu -->
							<nav id="menu" >
								<ul>
									<li><a href="home.php"><center>F.A.S.T. MENU</center></a></li>
									<li><a href="home.php">MOFIFICAR MI INFORMACION</a>
									</li>		
									<li><a href="home.php">USUARIOS</a>
										<ul>
											<li><a href="Usuarios/frmCrearUsuario.php">CREAR USUARIO</a></li>
											<li><a href="home.php">ASIGNAR USUARIO A PAIS</a></li>												
											<li><a href="home.php">DESASIGNAR USUARIO A PAIS</a></li>
											<li><a href="home.php">ASIGNAR USUARIO A EVENTO</a></li>	
											<li><a href="home.php">DESASIGNAR USUARIO A EVENTO</a></li>																							
											<li><a href="home.php">MODIFICAR INFORMACION USUARIO</a></li>
											<li><a href="home.php">ELIMINAR USUARIO </a></li>					
										</ul>									
									</li>																	
									<li><a href="home.php">CRR</a>
										<ul>
											<li><a href="home.php">EVALUAR CRR</a></li>
											<li><a href="home.php">REPORTES CRR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">SRA</a>
										<ul>
											<li><a href="home.php">EVALUAR SRA</a></li>
											<li><a href="home.php">REPORTES SRA</a>
												<ul>
												<li><a href="home.php">PUNTOS DE EVALUACION</a></li>
												<li><a href="home.php">EVENTOS</a></li>
												</ul>
											</li>						
										</ul>
									</li>
									<li><a href="home.php">CSR</a>
										<ul>
											<li><a href="home.php">EVALUAR CSR</a></li>
											<li><a href="home.php">REPORTES CSR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">HISS-CAM</a>
										<ul>
											<li><a href="home.php">EVALUAR HISS-CAM</a></li>
											<li><a href="home.php">REPORTES HISS-CAM</a></li>						
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
									<li><a href="#">Acerca de F.A.S.T. menu Admin Pais</a>
										<ul>
											<li><a href="aboutfast/mision.php">Misión</a></li>
											<li><a href="aboutfast/vision.php">Visión</a></li>
											<li><a href="aboutfast/valores.php">Valores</a></li>
											<li><a href="aboutfast/historia.php">Historia</a></li>
										</ul>
									</li>
									<li><a href="contacto.php">Contacto</a></li>
									<li><a href="logOut.php">Log Out</a></li>
								</ul>
							</nav>
							<!-- /Menu -->';	

			}
			else if($strTipoUsuario==3)
			{							echo '	<!-- Menu -->
							<nav id="menu" >
								<ul>
									<li><a href="home.php"><center>F.A.S.T. MENU</center></a></li>
									<li><a href="home.php">MOFIFICAR MI INFORMACION</a>
									</li>										
									<li><a href="home.php">CRR</a>
										<ul>
											<li><a href="home.php">EVALUAR CRR</a></li>
											<li><a href="home.php">REPORTES CRR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">SRA</a>
										<ul>
											<li><a href="home.php">EVALUAR SRA</a></li>
											<li><a href="home.php">REPORTES SRA</a>
												<ul>
												<li><a href="home.php">PUNTOS DE EVALUACION</a></li>
												<li><a href="home.php">EVENTOS</a></li>
												</ul>
											</li>						
										</ul>
									</li>
									<li><a href="home.php">CSR</a>
										<ul>
											<li><a href="home.php">EVALUAR CSR</a></li>
											<li><a href="home.php">REPORTES CSR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">HISS-CAM</a>
										<ul>
											<li><a href="home.php">EVALUAR HISS-CAM</a></li>
											<li><a href="home.php">REPORTES HISS-CAM</a></li>						
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
									<li><a href="#">Acerca de F.A.S.T. menu Reportero</a>
										<ul>
											<li><a href="aboutfast/mision.php">Misión</a></li>
											<li><a href="aboutfast/vision.php">Visión</a></li>
											<li><a href="aboutfast/valores.php">Valores</a></li>
											<li><a href="aboutfast/historia.php">Historia</a></li>
										</ul>
									</li>
									<li><a href="contacto.php">Contacto</a></li>
									<li><a href="logOut.php">Log Out</a></li>
								</ul>
							</nav>
							<!-- /Menu -->';	

			}
			else if($strTipoUsuario==4)
			{
							echo '	<!-- Menu -->
							<nav id="menu" >
								<ul>
									<li><a href="home.php"><center>F.A.S.T. MENU</center></a></li>
									<li><a href="home.php">MOFIFICAR MI INFORMACION</a>
									</li>										
									<li><a href="home.php">CRR</a>
										<ul>
											<li><a href="home.php">REPORTES CRR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">SRA</a>
										<ul>
											<li><a href="home.php">REPORTES SRA</a>
												<ul>
												<li><a href="home.php">PUNTOS DE EVALUACION</a></li>
												<li><a href="home.php">EVENTOS</a></li>
												</ul>
											</li>						
										</ul>
									</li>
									<li><a href="home.php">CSR</a>
										<ul>
											<li><a href="home.php">REPORTES CSR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">HISS-CAM</a>
										<ul>
											<li><a href="home.php">REPORTES HISS-CAM</a></li>						
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
									<li><a href="#">Acerca de F.A.S.T. menu Consultor</a>
										<ul>
											<li><a href="aboutfast/mision.php">Misión</a></li>
											<li><a href="aboutfast/vision.php">Visión</a></li>
											<li><a href="aboutfast/valores.php">Valores</a></li>
											<li><a href="aboutfast/historia.php">Historia</a></li>
										</ul>
									</li>
									<li><a href="contacto.php">Contacto</a></li>
									<li><a href="logOut.php">Log Out</a></li>
								</ul>
							</nav>
							<!-- /Menu -->';	

			}
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

			<!-- libreria para alertas -->
			<script src="js/sweet-alert.js"></script>
			<link rel="stylesheet" href="css/sweet-alert.css">
			

			<!-- Scripts para menu -->
			<script type="text/javascript" src="js/menu/jquery.mmenu.min.all.js"></script>
			<!-- for the fixed header -->
			<style type="text/css">
				.header,
				.footer
				{
					position: fixed;
					width: 100%;
					z-index: 100;

					box-sizing: border-box;
				}
				.footer
				{
					bottom: 0;
				}
			</style>
			' . $CodigoDentroDeHeader . 


			'

			<script type="text/javascript">
				function mostrarMensaje(TituloMensaje, CuerpoMensaje, TipoMensaje){
					swal(TituloMensaje, CuerpoMensaje, TipoMensaje);
				}
			</script>
		</head>';
	}

	function getMenuNivel2(){
			if($strTipoUsuario==1)
			{
							echo '	<!-- Menu -->
							<nav id="menu" >
								<ul>
									<li><a href="home.php"><center>F.A.S.T. MENU</center></a></li>
									<li><a href="home.php">MOFIFICAR MI INFORMACION</a>
									</li>	
									<li><a href="home.php">USUARIOS</a>
										<ul>
											<li><a href="Usuarios/blank.php?TipoUsuario='.md5($strTipoUsuario).'>CREAR USUARIO</a></li>
											<li><a href="home.php">ASIGNAR USUARIO A PAIS</a></li>	
											<li><a href="home.php">DESASIGNAR USUARIO A PAIS</a></li>
											<li><a href="home.php">ASIGNAR USUARIO A EVENTO</a></li>		
											<li><a href="home.php">DESASIGNAR USUARIO A EVENTO</a></li>																						
											<li><a href="home.php">MODIFICAR INFORMACION USUARIO</a></li>
											<li><a href="home.php">ELIMINAR USUARIO </a></li>					
										</ul>									
									</li>	
									<li><a href="home.php">AGREGAR INFORMACION A FAST</a>
										<ul>
											<li><a href="home.php">AGREGAR PAIS</a></li>
											<li><a href="home.php">AGREGAR REGION</a></li>	
											<li><a href="home.php">AGREGAR PUNTO DE EVALUACION</a></li>	
											<li><a href="home.php">AGREGAR EVENTO</a></li>																												
										</ul>
									</li>	
									<li><a href="home.php">MODIFICAR INFORMACION DE FAST</a>
										<ul>
											<li><a href="home.php">MODIFICAR PAIS</a></li>
											<li><a href="home.php">MODIFICAR REGION</a></li>			
											<li><a href="home.php">MODIFICAR PUNTO DE EVALUACION</a></li>
											<li><a href="home.php">MODIFICAR EVENTO</a></li>																											
										</ul>
									</li>									
									<li><a href="home.php">ELIMINAR INFORMACION DE FAST</a>
										<ul>
											<li><a href="home.php">ELIMINAR PAIS</a></li>
											<li><a href="home.php">ELIMINAR REGION</a></li>			
											<li><a href="home.php">ELIMINAR PUNTO DE EVALUACION</a></li>
											<li><a href="home.php">ELIMINAR EVENTO</a></li>																											
										</ul>
									</li>																																																						
									<li><a href="home.php">CRR</a>
										<ul>
											<li><a href="home.php">EVALUAR CRR</a></li>
											<li><a href="home.php">REPORTES CRR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">SRA</a>
										<ul>
											<li><a href="sra/index.php">EVALUAR SRA</a></li>
											<li><a href="home.php">REPORTES SRA</a>
												<ul>
												<li><a href="home.php">PUNTOS DE EVALUACION</a></li>
												<li><a href="home.php">EVENTOS</a></li>
												</ul>
											</li>						
										</ul>
									</li>
									<li><a href="home.php">CSR</a>
										<ul>
											<li><a href="home.php">EVALUAR CSR</a></li>
											<li><a href="home.php">REPORTES CSR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">HISS-CAM</a>
										<ul>
											<li><a href="home.php">EVALUAR HISS-CAM</a></li>
											<li><a href="home.php">REPORTES HISS-CAM</a></li>						
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
									<li><a href="#">Acerca de F.A.S.T. Menu Super Admin</a>
										<ul>
											<li><a href="aboutfast/mision.php">Misión</a></li>
											<li><a href="aboutfast/vision.php">Visión</a></li>
											<li><a href="aboutfast/valores.php">Valores</a></li>
											<li><a href="aboutfast/historia.php">Historia</a></li>
										</ul>
									</li>
									<li><a href="contacto.php">Contacto</a></li>
									<li><a href="logOut.php">Log Out</a></li>
								</ul>
							</nav>
							<!-- /Menu -->';					
			}
			else if($strTipoUsuario==2)
			{
							echo '	<!-- Menu -->
							<nav id="menu" >
								<ul>
									<li><a href="home.php"><center>F.A.S.T. MENU</center></a></li>
									<li><a href="home.php">MOFIFICAR MI INFORMACION</a>
									</li>		
									<li><a href="home.php">USUARIOS</a>
										<ul>
											<li><a href="Usuarios/frmCrearUsuario.php">CREAR USUARIO</a></li>
											<li><a href="home.php">ASIGNAR USUARIO A PAIS</a></li>												
											<li><a href="home.php">DESASIGNAR USUARIO A PAIS</a></li>
											<li><a href="home.php">ASIGNAR USUARIO A EVENTO</a></li>	
											<li><a href="home.php">DESASIGNAR USUARIO A EVENTO</a></li>																							
											<li><a href="home.php">MODIFICAR INFORMACION USUARIO</a></li>
											<li><a href="home.php">ELIMINAR USUARIO </a></li>					
										</ul>									
									</li>																	
									<li><a href="home.php">CRR</a>
										<ul>
											<li><a href="home.php">EVALUAR CRR</a></li>
											<li><a href="home.php">REPORTES CRR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">SRA</a>
										<ul>
											<li><a href="home.php">EVALUAR SRA</a></li>
											<li><a href="home.php">REPORTES SRA</a>
												<ul>
												<li><a href="home.php">PUNTOS DE EVALUACION</a></li>
												<li><a href="home.php">EVENTOS</a></li>
												</ul>
											</li>						
										</ul>
									</li>
									<li><a href="home.php">CSR</a>
										<ul>
											<li><a href="home.php">EVALUAR CSR</a></li>
											<li><a href="home.php">REPORTES CSR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">HISS-CAM</a>
										<ul>
											<li><a href="home.php">EVALUAR HISS-CAM</a></li>
											<li><a href="home.php">REPORTES HISS-CAM</a></li>						
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
									<li><a href="#">Acerca de F.A.S.T. menu Admin Pais</a>
										<ul>
											<li><a href="aboutfast/mision.php">Misión</a></li>
											<li><a href="aboutfast/vision.php">Visión</a></li>
											<li><a href="aboutfast/valores.php">Valores</a></li>
											<li><a href="aboutfast/historia.php">Historia</a></li>
										</ul>
									</li>
									<li><a href="contacto.php">Contacto</a></li>
									<li><a href="logOut.php">Log Out</a></li>
								</ul>
							</nav>
							<!-- /Menu -->';	

			}
			else if($strTipoUsuario==3)
			{							echo '	<!-- Menu -->
							<nav id="menu" >
								<ul>
									<li><a href="home.php"><center>F.A.S.T. MENU</center></a></li>
									<li><a href="home.php">MOFIFICAR MI INFORMACION</a>
									</li>										
									<li><a href="home.php">CRR</a>
										<ul>
											<li><a href="home.php">EVALUAR CRR</a></li>
											<li><a href="home.php">REPORTES CRR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">SRA</a>
										<ul>
											<li><a href="home.php">EVALUAR SRA</a></li>
											<li><a href="home.php">REPORTES SRA</a>
												<ul>
												<li><a href="home.php">PUNTOS DE EVALUACION</a></li>
												<li><a href="home.php">EVENTOS</a></li>
												</ul>
											</li>						
										</ul>
									</li>
									<li><a href="home.php">CSR</a>
										<ul>
											<li><a href="home.php">EVALUAR CSR</a></li>
											<li><a href="home.php">REPORTES CSR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">HISS-CAM</a>
										<ul>
											<li><a href="home.php">EVALUAR HISS-CAM</a></li>
											<li><a href="home.php">REPORTES HISS-CAM</a></li>						
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
									<li><a href="#">Acerca de F.A.S.T. menu Reportero</a>
										<ul>
											<li><a href="aboutfast/mision.php">Misión</a></li>
											<li><a href="aboutfast/vision.php">Visión</a></li>
											<li><a href="aboutfast/valores.php">Valores</a></li>
											<li><a href="aboutfast/historia.php">Historia</a></li>
										</ul>
									</li>
									<li><a href="contacto.php">Contacto</a></li>
									<li><a href="logOut.php">Log Out</a></li>
								</ul>
							</nav>
							<!-- /Menu -->';	

			}
			else if($strTipoUsuario==4)
			{
							echo '	<!-- Menu -->
							<nav id="menu" >
								<ul>
									<li><a href="home.php"><center>F.A.S.T. MENU</center></a></li>
									<li><a href="home.php">MOFIFICAR MI INFORMACION</a>
									</li>										
									<li><a href="home.php">CRR</a>
										<ul>
											<li><a href="home.php">REPORTES CRR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">SRA</a>
										<ul>
											<li><a href="home.php">REPORTES SRA</a>
												<ul>
												<li><a href="home.php">PUNTOS DE EVALUACION</a></li>
												<li><a href="home.php">EVENTOS</a></li>
												</ul>
											</li>						
										</ul>
									</li>
									<li><a href="home.php">CSR</a>
										<ul>
											<li><a href="home.php">REPORTES CSR</a></li>						
										</ul>
									</li>
									<li><a href="home.php">HISS-CAM</a>
										<ul>
											<li><a href="home.php">REPORTES HISS-CAM</a></li>						
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
									<li><a href="#">Acerca de F.A.S.T. menu Consultor</a>
										<ul>
											<li><a href="aboutfast/mision.php">Misión</a></li>
											<li><a href="aboutfast/vision.php">Visión</a></li>
											<li><a href="aboutfast/valores.php">Valores</a></li>
											<li><a href="aboutfast/historia.php">Historia</a></li>
										</ul>
									</li>
									<li><a href="contacto.php">Contacto</a></li>
									<li><a href="logOut.php">Log Out</a></li>
								</ul>
							</nav>
							<!-- /Menu -->';	

			}	
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

		<!-- libreria para alertas -->
		<script src="../js/sweet-alert.js"></script>
		<link rel="stylesheet" href="../css/sweet-alert.css">
		

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
				z-index: 100;
				box-sizing: border-box;
			}
			.footer
			{
				bottom: 0;
			}
		</style>
		' . $CodigoDentroDeHeader . '


		<script type="text/javascript">
			function mostrarMensaje(TituloMensaje, CuerpoMensaje, TipoMensaje){
				swal(TituloMensaje, CuerpoMensaje, TipoMensaje);
			}
		</script>


	</head>';
}

function getHeaderPage($TituloDePagina = ""){
	echo '<div class="header" >
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
	echo '<div class="header">
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
		</div><!-- /footer -->

		<script type="text/javascript">
			function mostrarMensaje(TituloMensaje, CuerpoMensaje, TipoMensaje){
				swal(TituloMensaje, CuerpoMensaje, TipoMensaje);
			}
		</script>
		';

	}

	function getFooterNivel2(){
		echo '	<div class="footer FixedBottom"  style="z-index: 100;">
		<span>Visi&oacute;n Mundial Guatemala,';
			echo date("Y"); 
			echo '			<img src="../img/logo-fit.png" style="width:76px; height:25px; margin-top:5px;"/>
		</span>
	</div><!-- /footer -->

	
	';

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

		function InsertarUsuario($strNombreUsuario, $strApellidoUsuario, $strCorreoUsuario, $strPassword, $intTipoUsuario, $strPaisUsuario){
			//validaciones 
			
			//nombre no vacio
			if($strNombreUsuario == ""){
				echo 'El nombre del usuario no puede ser vacío.';
				return;
			}

			//Apellido no vacio
			if($strApellidoUsuario == ""){
				echo 'El apellido del usuario no puede ser vacío.';
				return;
			}

			if($strCorreoUsuario == ""){
				echo 'El correo del usuario no puede ser vacío.';
				return;
			}

			if($strPassword == ""){
				echo 'El password del usuario no puede ser vacío.';
				return;
			}

			if($intTipoUsuario == null || $intTipoUsuario == ""){
				echo 'Debe elegir un tipo de usuario.';
				return;
			}

			if($strPaisUsuario == null || $strPaisUsuario == ""){
				echo 'Debe elegir un país para el usuario.';
				return;
			}

			//validaciones han pasado
			//inicia la insercion
			try {
				$strTabla = " usuario ";
				$strCampos = " nombre, apellido, correo, password, fk_idTIPO_USUARIO "; 
				$strValores = " '" . $strNombreUsuario . "', '" . $strApellidoUsuario . "', '" . $strCorreoUsuario . "', " ; 
				$strValores .= " '" . $this->getMD5($strPassword) . "', " . $intTipoUsuario . " " ;
				$idInsertado = $this->db->InsertarIdentity($strTabla, $strCampos, $strValores);				
				//se inserta el pais con el usuario  en la tabla asignacion_usuario_pais				
				$strTablaPais = " asignacion_usuario_pais ";
				$strCamposPais = " fk_idPAIS,fk_idUSUARIO ";
				$strValoresPais = $strPaisUsuario . "," . $idInsertado . " ";
				$result2 = $this->db->Insertar($strTablaPais, $strCamposPais, $strValoresPais);
				if($result2){
					return 1;
				}else{
					return -2;
				}
			} catch (Exception $e) {
				//no se pudo realizar la insercion
				echo 'Error al insertar el nuevo usuario: ' . $e->getMessage();
				return;
			}
		}

		/**
		FUNCIONES PARA PAISES
		*/
		function getListaPaises($idUsuarioLogeado = ""){
			//carga en un select, el id y nombre de todos los paises
			try {
				$strTabla = "";				
				$strCampos = "";
				$strRestricciones = "";
				if($idUsuarioLogeado != ""){
					$strTabla = " pais p, asignacion_usuario_pais aup ";
					$strCampos = " p.* ";
					$strRestricciones = " p.idPAIS = aup.fk_idPAIS AND aup.fk_idUSUARIO = " . $idUsuarioLogeado . " ";
				}else{
					$strTabla = " pais ";
					$strCampos = " * ";
					$strRestricciones = "";
				}
				$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones);
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function getNombrePais($idPais){
			//devuelve el nombre de un pais especifico
			try {
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM PAIS WHERE idPAIS='$idPais'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function verificarExistenciaPais($variable){
			//verifica si ya existe un pais con dicho nombre
			try {
				$nombrePais=trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM PAIS WHERE nombre='$nombrePais'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					if(strcasecmp($row[0],$nombrePais)==0){

						echo true;
					}
					else{
						echo false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	
			

		function insertarPais($nombrePais, $idRegion){
			//agrega un nuevo pais al sistema
			try {
				$result = $this->db->ExecutePersonalizado("INSERT INTO PAIS (nombre, fk_idREGION) VALUES('$nombrePais', $idRegion)");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function eliminarPais($pais){
			//elimina pais del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM PAIS WHERE idPais='$pais'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}				

		/**
		FUNCIONES PARA REGIONES
		*/
		function getListaRegiones(){
			//carga en un select, el id y nombre de todas las regiones
			try {
				$result = $this->db->Consultar("region", " * ");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}	

		function verificarExistenciaRegion($variable){
			//verifica si ya existe un pais con dicho nombre
			try {
				$nombreRegion=trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM REGION WHERE nombre='$nombreRegion'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					if(strcasecmp($row[0],$nombreRegion)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function insertarRegion($nombreRegion){
			//agrega una nueva region al sistema
			try {
				$result = $this->db->ExecutePersonalizado("INSERT INTO REGION (nombre) VALUES('$nombreRegion')");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function eliminarRegion($region){
			//elimina region del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM REGION WHERE idRegion='$region'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}
		/**
		 FUNCIONES PARA PUNTOS DE EVALUACION
		 */
		function verificarExistenciaPtoEvaluacion($variable, $idPais){
			//verifica si ya existe un Punto de Evaluacion con dicho nombre
			try {
				$nombrePtoEvaluacion = trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre, PAIS_idPAIS FROM PUNTO_EVALUACION WHERE nombre='$nombrePtoEvaluacion' AND PAIS_idPAIS='$idPais'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								if(strcasecmp($row[0],$nombrePtoEvaluacion)==0 AND strcasecmp($row[1],$idPais)==0 ){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function insertarPtoEvaluacion($nombrePtoEvaluacion, $latitud, $longitud, $descripcion, $idPais){
			//agrega un  Punto de Evaluacion al sistema
			try {
				$result = $this->db->ExecutePersonalizado("INSERT INTO PUNTO_EVALUACION (nombre, latitud, longitud, descripcion, PAIS_idPAIS) VALUES ('$nombrePtoEvaluacion', '$latitud','$longitud', '$descripcion', '$idPais')");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function getListaPtosEvaluacion($pais){
			try{
				$result = $this->db->ExecutePersonalizado("SELECT idPUNTO_EVALUACION, nombre FROM PUNTO_EVALUACION WHERE PAIS_idPAIS='$pais'");
				return $result;
			}catch(Exception $e){
				echo 'Error: ' .$e->getMessage();
			}

		}

		function eliminarPtoEvaluacion($ptoEvaluacion){
			//elimina un Punto de Evaluacion del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM PUNTO_EVALUACION WHERE idPUNTO_EVALUACION='$ptoEvaluacion'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}						

		/**
		FUNCIONES PARA AMENAZAS
		*/	

		function getAmenazas($idAmenaza = -1){
			$strHtml = "";
			$strTabla = " amenaza ";
			$strCampos = " * ";
			$strRestricciones = "";
			if($idAmenaza != -1){
				$strRestricciones .= " idAMENAZA = " . $idAmenaza . " ";
			}			
			try {
				$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function getListaAmenazas(){
			//carga en un select, el id y nombre de todas las amenazas
			try {
				$result = $this->db->Consultar("amenaza", " * ");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}		

		function verificarExistenciaAmenaza($variable){
			//verifica si ya existe una Amenaza con dicho nombre
			try {
				$nombreAmenaza = trim($variable," \t\n\r\0\x0B");
				$result = $this->db->ExecutePersonalizado("SELECT nombre FROM AMENAZA WHERE nombre='$nombreAmenaza'");
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								if(strcasecmp($row[0],$nombreAmenaza)==0){

						return true;
					}
					else{
						return false;
					}

				}
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}


		function insertarAmenaza($nombreAmenaza, $descripcion){
			//agrega una Amenza al sistema
			try {
				$result = $this->db->ExecutePersonalizado("INSERT INTO AMENAZA (nombre, descripcion) VALUES ('$nombreAmenaza', '$descripcion')");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}

		function eliminarAmenaza($amenaza){
			//elimina una Amenaza del sistema
			try {
				$result = $this->db->ExecutePersonalizado("DELETE FROM AMENAZA WHERE idAMENAZA='$amenaza'");
				return $result;
			} catch (Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}
		}						


/**
	FUNCIONES PARA PUNTOS DE EVALUACION
*/
	function ConsultarPuntosEvaluacion($intIdPais = -1){		
		$strTabla = " punto_evaluacion ";
		$strCampos = " * ";
		$strRestricciones = "";
		if($intIdPais != -1){
			$strRestricciones = " PAIS_idPAIS = " . $intIdPais . " ";
		}
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	/**
		FUNCIONES VARIAS
	*/
		function getMD5($strPassword){
			return md5($strPassword);
		}



/**
	FUNCIONES PARA EVALUACION SRA
*/
	//insertamos una nueva evaluacion 
	function CrearEvaluacionSra($intIdUsuario, $strFecha, $strElaboradoPor, $intIdPuntoEvaluacion = -1, $intIdEvento = -1){
		//CrearEvaluacionSra($idUsuario, $FechaElaboracion, $strElaboradoPor, $idPuntoEvaluacion);
		try {
			$strTabla = " evaluacion ";
			$strCampos = " fk_idUSUARIO, Fecha, Creador";
			$fecha = explode("/",$strFecha);
			$NuevaFecha = $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
			$strValores = " " . $intIdUsuario . ", '" . $NuevaFecha . "', '" . $strElaboradoPor . "' ";

			if($intIdPuntoEvaluacion != -1){
				$strCampos .= ", fk_idPUNTO_EVALUACION ";
				$strValores .= ", " . $intIdPuntoEvaluacion . " ";
			}else{
				$strCampos .= ", fk_idEVENTO ";
				$strValores .= ", " . $intIdEvento . " ";
			}

			$idInsertado = $this->db->InsertarIdentity($strTabla, $strCampos, $strValores);				
			return $idInsertado;
		} catch (Exception $e) {
				//no se pudo realizar la insercion
			echo 'Error al crear la evaluacion. ' . $e->getMessage();
			return;
		}
	}


	function ValidarLogin($strUsuario, $strPassword, $strTipoUsuario){
		//funcion para validar que el usuario exista y setear la variable del id del usuario si es que existe
		$strTabla = " usuario ";
		$strCampos = " * ";
		$strRestricciones = " correo = '" . $strUsuario . "' AND password = '" . $this->getMD5($strPassword) . "' AND fk_idTIPO_USUARIO = " . $strTipoUsuario . " ";		
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			 $rowcount=mysqli_num_rows($result);
			// $cont = 0;
			while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {					
				$_SESSION["idUsuario"] = $row[0];				
			}			
			if($rowcount > 0){
				return true;
			}else{
				$_SESSION["idUsuario"] = "";
				return false;
			}			
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}


	function ConsultarNivelesDeRiesgo(){
		$strTabla = " nivel_riesgo ";
		$strCampos = " * ";
		$strRestricciones = "";		
		try {
			$result = $this->db->Consultar($strTabla, $strCampos, $strRestricciones, "","");
			return $result;
		} catch (Exception $e) {
			echo 'Error: ' .$e->getMessage();
		}
	}

	} // FIN DE CLASE
	?>