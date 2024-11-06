<?php
include 'header.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agl";
$i = 1;

$conn = mysqli_connect($servername, $username, $password, $dbname);
?>

<div class="wrapper">
<?php
include 'leftsidebar.php';
include 'navbar.php';
?>

<main id="main">
    
   


    <div class="datacon">
    <div style="display: block; background-color:#99aeeb; font-weight: 600; text-align:center; padding:15px; font-size:larger; border-radius:10px 10px 0 0 ;">News</div>
    <?php
    if (isset($_GET['message']) && $_GET['message'] == 'deleted') {
        echo "<div class='success-message'>Blog deleted successfully!</div>";
    }
    ?>
    <div style="padding:10px 30px"  class="top-bar">
        <div style=" display: flex; flex-direction:row;">
        <button class="blog-button"><a href="http://localhost/practise/BlogWebsite/Home.php"><i class="fas fa-globe"></i> Go to Blog</a></button>
        <button class="add-button"><a href="NewsSubmission.php">Add</a></button>
        </div>


    <table style="margin:15px 0 30px" class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql1 = "SELECT * FROM `newsdata`";
            $result = mysqli_query($conn, $sql1);
            if (!$result) {
                die("". mysqli_error($conn));
            }
            
            while ($row = $result->fetch_assoc()) {

                echo "<tr>
                        <td data-label='ID'>".$i++."</td>
                        <td data-label='User ID'>".$row['user_id']."</td>
                        <td data-label='Author'>".$row['Author_name']."</td>
                        <td data-label='Title'>".$row['title']."</td>
                        <td data-label='Created Date'>".$row['created_at']."</td>
                        <td data-label='Updated Date'>".$row['updated_at']."</td>
                        <td data-label='Edit' id='edit'><a href='http://localhost/practise/components/EditNews.php?id=".$row['id']."'>Edit</a></td>
                        <td data-label='Delete' id='delete'><a href='http://localhost/practise/components/DeleteNews.php?id=".$row['id']."'>Delete</a></td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
    
    </div>
   
</main>

<?php
include 'footer.php';
?>
</div>
