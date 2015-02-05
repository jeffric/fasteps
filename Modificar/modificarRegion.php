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
<?php echo $c_funciones->getHeaderNivel2("Modificar Región", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Regiones"); ?>
		<div class="content">
			<p><strong>Seleccione la Región que desea modificar</strong><br />	

			<div class="ui-body ui-body-a ui-corner-all">
			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">						
            <select name="selectRegion" id="selectRegion">
            <option value="-2">Elegir una región</option>                   
				<?php 				
				$result = $c_funciones->getListaRegiones();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
				}					
				?>
            </select> 

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<label for="txtRegion" >Nombre Región</label>
				<input type="text" name="txtRegion" id="txtRegion" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
			</div>   

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<a href="#"  data-role="button" id="botonGuardar" data-theme="b">Guardar Cambios</a></center> 
			</div> 					

        </div>



            

            <div id="ajax_loader">
            <img id="loader_gif" src="../css/images/ajax-loader.gif" style=" display:none;"/>
            </div>		
		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	
	<script type="text/javascript">
		$(function(){
		
		$("#selectRegion").change(function(){
			CargarInfo();
		});

		function CargarInfo(){

			strRegion = $("#selectRegion option:selected").val();
			if(strRegion==-2){
				swal("!","Debes elegir una región válida","warning");

			}
			else{

                $.ajax({
                  type: "POST",
                  url: "../funcionesAjax.php",
                  data: {nombreMetodo: "obtenerInfoRegion", AjxRegion: strRegion},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){

                  },
                  dataType: "html",
                  success: function(msg){
                  	 var recoge=msg.split(",");

					 $('#txtRegion').val(recoge[1]);                  	
						
						  

                  }              


                });	


			}


		}

				$("#botonGuardar").click(function(){
					validar();
				});

	           function validar(){
		              var nombre = $('#txtRegion').val();
		              var idRegion = $("#selectRegion option:selected").val();

		              if(nombre == ""){
		                swal("!","No debes dejar campos vacios","warning");          
		              }
		              else{
		                    $.ajax({
		                        type: "POST",
		                        url: "../funcionesAjax.php",
		                        data: {nombreMetodo: "modificarRegion", AjxNombre:nombre, AjxRegion: idRegion},
		                        contentType: "application/x-www-form-urlencoded",
		                        beforeSend: function(){
		                        $('#loader_gif').fadeIn("slow");

		                        },
		                        dataType: "html",
		                        success: function(msg){
		                          swal(msg);
		                          $('#txtRegion').val('');  
		                          $("#loader_gif").fadeOut("slow");  
		                                    

		                      }              

		                    });
		                }    

	           }						

		});	
	</script>	
	</html>