<?php

include 'headfile.php';
?>


<div class="wrapper">
<?php
include 'leftsidebar.php';
include 'navbar.php';
?>
<main>

<div class="aboutcontainer">
        <h1>About Us</h1>
        <p>Welcome to our community! Our platform is designed to provide an engaging and interactive experience for everyone. With features like user profiles, blog creation, and seamless contact options, we aim to foster a space where users can express themselves and connect with each other.</p>
        
        <h2>Key Features</h2>
        <ul>
            <li><strong>User Registration and Login</strong>: Join our platform easily by registering an account. Our registration and login systems ensure your data is secure and accessible.</li>
            
            <li><strong>User Profiles</strong>: View and edit your profile to keep your information up-to-date. Customize your experience and stay connected.</li>
            
            <li><strong>Admin Privileges</strong>: Admins have additional powers, such as editing and managing user information. Admins can also delete user profiles, ensuring that our community remains safe and well-managed.</li>
            
            <li><strong>Blogging Platform</strong>: Our platform allows you to share your thoughts, ideas, and stories. Create, edit, and update blogs effortlessly to engage with other community members.</li>
            
            <li><strong>Contact Us</strong>: Need assistance? Reach out via email using our contact feature, and our team will be here to help you with any questions or support you may need.</li>
        </ul>
        
        <p>Thank you for being part of our community! Together, we’re building a vibrant and interactive platform for everyone.</p>
    </div>

</main>
<?php
include 'footer.php';
?>
</div>
<style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .aboutcontainer { width: 90%; max-width: 800px;  padding:20px 40px; background-color:rgb(218, 212, 200); border-radius: 8px;}
        h1 { color: #333; margin: 10px 0}
        p { line-height: 1.6; color: #666; margin: 10px 0}
        ul { line-height: 1.6; color: #444;margin: 10px 0 }
    </style>

