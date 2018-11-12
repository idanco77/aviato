<?php
require_once 'app/helper.php';
?>
<?php
my_session_start('the_blog');
if (!verify_user()) {
    header('location: signin.php');
    exit;
}
$title = 'Delete Post';


if (isset($_POST['submit'])) {
    $pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING);
    $pid = trim($pid);
    $uid = $_SESSION['id'];
    if (is_numeric($pid)) {

        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        $pid = mysqli_real_escape_string($link, $pid);
        $sql = "DELETE FROM posts WHERE id=$pid AND user_id=$uid LIMIT 1";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_affected_rows($link) == 1) {

            header('location: blog.php?sm=4');
            exit;
        } else {
            header('location: blog.php');
            exit;
        }
    }
}
?>

<?php include 'partials/header.php'; ?>
<div class="container content mt-5 pt-4">
    <h1>Delete Post</h1>
    <p>Are you sure you want to delete your post?</p>
    <form action="" method="POST">
        <input type="button"  class="btn" value="Cancel" onclick="location = 'blog.php'">
        <input type="submit" class="btn" name="submit" value="delete post"><br>

    </form>


</div>

<?php include 'partials/footer.php'; ?>