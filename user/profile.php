<?php
session_start();
$_SESSION['current'] = 'home';
require_once "config.php";

if (empty($_SESSION['u_id'])) {
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['u_submit'])) {
    $u_id = $_SESSION['u_id'];
    $Name = $_POST['name'];
    $Contact = $_POST['contact'];
    $Email = $_POST['email'];
    $Current_City = $_POST['currentCity'];
    $DOB = $_POST['DOB'];
    $Type_Of_Employment = $_POST['typeofemployment'];
    if ($Type_Of_Employment != 'ownbussiness') {
        $Company_Name = $_POST['companyname'];
        $Company_Joining_Date = $_POST['companyjoiningdate'];
        $Work_Exp = $_POST['workexp'];
        $Salary = $_POST['salary'];

        $Industry_Type = '';
        $Start_Date = '';
        $Profit = '';
        $Turnover = '';
        $Partnership_Percentage = '';
    } else {
        $Industry_Type = $_POST['industrytype'];
        $Start_Date = $_POST['startdate'];
        $Profit = $_POST['profit'];
        $Turnover = $_POST['turnover'];
        $Partnership_Percentage = $_POST['partnershippercentage'];
        $Company_Name = '';
        $Company_Joining_Date = '';
        $Work_Exp = '';
        $Salary = '';
    }

    $query = $mysqli->prepare("UPDATE user SET u_currentcity = ?, u_DOB = ?, Company_Name = ?, u_typeofemployment = ?, 
    u_companyjoiningdate = ?, u_workexp = ?, u_salary = ?, u_industrytype = ?, u_startdate = ?, u_profit = ?, 
    u_turnover = ?, u_partnershippercentage = ? WHERE u_id = ?");
    $query->bind_param('ssssssssssssi', $Current_City, $DOB, $Company_Name, $Type_Of_Employment, $Company_Joining_Date,
                      $Work_Exp, $Salary, $Industry_Type, $Start_Date, $Profit, $Turnover, $Partnership_Percentage, $u_id);
    $query->execute();
    $query->close();

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

	<?php
	}
  ?>
    <br>
    <?php
    require_once "config.php";
        $u_id=$_SESSION["u_id"];
        $result = $conn->query("SELECT * FROM user  WHERE u_id='$u_id'") or die($conn->error);
        
        while ($row = $result->fetch_assoc()) {
        ?>
        <h4 class="align">Profile</h4>
        <form action="profile.php" method="post">
            <table class="table2">
                <tr>
                    <th>Name:</th>
                    <td><input type="text" name="name" value="<?php echo $row['u_name']; ?>"></td>
                </tr>
                <tr>
                    <th>Mobile no</th>
                    <td><input type="text" name="contact" value="<?php echo $row['u_contact']; ?>"></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><input type="Email" name="email" value="<?php echo $row['u_email']; ?>" ></td>
                </tr>
                <tr>
                    <th>Current City</th>
                    <td><input type="text" name="currentCity" value="<?php echo $row['u_currentcity']; ?>"></td>
                </tr>
                <tr>
                    <th>DOB</th>
                    <td><input type="Date" name="DOB" value="<?php echo $row['u_DOB']; ?>"></td>
                </tr>
                <tr>
                <th>
                <div><?php echo $row['u_typeofemployment']; ?>
                <span><label>Type of employment</label></span> </th><td><span><input name="typeofemployment" 
                type="radio" group="typeofemployment" id="typeofemployment" class="textbox" value="Salaried" <?php if ($row['u_typeofemployment'] == 'Salaried') echo "checked"; ?> onclick="fun1()">Salaried</span>
                          <span><input name="typeofemployment" type="radio" group="typeofemployment" id="typeofemployment" class="textbox" value="ownbussiness" onclick="fun2()" <?php if ($row['u_typeofemployment'] == 'ownbussiness') echo "checked"; ?>>Own business</span></div>
                          <td></tr>

                <tr><th>   </th><td>  <div id="salaried">
                            <div><span><label>Company name</label></span> <span><input type="text" name="companyname" value="<?php echo $row['Company_Name']; ?>"></span></div>
                            <div><span><label>Company joining date</label></span> <span><input type="date" name="companyjoiningdate" value="<?php echo $row['u_companyjoiningdate']; ?>"></span></div>
                            <div><span><label>Work Exp</label></span> <span><input type="text" name="workexp" value="<?php echo $row['u_workexp']; ?>"></span></div>
                            <div><span><label>Salary</label></span> <span><input type="text" name="salary" value= <?php echo $row['u_salary']; ?>></span></div>
                          </div>
                          <div id="ownbussiness" style="display:none;">
                            <div><span><label>Industry Type</label></span> <span><input type="text" name="industrytype" value="<?php echo $row['u_industrytype']; ?>"></span></div>
                            <div><span><label>Start Date</label></span> <span><input type="date" name="startdate" value="<?php echo $row['u_startdate']; ?>"></span></div>
                            <div><span><label>Profit</label></span> <span><input type="text" name="profit" value="<?php echo $row['u_profit']; ?>"></span></div>
                            <div><span><label>Turnover</label></span> <span><input type="text" name="turnover" value="<?php echo $row['u_turnover']; ?>"></span></div>
                            <div><span><label>Partnership Percentage</label></span> <span><input type="text" name="partnershippercentage" value="<?php echo $row['u_partnershippercentage']; ?>"></span></div>
                          </div>
                        </div><td>
                        </tr>
                        <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" class="btn credit-btn box-shadow btn-2" name="u_submit" value="submit">
                        </td>
                        </tr>
                    </table>			
        </form>		
        <?php }
        
        ?>
        
    <?php include("../footer.php"); ?>
    <?php include("../footerjs.php"); ?>
<script>function fun1(){document.getElementById("salaried").style.display="block";document.getElementById("ownbussiness").style.display="none";}
        function fun2(){document.getElementById("salaried").style.display="none";document.getElementById("ownbussiness").style.display="block";}</script>
</body>
</html>
