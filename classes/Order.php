<?php
class Order
{
	private $db = null;
	function __construct()
	{
		$this->db = new DB();
	}


	function  getOrders($studentID , $order_id = 0)
	{
		$data= array();
		$order = ( $order_id  == 0 ) ? "" : " and  id  = '$order_id'";
		$sql = "SELECT * FROM orders where student_id = '$studentID' $order ";
		$result = $this->db->executeQuery($sql);
		$i = 0;
		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data[$i]["id"] =  $row["id"];
				$data[$i]["student_id"] =  $row["student_id"];
				$data[$i]["pay_method"] =  $row["pay_method"];
				$data[$i]["order_date"] =  $row["order_date"];
				$data[$i]["total_amount"] =  $row["total_amount"];
				$i++;
			}
		}
		return $data;
	}



	function  getOrderDetail($studentID , $order_id)
	{
		$data= array();

		$sql = "SELECT * FROM items ,orders , `order_detail` where order_detail.item_id = items.id
		and student_id = '$studentID' and order_id = '$order_id' and orders.id = `order_detail`.`order_id`";
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
				$data[$i]["order_id"] =  $row["order_id"];
				$i++;
			}
		}
		return $data;
	}



	function  getTotalAmount($studentID)
	{
		$data= array();

		$sql = "SELECT * FROM items ,`order_detail` where order_detail.item_id = items.id and studentID = '$studentID'";
		$sum = 0;
		$result = $this->db->executeQuery($sql);
		$i = 0;
		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$sum =  $sum + ($row["price"] * $row["quantity"]);
			}
		}
		return $sum;
	}




	function editOrder($id, $name)
	{
		$sql = "update  order_detail set name = '$name',";

		return $this->db->executeNonQuery($sql);
	}


	function clear($studentID)
	{
			$sql = "delete from order_detail where  studentID = '$studentID'";
			$this->db->executeNonQuery($sql);
	}




	function  listOrders()
	{
		$data= "";
		$sql = "SELECT * FROM student , orders where student.id = orders.student_id order by  orders.id desc ";
		$result = $this->db->executeQuery($sql);
		$i = 0;
		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data = $data . "<tr>";
				$data = $data . " <td>".$row["name"]."</td>";
				$p = ($row["pay_method"] == "1")? "Cahs" : "Using Account";
				$data = $data . " <td>".$p."</td>";
				$data = $data . " <td>".$row["order_date"]."</td>";
				$data = $data . " <td>".$row["total_amount"]."</td>";


				$data = $data . " <td> <a href='stud_details.php?action=student&student_id=".$row["student_id"]."'>View Student's Info</a></td>";
				$data = $data . " <td> <a href='order_details.php?sid=".$row["student_id"]."&oid=".$row["id"]."'>View Order Detail</a></td>";
				$data = $data . "</tr>";
			}
			return $data;
		}
		else
			return "<tr><td colspan=3>No data available</td></tr>";

	}


}

?>
