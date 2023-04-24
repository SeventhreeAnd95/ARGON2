<?php
	session_start();
	if(isset($_SESSION["u_id"]))
	{
		unset($_SESSION["u_id"]);	
	}
	if(isset($_SESSION["u_name"]))
	{
		unset($_SESSION["u_name"]);	
	}
	if(isset($_SESSION["sid"]))
	{
		unset($_SESSION["sid"]);	
	}
	if(isset($_SESSION["a_id"]))
	{
		unset($_SESSION["a_id"]);	
	}
	
	if(isset($_SESSION["a_email"]))
	{
		unset($_SESSION["a_email"]);	
	}
	if(isset($_SESSION["a_name"]))
	{
		unset($_SESSION["a_name"]);	
	}
	if(isset($_SESSION["sa_id"]))
	{
		unset($_SESSION["sa_id"]);	
	}
	if(isset($_SESSION["sa_name"]))
	{
		unset($_SESSION["sa_name"]);	
	}
	if(isset($_SESSION["sa_email"]))
	{
		unset($_SESSION["sa_email"]);	
	}
	
	
	session_destroy();

	header("Location: index.php");
	exit;
?>