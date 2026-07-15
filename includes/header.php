<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$page_title = isset($page_title) ? $page_title : 'CodePath Academy';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> | CodePath Academy</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container navigation">
            <a class="logo" href="index.php">Code<span>Path</span></a>
            <nav>
                <a href="index.php">Home</a>
                <a href="courses.php">All Courses</a>
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="my-courses.php">My Courses</a>
                    <a href="logout.php" class="nav-button">Logout</a>
                <?php } else { ?>
                    <a href="login.php">Login</a>
                    <a href="register.php" class="nav-button">Register</a>
                <?php } ?>
            </nav>
        </div>
    </header>
    <main>
