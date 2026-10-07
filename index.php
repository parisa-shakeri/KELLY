<?php

//connect to DB
require_once 'config/database.php';
// Get the main profile( only 1)
$stmt = $pdo->query("SELECT * FROM profile LIMIT 1");


$profile = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- HEADER -->
<?php include 'includes/header.php'; ?>
<!--MAIN-->
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

        <div class="container text-center" data-aos="zoom-out" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <h2><?= htmlspecialchars($profile['name']) ?></h2>

                    <p><?= htmlspecialchars($profile['role']) ?></p>

                    <a href="about.php" class="btn-get-started">About Me</a>

                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

</main>




<!--FOOTER-->
<?php include 'includes/footer.php'; ?>
