<?php
	include("admin/classes/DB.php");
	
	$resultArr = array();
	$db  = new DB();
	$db = $db->getConnection();
	$count = 0 ;
	$Email = $_POST['Email'];
	$UserPass_Val = $_POST['UserPass'];
	
	$sql_q = "select * from student where email = '$Email' and `password` = MD5('$UserPass_Val')";	
	
	//echo $sql_q;
	
	if((isset($_POST['Email'])  && isset($_POST['UserPass'])) && (($_POST['Email'] != "" && $_POST['UserPass'] != "")))
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
				while($row = mysqli_fetch_array($result))
				{

					array_push($resultArr,
						array('id'=>$row["id"],
						'name'=>$row["name"],
						'active'=>$row["active"]
					));
					$count ++;
				}
				if($count>0)
					echo json_encode(array("result"=>$resultArr));
				else
				{
					$resultArr = array();
					array_push($resultArr,
						array('success'=>0));
					echo json_encode(array("result"=>$resultArr));
				}					
			} else {
				array_push($resultArr,
					array('success'=>0));
				echo json_encode(array("result"=>$resultArr));
			}
	}
	
?>