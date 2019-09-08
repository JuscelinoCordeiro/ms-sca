<?php

    include_once './classes/Usuarios.php';

    $usuario = new Usuarios();
    echo '<pre>';
    print_r($usuario->existeUsuario($usuario));

    echo '--------------------<br><br>';
    print_r(json_encode($usuario->existeUsuario($usuario)));
