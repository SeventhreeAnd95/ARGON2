<?php
session_start();
require_once "config.php";

if (empty($_SESSION['u_id'])) {
  header("Location: index.php");
  exit;
}

$uid = $_SESSION["u_id"];
$lid = $_GET['lid'] ?? null;
$month = $_GET['month'] ?? null;
$emi = $_GET['emi'] ?? null;
$duedate = $_GET['duedate'] ?? null;
$cdate = $_GET['cdate'] ?? null;
$cardnum = '';
$expdatemm = 'MM';
$expdateyy = 'YY';

if ($lid && $month && $emi && $duedate && $cdate) {
  $result = mysqli_query($conn, "SELECT * FROM applyloan WHERE status ='Approved' AND loan_id = '$lid' AND u_id=$uid");

  if ($row = mysqli_fetch_array($result)) {
    $result1 = mysqli_query($conn, "SELECT cardnum, expdatemm, expdateyy FROM user WHERE u_id=$uid");
    if ($row1 = mysqli_fetch_array($result1)) {
      $cardnum = $row1['cardnum'];
      $expdatemm = $row1['expdatemm'];
      $expdateyy = $row1['expdateyy'];
    }
  } else {
    header("Location:logout.php");
    exit;
  }   
} else {
  header("Location:logout.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include("head.php"); ?>
  <link rel="stylesheet" type="text/css" href="custom.css">
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
  <form action="payemi.php" method="post">
    <h4 class="align">Pay Your EMI By Using Your DEBIT/CREDIT Card</h4><br><br>
    <div class="align">
      <div>
        <span>
          <label>Card Number</label>
        </span>        
        <span>
          <input name="cardnumber" type="text" class="textbox" style="width:300px" required maxlength="16" value="<?= $cardnum ?>">
        </span>
      </div>
      <div>
        <span>
          <label>Expiry Date</label>
        </span> 
        <span>
          <input name="expdatemm" type="text" class="textbox" style="display:inline;width:60px" value="<?= $expdatemm ?>" required maxlength="2"> / <input name="expdateyy"type="text"class="textbox"style="display:inline;width:60px"value="<?= $expdateyy ?>" required maxlength="2">
        </span>
      </div>
      <div>
        <span>
          <label>CVV</label>
        </span> 
        <span>
          <input name="cvv" type="text" class="textbox" style="width:100px" required maxlength="3">
        </span>
      </div><br>
    </div>    
    <div class="align">
      <input type="submit" name ="pay" class="btn credit-btn box-shadow btn-2" value="pay"><br><br><br>
    </div>
  </form>
  <?php include("footer.php"); ?>
  <?php include("footerjs.php"); ?>  
</body>
</html>
