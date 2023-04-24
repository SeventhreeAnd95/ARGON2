<?php
  // Start session
  session_start();

  // Set session variables
  $_SESSION['current'] = 'home';
  $_SESSION['folderstep'] = "../";

  // Include config file
  require_once("../config.php");

  // Check if user is authorized to view this page
  if(!isset($_SESSION['sa_id'])) {
    die("Access denied.");
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
  <!-- Header Area Start -->
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
              <span>Super Admin Welcome, <?php 
                if(isset($_SESSION['sa_name'])) {
                  echo $_SESSION['sa_name'];
                }  
              ?> </span>
              
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

  <br>

  <h4 class="align">Admin All Customer Detail</h4>

  <?php
    // Execute SQL query to fetch all user data
    $query = "SELECT * FROM user";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
  ?>
<form action="">
    <table class="table1 align">
      <tr>
        <th>Name</th>  
        <th>Email</th>
        <th>Mob no</th> 
      </tr>

      <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['u_name']; ?></td>
          <td><?php echo $row['u_email']; ?></td>
          <td><?php echo $row['u_contact']; ?></td>
        </tr>
      <?php } ?>

    </table>

  <?php } else { ?>

    <p>No users found.</p>

  <?php } ?>

  <?php
    // Include footer and javascript file
    require_once("../footer.php");
    require_once("../footerjs.php");
  ?>
    
</body>
</html>
