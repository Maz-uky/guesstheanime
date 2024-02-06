<?php

$db_host = 'mysql33.1blu.de';
$db_user = 's350929_3538727';
$db_password = '1PX86quM6EXFNAcF!F6';
$db_name = 'db350929x3538727';

// Verbindung zur Datenbank herstellen
$webspace = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($webspace->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $webspace->connect_error);
}

$enteredName = $_GET['enteredName'];

// SQL-Abfrage erstellen, um den Namen abzurufen
$sql = "SELECT * FROM guesstheanime WHERE anime_name = '".$enteredName."'";

$result = $webspace->query($sql);

$response = array();

if ($result->num_rows > 0) {
    // Datensatz gefunden
    $row = $result->fetch_assoc();
    $gta_text = $row['detail'];
    $gta_amazon = $row['amazon'];
    $gta_prime_video = $row['prime_video'];
    $gta_chrunchyroll = $row['chrunchyroll'];
    $gta_netflix = $row['netflix'];
    $gta_name = $row['anime_name'];
    
    $response['gta_text'] = $gta_text;
    $response['gta_amazon'] = $gta_amazon;
    $response['gta_prime_video'] = $gta_prime_video;
    $response['gta_chrunchyroll'] = $gta_chrunchyroll;
    $response['gta_netflix'] = $gta_netflix;
    $response['gta_name'] = $gta_name;
} else {
    // Kein Datensatz gefunden
    http_response_code(404);
    $response['error'] = 'Nicht gefunden';
}

$webspace->close();

header('Content-Type: application/json');
echo json_encode($response);
?>