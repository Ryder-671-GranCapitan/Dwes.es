<?php

function autenticar($usuario, $clave) {
    $usuarios = ['pepe' => ['email' => 'pepe@mail.com', 
                            'clave' => password_hash("usuario", PASSWORD_DEFAULT)],
                 'manolo' => ['email' => 'manolo@mail.com',
                              'clave' => password_hash("usuario", PASSWORD_DEFAULT)]
    ];


    if( array_key_exists($usuario, $usuarios) ) {
        return password_verify($clave, $usuarios[$usuario]['clave']);
    }
    else {
        return false;
    }                           
}


function cerrar_sesion() {
    
    // 1º Destruir el id de sesión
    $nombre_id = session_name();
    $parametros_cookie = session_get_cookie_params();
    setcookie($nombre_id, '', time() - 10000,
        $parametros_cookie['path'], $parametros_cookie['domain'],
        $parametros_cookie['secure'], $parametros_cookie['httponly'] );

    // 2º Destruir las variables de sesión
    session_unset();

    // 3º Destruir los datos de la sesión
    session_destroy();
}
?>