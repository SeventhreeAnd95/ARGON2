<?php
session_start();
require_once('../config.php');
$e = "";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


// Validate user input
if (empty($_POST['email']) || empty($_POST['password'])) {
    // If email or password is empty, redirect to signup page
    header("Location: index.php");
    exit();
}

// Get user input and sanitize email field
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);




// Retrieve details from database for the given email
$whereCondition = "a_email = ?";

// // Prepare the SQL query with the WHERE clause and bind the variable to a parameter
$stmt = $conn->prepare("SELECT * FROM admin WHERE $whereCondition");
$stmt->bind_param("s", $email);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        
        // Check if the hashed password matches with the one stored in database
        if (password_verify($password, $row['a_password'])) {

            // Generate random OTP
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'mail.ambrevia-loan.co.in';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = '_mainaccount@ambrevia-loan.co.in';                     //SMTP username
                $mail->Password   = 'aFPT$eLag_*+48G';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Recipients
                $mail->setFrom('_mainaccount@ambrevia-loan.co.in', 'Mailer');
                $mail->addAddress($email, $row['a_name']);     //Add a recipient
                

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body = '<p>Hello '.htmlspecialchars($row['a_name']).'</p><p>Your One Time Password is: </p><h1>'.$otp.'</h1>';

                $mail->send();
                
                // Redirect user to authentication page after sending OTP email
                session_start();
                $_SESSION['auth_aid'] = $row['a_id'];
                $_SESSION['auth_aemail'] = $row['a_email'];
                $_SESSION['auth_aname'] = $row['a_name'];
                header("Location: aauthentication.php");
                exit();

            } catch (Exception $e) {
                die("Error sending email: " . $mail->ErrorInfo);
            }
            header("Location: authentication.php");
        } else {
            // Handle case where entered password does not match the one stored in database
            $error_message = "The entered password does not match.";
        }
    } else {
        // Handle case where entered email is not in the database
        $error_message = "The entered email is not in the database.";
    }

    // Redirect to signup page with error message if any
    if (isset($error_message)) {
        header("Location: signup.php?error=".urlencode($error_message));
        exit();
    }

} else {
    die("Error executing SQL query: " . $conn->error);
}
?>