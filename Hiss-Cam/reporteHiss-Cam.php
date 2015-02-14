<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

		if($_SESSION["Usuario"] == ""){
			header("Location: ../index.php");
			return;
		}

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("SRA - Inicio", 
	'<script type="text/javascript">
	$(function() {
		////$("nav#menu").mmenu();
	});
$(document).bind("mobileinit", function () {

	$.mobile.ajaxEnabled = false;

});

</script>
<link src="../css/jquery-ui.structure.css" rel="stylesheet">	
<link src="../css/jquery-ui.css" rel="stylesheet">	
<link src="../css/jquery-ui.theme.css" rel="stylesheet">	
<script src="../css/jquery-ui.js"></script>
<script src="jquery.PrintArea.js"></script>

<script>
	$( document ).bind( "mobileinit", function() {
		$.mobile.hashListeningEnabled = false;
		$.mobile.pushStateEnabled = false;
		$.mobile.changePage.defaults.changeHash = false;
	});
</script>

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



	.cabeceraNormal{
		color: black;
		font-weight: bold;
		background-color: #e3e3e3;
	}
	.subCabecera{
		color: black;
		font-weight: bold;
		background-color: #ffffff;
		text-indent: 50px;
		font-style: italic;
	}
	.negrita{
		font-weight: bold;		
	}

	tr {
    border-bottom: 1px solid #d6d6d6;
}
tr:nth-child(even) {
    background: #e9e9e9;
}
</style>

'); ?>
<body>

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. HISS-CAM"); ?>
		<div class="content" id="Reporte">
		<div style="text-align: center;">
			<h1 style="font-size: 4em; color: #4C4C4C;" >Evaluación Hiss-Cam</h1>
		</div>
			<table id="tablaGeneral"  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
				<thead></thead>
				<tbody>
					<!-- encabezado de la evaluacion -->
					<tr>
						<table data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
							<thead></thead>
							<tbody>
								<tr>
									<th class="cabeceraNormal">Nombre y Departamento</th>
									<td>
										<textarea rows="4" cols="30" id="txtNombreYDepto" value="" name="txtNombreYDepto"></textarea>
									</td>
								</tr>
								<tr>
									<th class="cabeceraNormal">Fecha del reporte</th>
									<td>
										<input type="date" name="txtFechaCreacion" id="txtFechaCreacion" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset"/>
									</td>
								</tr>
								<tr>
									<th class="cabeceraNormal">Tema</th>
									<td>
										<textarea rows="4" cols="30" id="txtTema" class="negrita" value="" name="txtNombreYDepto"></textarea>							
									</td>
								</tr>
								<tr>
									<th class="cabeceraNormal">País/Región</th>
									<td>
										<textarea rows="4" cols="30" id="txtPaisRegion" value="" name="txtNombreYDepto"></textarea>
									</td>
								</tr>
								<tr>
									<th class="cabeceraNormal">Ejercito/Otro actor</th>
									<td>
										<textarea rows="4" cols="30" id="txtEjercito" value="" name="txtNombreYDepto"></textarea>							
									</td>
								</tr>
								<tr>
									<th class="subCabecera">Status quo</th>
									<td>
										<textarea rows="4" cols="30" id="txtStatusQuo" value="" name="txtNombreYDepto"></textarea>							
									</td>
								</tr>
								<tr>
									<th class="subCabecera">Cambio propuesto</th>
									<td>
										<textarea rows="4" cols="30" id="txtCambioPropuesto" value="" name="txtNombreYDepto"></textarea>							
									</td>
								</tr>
								<tr >
									<th class="cabeceraNormal">Resumen especifico</th>
									<td>
										<textarea rows="8" cols="30" id="txtResumenEspecifico" value="" name="txtNombreYDepto"></textarea>							
									</td>
								</tr>
							</tbody>
						</table>
						<br><br>
					</tr>
					<!-- parte hiss -->
					<tr>
						<table style=" width: 100%"  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
							<thead class="cabeceraNormal">
								<td colspan="2">Principio</td>
								<td>Respuesta</td>
								<td>S/N</td>
							</thead>
							<tbody>
								<!-- Humanitaria imperativa -->
								<tr>
									<td style="width:5%;"><h1 style="font-size: 7em; color:orange;">H</h1></td>
									<td style="width:35%">
										<p>											
											<div style="text-align: left;">
											<h3>umanitaria Imperativa</h3>
												Es esta acción:<br>
												>	¿Solamente ocurre en orden de adelantar la imperativa humanitaria para proveer 
												ayuda a esos en necesidad, de acuerdo con los más altos estándares de entrega de ayuda?  
											</div>
										</p>
									</td>
									<td style="width:35%">
									<textarea rows="13" style="width:100%;" id="txtRespuestaH" value="" name="txtRespuestaH"></textarea>
									</td>
									<td style="width:25%">
										<label><input type="checkbox" id="chkH" name="chkH"/> Sí/No</label>
										<br>
										<label><input type="checkbox" id="chkH_bandera" name="chkH_bandera"/><img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
								<!-- Imparcialidad e independencia -->
								<tr>
									<td><h1 style="font-size: 7em; color:orange;">I</h1></td>
									<td>
										<p>
											<div style="text-align: left;">
												<h3>mparcialidad e Independencia</h3>								
											Está esta acción asegurando que:
											<br>> 	¿No discriminamos en base a género, raza, etnicidad, religión, nacionalidad, afiliación política estatus social?
											<br>>	¿Nuestro alivio es guiado por una evaluación de necesidades?
											<br>>	¿prioridad es  dada a los casos más urgentes de angustia?
											</div>
										</p>
									</td>
									<td>
										<textarea  id="txtRespuestaI0" value="" name="txtRespuestaI0"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkI0" name="chkI0"/> Sí/No</label>
										<label><input type="checkbox" id="chkI0_bandera" name="chkI0_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<p>											
											<div style="text-align: left;">
												>	¿Somos neutrales en la provisión de ayuda (particularmente en el contexto de emergencias complejas)?
											</div>
										</p>
									</td>
									<td>
										<textarea id="txtRespuestaI1" value="" name="txtRespuestaI1"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkI1" name="chkI1"/>Sí/No</label>										
										<label><input type="checkbox" id="chkI1_bandera" name="chkI1_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<p>											
											<div style="text-align:left;">
												Está esta acción asegurando que: <br>
											>	¿nuestro compromiso es hacia la imperativa humanitaria y no a la 
											agenda de gobiernos, grupos políticos, o fuerzas militares?
											</div>
										</p>
									</td>
									<td>
										<textarea  id="txtRespuestaI2" value="" name="txtRespuestaI2"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkI2" name="chkI2"/>Sí/No</label>
										<label><input type="checkbox" id="chkI2_bandera" name="chkI2_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>										
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<p>											
											<div style="text-align:left;">
												>	¿nosotros no actuamos de una manera que entrega nuestra habilidad de advocar? 
											</div>
										</p>
									</td>
									<td>
										<textarea id="txtRespuestaI3" value="" name="txtRespuestaI3"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkI3" name="chkI3"/>Sí/No</label>
										<label><input type="checkbox" id="chkI3_bandera" name="chkI3_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<p>											
											<div style="text-align:left;">
												>	¿nosotros no ponemos en peligro la libertad de movimiento del personal humanitario?
											</div>
										</p>
									</td>
									<td>
										<textarea id="txtRespuestaI4" value="" name="txtRespuestaI4"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkI4" name="chkI4"/>Sí/No</label>
										<label><input type="checkbox" id="chkI4_bandera" name="chkI4_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<p>											
											<div style="text-align: left;">
												>	¿tenemos la libertad de conducir evaluaciones independientes?
											</div>
										</p>
									</td>
									<td>
										<textarea id="txtRespuestaI5" value="" name="txtRespuestaI5"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkI5" name="chkI5"/>Sí/No</label>
										<label><input type="checkbox" id="chkI5_bandera" name="chkI5_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<p>											
											<div style="text-align: left;">
												>	¿tenemos la libertad de seleccionar el personal?
											</div>
										</p>
									</td>
									<td>
										<textarea id="txtRespuestaI6" value="" name="txtRespuestaI6"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkI6" name="chkI6"/>Sí/No</label>
										<label><input type="checkbox" id="chkI6_bandera" name="chkI6_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<p>											
											<div style="text-align: left;">
												>	¿tenemos la libertad de identificar beneficiarios en base a necesidades? 
											</div>
										</p>
									</td>
									<td>
										<textarea id="txtRespuestaI7" value="" name="txtRespuestaI7"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkI7" name="chkI7"/>Sí/No</label>
										<label><input type="checkbox" id="chkI7_bandera" name="chkI7_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<p>											
											<div style="text-align: left;">
												>	¿tenemos un flujo de información libre entre las agencias humanitarias?
											</div>
										</p>
									</td>
									<td>
										<textarea id="txtRespuestaI8" value="" name="txtRespuestaI8"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkI8" name="chkI8"/>Sí/No</label>
										<label><input type="checkbox" id="chkI8_bandera" name="chkI8_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
								<!-- Seguridad y proteccion -->
								<tr>
									<td><h1 style="font-size: 7em; color:orange;">S</h1></td>
									<td>
										<p>
											<div style="text-align: left;">
												<h3>eguridad y Protección</h3>								
											Mediante una rápida evaluación de "No hacer daño" del contexto, está esta acción garantizando que podamos prevenir a lo mejor de nuestra capacidad cualquier tipo de consecuencias no deseadas para: <br> 
											>	¿la seguridad de nuestro personal?<br>
											>	¿la seguridad de nuestros compañeros locales?<br>
											>	¿la seguridad de nuestros beneficiarios?<br>
											>	¿la seguridad de nuestras agencias?<br>
											>	¿el fomento de conflicto?
											</div>
										</p>
									</td>
									<td>
										<textarea id="txtRespuestaS1" value="" name="txtRespuestaS1"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkS1" name="chkS1"/>Sí/No</label>
										<label><input type="checkbox" id="chkS1_bandera" name="chkS1_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
								<tr>
									<td><h1 style="font-size: 7em; color:orange;">S</h1></td>
									<td>
										<p>
											<div style="text-align: left;">
												<h3>ostenibilidad</h3>								
											Es esta acción: <br>
											>	¿tomando en cuenta una perspectiva de plazo más largo que la inmediata?
											</div>
										</p>
									</td>
									<td>
										<textarea id="txtRespuestaS2_0" value="" name="txtRespuestaS2_0"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkS2_0" name="chkS2_0"/>Sí/No</label>
										<label><input type="checkbox" id="chkS2_0_bandera" name="chkS2_0_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<p>
											<div style="text-align: left;">
												>	¿alineada estratégicamente con el trabajo de VM en la asistencia de comunidades para vencer la pobreza e injusticia?
											</div>
										</p>
									</td>
									<td>
										<textarea id="txtRespuestaS2_1" value="" name="txtRespuestaS2_1"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkS2_1" name="chkS2_1"/>Sí/No</label>
										<label><input type="checkbox" id="chkS2_1_bandera" name="chkS2_1_bandera"/>
										<img src="../img/flag.jpg" alt="bandera"/></label>
									</td>
								</tr>
							</tbody>
						</table>
					</tr>

					<!-- parte cam -->
					<tr>
						<table border  data-mode="reflow" style="border:solid 1px; width:100%" class="ui-responsive table-stroke ui-table ui-table-">
							<thead class="cabeceraNormal">
								<td colspan="2">Proceso</td>
								<td>Respuesta</td>
								<td>S/N</td>
							</thead>
							<tbody>
								<tr>
									<td style="width: 5%;"><h1 style="font-size: 7em; color:orange;">C</h1></td>
									<td style="width: 35%;">
										<p>
											<div style="text-align: left;">
												<h3>onvincente propósito</h3>								
											Es esta acción:<br>
											>	¿en busca de un propósito importante o convincente? (consideraciones económicas en y de ellos mismos nunca debe constituir esto)
											<br>>	¿en busca de un resultado deseado especifico?
											<br>>	¿alineado con las miras estratégicas de VM (incluyendo global, regional, nacional)?
											</div>
										</p>
									</td>
									<td style="width: 35%;">
										<textarea id="txtRespuestaC" value="" name="txtRespuestaC"></textarea>
									</td>
									<td style="width: 25%;">
										<label><input type="checkbox" id="chkC" name="chkC"/> Sí/No</label>
									</td>
								</tr>
								<tr>
									<td><h1 style="font-size: 7em; color:orange;">A</h1></td>
									<td>
										<p>											
											<div style="text-align: left;">
												<h3>propiado, adaptado & adecuadamente informado</h3>								
											Es esta acción: <br>
											>	¿apropiado para su propósito (ej. razonable y por evidencia conectado a la mira anterior)?  
											<br>>	¿adaptado al contexto?
											<br>>	¿adecuadamente informado por medio de evidencia tal como análisis y evaluaciones de contexto existentes y cualquier información nueva disponible?
											</div>
										</p>
									</td>
									<td>
										<textarea  id="txtRespuestaA" value="" name="txtRespuestaA"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkA" name="chkA"/> Sí/No</label>
									</td>
								</tr>
								<tr>
									<td><h1 style="font-size: 7em; color:orange;">M</h1></td>
									<td>
										<p>
											<div style="text-align: left;">
												<h3>inimo impacto negativo</h3>								
											Es esta acción: <br>
											>	¿el último recurso en obtener la meta (ej. todos los otros medios han sido agotados)?
											<br>>	el menos impactante:<br>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;o	¿en la inmediata y largo plazo?<br>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;o	¿en accionistas (comunidades, iguales de industria y VM)?
											</div>
										</p>
									</td>
									<td>
										<textarea id="txtRespuestaM" value="" name="txtRespuestaM"></textarea>
									</td>
									<td>
										<label><input type="checkbox" id="chkM" name="chkM"/>Sí/No</label>
									</td>
								</tr>
							</tbody>
						</table>
					</tr>

					<!-- parte de recomendacion -->
					<tr>
						<table width="100%" border  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
							<thead>
								<th colspan="2"  class="cabeceraNormal">
									<div class="ui-radio ui-mini">
										<label for="rdbCortar" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Cortar</label>
										<input type="radio" name="rdbReco" class="" id="rdbCortar" value="0" checked="checked">
									</div>
									<div class="ui-radio ui-mini">
										<label for="rdbCoexistir" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Coexistir</label>
										<input type="radio" name="rdbReco" class="" id="rdbCoexistir" value="1">
									</div>
									<div class="ui-radio ui-mini">
										<label for="rdbCoordinar" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Coordinar</label>
										<input type="radio" name="rdbReco" class="" id="rdbCoordinar" value="2">
									</div>
									<div class="ui-radio ui-mini">
										<label for="rdbCooperar" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Cooperar</label>
										<input type="radio" name="rdbReco" class="" id="rdbCooperar" value="3">
									</div>
									<p>Elija una de estas cuatro palabras que mejor describa el nivel de compromiso propuesto</p>
								</th>
							</thead>
							<tbody>
								<tr>									
									<td style="width:20%">
										<h3><b>Recomendación</b></h3>
									</td>
									<td>
										<textarea rows="10" cols="30" id="txtRecomendacion" value="" name="txtRecomendacion"></textarea>
									</td>									
								</tr>
							</tbody>
						</table>
					</tr>

					<!-- parte de referencia -->
					<tr>
						<table style="width:100%;" border  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
							<thead>
								<th colspan="2"  class="cabeceraNormal">									
									<h3>Referencia</h3>
								</th>
							</thead>
							<tbody>
								<tr>									
									<td style="width:35%">
										<div style="text-align: left;">
											<b>Implicaciones para otras entidades de VM</b> <br>
										¿Piensa que usted puede tomar la decisión solo, o que otras entidades de VM deben de estar comprometidas? <bR>
										>	¿Implicaciones de la Oficina Nacional?<br>
										>	¿Implicaciones Regionales?<br>
										>	¿Implicaciones de la Oficina de Apoyo?<br>
										>	¿Implicaciones de la Asociación?<br>
										Cuando la recomendación se da a seguir con la acción propuesta, requiriendo un acuerdo, consulte el Manual de Ops 2A-17 (p.8) y 2F-44 (pp.16-17).
										</div>
									</td>
									<td>
										<textarea rows="10" cols="30" id="txtReferencia" value="" name="txtReferencia"></textarea>
									</td>									
								</tr>
								<tr>
									<td><b>Referirse a</b></td>
									<td><textarea rows="10" cols="30" id="txtReferirseA" value="" name="txtReferirseA"></textarea></td>
								</tr>
							</tbody>
						</table>
					</tr>

					<!-- parte decision final y base -->
					<tr>
						<table style="width:100%;" border  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
							<thead class="cabeceraNormal">
								<th colspan="2">									
									<h3>Decisión final y base</h3>
								</th>
							</thead>
							<tbody>
								<tr>									
									<td style="width: 35%;">
										<b>Nombre y departamento</b>
									</td>
									<td>
										<textarea rows="10" cols="30" id="txtNombreyDepaFinal" value="" name="txtNombreyDepaFinal"></textarea>
									</td>									
								</tr>
								<tr>									
									<td>
										<b>Fecha de recibo</b>
									</td>
									<td>
										<input type="date" name="txtFechaRecibo" id="txtFechaRecibo" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset"/>
									</td>									
								</tr>
								<tr>									
									<td>
										<b>
											>	¿Acuerdo con evaluación?<br>
											>	¿Áreas de desacuerdo?<br>
											>	¿El proceso se mueve hacia adelante?<br>
											>	¿Qué grupos han sido alertadas?<br>
										</b>
									</td>
									<td>
										<textarea rows="10" cols="30" id="txtDecisionFinalUltima" value="" name="txtDecisionFinalUltima"></textarea>
									</td>									
								</tr>
								
							</tbody>
						</table>
					</tr>

					<!-- parte plan de accion  -->
					<tr>
						<table style="width:100%;" border  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
							<thead>
								<td>
									<h3>
										Plan de acción
									</h3>
									<p style="font-size: 0.8em; font-style: italic; word-wrap: break-word;">
										Si la recomendación da a proceder con el acuerdo/cambio propuesto en el nivel de compromiso, usted pueda querer desarrollar un plan de acción acompañante para las secciones relevantes anteriores que fueron evaluadas como posibles acuerdos (ej., nuestra independencia, protección del beneficiario) – esto incluye ‘banderines rojos’. Cualquier acuerdo debe de ser compensado por una serie de acciones conectados con gatillos (ej., en áreas como el apoyo, seguridad, recursos humanos, y comunicaciones).
									</p>
								</td>
							</thead>
							<tbody>
								<tr>
									<td>
										<textarea rows="40" id="txtPlanDeAccion" value="" name="txtPlanDeAccion"></textarea>
									</td>
								</tr>
							</tbody>
						</table>
					</tr>

					<!-- parte de anexo -->
					<tr>
						<table style="width:100%;" border  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
							<thead>
								<td>
									<h3>
										Anexo
									</h3>
									<p style="font-size: 0.8em; font-style: italic; word-wrap: break-word;">
										Inserte información aquí si siente que debería de haber más información de fondo proporcionada en el Contexto, Historia del Programa, o cualquier otra información relevante a esta decisión.
									</p>
								</td>
							</thead>
							<tbody>
								<tr>
									<td>
										<textarea rows="20" id="txtAnexo" value="" name="txtAnexo"></textarea>
									</td>
								</tr>
							</tbody>
						</table>
					</tr>

					<!-- boton de evaluacion -->
					<tr>
						<td>
							<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
								<input type="button" id="btnEvaluar" data-theme="a" name="btnEvaluar" onclick="confirmar();" value="Evaluar" class="ui-btn-hidden" aria-disabled="false"/>
							</div>
						</td>
					</tr>
				</tbody>			
			</table>			
		</div>
		<?php echo $c_funciones->getMenuNivel2($_SESSION["TipoUsuario"]); ?>
	</div>		
	<?php echo $c_funciones->getFooterNivel2(); ?>		
	<!-- FOOTER -->

	<script type="text/javascript">
	//txtFecha
	$(function(){
		$("#txtFecha").datepicker();
	});

	$("#lstPais").change(function(){
		var idPais = $(this).val();
		if(idPais == "-2"){
			swal("Advertencia", "Debe elegir un país", "warning");
			return false;
		}

		$.ajax({
			type: "POST",
			url: "../funcionesAjax.php",
			data: {
				nombreMetodo: "getPtosEval",
				AjxPPais: idPais
			},
			beforeSend: function () {
					//$("#modalCargando").modal("show");
					$("#respuesta").text("Creando usuario...");
				},
				success: function (datos) {					
					$("#lstPuntoEvaluacion").html("");
					$("#lstPuntoEvaluacion").html(datos);
					$('#lstPuntoEvaluacion option:eq(0)').prop('selected', true);
					$('#lstPuntoEvaluacion').selectmenu('refresh');
				},
				error: function (objeto, error, objeto2) {
					//$("#modalCargando").modal("hide");
					alert(error);
				}
			});
	});


	function openModalCargando(){
		swal({
			title: "Cargando...",			
			imageUrl: "../css/images/ajax-loader.gif"			
		});
		$(".confirm").css("display", "none");
	}

	function closeModalCargando(){
		$(".confirm").click();
	}

</script>
</body>
</html>