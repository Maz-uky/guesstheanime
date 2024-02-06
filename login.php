<?php
session_start(['cookie_lifetime' => 604800]);
include ($_SERVER['DOCUMENT_ROOT']."/data.php");

$db_host = "mysql33.1blu.de";
$db_user = "s350929_3538727";
$db_password = "1PX86quM6EXFNAcF!F6";
$db_name = "db350929x3538727";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Überprüfen Sie die Verbindung
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errors = array();
$dataArray = array();

$username = mysqli_real_escape_string($webspace_01, $_GET['username']);
$password = mysqli_real_escape_string($webspace_01, $_GET['password']);

if(empty($username) || empty($password)){
    $errors['email'] = "Username and password are required.";
} else {
    $query = "SELECT * FROM user WHERE user_name = ?";
    $stmt = $webspace_01->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res->num_rows > 0){
        $fetch = $res->fetch_assoc();
        $fetch_pass = $fetch['user_password'];
        
        if(password_verify($password, $fetch_pass)){
            $_SESSION['id'] = $fetch['user_id'];
            $_SESSION['username'] = $fetch['user_name'];

            $getDataQuery = "SELECT * FROM savedata WHERE user_id = ?";
            $getDataStmt = $conn->prepare($getDataQuery);
            $getDataStmt->bind_param('s', $_SESSION['id']);
            $getDataStmt->execute();
            $dataResult = $getDataStmt->get_result();

             // Daten im localStorage speichern
             while ($dataRow = $dataResult->fetch_assoc()) {
                $game_id = $dataRow['game_id'];
                $currentNumber = $dataRow['currentNumber'];
                $Number = $dataRow['number'];
                $loseNumber = $dataRow['loseNumber'];
                $win = $dataRow['win'];
                $allUnlocked = $dataRow['allUnlocked'];
                $guess = $dataRow['guess'];
                
                $dataArray[] = array(
                    'game_id' => $game_id,
                    'currentNumber' => $currentNumber,
                    'Number' => $Number,
                    'loseNumber' => $loseNumber,
                    'win' => $win,
                    'allUnlocked' => $allUnlocked,
                    'guess' => $guess
                );

            }

            $errors['email'] = "Login successful!";
            $response['success'] = true;
            $response['data'] = $dataArray;
        } else {
            $errors['email'] = "Incorrect username or password!";
        }
    } else {
        $errors['email'] = "It looks like you're not yet a member! Click on the bottom link to sign up.";
    } 
}

$response['error'] = $errors['email'];

$webspace_01->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
