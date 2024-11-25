<?php
// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');
require_once('03jwt_include.php');
require_once('include.php');

inicio_html('Pantalla bienvenida', ['/estilos/general.css']);

$jwt = $_COOKIE['jwt'];
if (! $payload = verificar_token($jwt)) {
    cerrar_sesion();
    exit(1);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' ) {

    echo "<h1>Bienvenido {$payload['email']}</h1>";
    
    echo "<a href='/actividades/RA4/082/032.php'> Puedes introducir comentario</a> ";


}

//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();

?>
