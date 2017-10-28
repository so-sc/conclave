<?php
$servername = "localhost";
$username = "chaman";
$password = "concl@ve@s@hy@dri";
$dbname = "sahyadriconclave";
$result = "";
$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_errno) {
    echo "Connectin to database failed: ".$mysqli->connect_error;
   exit();
}
$sql = "SELECT * FROM form";
if(!$result = $mysqli->query($sql)){
    die('There was an error running the query [' . $mysqli->error . ']');
}
while($row = $result->fetch_assoc()){
    //echo $row['gender'] . '<br />';
    echo $row['userid']." ".$row['fname']." ".$row['lname']." ".$row['gender']." ".$row['org']." ".$row['email']." ".$row['mobile']." ".$row['emergency']." ".$row['address']." ".$row['study']." ".$row['occupation']." ".$row['image']." ".$row['ip']." ".$row['useragent']." ".$row['registered']." ".$row['status']."<br />"."<br />";
}
/* free result set */
$result->free();
/* close connection */
$mysqli->close();
?>
