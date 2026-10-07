<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'includes/db.php';


$message = "";
$error = "";


/* ============================================================
   ADD SERVICE
   ============================================================ */

if (isset($_POST['add_service'])) {

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $icon = trim($_POST['icon'] ?? '');
    $sort_order = (int) ($_POST['sort_order'] ?? 0);

    if ($title === '') {

        $error = "Service title is required.";

    } else {

        try {

            $stmt = $pdo->prepare("
                INSERT INTO services
                (
                    title,
                    description,
                    icon,
                    sort_order
                )
                VALUES
                (
                    :title,
                    :description,
                    :icon,
                    :sort_order
                )
            ");

            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':icon', $icon);
            $stmt->bindValue(':sort_order', $sort_order, PDO::PARAM_INT);

            $stmt->execute();

            $message = "Service added successfully.";

        } catch (PDOException $e) {

            $error = "Something went wrong while adding the service.";

        }
    }
}


/* ============================================================
   UPDATE SERVICE
   ============================================================ */

if (isset($_POST['update_service'])) {

    $id = (int) ($_POST['id'] ?? 0);
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $icon = trim($_POST['icon'] ?? '');
    $sort_order = (int) ($_POST['sort_order'] ?? 0);

    if ($id <= 0 || $title === '') {

        $error = "Service title is required.";

    } else {

        try {

            $stmt = $pdo->prepare("
                UPDATE services
                SET
                    title = :title,
                    description = :description,
                    icon = :icon,
                    sort_order = :sort_order
                WHERE id = :id
            ");

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':icon', $icon);
            $stmt->bindValue(':sort_order', $sort_order, PDO::PARAM_INT);

            $stmt->execute();

            $message = "Service updated successfully.";

        } catch (PDOException $e) {

            $error = "Something went wrong while updating the service.";

        }
    }
}


/* ============================================================
   DELETE SERVICE
   ============================================================ */

if (isset($_GET['delete'])) {

    $id = (int) $_GET['delete'];

    if ($id > 0) {

        try {

            $stmt = $pdo->prepare("
                DELETE FROM services
                WHERE id = :id
            ");

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            $message = "Service deleted successfully.";

        } catch (PDOException $e) {

            $error = "Something went wrong while deleting the service.";

        }
    }
}


/* ============================================================
   GET SERVICE FOR EDIT
   ============================================================ */

$edit_service = null;

if (isset($_GET['edit'])) {

    $edit_id = (int) $_GET['edit'];

    if ($edit_id > 0) {

        $stmt = $pdo->prepare("
            SELECT *
            FROM services
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->bindValue(':id', $edit_id, PDO::PARAM_INT);

        $stmt->execute();

        $edit_service = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


/* ============================================================
   GET ALL SERVICES
   ============================================================ */

$services = $pdo->query("
    SELECT *
    FROM services
    ORDER BY sort_order ASC, id ASC
")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Services - Kelly Admin</title>

    <link
        rel="stylesheet"
        href="assets/css/admin.css?v=5"
    >

</head>


<body>


<div class="admin-wrapper">


    <?php require_once 'includes/sidebar.php';?>


    <!-- MAIN CONTENT -->

    <main class="main-content">

        <div class="services-page">


            <!-- HEADER -->

            <div class="services-header">

                <div>

                    <h1>
                        Services
                    </h1>

                    <p>
                        Manage the services displayed on your portfolio.
                    </p>

                </div>

            </div>


            <!-- ALERTS -->

            <?php if ($message): ?>

                <div class="services-alert services-success">

                    <?= htmlspecialchars($message) ?>

                </div>

            <?php endif; ?>


            <?php if ($error): ?>

                <div class="services-alert services-error">

                    <?= htmlspecialchars($error) ?>

                </div>

            <?php endif; ?>


            <!-- ADD / EDIT SERVICE -->

            <div class="services-card">


                <div class="services-card-header">

                    <h2>

                        <?= $edit_service
                            ? 'Edit Service'
                            : 'Add Service'
                        ?>

                    </h2>

                    <p>

                        <?= $edit_service
                            ? 'Update the selected service.'
                            : 'Add a new service to your portfolio.'
                        ?>

                    </p>

                </div>


                <form
                    method="POST"
                    class="services-form"
                >


                    <?php if ($edit_service): ?>

                        <input
                            type="hidden"
                            name="id"
                            value="<?= (int) $edit_service['id'] ?>"
                        >

                    <?php endif; ?>


                    <div class="services-grid">


                        <!-- TITLE -->

                        <div class="services-field">

                            <label for="title">
                                Service Title
                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="<?= htmlspecialchars(
                                    $edit_service['title'] ?? ''
                                ) ?>"
                                placeholder="e.g. Web Development"
                                required
                            >

                        </div>


                        <!-- ICON -->

                        <div class="services-field">

                            <label for="icon">
                                Icon
                            </label>

                            <input
                                type="text"
                                id="icon"
                                name="icon"
                                value="<?= htmlspecialchars(
                                    $edit_service['icon'] ?? ''
                                ) ?>"
                                placeholder="e.g. bi bi-code-slash"
                            >

                            <small class="services-help">
                                Enter the Bootstrap Icons class.
                            </small>

                        </div>


                        <!-- SORT ORDER -->

                        <div class="services-field">

                            <label for="sort_order">
                                Sort Order
                            </label>

                            <input
                                type="number"
                                id="sort_order"
                                name="sort_order"
                                min="0"
                                value="<?= htmlspecialchars(
                                    $edit_service['sort_order'] ?? '0'
                                ) ?>"
                            >

                        </div>


                        <!-- DESCRIPTION -->

                        <div class="services-field services-field-full">

                            <label for="description">
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="Describe this service..."
                            ><?= htmlspecialchars(
                                    $edit_service['description'] ?? ''
                                ) ?></textarea>

                        </div>


                    </div>


                    <div class="services-form-footer">


                        <button
                            type="submit"
                            name="<?= $edit_service
                                ? 'update_service'
                                : 'add_service'
                            ?>"
                            class="services-save-btn"
                        >

                            <?= $edit_service
                                ? 'Update Service'
                                : 'Add Service'
                            ?>

                        </button>


                        <?php if ($edit_service): ?>

                            <a
                                href="services.php"
                                class="services-cancel-btn"
                            >
                                Cancel
                            </a>

                        <?php endif; ?>


                    </div>


                </form>

            </div>


            <!-- SERVICES LIST -->

            <div class="services-list">


                <?php if (empty($services)): ?>

                    <div class="services-card">

                        <p class="services-empty">
                            No services found.
                        </p>

                    </div>

                <?php endif; ?>


                <div class="services-items-grid">


                    <?php foreach ($services as $service): ?>

                        <div class="services-item-card">


                            <div class="services-item-top">


                                <div class="services-icon">

                                    <?php if (!empty($service['icon'])): ?>

                                        <i class="<?= htmlspecialchars(
                                            $service['icon']
                                        ) ?>"></i>

                                    <?php else: ?>

                                        <span>✦</span>

                                    <?php endif; ?>

                                </div>


                                <div class="services-actions">

                                    <a
                                        href="services.php?edit=<?= (int) $service['id'] ?>"
                                        class="services-edit-btn"
                                    >
                                        Edit
                                    </a>

                                    <a
                                        href="services.php?delete=<?= (int) $service['id'] ?>"
                                        class="services-delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this service?');"
                                    >
                                        Delete
                                    </a>

                                </div>


                            </div>


                            <h2>

                                <?= htmlspecialchars(
                                    $service['title'] ?? ''
                                ) ?>

                            </h2>


                            <?php if (!empty($service['description'])): ?>

                                <p>

                                    <?= nl2br(
                                        htmlspecialchars(
                                            $service['description']
                                        )
                                    ) ?>

                                </p>

                            <?php endif; ?>


                            <div class="services-order">

                                Order:
                                <?= (int) $service['sort_order'] ?>

                            </div>


                        </div>

                    <?php endforeach; ?>


                </div>


            </div>


        </div>

    </main>


</div>


</body>

</html>