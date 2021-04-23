<?php
class Item
{
	private $db = null;
	function __construct()
	{
		$this->db = new DB();
	}

	function insertNew($name , $description, $imgURL, $price, $item_type, $category_id )
	{
		$sql = "INSERT INTO items (name , description, imgURL, price, item_type, category_id)
						VALUES ('$name' , '$description', '$imgURL', '$price', '$item_type', '$category_id')";

		return $this->db->executeNonQuery($sql);
	}

	function editItem($id, $name, $description, $imgURL, $price, $item_type, $category_id )
	{
		$sql = "update items set name = '$name',
										description = '$description',
										imgURL = '$imgURL',
										price = '$price',
										item_type = '$item_type',
										category_id = '$category_id'
										where id = '$id'";

		return $this->db->executeNonQuery($sql);
	}

	function deleteItem($id)
	{
		$sql = "delete from items where id = '$id'";
		return $this->db->executeNonQuery($sql);
	}

	function getItem($id)
	{
		$sql = "select * from items where id = '$id'";
		$result = $this->db->executeQuery($sql);

		if(gettype($result) == "object")
		{
			return $row = $result->fetch_assoc();
		}else{
			return 0;
		}
	}


	function showItemsTable($category_id , $item_type)
	{
		$data="";
		if($category_id == 0 &&  $item_type == 0)
		{
			$sql = "select * from items";
		}else{
			$cat = ($category_id  > 0) ? " category_id = $category_id "  : "";
			$type = ($item_type  > 0) ? " item_type = $item_type "  : "";
			if($category_id  > 0 && $item_type  > 0)
				$sql = "select * from items where $cat and $type";
			else if($category_id  > 0 && $item_type  == 0)
				$sql = "select * from items where $cat ";
			else
				$sql = "select * from items where $type ";
		}
		$result = $this->db->executeQuery($sql);

		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data = $data . "<tr>";
				$data = $data . " <td>".$row["name"]."</td>";
				$data = $data . " <td>".$row["price"]."</td>";
				$data = $data . " <td> <img src='../images/".$row["imgURL"]."' width='80px' height= '80px'></td>";
				$data = $data . " <td>".(($row["item_type"] == 1) ? "Product" : "Service")."</td>";

				$data = $data . " <td> <a href='item.php?action=edit&item_id=".$row["id"]."'>Edit</a></td>";
				$data = $data . " <td> <a href='item.php?action=delete&item_id=".$row["id"]."'>Delete</a></td>";
				$data = $data . "</tr>";
			}
			return $data;
		}
		else
			return "<tr><td colspan=3>No data available</td></tr>";
	}



	function getItems($category_id , $item_type)
	{
		$data= array();
		if($category_id == 0 &&  $item_type == 0)
		{
			$sql = "select * from items";
		}else{
			$cat = ($category_id  > 0) ? " category_id = $category_id "  : "";
			$type = ($item_type  > 0) ? " item_type = $item_type "  : "";
			if($category_id  > 0 && $item_type  > 0)
				$sql = "select * from items where $cat and $type";
			else if($category_id  > 0 && $item_type  == 0)
				$sql = "select * from items where $cat ";
			else
				$sql = "select * from items where $type ";
		}
		$result = $this->db->executeQuery($sql);
		$i = 0;
		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data[$i]["id"] =  $row["id"];
				$data[$i]["name"] =  $row["name"];
				$data[$i]["description"] =  $row["description"];
				$data[$i]["imgURL"] =  $row["imgURL"];
				$data[$i]["price"] =  $row["price"];
				$data[$i]["item_type"] =  $row["item_type"];
				$data[$i]["category_id"] =  $row["category_id"];
				$i++;
			}
		}
		return $data;
	}


}

?>
