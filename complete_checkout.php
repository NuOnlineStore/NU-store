<?php
	
	include("admin/classes/DB.php");
	include("admin/classes/Item.php");
	include("admin/classes/Cart.php");
	include("admin/classes/Account.php");
	$db  = new DB();
	$cart  = new Cart();
	$account  = new Account();
	
	
	
	$user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : "0"; 
	$method = isset($_POST["method"]) ? $_POST["method"] : "0"; 
	$total = isset($_POST["total"]) ? $_POST["total"] : "0"; 
	
	if($cart->completeProcess($user_id , $method , $total) )
	{
		$cart->clear($user_id);
		if($method == 0)
		{
			echo "ok";
		}else{
			if($account->updateAccount($user_id, $total)){
				echo "ok";
			}else{
				echo "no";
			}
		}
	}
	
?>
