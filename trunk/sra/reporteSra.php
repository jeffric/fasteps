<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

		if($_SESSION["Usuario"] == ""){
			header("Location: ../index.php");
			return;
		}

try {
	unset($_SESSION['arrAmenazasSRAActual']);
	unset($_SESSION["idEvalSraActual"]);
	unset($_SESSION["JsonPaso1SRA"]);
} catch (Exception $e) {
	
}

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Reporte SRA", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
$(document).bind("mobileinit", function () {

	$.mobile.ajaxEnabled = false;

});
</script>

'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Home"); ?>
		<div class="content">
			<div id="printReport" class="ui-grid-solo">
				<?php 
				$idReporteSra = $_GET["idRepo"];
				$strHtmlReporte = '';
				$result = $c_funciones->getReporteSra($idReporteSra);
				while($row = mysqli_fetch_array($result, MYSQL_NUM)){
					$strHtmlReporte = $row[2];					
					break;
				}
				echo $strHtmlReporte;
				?>
			</div>
<?php  
	echo '<input type="hidden" id="hdRep" value="' . $_GET["idRepo"] . '" />';
?>
			<div data-role="fieldcontain">
				<label for="txtDescripcion">Lista de correos (correos separados por comas):</label>
				<textarea cols="40" rows="8" name="txtCorreos" id="txtCorreos" placeholder="Ej: cordonez@vm.com, jp@vm.com, jfuentes@gmail.com, lbarrios@gmail.com..."></textarea>
			</div>
			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<a id="btnCorreo" data-theme="a" href="#" name="btnEvaluar" class="ui-btn-hidden" aria-disabled="false">Enviar por correo</a>
			</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($_SESSION["TipoUsuario"]); ?>
	</div>		
	<?php echo $c_funciones->getFooterNivel2(); ?>		
	<!-- FOOTER -->

	<script type="text/javascript">
	$("#btnCorreo").click(function(){
		var correos = $("#txtCorreos").val();
		var idRep = $("#hdRep").val();
		var estilo = $("style").text();
		$.ajax({
				type: "POST",
				url: "../funcionesAjax.php",
				data: {                   
					nombreMetodo: "SendEMail",
					mails: correos,
					estilos: "",
					idRepo : idRep
				},
				beforeSend: function () {
					//$("#modalCargando").modal("show");                       
				},
				success: function (datos) {
					//$("#modalCargando").modal("hide");
					alert(datos);
				},
				error: function (objeto, error, objeto2) {
					//$("#modalCargando").modal("hide"); 
					alert(error);
				}
			});
	});
	</script>
</body>
</html>