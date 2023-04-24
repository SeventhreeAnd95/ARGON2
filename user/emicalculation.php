<?php
session_start();
$_SESSION['current'] = 'home';
include("config.php");

if(isset($_GET['lid']))
{
		$uid=$_SESSION["u_id"];
		$lid=$_GET['lid'];
		$result = mysql_query("SELECT * FROM applyloan WHERE status ='Approved' and loan_id = '$lid' and u_id=".$uid)or die(mysql_error());
		if($row = mysql_fetch_array( $result ))
		{
			$loan_type = $row['Loantype']; 
			$loanamount = $row['Loanamount']; 
			$tenure = $row['Totalmonths']; 
			$interestrate = $row['Percentage'];  
			$startdate = $row['startdate'];  
			$curmonth = $row['curmonth'];  
			
			$today = date('d-m-Y');
			$today_date = date_create($today);
			$date = date_create($startdate);
			$monthlyrate = $interestrate/12;
			$p_into_r = $loanamount*$monthlyrate/100;
			$static = 1;
			$static_plus_r = $static + ($monthlyrate/100) ;
			$static_plus_r_restto_n =round(pow($static_plus_r, $tenure),5);
			$static_plus_r_restto_n_1 = round($static_plus_r_restto_n-1,5);
			$emimonthly = round($p_into_r*($static_plus_r_restto_n/$static_plus_r_restto_n_1),2);
		}
		else
		{
			header("Location:logout.php");
		}

		

}
else
{
	header("Location:logout.php");
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
                           <?php } ?>
<br>
<h4 class="align">Emi Calculation</h4>
<br>
<?php
if(isset($_GET['lid']))
{
?>
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
				<th>Due Date</th>
				<th>Payment Status </th>				
			</tr>
			<?php
			for($i=1;$i<=$tenure;$i++)
			{
				date_add($date,date_interval_create_from_date_string("30 days"));
			?>
			<tr>
				<td><?php echo $i;?> </td>
				<td><?php echo round($loanamount,2);?></td>
				<td><?php echo $interestrate;?></td>
				<td><?php echo round(($loanamount*$interestrate/100)/12,2);?></td>
				<td><?php echo round($loanamount + (($loanamount*$interestrate/100)/12),2);?></td>
				<td><?php echo $emimonthly;?></td>
				<td><?php echo round(($loanamount + (($loanamount*$interestrate/100)/12))-$emimonthly,2);?></td>
				<td><?php echo date_format($date,"d-m-Y");?></td>
				<td><?php 
					if($curmonth<$i)
					{
						if($date < $today_date)
						{
							$duedatep =   "&duedate=".date_format($date,"d-m-Y");
							$cdatep =   "&cdate=".date_format($today_date,"d-m-Y");
						?>
						
						<a href="carddetails.php?lid=<?php echo $row['loan_id'];?>&month=<?php echo $i;?>&emi=<?php echo $emimonthly;?><?php echo $duedatep;?><?php echo $cdatep;?>"  class='btn credit-btn box-shadow btn-2'>Pay Now</a>
							
						<?php
						}else
						{
							echo "Pending";
						}
					}
					else
					{
							echo "<div style='background-color:green' class='btn credit-btn box-shadow btn-2'>Paid</div>"	;
					}
					?>
				</td>
			</tr>
			<?php
			$loanamount =round(($loanamount + (($loanamount*$interestrate/100)/12))-$emimonthly,2);
			}
			?>
			
			
			
		</table>
<?php
}
?>		
<br><br>
		<br><br>
		
	  <?php include("footer.php"); ?>
    
		<?php include("footerjs.php"); ?>
</body>
</html>