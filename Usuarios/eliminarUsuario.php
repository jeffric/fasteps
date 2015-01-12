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
<?php echo $c_funciones->getHeaderNivel2("Eliminación de usuarios", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); ?>
<body>
	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Eliminación"); ?>
		<div class="content">
			<p><strong>ELIMINACIÓN DE USUARIO</strong><br />
				<div class="ui-body ui-body-a ui-corner-all">
						<label for="txtusuario" >Usuario</label>
						<select name="lstUsuario" id="lstUsuario">
							<option value="-2">Elejir un usuario</option>
							<?php 	
							if($strTipoUsuario==1){			
							$result = $c_funciones->getListaUsuarios($idUsuario);					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
								}
							}
							else{
							$result = $c_funciones->getListaUsuarios2($idUsuario);					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'<option value="'. $row[0] . '" >' . $row[1] . '</option>';
								}						
							}
							?>
						</select>
	
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<button id="botonEliminar" data-theme="a" name="submit" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Eliminar Usuario</button>
				</div>								
				</div>					
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>	
		</div>
		<?php echo $c_funciones->getFooterNivel2(); ?>				
	</body>
		<script>
       $(document).ready(function(){

            $('#botonEliminar').click(function(){

            	strUsr = $("#lstUsuario option:selected").val();
				if(strUsr==-2){
				swal("Debe elegir un usuario valido");

				}else{

				swal({   title: "Eliminar Usuario?",   text: "Este Usuario será eliminado, toda información relacionada a el, tambien será eliminada del sistema",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Sí, eliminar!",   cancelButtonText: "No, cancelar!",   closeOnConfirm: false,   closeOnCancel: false }, 
				function(isConfirm){   
					if (isConfirm) {     

						      $.ajax({
			                  type: "POST",
			                  url: "../funcionesAjax.php",
			                  data: {nombreMetodo: "eliminarUsuario", AjxPUser:$("#lstUsuario option:selected").val() },
			                  contentType: "application/x-www-form-urlencoded",
			                  beforeSend: function(){

			                  },
			                  dataType: "html",
			                  success: function(msg){			                  		                                

			                  }              


			                });

						swal("Eliminado!", "El usuario ha sido elminado exitosamente", "success");  

					} 
					else{     swal("Cancelado", "La acción ha sido cancelada", "error");   

					} });					




            }

       	  });

            });
     </script>
	</html>