<?php
	include("admin/classes/DB.php");
	
	$resultArr = array();
	$db  = new DB();
	$db = $db->getConnection();
	
	$UserName = $_POST["UserName"];
	$Email = $_POST['Email'];;
	$password = $_POST['Password'];
	$Phone = $_POST['Phone'];
	$academic_id = $_POST['academic_id'];
	$user_id = $_POST['user_id'];
	
	$sql_q = "update student  set name = '$UserName', 
								phone = '$Phone', 
								email = '$Email', 
								password = MD5('$password'), 
								academic_id = '$academic_id' 
								where id = '$user_id' ";
	
	if((isset($_POST['Email'])  && isset($_POST['Password'])) && (($_POST['Password'] != "" && $_POST['UserName'] != "")))
	{
            if ( !($result = mysqli_query ($db, $sql_q) ))
			{
				print("Could not execute query!  ");
				die ( mysql_error());
			}
			if ($result) 
			{
				array_push($resultArr,
					array('success'=>1));
				echo json_encode(array("result"=>$resultArr));
			} else {
				array_push($resultArr,
					array('success'=>0));
				echo json_encode(array("result"=>$resultArr));
			}
	}
	
?>