<?php 
session_start();
ob_start();
include_once "funciones.php";
$c_funciones = new Funciones();
?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeader("Master page", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPage("F.A.S.T. Regiones"); ?>
		<div class="content">
			<p><strong>Seleccione la Región que desea eliminar del sistema</strong><br />			
            <select name="selectRegion" id="selectRegion">     
				<?php 				
				$result = $c_funciones->getListaRegiones();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
				}					
				?>
            </select> 

            <a href="#"  data-role="button" id="botonEliminar" data-theme="b">Eliminiar Region</a></center> 
            

		</div>
			<?php echo $c_funciones->getMenu(); ?>
	</div>		
		<?php echo $c_funciones->getFooter(); ?>		
		<!-- FOOTER -->
	</body>
	</html>