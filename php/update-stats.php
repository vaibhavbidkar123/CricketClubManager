<?php
session_start();
echo '<link rel="stylesheet" href="../css/update-player.css">';
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $totalMatchesPlayed = $_POST['total_matches'];
        $totalRuns = $_POST['total_runs'];
        $notOuts = $_POST['not_outs'];
        $ballsFaced = $_POST['balls_faced'];
        $ballsBowled = $_POST['balls_bowled'];
        $runsGiven = $_POST['runs_given'];
        $wicketsTaken = $_POST['wickets_taken'];

        // Update the player stats in the database
        $sql = "UPDATE PLAYER_TABLE SET
                TOTAL_MATCHES = '$totalMatchesPlayed',
                TOTAL_RUNS = '$totalRuns',
                NOT_OUTS = '$notOuts',
                BALLS_FACED = '$ballsFaced',
                BALLS_BOWLED = '$ballsBowled',
                RUNS_GIVEN = '$runsGiven',
                TOTAL_WICKETS = '$wicketsTaken'
                WHERE PLAYER_ID = '$playerID'";

        if ($conn->query($sql) === TRUE) {
            echo "Player stats updated successfully!";
        } else {
            echo "Error updating player stats: " . $conn->error;
        }
    }

    $sql = "SELECT * FROM PLAYER_TABLE WHERE PLAYER_ID = '$playerID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $totalMatchesPlayed = $row['TOTAL_MATCHES'];
        $totalRuns = $row['TOTAL_RUNS'];
        $notOuts = $row['NOT_OUTS'];
        $ballsFaced = $row['BALLS_FACED'];
        $ballsBowled = $row['BALLS_BOWLED'];
        $runsGiven = $row['RUNS_GIVEN'];
        $wicketsTaken = $row['TOTAL_WICKETS'];

        echo "<h1>Update Player Stats</h1>";
        echo "<form method='POST'>";
        echo "<label>Total Matches Played:</label>";
        echo "<input type='number' name='total_matches' value='$totalMatchesPlayed' required><br>";
        echo "<label>Total Runs:</label>";
        echo "<input type='number' name='total_runs' value='$totalRuns' required><br>";
        echo "<label>Not Outs:</label>";
        echo "<input type='number' name='not_outs' value='$notOuts' required><br>";
        echo "<label>Balls Faced:</label>";
        echo "<input type='number' name='balls_faced' value='$ballsFaced' required><br>";
        echo "<label>Balls Bowled:</label>";
        echo "<input type='number' name='balls_bowled' value='$ballsBowled' required><br>";
        echo "<label>Runs Given:</label>";
        echo "<input type='number' name='runs_given' value='$runsGiven' required><br>";
        echo "<label>Wickets Taken:</label>";
        echo "<input type='number' name='wickets_taken' value='$wicketsTaken' required><br>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";
    } else {
        echo "Player not found.";
    }

    $conn->close();
} else {
    echo "Player ID is missing in the URL!";
}
?>
