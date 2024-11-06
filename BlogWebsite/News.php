<?php 
// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'agl';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function generateSlug($title) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
    return $slug;
}

if (isset($_POST['load_more'])) {
    $offset = (int)$_POST['offset']; // Cast to int for safety
    $stmt = $conn->prepare("SELECT * FROM newsdata ORDER BY created_at DESC LIMIT 3 OFFSET ?");
    $stmt->bind_param('i', $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    $html = '';
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date = date('F j, Y', strtotime($row['created_at']));
            $description = htmlspecialchars_decode($row['description']);
            $slug = generateSlug($row['title']);

            // Ensure the loaded HTML matches the main section
            $html .= '<div class="news-card">
                <img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '" class="news-image">
                <div class="news-content">
                    <h2>' . htmlspecialchars($row['title']) . '</h2>
                    <p>' . $description . '</p>
                    <span class="news-date">' . $date . '</span>
                    <a href="newsdetails/' . urlencode($slug) . '" class="read-more">Read More</a>
                </div>
            </div>';
        }
    }
    echo $html; 
    exit;
}

$sql = "SELECT id, title, description, image, created_at FROM newsdata ORDER BY created_at DESC LIMIT 3";
$result = $conn->query($sql);
$total_query = "SELECT COUNT(*) as total FROM newsdata"; // Use the correct table name
$total_result = $conn->query($total_query);
$total_posts = $total_result->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Website</title>
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
        <h1>Latest News</h1>
        <div class="news-cards">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="news-card">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="news-image">
                        <div class="news-content">
                            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                            <p><?php echo htmlspecialchars_decode($row['description']); ?></p>
                            <span class="news-date"><?php echo date("F j, Y", strtotime($row['created_at'])); ?></span>
                            <a href="newsdetails/<?php echo urlencode(generateSlug($row['title'])); ?>" class="read-more">Read More</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No news available at the moment.</p>
            <?php endif; ?>
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
            const blogGrid = document.querySelector('.news-cards');
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
