<?php

	include("template/header.htm");
include("admin/classes/upload.php");

	$db  = new DB();
	$db = $db->getConnection();

	$itemsList = array();

	$itemsList[0] = 1;


	$lang = isset($_GET["lang"])? $_GET["lang"] : "en";
	if($lang == "en"){
		$var0 = "Check Out";
		$var1 = "Select Account";
		$var2 = "Total Amount";
		$var2 = "Your dept";
		$var2 = "Allow Debt amount";
		$var2 = "Use my account";
		$var2 = "Cash on dilvery";

		$msg1 = "Couldn't complete the process";
		$msg2 = "Your account is not enough to complete process";

	}else{
		$var0 = "انهاء الطلب";
		$var1 = "اختر الحساب";
		$var2 = "المبلغ الإجمالي";
		$var2 = "المبلغ المتاح";
		$var2 = "المبلغ المسموح";
		$var2 = "استخدم حسابي";
		$var2 = "الدفع عند الاستلام";

		$msg1 = "لم نتمكن من اتمام العملية";
		$msg2 = "رصيدك غير كاف لاتمام العملية";
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
					<h3 style="text-align:center;">New Items</h3>
				</div>
                <!-- /.row -->
				<div class="row">
					<?php
					if(isset($_FILES["file"]) )
					{
						$img = uploadImg($_FILES);
					}
					else{
						$img = false;
					}
						if(!is_array($itemsList) || sizeof($itemsList) == 0)
						{
							?>
							<div class="col-sm-4 col-lg-4 col-md-4" >
								<div class="thumbnail">
									<h3 style="text-align:center;">No new Items</h3>
								</div>
							</div>
							<?php
						}

						for($i = 0; is_array($itemsList) && $i<sizeof($itemsList); $i++)
						{
							?>
							<div class="col-sm-4 col-lg-4 col-md-4">
								<div class="thumbnail">
									<a href="#"  style="margin:0 0 20px;">
										<img class="nspImage" src="images\1.jpg"  style="width:208px;height:135px;">
									</a>
									<canvas id="canvas" height="1"></canvas>
									<input type="file" id="file" name="file" accept="image/*"/>
									<div>
										<div class="caption" style="/*width:78%; float: left;*/">
											<h6><a href="#" title="" onclick="">
												Item title</a>
											</h6>
											[price: 10SR]

										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-4 col-lg-4 col-md-4">
								<div class="thumbnail">
									<a href="#"  style="margin:0 0 20px;">
										<img class="nspImage" src="images\1.jpg"  style="width:208px;height:135px;">
									</a>
									<div>
										<div class="caption" style="/*width:78%; float: left;*/">
											<h6><a href="#" title="" onclick="">
												Item title</a>
											</h6>
											[price: 10SR]

										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-4 col-lg-4 col-md-4">
								<div class="thumbnail">
									<a href="#"  style="margin:0 0 20px;">
										<img class="nspImage" src="images\1.jpg"  style="width:208px;height:135px;">
									</a>
									<div>
										<div class="caption" style="/*width:78%; float: left;*/">
											<h6><a href="#" title="" onclick="">
												Item title</a>
											</h6>
											[price: 10SR]

										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4 col-lg-4 col-md-4">
								<div class="thumbnail">
									<a href="#"  style="margin:0 0 20px;">
										<img class="nspImage" src="images\1.jpg"  style="width:208px;height:135px;">
									</a>
									<div>
										<div class="caption" style="/*width:78%; float: left;*/">
											<h6><a href="#" title="" onclick="">
												Item title</a>
											</h6>
											[price: 10SR]

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
