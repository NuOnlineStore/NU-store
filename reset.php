<?php
	include("template/header.htm");

	include("admin/classes/Student.php");

	date_default_timezone_set('Asia/Aden');

	$student = new Student();

	$resultArr = array();
	$expaireLink = false;


	$req_id = isset($_GET["id"])? $_GET["id"]:"0";
	$data = $student->getRecoverByID($req_id);

	$start_date = new DateTime($data["req_time"]);

	$since_start = $start_date->diff(new DateTime());
	// Check mins and hours
	if ($since_start->i >= 5 ) {
		$expaireLink = true;
	}

	$updateSuccess = false;

	if(!$expaireLink)
	{

		$userID = $student->getUserID($data["email"]);
		$userID = $userID["id"];
		$data = $student->getStudent($userID);

		$email =  isset($_POST["email"]) ? $_POST["email"] : $data["email"];

		$password = isset($_POST["password"]) ? $_POST["password"] : "";

		if( $password != "")
		{
			if($student->updatePass($userID, $password))
			{
				echo "<h2>Your password account updated successfully</h2>";
				$updateSuccess = true;
			}
			else{
				echo "<h2>Error, couldn't update your password</h2>";
			}
		}
		if(! $updateSuccess ){
	?>
	<!-- Page Content -->
			<div id="page-wrapper">
				<div class="container-fluid">
					<div class="row">
						<p>Account Detail.</p>
					</div>
					<!-- /.row -->
					<div class="row">

						<form action="?id=<?=$req_id?>" method="post" enctype="multipart/form-data">
							<fieldset>
								Please set your new password

								<div class="form-group">
									<input class="form-control" placeholder="New Password" name="password" type="password" value="<?=$password?>" required autofocus>
								</div>



								<!-- Change this to a button or input when using this as a form -->
								<input type="submit" value="Update Password" username="reserve" onclick="load()" class="btn btn-lg btn-success btn-block">
							</fieldset>

						</form>
					</div>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /#page-wrapper -->

		<?php
		}
	}
	else{
		echo "<h1>This link has been expaired</h1>";
	}
	include("template/footer.htm");

	?>
