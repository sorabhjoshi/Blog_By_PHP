<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agl";
$id = $_GET['id'];

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql2 = "DELETE FROM `newsdata` WHERE id=$id";
$result = mysqli_query($conn, $sql2);

if ($result) {
    header("Location: ../Components/news.php?message=deleted");
    exit;
} else {
    echo 'Error: ' . mysqli_error($conn);
}
?>
