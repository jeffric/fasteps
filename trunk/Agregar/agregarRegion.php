<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Agregar Region", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Regiones"); ?>
		<div class="content">
			<p><strong>Ingrese la información requerida:</strong><br />	

            <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
            <label for="name">Nombre de Región:</label>
            <input type="text" name="nameNombreRegion" id="textNombreRegion"  style="text-align:center; font-weight:Bold; color:black; font-size:20;"> 
            </div>

            <div id="ajax_loader" align="center">
            <img id="loader_gif" src="../css/images/ajax-loader.gif" style=" display:none;"/>
            </div>			


			       <a href="#"  data-role="button" data-theme="b" id="botonAgregar" >Agregar Región</a>
                

		</div>
			<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
	</div>		
		<?php echo $c_funciones->getFooterNivel2(); ?>		
		<!-- FOOTER -->
	</body>
	<script>
       $(document).ready(function(){

            $('#botonAgregar').click(function(){

                $.ajax({
                  type: "POST",
                  url: "../funcionesAjax.php",
                  data: {nombreMetodo: "agregarRegion", region:$('#textNombreRegion').val()},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){
                  $('#loader_gif').fadeIn("slow");

                  },
                  dataType: "html",
                  success: function(msg){
                  	swal(msg);
                    $('#textNombreRegion').val('');  
                    $("#loader_gif").fadeOut("slow");                 

                  }              


                });



       	  });

            });
     </script>	
	</html>