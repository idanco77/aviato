<?php
require_once 'app/helper.php';
?>
<?php
my_session_start('the_blog');
if (!verify_user()) {
    header('location: signin.php');
    exit;
}
$title = 'Updtae Post';
$error = '';
$pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING);
$pid = trim($pid);
if ($pid && is_numeric($pid)) {
    $uid = $_SESSION['id'];
    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    mysqli_query($link, 'SET NAMES utf8');
    $pid = mysqli_real_escape_string($link, $pid);
    $uid = mysqli_real_escape_string($link, $uid);
    $sql = "SELECT * FROM posts WHERE id = $pid AND user_id = $uid LIMIT 1";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header('location: blog.php');
        exit;
    }
}

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
        $ftitle = mysqli_real_escape_string($link, $ftitle);
        $article = mysqli_real_escape_string($link, $article);
        $update_sql = "UPDATE posts SET title = '$ftitle', article = '$article' WHERE id = $pid AND user_id = $uid";
        $result = mysqli_query($link, $update_sql);
        if ($result) {
            header('location: blog.php?sm=3');
            exit;
        } else {
            header('location: blog.php');
            exit;
        }
    }
}
?>

<?php include 'partials/header.php'; ?>
<div class="content container">
    <h1>Edit Post</h1>
    <form action="" method="POST">
        <label for="title">title:</label><br>
        <input type="text" id="title" name="title" size="108" value="<?= $row['title']; ?>"> <br><br>
        <label for="article">Article:</label><br>
        <textarea id="article" name="article" cols="100" rows="20"><?= $row['article']; ?></textarea>

        <br><br>
        <input type="button"  class="btn" value="Cancel" onclick="location = 'blog.php'">
        <input type="submit" class="btn" name="submit" value="Update post"><br>
        <span id="error"><?= $error; ?></span>
    </form>


</div>

<?php include 'partials/footer.php'; ?>