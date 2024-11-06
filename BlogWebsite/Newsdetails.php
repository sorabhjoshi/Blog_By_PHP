<?php 

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'agl';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['slug'])) {
    $slug = htmlspecialchars($_GET['slug']);

    $stmt = $conn->prepare("SELECT * FROM newsdata WHERE slug = ?");
    if (!$stmt) {
        echo "<p>Error in preparing statement.</p>";
        exit();
    }

    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = htmlspecialchars_decode($row['title']);
        $author = htmlspecialchars_decode($row['Author_name']);
        $date = date('F j, Y', strtotime($row['created_at']));
        $content = htmlspecialchars_decode($row['description']);
        $image = $row['image'];
    } else {
        echo "<p>News post not found.</p>";
        exit();
    }
} else {
    echo "<p>Invalid news post slug.</p>";
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> - Blog Website</title>
    <link rel="stylesheet" href="http://localhost/practise/BlogWebsite/styles.css">
</head>
<body>
    <header>
        <div class="container1">
            <a href="http://localhost/practise/BlogWebsite/Home.php" class="logo">Blog Website</a>
            <div class="tags">
                <a href="http://localhost/practise/BlogWebsite/Home.php">Home</a>
                <a href="http://localhost/practise/BlogWebsite/About.php">About</a>
                <a href="http://localhost/practise/BlogWebsite/Contact.php">Contact</a>
                <a href="http://localhost/practise/BlogWebsite/News.php">News</a>
            </div>
        </div>
    </header>

    <main class="container">
        <article class="blog-post">
            <img src="../<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?>" class="blog-image">
            <h1><?php echo htmlspecialchars($title); ?></h1>
            <div class="blog-meta">
                <span>By <?php echo htmlspecialchars($author); ?></span> | <span><?php echo $date; ?></span>
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
