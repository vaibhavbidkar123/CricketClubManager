<?php

 $teamid = $_GET['team_id'];
 echo '<!DOCTYPE html>';
 echo '<html lang="en">';
 echo '<head>';
 echo '    <meta charset="UTF-8">';
 echo '    <meta http-equiv="X-UA-Compatible" content="IE=edge">';
 echo '    <meta name="viewport" content="width=device-width, initial-scale=1.0">';
 echo '<link rel="stylesheet" href="../css/add-player.css">';
 echo '    <title>Add Player</title>';
 echo '</head>';
 echo '<body>';
 echo '    <h1>ADD PLAYER</h1>';
 echo '    <form action="../php/add-player.php" method="post" autocomplete="off" enctype="multipart/form-data">';
 echo '<input type="hidden" name="teamid" value="' . $teamid . '">';
 echo '        <table border="1" align="center">';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Player Name</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="text" name="name">';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Age</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="text" name="age">';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Photo</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="file" name="image" accept=".jpg, .jpeg, .png">';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Jersey Number</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="text" name="jersey">';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Role</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="radio" name="role" value="batsman"> Batsman';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="radio" name="role" value="bowler"> Bowler';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="radio" name="role" value="all rounder"> All Rounder';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Matches Played</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="text" name="matches">';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Total Runs</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="text" name="totalruns">';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Not Outs</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="text" name="notouts">';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Balls Faced</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="text" name="ballsfaced">';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Balls Bowled</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="text" name="ballsbowled">';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Runs Given</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="text" name="runsgiven">';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td>';
 echo '                    <label>Wickets Taken</label>';
 echo '                </td>';
 echo '                <td>';
 echo '                    <input type="text" name="wickets">';
 echo '                </td>';
 echo '            </tr>';
 echo '            <tr>';
 echo '                <td colspan="2">';
 echo '                    <input type="submit" name="save" value="Submit" style="font-size:20px"></td>';
 echo '            </tr>';
 echo '        </table>';
 echo '    </form>';
 echo '</body>';
 echo '</html>';
 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $age = $_POST['age'];
    $jersey = $_POST['jersey'];
    $role = $_POST['role'];
    $matches = $_POST['matches'];
    $totalruns = $_POST['totalruns'];
    $notouts = $_POST['notouts'];
    $ballsfaced = $_POST['ballsfaced'];
    $ballsbowled = $_POST['ballsbowled'];
    $runsgiven = $_POST['runsgiven'];
    $wickets = $_POST['wickets'];
    $teamid = $_POST['teamid'];
    
    $playerImage = $_FILES['image']['name'];
    $playerImageTmp = $_FILES['image']['tmp_name'];
    $targetDirectory = "../player-images/"; 

  
    $playerImageName = uniqid() . '_' . $playerImage;

 
    $targetPath = $targetDirectory . $playerImageName;

 
    move_uploaded_file($playerImageTmp, $targetPath);
 
    session_start();
    

 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cricketclub";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

 
    $stmt = $conn->prepare("INSERT INTO PLAYER_TABLE (PLAYER_NAME, AGE,PLAYER_IMAGE, JERSEY_NO, ROLE, TOTAL_MATCHES, TOTAL_RUNS, NOT_OUTS, BALLS_FACED, BALLS_BOWLED, RUNS_GIVEN, TOTAL_WICKETS, TEAM_ID ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisisiiiiiiii", $name, $age, $playerImageName, $jersey, $role, $matches, $totalruns, $notouts, $ballsfaced, $ballsbowled, $runsgiven, $wickets, $teamid);
 
    if ($stmt->execute()) {

        echo "Player added successfully!";
        header('Location:../html/home.html');
    } else {

        echo "Error: " . $stmt->error;
    }

 
    $stmt->close();
    $conn->close();
}

?>
