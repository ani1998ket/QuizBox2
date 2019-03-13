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
            $user = isset($_SESSION['username']) ? $_SESSION['username'] : "";

            echo $this->twig->render("home.html", array(
                "title" => "QuizBox",
                "username" => $user,
            ));
        }
    }
?>