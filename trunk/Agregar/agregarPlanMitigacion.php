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
<?php echo $c_funciones->getHeaderNivel2("Agregar Mitigación", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Mitigaciones"); ?>
		<div class="content">
			<p><strong>Ingrese la información solicitada  </strong><br />	
			<div class="ui-body ui-body-a ui-corner-all">

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<label for="txtNombre" >Nombre Plan Mitigación</label>
				<input type="text" name="txtNombre" id="txtNombre" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
			</div>    

			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<label for="txtDescripcion" >Descripción</label>
				<input type="text" name="txtDescripcion" id="txtDescripcion" value=""  class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
			</div> 


			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<a href="#"  data-role="button" id="botonAgregar" data-theme="b">Agregar Plan de Mitigación</a></center> 
			</div> 			

		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>

	<script type="text/javascript">

       $(function(){

				$("#botonAgregar").click(function(){
					validar();
				});

				function validar(){
					var nombre = $('#txtNombre').val();
					var descripcion = $('#txtDescripcion').val();

					if(nombre == ""){
						swal("","No debes dejar campos vacios","warning");					
					}
					else if(descripcion == ""){
						swal("","No debes dejar campos vacios","warning");					
					}
					else{

                      $.ajax({
                        type: "POST",
                        url: "../funcionesAjax.php",
                        data: {nombreMetodo: "agregarPlanMitigacion", AjxNombre: nombre, AjxDescripcion: descripcion},
                        contentType: "application/x-www-form-urlencoded",
                        beforeSend: function(){
                        $('#loader_gif').fadeIn("slow");

                        },
                        dataType: "html",
                        success: function(msg){
                          $("#loader_gif").fadeOut("slow");         
                          swal(msg);                     
                          $('#txtNombre').val(''); 
                          $('#txtDescripcion').val('');            

                        }              


                      });						
					}

				}


        });

	</script>
	</html>