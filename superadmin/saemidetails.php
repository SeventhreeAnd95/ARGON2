<?php
session_start();
$_SESSION['folderstep'] = "../";
include("../config.php");
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
if(isset($_SESSION['sa_id']))
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
                            <a href="index.html"><img src="../img/core-img/Ambrevia.png" alt="" style="height:100px;width:200px;"></a>
                        </div>

						
                        <!-- Top Contact Info -->
							
							<div class="top-contact-info d-flex align-items-center">
							<span>super admin     Welcome, &nbsp; <?php 
								if(isset($_SESSION['sa_name']))
								{
										echo $_SESSION['sa_name'];
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
                                    <li><a href="saindex.php">Home</a></li>
									<li><a href="saviewapp.php">Loan Application </a></li>
									<!-- <li><a href="saemientry.php">EMI Entry</a></li>-->
									<li><a href="sacreateadmin.php">Create Admin</a></li>
									<li><a href="saemidetails.php">Emi Details</a></li>
									<li><a href="sacustomerdetails.php">Customers</a></li>
									<li><a href="saloancategory.php">Loan Type</a></li>
									<li><a href="sachangepass.php">Change Password</a></li>
                                </ul>
                            </div>
							
							
                            <!-- Nav End -->
                        </div>

                        <!-- Contact -->
                        <!--<div class="contact">
                            <a href="#"><img src="../img/core-img/call2.png" alt=""> +800 00 700 600</a>
                        </div>-->
                    </nav>					
                </div>
            </div>
        </div>
		
    </header>
	<?php } ?>

	<div> <br><h4 class="align">EMI Details</h4></div>
    
	
	<table class="table1">
			<tr>
				<th>Loan ID</th>
				<th>Loan Type</th>
				<th>Loan Amount</th>
				<th>How Many Months</th>
				<th>Interest Rate</th>
				<th>Start Date</th>
				<th>Status</th>
				<th>View</th>
				<th>Emi Calculation</th>
			</tr>
			<?php
				//$uid=$_SESSION["u_id"];
				$result = mysql_query("SELECT * FROM applyloan where startdate!='0000-00-00' and status='Approved'")or die(mysql_error());
				
				while($row = mysql_fetch_array( $result )) { 
			?>
			<tr>
				<td><?php echo $row['loan_id']; ?></td>
				<td><?php echo $row['Loantype']; ?></td>
				<td><?php echo $row['Loanamount']; ?></td>
				<td><?php echo $row['Totalmonths']; ?></td>
				<td><?php echo $row['Percentage']; ?></td>
				<td><?php if($row['status']=='Approved'){echo $row['startdate'];}else{echo "NA";}?></td>
				<td><?php echo $row['status']; ?>
				
				</td>
				<td><a href="saloanview.php?lid=<?php echo $row['loan_id'];?>"  class="ubtn">View</a></td>
				<td><a href="saemicalculation.php?lid=<?php echo $row['loan_id'];?>&uid=<?php echo $row['u_id'];?>"   class="ubtn">Emi Calculation</a>
				</td></tr>
			<?php
				}
			?>
		</table><br>

    <!-- ##### Footer Area Start ##### -->
    <?php include("../footer.php"); ?>
	<?php include("../footerjs.php"); ?>
	
</body>
</html>