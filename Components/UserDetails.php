<?php
include "../Login/user.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agl";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$email = $_SESSION['email'];
$usertype = $_SESSION['usertype'];
$usertype = ($usertype==0) ? ('User') : ('Admin');
$sql = "SELECT * FROM `user-data` WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_array($result); 
$username = $user['name']; 
$phone= $user['Phone_no'];
$City = $user['City'];
$State = $user['State'];
$Country = $user['Country'];
$Pincode = $user['Pincode'];

?><?php

include 'headfile.php';
?>


<div class="wrapper">
<?php
include 'leftsidebar.php';
include 'navbar.php';
?>
<main>
<div class="container">
<div class="col">
<div class="name">
<label for="name">Name:</label>
<input  type="name" name="name" disabled value=<?php echo $username?>>
</div>    
<div class="name">
<label for="email">E-mail:</label>
<input  type="email" name="email" disabled value="<?php echo $email?>">
</div>
<div class="name">
<label for="usertype">Usertype:</label>
<input  type="usertype" name="usertype" disabled value=<?php echo $usertype?>>
</div>
<div class="name">
<label for="usertype">Phone no:</label>
<input  type="usertype" name="usertype" disabled value=<?php echo $phone?>>
</div>
</div>
<div class="col">
    <div class="name">
<label for="usertype">City:</label>
<input  type="usertype" name="usertype" disabled value=<?php echo $City?>>
</div>
<div class="name">
<label for="usertype">State:</label>
<input  type="usertype" name="usertype" disabled value=<?php echo $State?>>
</div>
<div class="name">
<label for="usertype">Country:</label>
<input  type="usertype" name="usertype" disabled value=<?php echo $Country?>>
</div>
<div class="name">
<label for="usertype">Pincode:</label>
<input  type="usertype" name="usertype" disabled value=<?php echo $Pincode?>>
</div>
</div>





</div>


</main>
<?php
?>
</div>


