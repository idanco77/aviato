<?php
require_once 'app/helper.php';
?>
<?php
my_session_start('the_blog');
if (isset($_POST['id'])) {
    header('location: blog.php');
}
$title = 'Sign up';
$error['fname'] = $error['email'] = $error['password'] = '';

if (isset($_POST['submit'])) {
    if (isset($_POST['token']) && isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token']) {
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        mysqli_query($link, 'SET NAMES utf8');
        $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
        $fname = trim($fname);
        $fname = mysqli_real_escape_string($link, $fname);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $email = trim($email);
        $email = mysqli_real_escape_string($link, $email);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $password = trim($password);
        $password = mysqli_real_escape_string($link, $password);
        $cpassword = filter_input(INPUT_POST, 'confirm-password', FILTER_SANITIZE_STRING);
        $cpassword = trim($cpassword);
        $valid = true;
        if (!$fname || mb_strlen($fname) < 2 || mb_strlen($fname) > 70) {
            $valid = false;
            $error['fname'] = 'please enter a valid name';
        }
        if (!$email) {
            $error['email'] = 'please enter a valid email';
            $valid = false;
        } elseif (email_exist($link, $email)) {
            $error['email'] = 'your email is already exists, please sign in';
            $valid = false;
        }
        if (!$password) {
            $error['password'] = 'please enter a valid password';
            $valid = false;
        } elseif ($password != $cpassword) {
            $error['password'] = 'password and confirm password miss match';
            $valid = false;
        }
        if ($valid) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users VALUES('','$fname','$email','$password')";
            $result = mysqli_query($link, $sql);
            $rows = mysqli_affected_rows($link);
            if ($result && $rows == 1) {
                $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['id'] = mysqli_insert_id($link);
                $_SESSION['name'] = $fname;
                header('location: blog.php?sm=1');
                exit;
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
            <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>

            <input type="hidden" name="token" value="<?= $token; ?>">

            <label for="fname" class="sr-only">full name:</label>                  
            <input type="text" id="fname" name="fname" class="form-control" placeholder="Full Name" autofocus value="<?= old('fname'); ?>">
            <span class="text-danger" id="error"><?= $error['fname']; ?></span>

            <label for="email" class="sr-only">email:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" autofocus value="<?= old('email'); ?>">
            <span class="text-danger" id="error"><?= $error['email']; ?></span>

            <label for="password" class="sr-only">password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <span class="text-danger" id="error"><?= $error['password']; ?></span>

            <label for="confirm-password" class="sr-only">confirm password:</label>
            <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder=" Confirm password">

            <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="signup">


        </form>

    </div>
</div>


<?php include 'partials/footer.php'; ?>

