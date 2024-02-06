<?php
// Verbindung zur MySQL-Datenbank herstellen (ersetze die unten stehenden Informationen mit deinen eigenen)
$db_host = 'mysql33.1blu.de';
$db_user = 's350929_3538727';
$db_password = '1PX86quM6EXFNAcF!F6';
$db_name = 'db350929x3538727';

$webspace = new mysqli($db_host, $db_user, $db_password, $db_name);

// Prüfen, ob die Verbindung erfolgreich hergestellt wurde
if ($webspace->connect_error) {
    die('Verbindung zur Datenbank fehlgeschlagen: ' . $webspace->connect_error);
}

// Suchbegriff aus der AJAX-Anfrage abrufen
$searchQuery = $_GET['query'];

// SQL-Abfrage vorbereiten (hier wird angenommen, dass die Tabelle "deine_tabelle" ein Feld "name" enthält)
$sql = "SELECT * FROM guesstheanime WHERE anime_name LIKE '%$searchQuery%' OR anime_name_eng LIKE '%$searchQuery%'";

// SQL-Abfrage ausführen
$result = $webspace->query($sql);

// Ergebnisse in ein assoziatives Array umwandeln
$results = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Füge den Originalnamen und den englischen Namen in das Ergebnis-Array ein
        $results[] = array(
            $row['anime_name'],
            $row['anime_name_eng']
        );
    }
}

// JSON-Antwort an den Client senden
header('Content-Type: application/json');
echo json_encode($results);

// Verbindung zur Datenbank schließen
$webspace->close();
?>
