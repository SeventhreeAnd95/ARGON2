<?php
session_start();
$_SESSION['current'] = 'home';
require("config.php");

if(isset($_POST['pay'])) {
    $cardnum = $_POST['cardnumber'];
    $expdatemm = $_POST['expdatemm'];
    $expdateyy = $_POST['expdateyy'];
    $u_id=$_SESSION["u_id"];
    $loan_id =$_SESSION['lid'];
    $month =$_SESSION['month'];
    $emi=$_SESSION['emi'];
    $duedate =$_SESSION['duedate'];
    $cdate =$_SESSION['cdate'];

    // Validate and sanitize user input
    $cardnum = mysqli_real_escape_string($conn, $_POST['cardnumber']);
    $expdatemm = mysqli_real_escape_string($conn, $_POST['expdatemm']);
    $expdateyy = mysqli_real_escape_string($conn, $_POST['expdateyy']);

    if($loan_id && $month && $emi && $duedate && $cdate) {
        $duedate = date('Y-m-d',strtotime($duedate));
        $cdate = date('Y-m-d',strtotime($cdate));

        // Use prepared statements to make the queries efficient and secure
        $stmt1 = $conn->prepare("SELECT * FROM applyloan WHERE status ='Approved' and loan_id = ? and u_id = ?");
        $stmt1->bind_param("si", $loan_id, $u_id);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        if($row = mysqli_fetch_array($result1)) {
            $stmt2 = $conn->prepare("INSERT INTO payemi (u_id,loan_id, month, emi, duedate, cdate, cardnum, expdatemm, expdateyy) 
                            VALUES(?,?,?,?,?,?,?,?,?)");
            $stmt2->bind_param("isiiisiii", $u_id, $loan_id, $month, $emi, $duedate, $cdate, $cardnum, $expdatemm, $expdateyy);
            $stmt2->execute();

            if($stmt2->affected_rows > 0) {
                $stmt3 = $conn->prepare("UPDATE applyloan SET curmonth = ? WHERE u_id = ? AND loan_id = ?");
                $stmt3->bind_param("isi", $month, $u_id, $loan_id);
                $stmt3->execute();

                if($stmt3->affected_rows > 0) {
                    $stmt4 = $conn->prepare("UPDATE user SET cardnum = ?, expdatemm = ?, expdateyy = ? WHERE u_id = ?");
                    $stmt4->bind_param("iiii", $cardnum, $expdatemm, $expdateyy, $u_id);
                    $stmt4->execute();

                    if($stmt4->affected_rows > 0) {
                        header("Location:emicalculation.php?lid=$loan_id");
                    }
                }
            }
        } else {
            header("Location:logout.php");
        }

    } else {
        header("Location:logout.php");
    }
} else {
    header("Location:logout.php");
}
?>
