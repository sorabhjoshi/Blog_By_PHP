<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Blog Website</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="home.css">
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
        <section class="intro">
            <h1>Welcome to Our Blog</h1>
            <p>Discover insightful articles, tutorials, and tips to enhance your knowledge. Join us on a journey through engaging stories and expert advice!</p>
            <a href="http://localhost/practise/BlogWebsite/Index.php" class="explore-btn">Explore Our Blogs</a>
            <a href="http://localhost/practise/BlogWebsite/News.php" class="explore-btn">Get Latest News</a>
        </section>

        <section class="featured-articles">
            <h2>Featured Articles</h2>
            <div class="article-grid">
                <?php
                $db_host = 'localhost';
                $db_user = 'root';
                $db_pass = '';
                $db_name = 'agl';

                
                function generateSlug($title) {
                    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
                    return $slug;
                }

                
                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

               
                $query = "SELECT * FROM blogdata ORDER BY Created_date DESC LIMIT 3";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $title = htmlspecialchars($row['Title']);
                        $slug = generateSlug($row['Title']);
                        $description = htmlspecialchars_decode($row['Description']);
                        $lines = explode("\n", $description);
                        $image = htmlspecialchars($row['Image']);
                        $id = htmlspecialchars($row['id']);
                        echo "
                        <article class='article-card'>
                            <img src='$image' alt='$title'>
                            <h3>$title</h3>
                            <p>" . $lines[0] . "</p>
                            <a href='blog/" . urlencode($slug) . "' class='read-more'>Read More</a>
                        </article>
                        ";
                    }
                } else {
                    echo "<p>No featured articles available.</p>";
                }

                
                ?>
            </div>
        </section>

        <section class="latest-news">
            <h2>Latest News</h2>
            <div class="article-grid">
              <?php
              $query = "SELECT * FROM newsdata ORDER BY created_at DESC LIMIT 3";
              $result = $conn->query($query);
              if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $title = htmlspecialchars($row['title']);
                    $slug = generateSlug($row['title']);
                    $description = htmlspecialchars_decode($row['description']);
                    $lines = explode("\n", $description);
                    $image = htmlspecialchars($row['image']);
                    $id = htmlspecialchars($row['id']);
                    echo "
                    <article class='article-card'>
                        <img src='$image' alt='$title'>
                        <h3>$title</h3>
                        <p>" . $lines[0] . "</p>
                        <a href='newsdetails/" . urlencode($slug) . "' class='read-more'>Read More</a>
                    </article>
                    ";
                }
            } else {
                echo "<p>No featured articles available.</p>";
            }$conn->close();
              ?>
            </div>
        </section>
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
