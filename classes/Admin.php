<?php
class Admin
{
	private $db = null;
	private $userID = 0;
	
	function __construct($db)
	{
		$this->db = $db;
	}
	
	function userLogin($email, $pass)
	{
		
		$sql = "select * from admin where email = '$email' and `password`  = PASSWORD('$pass')";
		
		$result = $this->db->executeQuery($sql);
		
		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc()) 
			{
				$this->setUserID($row["id"]);
			}
			return 1;
		}else{
			return 0;
		}
	}
	
	function edit($email, $pass)
	{
		$sql = "update admin set  email = '$email', `password`  = PASSWORD('$pass')";
		return $this->db->executeNonQuery($sql);
	}
	
	function getUserID()
	{
		return $this->userID;
	}
	
	function setUserID($userID)
	{
		$this->userID = $userID;
	}
}

?>