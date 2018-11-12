<?php
require_once 'app/helper.php';
?>
<?php
my_session_start('the_blog');
$title = 'home page';
?>

<?php include 'partials/header.php'; ?>
<main role="main" class="mt-5">

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide" src="img/carousel-image-1.jpg" width="100%" height="500px" alt="First slide">
                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>Welcome to AVIATO</h1>

                        <p><a class="btn btn-lg btn-primary" href="blog.php" role="button">Start here</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="second-slide" src="img/carousel-image-2.jpg" height="500px" width="100%" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>AVIATO - aviation blog</h1>

                        <p><a class="btn btn-lg btn-primary" href="blog.php" role="button">Start here</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="third-slide" src="img/carousel-image-3.jpg" height="500px" width="100%" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption text-right">
                        <h1>Best aviation blog in the world</h1>

                        <p><a class="btn btn-lg btn-primary" href="blog.php" role="button">Start here</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <?php include 'partials/footer.php'; ?>
