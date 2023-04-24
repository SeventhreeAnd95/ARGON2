<?php
session_start();
$_SESSION['current'] = 'home';
include "../config.php";

if (!isset($_SESSION['u_id'])) {
    header("Location: index.php");
    exit;
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
<?php
    if(isset($_SESSION['u_id']))
    {
?>
   <!-- ##### Header Area Start ##### -->
   <header class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 d-flex justify-content-between">
                        <!-- Logo Area -->
                        <div class="logo">
                            <a href="uindex.html"><img src="img/core-img/Ambrevia.png" alt="" style="height:80px; width:150px;"></a>
                        </div>

						
                        <!-- Top Contact Info -->
							
							<div class="top-contact-info d-flex align-items-center">
							<span>Welcome, &nbsp; 		
								<?php 
								if(isset($_SESSION['u_name']))
								{
										echo $_SESSION['u_name'];
								}
								 ?>
								</span>
								
								
								&nbsp;&nbsp;
								
								<a href="logout.php">Logout</a>
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
                                    <li><a href="uindex.php">Home</a></li>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="profile.php">Profile</a></li>
                                    <li><a href="applyloan.php">Loan Apply </a></li>
                                    <li><a href="loanstatus.php">Loan Status</a></li>
                                    <li><a href="emidetails.php">EMI </a></li>
                                    <li><a href="chargesdetails.php">Charges Details</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>
                            </div>
							
							
                            <!-- Nav End -->
                        </div>

                        <!-- Contact -->
                        <div class="contact">
                            <a href="#"><img src="img/core-img/call2.png" alt=""> +441234567891</a>
                        </div>
                    </nav>					
                </div>
            </div>
        </div>
		
    </header>

    <?php } ?>

    
    <!-- ##### Header Area End ##### -->

   <div style="height:50px"></div>
   <div class="card">
  <div class="card-body">
  <h5>Loan management system is an advanced and comprehensive bank loan management system that aims to improve the quality, turnaround time and service for end-customers. As a loan management solution, it enables financial institutions to automate the processes for achieving cost savings and enhanced customer experience.</h5>
   
  </div>
</div>
<br>
<br>
<br>
	

    	<div style="height:300px"></div>

    <!-- ##### Footer Area Start ##### -->
    <?php include("../footer.php"); ?>
    
		<?php include("../footerjs.php"); ?>
	
</body>

</html>