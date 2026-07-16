<?php
$page_title = 'Add Course';
$base_path = '../';
session_start();
require('../includes/admin-auth.php');
require('../config/connection.php');

$errors = [];
$title = $image = $description = $price = $level = $duration = $instructor = '';
$status = 'Available';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $image = trim($_POST['image']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $level = trim($_POST['level']);
    $duration = trim($_POST['duration']);
    $instructor = trim($_POST['instructor']);
    $status = $_POST['status'];

    if (empty($title)) { $errors['title'] = 'Please enter a course title.'; }
    if (empty($image)) { $errors['image'] = 'Please enter an image URL.'; }
    elseif (!filter_var($image, FILTER_VALIDATE_URL)) { $errors['image'] = 'Please enter a valid image URL.'; }
    if (empty($description)) { $errors['description'] = 'Please enter a description.'; }
    if (empty($price)) { $errors['price'] = 'Please enter a price.'; }
    elseif (!is_numeric($price) || $price <= 0) { $errors['price'] = 'Price must be a number greater than zero.'; }
    if (empty($level)) { $errors['level'] = 'Please select a level.'; }
    if (empty($duration)) { $errors['duration'] = 'Please enter the course duration.'; }
    if (empty($instructor)) { $errors['instructor'] = 'Please enter the instructor name.'; }
    if ($status != 'Available' && $status != 'Unavailable') { $errors['status'] = 'Please select a valid status.'; }

    if (empty($errors)) {
        $query = "INSERT INTO courses (title, image, description, price, level, duration, instructor, status) VALUES ('$title', '$image', '$description', '$price', '$level', '$duration', '$instructor', '$status')";
        if (mysqli_query($connection, $query)) { header('Location: dashboard.php?message=Course added successfully.'); exit(); }
        $errors['general'] = 'Course could not be added. Please try again.';
    }
}
include('../includes/header.php');
?>

<section class="section container"><a class="back-link" href="dashboard.php">&larr; Back to dashboard</a><div class="admin-form-card"><p class="eyebrow">NEW COURSE</p><h1>Add a course</h1><p>Add the course information that students will see in the catalogue.</p><?php if (isset($errors['general'])) { ?><p class="error-message"><?php echo $errors['general']; ?></p><?php } ?>
<form action="add-course.php" method="POST" novalidate><div class="form-grid">
<div><label for="title">Course Title</label><input id="title" name="title" value="<?php echo $title; ?>"><small><?php echo isset($errors['title']) ? $errors['title'] : ''; ?></small></div>
<div><label for="instructor">Instructor Name</label><input id="instructor" name="instructor" value="<?php echo $instructor; ?>"><small><?php echo isset($errors['instructor']) ? $errors['instructor'] : ''; ?></small></div>
<div class="full-field"><label for="image">Course Image URL</label><input id="image" name="image" value="<?php echo $image; ?>" placeholder="https://example.com/course-image.jpg"><small><?php echo isset($errors['image']) ? $errors['image'] : ''; ?></small></div>
<div class="full-field"><label for="description">Description</label><textarea id="description" name="description" rows="5"><?php echo $description; ?></textarea><small><?php echo isset($errors['description']) ? $errors['description'] : ''; ?></small></div>
<div><label for="price">Price (EGP)</label><input type="number" id="price" name="price" value="<?php echo $price; ?>" min="1" step="0.01"><small><?php echo isset($errors['price']) ? $errors['price'] : ''; ?></small></div>
<div><label for="duration">Duration</label><input id="duration" name="duration" value="<?php echo $duration; ?>" placeholder="6 Weeks"><small><?php echo isset($errors['duration']) ? $errors['duration'] : ''; ?></small></div>
<div><label for="level">Level</label><select id="level" name="level"><option value="">Select level</option><option value="Beginner" <?php echo $level == 'Beginner' ? 'selected' : ''; ?>>Beginner</option><option value="Intermediate" <?php echo $level == 'Intermediate' ? 'selected' : ''; ?>>Intermediate</option></select><small><?php echo isset($errors['level']) ? $errors['level'] : ''; ?></small></div>
<div><label for="status">Availability Status</label><select id="status" name="status"><option value="Available" <?php echo $status == 'Available' ? 'selected' : ''; ?>>Available</option><option value="Unavailable" <?php echo $status == 'Unavailable' ? 'selected' : ''; ?>>Unavailable</option></select><small><?php echo isset($errors['status']) ? $errors['status'] : ''; ?></small></div>
</div><button class="button form-button" type="submit">Add Course</button></form></div></section>
<?php include('../includes/footer.php'); ?>
