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
	<title>FAST-Home</title>
	
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
						<input type="checkbox" name="checkbox-1a" id="checkbox-1a" class="custom">
						<label for="checkbox-1a" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="checkbox-off" data-theme="c" data-mini="true" class="ui-btn ui-mini ui-btn-icon-left ui-corner-top ui-checkbox-off ui-btn-up-c">
							<span class="ui-btn-inner ui-corner-top">
								<span class="ui-btn-text">Opcion 1</span>
								<span class="ui-icon ui-icon-shadow ui-icon-checkbox-off">&nbsp;</span>
							</span>
						</label>
					</div>

					<div class="ui-checkbox">
						<input type="checkbox" name="checkbox-2a" id="checkbox-2a" class="custom">
						<label for="checkbox-2a" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="checkbox-off" data-theme="c" data-mini="true" class="ui-btn ui-mini ui-btn-icon-left ui-checkbox-off ui-btn-up-c">
							<span class="ui-btn-inner">
								<span class="ui-btn-text">Opcion 2</span>
								<span class="ui-icon ui-icon-shadow ui-icon-checkbox-off">&nbsp;</span>
							</span>
						</label>
					</div>

					<div class="ui-checkbox">
						<input type="checkbox" name="checkbox-3a" id="checkbox-3a" class="custom">
						<label for="checkbox-3a" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="checkbox-off" data-theme="c" data-mini="true" class="ui-btn ui-mini ui-btn-icon-left ui-checkbox-off ui-btn-up-c">
							<span class="ui-btn-inner">
								<span class="ui-btn-text">Opcion 3</span>
								<span class="ui-icon ui-icon-shadow ui-icon-checkbox-off">&nbsp;</span>
							</span>
						</label>
					</div>

					<div class="ui-checkbox">
						<input type="checkbox" name="checkbox-4a" id="checkbox-4a" class="custom">
						<label for="checkbox-4a" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="checkbox-off" data-theme="c" data-mini="true" class="ui-btn ui-mini ui-btn-icon-left ui-corner-bottom ui-controlgroup-last ui-checkbox-off ui-btn-up-c">
							<span class="ui-btn-inner ui-corner-bottom ui-controlgroup-last">
								<span class="ui-btn-text">Opcion 4</span>
								<span class="ui-icon ui-icon-shadow ui-icon-checkbox-off">&nbsp;</span>
							</span>
						</label>
					</div>
				</div>		
			</fieldset> <!-- /Formulario CRR Pagina 1-->
		</div>
	</div>
</body>

</html>
