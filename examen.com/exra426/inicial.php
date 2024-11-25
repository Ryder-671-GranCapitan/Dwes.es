<?php
session_start();
ob_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/exra426/includes/funciones.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/exra426/includes/jwt_include.php');

require_once('include.php');

inicio_html('inicial', ['/exra426/estilos/general.css', '/exra426/estilos/bh.css', '/exra426/estilos/formulario.css', '/exra426/estilos/tablas.css' ]);



if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
       <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <legend>inicio de sesion</legend>
            <label for="nombre">nombre completo:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="correo">email</label>
            <input type="email" name="correo" id="correo" require>

            <label for="clave">clave</label>
            <input type="password" name="clave" id="clave" required>

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
        if ($clave == autenticar($correo, $clave)) {
            
            $usuario = [
                'nombre' => $nombre,
                'correo' => $correo,
                'hora' => date('H:m:s')
            ];

            $jwt = generar_token($usuario);
            $expires = time() + 120 * 60;
            setcookie('jwt', $jwt, $expires, '/', '');

            header('location: /exra426/carrito.php');


        } else {
            header('location: /exra426/inicial.php');
        }
    } else {
        header('location: /exra426/inicial.php');
    }
}

$ob_datos = ob_get_contents();
ob_flush();
fin_html();
?>
