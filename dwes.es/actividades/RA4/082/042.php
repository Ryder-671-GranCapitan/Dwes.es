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


if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload && $_SESSION['opcion'] && $_SESSION['comentario']) {

    $opcion = $_SESSION['opcion'];
    $comen= $_SESSION['comentario'];

    $comentario = [
        'opcion' => $opcion,
        'comentario' => $comen,
        'fecha'=> date('H:i:s')
    ];
    
    if (!isset($_SESSION['comentarios']) || !is_array($_SESSION['comentarios'])) {
        $_SESSION['comentarios'] = [];
    }

    $_SESSION['comentarios'][] = $comentario;

    echo "<h2>Lista de comentarios de {$payload['email']}</h2>";
    echo "<a href='/actividades/RA4/082/032.php'>añadir mas</a><br>";
    echo "<a href='/actividades/RA4/082/052.php'>Presentar Todos</a>";

    ?>
    <fieldset>
        <legend>tipo: <?=$_SESSION['opcion'] ?></legend>
        <p>
            <?= $_SESSION['comentario']?>
        </p>

    </fieldset>
    
    <?php
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
