<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/funciones.php");

try  {

}
catch( Exception $e) {
    echo ""
}

function autocarga_clases(string $clase): void {

}

use ra6\bbdd\Usuario;

inicio_html("Espacio de nombres", ["/estilos/general.css"]);

$usu1 = new Usuario("pepe", "José García", "Adm");

$emp1 = new Empleado("30000001A", "Manuel González");



echo "$usu1<br>";
echo "$emp1<br>";



fin_html();

?>