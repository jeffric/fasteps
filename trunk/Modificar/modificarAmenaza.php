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
<?php echo $c_funciones->getHeaderNivel2("Modificar Amenaza", 
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Amenazas"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong>Seleccione la amenaza desea modificar </strong><br />	
			<div class="ui-body ui-body-a ui-corner-all">
			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">					
	            <select name="selectAmenaza" id="selectAmenaza">   
	            <option value="-2">Elegir una amenaza</option>  
<?php 				
					$result = $c_funciones->getListaAmenazas();					
					while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
					echo'
					<option value="'. $row[0] . '">' . $row[1] . '</option>';
					}					
?>
	            

	            </select> 
            </div>	

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<label for="txtNombre" >Nombre Amenaza</label>
				<input type="text" name="txtNombre" id="txtNombre" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
			</div>    

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<label for="txtDescripcion" >Descripción</label>
				<input type="text" name="txtDescripcion" id="txtDescripcion" value=""  class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
			</div> 

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<a href="#"  data-role="button" id="botonGuardar" >Guardar Cambios</a>
			</div> 			

		</div>
	</div>	
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
		<?php echo $c_funciones->getFooterNivel2(); ?>				
</div>	

<div id="pageMensaje" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensaje" align="center"></p>
      <center><img src="../img/mensaje.png" style="width:55%; height:55%; margin-top:1px;" /> 
      <br>           
            <a href="../Modificar/modificarRegion.php" data-role="button" id="btn" data-ajax="false">Aceptar</a>
            </center>
           </article>
</div>

<div id="pageWarning" data-role="dialog" data-theme="b" >
    <header data-role="header">
        <h1>Mensaje</h1>
            <article data-role="content">
            <p id="mensajeWarning" align="center"></p>
      <center><img src="../img/admiracion.png" style="width:40%; height:40%; margin-top:1px;" />
      <br>
            <a href="#" data-role="button" id="btn" data-rel="back">Aceptar</a>
            </center>
           </article>
</div>

</body>
<script type="text/javascript">

	$(function(){
		
				$("#selectAmenaza").change(function(){
					CargarInfo();
				});

				function CargarInfo(){

						strAmenaza = $("#selectAmenaza option:selected").val();
						if(strAmenaza==-2){
				                $('#txtNombre').val("");
				                $('#txtDescripcion').val("");
			                  $("#mensajeWarning").text("Debes elegir una amenaza válida");    
			                  $.mobile.changePage('#pageWarning', 'pop', true, true);
			                  return false;  							

						}
						else
						{
			                $.ajax({
					                  type: "POST",
					                  url: "../funcionesAjax.php",
					                  data: {nombreMetodo: "obtenerInfoAmenaza", AjxAmenaza: strAmenaza},
					                  contentType: "application/x-www-form-urlencoded",
					                  beforeSend: function(){

					                  },
					                  dataType: "html",
					                  success: function(msg){
					                  	 var variables=msg.split(",");

					                  	 $('#txtNombre').val(variables[1]);
					                  	 $('#txtDescripcion').val(variables[2]);				  

					                  }              
			                });					
						}

				}

				$("#botonGuardar").click(function(){
					validar();
				});

	           function validar(){
		              var nombre = $('#txtNombre').val().trim();
		              var descripcion = $('#txtDescripcion').val().trim();
		              var idAmenaza = $("#selectAmenaza option:selected").val().trim();
						strAmenaza = $("#selectAmenaza option:selected").val();
						if(strAmenaza==-2){
				              $('#txtNombre').val("");
				              $('#txtDescripcion').val("");
			                  $("#mensajeWarning").text("Debes elegir una amenaza válida");    
			                  $.mobile.changePage('#pageWarning', 'pop', true, true);
			                  return false;  							

						}
		              else if(nombre == ""){
 
		                  $("#mensajeWarning").text("No debes dejar campos vacios");    
		                  $.mobile.changePage('#pageWarning', 'pop', true, true);
		                  return false;  		                       
		              }
		              else if(descripcion == ""){

		                  $("#mensajeWarning").text("No debes dejar campos vacios");    
		                  $.mobile.changePage('#pageWarning', 'pop', true, true);
		                  return false;  						
		              }
		              else{
		                    $.ajax({
		                        type: "POST",
		                        url: "../funcionesAjax.php",
		                        data: {nombreMetodo: "modificarAmenaza", AjxNombre:nombre, AjxDescripcion: descripcion, AjxAmenaza: idAmenaza },
		                        contentType: "application/x-www-form-urlencoded",
		                        beforeSend: function(){
		                        $('#loader_gif').fadeIn("slow");

		                        },
		                        dataType: "html",
		                        success: function(msg){
		                          swal(msg);
		                          $('#txtNombre').val('');  
		                          $('#txtDescripcion').val('');  
		                          $("#loader_gif").fadeOut("slow");

				                  $("#mensaje").text(msg);    
				                  $.mobile.changePage('#pageMensaje', 'pop', true, true);
				                  return false;		                                    

		                      }              

		                    });
		                }    

	           }

	});		

	</script>
	</html>