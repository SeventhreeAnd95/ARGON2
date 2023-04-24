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

    <main>
        <h2>Track Application</h2>

        <form action="trackapplication.php" method="post">
            <table>
                <tr>
                    <td><label for="search">Application ID:</label></td>
                    <td><input type="text" name="search" id="search" size="40" maxlength="10"></td>
                    <td><button type="submit" name="submit">Search</button></td>
                </tr>
            </table>
        </form>

        <?php
		    require_once "config.php";
            if (isset($_POST['submit'])) {
                $loan = $_POST['search'];
                include("config.php");

                $stmt = $conn->prepare("SELECT * FROM applyloan WHERE loan_id=?");
                $stmt->execute([$loan]);
                $result = $stmt->fetchAll();

                if (count($result) > 0) {
                    echo "<h3>Application status Select/Reject</h3>";
                    echo "<table>";
                    echo "<tr><th>Application ID</th><th>Status</th></tr>";

                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['loan_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p>No results found for application ID '$loan'</p>";
                }
            }
        ?>
    </main>

    <?php include("footer.php"); ?>
    <?php include("footerjs.php"); ?>
</body>
</html>
