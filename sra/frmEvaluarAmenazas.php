<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();
//$result = $c_funciones->ConsultarNivelesDeRiesgo()
		if($_SESSION["Usuario"] == ""){
			header("Location: ../index.php");
			return;
		}

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Evaluar Amenazas SRA", 
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>'); 
  ?>
	<script type="text/javascript">
	$(function() {
		////$("nav#menu").mmenu();
	});
</script>'); ?>

<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Evaluar Amenazas SRA"); ?>
		<div role="main" class="ui-content">			
			<div class="ui-body ui-body-a ui-corner-all">
			<table data-role="table" id="sra-table" data-mode="reflow" class="ui-responsive table-stroke ui-table ui-table-reflow">
				<thead>
					<tr>
						<th >Pregunta</th>
						<th >Riesgo</th>
						<th >Impacto</th>
						<th ><abbr title="Rotten Tomato Rating">Probabilidad</abbr></th>
						<th >Nivel de Riesgo</th>
					</tr>
				</thead>
				<tbody>
					<?php  
					//obtenemos las amenazas escogidas anteriormente
					$arrAmenazas = Array();
					if(isset($_POST['chkAmenazas'])){
						if(!empty($_POST['chkAmenazas'])) {
							$_SESSION['arrAmenazasSRAActual'] = $_POST['chkAmenazas'];							
							$strHtml = "";
							$strJs = "";
							$contadorA = 0;
							$contadorB = 100;
							$contadorC = 200;
							$contadorD = 300;
							$contadorE = 400;
							$contadorF = 500;
							foreach($_SESSION['arrAmenazasSRAActual'] as $checkAmenaza){
								$strNombreAmenaza = "";
								$strIdAmenaza;
								//primero con el id de la amenaza, consultamos su informacion\
								$resultAmenaza = $c_funciones->getAmenazas($checkAmenaza);
								while($row = mysqli_fetch_array($resultAmenaza, MYSQL_NUM)){
									$strNombreAmenaza = $row[1];
									$strIdAmenaza = $row[0];
									break;
								}

//Estos names sirven para poder escribir las funciones javascript que controlan
//el cambio automatico del nivel de riesgo
								$nameImpacto="rdbP_Impacto" . $contadorA;
								$nameProbabilidad = "rdbP_Probabilidad" . $contadorB;
								$nameNivelRiesgo = "rdbP_NivelDeRiesgo" . $contadorC;

								$strHtml .= '<tr idAmenaza="' . $strIdAmenaza . '" strAmenaza="' . $strNombreAmenaza . '">';
								$strHtml .= '<th><b class="ui-table-cell-label">Pregunta</b>' . $contadorA . ' - ' . $strNombreAmenaza . '</th>';
								$strHtml .= '<td><b class="ui-table-cell-label">Riesgo</b>' . $strNombreAmenaza . '</td>';
								$strHtml .= '<td><b class="ui-table-cell-label">Impacto</b>';
								$strHtml .= '	<table class="tblImpacto">';
								$strHtml .= '		<tr>';
								$strHtml .= '			<td>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_Impacto' . $contadorA . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Insignificante</label>';
								$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorA . '" class="" id="rdbP_Impacto' . $contadorA . '" value="0" checked="checked">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_Impacto' . $contadorB . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Menor</label>';
								$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorA . '" id="rdbP_Impacto' . $contadorB . '" value="1" >';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_Impacto' . $contadorC . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Moderado</label>';
								$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorA . '" id="rdbP_Impacto' . $contadorC . '" value="2">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_Impacto' . $contadorD . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Severo</label>';
								$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorA . '" id="rdbP_Impacto' . $contadorD . '" value="3">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_Impacto' . $contadorE . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Cr&iacute;tico</label>';
								$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorA . '" id="rdbP_Impacto' . $contadorE . '" value="4">';
								$strHtml .= '				</div>';
								$strHtml .= '			</td>';
								$strHtml .= '		</tr>';
								$strHtml .= '	</table>';
								$strHtml .= '</td>';
								$strHtml .= '<td>';
								$strHtml .= '	<b class="ui-table-cell-label">Probabilidad</b>';
								$strHtml .= '	<table class="tblProb">';
								$strHtml .= '		<tr>';
								$strHtml .= '			<td>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorA . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Improbable</label>';
								$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorB . '" id="rdbP_Probabilidad' . $contadorA . '" value="4" checked="checked">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorB . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Moderadamente Probable</label>';
								$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorB . '" id="rdbP_Probabilidad' . $contadorB . '" value="3">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorC . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Probable</label>';
								$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorB . '" id="rdbP_Probabilidad' . $contadorC . '" value="2">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorD . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Muy Probable</label>';
								$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorB . '" id="rdbP_Probabilidad' . $contadorD . '" value="1">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorE . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Inminente</label>';
								$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorB . '" id="rdbP_Probabilidad' . $contadorE . '" value="0">';
								$strHtml .= '				</div>';
								$strHtml .= '			</td>';
								$strHtml .= '		</tr>';
								$strHtml .= '	</table>';
								$strHtml .= '</td>';
								$strHtml .= '<td>';
								$strHtml .= '	<b class="ui-table-cell-label">Nivel de riesgo</b>';
								$strHtml .= '	<table class="tblNivelRiesgo">';
								$strHtml .= '		<tr>';
								$strHtml .= '			<td>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorA . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Nulo</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorA . '" value="6" checked="checked" disabled>';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorB . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Insignificante</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorB . '" value="1" disabled>';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorC . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Bajo</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorC . '" value="2" disabled>';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorD . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Medio</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorD . '" value="3" disabled>';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorE . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Alto</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorE . '" value="4" disabled>';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorF . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Cr&iacute;tico</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorF . '" value="5" disabled>';
								$strHtml .= '				</div>';
								$strHtml .= '			</td>';
								$strHtml .= '		</tr>';
								$strHtml .= '	</table>';
								$strHtml .= '</td>';
								$strHtml .= '</tr>';								


//imprimimos las funciones javascript para el cambio automatico
								$strJs .= "
								$(function(){
									$('input[name=" . $nameImpacto . "]').click(function() {
										var prob = $($('input[name=" . $nameProbabilidad . "]:radio:checked')).val();
										var impact = $(this).val();
										var stval = getRiskLevelNumber(prob,impact);
										$('[name=" . $nameNivelRiesgo . "][value=\"'+ stval +'\"]').prop('checked','checked');
										$(\"input[type='radio']\").checkboxradio(\"refresh\");
									});

$('input[name=" . $nameProbabilidad . "]').click(function() {
	var impact = $($('input[name=" . $nameImpacto . "]:radio:checked')).val();
	var prob = $(this).val();
	var stval = getRiskLevelNumber(prob,impact);
	$('[name=" . $nameNivelRiesgo . "][value=\"'+ stval +'\"]').prop('checked','checked');
	$(\"input[type='radio']\").checkboxradio(\"refresh\");
});
});
";

								//se aumentan los contadores
$contadorA++;
$contadorB++;
$contadorC++;
$contadorD++;
$contadorE++;
$contadorF++;
}
echo $strHtml;
echo "<script type='text/javascript'>" . $strJs . "</script>";
}else{
	echo '
	<script type="text/javascript">
		$(function(){
			setTimeout(function() {
				swal({   
					title: "Advertencia",   
					text: "La evaluacion SRA no se ha podido crear. Se le redireccionara para crear una nueva evaluacion SRA.",   
					type: "warning",   
					showCancelButton: false,   
					confirmButtonColor: "#DD6B55",   
					confirmButtonText: "Aceptar",   
					cancelButtonText: "",   
					closeOnConfirm: false,   
					closeOnCancel: false 
				}, 
				function(isConfirm){   
					if (isConfirm) {     
						window.location = "index.php";
					} 
					else {     
						window.location = "index.php";
					} 
				});
}, 100);
});	
</script>
';
}
}else if(isset($_SESSION['arrAmenazasSRAActual'])){
	$strHtml = "";
	$strJs = "";
	$contadorA = 0;
	$contadorB = 100;
	$contadorC = 200;
	$contadorD = 300;
	$contadorE = 400;
	$contadorF = 500;
	foreach($_SESSION['arrAmenazasSRAActual'] as $checkAmenaza){
		$strNombreAmenaza = "";
		$strIdAmenaza;
								//primero con el id de la amenaza, consultamos su informacion\
		$resultAmenaza = $c_funciones->getAmenazas($checkAmenaza);
		while($row = mysqli_fetch_array($resultAmenaza, MYSQL_NUM)){
			$strNombreAmenaza = $row[1];
			$strIdAmenaza = $row[0];
			break;
		}

//Estos names sirven para poder escribir las funciones javascript que controlan
//el cambio automatico del nivel de riesgo
		$nameImpacto="rdbP_Impacto" . $contadorA;
		$nameProbabilidad = "rdbP_Probabilidad" . $contadorB;
		$nameNivelRiesgo = "rdbP_NivelDeRiesgo" . $contadorC;

		$strHtml .= '<tr idAmenaza="' . $strIdAmenaza . '">';
		$strHtml .= '<th><b class="ui-table-cell-label">Pregunta</b>' . $contadorA . ' - ' . $strNombreAmenaza . '</th>';
		$strHtml .= '<td><b class="ui-table-cell-label">Riesgo</b>' . $strNombreAmenaza . '</td>';
		$strHtml .= '<td><b class="ui-table-cell-label">Impacto</b>';
		$strHtml .= '	<table class="tblImpacto">';
		$strHtml .= '		<tr>';
		$strHtml .= '			<td>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_Impacto' . $contadorA . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Insignificante</label>';
		$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorA . '" class="" id="rdbP_Impacto' . $contadorA . '" value="0" checked="checked">';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_Impacto' . $contadorB . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Menor</label>';
		$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorA . '" id="rdbP_Impacto' . $contadorB . '" value="1" >';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_Impacto' . $contadorC . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Moderado</label>';
		$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorA . '" id="rdbP_Impacto' . $contadorC . '" value="2">';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_Impacto' . $contadorD . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Severo</label>';
		$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorA . '" id="rdbP_Impacto' . $contadorD . '" value="3">';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_Impacto' . $contadorE . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Cr&iacute;tico</label>';
		$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorA . '" id="rdbP_Impacto' . $contadorE . '" value="4">';
		$strHtml .= '				</div>';
		$strHtml .= '			</td>';
		$strHtml .= '		</tr>';
		$strHtml .= '	</table>';
		$strHtml .= '</td>';
		$strHtml .= '<td>';
		$strHtml .= '	<b class="ui-table-cell-label">Probabilidad</b>';
		$strHtml .= '	<table class="tblProb">';
		$strHtml .= '		<tr>';
		$strHtml .= '			<td>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorA . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Improbable</label>';
		$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorB . '" id="rdbP_Probabilidad' . $contadorA . '" value="4" checked="checked">';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorB . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Moderadamente Probable</label>';
		$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorB . '" id="rdbP_Probabilidad' . $contadorB . '" value="3">';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorC . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Probable</label>';
		$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorB . '" id="rdbP_Probabilidad' . $contadorC . '" value="2">';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorD . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Muy Probable</label>';
		$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorB . '" id="rdbP_Probabilidad' . $contadorD . '" value="1">';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorE . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Inminente</label>';
		$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorB . '" id="rdbP_Probabilidad' . $contadorE . '" value="0">';
		$strHtml .= '				</div>';
		$strHtml .= '			</td>';
		$strHtml .= '		</tr>';
		$strHtml .= '	</table>';
		$strHtml .= '</td>';
		$strHtml .= '<td>';
		$strHtml .= '	<b class="ui-table-cell-label">Nivel de riesgo</b>';
		$strHtml .= '	<table class="tblNivelRiesgo">';
		$strHtml .= '		<tr>';
		$strHtml .= '			<td>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorA . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Nulo</label>';
		$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorA . '" value="6" checked="checked" disabled>';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorB . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Insignificante</label>';
		$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorB . '" value="1" disabled>';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorC . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Bajo</label>';
		$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorC . '" value="2" disabled>';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorD . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Medio</label>';
		$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorD . '" value="3" disabled>';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorE . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Alto</label>';
		$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorE . '" value="4" disabled>';
		$strHtml .= '				</div>';
		$strHtml .= '				<div class="ui-radio ui-mini">';
		$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorF . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Cr&iacute;tico</label>';
		$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorF . '" value="5" disabled>';
		$strHtml .= '				</div>';
		$strHtml .= '			</td>';
		$strHtml .= '		</tr>';
		$strHtml .= '	</table>';
		$strHtml .= '</td>';
		$strHtml .= '<td>';
		$strHtml .= '	<table>';
		$strHtml .= '<tr>';
							//planes de prevencion
		$strHtml .= '<td>';
		$strHtml .= '<select data-role="none" multiple="multiple" id="prevsel-' . $contadorA . '" class="planprev" name="prevsel-' . $contadorA . '[]">';
		$resultPrev = $c_funciones->getPlanesPrevencion();
		while($row = mysqli_fetch_array($resultPrev, MYSQL_NUM)){
			$strHtml .=  '<option value="' . $row[0] . '" title="' . $row[2] . '" >' . $row[1] . '</option>';
		}
		$strHtml .= '</td>';

		$strHtml .= '</td>';
		$strHtml .= '</tr>';
		$strHtml .= '	</table>';
		$strHtml .= '</td>';


							//planes de mitigacion 
		$strHtml .= '<td>';
		$strHtml .= '	<table>';
		$strHtml .= '<tr>';							
		$strHtml .= '<td>';
		$strHtml .= '<select data-role="none" multiple="multiple" id="mitsel-' . $contadorA . '" class="planprev" name="mitsel-' . $contadorA . '[]">';
		$resultMit = $c_funciones->getPlanesMitigacion();
		while($row = mysqli_fetch_array($resultMit, MYSQL_NUM)){
			$strHtml .=  '<option value="' . $row[0] . '" title="' . $row[2] . '" >' . $row[1] . '</option>';
		}
		$strHtml .= '</td>';

		$strHtml .= '</td>';
		$strHtml .= '</tr>';
		$strHtml .= '	</table>';
		$strHtml .= '</td>';
		$strHtml .= '</tr>';


//imprimimos las funciones javascript para el cambio automatico
		$strJs .= "
		$(function(){
			$('input[name=" . $nameImpacto . "]').click(function() {
				var prob = $($('input[name=" . $nameProbabilidad . "]:radio:checked')).val();
				var impact = $(this).val();
				var stval = getRiskLevelNumber(prob,impact);
				$('[name=" . $nameNivelRiesgo . "][value=\"'+ stval +'\"]').prop('checked','checked');
				$(\"input[type='radio']\").checkboxradio(\"refresh\");
			});

$('input[name=" . $nameProbabilidad . "]').click(function() {
	var impact = $($('input[name=" . $nameImpacto . "]:radio:checked')).val();
	var prob = $(this).val();
	var stval = getRiskLevelNumber(prob,impact);
	$('[name=" . $nameNivelRiesgo . "][value=\"'+ stval +'\"]').prop('checked','checked');
	$(\"input[type='radio']\").checkboxradio(\"refresh\");
});

	//llamada a multiselect
$(\".planprev\").multiSelect();
});
";

								//se aumentan los contadores
$contadorA++;
$contadorB++;
$contadorC++;
$contadorD++;
$contadorE++;
$contadorF++;
}
echo $strHtml;
echo "<script type='text/javascript'>" . $strJs . "</script>";
}else{
	echo '
	<script type="text/javascript">
		$(function(){
			setTimeout(function() {
				swal({   
					title: "Advertencia",   
					text: "La evaluacion SRA no se ha podido crear. Se le redireccionara para crear una nueva evaluacion SRA.",   
					type: "warning",   
					showCancelButton: false,   
					confirmButtonColor: "#DD6B55",   
					confirmButtonText: "Aceptar",   
					cancelButtonText: "",   
					closeOnConfirm: false,   
					closeOnCancel: false 
				}, 
				function(isConfirm){   
					if (isConfirm) {     
						window.location = "index.php";
					} 
					else {     
						window.location = "index.php";
					} 
				});
}, 100);
});	
</script>';
}
					// if (is_array($_POST['chkAmenazas'])) {	
					// 	if(!empty($_POST['chkAmenazas'])) {
					// 		$_SESSION['arrAmenazasSRAActual'] = $_POST['chkAmenazas'];
					// 		$arrAmenazas = $_POST['chkAmenazas'];
					// 	}
					// }else{
					// 	echo "no es array.";
					// }					
?>
</tbody>
</table>
<form action="frmPlanesMitigacion.php" id="frmEval" name="frmEval" style="display:none;" method="POST" data-ajax="false">
	<input type="hidden" id="hdIdsSRA" name="hdIdsSRA">
	<input type="hidden" id="jsonPaso1" name="jsonPaso1">
	<?php echo '<input type="hidden" id="hdIdEval" value="' . $_SESSION["idEvalSraActual"] . '" />'; ?>
	<input type="submit" id="btnEv" name="btnEv" value="" />
</form>	
<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
	<input type="button" id="btnEvaluar" data-theme="a" name="btnEvaluar" onclick="confirmar();" value="Evaluar" class="ui-btn-hidden" aria-disabled="false"/>
</div>		
</div>
</div>
<?php echo $c_funciones->getMenuNivel2($_SESSION["TipoUsuario"]); ?>
<?php echo $c_funciones->getFooterNivel2(); ?>		

</div>		
<script type="text/javascript">

	if (typeof String.prototype.startsWith != 'function') {
  // see below for better implementation!
  String.prototype.startsWith = function (str){
  	return this.indexOf(str) == 0;
  };
}

		//0=Inisignificante, 1=Bajo, 2=Medio, 3=Alto, 4=Critico, 5=nulo

		//								_Insignificante_	_Menor_			_Moderado_		_Severo_		_Critico_
		// Imninente 		  	  ||	Bajo(0,0)				Medio(0,1)			Alto(0,2)			Critico(0,3)			Critico(0,4)
		// Muy Probable 		  ||	Bajo(1,0)				Medio(1,1)			Alto(1,2)			Alto(1,3)			Critico(1,4)
		// Probable  			  ||	Insignificante(2,0)		Bajo(2,1)			Medio(2,2)			Alto(2,3)			Alto(2,4)
		// Moderadamente Probable || 	Insignificante(3,0)		Bajo(3,1)			Bajo(3,2)			Medio(3,3)			Medio(3,4)
		// Improbable   		  ||	Nulo(4,0)				Insignificante(4,1)	Insignificante(4,2)	Bajo(4,3)			Bajo(4,4)
		

		
		var MatrizSra = [
		[2,3,4,5,5],
		[2,3,4,4,5],
		[1,2,3,4,4],
		[1,2,2,3,3],
		[6,1,1,2,2]
		];	
		function getRiskLevelNumber(Probabilidad, Impacto){
			if(parseInt(Probabilidad) > 4 || parseInt(Impacto) > 4){
				return -1;
			}
			return MatrizSra[parseInt(Probabilidad)][parseInt(Impacto)];
		}


		function getRiskLevelString(Probabilidad, Impacto){
			if(parseInt(Probabilidad) > 4 || parseInt(Impacto) > 4){
				return "";
			}
			var RiskNumber = getRiskLevelNumber(parseInt(Probabilidad), parseInt(Impacto));
			//0=Inisignificante, 1=Bajo, 2=Medio, 3=Alto, 4=Critico, 5=nulo
			switch(RiskNumber){
				case 1:
				return "Insignificante";
				case 2:
				return "Bajo";
				case 3:
				return "Medio";
				case 4:
				return "Alto";
				case 5:
				return "Cr&iacute;tico";
				case 6:
				return "Nulo";
				default:
				return "";
			}
		}	

		function getEvalJson(){
			var objContenidos = {
				"InfoEval":[],
				"Eval" : []
			}

			var idEval = $("#hdIdEval").val();


			objContenidos.InfoEval.push({"IdEvaluacion" : idEval});


			$("#sra-table tr").each(function(){
				var idAmenaza = $(this).attr("idAmenaza");
				var impacto = "";
				var probabilidad = "";
				var nivelDeRiesgo = "";				
				var strAmenaza = $(this).attr("strAmenaza");
				var strImpacto = "";
				var strProbabilidad = "";
				var strNivelDeRiesgo = "";


				//tabla de impactos
				$(this).find(".tblImpacto").each(function(){
					impacto = $(this).find("input[type=radio]:checked").val();
					var idlbl = $(this).find("input[type=radio]:checked").attr("id");
					var label = $('label[for="' + idlbl + '"]');
					strImpacto = $(label).text();
				});

				//tabla de probabilidades
				$(this).find(".tblProb").each(function(){
					probabilidad = $(this).find("input[type=radio]:checked").val();
					var idlbl = $(this).find("input[type=radio]:checked").attr("id");
					var label = $('label[for="' + idlbl + '"]');
					strProbabilidad = $(label).text();
				});

				//tabla de niveles de riesgo
				$(this).find(".tblNivelRiesgo").each(function(){
					nivelDeRiesgo = $(this).find("input[type=radio]:checked").val();
					var idlbl = $(this).find("input[type=radio]:checked").attr("id");
					var label = $('label[for="' + idlbl + '"]');
					strNivelDeRiesgo = $(label).text();
				});

				//hacemos push al json de los datos.
				if(impacto != "" && probabilidad != "" && nivelDeRiesgo != ""){
					objContenidos.Eval.push(
						{
							"IdAmenaza": idAmenaza, 
							"Impacto": impacto, 
							"Probabilidad": probabilidad, 
							"NivelDeRiesgo" : nivelDeRiesgo,
							"strAmenaza" : strAmenaza,
							"strImpacto" : strImpacto,
							"strProbabilidad" : strProbabilidad,
							"strNivelDeRiesgo" : strNivelDeRiesgo
						});
				}
			});			
			return objContenidos;
		}

		// $(function(){
		// 	$("#frmEval").submit(function(){
		// 		$("#hdJsonEval").val(JSON.stringify(getEvalJson()));
		// 		return true;
		// 	});
		// });

function confirmar(){
	swal({   
		title: "¿Desea evaluar las amenazas?",   
		text: "",   
		type: "info",
		showCancelButton: true,   
		cancelButtonText: "Cancelar",
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Evaluar",   
		closeOnConfirm: false 
	}, 
	function(){   
		evaluar();
	});
}

function evaluar(){
	//alert(JSON.stringify(getEvalJson()));
	var objJsonSra = getEvalJson();
	var blnSubmit = false;
	$("#hdIdsSRA").val(JSON.stringify(objJsonSra));	
			//EvaluarSRA()
			$.ajax({
				type: "POST",
				url: "../funcionesAjax.php",
				data: {                   
					nombreMetodo: "EvalSRA",
					jsonSRA: JSON.stringify(objJsonSra), 
					jsonPaso1: JSON.stringify(getEvalJson())
				},
				beforeSend: function () {
					//$("#modalCargando").modal("show");                       
				},
				success: function (datos) {
					//$("#modalCargando").modal("hide");
					if(datos.startsWith("-1")){
						var arrErr = datos.split("|");
						alert(arrErr[2] + ", Insertados: " + arrErr[1]);
					}else{
						$("#btnEv").click();
					}
				},
				error: function (objeto, error, objeto2) {
					//$("#modalCargando").modal("hide"); 
					alert(error);
				}
			});			
		}
	</script>
</body>
</html>