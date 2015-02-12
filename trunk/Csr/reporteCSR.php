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

if ($_SERVER["REQUEST_METHOD"] == "POST") {	

	$arrSelect= $_POST['select'];	
	$_SESSION["arrSelect"] =$arrSelect;
	$idNivelRiesgo =$_SESSION["idNivelRiesgo"];

	}
	else{
			header("Location: ../Csr/buscarEvento.php");
			return;

	}

//$idUsuario = $c_funciones->getIdUsuario($strUsuario);

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$idUsuario = $_SESSION["idUsuario"];
	$idPais = $_POST["lstPais"];
	$idPuntoEvaluacion = $_POST["lstPuntoEvaluacion"];
	$FechaElaboracion = $_POST["txtFecha"];
	$strElaboradoPor = $_POST["txtCreador"];

	$idEvaluacion = $c_funciones->CrearEvaluacionSra($idUsuario, $FechaElaboracion, $strElaboradoPor, $idPuntoEvaluacion);	
	$_SESSION["idEvalSraActual"] = $idEvaluacion;
}*/



?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Evaluacion CSR", 
	'<style>
  .panel-content {
    padding: 1em;
  }
  </style>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<style>

	/* Add alternating row stripes */
	.table-stripe tbody tr:nth-child(odd) td,
	.table-stripe tbody tr:nth-child(odd) th {
		background-color: rgba(0,0,0,0.04);
	}

	/* These apply across all breakpoints because they are outside of a media query */
	/* Make the labels light gray all caps across the board */
	.movie-list thead th,
	.movie-list tbody th .ui-table-cell-label,
	.movie-list tbody td .ui-table-cell-label {
		text-transform: uppercase;
		
		color: rgba(0,0,0,0.5);
		font-weight: bold;
	}
	/* White bg, large blue text for rank and title */
	.movie-list tbody th {
		font-size: 1.2em;
		background-color: #fff;
		color: #77bbff;
		text-align: center;
	}
	/*  Add a bit of extra left padding for the title */
	.movie-list tbody td.title {
		padding-left: .8em;
	}
	/* Add strokes */
	.movie-list thead th {
		border-bottom: 1px solid #d6d6d6; /* non-RGBA fallback */
		border-bottom: 1px solid rgba(0,0,0,.1);
	}
	.movie-list tbody th,
	.movie-list tbody td {
		border-bottom: 1px solid #e6e6e6; /* non-RGBA fallback  */
		border-bottom: 1px solid rgba(0,0,0,.05);
	}
	/*  Custom stacked styles for mobile sizes */
	/*  Use a max-width media query so we dont have to undo these styles */
	@media (max-width: 40em) {
		/*  Negate the margin between sections */
		.movie-list tbody th {
			margin-top: 0;
			text-align: left;
		}
		/*  White bg, large blue text for rank and title */
		.movie-list tbody th,
		.movie-list tbody td.title {
			display: block;
			font-size: 1.2em;
			line-height: 110%;
			padding: .5em .5em;
			background-color: #fff;
			color: #77bbff;
			-moz-box-shadow: 0 1px 6px rgba(0,0,0,.1);
			-webkit-box-shadow: 0 1px 6px rgba(0,0,0,.1);
			box-shadow: 0 1px 6px rgba(0,0,0,.1);
		}
		/*  Hide labels for rank and title */
		.movie-list tbody th .ui-table-cell-label,
		.movie-list tbody td.title .ui-table-cell-label {
			display: none;
		}
		/*  Position the title next to the rank, pad to the left */
		.movie-list tbody td.title {
			margin-top: -2.1em;
			padding-left: 2.2em;
			border-bottom: 1px solid rgba(0,0,0,.15);
		}
		/*  Make the data bold */
		.movie-list th,
		.movie-list td {
			font-weight: bold;
		}
		/* Make the label elements a percentage width */
		.movie-list td .ui-table-cell-label,
		.movie-list th .ui-table-cell-label {
			min-width: 20%;
		}
	}
	/* Media query to show as a standard table at wider widths */
	@media ( min-width: 40em ) {
		/* Show the table header rows */
		.movie-list td,
		.movie-list th,
		.movie-list tbody th,
		.movie-list tbody td,
		.movie-list thead td,
		.movie-list thead th {
			display: table-cell;
			margin: 0;
		}
		/* Hide the labels in each cell */
		.movie-list td .ui-table-cell-label,
		.movie-list th .ui-table-cell-label {
			display: none;
		}
	}
	/* Hack to make IE9 and WP7.5 treat cells like block level elements */
	/* Applied in a max-width media query up to the table layout breakpoint so we dont need to negate this */
	@media ( max-width: 40em ) {
		.movie-list td,
		.movie-list th {
			width: 100%;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			float: left;
			clear: left;
		}
	}
</style>


'); ?>
<body>
<div data-role="page" id="page" >
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. CSR"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong>REPORTE CSR</strong><br />
				<p align="center"><?php 
					if($idNivelRiesgo==1){
						echo "Nivel de riesgo: Insignificante";

					}
					else if($idNivelRiesgo==2){
						echo "Nivel de Riesgo: Bajo";

					}
					else if($idNivelRiesgo==3){
						echo "Nivel de Riesgo: Medio";

					}
					else if($idNivelRiesgo==4){
						echo "Nivel de Riesgo: Alto";

					}



				?></p>
			<div class="ui-body ui-body-a ui-corner-all">
<?php

		$contadorNoAplicable=0;
		$contadorNoIniciado=0;
		$contadorIniciado=0;
		$contadorCompletado=0;

		$cadenaNoAplicable="";
		$cadenaNoIniciado="";
		$cadenaIniciado="";
		$cadenaCompletado="";

	if(($arrSelect)){
						if(!empty($arrSelect)) {
$contador=0;
								foreach($arrSelect as $option){
										if($option == '1'){
											$contadorNoAplicable = $contadorNoAplicable+1;
											$cadenaNoAplicable=$cadenaNoAplicable."
											<br>".$_POST['requerimientos'.$contador];
										}
										else if($option == '2'){
											$contadorNoIniciado = $contadorNoIniciado+1;
											$cadenaNoIniciado=$cadenaNoIniciado."
											<br>".$_POST['requerimientos'.$contador];											
										}
										else if($option == '3'){
											$contadorIniciado = $contadorIniciado+1;
											$cadenaIniciado=$cadenaIniciado."
											<br>".$_POST['requerimientos'.$contador];											
										}
										else{
											$contadorCompletado = $contadorCompletado+1;
											$cadenaCompletado=$cadenaCompletado."
											<br>".$_POST['requerimientos'.$contador];											
										}

										$contador=$contador+1;

								}

									$contadorNoAplicable = ($contadorNoAplicable/57)*100;
									$contadorNoIniciado = ($contadorNoIniciado/57)*100;
									$contadorIniciado = ($contadorIniciado/57)*100;
									$contadorCompletado = ($contadorCompletado/57)*100;

									$NA = number_format($contadorNoAplicable, 2, '.', '');
									$NOIN = number_format($contadorNoIniciado, 2, '.', '');
									$IN = number_format($contadorIniciado, 2, '.', '');
									$COM = number_format($contadorCompletado, 2, '.', '');	

									echo "<table data-role='table'id='movie-table-custom' data-mode='reflow' class='movie-list table-stripe'>";
								    echo "<thead>";
								    echo "		<tr>";
								    echo "            <th>% No APlica</th>";
								    echo "            <th>% No Iniciados</th>";
								    echo "            	<th>% Iniciados</th>";
								    echo "            <th>% Completados</th>";
								    echo "            <th>% Cumplimiento</th>";
								    echo "        </tr>";
								    echo "    </thead>";

									echo "<tbody>";
									echo "<tr>";

									echo "<td>";
									echo $NA."%";
									echo "<br>";
									echo "</td>";

									echo "<td>";
									echo $NOIN."%";
									echo "<br>";
									echo "</td>";

									echo "<td>";
									echo $IN."%";
									echo "<br>";
									echo "</td>";

									echo "<td>"; 
									echo $COM."%";
									echo "<br>";
									echo "</td>";

									echo "<td>"; 
									if($contadorCompletado ==0){

										echo "0";

									}
									else{
									echo number_format((($contadorCompletado/($contadorIniciado+$contadorNoIniciado+$contadorCompletado))*100), 2, '.', '')."%";

									}
									echo "<br>";
									echo "</td>";	
									
									echo "</tr>";

									echo "<tr>";
									echo "<td>";
									echo $cadenaNoAplicable;
									echo "</td>";

									echo "<td>";
									echo $cadenaNoIniciado;
									echo "</td>";

									echo "<td>";
									echo $cadenaIniciado;
									echo "</td>";	

									echo "<td>";
									echo $cadenaCompletado;
									echo "</td>";																										
									echo "</tr>";

									echo "</tbody>";


									echo "</table>";																	

						}
	}



?>
	</div>
	</div>	
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>	
		<?php echo $c_funciones->getFooterNivel2(); ?>	
</div>		
				
</body>
	<script type="text/javascript">

       $(document).ready(function(){




        });       	


	</script>
	</html>