<?php

    require_once './conexao/Conexao.php';

    class Sistemas extends Conexao {

//    listar todos os sistemas
        public function getSistemas() {
            $sql = "SELECT * FROM SISTEMA ORDER BY ID ASC";
            $exec = Conexao::prepare($sql);
            $exec->execute();

            Conexao::fechar();
            return $exec->fetchAll();
        }

        public function getSistema($id) {
            $sql = "SELECT * FROM SISTEMA WHERE ID = :id";
            $exec = Conexao::prepare($sql);
            $exec->bindValue(':id', $id);
            $exec->execute();

            Conexao::fechar();
            return $exec->fetch();
        }

        public function cadastrarSistema($dados) {
            try {
                $sql = "INSERT INTO SISTEMA (SISTEMA, ATIVO, DESCRICAO) VALUES (:sistema, :ativo, :descricao)";
                $exec = Conexao::prepare($sql);
                $exec->bindValue(':sistema', $dados['sistema']);
                $exec->bindValue(':ativo', $dados['status']);
                $exec->bindValue(':descricao', $dados['descricao']);
                $exec->execute();

                $exec->rowCount();
                Conexao::fechar();
//            return $exec->fetch();
            } catch (PDOException $e) {
                echo $exc->getMessage();
            }
        }

        public function editarSistema($dados) {
            try {
                $sql = "INSERT INTO SISTEMA (SISTEMA, ATIVO, DESCRICAO) VALUES (:sistema, ;ativo, :descricao)";
                $exec = Conexao::prepare($sql);
                $exec->bindValue(':sistema', $dados['sistema']);
                $exec->bindValue(':ativo', $dados['ativo']);
                $exec->bindValue(':descricao', $dados['descricao']);
                $exec->execute();

                $exec->rowCount();
                Conexao::fechar();
//            return $exec->fetch();
            } catch (PDOException $e) {
                echo $exc->getMessage();
            }
        }

    }

?>