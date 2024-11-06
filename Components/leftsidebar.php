<?php
include_once "../Login/user.php";
$useradmin = $_SESSION["usertype"];

?>
<head>
   
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<div class="sidebar" style="margin-left:0;">
    <div class="top">
        <span><img class="img" src="https://www.absglobaltravel.com/public/images/footer-abs-logo.webp" alt=""></span>
        
    </div>
    <ul>
        <li>
            <button id="myAccountBtn" class="ac">
                <i class="fas fa-user"></i> My Account
                <i class="fas fa-chevron-down dropdown-arrow"></i> 
            </button>
            <ul id="accountLinks" style="display: none;">
                <li><a href="UserDetails.php"><i class="fas fa-id-card"></i> Profile</a></li>
                <li><a href="UserUpdate.php"><i class="fas fa-pencil-alt"></i> Update Profile</a></li>
                <?php if ($useradmin == 1) { ?>
                    <li><a href="User.php"><i class="fas fa-users"></i> Users</a></li>
                <?php } ?>
            </ul>
        </li>
        <li>
            <button id="myAccountBtn">
                <i class="fas fa-blog"></i>
                <?php if ($useradmin == 1) { ?>
                    <a href="Blogs.php">Blogs</a>
                <?php } else{?>
                    <a href="Blogsubmission.php">Blogs</a><?php
                }?>
                
                
            </button>
        </li>
        <li>
            <button id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i> <a href="news.php">News</a>
            </button>
        </li>
        <li>
            <button id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i> <a href="Logout.php">Logout</a>
            </button>
        </li>
    </ul>
</div>

<script>
    document.getElementById("myAccountBtn").onclick = function() {
        var accountLinks = document.getElementById("accountLinks");
        var dropdownArrow = document.querySelector("#myAccountBtn .dropdown-arrow");

        // Toggle dropdown display
        if (accountLinks.style.display === "none" || accountLinks.style.display === "") {
            accountLinks.style.display = "block";
            dropdownArrow.style.transform = "rotate(180deg)"; // Rotate arrow downwards
        } else {
            accountLinks.style.display = "none";
            dropdownArrow.style.transform = "rotate(0deg)"; // Reset arrow rotation
        }
    }
</script>

