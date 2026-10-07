<?php

require_once "config/database.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: portfolio.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT 
        portfolio_projects.*,
        portfolio_categories.name AS category_name
    FROM portfolio_projects
    LEFT JOIN portfolio_categories
        ON portfolio_projects.category_id = portfolio_categories.id
    WHERE portfolio_projects.id = ?
");

$stmt->execute([$id]);

$project = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$project) {
    header("Location: portfolio.php");
    exit;
}

$imageStmt = $pdo->prepare("
    SELECT image
    FROM portfolio_images
    WHERE project_id = ?
    ORDER BY sort_order ASC
");

$imageStmt->execute([$id]);

$images = $imageStmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>
        <?= htmlspecialchars($project['title']) ?> - Kelly
    </title>

    <meta name="description" content="<?= htmlspecialchars($project['short_description']) ?>">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="portfolio-details-page">

<header id="header" class="header d-flex align-items-center light-background sticky-top">

    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

        <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
            <h1 class="sitename">Kelly</h1>
        </a>

        <nav id="navmenu" class="navmenu">

            <ul>

                <li>
                    <a href="index.php">Home</a>
                </li>

                <li>
                    <a href="about.php">About</a>
                </li>

                <li>
                    <a href="resume.php">Resume</a>
                </li>

                <li>
                    <a href="services.php">Services</a>
                </li>

                <li>
                    <a href="portfolio.php" class="active">Portfolio</a>
                </li>

                <li class="dropdown">
                    <a href="#">
                        <span>Dropdown</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>

                    <ul>

                        <li>
                            <a href="#">Dropdown 1</a>
                        </li>

                        <li class="dropdown">

                            <a href="#">
                                <span>Deep Dropdown</span>
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                            </a>

                            <ul>

                                <li><a href="#">Deep Dropdown 1</a></li>
                                <li><a href="#">Deep Dropdown 2</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>

                            </ul>

                        </li>

                        <li><a href="#">Dropdown 2</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>

                    </ul>

                </li>

                <li>
                    <a href="contact.php">Contact</a>
                </li>

            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

        </nav>

        <div class="header-social-links">

            <a href="#" class="twitter">
                <i class="bi bi-twitter-x"></i>
            </a>

            <a href="#" class="facebook">
                <i class="bi bi-facebook"></i>
            </a>

            <a href="#" class="instagram">
                <i class="bi bi-instagram"></i>
            </a>

            <a href="#" class="linkedin">
                <i class="bi bi-linkedin"></i>
            </a>

        </div>

    </div>

</header>


<main class="main">

    <!-- Portfolio Details Section -->

    <section id="portfolio-details" class="portfolio-details section">

        <div class="container section-title" data-aos="fade-up">

            <h2>Portfolio Details</h2>

            <p>
                <?= htmlspecialchars($project['short_description']) ?>
            </p>

        </div>


        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">


                <!-- Project Image -->

                <div class="col-lg-8">

                    <div class="portfolio-details-slider swiper init-swiper">

                        <script type="application/json" class="swiper-config">

                            {
                                "loop": true,
                                "speed": 600,
                                "autoplay": {
                                    "delay": 5000
                                },
                                "slidesPerView": "auto",
                                "pagination": {
                                    "el": ".swiper-pagination",
                                    "type": "bullets",
                                    "clickable": true
                                }
                            }

                        </script>


                        <div class="swiper-wrapper align-items-center">

                            <div class="swiper-slide">

                                <img
                                        src="<?= htmlspecialchars($project['main_image']) ?>"
                                        alt="<?= htmlspecialchars($project['title']) ?>"
                                >

                            </div>

                            <?php foreach ($images as $image): ?>

                                <div class="swiper-slide">

                                    <img
                                            src="<?= htmlspecialchars($image['image']) ?>"
                                            alt="<?= htmlspecialchars($project['title']) ?>"
                                    >

                                </div>

                            <?php endforeach; ?>

                        </div>

                        <div class="swiper-pagination"></div>

                    </div>

                </div>


                <!-- Project Information -->

                <div class="col-lg-4">

                    <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">

                        <h3>Project information</h3>

                        <ul>

                            <li>
                                <strong>Category</strong>:
                                <?= htmlspecialchars($project['category_name']) ?>
                            </li>

                            <li>
                                <strong>Client</strong>:
                                <?= htmlspecialchars($project['client']) ?>
                            </li>

                            <li>
                                <strong>Project date</strong>:
                                <?= htmlspecialchars($project['project_date']) ?>
                            </li>

                            <li>
                                <strong>Project URL</strong>:

                                <?php if (!empty($project['project_url'])): ?>

                                    <a
                                        href="<?= htmlspecialchars($project['project_url']) ?>"
                                        target="_blank"
                                    >
                                        <?= htmlspecialchars($project['project_url']) ?>
                                    </a>

                                <?php else: ?>

                                    <span>Not available</span>

                                <?php endif; ?>

                            </li>

                        </ul>

                    </div>


                    <!-- Project Description -->

                    <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">

                        <h2>
                            <?= htmlspecialchars($project['title']) ?>
                        </h2>

                        <p>
                            <?= nl2br(htmlspecialchars($project['description'])) ?>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

</main>


<footer id="footer" class="footer light-background">

    <div class="container">

        <div class="copyright text-center">

            <p>
                © <span>Copyright</span>
                <strong class="px-1 sitename">Kelly</strong>
                <span>All Rights Reserved<br></span>
            </p>

        </div>

        <div class="social-links d-flex justify-content-center">

            <a href="">
                <i class="bi bi-twitter-x"></i>
            </a>

            <a href="">
                <i class="bi bi-facebook"></i>
            </a>

            <a href="">
                <i class="bi bi-instagram"></i>
            </a>

            <a href="">
                <i class="bi bi-linkedin"></i>
            </a>

        </div>

        <div class="credits">

            Designed by
            <a href="https://bootstrapmade.com/">BootstrapMade</a>
            |
            <a href="https://bootstrapmade.com/tools/">DevTools</a>

        </div>

    </div>

</footer>


<!-- Scroll Top -->

<a
    href="#"
    id="scroll-top"
    class="scroll-top d-flex align-items-center justify-content-center"
>
    <i class="bi bi-arrow-up-short"></i>
</a>


<!-- Preloader -->

<div id="preloader"></div>


<!-- Vendor JS Files -->

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="assets/vendor/php-email-form/validate.js"></script>

<script src="assets/vendor/aos/aos.js"></script>

<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>

<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

<script src="assets/js/main.js"></script>

</body>

</html>