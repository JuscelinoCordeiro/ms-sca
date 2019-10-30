<?php

    require_once 'config.php';

    class Conexao {

        private static $instance;

        public static function getInstance() {
            if (!isset(self::$instance)) {
                try {
                    self::$instance = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
                    self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                    self::$instance->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
                    //var_dump(self::$instance->query('SELECT @@autocommit')->fetchAll());
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
            return self::$instance;
        }

        public static function prepare($sql) {
            return self::getInstance()->prepare($sql);
        }

        public static function fechar() {
            self::$instance = NULL;
        }

        public static function iniciarTransacao() {
            self::getInstance()->beginTransaction();
        }

        public static function commit() {
            self::getInstance()->commit();
        }

        public static function rollback() {
            self::getInstance()->rollback();
        }

    }

?>