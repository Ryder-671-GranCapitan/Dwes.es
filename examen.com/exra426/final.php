<?php
session_start();
ob_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/exra426/includes/funciones.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/exra426/includes/jwt_include.php');

require_once('include.php');

inicio_html('final', ['/exra426/estilos/general.css', '/exra426/estilos/bh.css', '/exra426/estilos/formulario.css', '/exra426/estilos/tablas.css']);

$jwt = $_COOKIE['jwt'];
if (!$payload = verificar_token($jwt)) {
    cerrar_sesion();
    exit(1);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $precio_total = 0;
?>
    <h1>Carrito de <?= $payload['nombre'] ?></h1>
    <h2><?= $payload['correo'] ?></h2>
    <h3><?= $payload['hora'] ?></h3>


    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="submit" value="enviar">

    </form>
    <?php
    //recorro los objetos del carrito
    echo '<fieldset>';
    echo `<legend>Resumen de pedido</legend>`;

    foreach ($_SESSION['carrito'] as $key) {

        //recorro los apartados de cada objeto de carrito y los muestro por pantalla
        //echo `<p>{$value['producto_nombre']}</p>`;
        echo `<p>nombre: {$key['producto_nombre']}</p>`;
        echo `<p>precio: {$key['producto_precio']}</p>`;
        echo `<p>cantidad: {$key['cantidad']}</p>`;
        echo `<p>precio total: {$key['precio_unitario']}</p>`;

        //sumo los totales de precio
        $precio_total += $key['precio_unitario'];
        echo '<hr>';
    }

    echo '<fieldset>';

    echo `<h2>Precio total: $precio_total</h2>`;
    ?>

<?php

} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    cerrar_sesion();
    header('location: /exra426/inicial.php');
}

$ob_datos = ob_get_contents();
ob_flush();
fin_html();
?>