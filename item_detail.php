<?php

	include("template/header.htm");
	include("admin/classes/Item.php");
	include("admin/classes/Category.php");

	$db  = new DB();
	$item  = new Item();
	$categ  = new Category();
	$db = $db->getConnection();

	$resultArr = array();



	$item_id = isset($_GET["item_id"])?$_GET["item_id"]:"0";
	$user_id = isset($_GET["user_id"])?$_GET["user_id"]:"0";

	$item = $item->getItem($item_id);
	$item_type = $item["item_type"];


	$lang = isset($_GET["lang"])? $_GET["lang"] : "en";
	if($lang == "en"){
		$var0 = "Details";
		$var1 = "Category";
		$var2 = "Add to cart";

	}else{
		$var0 = "تفاصيل العنصر";
		$var1 = "الفئة";
		$var2 = "اضف الى السلة";

	}
?>
	<script>
		function load(){
			JSReceiver.loadProcess();
		}

		function loadDismiss(){
			JSReceiver.loadDismiss();
		}

		function categoryListActivity(categ_id, item_type){
			JSReceiver.categoryListActivity(categ_id, item_type);
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
					<div class="col-sm-4 col-lg-4 col-md-4">

						<div class="thumbnail"  >
							<div >
								<div>
									<img class="nspImage" src="images/<?=$item['imgURL']?>"  style="width:100%;">

								</div>
								<div class="caption" style="width:75%; float: left;">
									<h6><a href="#" title=""><?php echo $item['name']; ?></a>
									</h6>

								</div>
								<div class="caption" style="width:22%; float: right;">
									<h6><?php echo $item['price']; ?> SR
									</h6>

								</div>

								<div style="clear:both;"></div>

								<h6><?php
											echo $item['description']; ?></h6>

								<div >
									<?php
										$categName = $categ->getCategory($item['category_id']) ["name"];
									?>
									<?=$var1?>: <a href="#" onclick="categoryListActivity(<?=$item['category_id']?>, <?=$item_type?>)"><?=$categName?> </a>

								</div>

								<div style="clear:both;"></div>
							</div>
						</div>
						<button type="button" id="addBtn" class="btn btn-default nu_btn"><?=$var2?></button>
					</div>

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
		$( "#addBtn" ).click(function() {

				addToCart ();
		});


		function addToCart(){
				load();
			 var values = "item_id=<?=$item_id?>&item_type=<?=$item_type?>&user_id=<?=$user_id;?>" ;
			 $.ajax({
					url: "addToCart.php",
					type: "post",
					data: values,
					success: function (response) {
						loadDismiss();
						if(response == "ok")
							JSReceiver.addCartDone();
						else
							JSReceiver.addCartError();

					},
					error: function(jqXHR, textStatus, errorThrown) {
					   console.log(textStatus, errorThrown);
					}
			});
		}

		</script>
