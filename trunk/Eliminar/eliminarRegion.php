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
<?php echo $c_funciones->getHeaderNivel2("Eliminar Reegión", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Regiones"); ?>
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

            <div id="ajax_loader">
            <img id="loader_gif" src="../css/images/ajax-loader.gif" style=" display:none;"/>
            </div>
            <a href="#"  data-role="button" id="botonEliminar" data-theme="b">Eliminar Region</a></center> 
            

		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	      <script>
       $(document).ready(function(){
            
            $('#botonEliminar').click(function(){
                

swal({   title: "Confirmas que deseas eliminar "+$('#selectRegion option:selected').text()+" ?",   
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
                  data: {nombreMetodo: "eliminarRegion", region: $('#selectRegion').val()},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){
                    $('#loader_gif').fadeIn("slow");

                  },
                  dataType: "html",
                  success: function(msg){
                    $("#loader_gif").fadeOut("slow");
                    window.location.assign("eliminarRegion.php")


                  }              


                });
			swal("Deleted!", "La region se ha eliminado exitosamente.", "success");   
		} else {     
			swal("Cancelado", "La acción ha sido cancelada", "error");   
		} });



            });
                    
        });
    </script>
	</html>