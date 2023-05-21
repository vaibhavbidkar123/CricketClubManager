<?php

session_start(); 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "cricketclub"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coachName = $_POST["coachname"];
    $password = $_POST["password"];

   
    if ($coachName === 'admin' && $password === '1234') {
    
        header("Location: admin-page.php");
        exit; 
    }


  
    $sql = "SELECT * FROM COACH_TABLE WHERE COACH_NAME = '$coachName' AND PASSWORD = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
      
        $row = $result->fetch_assoc();
        $coachID = $row['COACH_ID'];
 
        $_SESSION['coach_id'] = $coachID;
        echo "Login successful!";
        header("Location: ../html/home.html");
    } else {
        echo "Invalid credentials!";
    }
}


$conn->close();
?>
