<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>crr-politics</title>
	
	<?php 
		//importacion de estilos
	echo $c_funciones->getCssImports();

		//importacion de librerias javascript
	echo $c_funciones->getJavascriptImports(); 
	?>

	<style>
		/* Swipe works with mouse as well but often causes text selection. */
		#demo-page * {
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			-o-user-select: none;
			user-select: none;
		}
		/* Arrow only buttons in the header. */
		#demo-page .ui-header .ui-btn {
			background: none;
			border: none;
			top: 9px;
		}
		#demo-page .ui-header .ui-btn-inner {
			border: none;
		}
		/* Content styling. */
		dl { font-family: "Times New Roman", Times, serif; padding: 1em; }
		dt { font-size: 2em; font-weight: bold; }
		dt span { font-size: .5em; color: #777; margin-left: .5em; }
		dd { font-size: 1.25em; margin: 1em 0 0; padding-bottom: 1em; border-bottom: 1px solid #eee; }
		.back-btn { float: right; margin: 0 2em 1em 0; }
	</style>
</head>
<body>

	<!-- Start of first page: #one -->
	<div data-role="page" id="one">
	<?php $c_funciones->getMenu(" - CCR - ","crr");?>
		<div role="main" class="ui-content">
			<fieldset data-role="controlgroup" data-mini="true" class="ui-corner-all ui-controlgroup ui-controlgroup-vertical ui-mini">
				<div role="heading" class="ui-controlgroup-label">Choose as many snacks as you'd like:</div>
				<div class="ui-controlgroup-controls">
					<div class="ui-checkbox">
						<label>
							<input  type="radio" name="rdb-answer1" id="radio-choice-0a">1
						</label>
						<label>
							<input type="radio" name="rdb-answer2" id="radio-choice-0a">2
						</label>
						<label>
							<input type="radio" name="rdb-answer3" id="radio-choice-0a">3
						</label>
						<label>
							<input type="radio" name="rdb-answer4" id="radio-choice-0a">4
						</label>
						<label>
							<input type="radio" name="rdb-answer5" id="radio-choice-0a">5
						</label>																								

					</div>

				</div>		
			</fieldset> <!-- /Formulario CRR Pagina 1-->
		</div>
	</div>
</body>

</html>
