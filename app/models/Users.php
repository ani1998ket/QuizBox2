<?php
    namespace Models;
    
    class Users{
        
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

        public static function getUsers(){
            $db = self::getDB();
            $query = "SELECT * FROM userbase ORDER BY points DESC";
            $checkUser = $db->prepare($query);

            $checkUser->execute();

            $row = $checkUser->fetchAll();
            return $row;
        }

        public static function addPoints($user, $points){
            $db = self::getDB();
            $query = "UPDATE userbase SET points = points + $points WHERE user_name = :user";
            $data = $db->prepare($query);
            $data->execute(array(
                "user" => $user,
            ));
        }
    };
?>