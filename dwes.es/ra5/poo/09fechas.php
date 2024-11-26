<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/funciones.php");
echo "<header>fechas en PHP</header>";

echo "<h3>clase datetime</h3>";

$mi_fecha_nacimiento = new DateTime();

$formato_fecha = "j/n/Y G:i:s";

$mi_fecha_nacimiento = new DateTime($formato_fecha);









?>