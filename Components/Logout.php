<?php
include_once "../Login/user.php";
session_destroy();
echo 'You have been logged out. <a href="../Login/Login.php">Go back</a>';
?>