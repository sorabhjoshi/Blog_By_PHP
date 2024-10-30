<?php include 'user.php';
global $loginerror;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Login.css">
</head>
<body>
    <div class="Container">
    <div>
    <form onsubmit="return validateForm()"   method="POST">
        <h1>Login</h1>
        <input id="email" type="email" name="email" placeholder="Email">
        <span id="email-span"></span>
        <input id="password" type="password" name="password" placeholder="Password">
        <span id="password-span"><?php echo isset($loginerror) ? $loginerror : ''; ?></span>
        <input type="submit" value="Submit" name="submit" >
    </form>
    <h4>Not a Member? <a style="text-decoration:none" href="../Register/Register.php">Register!</a></h4>
    </div>
    </div>
    <script src="LoginValid.js"></script>
</body>
</html>