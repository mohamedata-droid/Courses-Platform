<?php
$page_title = 'All Courses';
require('config/connection.php');

$query = 'SELECT * FROM courses ORDER BY id ASC';
$result = mysqli_query($connection, $query);
$courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

include('includes/header.php');
?>

<section class="page-banner"><div class="container"><p class="eyebrow">COURSE CATALOGUE</p><h1>Choose your next skill.</h1><p>Explore focused programming courses for every stage of your learning journey.</p></div></section>
<section class="section container">
    <?php if (isset($_GET['message'])) { ?><p class="success-message"><?php echo $_GET['message']; ?></p><?php } ?>
    <div class="course-grid">
        <?php foreach ($courses as $course) { ?>
            <article class="course-card">
                <img src="<?php echo $course['image']; ?>" alt="<?php echo $course['title']; ?>">
                <div class="course-content">
                    <div class="course-meta"><span><?php echo $course['level']; ?></span><span><?php echo $course['duration']; ?></span></div>
                    <h3><?php echo $course['title']; ?></h3>
                    <p><?php echo $course['description']; ?></p>
                    <div class="course-bottom"><strong>EGP <?php echo $course['price']; ?></strong><a href="course-details.php?id=<?php echo $course['id']; ?>">Details &rarr;</a></div>
                </div>
            </article>
        <?php } ?>
    </div>
</section>
<?php include('includes/footer.php'); ?>
