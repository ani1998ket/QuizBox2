<?php
    namespace Controllers;
    use Models\Problems;
    use Models\Users;
    session_start();
    class ProblemsController{

        protected $twig;

        public function __construct(){
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
            $this->twig = new \Twig_Environment($loader);
        }

        public function get(){
            $user = isset($_SESSION['username']) ? $_SESSION['username'] : "";
            $isAdmin = Users::checkAdmin($user);
            $data = array("title" => "problems",
                            "username" => $user,
                            "questions" => Problems::getProblems(),
                            "isAdmin" => $isAdmin,
                        );
            echo $this->twig->render("problems.html", $data);
        }

    }
?>