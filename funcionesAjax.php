<?php 
/**
	Author: Jeffric Alexander Fuentes Heiz.
	Author: Luis Roberto Barrios Galdamez

	Project: EPS, Ciencias y Sistemas, USAC. 2014-2015	

	CLASE QUE CONTIENE TODAS LAS FUNCIONES NECESARIAS PARA LA CONSTRUCCION 
	DE LAS DISTINTAS SECCIONES DE LAS PAGINAS

*/


	$strMetodo = "";

//recuperacion del parametro que lleva el nombre del metodo.
//Este puede venir por post o por get.
/**
NOMBRE DEL PARAMETRO DE METODO: nombreMetodo
*/
try {
	if(isset($_POST["nombreMetodo"])){
		$strMetodo = $_POST["nombreMetodo"];
	}else if(isset($_GET["nombreMetodo"])){
		$strMetodo = $_GET["nombreMetodo"];
	}else{
		$strMetodo = "";
	}
} catch (Exception $e) {
	echo $e->getMessage();
}


//crear usuario
if($strMetodo == "CUsr")
	CrearUsuario();

function CrearUsuario(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$strNombre = $_POST["AjxPNombre"];		
	$strApellido = $_POST["AjxPApellido"];
	$strCorreo = $_POST["AjxPCorreo"];
	$strPassword = $_POST["AjxPPassword"];
	$strTipoUsuario = $_POST["AjxPTipoUser"];
	$strPaisUsuario = $_POST["AjxPPais"];

	try {
		$result = $db_funciones->InsertarUsuario($strNombre, 
												$strApellido,
												$strCorreo, 
												$strPassword,
												$strTipoUsuario,
												$strPaisUsuario);
		if($result == 1){
			echo "Usuario agregado exitosamente.";
		}else{
			echo $result;
		}
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Agregar Pais
if($strMetodo = "agregarPais")
	agregarPais();

function agregarPais(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePais = $_POST["pais"];	
	$idRegion = $_POST["region"];	


	try {
		if(validarVacio($nombrePais)==false){
		$bandera=$db_funciones->verificarExistenciaPais($nombrePais);
				if($bandera==true){

					echo "Este Pais ya se encuentra registrado en el sistema";
				}
				else{
				$result = $db_funciones->insertarPais($nombrePais, $idRegion);

				echo "Pais: ".$nombrePais." guardado existosamente";

				}
		}
		else{
				echo "No debes dejar campos vacios";
		}

		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

function validarVacio($variable){
trim($variable," \t\n\r\0\x0B");
		if(strcasecmp($variable, "")!=0){	
			return false;
		}
		else{
			return true;

		}
}	


?>