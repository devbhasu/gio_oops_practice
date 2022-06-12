<?php 

namespace App;
use PDO;
use PDOException;

class Db{
    private $host = 'localhost';
    private $user = 'root';
    private $pwd = '';
    private $dbname = 'oopspractice';
    protected function connect(){
        $dsn = 'mysql:host='. $this->host . ';dbname=' .$this->dbname;
       try {
            $pdo = new PDO ($dsn, $this->user, $this->pwd);
        
            if ($pdo) {
               // echo "Connected to the database successfully!<br>";
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
                return $pdo;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
}