<?php
session_start();
require('includes/auth.php');
require('config/connection.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: courses.php');
    exit();
}

$course_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$course_query = "SELECT id FROM courses WHERE id = $course_id";
$course_result = mysqli_query($connection, $course_query);

if (mysqli_num_rows($course_result) == 0) {
    header('Location: courses.php');
    exit();
}

$check_query = "SELECT id FROM enrollments WHERE user_id = $user_id AND course_id = $course_id";
$check_result = mysqli_query($connection, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    header('Location: course-details.php?id=' . $course_id . '&message=You are already enrolled in this course.');
    exit();
}

$date = date('Y-m-d');
$query = "INSERT INTO enrollments (user_id, course_id, enrolled_at) VALUES ('$user_id', '$course_id', '$date')";
$result = mysqli_query($connection, $query);

if ($result) {
    header('Location: my-courses.php?message=Enrollment successful! Your course is ready.');
    exit();
}

header('Location: courses.php?message=Something went wrong. Please try again.');
exit();
?>
