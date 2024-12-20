<?php
// INICIO DE ARCHIVO PHP

// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once( $_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');
require_once('03jwt_include.php');
require_once('include.php');


inicio_html('Bienvenida', ['/estilos/general.css']);

$jwt = $_COOKIE['jwt'];

$payload = verificar_token($jwt);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    
        echo "<h2>PANTALLA DE BIENVENIDA</h2>";
        echo "{$payload['nombre']}, bienvenido a la aplicación <br>";
        echo "{$payload['correo']}  correo electronico<br>";
    
        echo "<p>para ir a la siguiente ventana: </p>";
        echo "<a href='/actividades/RA4/08/03.php'>Siguiente</a>";//se pasa como peticion get


}
else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['nombre'] && $_SESSION['correo'] && $_SESSION['clave']) {
    


}

//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();

?>