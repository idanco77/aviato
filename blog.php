<?php
require_once 'app/helper.php';
?>
<?php
my_session_start('the_blog');
if (!verify_user()) {
    header('location: signin.php');
    exit;
}
$title = 'Blog';
$posts = [];
$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
mysqli_query($link, 'SET NAMES utf8');
$sql = "SELECT p.*,u.name FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.date DESC";
$result = mysqli_query($link, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
}
?>

<?php include 'partials/header.php'; ?>
<div class="container-fluid av-blog content mt-5 pt-4 text-center mb-3">
    <h1>The Blog</h1>
    <input class="btn" type="button" value="add new post" onclick="location = 'add_post.php'">
    <?php if ($posts): ?>
        <div class="blog-wrapper">
            <?php foreach ($posts as $post): ?>
                <hr class="featurette-divider">
                <div class="post-blog row featurette bg-light">
                    <div class="col-md-12">
                        <h2 class="featurette-heading"><?= htmlentities($post['title']); ?></h2>
                        <p class="lead article"><?= str_replace("\n", '<br>', htmlentities($post['article'])); ?></p>
                    </div>

                    <p><i>written by: <?= htmlentities($post['name']); ?>. published at: <?= $post['date']; ?></i>
                        <?php if ($_SESSION['id'] == $post['user_id']): ?>
                            <span class="float-right">
                                <a class="px-2" href="edit_post.php?pid=<?= $post['id']; ?>">Edit</a>
                                <a href="delete_post.php?pid=<?= $post['id']; ?>">Delete</a>
                            </span>
                        <?php endif; ?>
                    </p>        

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php include 'partials/footer.php'; ?>