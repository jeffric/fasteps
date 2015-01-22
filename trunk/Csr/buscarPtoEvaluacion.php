<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

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
			<p><strong>Seleccione el Punto de Evaluación que desea evaluar CSR</strong><br />		
			<ul data-role="listview" data-filter="true" data-ajax="false">
				<?php 				
				$result = $c_funciones->getListaPtosEvaluacion($idPais);					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<li><a href=../Csr/realizarEvaluacion.php?idPtoEvaluacion='.$row[0] .'&idPais='.$idPais.' data-ajax="false">' . $row[1] . '</a></li> ';
				}					
				?>
					
		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	</html>