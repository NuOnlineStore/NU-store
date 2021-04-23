<?php

	$page_titel = "Administrator";
	include("template/header.htm");



	if( isset($_GET["lang"]) )
	{
		$lang = isset($_GET["lang"])? $_GET["lang"] : "en";
		$_SESSION["lang"] = $lang;
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
	}else{
		$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	}

	if($lang == "en"){
		$var0 = "Welcome to NU's Student shopping";
		$var1 = "Choose Langauge:";
	}else{
		$var0 = "مرحبا بك في الإدارة";
		$var1 = ":اختر اللغة";
	}
?>
<!-- Page Content -->
        <div id="page-wrapper" style="<?=$dir;?>">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?=$var0?> </h1>
						<ul>
							<?=$var1?>
							<li><a href="?lang=en">English</a></li>
							<li><a href="?lang=ar">عربي</a></li>
						</ul>

					</div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row">

				</div>

			</div>
			<!-- /.container-fluid -->
		</div>
        <!-- /#page-wrapper -->



<?php
include("template/footer.htm");

?>
