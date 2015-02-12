<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

$idUsuario = $c_funciones->getIdUsuario($strUsuario);

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Buscar Reporte CSR Punto Evaluación", 
	'  <style>
  .panel-content {
    padding: 1em;
  }
  </style>'); ?>
<body>
<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("F.A.S.T. Buscar Reporte CSR"); ?>
		<div role="main" class="ui-content">
			<p align="center"><strong>Puntos de Evaluación</strong><br />
				<div class="ui-body ui-body-a ui-corner-all">

					BUSCAR:
					<input id="filterTable-input" data-type="search">
						<table data-role="table" id="movie-table" data-filter="true" data-input="#filterTable-input" class="ui-responsive">
						    <thead>
						        <tr>
						            <th data-priority="1">Campo1</th>
						            <th data-priority="persist">Campo2</th>
						            <th data-priority="2">Campo3</th>
						            <th data-priority="3"><abbr title="Rotten Tomato Rating">Campo4</abbr></th>
						            <th data-priority="4">Campo5</th>
						        </tr>
						        </thead>
						        <tbody>
						            <tr>
						                <th>1</th>
						                <td><a href="http://en.wikipedia.org/wiki/Citizen_Kane" data-rel="external">Citizen Kane</a></td>
						                <td>1941</td>
						                <td>100%</td>
						                <td>74</td>
						            </tr>
						            <tr>
						                <th>2</th>
						                <td><a href="http://en.wikipedia.org/wiki/Casablanca_(film)" data-rel="external">Casablanca</a></td>
						                <td>1942</td>
						                <td>97%</td>
						                <td>64</td>
						            </tr>
						            <tr>
						                <th>3</th>
						                <td><a href="http://en.wikipedia.org/wiki/The_Godfather" data-rel="external">The Godfather</a></td>
						                <td>1972</td>
						                <td>97%</td>
						                <td>87</td>
						            </tr>
						        </tbody>
						    </table>	
					
				</div>
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>			
		<?php echo $c_funciones->getFooterNivel2(); ?>	
</div>
</body>
<script>
</script>
</html>