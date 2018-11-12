<?php
require_once 'app/helper.php';
?>
<?php
my_session_start('the_blog');
if (isset($_POST['id'])) {
    header('location: blog.php');
}
$title = 'Signin';
$error = '';

if (isset($_POST['submit'])) {
    if (isset($_POST['token']) && isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token']) {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $email = trim($email);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $password = trim($password);

        if (!$email) {
            $error = 'please enter a valid email';
        } elseif (!$password) {
            $error = 'a valid password is required';
        } else {
            $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
            $email = mysqli_real_escape_string($link, $email);
            $password = mysqli_real_escape_string($link, $password);
            $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
            $result = mysqli_query($link, $sql);
            if ($result && mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    header('location: blog.php?sm=6');
                    exit();
                } else {
                    $error = 'wrong combination. try again';
                }
            } else {
                $error = 'wrong combination. try again';
            }
        }
    }
    $token = csrf();
} else {
    $token = csrf();
}
?>

<?php include 'partials/header.php'; ?>
<div class="content-signin container-fluid">
    <p class="avi-logo mt-5 text-center">
        <a class="a-avi-logo" href="./"><span><i class="fab fa-aviato fa-6x"></i></span></a>
    </p>
    <div class="signin text-center">

        <form action="" method="POST" novalidate="novalidate" class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="email" class="sr-only">email:</label>

            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" autofocus value="<?= old('email'); ?>">

            <label for="password" class="sr-only">password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="signin">
            <input type="hidden" name="token" value="<?= $token; ?>">
            <span class="text-danger" id="error"><?= $error; ?></span>

        </form>

    </div>
</div>


<?php include 'partials/footer.php'; ?>

