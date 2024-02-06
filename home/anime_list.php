<?php
include ($_SERVER['DOCUMENT_ROOT']."/data.php");

$sql = "SELECT * FROM guesstheanime WHERE guess_number >= 1 ORDER BY guess_number ASC";

$result = $webspace_02->query($sql);

if ($result) {
    $animeList = array();
    while ($row = $result->fetch_assoc()) {
        $animeList[] = $row['guess_number'];
    }

    echo json_encode($animeList);
} else {
    echo 'Fehler beim Abrufen der Daten: ' . $webspace_02->error;
}

$webspace_02->close();
?>
