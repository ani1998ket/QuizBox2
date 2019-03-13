<?php
    
    namespace Controllers;
    use Models\Users;
    session_start();

    class LeaderBoardController{

        protected $twig;

        public function __construct(){
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
            $this->twig = new \Twig_Environment($loader);
        }

        public function get(){
            $user = isset($_SESSION['username']) ? $_SESSION['username'] : "";
            echo $this->twig->render("leaderboard.html", array(
                "title" => "QuizBox",
                "dataList" => Users::getUsers(),
                "username" => $user,
            ));
        }
    }
?>