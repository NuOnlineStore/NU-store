<?php
	$page_titel = "List of Students ";
	include("template/header.htm");
	include("classes/Student.php");
	$studOb = new Student();
	if(isset($_GET['action']) && $_GET['action'] == "active")
	{
		if(isset($_GET['s']))
		{
			$studOb->setActive($_GET['student_id'] , $_GET['s']);
		}
	}

	$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	if($lang == "en"){
		$var1 = "List of Students";
		$var2 = "Student Name";
		$var3 = "Academic ID";
		$var4 = "email";
		$var5 = "phone no";
		$var6 = "Active/Disable.";
		$var7 = "View Details";
	}else{
		$var1 = "قائمة الطلاب";
		$var2 = "اسم الطالب";
		$var3 = "الرقم الأكاديمي";
		$var4 = "البريد الالكتروني";
		$var5 = "رقم الهاتف";
		$var6 = "تفعيل/تعطيل";
		$var7 = "عرض التفاصيل";
	}
?>
<!-- Page Content -->
        <div id="page-wrapper" style="<?=$dir;?>">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-lg-12">
                        <h1 class="page-header"><?=$var1?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row" style="display:flow-root">

					
						<table width="100%" class="table">
							<thead>
								<tr role="row">

									<th><?=$var2?></th>
									<th><?=$var3?></th>
									<th><?=$var4?></th>
									<th><?=$var5?></th>
									<th><?=$var6?></th>
									<th width="140"><?=$var7?></th>
								</tr>
							</thead>
							<tbody>
							<?php echo $studOb->showStudentsTable(); ?>

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
