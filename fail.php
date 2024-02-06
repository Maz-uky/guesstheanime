<?php

include ($_SERVER['DOCUMENT_ROOT']."/data.php");

$enteredName = $_GET['enteredName'];

$sql = "SELECT anime_name_eng FROM guesstheanime WHERE anime_name = '$enteredName'";

$result = $webspace_02->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $gta_name_eng = $row['anime_name_eng'];
    
    $response['gtaNameEng'] = $gta_name_eng;
} else {
    $response['gtaNameEng'] = 'Not found';
}

$webspace_02->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
