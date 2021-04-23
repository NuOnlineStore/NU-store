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
	$track = $account->getTrack($user_id);
	//$debt_amount = $debt_limit - 	$amount;
 //$balance = $debt_limit - $amount;
 	$con_amount =  $account->getStudentAmount($user_id);;




	$lang = isset($_GET["lang"])? $_GET["lang"] : "en";
	if($lang == "en"){
		$var0 = "My Account";
		$var1 = "The consumed amount ";
		$var2 = "Your balance";
		$var3 = "Allow debt amount";

		$var4 = "Account Track";
		$var5 = "Amount";

	}else{
		$var0 = "حسابي";
		$var1 = "المبلغ المستهلك";
		$var2 = "مبلغ الدين";
		$var3 = "الحد المسموح به للسلفة";

		$var4 = "سجل الحساب";
		$var5 = "المبلغ";

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

					<div class="col-sm-4 col-lg-4 col-md-4">
						<div class="thumbnail">
							<div >

								<b><?=$var1?>:</b> <?=$con_amount?>  SR</br>
								<b><?=$var2?>:</b> <?=$amount?>  SR</br>
								<b><?=$var3?>:</b> <?=$debt_limit?>  SR</br>
							</div>

						</div>
					</div>
				</div>
				<?php
					if(sizeof($track) > 0)
					{
						?>
						<div class="row">
							<h4><?=$var4?></h4>
						</div>
						<?php
					}
					for($i = 0; is_array($track) && $i<sizeof($track); $i++)
					{
						?>
						<div class="col-sm-4 col-lg-4 col-md-4">
							<div class="thumbnail">

								<div style="width: 100%; float:right; padding: 15px">
									<b><?=$var4?>:</b> <?=$track[$i]['pay_date']?> </br>
									<b><?=$var5?>:</b>  <?=$track[$i]['amount']?> SR</br>
								</div>
							</div>
						</div>
						<?php
					}

					?>
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
