<?php 
session_start();
require_once("../config.php");

if (!isset($_SESSION['a_id']) || empty($_SESSION['a_id'])) {
    header("Location: ../index.php");
    exit;
}

if (isset($_SESSION['a_id'])) {
    $a_id = $_SESSION['a_id'];
    $error = '';
    if (isset($_POST['cpsubmit'])) {
        $oldpassword = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
        $newpassword = filter_input(INPUT_POST, 'cpass', FILTER_SANITIZE_STRING);
        $repeatnewpassword = filter_input(INPUT_POST, 'rcpass', FILTER_SANITIZE_STRING);
        if (empty($a_id) || empty($newpassword) || empty($repeatnewpassword)) {
            $error = '<span style="color:red;">ERROR: Please fill in all required fields!</span>';
        } else {
            $stmt = $conn->prepare("SELECT a_password FROM admin WHERE a_id = ?");
            $stmt->execute([$a_id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $oldPasswordHash = $row['a_password'];
            if (!password_verify($oldpassword, $oldPasswordHash)) {
                $error = '<span style="color:red;">ERROR: Old Password does not Match.</span>';
            } elseif ($newpassword === $repeatnewpassword) {
                $options = [
                    'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
                    'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
                    'threads' => PASSWORD_ARGON2_DEFAULT_THREADS,
                ];
                $newPasswordHash = password_hash($newpassword, PASSWORD_ARGON2ID, $options);
                $stmt = $conn->prepare("UPDATE admin SET a_password = ? WHERE a_id = ?");
                $stmt->execute([$newPasswordHash, $a_id]);
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
    $error = '<span style="color:red;">ERROR: contact the superadmin.</span>';
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
    <title>Change Password</title>

    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../style.css">
	
	<link rel="stylesheet" type="text/css" href="../custom.css">
</head>
<body>
<?php
if(isset($_SESSION['a_id']))
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
                            <a href="index.html"><img src="../img/core-img/Ambrevia.png" alt="" style="height:80px; width:150px;"></a>
                        </div>

						
                        <!-- Top Contact Info -->
							
							<div class="top-contact-info d-flex align-items-center">
							<span> Admin Welcome, &nbsp;
							<?php 
								if(isset($_SESSION['a_name']))
								{
										echo $_SESSION['a_name'];
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
                                    <li><a href="aindex.php">Home</a></li>
									<li><a href="aviewapp.php">View Loan Application</a></li>
                                    <li><a href="aloaninterest.php">Loan Interest</a></li>
                                    <li><a href="aemidetails.php">Emi Details</a></li>
									<li><a href="achangepass.php">Change Password</a></li>
                                </ul>
                            </div>
							
							
                            <!-- Nav End -->
                        </div>

                        <!-- Contact -->
                        <div class="contact">
                            <a href="#"><img src="../img/core-img/call2.png" alt=""> </a>
                        </div>
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
