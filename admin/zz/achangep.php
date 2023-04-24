<?php
session_start();
include("config.php");
if (isset($_SESSION['a_id'])) {
      $a_id   = $_SESSION['a_id'];
      $error = '';
      if (isset($_POST['cpsubmit'])) {
          $oldpassword       = $_POST['pass'];
          $newpassword       = $_POST['cpass'];
          $repeatnewpassword = $_POST['rcpass'];
          if ($a_id == '' || $newpassword == '' || $repeatnewpassword = '') 
		  {
              $error = 'ERROR: Please fill in all required fields!';
			  header("Location:adminchangepassword.php");
          }
          $qq1 = mysql_query("SELECT * FROM admin where a_id = $a_id") or die(mysql_error());
          $row = mysql_fetch_array($qq1);
          if ($oldpassword != $row['a_password']) 
		  {
              $error = 'ERROR: Old Password does not Match.';
			  header("Location:adminchangepassword.php");
          }
          else if ($_POST['cpass'] == $_POST['rcpass'])
		  {
              $query = mysql_query("UPDATE admin SET  a_password = '$newpassword' WHERE a_id= $a_id and a_password='$oldpassword'") or die(mysql_error());
              $error = 'Updated: Congratulation your Password is Updated.';
			  header("Location:adminchangepassword.php?eid=7");
          } else {
              $error = 'ERROR: New & Repeat Password Should be Same.';
			  header("Location:adminchangepassword.php");
          }
		  echo $error;
      }
  } else {
      //header("Location:login.php");
	  echo " i am printing";
  }

?>