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
<?php echo $c_funciones->getHeaderNivel2("Modificar País", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Paises"); ?>
		<div class="content">
			<p><strong>Seleccione el Pais que desea modificar </strong><br />	
			<div class="ui-body ui-body-a ui-corner-all">
			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">					
            <select name="selectPais" id="selectPais">   
            <option value="-2">Elegir un país</option>  
				<?php 				
				$result = $c_funciones->getListaPaises();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
				}					
				?>
            </select> 
            </div>	

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<label for="txtNombre" >Nombre País</label>
				<input type="text" name="txtNombre" id="txtNombre" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
			</div>    

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<label for="txtRegion" >Región a la que pertence actualmente</label>
				<input type="text" name="txtRegion" id="txtRegion" value="" disabled="true" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
			</div> 

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<center><label for="selectRegion">Seleccione nueva región a asignar</label></center>	
			</div> 

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
            <select name="selectRegion" id="selectRegion" >   
				<?php 				
				$result = $c_funciones->getListaRegiones();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
				}					
				?>             
            </select> 			           
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
		
				$("#selectPais").change(function(){
					CargarInfo();
				});

				function CargarInfo(){

					strpais = $("#selectPais option:selected").val();
					if(strpais==-2){

				
						swal("!","Debes elegir un país valido","warning");

					}
					else{

			                $.ajax({
			                  type: "POST",
			                  url: "../funcionesAjax.php",
			                  data: {nombreMetodo: "obtenerInfoPais", AjxPais: strpais},
			                  contentType: "application/x-www-form-urlencoded",
			                  beforeSend: function(){

			                  },
			                  dataType: "html",
			                  success: function(msg){
			                  	 var recoge=msg.split(",");

			                  	 $('#txtNombre').val(recoge[1]);
			                  	 $('#txtRegion').val(recoge[4]);
								 $("#selectRegion").val(recoge[3]);
								 $('#selectRegion').selectmenu('refresh');				 
			                  	
									
									  

			                  }              


			                });					
					}

				}


				$("#botonGuardar").click(function(){
					validar();
				});			


	           function validar(){
				      var nombre = $('#txtNombre').val();

		              if(nombre == ""){
		                swal("!","No debes dejar campos vacios","warning");          
		              }
		              else{



				              var idPais = $("#selectPais option:selected").val();
				              var idRegion = $('#selectRegion option:selected').val();
		                    $.ajax({
		                        type: "POST",
		                        url: "../funcionesAjax.php",
		                        data: {nombreMetodo: "modificarPais", AjxNombre:nombre, AjxPais:idPais, AjxRegion:idRegion},
		                        contentType: "application/x-www-form-urlencoded",
		                        beforeSend: function(){

		                        },
		                        dataType: "html",
		                        success: function(msg){
		                          swal(msg);


		                                    

		                      }              

		                    });

		               }    

	           }

		});		

</script>
	</html>