<?php
		
	include("template/header.htm"); 
	include("classes/Item.php");
	include("classes/Category.php");
	include("classes/Order.php");
	
	$db  = new DB();
	$item  = new Item();
	$categ  = new Category();
	$orderOb  = new Order(); 
	 
	$resultArr = array();
	
	 
	 
	$oid = isset($_GET["oid"])?$_GET["oid"]:"0";
	$sid = isset($_GET["sid"])?$_GET["sid"]:"0";
	
	$itemsList = $orderOb->getOrderDetail($sid , $oid); 
	$order = $orderOb->getOrders($sid , $oid); 
	
	
	$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	if($lang == "en"){
		$var0 = "Order Details";
		$var1 = "No Items in Order"; 
		$var2 = "Cash";
		$var3 = "Using Account"; 
		$var4 = "price"; 
		$var5 = "QTY";   
	}else{ 
		$var0 = "تفاصيل الطلب";
		$var1 = "لا يوجد عناصر في الطلب"; 
		$var2 = "الدفع عند الاستلام";
		$var3 = "استخدام الحساب"; 
		$var4 = "السعر"; 
		$var5 = "الكمية";   
	}
?> 
<!-- Page Content -->
        <div id="page-wrapper" style="<?=$dir;?>">
            <div class="container-fluid">
                <div class="row">
					<h4><?=$var0?></h4>
				</div>
                <!-- /.row -->
				<div class="row">		
					<?php
					if(!is_array($itemsList) || sizeof($itemsList) == 0)
					{
						?>
						<div class="col-sm-12 col-lg-12 col-md-12" >
							<div class="thumbnail">
								<h3 style="text-align:center;"><?=$var1?></h3>
							</div>
						</div>
						<?php
					}
					$pay_method =( $order[0]["pay_method"] == "0")? "$var2":" $var3 "; 
						 
					for($i = 0; is_array($itemsList) && $i<sizeof($itemsList); $i++)
					{ 
						$item_type = $itemsList[$i]["item_type"]; 
						?>				
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="thumbnail">
							<div style="width: 30%; float: left;">
								<img class="nspImage" src="../images/<?=$itemsList[$i]['imgURL']?>"  style="width:80px;height:80px;">
							</div>
							<div style="width: 65%; float:right; padding: 15px">
								<b><?=$var4?>:</b> <?=$itemsList[$i]['price']?> SR </br>
								<b><?=$var5?>:</b>  <?=$itemsList[$i]['quantity']?> </br> 
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