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
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>

    <?php
          $idPais = $_GET['idPais'];
         
    ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. CSR"); ?>
		<div role="main" class="ui-content">
		<form action="realizarEvaluacionEvento.php" method="POST" data-ajax="false" >
			<p align="center"><strong>Seleccione el Evento que desea evaluar CSR</strong><br />		
				<div class="ui-body ui-body-a ui-corner-all">
						<select name="lstEventos" id="lsteEventos">
							<?php 				

									$result = $c_funciones->getListaEventos();
									while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo'
										<option value="'. $row[0] . '">' . $row[1] . '</option>';
									}																						
							?>
						</select>	
			<p align="center"><strong>Seleccione el nivel de riesgo para ese Evento</strong><br />						
						<select name="lstNivelRiesgo" id="lstNivelRiesgo">
							<?php 				

									$result = $c_funciones->getNivelRiesgo();
									while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
										echo'
										<option value="'. $row[0] . '">' . $row[1] . '</option>';
									}																						
							?>
						</select>	
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<input type="submit" id="botonEvaluar" data-theme="a" name="submit" value="Iniciar Evaluación" class="ui-btn-hidden" aria-disabled="false"/>
				</div>							

				</div>									
	</form>


		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	</html>