<?php
session_start();

if (isset($_GET['player_id'])) {
    $playerID = $_GET['player_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cricketclub";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "DELETE FROM PLAYER_TABLE WHERE PLAYER_ID = '$playerID'";

    if ($conn->query($sql) === TRUE) {
        
        header('Location:../html/home.html');
    } else {
        echo "Error deleting player: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Player ID is missing in the URL!";
}
?>
