<?php 
    
    namespace Models;

    class SignUp{

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

        public static function checkAndAddUser($fullname, $email, $username ,$password)
		{
            $db = self::getDB();
            
			$checkUser = $db->prepare("SELECT * FROM userbase WHERE user_name = :username");
			$checkUser->execute(array(
				"username"=>$username
            )) ;
            
            $row = $checkUser->fetch(\PDO::FETCH_ASSOC);
            
			if($row)
			{
				return true;
			}
			else
			{
                $password_hash = hash('sha256', $password);
                $query = "INSERT INTO userbase (full_name, email, user_name, password) 
                            VALUES (:fullname, :email, :username, :password_hash)";
                $addUser = $db->prepare($query) ;

				$row = $addUser->execute(array(
                    'username'=>$username,
                    'fullname' => $fullname,
                    'email' => $email,
					'password_hash'=>$password_hash
                ));
                
				return false;
			}
		}
    }
?>