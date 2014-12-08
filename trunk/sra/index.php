<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();
?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("SRA - Inicio", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
$(document).bind("mobileinit", function () {

	$.mobile.ajaxEnabled = false;

});

</script>
<link src="../css/jquery-ui.structure.css" rel="stylesheet">	
<link src="../css/jquery-ui.css" rel="stylesheet">	
<link src="../css/jquery-ui.theme.css" rel="stylesheet">	
<script src="../css/jquery-ui.js"></script>
'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. SRA"); ?>
		<div class="content">
			<div class="ui-body ui-body-a ui-corner-all">
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<label for="lstPais" >País</label>
					<select name="lstPais" id="lstPais">
						<option value="-2">Elegir un país</option>
						<?php 				
						//$result = $c_funciones->getListaPaises($_SESSION["IdUsrLog"]);
						$result = $c_funciones->getListaPaises(19);
						while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
							echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
						}					
						?>
					</select>
				</div>
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<label for="lstPuntoEvaluacion" >Punto de evaluación</label>
					<select name="lstPuntoEvaluacion" id="lstPuntoEvaluacion">						
					</select>
				</div>
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<label for="txtFecha" >Fecha</label>
					<input type="text" name="txtFecha" id="txtFecha" value="" data-role="date" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">					
				</div>
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<label for="txtCreador" >Elaborado por</label>
					<input type="text" name="txtCreador" id="txtCreador" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
				</div>
			</div>
			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<button id="btnCrearEval" data-theme="a" name="btnCrearEval" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Crear evaluación</button>
			</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2(); ?>
	</div>		
	<?php echo $c_funciones->getFooterNivel2(); ?>		
	<!-- FOOTER -->

	<script type="text/javascript">
	//txtFecha
	$(function(){
		$("#txtFecha").datepicker();
	});

	$("#lstPais").change(function(){
		var idPais = $(this).val();
		if(idPais == "-2"){
			swal("Advertencia", "Debe elegir un país", "warning");
			return false;
		}

		$.ajax({
			type: "POST",
			url: "../funcionesAjax.php",
			data: {
				nombreMetodo: "getPtosEval",
				AjxPPais: idPais
			},
			beforeSend: function () {
					//$("#modalCargando").modal("show");
					$("#respuesta").text("Creando usuario...");
				},
				success: function (datos) {					
					$("#lstPuntoEvaluacion").html(datos);					
				},
				error: function (objeto, error, objeto2) {
					//$("#modalCargando").modal("hide");
					alert(error);
				}
			});
	});


	function openModalCargando(){
		swal({
			title: "Cargando...",			
			imageUrl: "../css/images/ajax-loader.gif"			
		});
		$(".confirm").css("display", "none");
	}

	function closeModalCargando(){
		$(".confirm").click();
	}

</script>
</body>
</html>