<?php
session_start();
$_SESSION['current'] = 'home';
include("config.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php"); ?>
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
                            <a href="#"><img src="img/core-img/call2.png" alt=""> +441234567891</a>
                        </div>
                    </nav>					
                </div>
            </div>
        </div>
		
    </header>

    <!-- ##### Header Area End ##### -->

    
       
    <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=%20Garthdee%20House,%20Garthdee%20Rd,%20Garthdee,%20Aberdeen%20AB10%207AQ+(Ambrevia)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">measure area map</a></iframe></div>

<!-- ##### Footer Area Start ##### -->
    <?php include("footer.php"); ?>
    
		<?php include("footerjs.php"); ?>
</body>

</html>