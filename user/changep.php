<?php 
session_start();
require_once("config.php");

if (!isset($_SESSION['u_id']) || empty($_SESSION['u_id'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION['u_id'])) {
    $u_id = $_SESSION['u_id'];
    $error = '';
    if (isset($_POST['cpsubmit'])) {
        $oldpassword = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
        $newpassword = filter_input(INPUT_POST, 'cpass', FILTER_SANITIZE_STRING);
        $repeatnewpassword = filter_input(INPUT_POST, 'rcpass', FILTER_SANITIZE_STRING);
        if (empty($u_id) || empty($newpassword) || empty($repeatnewpassword)) {
            $error = '<span style="color:red;">ERROR: Please fill in all required fields!</span>';
        } else {
            $stmt = $conn->prepare("SELECT u_password FROM user WHERE u_id = ?");
            $stmt->execute([$u_id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $oldPasswordHash = $row['u_password'];
            if (!password_verify($oldpassword, $oldPasswordHash)) {
                $error = '<span style="color:red;">ERROR: Old Password does not Match.</span>';
            } elseif ($newpassword === $repeatnewpassword) {
                $newPasswordHash = password_hash($newpassword, PASSWORD_ARGON2ID);
                $stmt = $conn->prepare("UPDATE user SET u_password = ? WHERE u_id = ?");
                $stmt->execute([$newPasswordHash, $u_id]);
                if ($stmt->rowCount() > 0) {
                    session_regenerate_id();
                    $error = '<span style="color:green;">Congratulations, your password has been updated.</span>';
                } else {
                    $error = '<span style="color:red;">ERROR: Failed to update password.</span>';
                }
            } else {
                $error = '<span style="color:red;">ERROR: New & Repeat Password should be Same.</span>';
            }
        }
    }
} else {
    header("Location: login.php");
    exit;
}
$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
</head>
<body>
    <?php if (!empty($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="">
        <input type="password" name="pass" placeholder="Old Password">
        <input type="password" name="cpass" placeholder="New Password">
        <input type="password" name="rcpass" placeholder="Repeat Password">
        <button type="submit" name="cpsubmit">Submit</button>
    </form>
</body>
</html>
