<?php
session_start();
$_SESSION['current'] = 'home';
include("config.php");
$_SESSION['folderstep'] = "../";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../head.php"); ?>
</head>

<body>
	<br><br>
	<div id="content">
		<div class="container">
			<div class="col-md-12">
				<div class="box">
					<h2 class="text-uppercase">Login</h2>
					<p class="text-muted"></p>
					<hr>
					<form action="alog.php" method="post">
						<div class="form-group">
							<label for="name">Email</label>
							<input type="text" name="subadmin_email" class="form-control" id="subadmin_email">
						</div>
						<div class="form-group">
							<label for="apassword">Password</label>
							<input type="password" name="subadmin_password" class="form-control" id="subadmin_password">
						</div>
						<span>
							<?php if(isset($_GET['msg33']))
							echo $_GET['msg33'];?>
								
						</span>
						<div class="text-center">
							<span>
								<input type="submit" class="btn credit-btn box-shadow btn-2" name="subadmin_submit" value="Log in">
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
    
	<?php include("../footerjs.php"); ?>
	
</body>
</html>