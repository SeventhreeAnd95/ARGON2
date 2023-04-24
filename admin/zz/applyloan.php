<?php
session_start();
$_SESSION['current'] = 'home';
include("config.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" type="text/css" href="custom.css">
    <?php include("../head.php"); ?>
</head>

<body>
    <?php include("../header.php"); ?>
    <!-- ##### Header Area End ##### -->
	<form action="" method="post"><br>
		<h4 class="align">Apply For The Loan</h4><br>
		<table class="table2">
			<tr><th>Photo ID</th><td><input type="text" name="PhotoId" value=""></td></tr>
			<tr><th>Driving Licence</th><td><input type="text" name="DrivingLicence" value=""></td></tr>
			<tr><th>PAN Card</th><td><input type="text" name="PanCard" value=""></td></tr>
			<tr><th>Residence Proof</th><td><input type="text" name="ResidenceProof" value=""></td></tr>				
			<tr><th>Loan Type</th><td><input list="browsers" name="LoanType" class="datalist1">
			<datalist id="browsers">
				<option value="Gold Loan">
				<option value="Personal Loan">
				<option value="Home Loan">
				<option value="Study Loan">					
			</datalist></td></tr>			
			<tr><th>Total Months</th><td><input type="text" name="TotalMonths" value=""></td></tr>
			<tr><th>Loan Amount</th><td><input type="text" name="LoanAmount" value=""></td></tr>
			<tr><th>Percentage</th><td><input type="text" name="Percentage" value="" disabled></td></tr>		
		</table><br>	
	</form>
	
	<div class="align">
		<a href="#" class="btn credit-btn box-shadow btn-2">Submit</a>
	</div><br><br><br>

    <!-- ##### Footer Area Start ##### -->
    <?php include("../footer.php"); ?>
	<?php include("../footerjs.php"); ?>
	
</body>
</html>