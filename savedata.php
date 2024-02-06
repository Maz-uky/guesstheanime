<?php
session_start(['cookie_lifetime' => 604800]);

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

// Holen Sie sich die POST-Daten
$game_id = $_POST['game_id'];
$currentNumber = $_POST['currentNumber'];
$Number = $_POST['Number'];
$loseNumber = $_POST['loseNumber'];
$allUnlocked = $_POST['allUnlocked'];
$win = $_POST['win'];
$correctName = $_POST['correctName'];
$correctEngName = $_POST['correctEngName'];
$guess = $_POST['guess'];
$user_id = $_SESSION['id'];

// Überprüfen Sie, ob allUnlocked in der Datenbank true ist, um zu entscheiden, ob die Daten gespeichert werden sollen
$checkAllUnlockedQuery = "SELECT * FROM savedata WHERE game_id = $game_id AND allUnlocked = 'true' AND user_id = $user_id ";
$resultAllUnlocked = $conn->query($checkAllUnlockedQuery);

if ($resultAllUnlocked->num_rows == 0) {
    // Überprüfen Sie, ob die game_id bereits existiert
    $checkIfExistsQuery = "SELECT * FROM savedata WHERE game_id = $game_id AND user_id = $user_id";
    $result = $conn->query($checkIfExistsQuery);

    if ($result->num_rows > 0) {
        // Wenn die game_id existiert, aktualisieren Sie den Datensatz
        $updateQuery = "UPDATE savedata SET currentNumber = '$currentNumber', number = '$Number', loseNumber = '$loseNumber', win = '$win', allUnlocked = '$allUnlocked', correctName = '$correctName', correctEngName = '$correctEngName', guess = '$guess' WHERE game_id = $game_id AND user_id = $user_id";
        $conn->query($updateQuery);
    } else {
        // Wenn die game_id nicht existiert, fügen Sie einen neuen Datensatz hinzu
        $insertQuery = "INSERT INTO savedata (game_id, currentNumber, number, loseNumber, win, allUnlocked, correctName, correctEngName, guess, user_id) VALUES ($game_id, '$currentNumber', '$Number', '$loseNumber', '$win', '$allUnlocked', '$correctName', '$correctEngName', '$guess', '$user_id')";
        $conn->query($insertQuery);
    }
}

// Datenbankverbindung schließen
$conn->close();
?>
