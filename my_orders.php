<?php
		
	include("template/header.htm"); 
	include("admin/classes/Item.php");
	include("admin/classes/Category.php");
	include("admin/classes/Order.php");
	
	$db  = new DB();
	$item  = new Item();
	$categ  = new Category();
	$cart  = new Order(); 
	  
	 
	$user_id = isset($_GET["user_id"])?$_GET["user_id"]:"0";
	
	$orderList = $cart->getOrders($user_id); 
	
	
	$lang = isset($_GET["lang"])? $_GET["lang"] : "en";
	if($lang == "en"){
		$var0 = "My Orders"; 
		$var1 = "No Orders Yet"; 
		$var2 = "Cash"; 
		$var3 = "Using Account"; 
		
		$var4 = "Order Date"; 
		$var5 = "Total Amount"; 
		$var6 = "Payment Method"; 
		
		$var7 = "Detail";  
	}else{ 
		$var0 = "طلبياتي"; 
		$var1 = "لا يوجد طلبات بعد"; 
		$var2 = "عند الاستلام"; 
		$var3 = "استخدم حسابي"; 
		
		$var4 = "تاريخ الطلب"; 
		$var5 = "المبلغ الإجمالي"; 
		$var6 = "طريقة الدفع";  
		$var7 = "تفاصيل";  
	}
?>
	<script>
		function load(){
			JSReceiver.loadProcess();
		}
		
		function loadDismiss(){
			JSReceiver.loadDismiss();
		}
		  
		load();
	</script>
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
					<h4><?=$var0?></h4>
				</div>
                <!-- /.row -->
				<div class="row">		
					<?php
					if(!is_array($orderList) || sizeof($orderList) == 0)
					{
						?>
						<div class="col-sm-4 col-lg-4 col-md-4" >
							<div class="thumbnail">
								<h3 style="text-align:center;"><?=$var1?></h3>
							</div>
						</div>
						<?php
					}
					for($i = 0; is_array($orderList) && $i<sizeof($orderList); $i++)
					{ 
						$pay_method =( $orderList[$i]["pay_method"] == "0")? "$var2":" $var3 "; 
						
						?>				
					<div class="col-sm-4 col-lg-4 col-md-4">
						
						<div class="thumbnail">
							<div style="width: 73%; float:left; padding: 15px">
								<b><?=$var4?>:</b> <?=$orderList[$i]['order_date']?> </br>
								<b><?=$var5?>:</b> <?=$orderList[$i]['total_amount']?> SR </br> 
								<b><?=$var6?>:</b> <?=$pay_method ?>  </br> 
							</div>  
							<div style="width: 25%; float: left;">
								<button type="button" onclick="details(<?=$orderList[$i]["id"]?>)" 
										class="btn btn-default nu_btn" Style="margin-top:20px;"><?=$var7?></button>
							</div>
						</div>
					</div>
					<?php
					}
					
					?> 
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
        <!-- /#page-wrapper -->

		
	<?php 
	
	include("template/footer.htm");
	
	?>
		<script>
		$(document).ready(function() { 
			loadDismiss(); 
		}); 
		 
		function details(order_id ){
			//load(); 
			window.location = "order_details.php?order_id="+order_id+"&user_id=<?=$user_id;?>&lang=<?=$lang?>" ;  
		}
		   
		  
		 
		  
		</script>