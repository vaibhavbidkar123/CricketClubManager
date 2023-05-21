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

    $sql = "SELECT * FROM PLAYER_TABLE WHERE PLAYER_ID = '$playerID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $playerImage = $row['PLAYER_IMAGE'];
        $jerseyNumber = $row['JERSEY_NO'];
        $playerName = $row['PLAYER_NAME'];
        $playerRole = $row['ROLE'];
        $playerAge = $row['AGE'];
        $totalMatchesPlayed = $row['TOTAL_MATCHES'];
        $totalRuns = $row['TOTAL_RUNS'];
        $notOuts = $row['NOT_OUTS'];
        $ballsFaced = $row['BALLS_FACED'];
        $ballsBowled = $row['BALLS_BOWLED'];
        $runsGiven = $row['RUNS_GIVEN'];
        $wicketsTaken = $row['TOTAL_WICKETS'];

        // Calculate additional player stats
        $battingAverage = ($totalMatchesPlayed - $notOuts) > 0 ? ($totalRuns / ($totalMatchesPlayed - $notOuts)) : "-";
        $battingStrikeRate = $ballsFaced > 0 ? (($totalRuns / $ballsFaced) * 100) : "-";
        $bowlingEconomy = ($ballsBowled / 6) > 0 ? ($runsGiven / ($ballsBowled / 6)) : "-";

        echo "<link rel='stylesheet' type='text/css' href='../css/player-stat.css'>";
        echo "<h1>Player Stats</h1>";
        echo "<div class='player-container'>";
        echo "<img src='../player-images/$playerImage' alt='Player Image'>";
        echo "<h3>Jersey Number: $jerseyNumber</h3>";
        echo "<p>Name: $playerName</p>";
        echo "<p>Role: $playerRole</p>";
        echo "<p>Age: $playerAge</p>";
        echo "<h3>Player Statistics</h3>";
        echo "<table>";
        echo "<tr><th>Total Matches Played</th><td>$totalMatchesPlayed</td></tr>";
        echo "<tr><th>Total Runs</th><td>$totalRuns</td></tr>";
        echo "<tr><th>Not Outs</th><td>$notOuts</td></tr>";
        echo "<tr><th>Balls Faced</th><td>$ballsFaced</td></tr>";
        echo "<tr><th>Batting Average</th><td>$battingAverage</td></tr>";
        echo "<tr><th>Batting Strike Rate</th><td>$battingStrikeRate</td></tr>";
        echo "<tr><th>Balls Bowled</th><td>$ballsBowled</td></tr>";
        echo "<tr><th>Runs Given</th><td>$runsGiven</td></tr>";
        echo "<tr><th>Wickets Taken</th><td>$wicketsTaken</td></tr>";
        echo "<tr><th>Bowling Economy</th><td>$bowlingEconomy</td></tr>";
        echo "</table>";
        echo "</div>";
        echo "<button class='center-button' onclick=\"window.location.href = '../php/update-stats.php?player_id={$playerID}';\">Update Stats</button>";
        echo "<button class='center-button' onclick=\"if(confirm('Are you sure you want to delete this player?')){window.location.href = '../php/delete-player.php?player_id={$playerID}';}\">Delete Player</button>";
    } else {
        echo "Player not found.";
    }

    $conn->close();
} else {
    echo "Player ID is missing in the URL!";
}
?>
