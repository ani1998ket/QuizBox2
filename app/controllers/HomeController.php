<?php
    namespace Controllers;
    session_start();
    
    class HomeController{
        
        protected $twig;

        public function __construct(){
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
            $this->twig = new \Twig_Environment($loader);
        }

        public function get(){
            $user = "";
            //find proper way to check session
            if(isset($_SESSION['username'])) {
                $user =  $_SESSION['username'];
            } 

            echo $this->twig->render("home.html", array(
                "title" => "QuizBox",
                "username" => $user
            ));
        }
    }
?>