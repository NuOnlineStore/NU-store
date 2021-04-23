<?php
	$page_titel = "Categories ";
	include("template/header.htm");
	include("classes/Category.php");
	$categoryOb = new Category();
	$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : "0";

	$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	if($lang == "en"){
		$var1 = "List of categories";
		$var2 = "Category Name";
		$var3 = "Edit";
		$var4 = "Delete";
		$var5 = "Add New";
	}else{
		$var1 = "قائمة الفئات";
		$var2 = "اسم الفئة";
		$var3 = "تعديل";
		$var4 = "حذف";
		$var5 = "اضافة جديد";
	}

?>
<!-- Page Content -->
        <div id="page-wrapper" style="<?=$dir;?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?=$var1?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row" >
					<form action="" method="post">
						<table width="100%" class="table" >
							<thead>
								<tr role="row" >
									<th><?=$var2?></th>
									<th width="40"><?=$var3?></th>
									<th width="40"><?=$var4?></th>
								</tr>
							</thead>
							<tbody>
							<?php 	echo $categoryOb->showCategorysTable(); ?>

							<tr>
								<td colspan="2">
									<a href="category.php" class="btn btn-default"><?=$var5?></a>
								</td>
							</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
        <!-- /#page-wrapper -->

    <?php

	include("template/footer.htm");

	?>
