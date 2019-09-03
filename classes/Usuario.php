<?php

    class Usuario {

        public function autenticar($parametros) {
            $con = new PDO('mysql: host=locahost; dbname=ms_sca;', 'dimitri', '@!@#rf');

//            VERIFICAR PERFIL DO USUARIO NO SISTEMA 

            if (!empty($parametros)) {
                $sql = "SELECT ID FROM USUARIO IDT = $parametros[0]  AND SENHA = $parametros[1]";
            }

            $sql = $con->prepare($sql);
            $sql->execute();

            $resultados = array();
            $i = 0;

            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
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
