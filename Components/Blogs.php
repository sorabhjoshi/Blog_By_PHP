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
    <?php
    if (isset($_GET['message']) && $_GET['message'] == 'deleted') {
        echo "<div class='success-message'>Blog deleted successfully!</div>";
    }
    ?>
    <div class="top-bar">
        <button class="add-button"><a href="Blogsubmission.php">Add</a></button>
    

    <table class="table">
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
            $sql1 = "SELECT * FROM `blogdata`";
            $result = mysqli_query($conn, $sql1);
            if (!$result) {
                die("". mysqli_error($conn));
            }
            
            while ($row = $result->fetch_assoc()) {

                echo "<tr>
                        <td data-label='ID'>".$i++."</td>
                        <td data-label='User ID'>".$row['User_id']."</td>
                        <td data-label='Author'>".$row['Author_name']."</td>
                        <td data-label='Title'>".$row['Title']."</td>
                        <td data-label='Created Date'>".$row['Created_date']."</td>
                        <td data-label='Updated Date'>".$row['Updated_date']."</td>
                        <td data-label='Edit' id='edit'><a href='http://localhost/practise/components/EditBlog.php?id=".$row['id']."'>Edit</a></td>
                        <td data-label='Delete' id='delete'><a href='http://localhost/practise/components/DeleteBlog.php?id=".$row['id']."'>Delete</a></td>
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
