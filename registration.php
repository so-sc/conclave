<?php
$servername = "localhost";
$username = "chaman";
$password = "concl@ve@s@hy@dri";
$dbname = "sahyadriconclave";
$target_dir = "uploads/";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// define variables and set to empty values
$fname = $lname = $email = $gender = $emergency = $mobile = $org = $adderss = $occupation = $study= $image = $userid = $ip = $useragent =  "";
$fnameErr = $lnameErr = $genderErr = $orgErr = $addressErr = $emailErr = $mobileErr = $occupationErr = $studyErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["FirstName"])) {
    $fnameErr = "First Name is required";
  } else {
  	$fname = test_input($_POST["FirstName"]);
  }
  if (empty($_POST["LastName"])) {
    $lnameErr = "Last Name is required";
  } else {
  	$lname = test_input($_POST["LastName"]);
  }
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
    //$gender = null;
  } else {
  	$gender = test_input($_POST["gender"]);
  }
  if (empty($_POST["org"])) {
    $orgErr = "Institution Name is required";
  } else {
 	 $org = test_input($_POST["org"]);
  }
  if (empty($_POST["address"])) {
    $addressErr = "Address is required";
  } else {
  $address = test_input($_POST["address"]);
  }
  if (empty($_POST["email"])) {
    $emailErr = "email is required";
  } else {
  $email = test_input($_POST["email"]);
  }
  if (empty($_POST["mobile"])) {
    $mobileErr = "Mobile No is required";
  } else {
  $mobile = test_input($_POST["mobile"]);
  }
  $emergency = test_input($_POST["person"]);
  if (empty($_POST["occupation"])) {
    $occupationErr = "Occupation is required";
  } else {
  $occupation = test_input($_POST["occupation"]);
  }
  if (empty($_POST["study"])) {
    $studyErr = "Course of study is required";
    //$study = null;
  } else {

        $study = test_input($_POST["study"]);

  }
  $image = uniqid(rand(0,9), true). '.jpg';
  $ip = getUserIP();
  $useragent = $_SERVER['HTTP_USER_AGENT'];
  $tf = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $today = date("Y-m-d");
  $imageFileType = pathinfo($tf,PATHINFO_EXTENSION);
  $target_file = $target_dir . $image;

  //$image = "link";
  $sql = "INSERT INTO form VALUES ('', '$fname', '$lname', '$gender', '$org', '$email', '$mobile', '$emergency', '$address', '$study', '$occupation', '$image', '$today', '$ip', '$useragent', '')";

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        //  echo "File is an image - " . $check["mime"] . ".";
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

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {


header("Location: http://sahyadri-conclave.com"); /* Redirect browser */
echo "Registration successfull";
exit();
          //  echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
       // echo "Error: " . $sql . "<br>" . $conn->error;
       echo "Error: " . $conn->error;
    }
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

$conn->close();
?>
