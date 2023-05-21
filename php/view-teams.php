<?php
session_start(); // Start the session
echo "<link rel='stylesheet' type='text/css' href='../css/view-team.css'>";
// Check if the coach ID is stored in the session
if (isset($_SESSION['coach_id'])) {
    // Coach ID is available in the session, retrieve it
    $coachID = $_SESSION['coach_id'];

    // Assuming you have already established a database connection

    $servername = "localhost"; // Replace with your server name if different
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "cricketclub"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    // Fetch the teams and their logos for the specific coach from the database
    $sql = "SELECT * FROM TEAM_TABLE t WHERE t.COACH_ID = '$coachID'";
    $result = $conn->query($sql);

    // Include the CSS file
    
    // Output the HTML structure
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
