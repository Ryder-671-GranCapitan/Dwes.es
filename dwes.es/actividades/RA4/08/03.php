<?php

// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');
require_once('03jwt_include.php');
require_once('include.php');

$opciones = [
    'ser' => 'Servidor',
    'cli' => 'Cliente',
    'dec' => 'Despliegues'
];


inicio_html('Pantalla introducción comentarios', ['/estilos/general.css']);

$jwt = $_COOKIE['jwt'];
$payload = verificar_token($jwt);

if ($payload == false) { //si no se ha verificado el token se cierra la sesion y se redirige a la pantalla de inicio
    cerrar_sesion();
    header('location: /actividades/RA4/08/01.php');
} else {


    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload) {
?>
        <p>Bienvenido <?= $payload['nombre'] ?></p>
        <p>Que comentarios tienes</p>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <fieldset>
                <legend>Comentarios</legend>
                <label for="tipo">tipo</label>
                <select name="tipo" id="tipo">
                    <?php
                    foreach ($opciones as $key => $value) {
                        echo "<option value='$key'>$value</option>";
                    }
                    ?>

                </select>
                <br>
                <label for="comentario">Comentario:</label><br>
                <textarea name="comentario" id="comentario" cols="30" rows="10"></textarea>
                <br>

                <input type="submit" value="enviar">
            </fieldset>
        </form>
<?php

    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tipoCom = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS);

        $comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_SPECIAL_CHARS);

        $_SESSION['tipo'] = $tipoCom;
        $_SESSION['comentario'] = $comentario;

        header('location: /actividades/RA4/08/04.php');
    }
}
//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();

?>