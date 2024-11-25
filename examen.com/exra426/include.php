<?php
function autenticar($email, $clave) {
    $usuarios = [
        'pepe@gmail.com' => [
            'nombre' => 'José garcia',
            'clave' => password_hash("pepe123", PASSWORD_DEFAULT)
        ],
        'pepa@gmail.com' => [
            'nombre' => 'josefa marquez',
            'clave' => password_hash("pepa456", PASSWORD_DEFAULT)
        ]
    ];

    if (array_key_exists($email, $usuarios)) {
        return password_verify($clave, $usuarios[$email]['clave']);

    } else {
        return false;
    }
}



function cerrar_sesion() {
    $nombre_id = session_name();
    
    $parametros_cookie = session_get_cookie_params();

    setcookie($nombre_id, '', time() - 100000,
        $parametros_cookie['path'], $parametros_cookie['domain'],
        $parametros_cookie['secure'], $parametros_cookie['httponly']);

    session_unset();

    session_destroy();
}

?>
