<?php
session_start();

include("../config.php");

if (!isset($_SESSION['u_id'])) {
    header("Location: ../index.php");
    exit;
}

// Consolidate image upload code into a reusable function
function upload_file($name, &$errors) {
    if ($_FILES[$name]['error'] == UPLOAD_ERR_OK) {
        $file_name = $_FILES[$name]['name'];
        $file_tmp = $_FILES[$name]['tmp_name'];
        $file_size = $_FILES[$name]['size'];
        $file_type = $_FILES[$name]['type'];

        $folder = "uploads/";
        $final_file = rand(1000, 100000) . "-" . str_replace(' ', '-', $file_name);
        $imgupload = $folder . "" . $final_file;
        $imgsave = "uploads/" . "" . $final_file;

        if (!move_uploaded_file($file_tmp, $folder . $final_file)) {
            $errors[] = "Error uploading $name image";
        }

        return $imgsave;
    } else {
        $errors[] = "Error uploading $name image";
        return "";
    }
}

$errors = [];

if (isset($_POST['all_submit'])) {
    $u_id = $_SESSION['u_id'];

    // Validate user input
    if (empty($_POST['adharid']) || !ctype_digit($_POST['adharid']) || strlen($_POST['adharid']) !== 12) {
        $errors[] = "Adhar ID must be a 12-digit number";
    }
    if (empty($_POST['totalmonths']) || !ctype_digit($_POST['totalmonths'])) {
        $errors[] = "Total Months must be a number";
    }
    if (empty($_POST['loanamount']) || !ctype_digit($_POST['loanamount'])) {
        $errors[] = "Loan Amount must be a number";
    }

    if (empty($errors)) {
        $Adhar_ID = mysqli_real_escape_string($conn, $_POST['adharid']);
        $Loan_Type = mysqli_real_escape_string($conn, $_POST['loantype']);
        $Total_Months = mysqli_real_escape_string($conn, $_POST['totalmonths']);
        $Loan_Amount = mysqli_real_escape_string($conn, $_POST['loanamount']);

        $percentage_result = mysqli_query($conn, "SELECT rate FROM emi WHERE cat = '$Loan_Type'");
        if (!$percentage_result) {
            die('Could not execute query: ' . mysqli_error());
        }
        $row_percentage = mysqli_fetch_array($percentage_result);
        $Percentage = $row_percentage['rate'];

        $loan_id = "LID" . $u_id . rand(1000, 100000);

        $DL = upload_file("dl", $errors);
        $PAN = upload_file("pan", $errors);
        $Residence = upload_file("residence", $errors);

        if (empty($errors)) {
            // Use prepared statement to protect against SQL injection attacks
            $stmt = mysqli_prepare($conn, "INSERT INTO applyloan (u_id, loan_id, DL, PAN, Residence, Adhar_id, Loantype, Totalmonths, Loanamount, Percentage, status)
                                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')
                                           ON DUPLICATE KEY UPDATE
                                           DL = VALUES(DL),
                                           PAN = VALUES(PAN),
                                           Residence = VALUES(Residence),
                                           Adhar_id = VALUES(Adhar_id),
                                           Loantype = VALUES(Loantype),
                                           Totalmonths = VALUES(Totalmonths),
                                           Loanamount = VALUES(Loanamount),
                                           Percentage = VALUES(Percentage)");
            mysqli_stmt_bind_param($stmt, "ssssssssss", $u_id, $loan_id, $DL, $PAN, $Residence, $Adhar_ID, $Loan_Type, $Total_Months, $Loan_Amount, $Percentage);
            if (!mysqli_stmt_execute($stmt)) {
                die('Could not execute query: ' . mysqli_error());
            }
            mysqli_stmt_close($stmt);
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
                           <?php } ?>
    <br><br>
    <h4 class="align">Apply Loan</h4>
    <br>
    <br>

    <?php foreach ($errors as $error): ?>
        <p style='color:red'><?php echo $error; ?></p>
    <?php endforeach; ?>

    <form action="applyloan.php" method="post" enctype="multipart/form-data"><br>
        <table class="table2">
            <tr>
                <th>Salary Slip (if Salaried) / COI (if owner)</th>
                <td><input type="file" name="dl" required></td>
            </tr>
            <tr>
                <th>PAN Card <font color="red">*</font></th>
                <td><input type="file" name="pan" required></td>
            </tr>
            <tr>
                <th>Residence Proof<font color="red">*</font></th>
                <td><input type="file" name="residence" required></td>
            </tr>
            <tr>
                <th>Adhar ID</th>
                <td> <input type="text" name="adharid" maxlength="12" required></td>
            </tr>
            <tr>
                <th>Loan Type </th>
                <td>
                    <select name="loantype" class="form-control course">
                        <?php
                        $query = mysqli_query($conn, "SELECT cat FROM emi");
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <option value="<?php echo $row['cat']; ?>">
                                    <?php echo $row['cat']; ?></option>
                            <?php }
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Total Months </th>
                <td><input type="text" name="totalmonths" required></td>
            </tr>
            <tr>
                <th>Loan Amount </th>
                <td><input type="text" name="loanamount" required></td>
            </tr>
            <div style="display:none;">
                <tr style="display:none;">
                    <th>Percentage </th>
                    <td>
                        <input type="text" name="percentage" disabled>
                    </td>
                </tr>
            </div>
            <tr>
                <th></th>
                <td>
                    <input type="submit" class="btn credit-btn box-shadow btn-2" name="all_submit">
                </td>
            </tr>
        </table>
    </form>

    <div class="align" style=""></div>
    <br><br>

    <?php include("../footer.php"); ?>
    <?php include("../footerjs.php"); ?>

</body>

</html>
