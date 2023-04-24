<?php
session_start();
$_SESSION['current'] = 'home';
require_once "config.php";
if(isset($_GET['lid']))
{
    $loan_id = $_GET['lid'];
    $stmt = $pdo->prepare("SELECT DL, PAN, Residence, Adhar_id, Loantype, Totalmonths, Loanamount, Percentage FROM applyloan WHERE loan_id=?");
    $stmt->execute([$loan_id]);
    $row = $stmt->fetch();

    //header("Content-type: image/jpeg");
    $dl = $row['DL'];
    $pan = $row['PAN'];
    $residence = $row['Residence'];
    $adhar_id = $row['Adhar_id'];
    $loan_type = $row['Loantype'];
    $total_months = $row['Totalmonths'];
    $loan_amount = $row['Loanamount'];
    $percentage = $row['Percentage'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="custom.css">
    <?php include("head.php"); ?>
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
                            <a href="index.html"><img src="img/core-img/Ambrevia.png" alt="" style="height:80px; width:150px;"></a>
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
                                    <li><a href="index.php">Home</a></li>
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

	<?php
	}
  ?>
    <br>
    <h4 class="align">View Loan Details</h4>
    <br>
    <form>
        <table class="table2 align">
            <tr>
                <th>Driving License</th>
                <td><img src="<?php echo $dl;?>" width="150" height="150"></td>
            </tr>
            <tr>
                <th>Pan Card</th>
                <td><img src="<?php echo $pan;?>" width="150" height="150"></td>
            </tr>
            <tr>
                <th>Residential Proof</th>
                <td><img src="<?php echo $residence;?>" width="150" height="150"></td>
            </tr>
            <tr>
                <th>Adhar ID</th>
                <td><?php echo $adhar_id; ?></td>
            </tr>
            <tr>
                <th>Loan Type</th>
                <td><?php echo $loan_type; ?></td>
            </tr>
            <tr>
                <th>Total Months</th>
                <td><?php echo $total_months; ?></td>
            </tr>
            <tr>
                <th>Loan Amount</th>
                <td><?php echo $loan_amount; ?></td>
            </tr>
            <tr>
                <th>Percentage</th>
                <td><?php echo $percentage; ?></td>
            </tr>
        </table>
    </form>
    <br><br>
    <?php include("footer.php"); ?>
    <?php include("footerjs.php"); ?>
</body>
</html>
