<?php
$connection = mysqli_connect('localhost', 'root', '', 'codepath_academy');

if (!$connection) {
    die('Database connection failed. Please check config/connection.php.');
}
?>
