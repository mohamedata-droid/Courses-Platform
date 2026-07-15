<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?message=Please log in to continue.');
    exit();
}
?>
