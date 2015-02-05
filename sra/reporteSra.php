<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

		if($_SESSION["Usuario"] == ""){
			header("Location: ../index.php");
			return;
		}

try {
	unset($_SESSION['arrAmenazasSRAActual']);
	unset($_SESSION["idEvalSraActual"]);
	unset($_SESSION["JsonPaso1SRA"]);
} catch (Exception $e) {
	
}

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Master page Nivel 2", 
	'<script type="text/javascript">
	$(function() {
		$("nav#menu").mmenu();
	});
$(document).bind("mobileinit", function () {

	$.mobile.ajaxEnabled = false;

});
</script>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f38630;}
.tg .{background-color:#f38630;color:#ffffff}
.tg .tg-cxkv{background-color:#ffffff}


.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-lkh3{background-color:#9aff99}
.tg .tg-lkh4{background-color:#4C4C4C; color: white;}
.tg .tg-s6z2{text-align:center}
.tg .tg-8o5d{background-color:#34ff34}
.tg .tg-3ope{background-color:#ffcb2f}
.tg .tg-hgcj{font-weight:bold;text-align:center}
.tg .tg-mnb8{font-weight:bold;background-color:#f38630;color:#ffffff}
.tg .tg-yg2k{background-color:#fe0000;color:#ffffff;text-align:center}
.tg .tg-v88f{background-color:#f8ff00}

.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-e3zv{font-weight:bold}
.tg .tg-bghc{font-weight:bold;background-color:#32cb00;text-align:center}
.tg .tg-f062{font-weight:bold;background-color:#f38630;text-align:center}
.tg .tg-hgcj{font-weight:bold;text-align:center}
.tg .tg-1ea8{font-weight:bold;background-color:#963400;text-align:center}

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

	<div id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Home"); ?>
		<div class="content">
			<div id="printReport" class="ui-grid-solo">
				<?php 
				$idReporteSra = $_GET["idRepo"];
				$strHtmlReporte = '';
				$result = $c_funciones->getReporteSra($idReporteSra);
				while($row = mysqli_fetch_array($result, MYSQL_NUM)){
					$strHtmlReporte = $row[2];					
					break;
				}
				echo $strHtmlReporte;
				?>
			</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($_SESSION["TipoUsuario"]); ?>
	</div>		
	<?php echo $c_funciones->getFooterNivel2(); ?>		
	<!-- FOOTER -->
</body>
</html>