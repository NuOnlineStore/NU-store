<?php
	
	include("template/header.htm"); 
	include("admin/classes/Item.php");
	include("admin/classes/Category.php");
	
	$db  = new DB();
	$item  = new Item();
	$categ  = new Category();
	$db = $db->getConnection();
	
	$categ_id = isset($_GET["categ_id"]) ? $_GET["categ_id"] : "0";
	$item_type = isset($_GET["item_type"]) ? $_GET["item_type"] : "1";
	
	$itemsList = $item->getItems($categ_id , $item_type);
	
	
	$lang = isset($_GET["lang"])? $_GET["lang"] : "en";
	if($lang == "en"){
		$var0 = "New Items"; 
		$var1 = "No new Items"; 
		$var2 = "Type"; 
		$var3 = "price"; 
		$var4 = "in category"; 
		$var5 = "Product" ;
		$var6 = "Service";
	}else{ 
		$var0 = "عناصر جديدة في"; 
		$var1 = "لا يوجد عناصر"; 
		$var2 = "النوع"; 
		$var3 = "السعر"; 
		$var4 = "الفئة"; 
		$var5 = "منتج" ;
		$var6 = "خدمة";
	}
?>
<script>
		function load(){
			JSReceiver.loadProcess();
		}
		load();
		function loadDismiss(){
			JSReceiver.loadDismiss();
		}
	 
		
		function itemsDetailActivity(item_id){
			JSReceiver.itemsDetailActivity(item_id);
		}
		
		function categoryListActivity(categ_id, item_type){
			JSReceiver.categoryListActivity(categ_id, item_type);
		}
		
	
</script>
<style>
	.btnClass{
		background-color:#578ab9; 
		color:white; 
		width:100%;
		height:40px;
		border-radius:20px;
	}
</style>
<!-- Page Content -->
        <div id="page-wrapper">
           <div class="container-fluid">
				<?php
				$categ_label = "";
				if($categ_id > 0 )
				{
					$n = $categ->getCategory($categ_id) ["name"];
					$categ_label = " $var4 ($n)";
				}
				?>
                <div class="row">
					<h4 style="text-align:center;"><?=$var0?> <?=$categ_label?></h4>
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
						for($i = 0; is_array($itemsList) && $i<sizeof($itemsList); $i++)
						{ 
							
							?>
							<div class="col-sm-4 col-lg-4 col-md-4">
								<div class="thumbnail">
									<a href="#"  style="margin:0 0 20px;" onclick="itemsDetailActivity(<?=$itemsList[$i]['id']?>)">
										<img class="nspImage" src="images/<?=$itemsList[$i]['imgURL']?>"  style="width:208px;height:135px;">
									</a>
									<div>
										<div class="caption" style="/*width:78%; float: left;*/">
											<h6><a href="#" title="" onclick="itemsDetailActivity(<?=$itemsList[$i]['id']?>)">
												<?=$itemsList[$i]['name']?></a>
											</h6> 
											<h6>
												<b><?=$var2?>:</b>
												<?php
												echo ($itemsList[$i]['item_type'] == 1) ? "$var5" : " $var6";
												?>
											</h6> 
											<div style="width: 40%; float:left;">
											[<?=$var3?>: <?=$itemsList[$i]['price']?> SR]
											</div>
											<div style="float:right;" >
												<?php
													$categName = $categ->getCategory($itemsList[$i]['category_id']) ["name"];
												?>
												<a href="#" onclick="categoryListActivity(<?=$itemsList[$i]['category_id']?> , <?=$item_type?>)">
													[<?=$categName?> ]
												</a>
											</div> 
										</div>
									</div>
								</div>
							</div>
							
							<?php
						}						
					?>
				</div>
			</div>
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