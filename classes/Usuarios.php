<?php

    require_once './conexao/Conexao.php';

    class Usuarios extends Conexao {

        public function cadastrarUsuario($usuario) {

            $sql1 = "INSERT INTO USUARIO (NOME, IDENTIDADE, SENHA) VALUES (:nome, :idt, :senha)";
            $exec = Conexao::prepare($sql1);
            $exec->bindValue(':nome', $usuario->nome);
            $exec->bindValue(':idt', $usuario->identidade);
            $exec->bindValue(':senha', $usuario->senha);
            $result1 = $exec->execute();

//            if ($result1) {
            $sql2 = "SELECT MAX(ID) ID FROM USUARIO";
            $exec = Conexao::prepare($sql2);
            $exec->execute();
            $usuario_id = $exec->fetch(PDO::FETCH_OBJ);
            print_r($usuario_id);
//            }
//            die('pausado');
            $sql3 = "INSERT INTO USUARIO_PERFIL (USUARIO_ID, PERFIL_ID)  VALUES (:usuario_id, :perfil_id)";
            $exec = Conexao::prepare($sql3);
            $exec->bindValue(':usuario_id', $usuario_id->ID);
            $exec->bindValue(':perfil_id', $usuario->perfil);
            $result3 = $exec->execute();

            Conexao::fechar();
//            return $exec->fetch();
            return TRUE;
        }

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

    }

    /*
     * verificar se o usuario existe
     * verificar se pode acessar o sistema
     *
     * retornar o perfil ou msg de erro
     */