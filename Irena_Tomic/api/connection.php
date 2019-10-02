<?php
//Konekcija na bazu i postavlljanje parametra potrebni za konekciju. Klasa koja posjeduje metodu getConnstring, odnosno pozivom te medote se povezuje aplikacija na bazu.
class Connection{
    /* Database connection start */
	var $servername = "localhost";
	var $username = "root";
	var $password = "";
	var $dbname = "hr";  
	var $conn;

	function getConnstring() {

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Problem sa konekcijom: " . $exception->getMessage();
        }

        return $this->conn;
	}

}


?>
