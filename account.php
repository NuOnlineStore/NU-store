<?php
	
	$page_titel = "Edit Admin Profile";
	
	include("template/header.htm");
	include("classes/Admin.php");

	
	$email = isset($_POST['email'])?$_POST['email']:"";
	$password = isset($_POST['password'])?$_POST['password']:"";
	
	$admin = new Admin(new DB());
	
	
	$lang = isset($_SESSION["lang"])? $_SESSION["lang"] : "en";
	if($lang == "en"){
		$var1 = "Edit Admin Profile";
		$var2 = "ُEmail";
		$var3 = "Password";
		$var4 = "Update"; 
		$msg1 = "Data Updated."; 
	}else{
		$var1 = "تعديل بيانات ";
		$var2 = "البريد الالكتروني";
		$var3 = "كلمة المرور";
		$var4 = "تعديل"; 
		$msg1 = "تم تحديث البيانات."; 
	}
	?>
	
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid" style="<?=$dir;?>">
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
		if( isset($_POST['password']) && $_POST['password']!=""  && $email != "")
		{
			$edit = $admin->edit( $email, $password);
			if($edit)
				echo "<div class='info'>$msg1 </div>";
		}else{
			
	?>
			<form action="account.php?action=edit" method="post" enctype="multipart/form-data">
				<table width="648" border="0"> 
				
				  <tr>
					<td width="115"><?=$var2?>:</td>
					<td width="287">
					  <label><input type="email" name="email" class="form-control" id="email" value="<?php echo $email;?>" required>
					</label></td>
				  </tr>
				                    
				          
				  <tr>
					<td width="115"><?=$var3?>:</td>
					<td width="287">
					  <label><input type="password" name="password" class="form-control" id="password"  required>
					</label></td>
				  </tr>
				  
				  <tr>
					<td colspan="2" align="center">
						<input type="submit" class="btn btn-default" value="   <?=$var4?>   "/>
					</td>
				  </tr>
				</table>
			</form>
	<?php
			}
	}


include("template/footer.htm");

?>