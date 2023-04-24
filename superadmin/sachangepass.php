<?php
session_start();
$_SESSION['a_id'] = 1;
include("../config.php");
$_SESSION['folderstep'] = "../";

if (!isset($_SESSION['sa_id']) || empty($_SESSION['sa_id'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION['sa_id'])) {
    $sa_id = $_SESSION['sa_id'];
    $error = '';
    if (isset($_POST['cpsubmit'])) {
        $oldpassword = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
        $newpassword = filter_input(INPUT_POST, 'cpass', FILTER_SANITIZE_STRING);
        $repeatnewpassword = filter_input(INPUT_POST, 'rcpass', FILTER_SANITIZE_STRING);
        if (empty($sa_id) || empty($newpassword) || empty($repeatnewpassword)) {
            $error = '<span style="color:red;">ERROR: Please fill in all required fields!</span>';
        } else {
            $stmt = $conn->prepare("SELECT sa_password FROM supadmin WHERE sa_id = ?");
            $stmt->execute([$sa_id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $oldPasswordHash = $row['sa_password'];
            if (!password_verify($oldpassword, $oldPasswordHash)) {
                $error = '<span style="color:red;">ERROR: Old Password does not Match.</span>';
            } elseif ($newpassword === $repeatnewpassword) {
                $newPasswordHash = password_hash($newpassword, PASSWORD_ARGON2ID);
                $stmt = $conn->prepare("UPDATE supadmin SET sa_password = ? WHERE u_id = ?");
                $stmt->execute([$newPasswordHash, $sa_id]);
                if ($stmt->rowCount() > 0) {
                    session_regenerate_id();
                    $error = '<span style="color:green;">Congratulations, your password has been updated.</span>';
                } else {
                    $error = '<span style="color:red;">ERROR: Failed to update password.</span>';
                }
            } else {
                $error = '<span style="color:red;">ERROR: New & Repeat Password should be Same.</span>';
            }
        }
    }
} else {
    header("Location: login.php");
    exit;
}
$conn = null;
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
    <?php if (!empty($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="">
        <input type="password" name="pass" placeholder="Old Password">
        <input type="password" name="cpass" placeholder="New Password">
        <input type="password" name="rcpass" placeholder="Repeat Password">
        <button type="submit" name="cpsubmit">Submit</button>
    </form>
</body>
</html>