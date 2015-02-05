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
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Amenazas"); ?>
		<div class="content">
			<p><strong>Seleccione la amenaza desea modificar </strong><br />	
			<div class="ui-body ui-body-a ui-corner-all">
			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">					
            <select name="selectAmenaza" id="selectAmenaza">   
            <option value="-2">Elegir una amenaza</option>  
				<?php 				
				$result = $c_funciones->getListaAmenazas();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
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
				<a href="#"  data-role="button" id="botonGuardar" data-theme="b">Guardar Cambios</a></center> 
			</div> 			

		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>

	<script type="text/javascript">

	$(function(){
		
				$("#selectAmenaza").change(function(){
					CargarInfo();
				});

				function CargarInfo(){

						strAmenaza = $("#selectAmenaza option:selected").val();
						if(strAmenaza==-2){
							swal("!","Debes elegir una amenaza válida","warning");
			                $('#txtNombre').val("");
			                $('#txtDescripcion').val("");
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
		              var nombre = $('#txtNombre').val();
		              var descripcion = $('#txtDescripcion').val();
		              var idAmenaza = $("#selectAmenaza option:selected").val();
		              if(nombre == ""){
		                swal("!","No debes dejar campos vacios","warning");          
		              }
		              else if(descripcion == ""){
						swal("!","No debes dejar campos vacios","warning");
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
		                                    

		                      }              

		                    });
		                }    

	           }

	});		

	</script>
	</html>