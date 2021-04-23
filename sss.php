<?php
	$page_titel = "List of items ";
	include("template/header.htm");
	include("classes/Student.php");
	include("classes/Account.php");
	include("classes/Order.php");
	$studOb = new Student();
	$account = new Account();
	$order = new Order();

	$student_id = isset($_GET["student_id"])?$_GET["student_id"]:"0";

	if(isset($_GET['action']) && $_GET['action'] == "active")
	{
		if(isset($_GET['s']))
		{
			$studOb->setActive($_GET['student_id'] , $_GET['s']);
		}
	}

	if(isset($_POST['depoist']) && $_POST['depoist'] == "Deposit")
	{
		if(isset($_POST['amount']) && $_POST['amount']>0)
		{
			$amount = $_POST['amount'] ;
			$account->updateAccount($student_id, ($amount));
			$account->saveTrack($student_id, $amount );

		}
	}


	//$debt = $account->getStudentAmount($user_id);
	$amount = $account->getStudentAvailableAmount($student_id);
	$debt_limit = $account->getDebtLimit();
	$track = $account->getTrack($student_id);


	$data = $studOb ->getStudent($student_id);
	$orderList = $order->getOrders($student_id);


	$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	if($lang == "en"){
		$var1 = "Student Detail";
		$var2 = "Student Name";
		$var3 = "Academic ID";
		$var4 = "email";
		$var5 = "phone no";


		$var6 = "Student's Orders";
		$var7 = "No Orders Yet";
		$var8 = "Order Date";
		$var9 = "Total Amount";
		$var10 = "Payment Method";
		$var11 = "Order Details";
		$var12 = "Detail";
		$var13 = "Student's Account";
		$var14 = "The amount consumed";
		$var15 = "Your balance";
		$var16 = "Allow debt amount";
		$var17 = "Update student's account";
		$var18 = "Deposit to the student's account";
		$var19 = "Track Account";
		$var20 = "Pay Date";
		$var21 = "Amount";

	}else{
		$var1 = "تفاصيل  الطالب";
		$var2 = "اسم الطالب";
		$var3 = "الرقم الأكاديمي";
		$var4 = "البريد الالكتروني";
		$var5 = "رقم الهاتف";


		$var6 = "طلبات الطالب";
		$var7 = "لا يوجد طلبات بعد";
		$var8 = "تاريخ الطلب";
		$var9 = "الإجمالي";
		$var10 = "طريقة الدفع";
		$var11 = "تفاصيل الطب";
		$var12 = "تفاصيل";
		$var13 = "حساب الطالب";
		$var14 = "المبلغ المستهلك";
		$var15 = "رصيد";
		$var16 = "سقف السلفة المسموحة";
		$var17 = "تحديث حساب الطالب";
		$var18 = "ايداع الى حساب الطالب";
		$var19 = "سجل الحساب";
		$var20 = "تاريخ الدفع";
		$var21 = "المبلغ";
	}

?>
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid" style="<?=$dir;?>">
                <div class="row" >
                    <div class="col-lg-12">
                        <h1 class="page-header"><?=$var1?></h1>
                    </div>

                    <div class="col-lg-12">
                        <table width="100%" class="table">
							<thead>
								<tr role="row">

									<th><?=$var2?></th>
									<th><?=$var3?></th>
									<th><?=$var4?></th>
									<th><?=$var5?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?=$data["name"]?></td>
									<td><?=$data["academic_id"]?></td>
									<td><?=$data["email"]?></td>
									<td><?=$data["phone"]?></td>
								</tr>

							</tbody>
						</table>
                    </div>

                    <!-- /.col-lg-12 -->
                </div>
				</hr>
                <!-- /.row -->
                <div class="row" >
                    <div class="col-lg-12">
					</div>
				</div>
				<div class="row" style="display:flow-root">

					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="col-lg-12">
							<h3 class="page-header"><?=$var6?></h3>

						</div>
						<div  class="thumbnail">
							<div class="row">
								<?php
								if(!is_array($orderList) || sizeof($orderList) == 0)
								{
									?>
									<div class="col-sm-4 col-lg-4 col-md-4" >
										<div class="thumbnail">
											<h3 style="text-align:center;"><?=$var7?></h3>
										</div>
									</div>
									<?php
								}
								?>

								<table width="100%" class="table">
									<thead>
										<tr role="row">

											<th><?=$var8?></th>
											<th><?=$var9?></th>
											<th><?=$var10?></th>
											<th><?=$var11?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										for($i = 0; is_array($orderList) && $i<sizeof($orderList); $i++)
										{
											$pay_method =( $orderList[$i]["pay_method"] == "0")? "Cash":" Using Account ";

											?>
											<tr>
												<td> <?=$orderList[$i]['order_date']?> </td>
												<td><?=$orderList[$i]['total_amount']?> SR </td>
												<td> <?=$pay_method ?>  </td>
												<td><a href="order_details.php?oid=<?=$orderList[$i]["id"]?>&sid=<?=$student_id?>"><?=$var12?></a></td>
											</tr>
										<?php
										}

										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					 <div class="col-sm-6 col-lg-6 col-md-6">
						<div class="col-lg-12">
							<h3 class="page-header"><?=$var13?></h3>
						</div>
						<div class="thumbnail">
							<div >
								<b><?=$var14?>:</b> <?=($debt_limit - $amount)?>   SR</br>
								<b><?=$var15?>:</b> <?=$amount?>  SR</br>
								<b><?=$var16?>:</b> <?=$debt_limit?>  SR</br>
							</div>

							<hr/>
							<?=$var17?>
							<form action="" method="post">
								<label for="amount"><?=$var18?></label>
								<input type="number" min="0" value="0" name="amount" id = "amount" class="form-control">
								<input type="submit" value="Deposit" name="depoist" class="btn btn-default"/>
							</form>
							<div class="col-lg-12">
								<h3 class="page-header"><?=$var19?></h3>
							</div>
							<?php
							for($i = 0; is_array($track) && $i<sizeof($track); $i++)
							{
								?>
								<div class="col-sm-12 col-lg-12 col-md-12">
									<div class="thumbnail">
										<b><?=$var20?>:</b> <?=$track[$i]['pay_date']?> </br>
										<b><?=$var21?>:</b>  <?=$track[$i]['amount']?> SR</br>
									</div>
								</div>
								<?php
							}
							?>
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
