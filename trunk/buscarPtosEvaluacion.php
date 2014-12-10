<?php 
session_start();
ob_start();
include_once "funciones.php";
$c_funciones = new Funciones();
?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeader("Buscar Punto de Evaluación", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPage("F.A.S.T. MAPAS"); ?>
		<div class="content">
			<p><strong>Selecciones el pais, del cual desea eliminar el Punto de Evaluación</strong><br />		
			<ul data-role="listview" data-filter="true" data-ajax="false">
				<?php 				
				$result = $c_funciones->getListaPaises();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<li><a href=eliminarPtoEvaluacion.php?idPais='.$row[0] .' data-ajax="false">' . $row[1] . '</a></li> ';
				}					
				?>
					
		</div>
			<?php echo $c_funciones->getMenu(); ?>
	</div>		
		<?php echo $c_funciones->getFooter(); ?>		
		<!-- FOOTER -->
	</body>
	</html>