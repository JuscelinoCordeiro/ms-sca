<?php

    require_once './conexao/Conexao.php';

    class Usuarios extends Conexao {

        public function existeUsuario($usuario) {

            $sql = "SELECT ID FROM USUARIO WHERE IDENTIDADE = :idt and SENHA = :senha";
            $exec = Conexao::prepare($sql);
            $exec->bindValue(':idt', $usuario->identidade);
            $exec->bindValue(':senha', $usuario->senha);
            $exec->execute();

            Conexao::fechar();
            return $exec->fetch();
        }

        public function getPerfil($usuario) {

            $sql = "SELECT P.ID, P.PERFIL FROM PERFIL P
                    INNER JOIN PERFIL_SISTEMA PS ON P.ID = PS.PERFIL_ID
                    INNER JOIN USUARIO_PERFIL UP ON UP.PERFIL_ID = P.ID
                    WHERE UP.USUARIO_ID = :usuario_id AND PS.SISTEMA_ID = :sistema_id AND PS.ATIVO = 1";
            $exec = Conexao::prepare($sql);
            $exec->bindValue(':usuario_id', $usuario->id);
            $exec->bindValue(':sistema_id', $usuario->sistema_id);
            $exec->execute();

            Conexao::fechar();
            return $exec->fetch();
        }

        //=========================================
        public function autenticar($parametros) {
            $con = new PDO('mysql: host=locahost; dbname=ms_sca;', 'dimitri', '@!@#rf');

//            VERIFICAR PERFIL DO USUARIO NO SISTEMA

            if (!empty($parametros)) {
//                $sql = "SELECT ID FROM USUARIO IDT = $parametros[0]  AND SENHA = $parametros[1]";
                $sql = "SELECT ID FROM USUARIO IDT = '123456'  AND SENHA = '456'";
            }
            echo $sql;

            $sql = $con->prepare($sql);
            $sql->execute();

            $id = $sql->fetchObject();
            print_r($id);
            die();

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
//            return $resultados;
        }

        public function autenticar2($parametros) {
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

    /*
     * verificar se o usuario existe
     * verificar se pode acessar o sistema
     *
     * retornar o perfil ou msg de erro
     */