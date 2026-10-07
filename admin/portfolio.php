
<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'includes/db.php';

$projects = $pdo->query("
    SELECT
        portfolio_projects.*,
        portfolio_categories.name AS category_name
    FROM portfolio_projects
    LEFT JOIN portfolio_categories
        ON portfolio_projects.category_id = portfolio_categories.id
    ORDER BY portfolio_projects.id DESC
")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portfolio | Admin Panel</title>

    <link rel="stylesheet" href="assets/css/admin.css?v=8">

</head>

<body>

<div class="admin-wrapper">


    <?php require_once 'includes/sidebar.php'; ?>

    <!-- MAIN CONTENT -->

    <main class="main-content">

        <div class="portfolio-page">

            <div class="portfolio-header">

                <div>

                    <h1>Portfolio</h1>

                    <p>
                        Manage your portfolio projects.
                    </p>

                </div>

            </div>


            <div class="portfolio-card">

                <?php if (count($projects) > 0): ?>

                    <div class="portfolio-table-wrapper">

                        <table class="portfolio-table">

                            <thead>

                            <tr>

                                <th>Image</th>

                                <th>Title</th>

                                <th>Category</th>

                                <th>Client</th>

                                <th>Date</th>

                            </tr>

                            </thead>


                            <tbody>

                            <?php foreach ($projects as $project): ?>

                                <tr>

                                    <td>

                                        <?php if (!empty($project['main_image'])): ?>

                                            <img
                                                    src="../<?= htmlspecialchars($project['main_image']) ?>"
                                                    alt="<?= htmlspecialchars($project['title']) ?>"
                                                    class="portfolio-image"
                                            >

                                        <?php else: ?>

                                            <div class="portfolio-no-image">
                                                No Image
                                            </div>

                                        <?php endif; ?>

                                    </td>


                                    <td>

                                        <strong>
                                            <?= htmlspecialchars($project['title']) ?>
                                        </strong>

                                    </td>


                                    <td>

                                        <span class="portfolio-category">

                                            <?= htmlspecialchars($project['category_name'] ?? 'Uncategorized') ?>

                                        </span>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars($project['client'] ?? '-') ?>

                                    </td>


                                    <td>

                                        <?= htmlspecialchars($project['project_date'] ?? '-') ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                <?php else: ?>

                    <div class="portfolio-empty">

                        <div class="portfolio-empty-icon">
                            ◇
                        </div>

                        <h2>No Portfolio Projects</h2>

                        <p>
                            There are no portfolio projects yet.
                        </p>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </main>

</div>

</body>

</html>

