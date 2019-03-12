<?php
    namespace Models;

        class Problems{    

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

            public static function getProblems(){
                
                $db = self::getDB();

                $sql = "SELECT * FROM questions";
                $questions = $db->prepare($sql);
                $questions->execute(array());
                $row = $questions->fetchAll();
                
                return $row;

            }
    }
?>