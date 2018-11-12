<?php
require_once 'app/helper.php';
?>
<?php
my_session_start('the_blog');
$title = 'About';
?>

<?php include 'partials/header.php'; ?>
<div class="about-us container-fluid content mt-5 pt-4">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">

        <main role="main" class="inner cover">
            <h1 class="cover-heading">About us</h1>
            <p class="lead">Welcome to Aviatos. we are love aviation. 
                Addicted to everything relative that moves the aeronautical sector, from airports to the most remote corner of any plane.

                We want to take this blog to get you curiosities, information and deal with all the topics that move through the sky, but seen from the ground. 
                So, buckle up ... we took off!<p class="lead">
                <a href="blog.php" class="btn btn-lg btn-secondary">Go to our blog</a>
            </p>
        </main>
    </div>
</div>


<?php include 'partials/footer.php'; ?>