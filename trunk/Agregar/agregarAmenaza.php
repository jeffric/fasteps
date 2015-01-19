<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  $strUsuario = $_POST["username"];
  $strPassword = $_POST["password"];
  $strTipoUsuario = $_POST["slcTipoUsuarios"];
  
  if($c_funciones->ValidarLogin($strUsuario, $strPassword, $strTipoUsuario)){
    //el id se setea en la consulta de la validacion del login
    $_SESSION["Usuario"] = $strUsuario;
    $_SESSION["TipoUsuario"] = $strTipoUsuario;   
  }else{    
    header("Location: ../index.php?errLog=true");
  }
}else{  
  if(!isset($_SESSION["idUsuario"])){
    if($_SESSION["idUsuario"] == ""){
      header("Location: ../index.php?errLog=true02");
      return;
    }
  }
}

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Agregar Amenaza", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
</script> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Amenazas"); ?>
		<div class="content">
			<p><strong>Ingrese la informacion requerida:</strong><br />	
			
      <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
			<label >Nombre de la Amenaza:</label> 
      <input type="text"  id="textNombreAmenaza"  style="text-align:center; font-weight:Bold; color:black; font-size:20;">         
	    </div>

      <div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
			<label >Descripción de la Amenaza:</label> 
      <input type="text"  id="textDescripcion"  style="text-align:center; font-weight:Bold; color:black; font-size:20;">         
	    </div>

            <div id="ajax_loader" align="center">
            <img id="loader_gif" src="../css/images/ajax-loader.gif" style=" display:none;"/>
            </div>

            <a href=""  data-role="button" id="botonAgregar" data-theme="b">Agregar Amenaza</a></center> 

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
                  data: {nombreMetodo: "agregarAmenaza", amenaza:$('#textNombreAmenaza').val(), descripcion:$('#textDescripcion').val()},
                  contentType: "application/x-www-form-urlencoded",
                  beforeSend: function(){
                  $('#loader_gif').fadeIn("slow");

                  },
                  dataType: "html",
                  success: function(msg){
                  	swal(msg);
                    $('#textNombreAmenaza').val('');  
                    $('#textDescripcion').val('');
                    $("#loader_gif").fadeOut("slow");                 

                  }              


                });



       	  });

            });
     </script>
	</html>