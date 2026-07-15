<?php
$page_title = 'Login';
require('config/connection.php');

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = 'Please enter your email and password.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        $hashed_password = md5($password);
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$hashed_password'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: my-courses.php?message=Welcome back, ' . $user['name'] . '!');
            exit();
        } else {
            $error = 'Incorrect email or password.';
        }
    }
}
include('includes/header.php');
?>

<section class="auth-section"><div class="auth-card"><p class="eyebrow">WELCOME BACK</p><h1>Log in to learn</h1><p>Continue your journey and access your courses.</p>
<?php if (isset($_GET['message'])) { ?><p class="success-message"><?php echo $_GET['message']; ?></p><?php } ?>
<?php if (!empty($error)) { ?><p class="error-message"><?php echo $error; ?></p><?php } ?>
<form action="login.php" method="POST" novalidate>
    <label for="email">Email Address</label><input type="email" id="email" name="email" value="<?php echo $email; ?>" placeholder="ahmed@example.com">
    <label for="password">Password</label><input type="password" id="password" name="password" placeholder="Enter your password">
    <button class="button form-button" type="submit">Log In</button>
</form><p class="auth-bottom">New to CodePath? <a href="register.php">Create an account</a></p></div></section>
<?php include('includes/footer.php'); ?>
