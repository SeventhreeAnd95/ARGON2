<?php
session_start();
include_once "../config.php";
$_SESSION['folderstep'] = "../";

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
    if (isset($_SESSION['a_id'])) {

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
                                    if (isset($_SESSION['a_name'])) {
                                        echo htmlspecialchars($_SESSION['a_name'], ENT_QUOTES, 'UTF-8');
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
    <br>

    <h4 class="align">Admin View App</h4>

    <?php
    $sql = "SELECT * FROM applyloan WHERE startdate='0000-00-00'";
    if ($result = $conn->query($sql)) {
    ?>
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

            </tr>
            <?php
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['loan_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['Loantype'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['Loanamount'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['Totalmonths'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['Percentage'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php
                        if ($row['status'] == 'Approved') {
                            echo htmlspecialchars($row['startdate'], ENT_QUOTES, 'UTF-8');
                        } else {
                            echo "NA";
                        }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8'); ?>
                        <?php if ($row['status'] == "Approved") { ?>
                            <br /><a href="aloanview.php?sd=1&lid=<?php echo htmlspecialchars($row['loan_id'], ENT_QUOTES, 'UTF-8'); ?>" class="ubtn">Add Start Date</a>
                        <?php
                        } ?>
                    </td>
                    <td><a href="aloanview.php?lid=<?php echo htmlspecialchars($row['loan_id'], ENT_QUOTES, 'UTF-8'); ?>" class="ubtn">View</a></td>

                </tr>
            <?php
            }
            ?>
        </table>
    <?php
        $result->free();
    } else {
        echo 'Error: ' . $conn->error;
    }

    include("../footer.php"); ?>

    <?php include("../footerjs.php"); ?>

</body>

<?php $conn->close(); ?>

</html>