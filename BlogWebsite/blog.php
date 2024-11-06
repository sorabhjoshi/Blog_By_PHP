<?php 

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'agl';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);


if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];

    if (isset($_GET['slug'])) {

        $stmt = $conn->prepare("SELECT * FROM blogdata WHERE slug = ?");
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $title = htmlspecialchars_decode($row['Title']);
            $author = htmlspecialchars_decode($row['Author_name']);
            $date = date('F j, Y', strtotime($row['Created_date']));
            $content = htmlspecialchars_decode($row['Description']);
            $image = $row['Image'];
        } else {
            echo "<p>Blog post not found.</p>";
            exit();
        }
    } else {
        echo "<p>Invalid blog post ID.</p>";
        exit();
    }
} else {
    echo "<p>Invalid blog post slug.</p>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Blog Website</title>
    <link rel="stylesheet" href="http://localhost/practise/BlogWebsite/styles.css">
</head>
<body>
    <header>
        <div class="container1">
            <a href="http://localhost/practise/BlogWebsite/Home.php" class="logo">Blog Website</a>
            <div class="tags">
                <a href="">Home</a>
                <a href="http://localhost/practise/BlogWebsite/About.php">About</a>
                <a href="http://localhost/practise/BlogWebsite/Contact.php">Contact</a>
            </div>
        </div>
    </header>

    <main class="container">
        <article class="blog-post">
            <img src="<?php echo 'http://localhost/practise/BlogWebsite/'.$image; ?>" alt="Blog Image" class="blog-image">
            <h1><?php echo $title; ?></h1>
            <div class="blog-meta">
                <span>By <?php echo $author; ?></span> | <span><?php echo $date; ?></span>
            </div>
            <p><?php echo nl2br($content); ?></p>
        </article>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-links">
                <a href="http://localhost/practise/BlogWebsite/Home.php">Home</a>
                <a href="http://localhost/practise/BlogWebsite/About.php">About</a>
                <a href="http://localhost/practise/BlogWebsite/Contact.php">Contact</a>
                <a href="http://localhost/practise/BlogWebsite/News.php">News</a>
            </div>
            <p>&copy; 2024 Blog Website. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

