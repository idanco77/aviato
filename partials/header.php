

<!doctype html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css"/>
        <title>the blog | <?= $title; ?></title>

    </head>

    <body>
        <a href="../">Back to idan.online</a>

        <header class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-dark fixed-top mb-2">
                <a class="navbar-brand" href="index.php"><span><i class="fab fa-aviato fa-3x"></i></span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">                       
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">Blog</a>
                        </li>
                        <?php if (isset($_SESSION['id'])): ?>
                            <li class="nav-item text-light"><span class="p-5 h3">Welcome <?= htmlentities($_SESSION['name']); ?></span></li>    
                            <li class="nav-item"><a class="nav-link" href="logout.php">logout</a></li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="signin.php">Signin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="signup.php">Signup</a>
                            </li>
                        <?php endif; ?>                       
                    </ul>
                </div>
            </nav>

            <?php if (isset($_GET['sm']) && isset($messages[$_GET['sm']])): ?>
                <div class="nf-box">
                    <p><?= $messages[$_GET['sm']]; ?></p>
                </div>
            <?php endif; ?>

        </header>

