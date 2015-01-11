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
<?php echo $c_funciones->getHeaderNivel2("Desasignación de usuarios", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); ?>
<body>
	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Desasignación"); ?>
		<div class="content">
			<p><strong>DESASIGNAR USUARIO-PAIS</strong><br />
				<div class="ui-body ui-body-a ui-corner-all">
						<label for="txtusuario" >Usuario</label>
						<select name="lstUsuario" id="lstUsuario">
							<option value="-2">Elegir un usuario</option>
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
			            <div id="ajax_loader" align="center">
			            <img id="loader_gif" src="../css/images/ajax-loader.gif" style=" display:none;"/>
			            </div>				
						<div id="respuesta" data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							
						</div>	            
	
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<button id="botonDesasignar" data-theme="a" name="submit" value="submit-value" class="ui-btn-hidden" aria-disabled="false">Desasignar Usuario</button>
				</div>								
				</div>													
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>	
		</div>
		<?php echo $c_funciones->getFooterNivel2(); ?>		
	</body>

<script type="text/javascript">
       $(document).ready(function(){

            $('#lstUsuario').change(function(){

                $.ajax({
                  type: "POST",
                  url: "../funcionesAjax.php",
                  data: {nombreMetodo: "buscarPaisesAsignados", usuario:$('#lstUsuario option:selected').val() },
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){
                  $('#loader_gif').fadeIn("slow");

                  },
                  dataType: "html",
                  success: function(msg){
                    $("#loader_gif").fadeOut("slow");  
                    $("#respuesta").html(msg);	               

                  }              


                });



       	  });

            $('#botonDesasignar').click(function(){
			strUsr = $("#lstUsuario option:selected").val();
			if(strUsr==-2){
				swal("Debe elegir un usuario valido");

			}
			else{
				
                $.ajax({
                  type: "POST",
                  url: "../funcionesAjax.php",
                  data: {nombreMetodo: "desasignarUsuarioP", AjxPUser:$("#lstUsuario option:selected").val(), AjxPPais:$("#lstPais option:selected").val() },
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){

                  },
                  dataType: "html",
                  success: function(msg){

                  	if(msg=="eliminar"){
					swal({   title: "Eliminar Usuario?",   text: "Este Usuario será eliminado, debido a que éste es el único pais al que asignado",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Sí, eliminar!",   cancelButtonText: "No, cancelar!",   closeOnConfirm: false,   closeOnCancel: false }, 
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

								swal("Eliminado!", "El Usuario ha sido elminado.", "success");   
							} 
							else {     

								swal("Cancelado", "La acción ha sido cancelada", "error");   } });					
							}
					else{
						swal("Usuario Desasignado!", "La desasignación se realizó exitosamente!", "success");

					}        

                  }              


                });				

			}





       	  });            

            });

</script>
	</html>