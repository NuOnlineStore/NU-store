<?php
class Student
{
	private $db = null;
	function __construct()
	{
		$this->db = new DB();
	}

	function insertNew($name, $email, $pass,  $phone, $academic_id)
	{
		$sql = "INSERT INTO  student (	name, 	phone, email, `password`, academic_id)
				VALUES ('$name',  '$phone' , '$email', MD5('$pass'), '$academic_id')";

		return $this->db->executeNonQuery($sql);
	}

	function deleteStudent($id)
	{
		$sql = "delete from  student where id = '$id'";
		return $this->db->executeNonQuery($sql);
	}


	function getStudent($id)
	{
		$sql = "select * from  student where id = '$id'";
		$result = $this->db->executeQuery($sql);

		if(gettype($result) == "object")
		{
			return $row = $result->fetch_assoc();
		}else{
			return 0;
		}

	}


	function editStudent($id, $name, $email, $pass,  $phone, $academic_id)
	{
		$sql = "update  student set name = '$name', phone='$phone' , email='$email' , academic_id='$academic_id' ,
					`password`=MD5('$pass') where id = '$id'";

		return $this->db->executeNonQuery($sql);
	}

	function setActive($student_id , $status){
		$sql = "update  student set active = '$status' where id = '$student_id'";
		return $this->db->executeNonQuery($sql);
	}

	function showStudentsTable()
	{
		$data="";
		$sql = "select * from student";

		$result = $this->db->executeQuery($sql);

		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data = $data . "<tr>";
				$data = $data . " <td>".$row["name"]."</td>";
				$data = $data . " <td>".$row["academic_id"]."</td>";
				$data = $data . " <td>".$row["email"]."</td>";
				$data = $data . " <td>".$row["phone"]."</td>";
				$active = "";
				$act_status = 0;
				if($row["active"] == 0)
				{
					$active = "Click to active";
					$act_status = 1;
				}else{
					$active = "Disable account";
				}
				$data = $data . " <td><a href='?action=active&student_id=".$row["id"]."&s=$act_status'>".$active."</a></td>";

				$data = $data . " <td> <a href='stud_details.php?action=student&student_id=".$row["id"]."'>View</a></td>";
				$data = $data . "</tr>";
			}
			return $data;
		}
		else
			return "<tr><td colspan=3>No data available</td></tr>";
	}

	function search($studName)
	{
		$data="";
		$studName = ($studName == "") ? "/" : $studName;
		$sql = "select * from student where name like '$studName%'";

		$result = $this->db->executeQuery($sql);

		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data = $data . "<tr>";
				$data = $data . " <td>".$row["name"]."</td>";
				$data = $data . " <td>".$row["academic_id"]."</td>";
				$data = $data . " <td>".$row["email"]."</td>";
				$data = $data . " <td>".$row["phone"]."</td>";
				$active = "";
				$act_status = 0;
				if($row["active"] == 0)
				{
					$active = "Click to active";
					$act_status = 1;
				}else{
					$active = "Disable account";
				}
				$data = $data . " <td><a href='?action=active&student_id=".$row["id"]."&s=$act_status'>".$active."</a></td>";

				$data = $data . " <td> <a href='stud_details.php?action=student&student_id=".$row["id"]."'>View</a></td>";
				$data = $data . "</tr>";
			}
			return $data;
		}
		else
			return "<tr><td colspan=3>No data available</td></tr>";
	}





	function getUserID( $email){
		$query = "SELECT * FROM `student` where 	email = '$email' ";
		$data = array();

		$result = $this->db->executeQuery($query);

		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data["id"] = $row["id"];
			}
		}else{
			echo "<script>JSReceiver.showErrMessage(\"Error while fetch data\");</script>";
		}


		return $data;
	}


	function getRecoverByID(  $id){
		$query = "SELECT * FROM `recover_req` where 	id = '$id' ";
		$data = array();

		$result = $this->db->executeQuery($query);

		if(gettype($result) == "object")
		{
			while($row = $result->fetch_assoc())
			{
				$data["id"] = $row["id"];
				$data["email"] = $row["email"];
				$data["req_time"] = $row["req_time"];
			}
		}else{
			echo "<script>JSReceiver.showErrMessage(\"Error while fetch data\");</script>";
		}
		return $data;
	}


	function updatePass($id,  $pass)
	{
		$sql = "update  student set  `password`=MD5('$pass') where id = '$id'";

		return $this->db->executeNonQuery($sql);
	}

}

?>
