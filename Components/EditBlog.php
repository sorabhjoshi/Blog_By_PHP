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
        $phone1 = $_POST["phone"]; 

        $sql2 = "SELECT * FROM `user-data` WHERE email='$email1' AND id!=$id";
        $check = mysqli_query($conn, $sql2);

        if (mysqli_num_rows($check) > 0) {
            $emailerror = "Email Already Exists";
        } else {
            
            $sql = "UPDATE `blogdata` SET 
                        Author_name='$username1', 
                        Title='$email1', 
                        Description='$phone1'
                    WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                $queryresult = "Blog Successfully Updated!!";
            } else {
                echo 'Error: ' . mysqli_error($conn);
            }
        }
    }

    $sql1 = "SELECT * FROM `blogdata` WHERE id=$id";
    $result = mysqli_query($conn, $sql1);
    $user = mysqli_fetch_array($result);

    $Author = htmlspecialchars($user['Author_name']);
    $Title = htmlspecialchars($user['Title']);
    $Description = $user['Description'];
    ?>

    <main>
        <div class="container">
            
            <form onsubmit="return validate()" style="" action="Edit.php?id=<?php echo $id; ?>" method="POST">
             
            <h3 style="Display: block; margin:0 auto;"><?php echo isset($queryresult) ? $queryresult : ''; ?></h3>
                <div class="big">
                    <div class="col" style="margin-top:5px;">
                    <h1 style="color:black;">Edit Blog</h1>
                        <div class="name">
                            <label for="name">Author:</label>
                            <input type="text" id="name" name="name" placeholder="<?php echo $Author; ?>" value="<?php echo $Author; ?>">
                            <span id="name-span"></span>
                        </div>
                        <div class="name">
                            <label for="email">Title:</label>
                            <input type="text" id="email" name="email" placeholder="<?php echo $Title; ?>" value="<?php echo $Title; ?>">
                        </div>
                        <div class="name">
                            <label for="phone">Content:</label>
                            <textarea id="phone" name="phone" ><?php echo $Description; ?></textarea>
                            <span id="phone-span"></span>
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


<script src="https://cdn.tiny.cloud/1/2annmeyewpcnpqtixx04jzx2ho7hf6audb1x85cav7o9i85g/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#phone',
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar_mode: 'floating',
    height: 300
});


document.querySelector('form').addEventListener('submit', function() {
    tinymce.triggerSave();
});


function validate() {
    
    return true; 
}
</script>