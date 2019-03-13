<?php
    namespace Controllers;
    use Models\Problems;
    use Models\Users;

    session_start();
    class AdminController{

        protected $twig;

        public function __construct(){
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
            $this->twig = new \Twig_Environment($loader);
        }

        public function get(){
            $user = isset($_SESSION['username']) ? $_SESSION['username'] : "";
            
            if(Users::checkAdmin($user)){
                echo $this->twig->render("adminPortal.html", array(
                    "title" => "AdminPortal",
                ));
            }
            else{
                echo "Not admin";
            }
        }

        public function post(){
            $question = $_POST['question'];
            $points = $_POST['points'];
            $answer = $_POST['answer'];

            Problems::addQuestion($question, $answer, $points);

            $this->get();
        }
    }
?>