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
<?php echo $c_funciones->getHeaderNivel2("Modificar Prevencion", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Prevenciones"); ?>
		<div class="content">
			<p><strong>Seleccione el plan de prevención a modificar </strong><br />	
			<div class="ui-body ui-body-a ui-corner-all">
			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">					
            <select name="selectPrevencion" id="selectPrevencion">   
            <option value="-2">Elegir un plan de prevención</option>  
				<?php 				
				$result = $c_funciones->getListaPrevenciones();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
				}					
				?>
            </select> 
            </div>	

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<label for="txtNombre" >Nombre Plan Prevención</label>
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
		
		$("#selectPrevencion").change(function(){
			CargarInfo();
		});

		function CargarInfo(){

			strPrevencion = $("#selectPrevencion option:selected").val();
			if(strPrevencion==-2){
				swal("!","Debes elegir un plan de prevención válido","warning");

                  	 $('#txtNombre').val("");
                  	 $('#txtDescripcion').val("");

			}
			else
			{

                $.ajax({
                  type: "POST",
                  url: "../funcionesAjax.php",
                  data: {nombreMetodo: "obtenerInfoPrevencion", AjxPrevencion: strPrevencion},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){

                  },
                  dataType: "html",
                  success: function(msg){
                  	 var recoge=msg.split(",");

                  	 $('#txtNombre').val(recoge[1]);
                  	 $('#txtDescripcion').val(recoge[2]);

                  	
						
						  

                  }              


                });					
			}

		}

				$("#botonGuardar").click(function(){
					validar();
				});


	           function validar(){
		              var nombre = $('#txtNombre').val();
		              var descripcion = $("#txtDescripcion").val();	
		              var idPlan = $('#selectPrevencion option:selected').val();

		              if(nombre == ""){
		                swal("!","No debes dejar campos vacios","warning");          
		              }
		              else{
		                    $.ajax({
		                        type: "POST",
		                        url: "../funcionesAjax.php",
		                        data: {nombreMetodo: "modificarPlanPrevencion", AjxNombre:nombre, AjxDescripcion: descripcion, AjxPlan:idPlan},
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