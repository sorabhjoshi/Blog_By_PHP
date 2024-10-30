<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agl";
global $loginerror;
global $useradmin;

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (isset($_POST["submit"])) {
    $password = $_POST["password"];
    $email = $_POST["email"];
    $encrypt_password = sha1($password);

    $sql = "SELECT * FROM `user-data` WHERE email='$email' AND password='$encrypt_password'";
    $result = mysqli_query($conn, $sql);

    

    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_array($result); 
        $usertype = $user['UserType'];
        $userid = $user['id']; 
        $userkanaam = $user['name'];
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $encrypt_password;
        $_SESSION["usertype"] = $usertype;
        $_SESSION["id"] = $userid;
        $_SESSION["naam"] = $userkanaam;
        $useradmin = $usertype;
       
        header("Location: ../Components/Dashboard.php");
        exit();
    } else {
      $loginerror= "Invalid credentials";
    }
}

?>
