<?php
class Category
{
	private $db = null;
	function __construct()
	{
		$this->db = new DB();
	}

	function insertNew($name , $img )
	{
		$sql = "INSERT INTO category (name , img) VALUES ('$name' , '$img')";
		return $this->db->executeNonQuery($sql);
	}


	function editCategory($id, $name, $img)
	{
		$sql = "update category set name = '$name', img = '$img'
										where id = '$id'";
		return $this->db->executeNonQuery($sql);
	}


	function deleteCategory($id)
	{
		$sql = "delete from category where id = '$id'";
		return $this->db->executeNonQuery($sql);
	}

	function getCategory($id)
	{
		$sql = "select * from category where id = '$id'";
		$result = $this->db->executeQuery($sql);

		if(gettype($result) == "object")
		{
			return $row = $result->fetch_assoc();
		}else{
			return 0;
		}

	}


	function getCategoriesOptions($id)
	{
		$sql = "select * from category ";
		$result = $this->db->executeQuery($sql);

		$data="";
		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$selected = ($row["id"] == $id) ? " selected " : "";
				$data = $data . " <option value='$row[id]' $selected>$row[name]</option>";
			}
		}
		return $data ;
	}


	function showCategorysTable()
	{
		$data="";
		$sql = "select * from category";
		$result = $this->db->executeQuery($sql);

		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data = $data . "<tr>";
				$data = $data . " <td>".$row["name"]."</td>";

				$data = $data . " <td> <a href='category.php?action=edit&category_id=".$row["id"]."'>Edit</a></td>";
				$data = $data . " <td> <a href='category.php?action=delete&category_id=".$row["id"]."'>Delete</a></td>";
				$data = $data . "</tr>";
			}
			return $data;
		}
		else
			return "<tr><td colspan=3>No data available</td></tr>";
	}

	function categories()
	{
		$data= array();
		$sql = "select * from category";
		$result = $this->db->executeQuery($sql);
		$i =0;
		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data[$i]["id"] =  $row["id"];
				$data[$i]["name"] =  $row["name"];
				$data[$i]["img"] =  $row["img"];
				$i++ ;
			}
		}
		return $data;
	}


}

?>
