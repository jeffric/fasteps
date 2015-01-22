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
<?php echo $c_funciones->getHeaderNivel2("Eliminar Prevención", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
    <?php
          $idPlan = $_GET['idPlan'];
         
    ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Prevenciones"); ?>
		<div class="content">
			<p>Confirme la eliminacion del Plan: "
				<?php 				
				$result = $c_funciones->getInfoPrevencion($idPlan);					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<strong>'.$row[1] .'</strong>';
				}				
				?>	
				"
			<br />			



            <a href="#"  data-role="button" id="botonEliminar" data-theme="b">Eliminar Prevención</a></center> 
            

		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	      <script>
       $(document).ready(function(){
            
            $('#botonEliminar').click(function(){
                

swal({   title: "Confirmas que deseas eliminar  <?php 				
				$result = $c_funciones->getInfoPrevencion($idPlan);					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo $row[1];
				}				
				?> ?",   
	text: "Esta accion es irreversible, y provocará que toda la informacion relacionada tambien sea eliminada",   
	type: "warning",   
	showCancelButton: true,   
	confirmButtonColor: "#DD6B55",   
	confirmButtonText: "Sí, deseo eliminarla",   
	cancelButtonText: "No, cancelar",   
	closeOnConfirm: false,   
	closeOnCancel: false }, 

	function(isConfirm){   
		if (isConfirm) {     
			                $.ajax({
                  type: "POST",
                  url: "../funcionesAjax.php",
                  data: {nombreMetodo: "eliminarPlanPrevencion", AjxPlan: <?php echo $idPlan; ?>},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){

                  },
                  dataType: "html",
                  success: function(msg){
                    window.location.assign("../Eliminar/buscarPlanPrevencion.php")


                  }              


                });
			swal("Deleted!", "Prevención eliminada exitosamente.", "success");   
		} else {     
			swal("Cancelado", "La acción ha sido cancelada", "error");   
		} });



            });
                    
        });
    </script>
	</html>