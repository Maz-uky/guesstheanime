<?php
include ($_SERVER['DOCUMENT_ROOT']."/data.php");

$game_id = $_GET['game_id'];

$sql = "SELECT * FROM guesstheanime WHERE guess_number = '".$game_id."'";

$result = $webspace_02->query($sql);

if ($result) {
    if ($row = $result->fetch_assoc()) {
        $response['correctName'] = $row['anime_name'];
        $response['correctEngName'] = $row['anime_name_eng'];
        $response['tipp_1'] = $row['tipp_1'];
        $response['tipp_2'] = $row['tipp_2'];
        $response['tipp_3'] = $row['tipp_3'];
        $response['tipp_4'] = $row['tipp_4'];
        $response['tipp_5'] = $row['tipp_5'];
        $response['stream2'] = $row['prime_video'];
        $response['stream3'] = $row['chrunchyroll'];
        $response['stream4'] = $row['netflix'];
        echo json_encode($response);
    } else {
        echo "Name not found";
    }
} else {
    echo "Error in the database query 02: " . $stmt->error;
}

$webspace_02->close();
?>