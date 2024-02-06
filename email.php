<?php
session_start(['cookie_lifetime' => 604800]);
include ($_SERVER['DOCUMENT_ROOT']."/data.php");

$data = json_decode(file_get_contents('php://input'), true);

$email = mysqli_real_escape_string($webspace_01, $data['email']);

function generateRandomCode($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $code;
}

$verificationCode = generateRandomCode(16);

$query = "SELECT user_name FROM user WHERE user_email = ?";
$stmt = $webspace_01->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

$response = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['user_name'];

    $updateQuery = "UPDATE user SET user_code = ? WHERE user_name = ?";
    $updateStmt = $webspace_01->prepare($updateQuery);
    $updateStmt->bind_param('ss', $verificationCode, $username);
    $updateStmt->execute();

    $subject = "Reset Password Email";
    $message = "Hallo,\n\nTo reset your password, click on the following link:\n\n";
    $message .= "http://guesstheanime.net/reset_password.php?email=$email&code=$verificationCode\n\n";
    $message .= "If you do not wish to reset your password, you can ignore this email.\n\n";
    $message .= "Best regards,\nGuessTheAnime.net | Mazuky.de";
    $sender = "From: no-reply@mazuky.de";

    if (mail($email, $subject, $message, $sender)) {
        $info = "We've sent a verification code to your email - $email";
        $response['reset'] = 1;
        $response['registperf'] = $info;
    } else {
        $response['reset'] = "Failed while sending code!";
    }
} else {
    $response['reset'] = "Error in the query: " . $webspace_01->error;
}

$stmt->close();
$updateStmt->close();
$webspace_01->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
