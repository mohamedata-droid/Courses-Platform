<?php
$page_title = 'My Courses';
session_start();
require('includes/auth.php');
require('config/connection.php');
include('includes/header.php');

$user_id = $_SESSION['user_id'];
$query = "SELECT courses.*, enrollments.enrolled_at FROM courses JOIN enrollments ON courses.id = enrollments.course_id WHERE enrollments.user_id = $user_id ORDER BY enrollments.id DESC";
$result = mysqli_query($connection, $query);
$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<section class="page-banner"><div class="container"><p class="eyebrow">YOUR LEARNING SPACE</p><h1>Hello, <?php echo $_SESSION['user_name']; ?>.</h1><p>These are the courses you have enrolled in. Keep moving forward!</p></div></section>
<section class="section container">
    <?php if (isset($_GET['message'])) { ?><p class="success-message"><?php echo $_GET['message']; ?></p><?php } ?>
    <?php if (empty($courses)) { ?>
        <div class="empty-state"><h2>Your course list is waiting for you.</h2><p>You have not enrolled in a course yet. Choose a course and begin today.</p><a class="button" href="courses.php">Browse Courses</a></div>
    <?php } else { ?>
        <div class="course-grid">
            <?php foreach ($courses as $course) { ?>
                <article class="course-card enrolled-card"><img src="<?php echo $course['image']; ?>" alt="<?php echo $course['title']; ?>"><div class="course-content"><p class="enrolled-label">ENROLLED: <?php echo $course['enrolled_at']; ?></p><div class="course-meta"><span><?php echo $course['level']; ?></span><span><?php echo $course['duration']; ?></span></div><h3><?php echo $course['title']; ?></h3><p><?php echo $course['description']; ?></p><a class="button small-button" href="course-details.php?id=<?php echo $course['id']; ?>">View Course</a></div></article>
            <?php } ?>
        </div>
    <?php } ?>
</section>
<?php include('includes/footer.php'); ?>
