<?php

    class Servicos {

        public function mostrar($parametros) {
            $con = new PDO('mysql: host=locahost; dbname=netcar_sla;', 'dimitri', '@!@#rf');

            if (!empty($parametros)) {
                $sql = "SELECT * FROM servico where cd_servico =  " . $parametros;
            } else {
                $sql = "SELECT * FROM servico ORDER BY cd_servico ASC";
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
