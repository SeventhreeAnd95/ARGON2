<?php

// Start session and connect to database
session_start();
require_once("../config.php");
$conn = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, DB_NAME);

// Redirect to signup page if user is not logged in
if (!isset($_SESSION['u_id'])) {
    header("Location: ../signup.php");
    exit();
}

// Get charges details
$pageTitle = "Charges Details";
$query = "SELECT cat, rate FROM emi";
$result = mysqli_query($conn, $query);

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

<!-- Header Area -->
<header class="header-area">
    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 d-flex justify-content-between">
                    <!-- Logo Area -->
                    <div class="logo">
                        <a href="uindex.html"><img src="img/core-img/Ambrevia.png" alt="" style="height:80px; width:150px;"></a>
                    </div>

                    <!-- Top Contact Info -->
                    <div class="top-contact-info d-flex align-items-center">
                        <span>Welcome, <?php echo isset($_SESSION['u_name']) ? $_SESSION['u_name'] : ''; ?></span>
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
                        <a href="#"><img src="../img/core-img/call2.png" alt=""> +441234567891</a>
                    </div>
                </nav>					
            </div>
        </div>
    </div>
</header>

<!-- Charges Details Section -->
<section class="charges-details">
    <h2><?php echo $pageTitle; ?></h2>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <table class="charges-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Rate</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlentities($row['cat']); ?></td>
                        <td><?php echo htmlentities($row['rate']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>

</section>

<?php include("../footer.php"); ?>

</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
