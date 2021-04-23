<?php
class Cart
{
	private $db = null;
	function __construct()
	{
		$this->db = new DB();
	}

	function addItem($studentID, $item_id, $item_type,  $quantity)
	{
		$sql_update = "update cart set quantity = quantity+1 where item_id = $item_id and studentID = $studentID";
		$this->db->executeNonQuery($sql_update);
		if($this->db->getEffectedRows() == 0){
			$sql = "INSERT INTO  cart (	studentID, 	item_id, item_type, `quantity`, add_date)
					VALUES ('$studentID',  '$item_id' , '$item_type', '$quantity', now())";

			return $this->db->executeNonQuery($sql);
		}
		else
			return true;
	}

	function editItem($studentID, $item_id, $item_type,  $quantity)
	{
		$sql_update = "update cart set quantity = '$quantity' where item_id = $item_id and studentID = $studentID";
		return $this->db->executeNonQuery($sql_update);
	}

	function deleteItemCart($id)
	{
		$sql = "delete from  cart where id = '$id'";
		return $this->db->executeNonQuery($sql);
	}



	function  getCart($studentID)
	{
		$data= array();

		$sql = "SELECT * FROM items ,`cart` where cart.item_id = items.id and studentID = '$studentID'";
		$result = $this->db->executeQuery($sql);
		$i = 0;
		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data[$i]["id"] =  $row["id"];
				$data[$i]["item_id"] =  $row["item_id"];
				$data[$i]["name"] =  $row["name"];
				$data[$i]["description"] =  $row["description"];
				$data[$i]["imgURL"] =  $row["imgURL"];
				$data[$i]["price"] =  $row["price"];
				$data[$i]["item_type"] =  $row["item_type"];
				$data[$i]["quantity"] =  $row["quantity"];
				$data[$i]["category_id"] =  $row["category_id"];
				$i++;
			}
		}
		return $data;
	}



	function  getTotalAmount($studentID)
	{
		$data= array();

		$sql = "SELECT * FROM items ,`cart` where cart.item_id = items.id and studentID = '$studentID'";
		$sum = 0;
		$result = $this->db->executeQuery($sql);

		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$sum =  $sum + ($row["price"] * $row["quantity"]);
			}
		}
		return $sum;
	}



	function completeProcess($studentID , $method , $total){
		$sql = "insert into orders (student_id , pay_method,  order_date, total_amount)
			values ('$studentID', $method, now() ,'$total' )";
		if($this->db->executeNonQuery($sql)){
			$orderID = $this->db->getLastID();

			$sql = "SELECT * FROM items ,`cart` where cart.item_id = items.id and studentID = '$studentID'";
			$result = $this->db->executeQuery($sql);

			if(gettype($result) == "object")
			{
				while($row = $result->fetch_assoc())
				{
					$item_id =  $row["item_id"];
					$price =  $row["price"];
					$quantity = $row["quantity"];

					$sql = "insert into order_detail (order_id,  item_id , quantity, price)
					 values('$orderID' , '$item_id ' , '$quantity', '$price')";
					$this->db->executeNonQuery($sql);

				}
				return true;
			}
		}
		return false;
	}

	function clear($studentID)
	{
			$sql = "delete from cart where  studentID = '$studentID'";
			$this->db->executeNonQuery($sql);
	}
}

?>
