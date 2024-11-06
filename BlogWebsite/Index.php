<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'agl';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function generateSlug($title) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
    return $slug;
}

if (isset($_POST['load_more'])) {
    $offset = $_POST['offset'];
    $query = "SELECT * FROM blogdata ORDER BY Created_date DESC LIMIT 3 OFFSET $offset";
    $result = $conn->query($query);

    $html = '';
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date = date('F j, Y', strtotime($row['Created_date']));
            $description = htmlspecialchars_decode($row['Description']);
            $slug = generateSlug($row['Title']);
            $lines = explode("\n", $description);
            $html .= '<article class="blog-card">
                <div class="blog-content">
                    <img src="' . $row['Image'] . '" alt="Blog Image" class="blog-image">
                    <h2 class="blog-title">' . htmlspecialchars($row['Title']) . '</h2>
                    <div class="blog-description">' . $lines[0] . '</div>
                    <div class="blog-meta">
                        <span class="author">By ' . htmlspecialchars($row['Author_name']) . '</span>
                        <span class="date">' . $date . '</span>
                    </div>
                     <a href="blog/' . urlencode($slug) . '" class="read-more">Read More</a>
                </div>
            </article>';
        }
    }
    echo $html; 
    exit;
}

$query = "SELECT * FROM blogdata ORDER BY Created_date DESC LIMIT 3";
$result = $conn->query($query);

$total_query = "SELECT COUNT(*) as total FROM blogdata";
$total_result = $conn->query($total_query);
$total_posts = $total_result->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Website</title>
    <link rel="stylesheet" href="styles.css">
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
        <div class="blog-grid">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $date = date('F j, Y', strtotime($row['Created_date']));
                    $description = htmlspecialchars_decode($row['Description']);
                    $slug = generateSlug($row['Title']);
                    ?>
                    <article class="blog-card">
                        <div class="blog-content">
                            <img src="<?php echo $row['Image'] ?>" alt="Blog Image" class="blog-image">
                            <h2 class="blog-title"><?php echo htmlspecialchars($row['Title']); ?></h2>
                            <div class="blog-description"><?php $lines = explode("\n", $description); echo $lines[0]; ?></div>
                            <div class="blog-meta">
                                <span class="author">By <?php echo htmlspecialchars($row['Author_name']); ?></span>
                                <br>
                                <span class="date"><?php echo $date; ?></span>
                            </div>
                            <a href="blog/<?php echo urlencode($slug); ?>" class="read-more">Read More</a>
                        </div>
                    </article>
                    <?php
                }
            } else {
                echo '<p style="text-align: center; padding: 2rem;">No blog posts found.</p>';
            }
            ?>
        </div>
        <?php if ($total_posts > 3) { ?>
            <div class="load-more-container">
                <button class="load-more-btn">Load More</button>
            </div>
        <?php } ?>

        
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const blogGrid = document.querySelector('.blog-grid');
            const loadMoreBtn = document.querySelector('.load-more-btn');
            let offset = 3;
            const totalPosts = <?php echo $total_posts; ?>;

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    fetch(window.location.href, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `load_more=true&offset=${offset}`
                    })
                    .then(response => response.text())
                    .then(html => {
                        if (html) {
                            blogGrid.insertAdjacentHTML('beforeend', html);
                            offset += 3;

                            if (offset >= totalPosts) {
                                loadMoreBtn.style.display = 'none';
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            }
        });
    </script>
</body>
</html>
