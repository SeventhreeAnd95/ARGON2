<?php
session_start();
$_SESSION['current'] = 'home';
include("../config.php");

if(isset($_GET['uid']))
{
	if(isset($_GET['lid']))
	{
		$uid=$_GET["uid"];
		$lid=$_GET['lid'];
		$result = mysql_query("SELECT * FROM applyloan WHERE status ='Approved' and loan_id = '$lid' and u_id=".$uid)or die(mysql_error());
		if($row = mysql_fetch_array( $result ))
		{
			$loan_type = $row['Loantype']; 
			$loanamount = $row['Loanamount']; 
			$tenure = $row['Totalmonths']; 
			$interestrate = $row['Percentage'];  
			$startdate = $row['startdate'];  
			$curmonth = $row['curmonth'];  
			
			$today = date('d-m-Y');
			$today_date = date_create($today);
			$date = date_create($startdate);
			$monthlyrate = $interestrate/12;
			$p_into_r = $loanamount*$monthlyrate/100;
			$static = 1;
			$static_plus_r = $static + ($monthlyrate/100) ;
			$static_plus_r_restto_n =round(pow($static_plus_r, $tenure),5);
			$static_plus_r_restto_n_1 = round($static_plus_r_restto_n-1,5);
			$emimonthly = round($p_into_r*($static_plus_r_restto_n/$static_plus_r_restto_n_1),2);
		}
		else
		{
			header("Location:../logout.php");
		}

	}
	else
	{
		header("Location:../logout.php");
	}
}
else
{
	header("Location: logout.php");
}
	


?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="custom.css">
    <?php include("../head.php"); ?>
</head>

<body>

    <?php include("../header.php"); ?>
<br>
<h4 class="align">Emi Calculation</h4>
<br>
<?php
if(isset($_GET['lid']))
{
?>
		<h4 class="align"> Display For monthly EMI</h4>
		
		<table class="table1">	
			<tr>
				<th>Month</th>
				<th>Opening Amount </th>
				<th>Interest Rate</th>
				<th>Interest Amount</th>
				<th>Total with Interest</th>
				<th>PayEMI</th>
				<th>Closing Amount </th>
				<th>Due Date</th>
				<th>Payment Status </th>				
			</tr>
			<?php
			for($i=1;$i<=$tenure;$i++)
			{
				date_add($date,date_interval_create_from_date_string("30 days"));
			?>
			<tr>
				<td><?php echo $i;?> </td>
				<td><?php echo round($loanamount,2);?></td>
				<td><?php echo $interestrate;?></td>
				<td><?php echo round(($loanamount*$interestrate/100)/12,2);?></td>
				<td><?php echo round($loanamount + (($loanamount*$interestrate/100)/12),2);?></td>
				<td><?php echo $emimonthly;?></td>
				<td><?php echo round(($loanamount + (($loanamount*$interestrate/100)/12))-$emimonthly,2);?></td>
				<td><?php echo date_format($date,"d-m-Y");?></td>
				<td><?php 
					if($curmonth<$i)
					{
						if($date < $today_date)
						{
							$duedatep =   "&duedate=".date_format($date,"d-m-Y");
							$cdatep =   "&cdate=".date_format($today_date,"d-m-Y");
						
						
						
						echo "<div style='background-color:red' class='btn credit-btn box-shadow btn-2'>Payment Due</div>"	;	
						
						}else
						{
							echo "Pending";
						}
					}
					else
					{
							echo "<div style='background-color:green' class='btn credit-btn box-shadow btn-2'>Paid</div>"	;
					}
					?>
				</td>
			</tr>
			<?php
			$loanamount =round(($loanamount + (($loanamount*$interestrate/100)/12))-$emimonthly,2);
			}
			?>
			
			
			
		</table>
<?php
}
?>		
<br><br>
		<br><br>
		
	  <?php include("../footer.php"); ?>
    
		<?php include("../footerjs.php"); ?>
</body>
</html>