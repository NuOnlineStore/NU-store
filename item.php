<?php

	include("template/header.htm");
	include("classes/Category.php");
	include("classes/Item.php");
	include("classes/upload.php");

	$categOb = new Category();
	$itemOb = new Item();
	$item_id = isset($_GET['item_id']) ? $_GET['item_id'] : "0";
	$item_name  = isset($_POST['item_name'])?$_POST['item_name']:"";
	$description  = isset($_POST['description'])?$_POST['description']:"";
	$price  = isset($_POST['price'])?$_POST['price']:"";
	$item_type  = isset($_POST['item_type'])?$_POST['item_type']:"";
	$category_id  = isset($_POST['category_id'])?$_POST['category_id']:"";


	$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	if($lang == "en"){
		$var0 = "Add New Item";
		$var1 = "Item Name";
		$var2 = "Category";
		$var3 = "Product/Services";
		$var4 = "Product";
		$var5 = "Services";
		$var6 = "Description";
		$var7 = "Price";
		$var8 = "Item Image";
		$var9 = "Edit";
		$var10 = "Save";
		$var11 = "Delete";


		$msg1 = "Data updated..";
		$msg2 = "Are you sure to delete this item";
		$msg3 = "New item added to database successfully.";
	}else{
		$var0 = "اضافة عنصر جديد";
		$var1 = "اسم العنصر";
		$var2 = "الفئة";
		$var3 = "منتجات/خدمات";
		$var4 = "منتج";
		$var5 = "خدمة";
		$var6 = "الوصف";
		$var7 = "السعر";
		$var8 = "صورة العنصر";
		$var9 = "تعديل";
		$var10 = "حفظ";
		$var11 = "حذف";


		$msg1 = "تم تحديث البيانات..";
		$msg2 = "هل انت متأكد من حذف العصر";
		$msg3 = "تم اضافة عنصر جديد الى قاعدة البيانات.";
	}

	?>

	<!-- Page Content -->
        <div id="page-wrapper" style="<?=$dir;?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?=$var0?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row">


	<?php
	if(isset($_GET['action']) && $_GET['action']=="edit")
	{
		$item_id = $_GET['item_id'];
		$row = $itemOb->getItem($item_id);
		if(isset($_FILES["file"]) )
		{
			$img = uploadImg($_FILES);
		}
		else{
			$img = false;
		}

		if(isset($_POST['item_name']) && $_POST['item_name'] != ""  &&	$img!==false)
		{
			if($itemOb->editItem($item_id , $item_name , $description, $img, $price, $item_type , $category_id , $item_id ))
			{
				echo "<div class='info'>Data updated..</div>";
				unlink("../images/".$row["imgURL"]);
			}
		}else{
			$item_name = $row["name"];
			$description = $row["description"];
			$price = $row["price"];
			$item_type = $row["item_type"];
			$category_id = $row["category_id"];


	?>
			<form action="?action=edit&item_id=<?php echo $item_id;?>" method="post" enctype="multipart/form-data">
				<table width="100%" border="0">
					<tr>
						<td width="115"><?=$var1?>:</td>
						<td width="287">
						  <label><input type="text" name="item_name" class="form-control" id="item_name" value="<?php echo $item_name;?>" required>
							</label>
						</td>
					</tr>
					<tr>
						<td width="115"><?=$var2?>:</td>
						<td width="287">
							<select name="category_id" class="form-control" >
								<option value="0">....</option>
								<?php echo $categOb->getCategoriesOptions($category_id);?>
							</select>
						</td>
					</tr>

					<tr>
						<td width="115"><?=$var3?>:</td>
						<td width="287">
							<select name="item_type" class="form-control" >
								<option value="0">....</option>
								<option value="1"><?=$var4?></option>
								<option value="2"><?=$var5?></option>
							</select>
						</td>
					</tr>

					<tr>
						<td width="115"><?=$var6?>:</td>
						<td width="287">
						  <label><textarea  name="description" class="form-control"  id="editor" id="description" required><?php echo $description;?></textarea>
							</label>
						</td>
					</tr>
					<tr>
						<td width="115"><?=$var7?>:</td>
						<td width="287">
						  <label><input type="text" name="price" class="form-control" id="price" value="<?php echo $price;?>" required>
							</label>
						</td>
					</tr>
				</tr>
					<tr>
						<td width="115"><?=$var8?>:</td>
						<td width="287">
								<canvas id="canvas" height="1"></canvas>
								<input type="file" id="file" name="file" accept="image/*"/>
						</td>
					</tr>
				  </tr>

				  <tr>
					<td colspan="2" align="center">
						<input type="submit" class="btn btn-default" value="   <?=$var9?>   "/>
					</td>
				  </tr>
				</table>
			</form>
			</form>
	<?php
			}
	}else
	if(isset($_GET['action']) && $_GET['action']=="delete")
	{
			$item_id = $_GET['item_id'];
			$row = $itemOb->getItem($item_id);
			$item_name = $row["name"];
			if(isset($_POST['delete'])  )
			{
				if($itemOb->deleteItem($item_id )){
					unlink("../images/".$row["imgURL"]);
					echo "<div class='info'>Item ($item_name) deleted..</div>";
				}
			}else{

	?>
			<form action="?action=delete&item_id=<?php echo $item_id;?>" method="post" enctype="multipart/form-data">
				<table width="100%" border="0">

					<tr>
					<td colspan="2" align="center">
						<?=$msg2?> (<?=$item_name?>)?
					</td>
					</tr>
					<tr>
					<td colspan="2" align="center">
						<input type="submit" class="btn btn-default" value="   <?=$var11?>   " name="delete"/>
					</td>
				  </tr>
				</table>
			</form>
	<?php
			}
	}else
	{
		if(isset($_FILES["file"]) )
		{
			$img = uploadImg($_FILES);
		}
		else{
			$img = false;
		}


		if(isset($_POST['item_name']) && $_POST['item_name'] != ""  && $img!==false)
		{
			if($itemOb->insertNew($_POST['item_name'] ,$description, $img, $price, $item_type, $category_id ))
			{
				echo "<div class='info'>$msg3</div>";
			}
		}else{


	?>
			<form action="" method="post"  enctype="multipart/form-data" >
				<table width="100%" border="0">
					<tr>
						<td width="115"><?=$var1?>:</td>
						<td width="287">
						  <label><input type="text" name="item_name" class="form-control" id="item_name" value="<?php echo $item_name;?>" required>
							</label>
						</td>
					</tr>
					<tr>
						<td width="115"><?=$var2?>:</td>
						<td width="287">
							<select name="category_id" class="form-control" >
								<option value="0">....</option>
								<?php echo $categOb->getCategoriesOptions($category_id);?>
							</select>
						</td>
					</tr>

					<tr>
						<td width="115"><?=$var3?>:</td>
						<td width="287">
							<select name="item_type" class="form-control" >
								<option value="0">....</option>
								<option value="1"><?=$var4?></option>
								<option value="2"><?=$var5?></option>
							</select>
						</td>
					</tr>

					<tr>
						<td width="115"><?=$var6?>:</td>
						<td width="287">
						  <label><textarea  name="description" class="form-control"  id="editor" id="description" required><?php echo $description;?></textarea>
							</label>
						</td>
					</tr>
					<tr>
						<td width="115"><?=$var7?>:</td>
						<td width="287">
						  <label><input type="text" name="price" class="form-control" id="price" value="<?php echo $price;?>" required>
							</label>
						</td>
					</tr>
				</tr>
					<tr>
						<td width="115"><?=$var8?>:</td>
						<td width="287">
								<canvas id="canvas" height="1"></canvas>
								<input type="file" id="file" name="file" accept="image/*"/>
						</td>
					</tr>
				  </tr>

				  <tr>
					<td colspan="2" align="center">
						<input type="submit" class="btn btn-default" value="   <?=$var10?>   "/>
					</td>
				  </tr>
				</table>
			</form>

			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->



	<?php
			}
	}


include("template/footer.htm");

?>

<!--
config.language = 'es';
	config.uiColor = '#F7B42C';
	config.height = 300;
	config.toolbarCanCollapse = true;
	-->
<script src="ckeditor/ckeditor.js"></script>

<script>
	CKEDITOR.replace( 'editor', {
		width: '900',
		height: '400'
	});
</script>
