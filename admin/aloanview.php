<?php 
    session_start();
    $_SESSION['current'] = 'home';
    require_once("../config.php");
    
if(isset($_GET['lid']))
    {
        $loan_id = $_GET['lid'];
        if(isset($_GET['o']))
        {
            $o= $_GET['o'];
            
            if($o == 1)
            {
                $status="Approved";
            }
            if($o == 2)
            {
                $status="On-hold";
            }
            if($o == 3)
            {
                $status="Rejected";
            }
            $startdate="0000-00-00";
            $query = "update applyloan set status='$status' , startdate='$startdate'  WHERE loan_id='$loan_id'" ;
            $result = mysqli_query($conn, $query);
        }
        
        if(isset($_POST['submit']))
        {
            $startdate= $_POST['startdate'];
            $query = "update applyloan set startdate='$startdate' WHERE loan_id='$loan_id'" ;
            $result = mysqli_query($conn, $query);
        }
    }
  
    $sql = "SELECT * FROM applyloan WHERE loan_id='$loan_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    mysqli_close($conn);
    $dl = $row['DL'];
    $pan = $row['PAN'];
    $Residence = $row['Residence'];
    $Adhar_ID=$row['Adhar_id'];
    $Loan_Type=$row['Loantype'];
    $Total_Months=$row['Totalmonths'];
    $Loan_Amount=$row['Loanamount'];
    $Percentage=$row['Percentage'];
    $status=$row['status'];
    $startdate=$row['startdate'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <title>Credit - Loan & Credit Company HTML Template</title>

    <!-- Favicon -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../custom.css">
</head>
<body>
    <?php if(isset($_SESSION['a_id'])) { ?>
        <header class="header-area">
            <div class="top-header-area">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 d-flex justify-content-between">
                            <div class="logo">
                                <a href="index.html"><img src="../img/core-img/Ambrevia.png" alt="" style="height:80px; width:150px;"></a>
                            </div>

                            <div class="top-contact-info d-flex align-items-center">
                                <span> Admin Welcome, &nbsp;
                                    <?php if(isset($_SESSION['a_name'])) {
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

            <div class="credit-main-menu" id="sticker">
                <div class="classy-nav-container breakpoint-off">
                    <div class="container">
                        <nav class="classy-navbar justify-content-between" id="creditNav">
                            <div class="classy-navbar-toggler">
                                <span class="navbarToggler"><span></span><span></span><span></span></span>
                            </div>

                            <div class="classy-menu">
                                <div class="classycloseIcon">
                                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                                </div>

                                <div class="classynav">
                                    <ul>
                                        <li><a href="aindex.php">Home</a></li>
                                        <li><a href="aviewapp.php">View Loan Application</a></li>
                                        <li><a href="aloaninterest.php">Loan Interest</a></li>
                                        <li><a href="aemidetails.php">Emi Details</a></li>
                                        <li><a href="achangepass.php">Change Password</a></li>
                                    </ul>
                                </div>
                            </div>

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
    <h4 class="align">View Loan Details</h4>
    <br>
    <form action="">
        <table class="table2 align">
            <tr>
                <th>Driving License</th>
                <td><img src="../<?php echo $dl;?>" width="150" height="150" /></td>
            </tr>
            <tr>
                <th>Pan Card</th>
                <td><img src="../<?php echo $pan;?>" width="150" height="150" /></td>
            </tr>
            <tr>
                <th>Residencial Proof</th>
                <td><img src="../<?php echo $Residence;?>" width="150" height="150" /></td>
            </tr>
            <tr>
                <th>Adhar ID</th>
                <td><?php echo $Adhar_ID; ?></td>
            </tr>
            <tr>
                <th>Loan Type</th>
                <td><?php echo $Loan_Type; ?></td>
            </tr>
            <tr>
                <th>Total Months</th>
                <td><?php echo $Total_Months; ?></td>
            </tr>
            <tr>
                <th>Loan Amount</th>
                <td><?php echo $Loan_Amount; ?></td>
            </tr>
            <tr>
                <th>Percentage</th>
                <td><?php echo $Percentage; ?></td>
            </tr>
        </table>
    </form>

    <div align="center">
        <h3> Current Status: <?php echo $status;?> 
        <?php if ($row['status']=="Approved") { ?>
            <br/>Add Start Date <form action="aloanview.php?lid=<?php echo $row['loan_id'];?>" method="post">
            <table>
                <tr><td><input type="date" name="startdate" id = "startdate" value="<?php echo $startdate;?>"/> </td></tr>
                <tr><td><input type="submit" name="submit" class="btn credit-btn box-shadow btn-2"/></td></tr>
            </table></form>
        <?php
            }
        ?>
        </h3>
        
        <h3>Change Status: </h3>
            <a href="aloanview.php?o=1&lid=<?php echo $row['loan_id'];?>"  class="btn credit-btn box-shadow btn-2" style="background-color:green">Approved</a>
            <a href="aloanview.php?o=2&lid=<?php echo $row['loan_id'];?>"  class="btn credit-btn box-shadow btn-2" style="background-color:orange">On-hold</a>
            <a href="aloanview.php?o=3&lid=<?php echo $row['loan_id'];?>"  class="btn credit-btn box-shadow btn-2" style="background-color:red">Reject</a>
    </div>

    <br><br>
        
      <?php include("../footer.php"); ?>
    
        <?php include("../footerjs.php"); ?>
</body>
</html>
