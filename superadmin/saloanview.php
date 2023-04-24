<?php
session_start();
$_SESSION['current'] = 'home';
include("../config.php");

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
        $query = "UPDATE applyloan SET status=?, startdate=? WHERE loan_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $status, $startdate, $loan_id);
        $stmt->execute();
    }

    if(isset($_POST['submit']))
    {
        $startdate= $_POST['startdate'];
        $query = "UPDATE applyloan SET startdate=? WHERE loan_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $startdate, $loan_id);
        $stmt->execute();
    }
}

$sql = "SELECT * FROM applyloan WHERE loan_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $loan_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$dl = htmlspecialchars($row['DL']);
$pan = htmlspecialchars($row['PAN']);
$residence = htmlspecialchars($row['Residence']);
$adhar_id = htmlspecialchars($row['Adhar_id']);
$loan_type = htmlspecialchars($row['Loantype']);
$total_months = htmlspecialchars($row['Totalmonths']);
$loan_amount = htmlspecialchars($row['Loanamount']);
$percentage = htmlspecialchars($row['Percentage']);
$status = htmlspecialchars($row['status']);
$start_date = htmlspecialchars($row['startdate']);

$stmt->close();
$link->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("../head.php"); ?>
</head>
<body>
    <?php include("../header.php"); ?>

    <br>
    <h4 class="align">View Loan Details</h4>
    <br>

    <table class="table2 align">
        <tr>
            <th>Driving License</th>
            <td><img src="../<?php echo $dl; ?>" width="150" height="150" /></td>
        </tr>
        <tr>
            <th>Pan Card</th>
            <td><img src="../<?php echo $pan; ?>" width="150" height="150" /></td>
        </tr>
        <tr>
            <th>Residential Proof</th>
            <td><img src="../<?php echo $residence; ?>" width="150" height="150" /></td>
        </tr>
        <tr>
            <th>Adhar ID</th>
            <td><?php echo $adhar_id; ?></td>
        </tr>
        <tr>
            <th>Loan Type</th>
            <td><?php echo $loan_type; ?></td>
        </tr>
        <tr>
            <th>Total Months</th>
            <td><?php echo $total_months; ?></td>
        </tr>
        <tr>
            <th>Loan Amount</th>
            <td><?php echo $loan_amount; ?></td>
        </tr>
        <tr>
            <th>Percentage</th>
            <td><?php echo $percentage; ?></td>
        </tr>
    </table>

    <div align="center">
        <h3> Current Status: <?php echo $status; ?></h3>
    </div>

    <br><br>

    <?php include("../footer.php"); ?>
    <?php include("../footerjs.php"); ?>
</body>
</html>
