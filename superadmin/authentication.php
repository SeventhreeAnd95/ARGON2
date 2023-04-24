<?php
session_start();
$_SESSION['current'] = 'home';
include "../config.php";
$e ="";
global $conn;
 if(isset($_POST['usubmit'])) 
	{
    	//include("config.php");
		
		$otp=$_POST['otp'];
		$email=$_SESSION['auth_email'];		
		$said=$_SESSION['auth_id'];
		$sa_name = $_SESSION['auth_name'] ;
		if ($otp == $_SESSION['otp']){
			$_SESSION['sa_id'] = $said;
       		$_SESSION['sa_email'] = $email;
        	$_SESSION['sa_name'] = $sa_name;
			
			header("Location: saindex.php");
                exit();
		}
		else{
			echo "You Have entered wrong otp.";
			header("Location: index.php");
			exit();
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <!-- Title -->
    <title>Credit - Loan &amp; Credit Company HTML Template</title>

    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../style.css">
	
	<link rel="stylesheet" type="text/css" href="../custom.css">
</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 d-flex justify-content-between">
                        <!-- Logo Area -->
                        <div class="logo">
                            <a href="index.html"><img src="\img\core-img\Ambrevia.png" alt="" style="height:80px; width:150px;"></a>
                        </div>

						
                        <!-- Top Contact Info -->
							<div class="top-contact-info d-flex align-items-center">
								<a href="signup.php" data-toggle="tooltip" data-placement="bottom" title=""><img src="img/core-img/placeholder.png" alt=""> <span>sign up / sign in</span></a>
							</div>
						
													
						
                    </div>
                </div>
            </div>
        </div>

					
		
        <!-- Navbar Area -->
        <div class="credit-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="creditNav">

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
							
                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>
                            </div>
							
							
                            <!-- Nav End -->
                        </div>

                        <!-- Contact -->
                        <div class="contact">
                            <a href="#"><img src="../img/core-img/call2.png" alt=""> +441234567891</a>
                        </div>
                    </nav>					
                </div>
            </div>
        </div>
		
    </header>
	
	<div id="content">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="box"><br><br>
					
						<h2 class="text-uppercase">OTP AUTHETICATION</h2>
						<p>AN OTP has been send to your registered email . please check the mail.</p>
						
						<?php
							if(isset($_GET["uid"])) {
							if($_GET["uid"]==1) {
						?>
							<div style="color:red;">
						Please Enter Correct OTP
					</div>
						<?php
					}
					}
					?>
						<hr>

						<form action="authentication.php" method="post">
							<div class="form-group">
								<label for="email">OTP</label>
								<input type="text" name="otp" class="form-control" id="otp" required>
							</div>
							
							<div class="text-center">
								<span>
									<input type="submit" class="btn credit-btn box-shadow btn-2" name="usubmit" value="Submit">
								</span>
							</div><br><br>	
							<!--<div class="text-center">
								<a href="login.php" class="btn credit-btn box-shadow btn-2">Log in</a>
							</div> -->
						</form>
					</div>
				</div>

				
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
	</div>
		<!-- ##### Footer Area Start ##### -->
    <?php include("../footer.php"); ?>
	<?php include("../footerjs.php"); ?>	
</body>
</html>	