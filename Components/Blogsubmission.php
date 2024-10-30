<?php
include 'headfile.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agl";

$author_name = '';
$title = '';
$description = '';
$error = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $author_name = filter_input(INPUT_POST, 'author_name', FILTER_SANITIZE_STRING);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = $_POST['description']; // Don't sanitize here, we'll handle it in the prepared statement

    if (empty($author_name)) {
        $error = "Author name is required.";
    } elseif (empty($title)) {
        $error = "Title is required.";
    } elseif (empty($description)) {
        $error = "Description is required.";
    } else {
        try {
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }

            include_once "../Login/user.php";
            $id = $_SESSION["id"];
            $created_date = date('Y-m-d H:i:s');
            $updated_date = $created_date;

            $stmt = $conn->prepare("INSERT INTO blogdata (User_id, Author_name, Title, Created_date, Updated_date, Description) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $id, $author_name, $title, $created_date, $updated_date, $description);

            if ($stmt->execute()) {
                $message = "Blog submitted successfully!";
                header("Location: ../Components/Blogs.php");
                exit();
            } else {
                $error = "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<div class="wrapper">
<?php
include 'leftsidebar.php';
include 'navbar.php';
?>
<main>
<head>
  <link rel="stylesheet" href="bogsub.css">
  <script src="https://cdn.tiny.cloud/1/2annmeyewpcnpqtixx04jzx2ho7hf6audb1x85cav7o9i85g/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#description',
      plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      toolbar_mode: 'floating',
      height: 300
    });
  </script>
</head>

<div class="form-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="blogForm">
        <h1>Submit a Blog</h1>
        
        <label for="author_name">Author Name:</label>
        <input type="text" id="author_name" name="author_name" value="<?php echo htmlspecialchars($author_name); ?>" required>
        
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo htmlspecialchars($description); ?></textarea>
        
        <input style=" margin:auto; margin-top:15px;" type="submit" value="Submit Blog">
        
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <?php if ($message): ?>
            <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>
    </form>
</div>

<script>
document.getElementById('blogForm').onsubmit = function() {
    // Update TinyMCE textarea before form submission
    tinymce.triggerSave();
};
</script>

</main>
<?php
include 'footer.php';
?>
</div>