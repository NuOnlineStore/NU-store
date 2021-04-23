<?php

	include("template/header.htm");
	include("admin/classes/Item.php");
	include("admin/classes/Account.php");
	include("admin/classes/Cart.php");

	$db  = new DB();
	$item  = new Item();
	$account  = new Account();
	$cart  = new Cart();

	$resultArr = array();



	$user_id = isset($_GET["user_id"])?$_GET["user_id"]:"0";

	$totalAmount = $cart->getTotalAmount($user_id);
	$amount = $account->getStudentAvailableAmount($user_id);
	$debt_limit = $account->getDebtLimit();
	$debt = $account->getStudentAmount($user_id);


	$lang = isset($_GET["lang"])? $_GET["lang"] : "en";
	if($lang == "en"){
		$var0 = "Check Out";
		$var1 = "Select Account";
		$var2 = "Total Amount";
		$var3 = "Your dept";
		$var4 = "Allow Debt amount";
		$var5 = "Use my account";
		$var6 = "Cash on dilvery";

		$msg1 = "Couldn't complete the process";
		$msg2 = "Your account is not enough to complete process";

	}else{
		$var0 = "انهاء الطلب";
		$var1 = "اختر الحساب";
		$var2 = "المبلغ الإجمالي";
		$var3 = "مبلغ الدين";
		$var4 = "المبلغ المسموح";
		$var5 = "استخدم حسابي";
		$var6 = "الدفع عند الاستلام";

		$msg1 = "لم نتمكن من اتمام العملية";
		$msg2 = "رصيدك غير كاف لاتمام العملية";
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

						<div class="col-sm-4 col-lg-4 col-md-4" >
							<div class="thumbnail">
								<h3 style="text-align:center;"><?=$var1?></h3>
							</div>
						</div>
					<div class="col-sm-4 col-lg-4 col-md-4">
						<div class="thumbnail">
							<div >
								<?=$var2?>: <?=$totalAmount?> SR</br>
								<?=$var3?>: <?=$debt?>  SR</br>
								<?=$var4?>: <?=$debt_limit?>  SR</br>
							</div>
							<div style="margin-top: 90px;">
								<div style="width: 100%; float:right">
									<button type="button" onclick="my_account()"   class="btn btn-default nu_btn"><?=$var5?></button>

									<button type="button" onclick="cash()" class="btn btn-default nu_btn"><?=$var6?></button>

								</div>
							</div>
						</div>
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


		function my_account(item_id ){
			totalAmount = <?=$totalAmount?>;
			amount = <?=$amount?>;
			debt_limit = <?=$debt_limit?>;

			if(totalAmount < debt_limit)
			{
				if((amount == debt_limit) || (totalAmount+amount) <= debt_limit)
				{
					load();
					 var values = "user_id=<?=$user_id;?>&method=1&total="+totalAmount ;
					 $.ajax({
							url: "complete_checkout.php",
							type: "post",
							data: values,
							success: function (response) {
								loadDismiss();
								if(response == "ok")
									JSReceiver.checkOutDone();
								else
									JSReceiver.showErrMessage("<?=$msg1?>");

							},
							error: function(jqXHR, textStatus, errorThrown) {

								JSReceiver.showErrMessage(textStatus + " " + errorThrown);
							}
					});
				}else{
					//alert("<?=$msg2?>");
					JSReceiver.showErrMessage("<?=$msg2?>");
				}
			}else{
				//alert("<?=$msg2?>");
				JSReceiver.showErrMessage("<?=$msg2?>");
			}
		}
		 function doCashProcess(){
			totalAmount = <?=$totalAmount?>;
			 load();
				 var values = "user_id=<?=$user_id;?>&method=0&total="+totalAmount ;
				 $.ajax({
						url: "complete_checkout.php",
						type: "post",
						data: values,
						success: function (response) {
							loadDismiss();
							if(response == "ok")
								JSReceiver.checkOutDone();
							else
								JSReceiver.showErrMessage("<?=$msg1?>");

						},
						error: function(jqXHR, textStatus, errorThrown) {
						   
							JSReceiver.showErrMessage(textStatus + " " + errorThrown);
						}
				});
		 }


		function cash(){
			JSReceiver.cash();
			/*
			if (confirm('Are you sure you want to select cash on dilvery?')) {
				load();
				 var values = "user_id=<?=$user_id;?>&method=0&total="+totalAmount ;
				 $.ajax({
						url: "complete_checkout.php",
						type: "post",
						data: values,
						success: function (response) {
							loadDismiss();
							if(response == "ok")
								JSReceiver.checkOutDone();
							else
								JSReceiver.showErrMessage("Couldn't complete the process");

						},
						error: function(jqXHR, textStatus, errorThrown) {
						   //console.log(textStatus, errorThrown);
							JSReceiver.showErrMessage(textStatus + " " + errorThrown);
						}
				});
			} else {
			  // Do nothing!
			}
			 */
		}



		</script>
