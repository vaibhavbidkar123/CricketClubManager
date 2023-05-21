<?php
session_start(); 
echo "<link rel='stylesheet' type='text/css' href='../css/view-team.css'>";

if (isset($_SESSION['coach_id'])) {
  
    $coachID = $_SESSION['coach_id'];

  

    $servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "cricketclub"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  
    $sql = "SELECT * FROM TEAM_TABLE t WHERE t.COACH_ID = '$coachID'";
    $result = $conn->query($sql);


    echo "<h1>View Teams</h1>";
    echo "<div class='card-container'>";
    

    if ($result->num_rows > 0) {
      
        while ($row = $result->fetch_assoc()) {
            $teamName = $row['TEAM_NAME'];
            $teamLogo = $row['TEAM_LOGO'];
            $teamDESCRIPTION = $row['TEAM_DESCRIPTION'];
            
       
            echo "<div class='card'>";
            echo "<a href='view-players.php?team_id={$row['TEAM_ID']}'>";
            echo "<img src='../team-logos/{$teamLogo}' alt='Team Logo'>";
            echo "</a>";
            echo "<h3>{$teamName}</h3>";
            echo "<p>{$teamDESCRIPTION}</p>";
            echo "</div>";
        }
    } else {
     
        echo "You have no teams.";
    }

    echo "</div>";
} else {
    echo "Coach ID is not set in the session!";
}

?>
