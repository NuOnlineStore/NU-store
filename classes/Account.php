<?php
class Account
{
	private $db = null;
	function __construct()
	{
		$this->db = new DB();
	}
	/*
	function addItem($studentID, $item_id, $item_type,  $quantity)
	{
		$sql_update = "update student_id set quantity = quantity+1 where item_id = $item_id and studentID = $studentID";
		$this->db->executeNonQuery($sql_update);
		if($this->db->getEffectedRows() == 0){
			$sql = "INSERT INTO  account (	studentID, 	item_id, item_type, `quantity`, add_date)
					VALUES ('$studentID',  '$item_id' , '$item_type', '$quantity', now())";

			return $this->db->executeNonQuery($sql);
		}
		else
			return true;
	}*/



	function  getDebtLimit()
	{

		$sql = "SELECT * FROM debt_limit";

		$result = $this->db->executeQuery($sql);
		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				return $row["limit_amount"];
			}
		}
		return 0;
	}


	function  getStudentAvailableAmount($id)
	{
		$debt = $this->getDebtLimit();

		$sql = "SELECT * FROM `account` where student_id = '$id'";
		$amount=0;
		$result = $this->db->executeQuery($sql);
		if(gettype($result) == "object")
		{

			while($row = $result->fetch_assoc())
			{
				return ($debt - $row["amount"]);
			}
		}
		return $amount;
	}

	function  getStudentAmount($id)
	{
		$debt = $this->getDebtLimit();

		$sql = "SELECT * FROM `account` where student_id = '$id'";
		$amount = 0;
		$result = $this->db->executeQuery($sql);
		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				return ($row["amount"]);
			}
		}
		return $amount;
	}




	function updateAccount($student_id, $amount)
	{
		$sql = "update  account set amount = amount - '$amount' where student_id = '$student_id' ";
		$this->db->executeNonQuery($sql);
		if($this->db->getEffectedRows()	 == 0)
		{
			$sql = "insert into account (student_id, amount ) values ( '$student_id' , '$amount')";
			return $this->db->executeNonQuery($sql);
		}else{
			return true;
		}
	}


	function saveTrack($student_id, $amount ){
		$sql = "insert into account_track (student_id, amount, pay_date ) values ( '$student_id' , '$amount', now())";
		return $this->db->executeNonQuery($sql);
	}

	function  getTrack($studentID)
	{
		$data= array();

		$sql = "SELECT * FROM account_track where student_id = '$studentID' order by id desc";
		$result = $this->db->executeQuery($sql);
		$i = 0;
		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data[$i]["id"] =  $row["id"];
				$data[$i]["amount"] =  $row["amount"];
				$data[$i]["pay_date"] =  $row["pay_date"];
				$i++;
			}
		}
		return $data;
	}

}

?>
