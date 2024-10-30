<?php

include 'headfile.php';
include "../Login/user.php";
$userkanaam =  $_SESSION["naam"];
?>


<div class="wrapper">
<?php
include 'leftsidebar.php';
include 'navbar.php';
?>
<main>

<h1>Welcome <?php echo ucfirst($userkanaam) ?>!</h1>

</main>
<?php
include 'footer.php';
?>
</div>


