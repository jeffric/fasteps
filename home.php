<?php 
session_start();
ob_start();
include_once "funciones.php";
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

		<?php $c_funciones->getMenu(" - Home - ","");  	echo "This file full path is '" . __DIR__ . "'.\n";?>

		<div role="main" class="ui-content">
			<h2>One</h2>
			<div class="ui-grid-c ui-responsive">
				<div class="ui-block-a" style="text-align: center;">
					<a href="crr/crr.php">
						<img src="img/crr-logo.png" alt="crr-section">
						<h2>CRR</h2>
					</a>
				</div>
				<div class="ui-block-b" style="text-align: center;">
					<a href="crr/crr.php">
						<img src="img/sra-logo.png" alt="crr-section">
						<h2>SRA</h2>
					</a>
				</div>
				<div class="ui-block-c" style="text-align: center;">
					<a href="crr/crr.php">
						<img src="img/hiss-logo.png" style="width:80%;" alt="crr-section">
						<h2>HISS CAM</h2>
					</a>					
				</div>
				<div class="ui-block-d" style="text-align: center;">
					<a href="crr/crr.php">
						<img src="img/csr-logo.png" style="width:78%;" alt="crr-section">
						<h2>CSR</h2>
					</a>
				</div>
			</div><!-- /grid-b -->
			<div data-role="controlgroup">
				<a href="reportes.php" data-role="button">Reportes</a>
				<a href="configuracion.php" data-role="button">Configuraci&oacute;n</a>
				<a href="historial.php" data-role="button">Historial</a>
			</div> <!-- /Down Menu -->
			
		</div><!-- /content -->

		<?php $c_funciones->getFooter(); ?>
	</div><!-- /page one -->

	<script type="text/javascript">
		$( document ).on( "pageinit", "#demo-page", function() {
			$( document ).on( "swipeleft swiperight", "#demo-page", function( e ) {
		        // We check if there is no open panel on the page because otherwise
		        // a swipe to close the left panel would also open the right panel (and v.v.).
		        // We do this by checking the data that the framework stores on the page element (panel: open).
		        if ( $.mobile.activePage.jqmData( "panel" ) !== "open" ) {
		        	if ( e.type === "swipeleft"  ) {
		        		$( "#right-panel" ).panel( "open" );
		        	} else if ( e.type === "swiperight" ) {
		        		$( "#left-panel" ).panel( "open" );
		        	}
		        }
		    });
		});
	</script>
</body>
</html>