<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

$idUsuario = $c_funciones->getIdUsuario($strUsuario);

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Buscar Punto de Evaluación", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. MAPAS"); ?>
		<div class="content">
			<p><strong>Seleccione el país, del cual desea realizar CSR del Punto de Evaluación</strong><br />		
			<ul data-role="listview" data-filter="true" data-ajax="false">
				<?php 	

				if($strTipoUsuario==1){			
						$result = $c_funciones->getListaPaises();					
						while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
						echo'<li><a href=../Csr/buscarPtoEvaluacion.php?idPais='.$row[0] .' data-ajax="false">' . $row[1] . '</a></li> ';
						}	
				}
				else{
						$result = $c_funciones->getListaPaisesAsignados($idUsuario);					
						while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
						echo'<li><a href=../Csr/buscarPtoEvaluacion.php?idPais='.$row[0] .' data-ajax="false">' . $row[1] . '</a></li> ';
						}
				}				
				?>
					
		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	</html>