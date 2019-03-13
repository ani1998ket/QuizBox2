<?php
    namespace Controllers;
    use Models\SignUp;
    session_start();
    class SignUpController{

        protected $twig;

        public function __construct(){
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
            $this->twig = new \Twig_Environment($loader);
        }

        public function get(){
            
            echo $this->twig->render("signup.html", array(
                "title" => "SignUp",
                "username" => $user,));
        }

        public function post(){

            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = SignUp::checkAndAddUser($fullname, $email, $username, $password);

            if($result){
                echo $this->twig->render("signup.html", array(
                    "title" => "SignUp",
                    "error" => "User already exists"
                ));
            }
            else{
                header("Location: /login");
                // echo $this->twig->render("signup.html", array(
                //     "title" => "SignUp",
                //     "error" => "User Successfully added"
                // ));
            }
        }
    }
?>