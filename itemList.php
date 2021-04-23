<?php
	$page_titel = "List of items ";
	include("template/header.htm");
	include("classes/Item.php");
	include("classes/Category.php");
	$itemOb = new Item();
	$categOb = new Category();
	
	$category_id = isset($_POST["category_id"]) ? $_POST["category_id"]: 0;
	$item_type = isset($_POST["item_type"]) ? $_POST["item_type"]: 0;
	
	$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	if($lang == "en"){
		$var0 = "List of items";
		$var1 = "Filter By"; 
		$var2 = "Select Category";
		$var3 = "Select Type"; 
		$var4 = "Products"; 
		$var5 = "Services"; 		
		$var6 = "Item Name";   
		$var7 = "Price";   
		$var8 = "Image";   
		$var9 = "Type";   
		$var10 = "Edit";   
		$var11 = "Select";  
		$var12 = "Add New Item";  
		
	}else{ 
		$var0 = "قائمة العناصر";
		$var1 = "تصفية حسب"; 
		$var2 = "اختر الفئة";
		$var3 = "اختر النوع"; 
		$var4 = "منتجات"; 
		$var5 = "خدمات"; 		
		$var6 = "اسم العنصر";   
		$var7 = "السعر";   
		$var8 = "صورة العنصر";   
		$var9 = "النوع";   
		$var10 = "تعديل";   
		$var11 = "اختيار"; 
		$var12 = "اضافة عنصر جديد";  
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
				
                <div class="row">
                    <div class="col-lg-12">
						<form action="" method="post">
							<h2 class="page-header"><?=$var1?></h2>
							<div class="col-lg-6">
								<select name="category_id" onchange="form.submit();" class="form-control">
									<option value="0">-- <?=$var2?> --</option>
									<?php echo $categOb->getCategoriesOptions($category_id);?>
								</select>
							</div>
							<div class="col-lg-6">
								<select name="item_type" onchange="form.submit();" class="form-control">
									<option value="0">-- <?=$var3?> --</option> 
									<option value="1" <?=($item_type==1)?"selected":""?>><?=$var4?></option> 
									<option value="2" <?=($item_type==2)?"selected":""?>><?=$var5?></option> 
								</select>
							</div>
						</form>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
				<div class="row" style="display:flow-root">
					 
					<form action="deleteItems.php" method="post">
						<table width="100%" class="table">
							<thead>
								<tr role="row">
									
									<th><?=$var6?></th>
									<th><?=$var7?></th>
									<th><?=$var8?></th>
									<th><?=$var9?></th>
									<th width="40"><?=$var10?></th>            
									<th width="43"><?=$var11?></th>       
								</tr>
							</thead>
							<tbody>
							<?php echo $itemOb->showItemsTable($category_id , $item_type); ?>

							<tr>
								<td colspan="2">
									<a href="item.php" class="btn btn-default"><?=$var12?></a> 
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