<?php

    require_once './conexao/Conexao.php';

    class Servicos extends Conexao {

        public function mostrar($parametros) {

//            if (!empty($parametros)) {
//                $sql = "SELECT * FROM servico where cd_servico =  " . $parametros;
//            } else {
//            }
            $sql = "SELECT * FROM USUARIO";

            $con = Conexao::prepare($sql);

            $con->execute();


            $resultados = array();
            $i = 0;

            while ($row = $con->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => &$r) {
                    $r = utf8_encode($r);
                }

                $resultados[] = $row;
            }
            unset($r);

            if (!$resultados) {
                throw new Exception("Nenhum servico disponível!");
            }

            $con = NULL;
            return $resultados;
        }

    }
