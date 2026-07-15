<?php
$page_title = 'Create Account';
require('config/connection.php');

$errors = [];
$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($name)) { $errors['name'] = 'Please enter your full name.'; }
    if (empty($email)) { $errors['email'] = 'Please enter your email address.'; }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors['email'] = 'Please enter a valid email address.'; }
    if (empty($password)) { $errors['password'] = 'Please enter a password.'; }
    elseif (strlen($password) < 6) { $errors['password'] = 'Password must be at least 6 characters.'; }
    if ($password != $confirm_password) { $errors['confirm_password'] = 'Passwords do not match.'; }

    if (empty($errors)) {
        $check_query = "SELECT id FROM users WHERE email = '$email'";
        $check_result = mysqli_query($connection, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            $errors['email'] = 'This email is already registered.';
        } else {
            $hashed_password = md5($password);
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
            $result = mysqli_query($connection, $query);
            if ($result) {
                header('Location: login.php?message=Account created successfully. Please log in.');
                exit();
            }
        }
    }
}
include('includes/header.php');
?>

<section class="auth-section"><div class="auth-card"><p class="eyebrow">JOIN CODEPATH</p><h1>Create your account</h1><p>Start building your programming skills today.</p>
<form action="register.php" method="POST" novalidate>
    <label for="name">Full Name</label><input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="Ahmed Mohamed"><small><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></small>
    <label for="email">Email Address</label><input type="email" id="email" name="email" value="<?php echo $email; ?>" placeholder="ahmed@example.com"><small><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></small>
    <label for="password">Password</label><input type="password" id="password" name="password" placeholder="At least 6 characters"><small><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></small>
    <label for="confirm_password">Confirm Password</label><input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your password again"><small><?php echo isset($errors['confirm_password']) ? $errors['confirm_password'] : ''; ?></small>
    <button class="button form-button" type="submit">Create Account</button>
</form><p class="auth-bottom">Already have an account? <a href="login.php">Log in</a></p></div></section>
<?php include('includes/footer.php'); ?>
