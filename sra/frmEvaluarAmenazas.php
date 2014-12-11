<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();
//$result = $c_funciones->ConsultarNivelesDeRiesgo()


?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Evaluar Amenazas SRA", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Home"); ?>
		<div class="content">
		<form action="frmPlanesMitigacion.php" method="POST" data-ajax="false">
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
							$contadorA = 0;
							$contadorB = 100;
							$contadorC = 200;
							$contadorD = 300;
							$contadorE = 400;
							$contadorF = 500;
							foreach($_SESSION['arrAmenazasSRAActual'] as $checkAmenaza){
								$strNombreAmenaza = "";
								//primero con el id de la amenaza, consultamos su informacion\
								$resultAmenaza = $c_funciones->getAmenazas($checkAmenaza);
								while($row = mysqli_fetch_array($resultAmenaza, MYSQL_NUM)){
									$strNombreAmenaza = $row[1];
									break;
								}
								$strHtml .= '<tr>';
								$strHtml .= '<th><b class="ui-table-cell-label">Pregunta</b>' . $contadorA . ' - ' . $strNombreAmenaza . '</th>';
								$strHtml .= '<td><b class="ui-table-cell-label">Riesgo</b>' . $strNombreAmenaza . '</td>';
								$strHtml .= '<td><b class="ui-table-cell-label">Impacto</b>';
								$strHtml .= '	<table>';
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
								$strHtml .= '	<table>';
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
								$strHtml .= '	<table>';
								$strHtml .= '		<tr>';
								$strHtml .= '			<td>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorA . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Nulo</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorA . '" value="5" checked="checked">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorB . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Insignificante</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorB . '" value="0">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorC . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Bajo</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorC . '" value="1">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorD . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Medio</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorD . '" value="2">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorE . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Alto</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorE . '" value="3">';
								$strHtml .= '				</div>';
								$strHtml .= '				<div class="ui-radio ui-mini">';
								$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorF . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Cr&iacute;tico</label>';
								$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorF . '" value="4">';
								$strHtml .= '				</div>';
								$strHtml .= '			</td>';
								$strHtml .= '		</tr>';
								$strHtml .= '	</table>';
								$strHtml .= '</td>';
								$strHtml .= '</tr>';								

								//se aumentan los contadores
								$contadorA++;
								$contadorB++;
								$contadorC++;
								$contadorD++;
								$contadorE++;
								$contadorF++;
							}
							echo $strHtml;
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
						$contadorA = 0;
						$contadorB = 100;
						$contadorC = 200;
						$contadorD = 300;
						$contadorE = 400;
						$contadorF = 500;
						foreach($_SESSION['arrAmenazasSRAActual'] as $checkAmenaza){
							$strNombreAmenaza = "";
								//primero con el id de la amenaza, consultamos su informacion\
							$resultAmenaza = $c_funciones->getAmenazas($checkAmenaza);
							while($row = mysqli_fetch_array($resultAmenaza, MYSQL_NUM)){
								$strNombreAmenaza = $row[1];
								break;
							}
							$strHtml .= '<tr>';
							$strHtml .= '<th><b class="ui-table-cell-label">Pregunta</b>' . $contadorA . ' - ' . $strNombreAmenaza . '</th>';
							$strHtml .= '<td><b class="ui-table-cell-label">Riesgo</b>' . $strNombreAmenaza . '</td>';
							$strHtml .= '<td><b class="ui-table-cell-label">Impacto</b>';
							$strHtml .= '	<table>';
							$strHtml .= '		<tr>';
							$strHtml .= '			<td>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_Impacto' . $contadorA . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Insignificante</label>';
							$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorA . '" class="" id="rdbP_Impacto' . $contadorA . '" value="0" checked="checked">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_Impacto' . $contadorB . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Menor</label>';
							$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorB . '" id="rdbP_Impacto' . $contadorB . '" value="1" >';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_Impacto' . $contadorC . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Moderado</label>';
							$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorC . '" id="rdbP_Impacto' . $contadorC . '" value="2">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_Impactod' . $contadorD . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Severo</label>';
							$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorD . '" id="rdbP_Impacto' . $contadorD . '" value="3">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_Impacto' . $contadorE . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Cr&iacute;tico</label>';
							$strHtml .= '					<input type="radio" name="rdbP_Impacto' . $contadorE . '" id="rdbP_Impacto' . $contadorE . '" value="4">';
							$strHtml .= '				</div>';
							$strHtml .= '			</td>';
							$strHtml .= '		</tr>';
							$strHtml .= '	</table>';
							$strHtml .= '</td>';
							$strHtml .= '<td>';
							$strHtml .= '	<b class="ui-table-cell-label">Probabilidad</b>';
							$strHtml .= '	<table>';
							$strHtml .= '		<tr>';
							$strHtml .= '			<td>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorA . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Improbable</label>';
							$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorA . '" id="rdbP_Probabilidad' . $contadorA . '" value="4" checked="checked">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorB . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Moderadamente Probable</label>';
							$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorB . '" id="rdbP_Probabilidad' . $contadorB . '" value="3">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorC . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Probable</label>';
							$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorC . '" id="rdbP_Probabilidad' . $contadorC . '" value="2">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorD . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Muy Probable</label>';
							$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorD . '" id="rdbP_Probabilidad' . $contadorD . '" value="1">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_Probabilidad' . $contadorE . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Inminente</label>';
							$strHtml .= '					<input type="radio" name="rdbP_Probabilidad' . $contadorE . '" id="rdbP_Probabilidad' . $contadorE . '" value="0">';
							$strHtml .= '				</div>';
							$strHtml .= '			</td>';
							$strHtml .= '		</tr>';
							$strHtml .= '	</table>';
							$strHtml .= '</td>';
							$strHtml .= '<td>';
							$strHtml .= '	<b class="ui-table-cell-label">Nivel de riesgo</b>';
							$strHtml .= '	<table>';
							$strHtml .= '		<tr>';
							$strHtml .= '			<td>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorA . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Nulo</label>';
							$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorA . '" id="rdbP_NivelDeRiesgo' . $contadorA . '" value="5" checked="checked">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorB . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Insignificante</label>';
							$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorB . '" id="rdbP_NivelDeRiesgo' . $contadorB . '" value="0">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorC . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Bajo</label>';
							$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorC . '" id="rdbP_NivelDeRiesgo' . $contadorC . '" value="1">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorD . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Medio</label>';
							$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorD . '" id="rdbP_NivelDeRiesgo' . $contadorD . '" value="2">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorE . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Alto</label>';
							$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorE . '" id="rdbP_NivelDeRiesgo' . $contadorE . '" value="3">';
							$strHtml .= '				</div>';
							$strHtml .= '				<div class="ui-radio ui-mini">';
							$strHtml .= '					<label for="rdbP_NivelDeRiesgo' . $contadorF . '" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child">Cr&iacute;tico</label>';
							$strHtml .= '					<input type="radio" name="rdbP_NivelDeRiesgo' . $contadorF . '" id="rdbP_NivelDeRiesgo' . $contadorF . '" value="4">';
							$strHtml .= '				</div>';
							$strHtml .= '			</td>';
							$strHtml .= '		</tr>';
							$strHtml .= '	</table>';
							$strHtml .= '</td>';
							$strHtml .= '</tr>';								

								//se aumentan los contadores
							$contadorA++;
							$contadorB++;
							$contadorC++;
							$contadorD++;
							$contadorE++;
							$contadorF++;
						}
						echo $strHtml;
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
		</form>			
		</div>
		<?php echo $c_funciones->getMenuNivel2(); ?>
	</div>		
	<?php echo $c_funciones->getFooterNivel2(); ?>		
	<!-- FOOTER -->
</body>
</html>