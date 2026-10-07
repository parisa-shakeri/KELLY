<?php
require_once 'config/database.php';

$stmt = $pdo->query("SELECT * FROM profile LIMIT 1");
$profile = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM skills ORDER BY sort_order ASC");
$skills = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM stats ORDER BY sort_order ASC");
$stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $pdo->query("SELECT * FROM testimonials ORDER BY sort_order ASC");
$testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>About - Kelly Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Kelly
    * Template URL: https://bootstrapmade.com/kelly-free-bootstrap-cv-resume-html-template/
    * Updated: Aug 07 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body class="about-page">

<header id="header" class="header d-flex align-items-center light-background sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">Kelly</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php" class="active">About</a></li>
                <li><a href="resume.php">Resume</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
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
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="header-social-links">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>

    </div>
</header>

<main class="main">

    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>About</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 justify-content-center">
                <div class="col-lg-4">
                    <img src="<?= htmlspecialchars($profile['image']) ?>" class="img-fluid"
                         alt="<?= htmlspecialchars($profile['name']) ?>">
                </div>
                <div class="col-lg-8 content">
                    <h2><?= htmlspecialchars($profile['role']) ?></h2>
                    <p class="fst-italic py-3">
                        <?= htmlspecialchars($profile['description']) ?>
                    </p>

                    <div class="row">
                        <div class="col-lg-6">

                            <ul>
                                <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong>
                                    <span><?= htmlspecialchars($profile['birth_date']) ?></span></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong>
                                    <span><?= htmlspecialchars($profile['website']) ?></span></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong>
                                    <span><?= htmlspecialchars($profile['mobile']) ?></span></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>City:</strong>
                                    <span><?= htmlspecialchars($profile['city']) ?></span></li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul>
                                <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong>
                                    <span><?= htmlspecialchars($profile['age']) ?></span></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong>
                                    <span><?= htmlspecialchars($profile['degree']) ?></span></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong>
                                    <span><?= htmlspecialchars($profile['email']) ?></span></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong>
                                    <span><?= htmlspecialchars($profile['freelance_status']) ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <p class="py-3">
                        Officiis eligendi itaque labore et dolorum mollitia officiis optio vero. Quisquam sunt adipisci
                        omnis et ut. Nulla accusantium dolor incidunt officia tempore. Et eius omnis.
                        Cupiditate ut dicta maxime officiis quidem quia. Sed et consectetur qui quia repellendus itaque
                        neque.
                    </p>
                </div>
            </div>

        </div>

    </section>
    <!-- /About Section -->
    <!-- Skills Section -->
    <section id="skills" class="skills section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Skills</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row skills-content skills-animation">

                <div class="col-lg-6">

                    <?php foreach ($skills as $index => $skill): ?>

                        <?php if ($index % 2 == 0): ?>

                            <div class="progress">
                            <span class="skill">
                                <span><?= htmlspecialchars($skill['name']) ?></span>
                                <i class="val"><?= htmlspecialchars($skill['percentage']) ?>%</i>
                            </span>

                                <div class="progress-bar-wrap">
                                    <div class="progress-bar"
                                         role="progressbar"
                                         aria-valuenow="<?= htmlspecialchars($skill['percentage']) ?>"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                            </div><!-- End Skills Item -->

                        <?php endif; ?>

                    <?php endforeach; ?>

                </div>

                <div class="col-lg-6">

                    <?php foreach ($skills as $index => $skill): ?>

                        <?php if ($index % 2 != 0): ?>

                            <div class="progress">
                            <span class="skill">
                                <span><?= htmlspecialchars($skill['name']) ?></span>
                                <i class="val"><?= htmlspecialchars($skill['percentage']) ?>%</i>
                            </span>

                                <div class="progress-bar-wrap">
                                    <div class="progress-bar"
                                         role="progressbar"
                                         aria-valuenow="<?= htmlspecialchars($skill['percentage']) ?>"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                            </div><!-- End Skills Item -->

                        <?php endif; ?>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

    </section>

    <!-- /Skills Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Facts</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <?php foreach ($stats as $stat): ?>

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                <span
                        data-purecounter-start="0"
                        data-purecounter-end="<?= htmlspecialchars($stat['value']) ?>"
                        data-purecounter-duration="1"
                        class="purecounter">
                </span>
                            <p><?= htmlspecialchars($stat['title']) ?></p>
                        </div>
                    </div><!-- End Stats Item -->

                <?php endforeach; ?>

            </div>

        </div>

    </section><!-- /Stats Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Testimonials</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">

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

                <div class="swiper-wrapper">

                    <?php foreach ($testimonials as $testimonial): ?>

                        <div class="swiper-slide">
                            <div class="testimonial-item">

                                <img src="<?= htmlspecialchars($testimonial['image']) ?>"
                                     class="testimonial-img"
                                     alt="<?= htmlspecialchars($testimonial['name']) ?>">

                                <h3><?= htmlspecialchars($testimonial['name']) ?></h3>

                                <h4><?= htmlspecialchars($testimonial['role']) ?></h4>

                                <div class="stars">
                                    <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                        <i class="bi bi-star-fill"></i>
                                    <?php endfor; ?>
                                </div>

                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span><?= htmlspecialchars($testimonial['message']) ?></span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>




                            </div>
                        </div><!-- End testimonial item -->

                    <?php endforeach; ?>

                </div>

                <div class="swiper-pagination"></div>

            </div>

        </div>

    </section><!-- /Testimonials Section -->

</main>

<footer id="footer" class="footer light-background">

    <div class="container">
        <div class="copyright text-center ">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Kelly</strong>
                <span>All Rights Reserved<br></span></p>
        </div>
        <div class="social-links d-flex justify-content-center">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> | <a
                    href="https://bootstrapmade.com/tools/">DevTools</a>
        </div>
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>