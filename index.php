<?php

    require_once 'classes/Usuarios.php';
    require_once 'classes/Sistemas.php';

    if (isset($_REQUEST)) {
        echo Rest::open($_REQUEST);
    }

    class Rest {

        public static function open($requisicao) {

            @$url = explode('/', $requisicao['url']);

            @$classe = ucfirst($url[0]);
            array_shift($url);

            @$metodo = $url[0];
            array_shift($url);

            $json = file_get_contents('php://input');
            $parametros = isset($json) ? json_decode($json) : '';

//            print_r($parametros);
//            die();

            try {
                if (class_exists($classe)) {
                    if (method_exists($classe, $metodo)) {
                        $retorno = call_user_func(array(new $classe, $metodo), $parametros);
                        return json_encode(array('status' => '1', 'dados' => $retorno), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    } else {
                        return json_encode(array('status' => '0', 'dados' => 'Método inexistente!'));
                    }
                } else {
                    return json_encode(array('status' => '0', 'dados' => 'Classe inexistente!'));
                }
            } catch (Exception $e) {
                return json_encode(array('status' => '0', 'dados' => $e->getMessage()));
            }
        }

    }

?>
