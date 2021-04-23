<?php

	include("template/header.htm");
	include("admin/classes/Item.php");
	include("admin/classes/Category.php");
	include("admin/classes/Order.php");

	$db  = new DB();
	$item  = new Item();
	$categ  = new Category();
	$orderOb  = new Order();

	$resultArr = array();



	$order_id = isset($_GET["order_id"])?$_GET["order_id"]:"0";
	$user_id = isset($_GET["user_id"])?$_GET["user_id"]:"0";

	$itemsList = $orderOb->getOrderDetail($user_id , $order_id);
	$order = $orderOb->getOrders($user_id , $order_id);

	$lang = isset($_GET["lang"])? $_GET["lang"] : "en";
	if($lang == "en"){
		$var0 = "My Order Details";
		$var1 = "No Items in Orders";
		$var2 = "Order Date";
		$var3 = "Total Amount";
		$var4 = "Payment Method";
		$var5 = "price";
		$var6 = "QTY";
		$var7 = "Cash";
		$var8 = "Using Account";
	}else{
		$var0 = "تفاصيل طلبيتي";
		$var1 = "لا يوجد عناصر في الطلب";
		$var2 = "تاريخ الطلب";
		$var3 = "المبلغ الإجمالي";
		$var4 = "طريقة الدفع";
		$var5 = "السعر";
		$var6 = "الكمية";
		$var7 = "عند الاستلام";
		$var8 = "استخدم حسابي";
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
					if(!is_array($itemsList) || sizeof($itemsList) == 0)
					{
						?>
						<div class="col-sm-4 col-lg-4 col-md-4" >
							<div class="thumbnail">
								<h3 style="text-align:center;"><?=$var1?></h3>
							</div>
						</div>
						<?php
					}
					$pay_method =( $order[0]["pay_method"] == "0")? "Cash":" Using Account ";

						?>
					<div class="col-sm-4 col-lg-4 col-md-4">
						<div class="thumbnail">
							<div style="width: 100%; float:left; padding: 15px">
								<b><?=$var2?>:</b> <?=$order[0]['order_date']?> </br>
								<b><?=$var3?>:</b> <?=$order[0]['total_amount']?> SR </br>
								<b><?=$var4?>:</b> <?=$pay_method ?>  </br>
							</div>
						</div>
					</div>
					<?php
					for($i = 0; is_array($itemsList) && $i<sizeof($itemsList); $i++)
					{
						$item_type = $itemsList[$i]["item_type"];
						?>
					<div class="col-sm-4 col-lg-4 col-md-4">
						<div class="thumbnail">
							<div style="width: 30%; float: left;">
								<img class="nspImage" src="images/<?=$itemsList[$i]['imgURL']?>"  style="width:100%;height:80px;">
							</div>
							<div style="width: 65%; float:right; padding: 15px">
								<b><?=$var5?>:</b> <?=$itemsList[$i]['price']?> SR </br>
								<b><?=$var6?>:</b>  <?=$itemsList[$i]['quantity']?> </br>
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




		</script>
