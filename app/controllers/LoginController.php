<?php
    namespace Controllers;
    use Models\Login;
    session_start();

    class LoginController{

        protected $twig;

        public function __construct(){
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
            $this->twig = new \Twig_Environment($loader);
        }

        public function get(){
            $user = isset($_SESSION['username']) ? $_SESSION['username'] : "";
            echo $this->twig->render("login.html", array(
                "title" => "Login",
            ));
        }

        public function post(){

            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = Login::authenticate($username, $password);

            if($result){
                $_SESSION['username'] = $username;
                header("Location: /");
            }
            else{
                echo $this->twig->render("login.html", array(
                    "title" => "Login",
                    "error" => "Invalid username or password"
                ));
            }
        }
    }
?>