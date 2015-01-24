<?php 
/**
	Author: Jeffric Alexander Fuentes Heiz.
	Author: Luis Roberto Barrios Galdamez

	Project: EPS, Ciencias y Sistemas, USAC. 2014-2015	

	CLASE QUE CONTIENE TODAS LAS FUNCIONES NECESARIAS PARA LA CONSTRUCCION 
	DE LAS DISTINTAS SECCIONES DE LAS PAGINAS

*/

	session_start();
	ob_start();
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

//asignar usuario pais
if($strMetodo == "asignarUsuarioP")
	asignarUsuarioP();

function asignarUsuarioP(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$strUsuario = $_POST["AjxPUser"];
	$strPais = $_POST["AjxPPais"];

	if($strUsuario == -2){
		echo "Usuario invalido";

	}
	else{
		$bandera=$db_funciones->verificarExistenciaAsignacion($strUsuario, $strPais);
		if($bandera==1){
			$bandera2=$db_funciones->asignarUsuario($strPais, $strUsuario);
			if($bandera2==1){

				echo "Usuario Asignado Exitosamente";
			}
			else{

				echo "Hubo un Error en la Asignacion";
			}
		}
		else{
			echo "El usuario ya se encuentra asignado a este pais";
		}
	}


}

//buscar paises asignados de usuario a desasignar
if($strMetodo == "buscarPaisesAsignados")
	buscarPaisesAsignados();

function buscarPaisesAsignados(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$strUsuario = $_POST["usuario"];

	if($strUsuario == -2){

		$cadena ='<label for="txtPais" >Paises Asignados</label> <select>';

		$cadena=$cadena.'<option value="-2">Debe elejir un usuario valido</option></select name="lstPais" id="lstPais">'; 
	}
	else{
		$result = $db_funciones->getListaPaisesAsignados($strUsuario);
		$cadena ='<label for="txtPais" >Paises Asignados</label> <select name="lstPais" id="lstPais">';

		
		while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
			$cadena=$cadena.'<option value="'. $row[0] . '">' . $row[1] . '</option>';
		}
		$cadena=$cadena.'</select>';  

	}


	echo $cadena;


}


//desasignar usuario pais
if($strMetodo == "desasignarUsuarioP")
	desasignarUsuarioP();

function desasignarUsuarioP(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$strUsuario = $_POST["AjxPUser"];
	$strPais = $_POST["AjxPPais"];


	$result=$db_funciones->contarPaisesAsignados($strUsuario);
	while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
		if($row[0]==1){
			echo "eliminar";
		}
		else{

			$result = $db_funciones->desasignarUsuarioP($strUsuario, $strPais);
			echo "desasignar";

		}
	}





}


//eliminar usuario 
if($strMetodo == "eliminarUsuario")
	eliminarUsuario();

function eliminarUsuario(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$strUsuario = $_POST["AjxPUser"];


	$result=$db_funciones->eliminarUsuario($strUsuario);


}



//get puntos de evaluacion por pais
if($strMetodo == "getPtosEval")
	getPuntosEvaluacionxPais();

function getPuntosEvaluacionxPais(){
	$strHtml = "<option value='-2' selected='selected'>Elegir un punto de evaluaci&oacute;n</option>";
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
	$nombrePtoEvaluacion = $_POST["AjxNombre"];	
	$latitud = $_POST["AjxLatitud"];	
	$longitud = $_POST["AjxLongitud"];	
	$descripcion = $_POST["AjxDescripcion"];	
	$idPais = $_POST["AjxPais"];




	try {
		if(validarVacio($nombrePtoEvaluacion)==false AND validarVacio($descripcion)==false){
			$bandera=$db_funciones->verificarExistenciaPtoEvaluacion($nombrePtoEvaluacion, $idPais);
			if($bandera==true){

					echo 'Ya existe un Punto con el mismo nombre en este Pais, dentro del sistema';
				}
				else{
				$result = $db_funciones->insertarPtoEvaluacion($nombrePtoEvaluacion, $latitud, $longitud, $descripcion, $idPais );

				echo "Punto: ".$nombrePtoEvaluacion." guardado existosamente";

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

//Agregar Amenaza
if($strMetodo == "agregarAmenaza")
	agregarAmenaza();

function agregarAmenaza(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$amenaza = $_POST["amenaza"];	
	$descripcion = $_POST["descripcion"];



	try {
		if(validarVacio($amenaza)==false AND validarVacio($descripcion)==false){
			$bandera=$db_funciones->verificarExistenciaAmenaza($amenaza);
			if($bandera==true){

				echo "Esta Amenaza ya se encuentra registrada en el sistema";
			}
			else{
				$result = $db_funciones->insertarAmenaza($amenaza, $descripcion);

				echo "Amenaza: ".$amenaza." guardada existosamente";

			}
		}
		else{
			echo "No debes dejar campos vacios!";
		}

		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Eliminar Amenaza
if($strMetodo == "eliminarAmenaza")
	eliminarAmenaza();

function eliminarAmenaza(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$amenaza = $_POST["amenaza"];	

	try {

		$result = $db_funciones->eliminarAmenaza($amenaza);
		
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

//Obtener informacion de usuario
if($strMetodo == "obtenerInfoUsuario")
	obtenerInfoUsuario();

function obtenerInfoUsuario(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idUsuario = $_POST["AjxPUser"];
	try {
			$result = $db_funciones->getInfoUsuario($idUsuario);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					$cadena=$row[0].','.$row[1].','.$row[2].','.$row[3].','.$row[4].','.$row[5];				
				}				
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	}
//evaluacion de amenazas SRA
//EvalSRA
if($strMetodo == "EvalSRA")
	EvaluarSRA();
function EvaluarSRA(){
	$strJsonEval = $_POST["jsonSRA"];
	$strJsonPaso1 = $_POST["jsonPaso1"];
	//seteamos la variable de sesion para el paso 1
	$_SESSION["JsonPaso1SRA"] = $strJsonPaso1;
	$strCadenaEvaluados = "";
	include_once "funciones.php";
	$db_funciones = new Funciones();



	$arrJsonEval;
	$idEval = "";
	$error = "";
	
	$blnPrimeraVez = true;

	if($strJsonEval != "" && $strJsonEval != null){		
		$arrJsonEval = json_decode($strJsonEval);
		//obtenemos la informacion de evaluacion (idEvaluacion)
		$arrInfo = $arrJsonEval->InfoEval;

		$arrEval = $arrJsonEval->Eval;

		foreach($arrInfo as $json){
			$idEval = $json->IdEvaluacion;
			break;
		}

		foreach($arrEval as $json){
			//{"IdAmenaza": idAmenaza, "Impacto": impacto, "Probabilidad": probabilidad, "NivelDeRiesgo" : nivelDeRiesgo }
			$idAmenaza = $json->IdAmenaza;
			$impacto = $json->Impacto;
			$probabilidad = $json->Probabilidad;
			$nivelRiesgo = $json->NivelDeRiesgo;

			//Se inserta la evaluacion de cada amenaza, con el id de la evaluacion acarreado					
			//($strTabla, $strCampos, $strValores)					
			$result = $db_funciones->InsertarEvalAmenazas($idAmenaza, $impacto, $probabilidad, $idEval, $nivelRiesgo);
			if($result == -1){
				$error .= "No se pudo insertar la evaluacion de la amenaza: " . $idContenido . "<br>";
			}

			if($blnPrimeraVez){
				$strCadenaEvaluados = $result;
				$blnPrimeraVez = false;
			}else{
				$strCadenaEvaluados .= "," . $result;
			}
		}
		if($error == ""){
			echo $strCadenaEvaluados;
		}else{
			echo "-1|" . $strCadenaEvaluados . "|" . $error;
		}
	}else{
		Echo '-1||Error: No se han podido evaluar las amenazas. ';
	}
}


if($strMetodo == "setPaso2")
	SetPaso2SRA();
function SetPaso2SRA(){

	include_once "funciones.php";
	$db_funciones = new Funciones();

	$jsonPaso2 = $_POST["jsonSRAPaso2"];
	$jsonPaso1 = $_SESSION["JsonPaso1SRA"];
	$idEvalSra = $_SESSION["idEvalSraActual"];

	$NombreUsuarioCreador = "";
	$CorreoUsuarioCreador = "";
//$NombreUsuarioCreador = $row[1] . " " . $row[2];
//$CorreoUsuarioCreador = $row[3];

//variables de la evaluacion
	$idUsuarioEvaluador = "";
	$idPtoEval = "";
	$idEvento = "";
	$tipoObjeto = -1; //1 punto de evaluacion, 2 evento
	$nombreObjeto = "";
	$FechaEval = "";
	$Creador = "";


//punto/evento de evaluacion
	$nombrePtoEventoEval = "";
	//info de la evaluacion

	$resultEval = $db_funciones->getEval($idEvalSra);
	while ($row = mysqli_fetch_array($resultEval, MYSQL_NUM)){
		$idUsuarioEvaluador = $row[1];
		if(is_null($row[2])){
			$idPtoEval = "";
		}else{
			$idPtoEval = $row[2];
		}
		if(is_null($row[3])){
			$idEvento = "";
		}else{
			$idEvento = $row[3];
		}		
		$FechaEval = $row[4];
		$Creador = $row[5];
		break;
	}

	//info del usuario evaluador
	$resultUsuarioEval = $db_funciones->ConsultarUsuario($idUsuarioEvaluador);
	while ($row = mysqli_fetch_array($resultUsuarioEval, MYSQL_NUM)){
		$NombreUsuarioCreador = $row[1] . " " . $row[2];
		$CorreoUsuarioCreador = $row[3];
		break;
	}

	//consultamos punto de evaluacion o evento segun sea el caso
	if($idPtoEval == ""){
		//Es un evento
		$tipoObjeto = 2;
		$resultPtoEval = $db_funciones->ConsultarEvento($idEvento);
		while ($row = mysqli_fetch_array($resultPtoEval, MYSQL_NUM)){
			$nombrePtoEventoEval = "Evento: " . $row[1];
			$nombreObjeto = $row[1];
			break;
		}
	}else{
		//Es un punto de evaluacion
		$tipoObjeto = 1;
		$resultPtoEval = $db_funciones->ConsultarPuntoEvaluacion($idPtoEval);
		while ($row = mysqli_fetch_array($resultPtoEval, MYSQL_NUM)){
			$nombrePtoEventoEval = "Punto de evaluaci&oacute;n: " . $row[1];
			$nombreObjeto = $row[1];
			break;
		}
	}

	//parseo del json del paso 2 para sacar el nivel de riesgo y armar la tabla 2
	$strNivelRiesgoPaso2 = "";
	$strIdNivelRiesgoPaso2 = "";
	$strDescripcionPaso2 = "";
	$arrJsonPaso2 = json_decode($jsonPaso2);
		//obtenemos la informacion de evaluacion (idEvaluacion)
	$arrInfoPaso2 = $arrJsonPaso2->InfoEval;

	$arrEvalPaso2 = $arrJsonPaso2->Eval;

	foreach($arrInfoPaso2 as $itemJsonInfo){
		$strNivelRiesgoPaso2 = $itemJsonInfo->idNivelRiesgo;
		$strIdNivelRiesgoPaso2 = $itemJsonInfo->strNivelRiesgo;
		$strDescripcionPaso2 = $itemJsonInfo->Descripcion;
		break;
	}

	//Tabla 1 (encabezado con la info de la evaluacion)

	$strHtmlTabla1 = '<table style="width:100%" class="tg">';
	$strHtmlTabla1 .= '	<tr>';
	$strHtmlTabla1 .= '		<td class="tg-mnb8">';
	$strHtmlTabla1 .= 'Nivel de riesgo';
	$strHtmlTabla1 .= '		</td>';	
	$strHtmlTabla1 .= '		<td class="tg-031e">';
	$strHtmlTabla1 .= $strIdNivelRiesgoPaso2;
	$strHtmlTabla1 .= '		</td>';	
	$strHtmlTabla1 .= '	</tr>';
	$strHtmlTabla1 .= '<tr>';
	$strHtmlTabla1 .= '		<td class="tg-mnb8">';
	$strHtmlTabla1 .= 'Punto/Evento de evaluaci&oacute;n';
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '		<td class="tg-031e">';
	$strHtmlTabla1 .= $nombrePtoEventoEval;
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '	</tr>';
	$strHtmlTabla1 .= '<tr>';
	$strHtmlTabla1 .= '		<td class="tg-mnb8">';
	$strHtmlTabla1 .= 'Fecha';
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '		<td class="tg-031e">';
	$arrFechaEval = explode('-',$FechaEval);
	$strHtmlTabla1 .= "$arrFechaEval[2]/$arrFechaEval[1]/$arrFechaEval[0]";
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '	</tr>';
	$strHtmlTabla1 .= '<tr>';
	$strHtmlTabla1 .= '		<td class="tg-mnb8">';
	$strHtmlTabla1 .= 'Evaluador';
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '		<td class="tg-031e">';
	$strHtmlTabla1 .= $NombreUsuarioCreador . " - " . $CorreoUsuarioCreador . "<br>" . $Creador ;
	$strHtmlTabla1 .= '		</td>';
	$strHtmlTabla1 .= '	</tr>';
	$strHtmlTabla1 .= '</table>';


	//construccion de la tabla # 2, Evaluacion automatica
	$strHtmlTabla2 = '';
	$strHtmlTabla2 .= '<table style="width:100%;" class="tg">';
	$strHtmlTabla2 .= '	<tr>';
	$strHtmlTabla2 .= '		<th class="tg-hgcj" colspan="4">Reporte Autom&aacute;tico</th>';
	$strHtmlTabla2 .= '	</tr>';
	$strHtmlTabla2 .= '	<tr>';
	$strHtmlTabla2 .= '		<td class="tg-mnb8">Amenaza</td>';
	$strHtmlTabla2 .= '		<td class="tg-mnb8">Impacto</td>';
	$strHtmlTabla2 .= '		<td class="tg-mnb8">Probabilidad</td>';
	$strHtmlTabla2 .= '		<td class="tg-mnb8">Nivel de riesgo</td>';
	$strHtmlTabla2 .= '	</tr>';
	
	$arrJsonPaso1 = json_decode($jsonPaso1);		
	$arrEvalPaso1 = $arrJsonPaso1->Eval;

	foreach($arrEvalPaso1 as $itemJsonEval){
		$strHtmlTabla2 .= '	<tr>';
		$strHtmlTabla2 .= '<td class="tg-s6z2">' . $itemJsonEval->strAmenaza . '</td>';
		$strHtmlTabla2 .= '<td class="tg-s6z2">' . $itemJsonEval->strImpacto . '</td>';
		$strHtmlTabla2 .= '<td class="tg-s6z2">' . $itemJsonEval->strProbabilidad .'</td>';
		$strHtmlTabla2 .= '<td class="' . getCssNivelRiesgo($itemJsonEval->NivelDeRiesgo) . '">' . $itemJsonEval->strNivelDeRiesgo . '</td>';
		$strHtmlTabla2 .= '</tr>';			
	}

	$strHtmlTabla2 .= '</table>';



	//Armado de la tabla #3, con planes de prevencion y mitigacion
	$strHtmlTabla3 = '';
	$strHtmlTabla3 .= '<table class="tg">';
	$strHtmlTabla3 .= '	<tr>';
	$strHtmlTabla3 .= '		<th class="tg-hgcj" colspan="6">Reporte Operativo</th>';
	$strHtmlTabla3 .= '	</tr>';
	$strHtmlTabla3 .= '	<tr>';
	$strHtmlTabla3 .= '		<td class="tg-mnb8">Amenaza</td>';
	$strHtmlTabla3 .= '		<td class="tg-mnb8">Impacto</td>';
	$strHtmlTabla3 .= '		<td class="tg-mnb8">Probabilidad</td>';
	$strHtmlTabla3 .= '		<td class="tg-mnb8">Nivel de riesgo</td>';
	$strHtmlTabla3 .= '		<td class="tg-mnb8">Planes de prevenci&oacute;n</td>';
	$strHtmlTabla3 .= '		<td class="tg-mnb8">Planes de mitigaci&oacute;n</td>';
	$strHtmlTabla3 .= '	</tr>';	
	foreach ($arrEvalPaso2 as $iteJsonEval) {
		$strHtmlTabla3 .= '<tr>';
		$strHtmlTabla3 .= '		<td class="tg-s6z2">' . $iteJsonEval->strIdAmenaza . '</td>';
		$strHtmlTabla3 .= '		<td class="tg-s6z2">' . $iteJsonEval->strImpacto . '</td>';
		$strHtmlTabla3 .= '		<td class="tg-s6z2">' . $iteJsonEval->strProbabilidad . '</td>';
		$strHtmlTabla3 .= '		<td class="tg-s6z2">' . $iteJsonEval->strNivelDeRiesgo . '</td>';
		$strHtmlTabla3 .= '		<td class="tg-031e">';
		$strHtmlTabla3 .= '			<table>';
		$arrPrevenciones = $iteJsonEval->Prevenciones;
		foreach ($arrPrevenciones as $itemPrevencion) {
			$strHtmlTabla3 .= '<tr>';
			$strHtmlTabla3 .= '		<td title="' . $itemPrevencion->descripcion . '">' . $itemPrevencion->nombre . '</td>';
			$strHtmlTabla3 .= '</tr>';
		}
		$strHtmlTabla3 .= '			</table>';
		$strHtmlTabla3 .= '		</td">';
		$strHtmlTabla3 .= '		<td class="tg-031e">';
		$strHtmlTabla3 .= '			<table>';
		$arrMitigaciones = $iteJsonEval->Mitigaciones;
		foreach ($arrMitigaciones as $itemMitigacion) {
			$strHtmlTabla3 .= '<tr>';
			$strHtmlTabla3 .= '		<td title="' . $itemMitigacion->descripcion . '">' . $itemMitigacion->nombre . '</td>';
			$strHtmlTabla3 .= '</tr>';
		}
		$strHtmlTabla3 .= '			</table>';
		$strHtmlTabla3 .= '		</td">';
		$strHtmlTabla3 .= '	</tr">';		
	}
	$strHtmlTabla3 .= '</table">';

	//armado de la tabla #4, descripcion operativa del usuario

	$strHtmlTabla4 = '';
	$strHtmlTabla4 .= '<table class="tg">';
	$strHtmlTabla4 .= '	<tr>';
	$strHtmlTabla4 .= '		<th class="tg-hgcj" colspan="6">Reporte Operativo</th>';
	$strHtmlTabla4 .= '	</tr>';
	$strHtmlTabla4 .= '	<tr>';
	$strHtmlTabla4 .= '		<td class="tg-e3zv" colspan="6"><p>' . $strDescripcionPaso2 . '</p></td>';
	$strHtmlTabla4 .= '	</tr>';
	$strHtmlTabla4 .= '</table>';	

	//Armado de la tabla principal que contiene a todas las demas tablas
	$strHtmlTablaGeneral = "";
	$strHtmlTablaGeneral .= ' <table id="movie-table-custom" class="movie-list table-stripe">';
	$strHtmlTablaGeneral .= '	<tr>';
	$strHtmlTablaGeneral .= '		<td>';
	$strHtmlTablaGeneral .= $strHtmlTabla1;
	$strHtmlTablaGeneral .= '		</td>';
	$strHtmlTablaGeneral .= '	</tr>';
	$strHtmlTablaGeneral .= '	<tr>';
	$strHtmlTablaGeneral .= '		<td>';
	$strHtmlTablaGeneral .= $strHtmlTabla2;
	$strHtmlTablaGeneral .= '		</td>';
	$strHtmlTablaGeneral .= '	</tr>';
	$strHtmlTablaGeneral .= '	<tr>';
	$strHtmlTablaGeneral .= '		<td>';
	$strHtmlTablaGeneral .= $strHtmlTabla3;
	$strHtmlTablaGeneral .= '		</td>';
	$strHtmlTablaGeneral .= '	</tr>';
	$strHtmlTablaGeneral .= '	<tr>';
	$strHtmlTablaGeneral .= '		<td>';
	$strHtmlTablaGeneral .= $strHtmlTabla4;
	$strHtmlTablaGeneral .= '		</td>';
	$strHtmlTablaGeneral .= '	</tr>';
	$strHtmlTablaGeneral .= '</table>';
		// echo $strHtmlTablaGeneral;
	//insertamos el reporte
	$idReporte = $db_funciones->insertarReporteSra($FechaEval, 
		$strHtmlTablaGeneral, $idUsuarioEvaluador, $strNivelRiesgoPaso2, $tipoObjeto, $nombreObjeto);
	echo $idReporte;


}

function getCssNivelRiesgo($idNivelRiesgo){
	switch($idNivelRiesgo){
		case 1:
				//insignificante
		return "tg-8o5d";
		case 2:
				//bajo
		return "tg-v88f";
		case 3:
				//medio
		return "tg-3ope";
		case 4:
				//alto
		return "tg-yg2k";
		case 5:
				//critico
		return "tg-lkh4";
		case 6:
				//nulo
		return "tg-lkh3";
		default:
		return "";
	}
}

//Obtener informacion de un pais
if($strMetodo == "obtenerInfoPais")
	obtenerInfoPais();

function obtenerInfoPais(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idPais = $_POST["AjxPais"];
	$idRegion;
	$cadena="";
	try {
			$result = $db_funciones->getInfoPais($idPais);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					$idRegion=$row[2];
					$cadena=$row[0].','.$row[1].','.$row[2];				
				}

			$result = $db_funciones->getInfoRegion($idRegion);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					$cadena=$cadena.','.$row[0].','.$row[1];				
				}								
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}

}

//Obtener informacion de una region
if($strMetodo == "obtenerInfoRegion")
	obtenerInfoRegion();

function obtenerInfoRegion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idRegion = $_POST["AjxRegion"];
	$cadena="";
	try {
			$result = $db_funciones->getInfoRegion($idRegion);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){

					$cadena=$row[0].','.$row[1];				
				}						
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Obtener informacion de una amenaza
if($strMetodo == "obtenerInfoAmenaza")
	obtenerInfoAmenaza();

function obtenerInfoAmenaza(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idAmenaza = $_POST["AjxAmenaza"];
	$cadena="";
	try {
			$result = $db_funciones->getAmenazas($idAmenaza);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){

					$cadena=$row[0].','.$row[1].','.$row[2];				
				}						
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Obtener informacion de un plan de prevencion
if($strMetodo == "obtenerInfoPrevencion")
	obtenerInfoPrevencion();

function obtenerInfoPrevencion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idPrevencion = $_POST["AjxPrevencion"];
	$cadena="";
	try {
			$result = $db_funciones->getInfoPrevencion($idPrevencion);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){

					$cadena=$row[0].','.$row[1].','.$row[2];				
				}						
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Obtener informacion de un plan de mitigacion
if($strMetodo == "obtenerInfoMitigacion")
	obtenerInfoMitigacion();

function obtenerInfoMitigacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$idMitigacion = $_POST["AjxMitigacion"];
	$cadena="";
	try {
			$result = $db_funciones->getInfoMitigacion($idMitigacion);
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){

					$cadena=$row[0].','.$row[1].','.$row[2];				
				}						
				echo $cadena;			
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//eliminar Evento 
if($strMetodo == "eliminarEvento")
	eliminarEvento();

function eliminarEvento(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$idEvento = $_POST["AjxEvento"];


	$result=$db_funciones->eliminarEvento($idEvento);


}

//eliminar Plan de Prevencion 
if($strMetodo == "eliminarPlanPrevencion")
	eliminarPlanPrevencion();

function eliminarPlanPrevencion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$idPlan = $_POST["AjxPlan"];


	$result=$db_funciones->eliminarPlanPrevencion($idPlan);


}

//eliminar Plan de Mitigacion 
if($strMetodo == "eliminarPlanMitigacion")
	eliminarPlanMitigacion();

function eliminarPlanMitigacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();	
	$idPlan = $_POST["AjxPlan"];


	$result=$db_funciones->eliminarPlanMitigacion($idPlan);

}

//Agregar Evento
if($strMetodo == "agregarEvento")
	agregarEvento();

function agregarEvento(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombreEvento = $_POST["AjxNombre"];
	$localidad = $_POST['AjxLocalidad'];
	$descripcion = $_POST["AjxDescripcion"];
	$latitud = $_POST["AjxLatitud"];
	$longitud = $_POST["AjxLongitud"];		
	$fecha = $_POST["AjxFecha"];

	try {

		$bandera=$db_funciones->verificarExistenciaEvento($nombreEvento);
				if($bandera==true){

					echo 'Ya existe un Evento con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->insertarEvento($nombreEvento, $localidad, $descripcion, $latitud, $longitud, $fecha);

				echo "Evento: ".$nombreEvento." guardado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Agregar Plan de Mitigacion
if($strMetodo == "agregarPlanMitigacion")
	agregarPlanMitigacion();

function agregarPlanMitigacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePlan = $_POST["AjxNombre"];
	$descripcion = $_POST["AjxDescripcion"];

	try {

		$bandera=$db_funciones->verificarExistenciaPlanMitigacion($nombrePlan);
				if($bandera==true){

					echo 'Ya existe un Plan con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->insertarPlanMitigacion($nombrePlan, $descripcion);

				echo "Plan: ".$nombrePlan." guardado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Agregar Plan de Prevencion
if($strMetodo == "agregarPlanPrevencion")
	agregarPlanPrevencion();

function agregarPlanPrevencion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePlan = $_POST["AjxNombre"];
	$descripcion = $_POST["AjxDescripcion"];

	try {

		$bandera=$db_funciones->verificarExistenciaPlanPrevencion($nombrePlan);
				if($bandera==true){

					echo 'Ya existe un Plan con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->insertarPlanPrevencion($nombrePlan, $descripcion);

				echo "Plan: ".$nombrePlan." guardado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Modificar Amenaza
if($strMetodo == "modificarAmenaza")
	modificarAmenaza();

function modificarAmenaza(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombreAmenaza = $_POST["AjxNombre"];
	$descripcion = $_POST["AjxDescripcion"];
	$idAmenaza = $_POST["AjxAmenaza"];

	try {

		$bandera=$db_funciones->verificarExistenciaAmenazaUpdate($nombreAmenaza, $idAmenaza);
				if($bandera==true){

					echo 'Ya existe una Amenaza con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarAmenaza($nombreAmenaza, $descripcion, $idAmenaza);

				echo "Amenaza: ".$nombreAmenaza." guardado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Modificar Pais
if($strMetodo == "modificarPais")
	modificarPais();

function modificarPais(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePais = $_POST["AjxNombre"];
	$idPais = $_POST["AjxPais"];
	$idRegion = $_POST["AjxRegion"];

	try {

		$bandera=$db_funciones->verificarExistenciaPaisUpdate($nombrePais, $idPais);
				if($bandera==true){

					echo 'Ya existe una Pais con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarPais($nombrePais, $idRegion, $idPais);

				echo "Pais: ".$nombrePais." guardado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Modificar Region
if($strMetodo == "modificarRegion")
	modificarRegion();

function modificarRegion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombreRegion = $_POST["AjxNombre"];
	$idRegion = $_POST["AjxRegion"];

	try {

		$bandera=$db_funciones->verificarExistenciaRegionUpdate($nombreRegion, $idRegion);
				if($bandera==true){

					echo 'Ya existe una Region con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarRegion($nombreRegion, $idRegion);

				echo "Region: ".$nombreRegion." actualizada existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Modificar Plan de Mitigacion
if($strMetodo == "modificarPlanMitigacion")
	modificarPlanMitigacion();

function modificarPlanMitigacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePlan = $_POST["AjxNombre"];
	$descripcion = $_POST['AjxDescripcion'];
	$idPlan = $_POST["AjxPlan"];

	try {

		$bandera=$db_funciones->verificarExistenciaPlanMitigacionUpdate($nombrePlan, $idPlan);
				if($bandera==true){

					echo 'Ya existe un Plan con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarPlanMitigacion($nombrePlan, $descripcion, $idPlan);

				echo "Plan: ".$nombrePlan." actualizado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}



//Modificar Plan de Prevencion
if($strMetodo == "modificarPlanPrevencion")
	modificarPlanPrevencion();

function modificarPlanPrevencion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePlan = $_POST["AjxNombre"];
	$descripcion = $_POST['AjxDescripcion'];
	$idPlan = $_POST["AjxPlan"];

	try {

		$bandera=$db_funciones->verificarExistenciaPlanPrevencionUpdate($nombrePlan, $idPlan);
				if($bandera==true){

					echo 'Ya existe un Plan con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarPlanPrevencion($nombrePlan, $descripcion, $idPlan);

				echo "Plan: ".$nombrePlan." actualizado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


//Modificar Evento
if($strMetodo == "modificarEvento")
	modificarEvento();

function modificarEvento(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombreEvento = $_POST["AjxNombre"];
	$descripcion = $_POST['AjxDescripcion'];
	$idEvento = $_POST["AjxEvento"];
	$localidad = $_POST["AjxLocalidad"];	
	$fecha = $_POST["AjxFecha"];
	$latitud = $_POST["AjxLatitud"];	
	$longitud = $_POST["AjxLongitud"];	

	try {

		$bandera=$db_funciones->verificarExistenciaEventoUpdate($nombreEvento, $idEvento);
				if($bandera==true){

					echo 'Ya existe un Evento con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarEvento($nombreEvento, $descripcion, $localidad, $latitud, $longitud, $fecha, $idEvento);

				echo "Evento: ".$nombreEvento." actualizado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}



//Modificar Pto Evaluacion
if($strMetodo == "modificarPtoEvaluacion")
	modificarPtoEvaluacion();

function modificarPtoEvaluacion(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombrePto = $_POST["AjxNombre"];
	$descripcion = $_POST['AjxDescripcion'];
	$idPto = $_POST["AjxPto"];
	$idPais = $_POST["AjxPais"];
	$latitud = $_POST["AjxLatitud"];	
	$longitud = $_POST["AjxLongitud"];	

	try {

		$bandera=$db_funciones->verificarExistenciaPtoEvaluacionUpdate($nombrePto, $idPais, $idPto);
				if($bandera==true){

					echo 'Ya existe un Punto con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarPtoEvaluacion($nombrePto, $descripcion, $latitud, $longitud, $idPais, $idPto);

				echo "Punto: ".$nombrePto." actualizado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}


?>