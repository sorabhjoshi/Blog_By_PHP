<?php
 include'insert.php'; 
 global $emailerror;?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Register.css">
</head>
<body>
    <div class="Container">
    <div>
    <form id="form"  onsubmit="return validateForm()" method="POST">
        <h1>Regiter</h1>
        <input id="name" type="text" name="username"  placeholder="Username">
        <span id="name-span"></span>
        <input id="email" type="email" name="email"  placeholder="Email">
    
    <span id="email-span"><?php echo isset($emailerror) ? $emailerror : ''; ?></span>
        <input id="password" type="password" name="password"  placeholder="Password">
        <span id="password-span"></span>
        <input id="conpassword" type="password" name="confirm password"  placeholder="Confirm Password">
        <span id="conpassword-span"></span>
        <select id="usertype" name="usertype" >
            <option value="0">User</option>
            <option value="1">Admin</option>
        </select>
        <input type="submit" value="submit" name="submit">
    </form>
    <h4>Already a Member? <a style="text-decoration:none" href="../Login/Login.php">Login!</a></h4>
    </div>
    </div>
    <script src="RegisterValid.js"></script>
</body>
</html>