<?php
$servername = "localhost";
$username = "chaman";
$password = "concl@ve@s@hy@dri";
$dbname = "sahyadriconclave";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM form WHERE 1";
if ($result=$conn->query($sql) === TRUE) {
    echo $result;
  }
  else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>
