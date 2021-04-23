<?php

//	include("admin/include/db.php");
	session_start();
	include("classes/DB.php");
	include("classes/Admin.php");

	$page_titel = "Log In";

	$db = new DB();
	$user = new Admin($db);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">
					<div style='text-align: center;'>Admin Login</div>
					<div style=" margin-left:auto; margin-right: auto; width:50%">
						<img  width="100%" src="images/logo.png"/>
					</div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">

<?php

	//$con = connectBD();

	$email  = isset($_POST['email'])?$_POST['email']:"";
	$password = isset($_POST['password'])?$_POST['password']:"";
	$errLogin = false;
	if(isset($_POST['email']) && $_POST['email']!="" && $_POST['password']!="" )
	{
		if($user->userLogin($_POST['email'] , $_POST['password']))
		{
			$_SESSION['admin'] = $user;
			$errLogin = true;
		}
		if(!$errLogin)
			echo "<div class='info'>Invalid user
						<a href='login.php' class='btn btn-lg btn-success btn-block'>Please try again</a>
					</div>";
		else{
			echo "<meta http-equiv='refresh' content='5; url=index.php'>";
			echo "<div class='info'>You've logged in successfully</div>";
			echo "<div class='info'><a href='index.php'>Home</a>.</div>";
		}
	}else{

		if(!isset($_SESSION['admin']) || gettype($_SESSION['admin'])!="object")
		{
?>

				<form action="login.php" method="post">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="Email" name="email" type="email" autofocus required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Password" name="password" type="password" value="" required>
						</div>
						<input type="submit" value="دخول" class="btn btn-lg btn-success btn-block">
					</fieldset>

				</form>

		<?php
		}else{

		  	echo "<meta http-equiv='refresh' content='1; url=index.php'>";
		  echo "<div class='info'>You are already logged in..</div>";
		  echo "<div class='info'><a href='index.php'>Click here to continue</a>.</div>";

		}

		?>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<?php
	}
	?>


    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>
