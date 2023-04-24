<?php session_start();
    $_SESSION['folderstep'] = "../";
    include("../config.php");
    $message = "";

    if(isset($_POST['adminsubmit'])) {
        $aname = $_POST['adminname'];
        $aemail = $_POST['adminemail'];
        $amobile = $_POST['adminmobile'];
        $password = $_POST['adminpassword'];

        $options = [
            'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
            'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
            'threads' => PASSWORD_ARGON2_DEFAULT_THREADS,
        ];
        // Hash the password using Argon2 with default options
        $hash = password_hash($password, PASSWORD_ARGON2ID ,$options);

        // Check if the email already exists
        $check = mysqli_prepare($conn, "SELECT a_email FROM admin WHERE a_email=?");
        mysqli_stmt_bind_param($check, "s", $aemail);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);
        if(mysqli_stmt_num_rows($check) > 0) {
            $message = "<font color='red'>Email already exists.</font>";
        } else {
            $sql = mysqli_prepare($conn, "INSERT INTO admin (a_name, a_email, a_mobile, a_password) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($sql, "ssss", $aname, $aemail, $amobile, $hash);
            $retval = mysqli_stmt_execute($sql);

            if (!$retval) {
                $message = "<font color='red'>Could not enter data.</font>";
            }
            else {
                $message = "<font color='green'>Entered data successfully.</font>";
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
                        <a href="index.html"><img src="../img/core-img/Ambrevia.png" alt=""
                                                   style="height:100px;width:200px;"></a>
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
<br>
<br><br>
<div id="content">
    <div class="container">
        <div class="col-md-12">
            <div class="box">
                <h2 class="text-uppercase">Create Admin</h2>
                <p class="text-muted">
                    <?php echo $message; ?>
                </p>
                <hr>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="name">Admin Name</label>
                        <input type="text" name="adminname" class="form-control" id="adminname" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Email ID</label>
                        <input type="email" name="adminemail" class="form-control" id="adminemail" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Mobile</label>
                        <input type="tel" name="adminmobile" class="form-control" id="adminmobile" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="adminpassword" class="form-control" id="adminpassword" required>
                    </div>
                    <div class="text-center">
                            <span>
                                <input type="submit" class="btn credit-btn box-shadow btn-2" name="adminsubmit"
                                       value="adminsubmit">
                            </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br><br>

<?php
$result = mysqli_query($link, "SELECT * FROM admin");
if (mysqli_num_rows($result) > 0) {
?>
<br>
<form action="">
    <table class="table1">
        <tr>
            <th>Name</th>
            <th>EmailID</th>
            <th>Mob no</th>
            <th>Status</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?= htmlspecialchars($row['a_name']);?></td>
            <td><?= htmlspecialchars($row['a_email']);?></td>
            <td><?= htmlspecialchars($row['a_mobile']);?></td>

            <?php
            if($row['status']==0)
            {

            ?>
                <td><a href="sacreateadmin.php?a=1&id=<?= $row['a_id'];?>" class ="btn btn-template-main">Active</a></td>
            <?php
            }
            else
            {
            ?>
                <td><a href="sacreateadmin.php?a=0&id=<?= $row['a_id'];?>" class ="btn btn-template-main">Deactive</a></td>
            <?php
            }
            ?>
        </tr>
        <?php } ?>
    </table>

</form>
</br></br>
<?php } ?>

<?php include("../footer.php"); ?>
<?php include("../footerjs.php"); ?>
</body>
</html>
