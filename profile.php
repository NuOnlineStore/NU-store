<?php
	include("admin/classes/DB.php");
	include("admin/classes/Student.php");

	$resultArr = array();
	$db  = new DB();
	$student = new Student();
	$db = $db->getConnection();

	$user_id = $_POST["user_id"];
	$data = $student->getStudent($user_id);
	if( $_POST['user_id'] > 0 )
	{
		array_push($resultArr, array('success'=>1));

		array_push($resultArr,
		array('id'=>$data["id"],
				'name'=>$data["name"],
				'email'=>$data["email"],
				'phone'=>$data["phone"],
				'academic_id'=>$data["academic_id"]
			));


		echo json_encode(array("result"=>$resultArr));


	}else{
		array_push($resultArr,
			array('success'=>0));
		echo json_encode(array("result"=>$resultArr));
	}

?>
