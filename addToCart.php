<?php
	
	include("admin/classes/DB.php");
	include("admin/classes/Item.php");
	include("admin/classes/Cart.php");
	$db  = new DB();
	$cart  = new Cart();
	
	
	
	$user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : "0";
	$item_id = isset($_POST["item_id"]) ? $_POST["item_id"] : "0"; 
	$item_type = isset($_POST["item_type"]) ? $_POST["item_type"] : "0"; 
	
	if($cart->addItem($user_id, $item_id, $item_type,  1) )
	{
		echo "ok";
	}
	
?>
