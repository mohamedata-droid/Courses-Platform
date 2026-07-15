<?php
$page_title = 'Learn Programming with Confidence';
require('config/connection.php');

$query = 'SELECT * FROM courses LIMIT 3';
$result = mysqli_query($connection, $query);
$featured_courses = mysqli_fetch_all($result, MYSQLI_ASSOC);

include('includes/header.php');
?>

<section class="hero">
    <div class="container hero-content">
        <div>
            <p class="eyebrow">LEARN. BUILD. GROW.</p>
            <h1>Turn your curiosity into <span>real web skills.</span></h1>
            <p class="hero-text">Clear, practical programming courses designed to help you build confidence one project at a time.</p>
            <a class="button" href="courses.php">Explore Courses</a>
            <?php if (!isset($_SESSION['user_id'])) { ?>
                <a class="button button-light" href="register.php">Create Free Account</a>
            <?php } ?>
        </div>
        <div class="hero-card">
            <p class="card-label">START LEARNING TODAY</p>
            <h2>6 focused courses<br>for future developers.</h2>
            <div class="mini-stat"><strong>100%</strong><span>Practical learning</span></div>
            <div class="mini-stat"><strong>3</strong><span>Skill levels</span></div>
        </div>
    </div>
</section>

<section class="section container">
    <div class="section-heading">
        <div>
            <p class="eyebrow">FEATURED COURSES</p>
            <h2>Start with a skill that matters.</h2>
        </div>
        <a class="text-link" href="courses.php">View all courses &rarr;</a>
    </div>
    <div class="course-grid">
        <?php foreach ($featured_courses as $course) { ?>
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

<section class="benefits">
    <div class="container">
        <p class="eyebrow">WHY CODEPATH</p>
        <div class="benefit-grid">
            <div><span>01</span><h3>Clear path</h3><p>Start with the essentials and grow your skills in a logical order.</p></div>
            <div><span>02</span><h3>Practical focus</h3><p>Learn by creating pages, forms, databases, and complete projects.</p></div>
            <div><span>03</span><h3>Learn anywhere</h3><p>Our responsive platform makes finding your next course simple on every device.</p></div>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>
