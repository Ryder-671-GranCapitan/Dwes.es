<?php

// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');

inicio_html('Ejercicio 4', ['/estilos/general.css']);


$pintura_vehiculos = [
    ['nombre' => 'Gris triste', 'precio' => 0],
    ['nombre' => 'Rojo sangre', 'precio' => 250],
    ['nombre' => 'Rojo pasión', 'precio' => 150],
    ['nombre' => 'Azul noche', 'precio' => 175],
    ['nombre' => 'Caramelo', 'precio' => 300],
    ['nombre' => 'Mango', 'precio' => 275]
];

$extras_vehiculos = [
    ['nombre' => 'Navegador GPS', 'precio' => 500],
    ['nombre' => 'Calefacción asientos', 'precio' => 250],
    ['nombre' => 'Antena aleta tiburón', 'precio' => 50],
    ['nombre' => 'Acceso y arranque sin llave', 'precio' => 150],
    ['nombre' => 'Arranque en pendiente', 'precio' => 200],
    ['nombre' => 'Cargador inalámbrico', 'precio' => 300],
    ['nombre' => 'Control de crucero', 'precio' => 500],
    ['nombre' => 'Detectar ángulo muerto', 'precio' => 350],
    ['nombre' => 'Faros led automáticos', 'precio' => 400],
    ['nombre' => 'Frenada emergencia', 'precio' => 375]
];



if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['nombre'] && $_SESSION['telefono'] && $_SESSION['email']) {
?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <legend>Introduce los datos</legend>


            <label for="pintura">pintura</label><br>
            <select name="pintura" id="pintura">
                <?php
                foreach ($extras_vehiculos as $extras) {
                    echo "<option value='{$extras['nombre']}'>{$extras['nombre']} => {$extras['precio']}</option>";
                }
                ?>
            </select>
            <br><br>

            <label for="extras">extras</label><br>
            <?php
            foreach ($extras_vehiculos as $extras) {
                echo "<input type='checkbox' name='extras[]' id='extras' value='{$extras['nombre']}'>{$extras['nombre']} => {$extras['precio']}<br>";
            }
            ?>

            <input type="submit" value="confirmar">
        </fieldset>
    </form>
<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['nombre'] && $_SESSION['telefono'] && $_SESSION['email']) {

    $pintura = filter_input(INPUT_POST, 'pintura', FILTER_SANITIZE_SPECIAL_CHARS);
    $pinturaPrecio = key_exists($pintura, $pintura_vehiculos) ? $pintura_vehiculos[$pintura]['precio'] : 0;


    $extras = filter_input(INPUT_POST, 'extras', FILTER_SANITIZE_SPECIAL_CHARS);

    $_SESSION['pintura'] = $pintura;
    $_SESSION['extras'] = $extras;

    header('Location: ej04_pantalla_resumen.php');
} else {
    header('Location: ej04.php');

}

//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();

?>