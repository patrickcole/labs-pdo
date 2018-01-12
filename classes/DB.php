<?php

    class DB {

        private static $instance = NULL;

        private function __construct(){

            // intentially left empty;
        }

        private function __clone(){

            // intentially left empty;
        }

        public static function getInstance(){

            if ( !self::$instance){

                self::$instance = new PDO("mysql:host=localhost;dbname=pdo_test", 'patrick', 'admin1');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            return self::$instance;
        }
    }

?>