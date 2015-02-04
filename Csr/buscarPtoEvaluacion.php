<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();


		if($_SESSION["Usuario"] == ""){
			header("Location: ../index.php");
			return;
		}

		$strUsuario=$_SESSION["Usuario"];
		$strTipoUsuario=$_SESSION["TipoUsuario"];

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Buscar Punto de Evaluación", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>

    <?php
          $idPais = $_GET['idPais'];
         
    ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. MAPAS"); ?>
		<div class="content">
		<form action="realizarEvaluacion.php" method="POST" data-ajax="false" >
			<p><strong>Seleccione el Punto de Evaluación que desea evaluar CSR</strong><br />		

						<select name="lstPuntos" id="lstPuntos">
							<?php 				

									$result = $c_funciones->getListaPtosEvaluacion($idPais);
									while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
									}																						
							?>
						</select>	
						<select name="lstNivelRiesgo" id="lstNivelRiesgo">
							<?php 				

									$result = $c_funciones->getNivelRiesgo();
									while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
									}																						
							?>
						</select>										

		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
		<input type="submit" id="botonEvaluar" data-theme="a" name="submit" value="Iniciar Evaluación" class="ui-btn-hidden" aria-disabled="false"/>
		</div>	
	</form>


		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	</html>