<?php

/*
* Database Class
*/

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        $dsn = 'mysql:host='. $this->host . ';dbname='. $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    //Prepare the query for binding//
    public function query($query) {
        $this->stmt= $this->dbh->prepare($query);
    }
    //bind the query according to the value given to INSERT//
    public function bind($param, $value, $type= null){
        if (is_null($type)) {
            switch (true){
                case is_int($value): 
                    $type= PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type= PDO::PARAM_BOOL;
                    break;
                default:
                    $type= PDO::PARAM_STR;
                    break;
                } 
            }
            $this->stmt->bindValue($param,$value,$type);
        }
    //Only execute//
    public function execute(){
        return $this->stmt->execute();
        }
  
    


    //Get result as array of objects//
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //Get single result //
    public function single(){
        $this-> execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    //Get the rows count//
    public function rowCount(){
        $this-> execute();
        return $this->stmt->rowCount();
    }
}

