<?php
/**
 * User: Moxie5
 * Author: Dobromir Dobrev
 * Created with educational purposes 
 */

namespace App\Library;

use PDO;

class DataBase
{

    private $dbh;
    private $error;

    public function __construct()
    {
        if(!empty($_ENV['DB_HOST']) || !empty($_ENV['DB_NAME']) || !empty($_ENV['DB_USER']) || !empty($_ENV['DB_PASS'])) {
            $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
            $option = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            try {
                $this->dbh = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], $option);
            } catch (\PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }
    }

    //Prepare query 

    public function query($sql)
    {
        if($this->dbh != '') {
            $this->stmt = $this->dbh->prepare($sql);
        }
    }

    //Bind Values

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //Execute statment
    public function execute()
    {
        if($this->dbh != '') {
            return $this->stmt->execute();
        }
    }

    //Return multiple records
    public function resultAll()
    {
        if($this->dbh != '') {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }
    //Return a single record
    public function single()
    {
        if($this->dbh != '') {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }
    }
    //Get row count
    public function rowCount()
    {
        if($this->dbh != '') {
            return $this->stmt->rowCount();
        }
    }

    function __destruct() {
        try {
            $this->dbh = null; //Closes connection
        } catch (PDOException $e) {
            file_put_contents("Date: " . date('M j Y - G:i:s') . " ---- Error: " . $e->getMessage().PHP_EOL, FILE_APPEND);
            die($e->getMessage());
        }
    }
}
