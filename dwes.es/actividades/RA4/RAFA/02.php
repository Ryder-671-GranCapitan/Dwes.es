<?php

// Iniciamos la sesión
session_start();
//guardamos la hora de inicio de la sesión
if (!isset($_SESSION['inicio']) || $_SESSION['inicio'] == null) {
    $_SESSION['inicio'] = time();
    
}
//recogemos la cabeceras (echos y todo eso)
ob_start();

//fichero de funciones
require_once( $_SERVER['DOCUMENT_ROOT'] . '/includes/funciones.php');

//funcion para autenticar
function autenticar($usuario, $clave) {
    $usuarios = [
        'pepe' => [
            'nombre' => 'Pepe',
            'clave' => password_hash('usuario', PASSWORD_DEFAULT)]
        ];
        if (array_key_exists($usuario, $usuarios)) {
            return password_verify($clave, $usuarios[$usuario]['clave']);
        }
        return false;
    }
    
function generarToken($usuario, $clave) {

    $usuario = ['nombre' => $nombre,
                'clave' => $clave,
                'direccion' => $direccion,
                'telefono' => $telefono];
            
        $jwt =generarToken($usuario);
        setcookie('token', $jwt, time() + 60*60*24*);
    }
    

//recoger datos
$nombre = filter_input(INPUT_POST,'nombre', FILTER_SANITIZE_SPECIAL_CHARS);

$clave = $_POST['clave'];

//comprobamos si el usuario y la clave son correctos y si no lo son redirigimos a la página de logins
if (!autenticar($usuario, $clave)) {
    header('Location: 01.php');
    exit(1);
}

$direccion = filter_input(INPUT_POST,'direccion', FILTER_SANITIZE_SPECIAL_CHARS);
$telefono = filter_input(INPUT_POST,'telefono', FILTER_SANITIZE_NUMBER_INT);
$telefono = filter_var($telefono, FILTER_VALIDATE_INT);

if (!$telefono) {
    header('Location: 01.php');
    exit(2);
}



$_SESSION['ingredientes'] = [];

$vegetariana = filter_input(INPUT_POST, 'vegetariana', FILTER_VALIDATE_BOOLEAN);

$ingVeg = [
    ['nombre' => 'pepino', 'precio' => 1],
    ['nombre' => 'Calabacín', 'precio' => 1.50],
    ['nombre' => 'Pimiento verde', 'precio' => 1.25],
    ['nombre' => 'Pimiento rojo', 'precio' => 1.75],
    ['nombre' => 'Tomate', 'precio' => 1.50],
    ['nombre' => 'Aceitunas', 'precio' => 3.00],
    ['nombre' => 'Cebolla', 'precio' => 1.00]
];

$ingNoVeg = [
    ['nombre' => 'Atún', 'precio' => 2.00],
    ['nombre' => 'Carne picada', 'precio' => 2.50],
    ['nombre' => 'Peperoni', 'precio' => 1.75],
    ['nombre' => 'Morcilla', 'precio' => 2.25],
    ['nombre' => 'Anchoas', 'precio' => 1.50],
    ['nombre' => 'Salmón', 'precio' => 3.00],
    ['nombre' => 'Gambas', 'precio' => 4.00],
    ['nombre' => 'Langostinos', 'precio' => 4.00],
    ['nombre' => 'Mejillones', 'precio' => 2.00]
];

$ingredientes = $vegetariana ? $ingVeg : $ingNoVeg;


inicio_html('Ejercicio 4', ['/estilos/general.css']);


?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <fieldset>
        <legend>Introduce los ingredientes</legend>
        <label for="ingrediente">ingredientes</label>
        <select name="ingrediente" id="ingrediente">
            
       
    </fieldset>
    <input type="submit" value="siguiente ingrediente">
</form>
<?php

//recogemos los datos de ob en una variable
$ob_datos = ob_get_contents();

//borrar  todo el contenido del buffer de salida (que previamente hemos guardado en una variable)
ob_flush();

fin_html();

?>