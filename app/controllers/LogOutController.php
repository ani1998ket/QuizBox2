<?php
    namespace Controllers;
    session_start();
    class LogOutController{
        public function __construct(){

        }

        public function get(){
            session_destroy();
            header("Location: /");
        }
    }
?>