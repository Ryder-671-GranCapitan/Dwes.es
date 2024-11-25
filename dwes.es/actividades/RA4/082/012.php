<?php
// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');
require_once('03jwt_include.php');
require_once('include.php');

inicio_html('Pantalla inicial', ['/estilos/general.css']);


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
    <!-- FORMULARIO -->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <fieldset>
        <legend>inicio de sesion</legend>
        <label for="correo">email</label>
        <input type="email" name="correo" id="correo">

        <label for="clave">clave</label>
        <input type="password" name="clave" id="clave" require>

        <input type="submit" value="enviar">
    </fieldset>
</form>

<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    $clave = $_POST['clave'];

    if (autenticar($email, $clave)){

        $usuario = [
            'email' => $email
        ];

        $jwt = generar_token($usuario);

        $expire = time() + 60*120;

        setcookie('jwt', $jwt, $expire,'/');

        header('location: /actividades/RA4/082/022.php');
       
    }
    else{
        ?>
        <a href="/actividades/RA4/082/012.php">Has fallado intentalo de nuevo</a>
        <?php
    }
}

//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();

?>