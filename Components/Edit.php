<?php
include 'headfile.php';
?>

<div class="wrapper">
    <?php
    include_once 'leftsidebar.php';
    include 'navbar.php';

    $id = $_GET['id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agl";
    $conn = mysqli_connect($servername, $username, $password, $dbname);




    if (isset($_POST["update"])) {
       
        $username1 = htmlspecialchars($_POST["name"]);
        $email1 = htmlspecialchars($_POST["email"]);
        $phone1 = htmlspecialchars($_POST["phone"]);
        $city1 = htmlspecialchars($_POST["city"]);
        $state1 = htmlspecialchars($_POST["State"]);
        $country1 = htmlspecialchars($_POST["Country"]);
        $pincode1 = htmlspecialchars($_POST["pincode"]);

        
        $sql2 = "SELECT * FROM `user-data` WHERE email='$email1' AND id!=$id";
        $check = mysqli_query($conn, $sql2);

        if (mysqli_num_rows($check) > 0) {
            $emailerror = "Email Already Exists";
        } else {
            
            $sql = "UPDATE `user-data` SET 
                        name='$username1', 
                        email='$email1', 
                        Phone_no='$phone1', 
                        City='$city1', 
                        State='$state1', 
                        Country='$country1', 
                        Pincode='$pincode1' 
                    WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                $queryresult = "Details Successfully Updated!!";
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }
        }
    }

    $sql1 = "SELECT * FROM `user-data` WHERE id=$id";
    $result = mysqli_query($conn, $sql1);
    $user = mysqli_fetch_array($result);

    
    $username = htmlspecialchars($user['name']);
    $phone = htmlspecialchars($user['Phone_no']);
    $City = htmlspecialchars($user['City']);
    $State = htmlspecialchars($user['State']);
    $Country = htmlspecialchars($user['Country']);
    $Pincode = htmlspecialchars($user['Pincode']);
    $email = htmlspecialchars($user['email']);
    ?>

    <main>
        <div class="container">
            
            <form onsubmit="return validate()" action="Edit.php?id=<?php echo $id; ?>" method="POST">
            <h3 style="Display: block; margin:0 auto;"><?php echo isset($queryresult) ? $queryresult : ''; ?></h3>
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
                            <span id="email-span"><?php echo isset($emailerror) ? $emailerror : ''; ?></span>
                        </div>
                        <div class="name">
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" name="phone" placeholder="<?php echo $phone; ?>" value="<?php echo $phone; ?>">
                            <span id="phone-span"></span>
                        </div>
                        <div class="name">
                            <label for="city">City:</label>
                            <input type="text" id="city" name="city" placeholder="<?php echo $City; ?>" value="<?php echo $City; ?>">
                            <span id="city-span"></span>
                        </div>
                    </div>
                    <div class="col">
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
                <input class="submit" type="submit" value="update" name="update">
            </form>
        </div>
    </main>
    <?php
    include 'footer.php';
    ?>
</div>
