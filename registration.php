<?php
$servername = "localhost";
$username = "test123";
$password = "test123";
$dbname = "conclave";
$target_dir = "uploads/";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// define variables and set to empty values
$fname = $lname = $email = $gender = $emergency = $mobile = $org = $adderss = $occupation = $study= $image = $userid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = test_input($_POST["FirstName"]);
  $lname = test_input($_POST["LastName"]);
  $gender = test_input($_POST["gender"]);
  $org = test_input($_POST["org"]);
  $address = test_input($_POST["address"]);
  $email = test_input($_POST["email"]);
  $mobile = test_input($_POST["mobile"]);
  $emergency = test_input($_POST["person"]);
  $occupation = test_input($_POST["occupation"]);
  $study = test_input($_POST["study"]);
  $image = uniqid(rand(0,9), true). '.jpg';
  $tf = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($tf,PATHINFO_EXTENSION);
  $target_file = $target_dir . $image;

  //$image = "link";
  $sql = "INSERT INTO FORM VALUES ('', '$fname', '$lname', '$gender', '$org', '$email', '$mobile', '$emergency', '$address', '$study', '$occupation', '$image', '', '', '', '')";

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image." . "<br>";
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists." . "<br>";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 2000000) {
      echo "Sorry, your file is too large." . "<br>";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" ) {
      echo "Sorry, only JPG files are allowed." . "<br>";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Internal error!, your file was not uploaded." . "<br>";
  // if everything is ok, try to upload file
  } else {
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
 $data = htmlspecialchars($data);
  return $data;
}

$conn->close();
?>
