<?php
    namespace Models;
    session_start();
    
    class Login{
        
        public function __construct(){
            
        }

        public function getDB(){
            include __DIR__."/../../configs/credentials.php";
            return new \PDO(   
                "mysql:dbname=".$db_connect['dbname'].
                ";host=".$db_connect['server'], $db_connect['username'],
                    $db_connect['password']
            );
        }

        public static function authenticate($username, $password){
            $db = self::getDB();
            $password_hash = hash('sha256', $password);
            $query = "SELECT * FROM userbase WHERE user_name =:username AND password =:password";
            $checkUser = $db->prepare($query);

            $checkUser->execute(array(
                "username" => $username,
                "password" => $password_hash
            ));


            $row = $checkUser->fetch(\PDO::FETCH_ASSOC);
            if($row){
                return true;
            }
            else{
                return false;
            }
        }
    };
?>