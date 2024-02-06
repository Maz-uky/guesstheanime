<?php
include ($_SERVER['DOCUMENT_ROOT']."/data.php");

$searchQuery = $_GET['query'];

$sql = "SELECT * FROM guesstheanime WHERE anime_name LIKE '%$searchQuery%' OR anime_name_eng LIKE '%$searchQuery%'";

$result = $webspace_02->query($sql);

$results = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $results[] = array(
            $row['anime_name'],
            $row['anime_name_eng']
        );
    }
}

header('Content-Type: application/json');
echo json_encode($results);

$webspace_02->close();
?>
