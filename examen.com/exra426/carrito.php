<?php
session_start();
ob_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/exra426/includes/funciones.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/exra426/includes/jwt_include.php');

require_once('include.php');

date_default_timezone_set('Europe/Madrid');

$productos = [
    'lata01' => [
        'nombre' => 'Lata de atún',
        'precio' => '3.5'
    ],
    'docena02' => [
        'nombre' => 'Docena de huevos',
        'precio' => '2.5'
    ],
    'garba03' => [
        'nombre' => 'Paquete de garbanzos',
        'precio' => '3.25'
    ],
    'morci04' => [
        'nombre' => 'Morcilla',
        'precio' => '4.15'
    ]
];

inicio_html('carrito', ['/exra426/estilos/general.css', '/exra426/estilos/bh.css', '/exra426/estilos/formulario.css', '/exra426/estilos/tablas.css']);


$jwt = $_COOKIE['jwt'];
if (!$payload = verificar_token($jwt)) {
    cerrar_sesion();
    exit(1);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $payload) {
    print_r($_SESSION['carrito']);

?>
    <h1>Compras de <?= $payload['nombre'] ?></h1>
    <h2><?= $payload['correo'] ?></h2>
    <h3><?= $payload['hora'] ?></h3>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset>
            <legend>Añadir producto</legend>
            <label for="producto">productos:</label>
            <select name="producto" id="producto">
                <?php foreach ($productos as $codigo => $datos) { ?>
                    <option value="<?= $codigo ?>"> <?= $datos['nombre'] ?> => <?= $datos['precio'] ?> </option>
                <?php
                }
                ?>

            </select>
            <label for="cantidad">cantidad deseada:</label>
            <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="100" require>

            <input type="submit" value="Añadir mas">
        </fieldset>

        <a href="final.php"> Tramitar pedido</a>
    </form>
<?php
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);

    // no es necesario validad el array porque se genera a raiz del propio array
    //guardo la clave del producto
    $producto_actual = filter_input(INPUT_POST, 'producto', FILTER_SANITIZE_SPECIAL_CHARS);

    //creo un array asociativo, donde:
    //producto es el producto completo (clave, nombre, precio)
    //precio_unitario es el precio multiplicado por la cantidad
    //cantidad la cantidad de elementos que se han comprado S

    $producto_actual = [
        'producto_nombre' => $productos[$producto_actual_clave]['nombre'],
        'producto_precio' => $productos[$producto_actual_clave]['precio'],

        'precio_unitario' => ($productos[$producto_actual_clave]['precio'] * $cantidad),
        'cantidad' => $cantidad
    ];

    //si no hay carrito lo creo vacio
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (!array_key_exists($producto_actual_clave, $_SESSION['carrito'])) {
        //si el producto no existe en el carrito, lo añado el ultimo
        $_SESSION['carrito'][] = $producto_actual;
    } else {
        //si existe en el carrito sustityo la clave
        $_SESSION['carrito'][$producto_actual_clave] = $producto_actual;
    }

    print_r($_SESSION['carrito']);

    header('location: /exra426/carrito.php');
}

$ob_datos = ob_get_contents();
ob_flush();
fin_html();
?>