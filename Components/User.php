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
        echo "<div class='success-message'>User deleted successfully!</div>";
    }
    ?>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>UserType</th>
                <th>Phone no.</th>
                <th>State</th>
                <th>Pincode</th>
                <th>Country</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql1 = "SELECT * FROM `user-data`";
            $result = mysqli_query($conn, $sql1);
            if (!$result) {
                die("". mysqli_error($conn));
            }
            
            while ($row = $result->fetch_assoc()) {
                $userType = ($row['UserType'] == 0) ? 'User' : 'Admin';
                echo "<tr>
                        <td data-label='ID'>".$i++."</td>
                        <td data-label='Name'>".$row['name']."</td>
                        <td data-label='E-Mail'>".$row['email']."</td>
                        <td data-label='UserType'>".$userType."</td>
                        <td data-label='Phone no.'>".$row['Phone_no']."</td>
                        <td data-label='State'>".$row['State']."</td>
                        <td data-label='Pincode'>".$row['Pincode']."</td>
                        <td data-label='Country'>".$row['Country']."</td>
                        <td data-label='Edit' id='edit'><a href='http://localhost/practise/components/Edit.php?id=".$row['id']."'>Edit</a></td>
                       <td data-label='Delete' id='delete'><a href='http://localhost/practise/components/Delete.php?id=".$row['id']."'>Delete</a></td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
</main>

<?php
include 'footer.php';
?>
</div>



