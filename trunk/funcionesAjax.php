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
	$strHtml = "<option value='-2' selected='selected'>Elegir un punto de evaluacion</option>";
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

	$strHtmlTabla1 = '<table class="tg" style="undefined;table-layout: fixed; width: 100%;">';
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
	/*
<table class="tg" style="undefined;table-layout: fixed; width: 989px">
<colgroup>
<col style="width: 112px">
<col style="width: 129px">
<col style="width: 530px">
<col style="width: 109px">
<col style="width: 109px">
</colgroup>
  <tr>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
    <th class="tg-031e"></th>
  </tr>
  <tr>
    <td class="tg-hgcj">Amenaza 1</td>
    <td class="tg-f062">CRITICO<br></td>
    <td class="tg-031e">Maecenas luctus nec ante nec vulputate. Integer et euismod arcu. Curabitur volutpat mauris ac magna tincidunt, vel egestas dui tempus. Curabitur tristique turpis egestas justo dapibus volutpat. Nullam ac sollicitudin odio. Aliquam vulputate mauris vehicula tellus viverra lobortis ac in risus. Donec volutpat neque nec rutrum molestie.Fusce viverra consequat ipsum, nec tempor magna pellentesque sit amet. Morbi ex ligula, molestie et risus non, varius cursus erat. Phasellus volutpat tortor enim, id convallis ligula pharetra et. Praesent eu dolor non mi efficitur commodo. Mauris semper sem et bibendum posuere. Duis vulputate nec risus vitae ultrices. Donec mollis euismod nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;Mauris faucibus, nisl vel consequat ullamcorper, diam ex mollis nibh, imperdiet porttitor enim eros ut dui. Curabitur nisl leo, ultricies ac finibus ac, vestibulum id nibh. Suspendisse potenti. Donec sodales ipsum in neque mollis scelerisque. Ut molestie non erat nec feugiat. Nunc ut aliquam nunc. Aenean dictum tempor neque, ut convallis ante accumsan quis. Suspendisse vulputate nisl sed velit viverra pulvinar. Donec non dui magna. Fusce ultricies porta massa ac venenatis. Etiam fermentum luctus cursus. Donec ut orci vel erat dignissim aliquam quis sit amet lorem. Maecenas semper sagittis ipsum sed suscipit. Pellentesque cursus interdum malesuada. Aenean pharetra, metus lobortis tincidunt maximus, erat nunc semper metus, sed suscipit mauris ante vitae sem. Vestibulum nec accumsan lorem.</td>
    <td class="tg-f062">ALTO</td>
    <td class="tg-bghc">ACEPTABLE</td>
  </tr>
  <tr>
    <td class="tg-e3zv">Amenaza 2</td>
    <td class="tg-f062">MEDIO</td>
    <td class="tg-031e">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vel interdum orci. Fusce auctor hendrerit enim, vitae sollicitudin orci lobortis sit amet. Sed dictum tellus quis dolor mattis, et euismod ante vestibulum. Cras at odio tellus. Nulla imperdiet odio et pretium congue. Ut eget pretium dolor. Praesent egestas consectetur risus, ac accumsan quam fringilla sed. Suspendisse potenti. Maecenas et sem justo. Cras id varius neque, a aliquam tortor. Suspendisse in ex et ligula malesuada laoreet. Vivamus at mi nec sem pretium rhoncus. Donec ac lorem id sapien hendrerit iaculis id a tortor. Curabitur feugiat, massa nec cursus molestie, sapien nulla laoreet mauris, ut ultrices lacus velit et leo. Pellentesque laoreet, urna ac hendrerit volutpat, ipsum elit lacinia urna, sit amet tristique tortor arcu eu mi.Morbi ut mi erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam eu bibendum est. Morbi quis finibus eros, at elementum tellus. Vivamus a dignissim odio. Integer placerat quam lectus, nec consequat magna egestas a. Donec a leo euismod, mattis purus in, convallis magna. Donec sollicitudin elementum ex sed eleifend.Pellentesque accumsan velit ac erat porta, quis fringilla lacus consectetur. Donec eros magna, feugiat ac euismod a, dignissim nec orci. Sed eros ante, suscipit ac magna a, feugiat mattis mi. Pellentesque ultricies, ipsum quis consectetur cursus, erat enim accumsan urna, nec rhoncus ex elit ut nibh. Ut a justo ligula. Mauris ultricies porta diam vitae iaculis. Pellentesque placerat dui id mi lacinia rhoncus. Cras dignissim faucibus tristique. Vivamus leo risus, mattis ullamcorper lacinia ut, viverra vitae odio. Donec id augue magna. Etiam non tellus sagittis, dictum turpis in, varius velit. Mauris tempus rhoncus lacus, quis interdum urna facilisis quis.</td>
    <td class="tg-f062">Medio</td>
    <td class="tg-1ea8">INACEPTABLE</td>
  </tr>
</table>
*/
	$strHtmlTabla2 = '';
	$strHtmlTabla2 .= '<table class="tg" style="undefined;table-layout: fixed; width: 100%">';
	// $strHtmlTabla2 .= '	<tr>';
	// $strHtmlTabla2 .= '		<td class="tg-mnb8">Amenaza</td>';
	// $strHtmlTabla2 .= '		<td class="tg-mnb8">Impacto</td>';
	// $strHtmlTabla2 .= '		<td class="tg-mnb8">Probabilidad</td>';
	// $strHtmlTabla2 .= '		<td class="tg-mnb8">Nivel de riesgo</td>';
	// $strHtmlTabla2 .= '	</tr>';
	
	//niveles de riego del paso 1
	$arrNivelesRP1 = array();
	//plan mitigacion prevencion
	$arrPMP = array();
	//niveles de riesgo del paso 2
	$arrNivelRP2 = array();
	//amenazas
	$arrAmenaza = array();
	//array es aceptable o inaceptable
	$arrAceptable = array();

	$arrJsonPaso1 = json_decode($jsonPaso1);		
	$arrEvalPaso1 = $arrJsonPaso1->Eval;

	foreach($arrEvalPaso1 as $itemJsonEval){
		array_push($arrAmenaza, $itemJsonEval->strAmenaza);
		array_push($arrNivelesRP1, $itemJsonEval->strNivelDeRiesgo);
	}	
	foreach ($arrEvalPaso2 as $iteJsonEval) {		
		$strPlanMit = "";
		$strPlanPrev = "";
		array_push($arrNivelRP2, $iteJsonEval->strNivelDeRiesgo);
		$arrPrevenciones = $iteJsonEval->Prevenciones;
		foreach ($arrPrevenciones as $itemPrevencion) {
			$strPlanPrev .= $itemPrevencion->nombre . ": " . $itemPrevencion->descripcion . "<br>";			
		}		
		$arrMitigaciones = $iteJsonEval->Mitigaciones;
		foreach ($arrMitigaciones as $itemMitigacion) {
			$strPlanMit .= $itemMitigacion->nombre . ": " . $itemMitigacion->descripcion . "<br>";			
		}

		array_push($arrPMP, $strPlanPrev . " <br> " . $strPlanMit);
	}

	/*
<tr>
    <td class="tg-hgcj">Amenaza 1</td>
    <td class="tg-f062">CRITICO<br></td>
    <td class="tg-031e">Maecenas luctus nec ante nec vulputate. Integer et euismod arcu. Curabitur volutpat mauris ac magna tincidunt, vel egestas dui tempus. Curabitur tristique turpis egestas justo dapibus volutpat. Nullam ac sollicitudin odio. Aliquam vulputate mauris vehicula tellus viverra lobortis ac in risus. Donec volutpat neque nec rutrum molestie.Fusce viverra consequat ipsum, nec tempor magna pellentesque sit amet. Morbi ex ligula, molestie et risus non, varius cursus erat. Phasellus volutpat tortor enim, id convallis ligula pharetra et. Praesent eu dolor non mi efficitur commodo. Mauris semper sem et bibendum posuere. Duis vulputate nec risus vitae ultrices. Donec mollis euismod nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;Mauris faucibus, nisl vel consequat ullamcorper, diam ex mollis nibh, imperdiet porttitor enim eros ut dui. Curabitur nisl leo, ultricies ac finibus ac, vestibulum id nibh. Suspendisse potenti. Donec sodales ipsum in neque mollis scelerisque. Ut molestie non erat nec feugiat. Nunc ut aliquam nunc. Aenean dictum tempor neque, ut convallis ante accumsan quis. Suspendisse vulputate nisl sed velit viverra pulvinar. Donec non dui magna. Fusce ultricies porta massa ac venenatis. Etiam fermentum luctus cursus. Donec ut orci vel erat dignissim aliquam quis sit amet lorem. Maecenas semper sagittis ipsum sed suscipit. Pellentesque cursus interdum malesuada. Aenean pharetra, metus lobortis tincidunt maximus, erat nunc semper metus, sed suscipit mauris ante vitae sem. Vestibulum nec accumsan lorem.</td>
    <td class="tg-f062">ALTO</td>
    <td class="tg-bghc">ACEPTABLE</td>
  </tr>
	*/
  $contAm = 0;
  foreach ($arrAmenaza as $amenaza) {
  	$strHtmlTabla2 .= '<tr>';
  	$strHtmlTabla2 .= '<td style="width:15%;" class="tg-hgcj">' . $amenaza . '</td>';
  	$strHtmlTabla2 .= '<td style="width:15%;" class="tg-f062">' . $arrNivelesRP1[$contAm] . '</td>';
  	$strHtmlTabla2 .= '<td style="width:40%; word-wrap: break-word;background-image:url(../img/rarrow.png); background-size: 100% 100%; background-position:right 0px; background-repeat:no-repeat;" class="tg-031e">' . $arrPMP[$contAm] . '</td>';
  	$strHtmlTabla2 .= '<td class="tg-f062">' . $arrNivelRP2[$contAm] . '</td>';
  	$strHtmlTabla2 .= '<td class="tg-bghc">ACEPTABLE</td>';
  	$strHtmlTabla2 .= '</tr>';
  	$contAm = $contAm + 1;
  }

	$strHtmlTabla2 .= '</table>';



	//Armado de la tabla #3, con planes de prevencion y mitigacion
	$strHtmlTabla3 = '';

	//array planes mitigacion prevencion	
	

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
	$strHtmlTablaGeneral .= ' <table>';
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
	// $strHtmlTablaGeneral .= '	<tr>';
	// $strHtmlTablaGeneral .= '		<td>';
	// $strHtmlTablaGeneral .= $strHtmlTabla3;
	// $strHtmlTablaGeneral .= '		</td>';
	// $strHtmlTablaGeneral .= '	</tr>';
	$strHtmlTablaGeneral .= '	<tr>';
	$strHtmlTablaGeneral .= '		<td>';
	$strHtmlTablaGeneral .= $strHtmlTabla4;
	$strHtmlTablaGeneral .= '		</td>';
	$strHtmlTablaGeneral .= '	</tr>';
	$strHtmlTablaGeneral .= '</table>';
		// echo $strHtmlTablaGeneral;
	//insertamos el reporte
	$idReporte = $db_funciones->insertarReporteSra($FechaEval, 
		$strHtmlTablaGeneral, $idUsuarioEvaluador, $strNivelRiesgoPaso2, $tipoObjeto, $nombreObjeto,$idPtoEval);
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

//Modificar Amenaza
if($strMetodo == "modificarMiInfo")
	modificarMiInfo();

function modificarMiInfo(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$nombre = $_POST["AjxNombre"];
	$apellido = $_POST["AjxApellido"];
	$correo = $_POST["AjxCorreo"];
	$pass = $_POST["AjxPassword"];
	$idUsuario = $_POST["AjxUsuario"];

	try {

		$bandera=$db_funciones->verificarExistenciaUsuarioUpdate($correo, $idUsuario);
				if($bandera==true){

					echo 'Ya existe una Usuario con el mismo nombre dentro del sistema';

				}
				else{
				$result = $db_funciones->modificarUsuario($nombre, $apellido, $correo, $pass, $idUsuario);

				echo "Usuario: ".$correo." guardado existosamente";

				}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

//Auth
if($strMetodo == "Auth")
	Login();

function Login(){
	include_once "funciones.php";
	$db_funciones = new Funciones();
	$usuario = $_POST["usu"];
	$pass = $_POST['pass'];
	$tipo = $_POST["tipo"];


	try{

	if($db_funciones->ValidarLogin($usuario, $pass, $tipo)){
		//el id se setea en la consulta de la validacion del login

		$_SESSION["Usuario"] = $usuario;
		$_SESSION["TipoUsuario"] = $tipo;		
		echo true;
	}else{

		echo false;
	}
		
	}catch (Exception $e) {
		echo $e->getMessage();
	}
}


?>