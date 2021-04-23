<?php

	include("template/header.htm");

	include("admin/classes/Student.php");

	date_default_timezone_set('Asia/Aden');
	$db = new DB();
	$student = new Student();

	include("mail.php");

	$db =  $db -> getConnection();
	$resultArr = array();


	$email =  isset($_POST["email"]) ? $_POST["email"] : "";

	if(isset($_POST["email"])  && $email != "" )
	{
		if($student->getUserID( $email) > 0){

			$sql_q = " insert into recover_req (email , req_time) values ('$email', now());";

			$result = mysqli_query($db, $sql_q) or die(mysqli_error($db));
			if($result)
			{

				$last_id = mysqli_insert_id($db);
				$link = "http://localhost:8080/nu_shopping/reset.php?id=".$last_id;

				$fromEmail = "shorouq00000@gmail.com";
				$password = "1234@Qwer";
				if(sendEmail ($link, $email, $fromEmail, $password)){
					echo "<script>
								JSReceiver.loadDismiss();
								JSReceiver.showMessage(\"Email Sent, Please check your email inbox, you have 5 minuts to reset your password\");

							</script>";
				}
			}
			else{
				echo "<script>
						JSReceiver.loadDismiss();
						JSReceiver.showErrMessage(\"Error, Coludn't save data\");

					</script>";
			}
		}else{
			echo "<script>
						JSReceiver.loadDismiss();
						JSReceiver.showErrMessage(\"Error, Email not found.\");

					</script>";
		}

	}
?>
<script>
	function load(){
		JSReceiver.loadProcess();
	}
	function loadDismiss(){
		JSReceiver.loadDismiss();
	}
</script>
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
					<h4>Forget Password.</h4>
				</div>
                <!-- /.row -->
				<div class="row">
					<p>
						Write your email:
					</p>
					<form action="" method="post" enctype="multipart/form-data">
						<fieldset>


							<div class="form-group">
								<input class="form-control"  placeholder="Email" name="email" type="email" value="<?=$email?>" autofocus required />
							</div>



							<!-- Change this to a button or input when using this as a form -->
							<input type="submit" value="Recover Password" username="reserve" onclick="load()" class="btn btn-lg btn-success btn-block">
						</fieldset>

					</form>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
        <!-- /#page-wrapper -->

	<?php

	include("template/footer.htm");

	?>
