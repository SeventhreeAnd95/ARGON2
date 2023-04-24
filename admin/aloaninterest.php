<?php
session_start();
$_SESSION['folderstep'] = "../";

include("../config.php");
$message = "";
if(isset($_GET['eid']))
{
    $selected_cid = $_GET['eid'];
    //echo $selected_cid;
    $query="delete from emi where eid=$selected_cid";
    //echo "$query";
    $retval = mysqli_query($conn, $query);
}
if(isset($_POST['submit'])) 
{
        $cname = $_POST['cname'];
        $rate = $_POST['rate'];
        //$loan=$_POST['loan'];
        $check = mysqli_query($conn, "SELECT cat FROM emi WHERE cat='$cname'");
        $num_rows = mysqli_num_rows($check);
        if($num_rows > 0)
        {
            //$e = "<font color='red'>Email already exists...!!</font>";
            //header("Location:signup.php?e=$e");
            $message =  "<font color='red'>Category is already exists</font>";
        }
        else
        {
            $sql = "INSERT INTO emi (cat, rate) VALUES('$cname', $rate)";
            $retval = mysqli_query($conn, $sql);

            if(! $retval ) 
            {
                $message =  "<font color='red'>could not enter.</font>";
            }
            else
            {
                $message =  "<font color='green'>Entered data successfully\n</font>";    
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
    <!-- ##### Header Area End ##### -->

    <?php } ?>
    <br>
    <form action="" method="post">
        <table class="table2">
        
            <h4 class="align">EMI Entry</h4>  
            <br/>
            <?php echo $message;?>
            </br/>  
            <tr>
                <th>Loan Type</th>
                <td>
                    <select name="cname" class="form-control course">
                        <?php
                            $query = mysqli_query($conn, "SELECT cat FROM category");
                            if(mysqli_num_rows($query) > 0 )
                            {
                                while($row = mysqli_fetch_array($query))
                                {   
                                    ?>
                                        <option value="<?php echo $row['cat'];?>"><?php echo $row['cat'];?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <!--<tr><th>Months</th><td><input type="text" name="Months" value=""></td></tr>-->
            <tr>
                <th>Rate</th>
                <td><input type="text" name="rate" value=""></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="text-center">
                        <span>
                            <input type="submit" class="btn credit-btn box-shadow btn-2" name="submit" value="Submit">
                        </span></br></br>
                    </div>
                </td>
            </tr>
        </table>
    </form>

    <?php
        $count = mysqli_query($conn, "SELECT * FROM category") or die(mysqli_error());
        $row_count = mysqli_fetch_array($count);
        if ($row_count != 0) {
    ?>
    <br>
    <form action="">
        <table class="table1 align">
            <tr align="center">
                <th>Name</th>  
                <th>Rate</th> 
                <th>Operation</th>
                
            </tr>
            <?php
                  $qq1 = mysqli_query($conn, "SELECT * FROM emi") or die(mysqli_error());
                  while ($row = mysqli_fetch_array($qq1)) {
                  ?>
            <tr>
                <td><?php echo $row['cat'];?></td>
                <td><?php echo $row['rate'];?></td>
                <?php echo '<td><a href="aloaninterest.php?eid='.$row['eid'].'">Delete</a></td>';?>
            </tr>
            
            
            <?php }?>
        </table>

        
    </form></br></br>
    <?php }?>
    
    <!-- ##### Footer Area Start ##### -->
    <?php include("../footer.php"); ?>
    <?php include("../footerjs.php"); ?>
    
</body>
</html>
