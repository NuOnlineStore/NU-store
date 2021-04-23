<?php
	$page_titel = "List of items ";
	include("template/header.htm");
	include("classes/Student.php");
	include("classes/Order.php");
	$orderOb = new Order();
	$studOb = new Student();

	$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	if($lang == "en"){
		$var0 = "List of Orders";
		$var1 = "Student Name";
		$var2 = "Payment Method";
		$var3 = "Order Date";
		$var4 = "Order Amount";
		$var5 = "Student's Info";
		$var6 = "Order Details";
	}else{
		$var0 = "قائمة الطلبات";
		$var1 = "اسم الطالب";
		$var2 = "طريقة الدفع";
		$var3 = "تاريخ الطلبية";
		$var4 = "مبلغ الطلبية";
		$var5 = "بيانات الطالب";
		$var6 = "تفاصيل الطلب";
	}
?>
<!-- Page Content -->
        <div id="page-wrapper" style="<?=$dir;?>">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-lg-12">
                        <h1 class="page-header"><?=$var0?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row" style="display:flow-root">


						<table width="100%" class="table">
							<thead>
								<tr role="row">

									<th><?=$var1?></th>
									<th><?=$var2?></th>
									<th><?=$var3?></th>
									<th><?=$var4?></th>
									<th><?=$var5?></th>
									<th><?=$var6?></th>
								</tr>
							</thead>
							<tbody>
							<?php echo $orderOb->listOrders(); ?>

							</tbody>
						</table>
				
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
        <!-- /#page-wrapper -->

    <?php

	include("template/footer.htm");

	?>
