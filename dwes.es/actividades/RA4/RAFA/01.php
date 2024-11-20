<?php

// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once( $_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');

inicio_html('Ejercicio Pizzas RAFA VERSION', ['/estilos/general.css']);
echo'<h1>PIZZAS</h1>';

?>

<form action="02.php" method="POST">
    <fieldset>
        <legend>pizzas:</legend>

        <label for="nombre">nombre</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>

        <label for="clave">clave</label>
        <input type="password" name="clave" id="clave" required>

        <label for="direccion">direccion</label>
        <input type="text" name="direccion" id="direccion" required>
        <br>

        <label for="telefono">telefono</label>
        <input type="text" name="telefono" id="telefono" required>
        <br>

        <label for="vegetariana">vegetariana</label>
        <input type="checkbox" name="vegetariana" id="vegetariana">

        <input type="submit" value="enviar">
    </fieldset>
</form>

<?php

//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();

?>