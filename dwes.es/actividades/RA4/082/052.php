<?php
// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');
require_once('03jwt_include.php');
require_once('include.php');

inicio_html('EXAMEN', ['/estilos/general.css']);

$jwt = $_COOKIE['jwt'];
if (!$payload = verificar_token($jwt)) {
    cerrar_sesion();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    echo "<h1>Tus comentarios {$payload['email']}</h1>";

    if (isset($_SESSION['comentarios']) && is_array($_SESSION['comentarios'])) {
        foreach ($_SESSION['comentarios'] as $comentario) {
            ?>
                <fieldset>
                    <legend><?=$comentario['opcion']?> - <?=$comentario['fecha']?></legend>
                    <p><?=$comentario['comentario']?></p>
                </fieldset>
            <?php
        }
    } else {
        echo "<p>No hay comentarios disponibles.</p>";
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar datos
    // Redirigir
}

//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();



?>
