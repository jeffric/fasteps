<?php 

// Iniciamos sesión 
session_start(); 
// Borramos la variable
unset ($_SESSION["idUsuario"]);
unset($_SESSION["Usuario"]);
unset($_SESSION["TipoUsuario"]);
// Borramos toda la sesión
session_destroy();

header("Location: index.php");

?>