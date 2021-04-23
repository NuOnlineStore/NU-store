<?php

	include("template/header.htm");
	include("admin/classes/Item.php");
	include("admin/classes/Category.php");
	include("admin/classes/Cart.php");

	$db  = new DB();
	$item  = new Item();
	$categ  = new Category();
	$cart  = new Cart();

	$resultArr = array();



	$item_id = isset($_GET["item_id"])?$_GET["item_id"]:"0";
	$user_id = isset($_GET["user_id"])?$_GET["user_id"]:"0";

	$itemsList = $cart->getCart($user_id);


	$lang = isset($_GET["lang"])? $_GET["lang"] : "en";
	if($lang == "en"){
		$var0 = "My Cart";
		$var1 = "No Items in Cart";
		$var2 = "price";
		$var3 = "QTY";

		$var4 = "Update";
		$var5 = "Delete";
		$var6 = "Check Out";

	}else{
		$var0 = "سلتي";
		$var1 = "لا يوجد عناصر في السلة";
		$var2 = "السعر";
		$var3 = "الكمية";

		$var4 = "تحديث";
		$var5 = "حذف";
		$var6 = "انهاء الطلب";

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
					$showBtn = true;
					if(!is_array($itemsList) || sizeof($itemsList) == 0)
					{
						$showBtn = false;
						?>
						<div class="col-sm-4 col-lg-4 col-md-4" >
							<div class="thumbnail">
								<h3 style="text-align:center;"><?=$var1?></h3>
							</div>
						</div>
						<?php
					}
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
								<?=$var2?>: <?=$itemsList[$i]['price']?> SR </br>
								<?=$var3?>: <input type="number" min = '1' value="<?=$itemsList[$i]['quantity']?>" id="qty_<?=$itemsList[$i]["item_id"]?>" style="width:50%"/>  </br>
							</div>
							<div style="margin-top: 90px;">
								<div style="width: 48%; float:right">
										<button type="button" onclick="update(<?=$itemsList[$i]["item_id"]?>)"   class="btn btn-default nu_btn"><?=$var4?></button>

								</div>
								<div style="width: 48%; float:left">
										<button type="button" onclick="deleteItem(<?=$itemsList[$i]["id"]?>)" class="btn btn-default nu_btn"><?=$var5?></button>

								</div>
							</div>
						</div>
					</div>
					<?php
					}
					if( $showBtn )
					{
					?>
						<button type="button" id="checkOutBtn" class="btn btn-default nu_btn"><?=$var6?></button>
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

		$( "#checkOutBtn" ).click(function() {
			JSReceiver.checkOut ();
		});

		function update(item_id ){
				load();
			 $id = "#qty_"+item_id;
			 quantity = $( $id ).val();
			 var values = "item_id="+item_id+"&user_id=<?=$user_id;?>&quantity="+quantity ;
			 $.ajax({
					url: "editCart.php",
					type: "post",
					data: values,
					success: function (response) {
						loadDismiss();
						if(response == "ok")
							JSReceiver.updateCartDone();
						else
							JSReceiver.updateCartError();

					},
					error: function(jqXHR, textStatus, errorThrown) {
					   console.log(textStatus, errorThrown);
					}
			});
		}


		function deleteItem(cart_item_id){
			 load();
			 var values = "cart_item_id="+cart_item_id ;
			 $.ajax({
					url: "deleteItemCart.php",
					type: "post",
					data: values,
					success: function (response) {
						loadDismiss();
						if(response == "ok")
							JSReceiver.deleteItemDone();
						else
							JSReceiver.addCartError();

					},
					error: function(jqXHR, textStatus, errorThrown) {
					   console.log(textStatus, errorThrown);
					}
			});
		}



		</script>
