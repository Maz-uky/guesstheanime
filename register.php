<?php
session_start(['cookie_lifetime' => 604800]);
include ($_SERVER['DOCUMENT_ROOT']."/data.php");

$data = json_decode(file_get_contents('php://input'), true);

$errors = array();

$username = mysqli_real_escape_string($webspace_01, $data['username']);
$email = mysqli_real_escape_string($webspace_01, $data['email']);
$password = mysqli_real_escape_string($webspace_01, $data['password']);
$encpass = password_hash($password, PASSWORD_BCRYPT);

$query = "SELECT * FROM user WHERE user_name = ? OR user_email = ?";
$stmt = $webspace_01->prepare($query);
$stmt->bind_param('ss', $username, $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res) {
    $fetch = $res->fetch_assoc();
    if ($fetch) {
        if ($fetch['user_name'] === $username) {
            $errors['regist'] = "Username is already taken.";
        } else {
            $errors['regist'] = "Email address already exists.";
        }
    } else {
        $insertQuery = "INSERT INTO user (user_name, user_email, user_password) VALUES (?, ?, ?)";
        $insertStmt = $webspace_01->prepare($insertQuery);
        $insertStmt->bind_param('sss', $username, $email, $encpass);

        if ($insertStmt->execute()) {
            $errors['registperf'] = 1;
        } else {
            $errors['regist'] = 'Error inserting data: ' . $webspace_01->error;
        }

        $insertStmt->close();
    }
} else {
    $errors['regist'] = "Error in the query: " . $webspace_01->error;
}

$response['regist'] = $errors['regist'];
$response['registperf'] = $errors['registperf'];

$webspace_01->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
