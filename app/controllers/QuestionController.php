<?php
    namespace Controllers;
    use Models\Problems;

    class QuestionController{

        protected $twig;

        public function __construct(){
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
            $this->twig = new \Twig_Environment($loader);
        }

        public function get($number){

            $data = Problems::getQuestion($number);
            echo $this->twig->render("question.html", array(
                "title" => "Question".$number,
                "q_id" => $data["id"],
                "q_text" => $data["question"],
                "attempted " => 0,
            ));

        }

        public function post($number){

            $answer = $_POST["answer"];
            $isCorrect = Problems::checkAnswer($number, $answer);
            $data = Problems::getQuestion($number);
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