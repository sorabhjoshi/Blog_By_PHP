<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agl";
global $emailerror;
$conn = new mysqli($servername, $username, $password, $dbname);


if(isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];
  $encrypt_password = sha1($password);
  $usertype = $_POST["usertype"];

  
  $sql1 = "SELECT * FROM `user-data` WHERE email='$email'";
  $check = mysqli_query($conn, $sql1);
  
  if(mysqli_num_rows($check) >= 1) {
    $emailerror="Email Already Exists";

  } else {
   
    $sql = "INSERT INTO `user-data` (`name`, `email`, `password`, `usertype`) VALUES ('$username', '$email', '$encrypt_password', '$usertype')";
    
    if(mysqli_query($conn, $sql)) {

      header('Location: ../Login/Login.php');
      exit(); 
    } else {
      echo 'Error: ' . mysqli_error($conn);
    }
  }
}

?>
