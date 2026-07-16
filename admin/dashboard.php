<?php
$page_title = 'Admin Dashboard';
$base_path = '../';
session_start();
require('../includes/admin-auth.php');
require('../config/connection.php');

$users_result = mysqli_query($connection, 'SELECT COUNT(*) AS total FROM users');
$courses_result = mysqli_query($connection, 'SELECT COUNT(*) AS total FROM courses');
$enrollments_result = mysqli_query($connection, 'SELECT COUNT(*) AS total FROM enrollments');
$total_users = mysqli_fetch_assoc($users_result);
$total_courses = mysqli_fetch_assoc($courses_result);
$total_enrollments = mysqli_fetch_assoc($enrollments_result);

$courses_query = 'SELECT * FROM courses ORDER BY id DESC';
$courses_result = mysqli_query($connection, $courses_query);
$courses = mysqli_fetch_all($courses_result, MYSQLI_ASSOC);

include('../includes/header.php');
?>

<section class="page-banner"><div class="container"><p class="eyebrow">ADMIN AREA</p><h1>Dashboard</h1><p>Manage courses and review your platform totals from one protected place.</p></div></section>
<section class="section container">
    <?php if (isset($_GET['message'])) { ?><p class="success-message"><?php echo $_GET['message']; ?></p><?php } ?>
    <div class="admin-heading"><div><p class="eyebrow">PLATFORM OVERVIEW</p><h2>Welcome, <?php echo $_SESSION['user_name']; ?>.</h2></div><a class="button" href="add-course.php">+ Add New Course</a></div>
    <div class="admin-stats"><div><span>Total Users</span><strong><?php echo $total_users['total']; ?></strong></div><div><span>Total Courses</span><strong><?php echo $total_courses['total']; ?></strong></div><div><span>Total Enrollments</span><strong><?php echo $total_enrollments['total']; ?></strong></div></div>
    <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Course</th><th>Instructor</th><th>Price</th><th>Status</th><th>Actions</th></tr></thead><tbody>
        <?php foreach ($courses as $course) { ?>
            <tr><td><strong><?php echo $course['title']; ?></strong><span><?php echo $course['level']; ?> - <?php echo $course['duration']; ?></span></td><td><?php echo $course['instructor']; ?></td><td>EGP <?php echo $course['price']; ?></td><td><span class="status <?php echo $course['status'] == 'Available' ? 'status-available' : 'status-unavailable'; ?>"><?php echo $course['status']; ?></span></td><td><a class="table-link" href="edit-course.php?id=<?php echo $course['id']; ?>">Edit</a><a class="table-link table-delete" href="delete-course.php?id=<?php echo $course['id']; ?>">Delete</a></td></tr>
        <?php } ?>
    </tbody></table></div>
</section>
<?php include('../includes/footer.php'); ?>
