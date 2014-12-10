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

//get puntos de evaluacion por pais
if($strMetodo == "getPtosEval")
	getPuntosEvaluacionxPais();

function getPuntosEvaluacionxPais(){
	$strHtml = "<option value='-2' selected='selected'>Elegir un punto de evaluaci�n</option>";
	$intIdPais = $_POST["AjxPPais"];
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$result = $db_funciones->ConsultarPuntosEvaluacion($intIdPais);
	while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
		$strHtml .= "<option value='" . $row[0] . "'>" . $row[1] . "</option>";		
	}
	echo $strHtml;
}
//Agregar Pais
if($strMetodo == "agregarPais")
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

//Agregar Region
if($strMetodo == "agregarRegion")
	agregarRegion();

function agregarRegion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombreRegion = $_POST["region"];	



	try {
		if(validarVacio($nombreRegion)==false){
			$bandera=$db_funciones->verificarExistenciaRegion($nombreRegion);
			if($bandera==true){

				echo "Esta Region ya se encuentra registrada en el sistema";
			}
			else{
				$result = $db_funciones->insertarRegion($nombreRegion);

				echo "Region: ".$nombreRegion." guardada existosamente";

			}
		}
		else{
			echo "No debes dejar campos vacios";
		}

		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Agregar Punto de Evaluacion
if($strMetodo == "agregarPtoEvaluacion")
	agregarPtoEvaluacion();

function agregarPtoEvaluacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePtoEvaluacion = $_POST["nombrePtoEvaluacion"];	
	$latitud = $_POST["latitud"];	
	$longitud = $_POST["longitud"];	
	$descripcion = $_POST["descripcion"];	
	$idPais = $_POST["pais"];




	try {
		if(validarVacio($nombrePtoEvaluacion)==false AND validarVacio($descripcion)==false){
		$bandera=$db_funciones->verificarExistenciaPtoEvaluacion($nombrePtoEvaluacion, $idPais);
				if($bandera==true){

					echo "Este Punto de Evaluación ya se encuentra registrado en el sistema";
				}
				else{
				$result = $db_funciones->insertarPtoEvaluacion($nombrePtoEvaluacion, $latitud, $longitud, $descripcion, $idPais );

				echo "Punto de Evaluación: ".$nombrePtoEvaluacion." guardado existosamente";

				}
		}
		else{
				echo "No debes dejar campos vacios";
		}

		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Eliminar Region
if($strMetodo == "eliminarRegion")
	eliminarRegion();

function eliminarRegion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$region = $_POST["region"];	



	try {

				$result = $db_funciones->eliminarRegion($region);
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Eliminar Pais
if($strMetodo == "eliminarPais")
	eliminarPais();

function eliminarPais(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$pais = $_POST["pais"];	



	try {

				$result = $db_funciones->eliminarPais($pais);
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Eliminar Punto de Evaluacion
if($strMetodo == "eliminarPtoEvaluacion")
	eliminarPtoEvaluacion();

function eliminarPtoEvaluacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$ptoEvaluacion = $_POST["ptoEvaluacion"];	

	try {

				$result = $db_funciones->eliminarPtoEvaluacion($ptoEvaluacion);
		
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