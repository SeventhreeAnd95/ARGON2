<?php
include "config.php";
if(isset($_POST['submit']))
{
    $la = $_POST['loanamount'];
    $te = $_POST['tenure'];
    $ir = $_POST['interestrate'];

    $mr = $ir/12;
    $pir = $la*$mr/100;
    $ray = 1 + ($mr/100);
    $srtn = round(pow($ray, $te),5);
    $srtn1 = round($srtn-1,5);
    $emi = round($pir*($srtn/$srtn1),2);

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
                           <?php } ?>
    <div> <br></div>
    <div>
        <h4 class="align"> EMI Calculator</h4>
        <form action="emicalculator.php" method="post" class="emiform"><br>
            <table class="table1">
                <tr>
                    <td>Loan Amount </td>
                    <td><input type="text" name="loanamount" size="40"
                            maxlength="10" width="48" height="48"
                            value="<?= $la ?>" required></td>
                </tr>

                <tr>    
                    <td>Tenure in Months </td>
                    <td><input type="text" name="tenure" size="40"
                            maxlength="10" width="48" height="48"
                            value="<?= $te ?>" required></td>
                </tr>   

                <tr>    
                    <td>Interest Rate </td>
                    <td><input type="text" name="interestrate"
                            size="40" maxlength="10" width="48"
                            height="48" value="<?= $ir ?>" required>
                    </td>
                </tr>   

                <tr>
                    <td></td>                    
                    <td class="align"><input type="submit" name="submit" 
                            value= "submit" class="btn credit-btn 
                            box-shadow btn-2"></td>
                </tr>   
            </table>    
        </form><br></br>

        <h4 class="align"> Display For monthly EMI</h4>
        <table class="table1">
            <tr>
                <th>Month</th>
                <th>Opening Amount </th>
                <th>Interest Rate</th>
                <th>Interest Amount</th>
                <th>Total with Interest</th>
                <th>PayEMI</th>
                <th>Closing Amount </th>                
            </tr>

            <?php
            for($i=1;$i<=$te;$i++)
            {
                ?>
                <tr>
                    <td><?= $i ?> </td>
                    <td><?= round($la,2) ?></td>
                    <td><?= $ir ?></td>
                    <td><?= round(($la*$ir/100)/12,2) ?></td>
                    <td><?= round($la + (($la*$ir/100)/12),2) ?></td>
                    <td><?= $emi ?></td>
                    <td><?= round(($la + (($la*$ir/100)/12))-$emi,2) ?></td>
                </tr>

            <?php
                $la =round(($la + (($la*$ir/100)/12))-$emi,2);
            }
            ?>
        </table>
    </div>
    <?php include("footer.php"); ?>    
    <?php include("footerjs.php"); ?>
</body>
</html>

<?php
}
?>
