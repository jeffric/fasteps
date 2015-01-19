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
<?php echo $c_funciones->getHeaderNivel2("Agregar Pais", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script>'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Paises"); ?>
		<div class="content">
			<p><strong>Ingrese la informacion requerida:</strong><br />	
			
      <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
			<label >Nombre de País:</label> 
      <input type="text" name="namelatitud" id="textNombrePais"  style="text-align:center; font-weight:Bold; color:black; font-size:20;"> 
			</div>

      <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
      <label>Elige la Región a la que pertenecerá el nuevo País:</label>	            

            <select name="selectRegion" id="selectRegion" >   
				<?php 				
				$result = $c_funciones->getListaRegiones();					
				while ($row = mysqli_fetch_array($result, MYSQL_NUM)){
				echo'<option value="'. $row[0] . '">' . $row[1] . '</option>';
				}					
				?>             
            </select> 
        </div>	

            <div id="ajax_loader" align="center">
            <img id="loader_gif" src="../css/images/ajax-loader.gif" style=" display:none;"/>
            </div>

            <a href=""  data-role="button" id="botonAgregar" data-theme="b">Agregar País</a></center> 

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
                            data: {nombreMetodo: "agregarPais", pais:$('#textNombrePais').val(), region:$('#selectRegion option:selected').val() },
                            contentType: "application/x-www-form-urlencoded",
                            beforeSend: function(){
                                $('#loader_gif').fadeIn("slow");

                            },
                            dataType: "html",
                            success: function(msg){
                              	swal(msg);
                                $('#textNombrePais').val('');  
                                $("#loader_gif").fadeOut("slow");                 

                            }              
                      });

       	  });

        });
     </script>
	</html>