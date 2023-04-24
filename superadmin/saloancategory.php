<?php
session_start();
$_SESSION['folderstep'] = "../";
include("../config.php");
$message = "";
if(isset($_POST['submit'])) 
	{
    	$loan=$_POST['loan'];
		$check = mysql_query(" SELECT cat FROM category WHERE cat='$loan'");
		$num_rows = mysql_num_rows($check);
		if($num_rows>0)
		{
			//$e = "<font color='red'>Email already exists...!!</font>";
			//header("Location:signup.php?e=$e");
			$message =  "<font color='red'>emailid is already exists</font>";
		}
		else
		{
			$sql = "INSERT INTO category". "( cat) "." VALUES('$loan')";
			//echo "$sql\n";
			$retval = mysql_query($sql);

			if(! $retval ) 
			{
				//die('Could not enter data: ' . mysql_error());
				//$loc=header("Location: sacreateadmin.php");
				$message =  "<font color='red'>could not enter.</font>";
				
			}
			else
			{
				//$loc=header("Location:saindex.php");
				$message =  "<font color='green'>Entered data successfully\n</font>";	
			}
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
								
								<a href="../logout.php">Logout</a>
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
	<br>
	<h4 class="align">Loan Category</h4></br>
	
	<form action="saloancategory.php" method="post">
		<table class="table1">
			<tr>
				<th>Loan Category</th>
				<td>
					<input list="text" name="loan">
					
					
				</td>
			</tr>
			<tr>
			<td colspan="2">
			<div class="text-center">
							<span>
								<input type="submit" class="btn credit-btn box-shadow btn-2" name="submit" value="Submit">
							</span></br></br>
			</td>
			</tr>
		</table>
	</form></br>
	
	

							
							
							
						<?php
		$count = mysql_query("SELECT * FROM category") or die(mysql_error());
		$row_count = mysql_fetch_array($count);
		if ($row_count != 0) {
	?><br>
	<form action="">
		<table class="table1 align">
			<tr align="center">
				<th>Name</th>  
				
				
			</tr>
			<?php
                  $qq1 = mysql_query("SELECT * FROM category") or die(mysql_error());
                  while ($row = mysql_fetch_array($qq1)) {
                  ?>
			<tr>
				<td><?php echo $row['cat'];?></td>
				
				<?php
					
						
				?>
						
				<?php
					
				?>
			</tr>
			<?php }?>
		</table>
		
	</form></br></br>
	<?php }?>
	
							
							
	<?php include("../footer.php"); ?>
	<?php include("../footerjs.php"); ?>
	
</body>
</html>