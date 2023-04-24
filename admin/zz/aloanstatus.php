<?php
session_start();
$_SESSION['current'] = 'home';
include("../config.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../head.php"); ?>
	<link rel="stylesheet" type="text/css" href="custom.css">
</head>

<body>
    <?php include("../header.php"); ?><br><br>
    <!-- ##### Header Area End ##### -->
	<?php
		$count = mysql_query("SELECT * FROM user") or die(mysql_error());
		$row_count = mysql_fetch_array($count);
		if ($row_count != 0) {
	?>	
		
	<form action="interest.php" method="post">
		<h4 class="align">Current Status Of Your Loan</h4></br></br>
				
			<br>
			<table class="table1">
				<tr>
					<th>Loan ID</th>
					<th>Name</th> 
					<th>Status(Active/Deactive)</th>
				</tr>
				<?php
                  $qq1 = mysql_query("SELECT * FROM user") or die(mysql_error());
                  while ($row = mysql_fetch_array($qq1)) {
                  ?>
				<tr>
					<td>12145</td>
					<td><?php echo $row['u_name'];?></td> 
					<td>Active<!-- <input type="button" name="status" value="Active"> --></td>
				</tr>
				  <?php }?>
			</table><br><br>
	</form>
				<?php }?>
		
    <!-- ##### Footer Area Start ##### -->
    <?php include("../footer.php"); ?>    
	<?php include("../footerjs.php"); ?>
	
</body>
</html>