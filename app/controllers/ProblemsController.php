<?php
    namespace Controllers;
    use Models\Problems;

    class ProblemsController{

        protected $twig;

        public function __construct(){
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
            $this->twig = new \Twig_Environment($loader);
        }

        public function get(){
            
            $data = array("title" => "problems",
                                "questions" => Problems::getProblems());
            echo $this->twig->render("problems.html", $data);
        }

    }
?>