<?php
$page_title = 'Course Details';
require('config/connection.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: courses.php');
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM courses WHERE id = $id";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 0) {
    header('Location: courses.php');
    exit();
}

$course = mysqli_fetch_assoc($result);
include('includes/header.php');
?>

<section class="section container">
    <a class="back-link" href="courses.php">&larr; Back to all courses</a>
    <?php if (isset($_GET['message'])) { ?><p class="success-message"><?php echo $_GET['message']; ?></p><?php } ?>
    <div class="details-layout">
        <img class="details-image" src="<?php echo $course['image']; ?>" alt="<?php echo $course['title']; ?>">
        <div class="details-content">
            <p class="eyebrow"><?php echo $course['level']; ?> LEVEL</p>
            <h1><?php echo $course['title']; ?></h1>
            <p class="details-description"><?php echo $course['description']; ?></p>
            <div class="detail-facts"><div><span>Duration</span><strong><?php echo $course['duration']; ?></strong></div><div><span>Level</span><strong><?php echo $course['level']; ?></strong></div><div><span>Price</span><strong>EGP <?php echo $course['price']; ?></strong></div></div>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <a class="button" href="enroll.php?id=<?php echo $course['id']; ?>">Enroll Now</a>
            <?php } else { ?>
                <a class="button" href="login.php?message=Please log in before enrolling.">Log in to Enroll</a>
            <?php } ?>
        </div>
    </div>
</section>
<?php include('includes/footer.php'); ?>
