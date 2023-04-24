<?php
session_start();
	include('../config.php');			
		$loan_type=$_POST['loantype'];
		$months=$_POST['months'];
		$rate=$_POST['rate'];		
		
		$sql = "INSERT INTO emientry ". "( loantype, months, rate) "." VALUES('$loan_type','$months','$rate')";
				
			$retval = mysql_query($sql);

			if(! $retval ) 
			{
				//die('Could not enter data: ' . mysql_error());
				//$loc=header("Location: signup.php");
				
			}
			else
			{
				//$loc=header("Location: signup.php");
				//echo "Entered data successfully\n";	
			}
	?>