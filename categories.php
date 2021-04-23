<?php

	include("template/header.htm");
	include("admin/classes/Item.php");
	include("admin/classes/Category.php");

	$db  = new DB();
	$item  = new Item();
	$categ  = new Category();
	$db = $db->getConnection();

	$categList = $categ->categories();

	$lang = isset($_GET["lang"])? $_GET["lang"] : "en";
	if($lang == "en"){
		$var0 = "Categories";

	}else{
		$var0 = "الفئات";
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

		function categoryListActivity(categ_id){
			JSReceiver.categoryListActivity(categ_id , 0);
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
                <div class="row">
					<h3 style="text-align:center;"><?=$var0?></h3>
				</div>
                <!-- /.row -->
				<div class="row">
					<?php
						for($i = 0; is_array($categList) && $i<sizeof($categList); $i++)
						{

							?>
							<div class="col-sm-4 col-lg-4 col-md-4">
								<div class="thumbnail">
									<a href="#"  style="margin:0 0 20px;" onclick="categoryListActivity(<?=$categList[$i]['id']?>)">
										<img class="nspImage" src="images/<?=$categList[$i]['img']?>"  style="width:208px;height:135px;">
									</a>
									<div>
										<div class="caption" style="text-align:center">
											<h6><a href="#" title="" onclick="categoryListActivity(<?=$categList[$i]['id']?>)">
												<?=$categList[$i]['name']?></a>
											</h6>
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
