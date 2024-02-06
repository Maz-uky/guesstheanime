<?php
// Verbindung zur MySQL-Datenbank herstellen
$db_host = 'mysql33.1blu.de';
$db_user = 's350929_3538727';
$db_password = '1PX86quM6EXFNAcF!F6';
$db_name = 'db350929x3538727';

$webspace = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($webspace->connect_error) {
    die('Verbindung zur Datenbank fehlgeschlagen: ' . $webspace->connect_error);
}

// game_id aus der GET-Anfrage holen
$game_id = $_GET['game_id'];

// SQL-Abfrage, um den Namen (gta_name) basierend auf game_id abzurufen
$sql = "SELECT * FROM guesstheanime WHERE guess_number = '".$game_id."'";

$result = $webspace->query($sql);

if ($result) {
    if ($row = $result->fetch_assoc()) {
        $response['correctName'] = $row['anime_name'];
        $response['correctEngName'] = $row['anime_name_eng'];
        $response['tipp_1'] = $row['tipp_1'];
        $response['tipp_2'] = $row['tipp_2'];
        $response['tipp_3'] = $row['tipp_3'];
        $response['tipp_4'] = $row['tipp_4'];
        $response['tipp_5'] = $row['tipp_5'];
        echo json_encode($response);
    } else {
        echo "Name nicht gefunden";
    }
} else {
    echo "Fehler bei der Datenbankabfrage: " . $stmt->error;
}

// Datenbankverbindung schließen
$webspace->close();
?>