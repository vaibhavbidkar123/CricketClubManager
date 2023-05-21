<?php

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
    $email = $_POST["email"];
    $phoneNumber = $_POST["phonenumber"];
 

   

 
    $sql = "INSERT INTO COACH_TABLE (COACH_ID,COACH_NAME, PASSWORD, EMAIL, PHONE_NUMBER)
            VALUES ('','$coachName', '$password', '$email', '$phoneNumber')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>
