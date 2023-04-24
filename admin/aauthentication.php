<?php
session_start();
require_once("../config.php");

if (isset($_POST['usubmit'])) {
    $otp = $_POST['otp'];
    $email = $_SESSION['auth_aemail'];
    $aid = $_SESSION['auth_aid'];
    $a_name = $_SESSION['auth_aname'];
    if ($otp == $_SESSION['otp']){
			$_SESSION['a_id'] = $aid;
       		$_SESSION['a_email'] = $email;
        	$_SESSION['a_name'] = $a_name;

          header("Location: aindex.php");
          exit();
    }
    else{
			echo "You Have entered wrong otp.";
			header("Location: index.php");
			exit();
		}
 
        }?>
<html>
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
  <Body>
<!-- ##### Header Area Start ##### -->
<header class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 d-flex justify-content-between">
                        <!-- Logo Area -->
                        <div class="logo">
                            <a href="index.html"><img src="..\img\core-img\Ambrevia.png" alt="" style="height:80px; width:150px;"></a>
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


  <!-- ##### Header Area End ##### -->

  <div id="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="box"><br><br>

            <h2 class="text-uppercase">OTP AUTHENTICATION</h2>
            
            <?php if (isset($_SESSION['auth_aemail'])) { ?>
              <p>An OTP has been sent to your registered email. Please check your email and enter the OTP below:</p>
            
              <?php if (isset($error_msg)) { ?>
                <div style="color: red;"><?php echo $error_msg; ?></div>
              <?php } ?>

              <form action="aauthentication.php" method="post">
                <div class="form-group">
                  <label for="otp">OTP</label>
                  <input type="text" name="otp" class="form-control" id="otp" required>
                </div>

                <div class="text-center">
                  <button type="submit" name="usubmit" class="btn credit-btn box-shadow btn-2">Submit</button>
                </div>
              </form>
            <?php } else { ?>
              <p>No email found for authentication.</p>
            <?php } ?>
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
