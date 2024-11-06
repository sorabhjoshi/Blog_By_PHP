<?php
include 'headfile.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agl";

$author_name = '';
$title = '';
$description = '';
$errors = [];
$message = '';

function generateSlug($title) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $author_name =  $_POST['author_name'];
    $title = $_POST['title'];
    $description = $_POST['description'];

   
    if (empty($author_name)) {
        $errors['author_name'] = "Author name is required.";
    }
    if (empty($title)) {
        $errors['title'] = "Title is required.";
    }
    if (empty($description)) {
        $errors['description'] = "Description is required.";
    }
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors['image'] = "Image upload is required.";
    }

    
    if (empty($errors)) {
        $image = $_FILES['image'];
        $imageName = basename($image['name']);
        $targetDirectory = "../img/";
        $targetFile = $targetDirectory . $imageName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        if (!in_array($imageFileType, $allowedTypes)) {
            $errors['image'] = "Only JPG, JPEG, PNG files are allowed.";
        } elseif (move_uploaded_file($image['tmp_name'], $targetFile)) {
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }

           
            $slug = generateSlug($title);

            
            $stmt = $conn->prepare("SELECT * FROM newsdata WHERE slug = ?");
            $stmt->bind_param("s", $slug);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $errors['title'] = "Title already exists!";
            } else {
                include_once "../Login/user.php";
                $id = $_SESSION["id"];
                $created_date = date('Y-m-d H:i:s');
                $updated_date = $created_date;

                
                $stmt = $conn->prepare("INSERT INTO newsdata (User_id, Author_name, title, slug, created_at, updated_at, description, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssssss", $id, $author_name, $title, $slug, $created_date, $updated_date, $description, $targetFile);

                if ($stmt->execute()) {
                    $message = "Blog submitted successfully!";
                    header("Location: ../Components/news.php");
                    exit;
                } else {
                    error_log("Database error: " . $stmt->error);
                    $errors['database'] = "Error: " . $stmt->error;
                }
            }
        } else {
            $errors['image'] = "Sorry, there was an error uploading your image.";
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="blogForm" enctype="multipart/form-data">
        <h1>Submit a News Article</h1>
        
        <label for="author_name">Author Name:</label>
        <input type="text" id="author_name" name="author_name" value="<?php echo htmlspecialchars($author_name); ?>" >
        <?php if (isset($errors['author_name'])): ?>
            <span class="error"><?php echo $errors['author_name']; ?></span>
        <?php endif; ?>
        
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" >
        <?php if (isset($errors['title'])): ?>
            <span class="error"><?php echo $errors['title']; ?></span>
        <?php endif; ?>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" >
        <?php if (isset($errors['image'])): ?>
            <span class="error"><?php echo $errors['image']; ?></span>
        <?php endif; ?>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo htmlspecialchars($description); ?></textarea>
        <?php if (isset($errors['description'])): ?>
            <span class="error"><?php echo $errors['description']; ?></span>
        <?php endif; ?>
        
        <input style=" margin:auto; margin-top:15px;" type="submit" value="Submit Blog">
        
        <?php if ($message): ?>
            <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>
    </form>
</div>

<script>
document.getElementById('blogForm').onsubmit = function() {
    tinymce.triggerSave();
};
</script>

</main>
<?php
include 'footer.php';
?>
</div>
