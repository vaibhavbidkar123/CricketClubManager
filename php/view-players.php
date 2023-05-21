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

    $sql = "SELECT * FROM PLAYER_TABLE WHERE TEAM_ID = '$teamID'";
    $result = $conn->query($sql);

    echo "<link rel='stylesheet' type='text/css' href='../css/view-player.css'>";
    echo "<h1>View Players</h1>";
    echo "<div class='card-container'>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $playerImage = $row['PLAYER_IMAGE'];
            $jerseyNumber = $row['JERSEY_NO'];
            $playerName = $row['PLAYER_NAME'];
            $playerRole = $row['ROLE'];
            $playerAge = $row['AGE'];
            $playerID = $row['PLAYER_ID'];

            $teamID = $row['TEAM_ID'];

            echo "<div class='card'>";
            echo "<a href='../php/player-stats.php?player_id={$playerID}'>"; 
            echo "<img class='img-player' src='../player-images/$playerImage' alt='Player Image'>";
            echo "</a>";
            echo "<h3>Jersey Number: $jerseyNumber</h3>";
            echo "<p>Name: $playerName</p>";
            echo "<p>Role: $playerRole</p>";
            echo "<p>Age: $playerAge</p>";
            echo "</div>";
        }
    } else {
        echo "There are no players in this team.";
    }

    echo "</div>";
    echo "<div class='button-container'>";
    echo "<button class='action-button' onclick=\"window.location.href = '../php/add-player.php?team_id={$teamID}';\">Add Player</button>";
    echo "<button class='action-button' onclick=\"if(confirm('Are you sure you want to delete this team?')){ window.location.href = '../php/delete-team.php?team_id={$teamID}'; }\">Delete Team</button>";
    echo "</div>";
    
} else {
    echo "Team ID is missing in the URL!";
}
?>
