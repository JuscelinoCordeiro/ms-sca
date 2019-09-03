<?php

    header('Content-Type: application/json; charset=UTF-8', TRUE);

    require_once 'classes/Servicos.php';

    class Rest {

        public static function open($requisicao) {
            $url = explode('/', $requisicao['url']);

            $classe = ucfirst($url[0]);
            array_shift($url);

            $metodo = $url[0];
            array_shift($url);

            $parametros = array();
            $parametros = $url;


            try {
                if (class_exists($classe)) {
                    if (method_exists($classe, $metodo)) {
                        $retorno = call_user_func_array(array(new $classe, $metodo), $parametros);
                        return json_encode(array('status' => 'sucesso', 'dados' => $retorno), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                    } else {
                        return json_encode(array('status' => 'erro', 'dados' => 'Método inexistente!'));
                    }
                } else {
                    return json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'));
                }
            } catch (Exception $e) {
                return json_encode(array('status' => 'erro', 'dados' => $e->getMessage()));
            }
        }

    }

    if (isset($_REQUEST)) {
        echo Rest::open($_REQUEST);
    }
?>
