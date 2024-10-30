<?php
include "../Login/user.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agl";
$emailerror = "";
$queryresult = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$email = $_SESSION['email'];
$usertype = $_SESSION['usertype'];
$encrypt_password = $_SESSION['password']; 
$usertype = ($usertype == 0) ? 'User' : 'Admin';



if (isset($_POST["sub"])) {
    $username1 = $_POST["name"];
    $password1 = $_POST["password"];
    $email1 = $_POST["email"];
    $phone1 = $_POST["phone"];
    $city1 = $_POST["city"];
    $state1 = $_POST["State"];
    $country1 = $_POST["Country"];
    $pincode1 = $_POST["pincode"];

    $encrypt_password1 = sha1($password1);

    $sql2 = "SELECT * FROM `user-data` WHERE email='$email1'";
    $check = mysqli_query($conn, $sql2);
    
    if (mysqli_num_rows($check) >= 1 && $email1 != $email) {
        $emailerror = "Email Already Exists";
    } else {
        

        $sql = "UPDATE `user-data` SET 
                    name = '$username1', 
                    email = '$email1', 
                    password = '$encrypt_password1', 
                    Phone_no = '$phone1',
                    City = '$city1', 
                    State = '$state1', 
                    Country = '$country1', 
                    Pincode = '$pincode1'
                WHERE email = '$email'";
                

        if (mysqli_query($conn, $sql)) {
            $queryresult = "Details Successfully Updated!!";
            $_SESSION['email'] = $email1; 
            $_SESSION['password'] = $encrypt_password1; 
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
$sql1 = "SELECT * FROM `user-data` WHERE email='$email'";
$result = mysqli_query($conn, $sql1);
$user = mysqli_fetch_array($result);
$username = $user['name'];
$phone = $user['Phone_no'];
$City = $user['City'];
$State = $user['State'];
$Country = $user['Country'];
$Pincode = $user['Pincode'];
?>

<?php include 'headfile.php'; ?>

<div class="wrapper">
    <?php
    include 'leftsidebar.php';
    include 'navbar.php';
    ?>
    <main>
        <div class="container">
                
                <form onsubmit="return validate()"  method="POST">
                <h3><?php echo $queryresult; ?></h3>
                    <div class="big">
                    <div class="col">
                    <div class="name">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" placeholder="<?php echo $username; ?>" value="<?php echo $username; ?>">
                        <span id="name-span"></span>
                    </div>
                    <div class="name">
                        <label for="email">E-mail:</label>
                        <input type="text" id="email" name="email" placeholder="<?php echo $email; ?>" value="<?php echo $email; ?>">
                        <span id="email-span"><?php echo $emailerror; ?></span>
                    </div>
                    <div class="name">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="New Password">
                        <span id="password-span"></span>
                    </div>
                    <div class="name">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" placeholder="<?php echo $phone; ?>" value="<?php echo $phone; ?>">
                        <span id="phone-span"></span>
                    </div>
                    </div>
                    <div class="col">
                    <div class="name">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" placeholder="<?php echo $City; ?>" value="<?php echo $City; ?>">
                        <span id="city-span"></span>
                    </div>
                    <div class="name">
                        <label for="State">State:</label>
                        <input type="text" id="State" name="State" placeholder="<?php echo $State; ?>" value="<?php echo $State; ?>">
                        <span id="state-span"></span>
                    </div>
                    <div class="name">
                        <label for="Country">Country:</label>
                        <input type="text" id="Country" name="Country" placeholder="<?php echo $Country; ?>" value="<?php echo $Country; ?>">
                        <span id="country-span"></span>
                    </div>
                    <div class="name">
                        <label for="pincode">Pincode:</label>
                        <input type="text" id="pincode" name="pincode" placeholder="<?php echo $Pincode; ?>" value="<?php echo $Pincode; ?>">
                        <span id="pincode-span"></span>
                    </div>
                    </div>
                    </div>
                    <input class="submit" type="submit" value="Submit" name="sub">
                </form>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</div>
