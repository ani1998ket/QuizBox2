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

            public function addQuestion($question, $answer, $points){
                $db = self::getDB();

                $query = "INSERT INTO `questions`( `question`, `answer`, `points`) 
                            VALUES (:question, :answer, :points)";
                $questions = $db->prepare($query);
                $questions->execute(array(
                    "question" => $question,
                    "answer" => $answer,
                    "points" => $points
                ));

               

            }
            public static function getProblems(){
                
                $db = self::getDB();

                $sql = "SELECT * FROM questions";
                $questions = $db->prepare($sql);
                $questions->execute();
                $row = $questions->fetchAll();
                
                return $row;

            }
            public static function getQuestion($q_id){
                
                $db = self::getDB();

                $sql = "SELECT * FROM questions WHERE id = $q_id";
                $questions = $db->prepare($sql);
                $questions->execute();
                $row = $questions->fetch();
                
                return $row;

            }

            public static function checkAnswer($q_id, $answer){
                
                $db = self::getDB();

                $sql = "SELECT * FROM questions WHERE id = $q_id AND answer = '$answer'" ;
                $questions = $db->prepare($sql);
                $questions->execute();
                $row = $questions->fetch();
                
                if($row){
                    return true;
                }
                else{
                    return false;
                }

            }




    }
?>