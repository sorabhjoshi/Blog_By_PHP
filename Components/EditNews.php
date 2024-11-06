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

    $sql1 = "SELECT * FROM `newsdata` WHERE id=$id";
    $result = mysqli_query($conn, $sql1);
    $user = mysqli_fetch_array($result);

    $Author = htmlspecialchars($user['Author_name']);
    $Title = htmlspecialchars($user['title']);
    $Description = $user['description'];

    $queryresult = ""; // Initialize empty success message

    if (isset($_POST["update"])) {
        $Author1 = $_POST['AUTHOR'];
        $title1 = $_POST['TITLE'];
        $Description1 = $_POST['DESC'];
        $updated_date = date("Y-m-d H:i:s");  // Get current date and time

        $sql = "UPDATE `newsdata` SET 
                    Author_name='$Author1', 
                    title='$title1', 
                    description='$Description1', 
                    updated_at='$updated_date'
                WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
            $queryresult = "Blog Successfully Updated! Redirecting...";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'news.php';
                    }, 2000);
                  </script>";
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
    ?>

    <main>
        <div class="container">
            <form onsubmit="return validate()" action="" method="POST">
                <div class="big">
                    <div class="col" style="margin-top:5px;">
                    <?php if ($queryresult): ?>
                <h3 style="color: green; text-align: center;"><?php echo $queryresult; ?></h3>
            <?php endif; ?>
                        <h1 style="color:black;">Edit Blog</h1>
                        <div class="name">
                            <label for="name">Author:</label>
                            <input type="text" id="name" name="AUTHOR" placeholder="<?php echo $Author; ?>" value="<?php echo $Author; ?>">
                            <span id="name-span"></span>
                        </div>
                        <div class="name">
                            <label for="email">Title:</label>
                            <input type="text" id="email" name="TITLE" placeholder="<?php echo $Title; ?>" value="<?php echo $Title; ?>">
                        </div>
                        <div class="name">
                            <label for="phone">Content:</label>
                            <textarea id="phone" name="DESC"><?php echo $Description; ?></textarea>
                            <span id="phone-span"></span>
                        </div>
                    </div>
                </div>
                <input class="submit" type="submit" value="update" name="update">
            </form>
        </div>
    </main>
    <?php include 'footer.php'; ?>
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
