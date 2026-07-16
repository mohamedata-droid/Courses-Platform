<?php
$page_title = 'Edit Course';
$base_path = '../';
session_start();
require('../includes/admin-auth.php');
require('../config/connection.php');

if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) { header('Location: dashboard.php?message=Invalid course ID.'); exit(); }
$id = $_GET['id'];
$result = mysqli_query($connection, "SELECT * FROM courses WHERE id = $id");
if (mysqli_num_rows($result) == 0) { header('Location: dashboard.php?message=Course was not found.'); exit(); }
$course = mysqli_fetch_assoc($result);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course['title'] = trim($_POST['title']); $course['image'] = trim($_POST['image']); $course['description'] = trim($_POST['description']); $course['price'] = trim($_POST['price']); $course['level'] = trim($_POST['level']); $course['duration'] = trim($_POST['duration']); $course['instructor'] = trim($_POST['instructor']); $course['status'] = $_POST['status'];
    if (empty($course['title'])) { $errors['title'] = 'Please enter a course title.'; }
    if (empty($course['image'])) { $errors['image'] = 'Please enter an image URL.'; } elseif (!filter_var($course['image'], FILTER_VALIDATE_URL)) { $errors['image'] = 'Please enter a valid image URL.'; }
    if (empty($course['description'])) { $errors['description'] = 'Please enter a description.'; }
    if (empty($course['price']) || !is_numeric($course['price']) || $course['price'] <= 0) { $errors['price'] = 'Price must be a number greater than zero.'; }
    if (empty($course['level'])) { $errors['level'] = 'Please select a level.'; }
    if (empty($course['duration'])) { $errors['duration'] = 'Please enter the course duration.'; }
    if (empty($course['instructor'])) { $errors['instructor'] = 'Please enter the instructor name.'; }
    if ($course['status'] != 'Available' && $course['status'] != 'Unavailable') { $errors['status'] = 'Please select a valid status.'; }
    if (empty($errors)) {
        $query = "UPDATE courses SET title='$course[title]', image='$course[image]', description='$course[description]', price='$course[price]', level='$course[level]', duration='$course[duration]', instructor='$course[instructor]', status='$course[status]' WHERE id=$id";
        if (mysqli_query($connection, $query)) { header('Location: dashboard.php?message=Course updated successfully.'); exit(); }
        $errors['general'] = 'Course could not be updated. Please try again.';
    }
}
include('../includes/header.php');
?>

<section class="section container"><a class="back-link" href="dashboard.php">&larr; Back to dashboard</a><div class="admin-form-card"><p class="eyebrow">EDIT COURSE</p><h1>Update <?php echo $course['title']; ?></h1><?php if (isset($errors['general'])) { ?><p class="error-message"><?php echo $errors['general']; ?></p><?php } ?>
<form action="edit-course.php?id=<?php echo $id; ?>" method="POST" novalidate><div class="form-grid">
<div><label for="title">Course Title</label><input id="title" name="title" value="<?php echo $course['title']; ?>"><small><?php echo isset($errors['title']) ? $errors['title'] : ''; ?></small></div><div><label for="instructor">Instructor Name</label><input id="instructor" name="instructor" value="<?php echo $course['instructor']; ?>"><small><?php echo isset($errors['instructor']) ? $errors['instructor'] : ''; ?></small></div>
<div class="full-field"><label for="image">Course Image URL</label><input id="image" name="image" value="<?php echo $course['image']; ?>"><small><?php echo isset($errors['image']) ? $errors['image'] : ''; ?></small></div><div class="full-field"><label for="description">Description</label><textarea id="description" name="description" rows="5"><?php echo $course['description']; ?></textarea><small><?php echo isset($errors['description']) ? $errors['description'] : ''; ?></small></div>
<div><label for="price">Price (EGP)</label><input type="number" id="price" name="price" value="<?php echo $course['price']; ?>" min="1" step="0.01"><small><?php echo isset($errors['price']) ? $errors['price'] : ''; ?></small></div><div><label for="duration">Duration</label><input id="duration" name="duration" value="<?php echo $course['duration']; ?>"><small><?php echo isset($errors['duration']) ? $errors['duration'] : ''; ?></small></div>
<div><label for="level">Level</label><select id="level" name="level"><option value="Beginner" <?php echo $course['level'] == 'Beginner' ? 'selected' : ''; ?>>Beginner</option><option value="Intermediate" <?php echo $course['level'] == 'Intermediate' ? 'selected' : ''; ?>>Intermediate</option></select><small><?php echo isset($errors['level']) ? $errors['level'] : ''; ?></small></div><div><label for="status">Availability Status</label><select id="status" name="status"><option value="Available" <?php echo $course['status'] == 'Available' ? 'selected' : ''; ?>>Available</option><option value="Unavailable" <?php echo $course['status'] == 'Unavailable' ? 'selected' : ''; ?>>Unavailable</option></select><small><?php echo isset($errors['status']) ? $errors['status'] : ''; ?></small></div>
</div><button class="button form-button" type="submit">Save Changes</button></form></div></section>
<?php include('../includes/footer.php'); ?>
