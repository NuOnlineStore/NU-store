<?php
	$page_titel = "Delete Item";
	include("template/header.htm");

	include("classes/Item.php");
	$sections = new Item();


	$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	if($lang == "en"){
		$var0 = "Delete Item";
		$var1 = "The selected sections will be deleted, are you sure?";
		$msg1 = "Item has been deleted successfully";

	}else{
		$var0 = "حذف عنصر";
		$var1 = "سيتم حذف العنصر المحدد، هل انت متأكد؟?";
		$msg1 = "تم حذف العنصر بنجاح..";
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
	if(isset($_POST['delete']) || isset($_POST['yes'])|| isset($_POST['no']))
	{
		if(isset($_POST['yes']))
		{
			$delete = true;
			for($i=0; $i< sizeof($_POST["course_id"]); $i++)
			{
				if($sections->deleteItem($_POST["course_id"][$i])){
					$itt = $_POST["course_id"][$i];
					echo "<div class='info'>$msg1 ($itt).</div>";
				}else{
					$delete = false;
				}
			}
			if($delete)
			{
				echo "<meta http-equiv='refresh' content='5; url=sectionsList.php?deletemsg=true'>";
			}
		}else if(isset($_POST['no'])){
			echo "<meta http-equiv='refresh' content='0; url=sectionsList.php'>";
		}else{
	?>
			<form action="" method="post" enctype="multipart/form-data">
				<table width="648" border="0">
				  <tr>
					<td width="115"><?=$var1?></td>
					<?php
					for($i=0; $i< sizeof($_POST["courseID"]); $i++)
					{
						$courseID = $_POST["courseID"][$i];
						$index = "courseID_".$courseID;
						if(isset($_POST[$index ]) )
						{
							echo "<input type='hidden' name='course_id[]' value='$courseID'/>";
						}
					}
					?>
				  </tr>
				  <tr>
					<td>
						<input type="submit" class="btn btn-default" value="   Yes   " name="yes"/>
						<input type="submit" class="btn btn-default" value="   No   " name="no"/>
					</td>
				  </tr>
				</table>
			</form>
	<?php
		}
	}
	?>
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->

	<?php

include("template/footer.htm");

?>
