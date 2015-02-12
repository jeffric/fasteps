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
		$idUsuario = $c_funciones->getIdUsuario($strUsuario);

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Desasignación de usuarios", 
	'  <style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Desasignación"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong>DESASIGNAR USUARIO-PAIS</strong><br />
				<div class="ui-body ui-body-a ui-corner-all">
						<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
							<label for="lstUsuario" >Usuario: </label>
						<select name="lstUsuario" id="lstUsuario">
							<option value="-2">Elegir un usuario</option>
<?php 	
							if($strTipoUsuario==1){			
							$result = $c_funciones->getListaUsuarios($idUsuario);					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'
								<option value="'. $row[0] . '">' . $row[1] . '</option>';
								}
							}
							else{
							$result = $c_funciones->getListaUsuarios2($idUsuario);					
							while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
								echo'
								<option value="'. $row[0] . '" >' . $row[1] . '</option>';
								}						
							}
?>
						
						</select>
						</div>
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
		<?php echo $c_funciones->getFooterNivel2(); ?>		

	</div>

	<div id="pageWarning" data-role="dialog" data-theme="b" >
	    <header data-role="header">
	        <h1>Mensaje</h1>
	            <article data-role="content">
	            <p id="mensajeExito" align="center">Debes elegir un usuario válido</p>
				<center><img src="../img/admiracion.png" style="width:40%; height:40%; margin-top:1px;" />
				<br>
	            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
	            </center>
	           </article>
	</div>	

	<div id="pagePregunta" data-role="dialog" data-theme="b" >
	    <header data-role="header">
	        <h1>Mensaje</h1>
	            <article data-role="content">
	            <p id="mensajePregunta" align="center">Eliminar Usuario? Este usuario será eliminado debido a que éste es el unico país al que se encuentra asignado.</p>
				<center>
				<img src="../img/interrogacion.png" style="width:40%; height:40%; margin-top:1px;" />
				<br>
	            <a href="#" data-role="button" id="botonConfirmar" data-rel="back">Confirmar</a>
	            <a href="#" data-role="button" id="botonCancelar" data-rel="back">Cancelar</a>
	            </center>
	           </article>
	</div>	

	<div id="pageEliminado" data-role="dialog" data-theme="b" >
	    <header data-role="header">
	        <h1>Mensaje</h1>
	            <article data-role="content">
	            <p id="mensajeEliminado" align="center">El usuario fue eliminado exitosamente</p>
				<center><img src="../img/success.png" style="width:40%; height:40%; margin-top:1px;" /></center>
	            <a href="../Usuarios/desasignarUsuarioP.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
	           </article>
	</div>	

	<div id="pageExito" data-role="dialog" data-theme="b" >
	    <header data-role="header">
	        <h1>Mensaje</h1>
	            <article data-role="content">
	            <p id="mensajeExito" align="center">La desasignacion se realizó exitosamente</p>
				<center><img src="../img/success.png" style="width:40%; height:40%; margin-top:1px;" /></center>
	            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
	           </article>
	</div>		

	<div id="pageCancelado" data-role="dialog" data-theme="b" >
	    <header data-role="header">
	        <h1>Mensaje</h1>
	            <article data-role="content">
	            <p id="mensajeExito" align="center">La acción ha sido Cancelada</p>
				<center>
				<img src="../img/error.png" style="width:40%; height:40%; margin-top:1px;" />
				<br>
	            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
	            </center>
	           </article>
	</div>	

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
						
						$.mobile.changePage('#pageWarning', 'pop', true, true);
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

											$.mobile.changePage('#pagePregunta', 'pop', true, true);																
		                				}
		                				else{

		                					$.mobile.changePage('#pageExito', 'pop', true, true);
		                				}
			                	}              
		                	});				
					}
       	  });     
			$("#botonConfirmar").click(function(){

				$.ajax({

						type: "POST",
						url: "../funcionesAjax.php",
						data: {nombreMetodo: "eliminarUsuario", AjxPUser:$("#lstUsuario option:selected").val() },
						contentType: "application/x-www-form-urlencoded",
						beforeSend: function(){
	
	                   },
	                    dataType: "html",
	                    success: function(msg){     
						$.mobile.changePage('#pageEliminado', 'pop', true, true);
						return false;		                             
                       } 									
	
	     		});							
			});
			$("#botonCancelar").click(function(){
								
				$.mobile.changePage('#pageCancelado', 'pop', true, true);
				return false;
			});	       	         
    });

</script>
	</html>