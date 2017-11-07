<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Admin Panel</title>
      </head>

<body>
<?php
$servername = "localhost";
$username = "chaman";
$password = "concl@ve@s@hy@dri";
$dbname = "sahyadriconclave";
$mysqli = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM form";
$result = $mysqli->query($sql)
?>
<table class="table">
  <thead>
  <tr class="header">
                <td>ID</td>
                <td>FirstName</td>
                <td>LastName</td>
                <td>Gender</td>
                <td>Institution</td>
                <td>Email</td>
                <td>Mobile</td>
                <td>Contact</td>
                <td>Address</td>
                <td>Study</td>
                <td>Occupation</td>
                <td>Image</td>
                <td>Registered date</td>
                <td>I.P</td>
                <td>UserAgent</td>
                <td>Status</td>
            </tr>
</thead>
<tbody>
<?php
while($row = $result->fetch_assoc()){
  echo "<tr>";
  echo "<td>".$row['userid']."</td>";
  echo "<td>".$row['fname']."</td>";
  echo "<td>".$row['lname']."</td>";
  echo "<td>".$row['gender']."</td>";
  echo "<td>".$row['org']."</td>";
  echo "<td>".$row['email']."</td>";
  echo "<td>".$row['mobile']."</td>";
  echo "<td>".$row['emergency']."</td>";
  echo "<td>".$row['address']."</td>";
  echo "<td>".$row['study']."</td>";
  echo "<td>".$row['occupation']."</td>";
  echo "<td>".$row['image']."</td>";
  echo "<td>".$row['registered']."</td>";
  echo "<td>".$row['ip']."</td>";
  echo "<td>".$row['useragent']."</td>";
  echo "<td>".$row['status']."</td>";
  echo "</tr>";
}
?>
</tbody>
</table>
<?php
echo tempdir();
$dir          = '/home/conclavesahyadri/public_html/uploads';
$file_display = array(
    'jpg'
);

if (file_exists($dir) == false) {
    echo 'Directory \'', $dir, '\' not found!';
} else {
    $dir_contents = scandir($dir);

    foreach ($dir_contents as $file) {
        $file_type = strtolower(end(explode('.', $file)));

        if ($file !== '.' && $file !== '..' && in_array($file_type, $file_display) == true) {
            echo '<img src="', $dir, '/', $file, '" alt="', $file, '" />';
        }
    }
}
function tempdir() {
    $tempfile=tempnam(sys_get_temp_dir(),'');
    // you might want to reconsider this line when using this snippet.
    // it "could" clash with an existing directory and this line will
    // try to delete the existing one. Handle with caution.
    if (file_exists($tempfile)) { unlink($tempfile); }
    mkdir($tempfile);
    if (is_dir($tempfile)) { return $tempfile; }
}
?>
</body
</html>
