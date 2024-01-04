<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php if ($title) echo $title; ?></title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url('front'); ?>/css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?= site_url(); ?>">Blog by <?= writerPost($username); ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= site_url(); ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= linkPostSet('27'); ?>">About</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= linkPostSet('28'); ?>">Sample Post</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?= site_url('/pageb'); ?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('<?php echo base_url("img/$thumbnail"); ?>')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <?php if ($type == 'article') { ?>
                        <div class="post-heading">
                            <h1><?= ($title) ? $title : 'NO TITLE'; ?></h1>
                            <h2 class="subheading"><?= ($desc) ? $desc : 'A Blog Theme by Start Bootstrap'; ?></h2>
                            <span class="meta">
                                Posted by
                                <a href="<?= site_url(); ?>">Blog Hawxly</a>
                                on <?= (isset($created)) ? idForDate($created) : ''; ?>
                            </span>
                        </div>
                    <?php } else { ?>

                        <div class="site-heading">
                            <h1><?= ($title) ? $title : ''; ?></h1>
                            <span class="subheading"><?= ($desc) ? $desc : 'A Blog Theme by Start Bootstrap'; ?></span>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Post preview-->

                <?= $this->renderSection('content'); ?>

                <!-- Post preview-->
                <br>
                <?= (isset($created)) ? idForDate($created) : ''; ?>
                <hr class="my-4" />
                <?= $pager->simpleLinks('fr', 'front'); ?>
            </div>
        </div>
    </div>
    <!-- Footer-->


    <!-- Footer-->
    <footer class="border-top">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <?php
                    helper('global_helper');
                    $confN = "x";
                    $gconf = getConf($confN);
                    $x = $gconf['conf_value'];
                    $confN = "instagram";
                    $gconf = getConf($confN);
                    $instagram = $gconf['conf_value'];
                    $confN = "github";
                    $gconf = getConf($confN);
                    $github = $gconf['conf_value'];

                    ?>
                    <ul class="list-inline text-center">
                        <?php if ($x) { ?>
                            <li class="list-inline-item">
                                <a href="<?= $x; ?>" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($instagram) { ?>
                            <li class="list-inline-item">
                                <a href="<?= $instagram; ?>" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($github) { ?>
                            <li class="list-inline-item">
                                <a href="<?= $github; ?>" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2023</div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= base_url('front'); ?>/js/scripts.js"></script>
</body>

</html>