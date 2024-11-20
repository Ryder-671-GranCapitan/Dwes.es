<?php

// Iniciamos la sesión
session_start();

//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once( $_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');

inicio_html('Ejercicio 4', ['/estilos/general.css']);


$modelo_vehiculos = [
    "Monroy" => 20000,
    "Muchopami" => 21000,
    "Zapatoveloz" => 22000,
    "Guperino" => 25500,
    "Alomejor" => 29750,
    "Telapegas" => 32550
];

$tipo_motor = [
    "Gasolina" => 0,
    "Diesel" => 2000,
    "Híbrido" => 5000,
    "Electrico" => 10000
];

$pintura_vehiculos = [
    "Gris triste" => 0,
    "Rojo sangre" => 250,
    "Rojo pasión" => 150,
    "Azul noche" => 175,
    "Caramelo" => 300,
    "Mango" => 275
];

$extras_vehiculos = [
    "Navegador GPS" => 500,
    "Calefacción asientos" => 250,
    "Antena aleta tiburón" => 50,
    "Acceso y arranque sin llave" => 150,
    "Arranque en pendiente" => 200,
    "Cargador inalámbrico" => 300,
    "Control de crucero" => 500,
    "Detectar ángulo muerto" => 350,
    "Faros led automáticos" => 400,
    "Frenada emergencia" => 375
];


if ($_SERVER['REQUEST_METHOD'] == 'GET'/* && $_SESSION['nombre'] && $_SESSION['telefono'] && $_SESSION['email']*/) {
?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <legend>Introduce los datos</legend>

            <label for="modelo">modelo</label><br>
            <select name="modelo" id="modelo">
                <?php
                    foreach ($modelo_vehiculos as $modelo => $precio) {
                        echo "<option value='{$modelo}>{$modelo} => {$precio}</option>";
                    }
                ?>
            </select>
            <br><br>

            <label for="motor">motor</label><br>
            <?php
                foreach ($extras_vehiculos as $extras => $precio) {
                    echo "<input type='radio' name='motor' id='motor' value='{$extras}'>{$extras} => {$precio} <br>";
                }
            ?>
            <br>

            <label for="pintura">pintura</label><br>
            <select name="pintura" id="pintura">    
                <?php
                    foreach ($pintura_vehiculos as $pintura => $precio) {
                        echo "<option value='{$pintura}>{$pintura} => {$precio}</option>";
                    }
                ?>
            </select>
            <br><br>

            <label for="extras">extras</label><br>
            <?php
                foreach ($extras_vehiculos as $extras => $precio) {
                    echo "<input type='checkbox' name='extras[]' id='extras' value='{$extras}'>{$extras} => {$precio}<br>";
                }
            ?>


            
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