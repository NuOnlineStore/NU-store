<?php

$page_titel = "Log out page";
include("template/header.htm");

$_SESSION['admin'] = null;
session_destroy();

	$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	if($lang == "en"){
		$var0 = "You have successfully loged out"; 
	}else{ 
		$var0 = "لقد تم تسجيل خروجك بنجاح"; 
	}
?>

		<meta http-equiv='refresh' content='0; url=index.php'>

		<div class="errorbox notice">
			<p><?=$var0?></p>
		</div>
	

	
<?php
include("template/footer.htm");

?>