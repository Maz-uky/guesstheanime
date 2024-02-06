<?php
include ($_SERVER['DOCUMENT_ROOT']."/data.php");

$enteredName = $_GET['enteredName'];

$sql = "SELECT * FROM guesstheanime WHERE anime_name = '".$enteredName."'";

$result = $webspace_02->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $gta_text = $row['detail'];
    $gta_prime_video = $row['prime_video'];
    $gta_crunchyroll = $row['chrunchyroll'];
    $gta_netflix = $row['netflix'];
    $gta_name = $row['anime_name'];
    
    $response['gta_text'] = $gta_text;
    $response['gta_prime_video'] = $gta_prime_video;
    $response['gta_crunchyroll'] = $gta_crunchyroll;
    $response['gta_netflix'] = $gta_netflix;
    $response['gta_name'] = $gta_name;
} else {
    http_response_code(404);
    $response['error'] = 'Not found';
}

$webspace_02->close();

header('Content-Type: application/json');
echo json_encode($response);
?>