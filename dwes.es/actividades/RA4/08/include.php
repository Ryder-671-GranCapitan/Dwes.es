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

?>