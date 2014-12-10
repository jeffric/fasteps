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
    <?php
          $idPais = $_GET['idPais'];
         
    ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPage("F.A.S.T. Punto Evaluación"); ?>
		<div class="content">
			<p><strong>Seleccione el Punto de Evaluación que desea eliminar del sistema</strong><br />	
            <select name="selectPtoEvaluacion" id="selectPtoEvaluacion">     
				<?php 				
				$result = $c_funciones->getListaPtosEvaluacion($idPais);					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
				}					
				?>
            </select> 		

            <div id="ajax_loader">
            <img id="loader_gif" src="css/images/ajax-loader.gif" style=" display:none;"/>
            </div>

            <a href="#"  data-role="button" id="botonEliminar" data-theme="b">Eliminar Punto de Evaluación</a></center> 
            

		</div>
			<?php echo $c_funciones->getMenu(); ?>
	</div>		
		<?php echo $c_funciones->getFooter(); ?>		
		<!-- FOOTER -->
	</body>
		<script>
       $(document).ready(function(){
            
            $('#botonEliminar').click(function(){
                

swal({   title: "Confirmas que deseas eliminar "+$('#selectPtoEvaluacion option:selected').text()+" ?",   
	text: "Esto provocará que la informacion relacionada tambien sea eliminada",   
	type: "warning",   
	showCancelButton: true,   
	confirmButtonColor: "#DD6B55",   
	confirmButtonText: "Sí, deseo eliminarlo",   
	cancelButtonText: "No, cancelar",   
	closeOnConfirm: false,   
	closeOnCancel: false }, 

	function(isConfirm){   
		if (isConfirm) {     
			      
			      $.ajax({
                  type: "POST",
                  url: "funcionesAjax.php",
                  data: {nombreMetodo: "eliminarPtoEvaluacion", ptoEvaluacion: $('#selectPtoEvaluacion').val()},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){
                    $('#loader_gif').fadeIn("slow");

                  },
                  dataType: "html",
                  success: function(msg){
                    $("#loader_gif").fadeOut("slow");
                    window.location.assign("buscarPtosEvaluacion.php")


                  }              


                });
			swal("Deleted!", "El pais se ha eliminado exitosamente.", "success");   
		} else {     
			swal("Cancelado", "La acción ha sido cancelada", "error");   
		} });



            });
                    
        });
    </script>
	</html>