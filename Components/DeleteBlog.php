<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agl";
$id = $_GET['id'];

$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql2 = "DELETE FROM `blogdata` WHERE id=$id";
$result = mysqli_query($conn, $sql2);

if ($result) {
    header("Location: ../Components/Blogs.php?message=deleted");
    exit;
} else {
    echo 'Error: ' . mysqli_error($conn);
}
?>
