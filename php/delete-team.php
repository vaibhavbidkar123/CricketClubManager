<?php
session_start();

if (isset($_GET['team_id'])) {
    $teamID = $_GET['team_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cricketclub";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the team
    $sql1 = "DELETE FROM PLAYER_TABLE WHERE TEAM_ID = '$teamID'";
    $sql = "DELETE FROM TEAM_TABLE WHERE TEAM_ID = '$teamID'";

    if($conn->query($sql1) === TRUE){
     if ($conn->query($sql) === TRUE) {
        
        header('Location:../html/home.html');
    } else {
        echo "Error deleting team: " . $conn->error;
    }

    }
    
$conn->close();
   
} else {
    echo "Team ID is missing in the URL!";
} 
?>
