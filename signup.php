<?php
session_start();
$_SESSION['current'] = 'home';
include "config.php";
$conn = mysqli_connect('localhost', 'ambredm2_loanservices' ,'3WbpulWaqA}{', 'ambredm2_Ambrevia');

// Check if connection was successful
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}

if(isset($_POST['u_submit'])) {
  // retrieve user input and validate it
  $name = filter_input(INPUT_POST, 'u_name', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'u_email', FILTER_SANITIZE_EMAIL);
  $contact = filter_input(INPUT_POST, 'u_contact', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'u_password', FILTER_SANITIZE_STRING);

  // Check if the password meets the length requirements
if(strlen($password) < 8 || strlen($password) > 20) {
    die("<span style='color:red;'>Password length must be between 6 and 20 characters.</span>");
}


  if(empty($name) || empty($email) || empty($contact) || empty($password)) {
    die("<span style='color:red;'>Please enter all required fields.</span>");
  }

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("<span style='color:red;'>Invalid email address.</span>");
  }

  // add salt to password and hash with Argon2id
  $options = [
      'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
      'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
      'threads' => PASSWORD_ARGON2_DEFAULT_THREADS,
  ];
  $salted_password = $password;
  $hashed_password = password_hash($salted_password, PASSWORD_ARGON2ID, $options);

  // insert user data into database
  $check_stmt = mysqli_prepare($conn, "SELECT u_email FROM user WHERE u_email=?");
  mysqli_stmt_bind_param($check_stmt, 's', $email);
  mysqli_execute($check_stmt);
  $result = mysqli_stmt_get_result($check_stmt);

  if(mysqli_num_rows($result) > 0) {
      die("<span style='color:red;'>Email already exists.</span>");
  } else {
      $stmt = mysqli_prepare($conn, "INSERT INTO user (u_name, u_email, u_contact, u_password) VALUES (?, ?, ?, ?)");
      mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $contact, $hashed_password);
      $success = mysqli_stmt_execute($stmt);

      if(!$success) {
          die("<span style='color:red;'>Could not enter data.</span>");
      } else {
          echo "<span style='color:green;'>Entered data successfully.</span>";
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
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">
	
	<link rel="stylesheet" type="text/css" href="custom.css">
</head>

<body>
    
<!-- ##### Header Area Start ##### -->
<header class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 d-flex justify-content-between">
                        <!-- Logo Area -->
                        <div class="logo">
                            <a href="index.html"><img src="\img\core-img\Ambrevia.png" alt="" style="height:80px; width:150px;"></a>
                        </div>

						
                        <!-- Top Contact Info -->
							<div class="top-contact-info d-flex align-items-center">
								<a href="signup.php" data-toggle="tooltip" data-placement="bottom" title=""><img src="img/core-img/placeholder.png" alt=""> <span>sign up / sign in</span></a>
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

    <!-- ##### Header Area End ##### -->

    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="box"><br><br>
                        <h2 class="text-uppercase">Login</h2>
                        <?php
                        if(isset($_GET["uid"])) {
                            if($_GET["uid"]==1) {
                        ?>
                        <div style="color:red;">
                            Please enter correct details.
                        </div>
                        <?php
                            }
                        }
                        ?>
                        <hr>
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="pass" class="form-control" id="pass" required>
                            </div>
                            <div class="text-center">
                                <span>
                                    <input type="submit" class="btn credit-btn box-shadow btn-2" name="usubmit" value="Submit">
                                </span>
                            </div><br><br>   
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box"><br><br>
                        <h2 class="text-uppercase">Sign Up</h2>
                        
                        <hr>
                        <form action="signup.php" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="u_name" id="u_name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="u_email" id="u_email" placeholder="Email Id" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="tel" class="form-control" name="u_contact" id="u_contact" placeholder="Contact" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="u_password" id="u_password" placeholder="Password" required>
                            </div>
                            <div class="text-center">
                                <span >
                                    <input type="submit" class="btn credit-btn box-shadow btn-2" name="u_submit" value="Submit">
                                </span>
                            </div><br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include("footer.php"); ?>
    <?php include("footerjs.php"); ?> 
</body>
</html>
