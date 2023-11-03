<?php
echo '<link rel="stylesheet" href="../css/admin-page.css">';
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "cricketclub";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET["delete"]) && $_GET["delete"] != "") {
  
    $deleteID = $_GET["delete"];
    

  
    $sql = "DELETE FROM COACH_TABLE WHERE COACH_ID = '$deleteID'";
    if ($conn->query($sql) === TRUE) {
        
    } else {
        echo "Error deleting row: " . $conn->error;
    }
}

$sql = "SELECT * FROM COACH_TABLE";
$result = $conn->query($sql);


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Page</title>
  <style>

  </style>
</head>
<body>
  <h1>Admin Page</h1>

  <?php

  if ($result->num_rows > 0) {
 
      echo '<table>';
      echo '<tr><th>ID</th><th>Coach Name</th><th>Password</th><th>Email</th><th>Phone Number</th><th>Team Name</th></tr>';


      while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>'.$row["COACH_ID"].'</td>';
          echo '<td>'.$row["COACH_NAME"].'</td>';
          echo '<td>'.$row["PASSWORD"].'</td>';
          echo '<td>'.$row["EMAIL"].'</td>';
          echo '<td>'.$row["PHONE_NUMBER"].'</td>';
          echo '<td><a href="?delete='.$row["COACH_ID"].'">Delete</a></td>';
          echo '</tr>';
      }

      echo '</table>';
  } else {
      echo '<h1>No records found<h1/>';
  }
  ?>
</body>
</html>
