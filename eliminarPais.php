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
		<?php $c_funciones->getHeaderPage("F.A.S.T. Paises"); ?>
		<div class="content">
			<p><strong>Seleccione el Pais que desea eliminar del sistema</strong><br />			
            <select name="selectPais" id="selectPais">     
				<?php 				
				$result = $c_funciones->getListaPaises();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
				}					
				?>
            </select> 

            <div id="ajax_loader">
            <img id="loader_gif" src="css/images/ajax-loader.gif" style=" display:none;"/>
            </div>

            <a href="#"  data-role="button" id="botonEliminar" data-theme="b">Eliminar Pais</a></center> 
            

		</div>
			<?php echo $c_funciones->getMenu(); ?>
	</div>		
		<?php echo $c_funciones->getFooter(); ?>		
		<!-- FOOTER -->
	</body>
	<script>
       $(document).ready(function(){
            
            $('#botonEliminar').click(function(){
                

swal({   title: "Confirmas que deseas eliminar "+$('#selectPais option:selected').text()+" ?",   
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
                  data: {nombreMetodo: "eliminarPais", pais: $('#selectPais').val()},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){
                    $('#loader_gif').fadeIn("slow");

                  },
                  dataType: "html",
                  success: function(msg){
                    $("#loader_gif").fadeOut("slow");
                    window.location.assign("eliminarPais.php")


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