<?php
// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');
require_once('03jwt_include.php');
require_once('include.php');

inicio_html('Pantalla lista de comentarios', ['/estilos/general.css']);

$jwt = $_COOKIE['jwt'];
$payload = verificar_token($jwt);



if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload && $_SESSION['tipo'] && $_SESSION['comentario']) {


    $tipo = $_SESSION['tipo'];
    $comentario = $_SESSION['comentario'];
       
    $comentarioActual = [
        'tipo' => $tipo,
        'comentario' => $comentario,
        'hora' => date('H:i:s')
    ];
    
    $_SESSION['comentarios'][] = $comentarioActual;



    echo "<h2>Lista de comentarios de {$payload['nombre']}</h2>";
    echo "<a href='/actividades/RA4/08/03.php'>añadir mas</a><br>";
    echo "<a href='/actividades/RA4/08/05.php'>Presentar Todos</a>";


?>
        <fieldset>
            <legend><?=  $comentarioActual['tipo'] ?> - <?=  $comentarioActual['hora'] ?></legend>
            <p>
                <?=  $comentarioActual['comentario'] ?>
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