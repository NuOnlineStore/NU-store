<?php

	$page_titel = "";
	include("template/header.htm");
	include("classes/Category.php");
	include("classes/upload.php");

	$categoryOb = new Category();
	$category_title  = isset($_POST['category_title'])?$_POST['category_title']:"";
	$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : "0";


	$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	if($lang == "en"){
		$var1 = "Add New Category";
		$var2 = "Category Name";
		$var3 = "Category Image";
		$var4 = "Edit";
		$var5 = "Save";
		$msg1 = "Data updated..";
		$msg2 = "New category added to database successfully.";
		$msg3 = "Would you like to delete this category?";
		$msg4 = "Category is deleted.";
	}else{
		$var1 = "اضافة فئة جديدة";
		$var2 = "اسم الفئة";
		$var3 = "صورة الفئة";
		$var4 = "تعديل";
		$var5 = "حفظ";
		$msg1 = "تم تحديث البيانات..";
		$msg2 = "تم اضافة فئة جديدة الى قاعدة البيانات.";
		$msg3 = "هل ترغب في حذف هذه الفئة؟";
		$msg4 = "تم حذف الفئة";
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
				<div class="row">


	<?php
	if(isset($_GET['action']) && $_GET['action']=="edit")
	{
		if(isset($_FILES["file"]) )
		{
			$img = uploadImg($_FILES);
		}
		else{
			$img = false;
		}

		if(isset($_POST['category_title']) && $_POST['category_title'] != ""  && $img!==false)
		{
			if($categoryOb->editCategory($category_id ,$_POST['category_title'], $img ))
				echo "<div class='info'>$msg1</div>";
		}else{
			$category_id = $_GET['category_id'];
			$row = $categoryOb->getCategory($category_id);
			$category_title = $row["name"];


	?>
			<form action="?action=edit&category_id=<?php echo $category_id;?>" method="post" enctype="multipart/form-data">
				<table width="100%" border="0">
				   <tr>
					<td width="115"><?=$var2?>:</td>
					<td width="287">
					  <label><input type="text" name="category_title" class="form-control" id="category_title" value="<?php echo $category_title;?>" required>
						</label>
					</td>
				</tr>
				</tr>
					<tr>
						<td width="115"><?=$var3?>: </td>
						<td width="287">
								<canvas id="canvas" height="1"></canvas>
								<input type="file" id="file" name="file" accept="image/*"/>
						</td>

					</tr>
				  </tr>

				  <tr>
					<td colspan="2" align="center">
						<input type="submit" class="btn btn-default" value="   <?=$var4?>   "/>
					</td>
				  </tr>
				</table>
			</form>
			</form>
	<?php
			}
	}
	else if(isset($_GET['action']) && $_GET['action']=="delete")
	{
		if(isset($_POST['yes'])){
			$categoryOb->deleteCategory( $category_id);
			echo "<div class='info'>$msg4</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /#page-wrapper -->";
		}else if(isset($_POST['no'])){
			echo "<meta http-equiv='refresh' content='0; url=categoryList.php'>";
		}else{
		?>
			<form action="?action=delete&category_id=<?php echo $category_id;?>" method="post"  enctype="multipart/form-data" >
				<p><?=$msg3?></p>
				<input type="submit" name="yes" value="Yes"/>
				<input type="submit" name="no" value="No"/>
			</form>
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
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


		if(isset($_POST['category_title']) &&	$_POST['category_title'] != ""  && 	$img!==false)
		{
			if($categoryOb->insertNew($_POST['category_title'] , $img))
			{
				echo "<div class='info'>$msg2</div>";
			}
		}else{


	?>
			<form action="" method="post"  enctype="multipart/form-data" >
				<table width="100%" border="0">
				  <tr>
					<td width="115"><?=$var2?>:</td>
					<td width="287">
					  <label><input type="text" name="category_title" class="form-control" id="category_title" value="<?php echo $category_title;?>">
						</label>
					</td>
				</tr>

				</tr>
					<tr>
						<td width="115"><?=$var3?>:</td>
						<td width="287">
								<canvas id="canvas" height="1"></canvas>
								<input type="file" id="file" name="file" accept="image/*"/>
						</td>
					</tr>
				  </tr>

				  <tr>
					<td colspan="2" align="center">
						<input type="submit" class="btn btn-default" value="   <?=$var5?>   "/>
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
