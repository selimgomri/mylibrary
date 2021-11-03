<?php
session_start();
if (!empty($_SESSION['username'])) {
    echo "Welcome " . $_SESSION['username']; ?>
<button class="btn btn-outline-dark"><a href="logout.php">Logout</a></button>
<?php
} else {
    header("Location: login.php");
    die();
}
?>