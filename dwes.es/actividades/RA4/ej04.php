<?php

// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once( $_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');

inicio_html('Ejercicio 4', ['/estilos/general.css']);


if ($_SERVER['REQUEST_METHOD'] == 'GET' /*&& $_SESSION['nombre'] && $_SESSION['telefono'] && $_SESSION['email']*/) {
?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <legend>Introduce los datos</legend>

            <label for="nombre">nombre</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="telefono">telefono</label>
            <input type="text" name="telefono" id="telefono" required>

            <label for="email">email</label>
            <input type="email" name="email" id="email" required>
        </fieldset>
    </form>
<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
}

//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();

?>