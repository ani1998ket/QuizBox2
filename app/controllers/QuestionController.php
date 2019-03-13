<?php
    namespace Controllers;
    use Models\Problems;
    use Models\Users;
    session_start();
    class QuestionController{

        protected $twig;

        public function __construct(){
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
            $this->twig = new \Twig_Environment($loader);
        }

        public function get($number){
            $user = isset($_SESSION['username']) ? $_SESSION['username'] : "";
            $isAdmin = Users::checkAdmin($user);
            $data = Problems::getQuestion($number);
            echo $this->twig->render("question.html", array(
                "title" => "Question".$number,
                "username" => $user,
                "q_id" => $data["id"],
                "q_text" => $data["question"],
                "attempted " => 0,
                "isAdmin" => $isAdmin,
            ));

        }

        public function post($number){
            $user = $_SESSION['username'];
            $answer = $_POST["answer"];

            $isCorrect = Problems::checkAnswer($number, $answer);
            $data = Problems::getQuestion($number);

            
            if($isCorrect){
                Users::addPoints($user,$data['points']);
            }
            echo $this->twig->render("question.html", array(
                "title" => "Question".$number,
                "q_id" => $data["id"],
                "q_text" => $data["question"],
                "attempted" => 1,
                "isCorrect" => $isCorrect,
            ));
            
        }
    }
?>