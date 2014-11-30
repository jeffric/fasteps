<?php 
session_start();
ob_start();
include_once "funciones.php";
$c_funciones = new Funciones();
?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeader("Agregar Pais", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPage("F.A.S.T. Paises"); ?>
		<div class="content">
			<p><strong>Ingrese la informacion requerida:</strong><br />	
			
			<label >Nombre de País:</label> 
            <input type="text" name="namelatitud" id="textNombrePais"  style="text-align:center; font-weight:Bold; color:black; font-size:20;"> 
			<p><strong>Elige la Región a la que pertenecerá el nuevo País:</strong><br />	            

            <select name="selectRegion" id="selectRegion" >   
				<?php 				
				$result = $c_funciones->getListaRegiones();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
				}					
				?>             
            </select> 	

            <a href=""  data-role="button" id="botonAgregar" data-theme="b">Agregar País</a></center> 

		</div>
			<?php echo $c_funciones->getMenu(); ?>
	</div>		
		<?php echo $c_funciones->getFooter(); ?>		
		<!-- FOOTER -->
	</body>
	</html>