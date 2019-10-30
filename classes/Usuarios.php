<?php

    require_once './conexao/Conexao.php';

    class Usuarios extends Conexao {

        public function cadastrarUsuario($usuario) {

            Conexao::iniciarTransacao();

            $sql1 = "INSERT INTO USUARIO (NOME, IDENTIDADE, SENHA) VALUES (:nome, :idt, :senha)";
            $exec = Conexao::prepare($sql1);
            $exec->bindValue(':nome', $usuario->nome);
            $exec->bindValue(':idt', $usuario->identidade);
            $exec->bindValue(':senha', $usuario->senha);
            $result1 = $exec->execute();

            $sql2 = "SELECT MAX(ID) ID FROM USUARIO";
            $exec2 = Conexao::prepare($sql2);
            $exec2->execute();
            $usuario_id = $exec2->fetch(PDO::FETCH_OBJ);

            $sql3 = "INSERT INTO USUARIO_PERFIL (USUARIO_ID, PERFIL_ID, SISTEMA_ID)  VALUES (:usuario_id, :perfil_id, :sistema_id)";
            $exec3 = Conexao::prepare($sql3);
            $exec3->bindValue(':usuario_id', $usuario_id->ID);
            $exec3->bindValue(':perfil_id', $usuario->perfil);
            $exec3->bindValue(':sistema_id', $usuario->sistema_id);
            $result3 = $exec3->execute();

            $sql4 = "INSERT INTO USUARIO_SISTEMA (USUARIO_ID, SISTEMA_ID, ATIVO) VALUES (:usuario_id, :sistema_id, :ativo)";
            $exec4 = Conexao::prepare($sql4);
            $exec4->bindValue(':usuario_id', $usuario_id->ID);
            $exec4->bindValue(':sistema_id', $usuario->sistema_id);
            $exec4->bindValue(':ativo', 1);
            $result4 = $exec4->execute();

            $retorno = FALSE;
            if ($result1 && $result3 && $result4) {
                Conexao::commit();
                $retorno = TRUE;
            } else {
                Conexao::rollback();
            }

            Conexao::fechar();
            return $retorno;
        }

        public function autenticar($usuario) {

            $sql = "SELECT ID FROM USUARIO U
                    INNER JOIN
                    USUARIO_SISTEMA US ON U.ID = US.USUARIO_ID
                    WHERE
                    U.IDENTIDADE = :idt
                    AND U.SENHA = :senha
                    AND US.SISTEMA_ID = :sistema_id
                    AND US.ATIVO = 1;";
            $exec = Conexao::prepare($sql);
            $exec->bindValue(':idt', $usuario->identidade);
            $exec->bindValue(':senha', $usuario->senha);
            $exec->bindValue(':sistema_id', $usuario->sistema_id);
            $exec->execute();
            $dados = $exec->fetch();

            Conexao::fechar();
            return $dados;
        }

        public function existeUsuario($usuario) {

            $sql = "SELECT ID FROM USUARIO WHERE IDENTIDADE = :idt and SENHA = :senha";
            $exec = Conexao::prepare($sql);
            $exec->bindValue(':idt', $usuario->identidade);
            $exec->bindValue(':senha', $usuario->senha);
            $exec->execute();
            $dados = $exec->fetch();

            Conexao::fechar();
            return $dados;
        }

        public function trocarSenha($usuario) {

            Conexao::iniciarTransacao();

            $sql = "UPDATE USUARIO SET SENHA = :senha WHERE IDENTIDADE = :idt AND SENHA = :senha_antiga";
            $exec = Conexao::prepare($sql);
            $exec->bindValue(':idt', $usuario->identidade);
            $exec->bindValue(':senha', $usuario->senha);
            $exec->bindValue(':senha_antiga', $usuario->senha_antiga);
            $exec->execute();
            $retorno = ($exec->rowCount() > 0) ? TRUE : FALSE;

            if ($retorno) {
                Conexao::commit();
            } else {
                Conexao::rollback();
            }

            Conexao::fechar();
            return $retorno;
        }

        public function desativarUsuario($dados) {

            Conexao::iniciarTransacao();

            $sql = "SELECT ID FROM USUARIO WHERE IDENTIDADE = :idt";
            $exec = Conexao::prepare($sql);
            $exec->bindValue(':idt', $dados->identidade);
            $exec->execute();
            $usuario_id = $exec->fetch(PDO::FETCH_OBJ);

            $sql2 = "UPDATE USUARIO_SISTEMA SET ATIVO = 0 WHERE USUARIO_ID = :usuario_id AND SISTEMA_ID = :sistema_id";
            $exec2 = Conexao::prepare($sql2);
            $exec2->bindValue(':usuario_id', $usuario_id->ID);
            $exec2->bindValue(':sistema_id', $dados->sistema_id);
            $result = $exec2->execute();

            $retorno = ($exec2->rowCount() > 0) ? TRUE : FALSE;

            if ($retorno) {
                Conexao::commit();
            } else {
                Conexao::rollback();
            }

            Conexao::fechar();
            return $retorno;
        }

        public function ativarUsuario($dados) {

            Conexao::iniciarTransacao();

            $sql = "SELECT ID FROM USUARIO WHERE IDENTIDADE = :idt";
            $exec = Conexao::prepare($sql);
            $exec->bindValue(':idt', $dados->identidade);
            $exec->execute();
            $usuario_id = $exec->fetch(PDO::FETCH_OBJ);

            $sql2 = "UPDATE USUARIO_SISTEMA SET ATIVO = 1 WHERE USUARIO_ID = :usuario_id AND SISTEMA_ID = :sistema_id";
            $exec2 = Conexao::prepare($sql2);
            $exec2->bindValue(':usuario_id', $usuario_id->ID);
            $exec2->bindValue(':sistema_id', $dados->sistema_id);
            $result = $exec2->execute();

            $retorno = ($exec2->rowCount() > 0) ? TRUE : FALSE;

            if ($retorno) {
                Conexao::commit();
            } else {
                Conexao::rollback();
            }

            Conexao::fechar();
            return $retorno;
        }

        public function getPerfil($usuario) {

            $sql = "SELECT DISTINCT P.ID, P.PERFIL FROM PERFIL P
                    INNER JOIN PERFIL_SISTEMA PS ON P.ID = PS.PERFIL_ID
                    INNER JOIN USUARIO_PERFIL UP ON UP.PERFIL_ID = P.ID
                    INNER JOIN USUARIO U ON U.ID = UP.USUARIO_ID
                    WHERE U.IDENTIDADE = :idt AND UP.SISTEMA_ID = :sistema_id AND PS.ATIVO = 1";
            $exec = Conexao::prepare($sql);
            $exec->bindValue(':idt', $usuario->identidade);
            $exec->bindValue(':sistema_id', $usuario->sistema_id);
            $exec->execute();
            $dados = $exec->fetch();

            Conexao::fechar();
            return $dados;
        }

        public function getUsuario($dados) {

            $sql = "SELECT * FROM USUARIO WHERE ID = :usuario_id";
            $exec = Conexao::prepare($sql);
            $exec->bindValue(':usuario_id', $dados->usuario_id);
            $exec->execute();

            $dados = $exec->fetch();

            Conexao::fechar();
            return $dados;
        }

        public function getDadosUsuario($dados) {

            $sql = "SELECT * FROM USUARIO WHERE IDENTIDADE = :identidade";
            $exec = Conexao::prepare($sql);
            $exec->bindValue(':identidade', $dados->identidade);
            $exec->execute();

            $dados = $exec->fetch();

            Conexao::fechar();
            return $dados;
        }

        public function getUsuarios() {

            $sql = "SELECT * FROM USUARIO";
            $exec = Conexao::prepare($sql);
            $exec->execute();
            $dados = $exec->fetchAll();

            Conexao::fechar();
            return $dados;
        }

    }

?>
