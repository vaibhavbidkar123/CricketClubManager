<?php
echo " <style>
body {
    background-color: #333366;
}
</style>";
session_start();
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "cricketclub"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$teamName = $_POST['team_name'];
$coachID = $_SESSION['coach_id'];
$teamLogo = $_FILES['team_logo']['name'];
$teamDescription = $_POST['team_description'];


$targetDirectory = "../team-logos/"; 
$targetFile = $targetDirectory . basename($_FILES['team_logo']['name']);


move_uploaded_file($_FILES['team_logo']['tmp_name'], $targetFile);


$sql = "INSERT INTO TEAM_TABLE (TEAM_NAME, COACH_ID, TEAM_LOGO, TEAM_DESCRIPTION) 
        VALUES ('$teamName', '$coachID', '$teamLogo', '$teamDescription')";
        

if ($conn->query($sql) === TRUE) {

    echo "<dialog open><h3>Team added successfully!<h3/><dialog/>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
