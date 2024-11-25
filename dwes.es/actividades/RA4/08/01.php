<?php
// INICIO DE ARCHIVO

// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');
require_once('03jwt_include.php');
require_once('include.php');



inicio_html('Ejercicio 8', ['/estilos/general.css']);


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
    <!-- FORMULARIO -->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <legend>inicio de sesion</legend>

            <label for="nombre">nombre:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="correo">email</label>
            <input type="email" name="correo" id="correo">

            <label for="clave">clave</label>
            <input type="password" name="clave" id="clave" require>

            <input type="submit" value="enviar">

        </fieldset>
    </form>
<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);

    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $correo = filter_var($correo, FILTER_VALIDATE_EMAIL);

    $clave = $_POST['clave'];


    if ($nombre && $correo && $clave) {
        echo ' ' . $nombre . ' ' . $correo . ' ' . $clave;
        if (autenticar($nombre, $clave)) {
            echo ' ' . $nombre . ' ' . $correo . ' ' . $clave;

            $usuario = [
                'nombre' => $nombre,
                'correo' => $correo,                
            ];
            
            //generamos el token de la cookie
            $jwt = generar_token($usuario);
            $expires = time() + 120 * 60;
            setcookie('jwt', $jwt, $expires, '/', 'dwes.es');
            header('location: /actividades/RA4/08/02.php');

        } else {
            echo ' ' . $nombre . ' ' . $correo . ' ' . $clave;
            header('location: /actividades/RA4/08/01.php');
        }
    } else {
        header('location: /actividades/RA4/08/01.php');
    }
}

//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();

?>