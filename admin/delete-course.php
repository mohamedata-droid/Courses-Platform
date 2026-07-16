<?php
session_start();
require('../includes/admin-auth.php');
require('../config/connection.php');

if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) { header('Location: dashboard.php?message=Invalid course ID.'); exit(); }
$id = $_GET['id'];
$course_result = mysqli_query($connection, "SELECT id FROM courses WHERE id = $id");
if (mysqli_num_rows($course_result) == 0) { header('Location: dashboard.php?message=Course was not found.'); exit(); }

mysqli_query($connection, "DELETE FROM enrollments WHERE course_id = $id");
$result = mysqli_query($connection, "DELETE FROM courses WHERE id = $id");
if ($result) { header('Location: dashboard.php?message=Course deleted successfully.'); exit(); }
header('Location: dashboard.php?message=Course could not be deleted.');
exit();
?>
