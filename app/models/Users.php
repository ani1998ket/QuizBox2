<?php
    namespace Models;
    session_start();
    
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
    };
?>