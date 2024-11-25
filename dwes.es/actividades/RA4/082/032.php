<?php
// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');
require_once('03jwt_include.php');
require_once('include.php');

$tipo = [
    'se' => 'Servidor',
    'in' => 'Interfaces',
    'cl' => 'Cliente',
    'de' => 'Despliegues'
];

inicio_html('Introduccion de comentarios', ['/estilos/general.css']);

$jwt = $_COOKIE['jwt'];
if (!$payload = verificar_token($jwt)) {
    cerrar_sesion();
}


if ($_SERVER['REQUEST_METHOD'] == 'GET' ) {
?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <legend>Introduce tus comentarios</legend>
            <label for="opciones">Opciones</label>
            <select name="opciones" id="opciones">
                <?php
                    foreach ($tipo as $key => $value) {
                        echo "<option value='$value'>$value</option>";
                    }
                ?>
            </select>
            <br>

            <label for="comentario">Comentario</label>
            <textarea name="comentario" id="comentario" cols="30" rows="10" placeholder="Introduce tu comentario"></textarea>

            <input type="submit" value="Enviar">
        </fieldset>

    </form>
<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $opcion = filter_input(INPUT_POST,'opciones', FILTER_SANITIZE_SPECIAL_CHARS);

    $comentario = filter_input(INPUT_POST,'comentario', FILTER_SANITIZE_SPECIAL_CHARS);

    $_SESSION['opcion'] = $opcion;
    $_SESSION['comentario'] = $comentario;

    header('location: /actividades/RA4/082/042.php');

}

//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();

?>