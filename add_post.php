<?php
require_once 'app/helper.php';
?>
<?php
my_session_start('the_blog');
if (!verify_user()) {
    header('location: signin.php');
    exit;
}
$title = 'Add Post';
$error = '';
if (isset($_POST['submit'])) {
    $ftitle = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $ftitle = trim($ftitle);
    $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $article = trim($article);
    if (!$ftitle) {
        $error = 'please add a title';
    } elseif (!$article) {
        $error = 'please add your post';
    } else {
        $uid = $_SESSION['id'];
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        mysqli_query($link, 'SET NAMES utf8');
        $ftitle = mysqli_real_escape_string($link, $ftitle);
        $article = mysqli_real_escape_string($link, $article);
        $sql = "INSERT INTO posts VALUES('', '$uid', '$ftitle', '$article', NOW())";
        $result = mysqli_query($link, $sql);
        if ($result && mysqli_affected_rows($link) == 1) {
            header('location: blog.php?sm=2');
            exit;
        }
    }
}
?>

<?php include 'partials/header.php'; ?>
<div class="container content mt-5 pt-4">
    <h1>Add Post</h1>
    <form action="" method="POST">
        <label for="title">title:</label><br>
        <input type="text" id="title" name="title" size="108" value="<?= htmlentities(old('title')); ?>"> <br><br>
        <label for="article">Article:</label><br>
        <textarea id="article" name="article" cols="100" rows="20" value="<?= htmlentities(old('article')); ?>"></textarea><br><br>
        <input type="button"  class="btn" value="Cancel" onclick="location = 'blog.php'">
        <input type="submit"  class="btn" name="submit" value="add post"><br>
        <span id="error"><?= $error; ?></span>
    </form>


</div>

<?php include 'partials/footer.php'; ?>