<?php
class DB
{
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $db_name = "projects2021_shopping";
	private $conn = null;

	function __construct() {
		// Create connection
		$this->conn = new mysqli($this->servername, $this->username,$this->password, $this->db_name);
		return mysqli_query($this->conn, "set names utf8");
		// Check connection
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}
   }

	function getConnection()
	{
		return $this->conn;
	}

	function executeNonQuery($sql)
	{
		return mysqli_query($this->conn, $sql);
	}

	function getEffectedRows(){
		return mysqli_affected_rows($this->conn);
	}


	function getLastID(){
		return mysqli_insert_id($this->conn);
	}

	function executeQuery($query)
	{
		$result = $this->conn->query($query);
		if ($result->num_rows > 0) {
			return $result;
		}else{
			return 0;
		}
	}
}
?>
