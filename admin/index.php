<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once "includes/db.php";


/* ============================================================
   DASHBOARD STATISTICS
   ============================================================ */

$educationCount = $pdo->query("
    SELECT COUNT(*) 
    FROM education
")->fetchColumn();

$experienceCount = $pdo->query("
    SELECT COUNT(*) 
    FROM experience
")->fetchColumn();

$skillsCount = $pdo->query("
    SELECT COUNT(*) 
    FROM skills
")->fetchColumn();

$servicesCount = $pdo->query("
    SELECT COUNT(*) 
    FROM services
")->fetchColumn();

$portfolioCount = $pdo->query("
    SELECT COUNT(*) 
    FROM portfolio_projects
")->fetchColumn();

$messagesCount = $pdo->query("
    SELECT COUNT(*) 
    FROM contact_messages
")->fetchColumn();


/* ============================================================
   RECENT MESSAGES
   ============================================================ */

$recentMessages = $pdo->query("
    SELECT *
    FROM contact_messages
    ORDER BY id DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Kelly Admin</title>

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
            rel="stylesheet"
    >

    <link
            rel="stylesheet"
            href="assets/css/admin.css?v=4"
    >

</head>


<body>

<div class="admin-wrapper">


    <?php require_once 'includes/sidebar.php'; ?>


    <main class="main-content">


        <!-- =====================================================
             PAGE HEADER
        ====================================================== -->

        <div class="page-header">

            <div>

                <h1>Dashboard</h1>

                <p>
                    Overview of your portfolio website.
                </p>

            </div>

        </div>


        <!-- =====================================================
             STATISTICS
        ====================================================== -->

        <div class="dashboard-stats">


            <!-- Education -->

            <a href="education.php" class="dashboard-stat-card">

                <div class="dashboard-stat-icon">

                    <i class="bi bi-mortarboard"></i>

                </div>

                <div class="dashboard-stat-content">

                    <span class="dashboard-stat-label">
                        Education
                    </span>

                    <strong>
                        <?= (int) $educationCount ?>
                    </strong>

                </div>

            </a>


            <!-- Experience -->

            <a href="experience.php" class="dashboard-stat-card">

                <div class="dashboard-stat-icon">

                    <i class="bi bi-briefcase"></i>

                </div>

                <div class="dashboard-stat-content">

                    <span class="dashboard-stat-label">
                        Experience
                    </span>

                    <strong>
                        <?= (int) $experienceCount ?>
                    </strong>

                </div>

            </a>


            <!-- Skills -->

            <a href="skills.php" class="dashboard-stat-card">

                <div class="dashboard-stat-icon">

                    <i class="bi bi-bar-chart"></i>

                </div>

                <div class="dashboard-stat-content">

                    <span class="dashboard-stat-label">
                        Skills
                    </span>

                    <strong>
                        <?= (int) $skillsCount ?>
                    </strong>

                </div>

            </a>


            <!-- Services -->

            <a href="services.php" class="dashboard-stat-card">

                <div class="dashboard-stat-icon">

                    <i class="bi bi-gear"></i>

                </div>

                <div class="dashboard-stat-content">

                    <span class="dashboard-stat-label">
                        Services
                    </span>

                    <strong>
                        <?= (int) $servicesCount ?>
                    </strong>

                </div>

            </a>


            <!-- Portfolio -->

            <a href="portfolio.php" class="dashboard-stat-card">

                <div class="dashboard-stat-icon">

                    <i class="bi bi-images"></i>

                </div>

                <div class="dashboard-stat-content">

                    <span class="dashboard-stat-label">
                        Portfolio
                    </span>

                    <strong>
                        <?= (int) $portfolioCount ?>
                    </strong>

                </div>

            </a>


            <!-- Messages -->

            <a href="messages.php" class="dashboard-stat-card">

                <div class="dashboard-stat-icon">

                    <i class="bi bi-envelope"></i>

                </div>

                <div class="dashboard-stat-content">

                    <span class="dashboard-stat-label">
                        Messages
                    </span>

                    <strong>
                        <?= (int) $messagesCount ?>
                    </strong>

                </div>

            </a>


        </div>


        <!-- =====================================================
             DASHBOARD LOWER SECTION
        ====================================================== -->

        <div class="dashboard-grid">


            <!-- =================================================
                 RECENT MESSAGES
            ================================================== -->

            <section class="dashboard-card">

                <div class="dashboard-card-header">

                    <div>

                        <h2>Recent Messages</h2>

                        <p>
                            Latest messages received from your portfolio.
                        </p>

                    </div>

                    <a href="messages.php" class="dashboard-view-all">
                        View All
                    </a>

                </div>


                <?php if (!empty($recentMessages)): ?>


                    <div class="dashboard-messages">


                        <?php foreach ($recentMessages as $message): ?>

                            <div class="dashboard-message">


                                <div class="dashboard-message-icon">

                                    <i class="bi bi-person"></i>

                                </div>


                                <div class="dashboard-message-content">

                                    <strong>
                                        <?= htmlspecialchars(
                                                $message['name'] ?? 'Unknown'
                                        ) ?>
                                    </strong>

                                    <span>
                                        <?= htmlspecialchars(
                                                $message['email'] ?? ''
                                        ) ?>
                                    </span>


                                    <?php if (!empty($message['message'])): ?>

                                        <p>
                                            <?= htmlspecialchars(
                                                    mb_strimwidth(
                                                            $message['message'],
                                                            0,
                                                            100,
                                                            '...'
                                                    )
                                            ) ?>
                                        </p>

                                    <?php endif; ?>


                                </div>


                            </div>

                        <?php endforeach; ?>


                    </div>


                <?php else: ?>


                    <div class="dashboard-empty">

                        <div class="dashboard-empty-icon">

                            <i class="bi bi-envelope-open"></i>

                        </div>

                        <h3>No messages yet</h3>

                        <p>
                            Messages from your portfolio contact form
                            will appear here.
                        </p>

                    </div>


                <?php endif; ?>


            </section>



            <!-- =================================================
                 QUICK ACTIONS
            ================================================== -->

            <section class="dashboard-card">

                <div class="dashboard-card-header">

                    <div>

                        <h2>Quick Actions</h2>

                        <p>
                            Manage your portfolio content.
                        </p>

                    </div>

                </div>


                <div class="dashboard-actions">


                    <a href="profile.php" class="dashboard-action">

                        <i class="bi bi-person"></i>

                        <div>

                            <strong>
                                Edit Profile
                            </strong>

                            <span>
                                Update your personal information
                            </span>

                        </div>

                    </a>


                    <a href="portfolio.php" class="dashboard-action">

                        <i class="bi bi-images"></i>

                        <div>

                            <strong>
                                Manage Portfolio
                            </strong>

                            <span>
                                Add or edit your projects
                            </span>

                        </div>

                    </a>


                    <a href="experience.php" class="dashboard-action">

                        <i class="bi bi-briefcase"></i>

                        <div>

                            <strong>
                                Manage Experience
                            </strong>

                            <span>
                                Update your work experience
                            </span>

                        </div>

                    </a>


                    <a href="messages.php" class="dashboard-action">

                        <i class="bi bi-envelope"></i>

                        <div>

                            <strong>
                                View Messages
                            </strong>

                            <span>
                                Check messages from visitors
                            </span>

                        </div>

                    </a>


                </div>


            </section>


        </div>


    </main>

</div>

</body>

</html>