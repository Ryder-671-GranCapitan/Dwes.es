<?php

// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');

inicio_html('Ejercicio 4', ['/estilos/general.css']);


$modelo_vehiculos = [
    ['nombre' => 'Muchopami', 'precio' => 21000],
    ['nombre' => 'Zapatoveloz', 'precio' => 22000],
    ['nombre' => 'Guperino', 'precio' => 25500],
    ['nombre' => 'Alomejor', 'precio' => 29750],
    ['nombre' => 'Telapegas', 'precio' => 32550]

];


$tipo_motor = [
    ['nombre' => 'Gasolina', 'precio' => 0],
    ['nombre' => 'Diesel', 'precio' => 2000],
    ['nombre' => 'Híbrido', 'precio' => 5000],
    ['nombre' => 'Electrico', 'precio' => 10000]
];





if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SESSION['nombre'] && $_SESSION['telefono'] && $_SESSION['email']) {
?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <legend>Introduce los datos</legend>

            <label for="modelo">modelo</label><br>
            <select name="modelo" id="modelo">
                <?php
                foreach ($modelo_vehiculos as $modelo) {
                    echo "<option value='{$modelo['nombre']}'>{$modelo['nombre']} => {$modelo['precio']}</option>";
                }
                ?>
            </select>
            <br><br>

            <label for="motor">motor</label><br>
            <?php
            foreach ($tipo_motor as $motor) {
                echo "<input type='radio' name='motor' id='motor' value='{$motor['nombre']}'>{$motor['nombre']} => {$motor['precio']}<br>";
            }
            ?>
            <br>

            <input type="submit" value="confirmar">
        </fieldset>
    </form>
<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['nombre'] && $_SESSION['telefono'] && $_SESSION['email']) {

    $modelo = filter_input(INPUT_POST, 'modelo', FILTER_SANITIZE_SPECIAL_CHARS);
    $modeloPrecio = key_exists($modelo, $modelo_vehiculos) ? $modelo_vehiculos[$modelo]['precio'] : 0;
    
    $motor = filter_input(INPUT_POST, 'motor', in_array($modelo, $modelo_vehiculos));
    $motorPrecio = key_exists($motor, $motorPrecio) ? $motorPrecio[$motor]['precio'] : 0;
 

    $_SESSION['modelo'] = $modelo;
    $_SESSION['modeloPrecio'] = $modeloPrecio;
    $_SESSION['motor'] = $motor;
    $_SESSION['motorPrecio'] = $motorPrecio;

    header('Location: ej04_pantalla_pintura_extras.php');
} else {
    header('Location: ej04.php');

}

//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();

?>