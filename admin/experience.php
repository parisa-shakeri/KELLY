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
   ADD EXPERIENCE
   ============================================================ */

if (isset($_POST['add_experience'])) {

    $job_title = trim($_POST['job_title'] ?? '');
    $start_year = !empty($_POST['start_year']) ? (int) $_POST['start_year'] : null;
    $end_year = !empty($_POST['end_year']) ? (int) $_POST['end_year'] : null;
    $company = trim($_POST['company'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $sort_order = !empty($_POST['sort_order']) ? (int) $_POST['sort_order'] : 0;

    if ($job_title === '') {

        $error = "Job title is required.";

    } else {

        try {

            $stmt = $pdo->prepare("
                INSERT INTO experience
                (
                    job_title,
                    start_year,
                    end_year,
                    company,
                    location,
                    description,
                    sort_order
                )
                VALUES
                (
                    :job_title,
                    :start_year,
                    :end_year,
                    :company,
                    :location,
                    :description,
                    :sort_order
                )
            ");

            $stmt->bindValue(':job_title', $job_title);

            if ($start_year === null) {
                $stmt->bindValue(':start_year', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':start_year', $start_year, PDO::PARAM_INT);
            }

            if ($end_year === null) {
                $stmt->bindValue(':end_year', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':end_year', $end_year, PDO::PARAM_INT);
            }

            $stmt->bindValue(':company', $company);
            $stmt->bindValue(':location', $location);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':sort_order', $sort_order, PDO::PARAM_INT);

            $stmt->execute();

            $message = "Experience added successfully.";

        } catch (PDOException $e) {

            $error = "Something went wrong while adding the experience.";

        }
    }
}



/* ============================================================
   UPDATE EXPERIENCE
   ============================================================ */

if (isset($_POST['update_experience'])) {

    $id = (int) ($_POST['id'] ?? 0);

    $job_title = trim($_POST['job_title'] ?? '');
    $start_year = !empty($_POST['start_year']) ? (int) $_POST['start_year'] : null;
    $end_year = !empty($_POST['end_year']) ? (int) $_POST['end_year'] : null;
    $company = trim($_POST['company'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $sort_order = !empty($_POST['sort_order']) ? (int) $_POST['sort_order'] : 0;

    if ($id <= 0 || $job_title === '') {

        $error = "Job title is required.";

    } else {

        try {

            $stmt = $pdo->prepare("
                UPDATE experience
                SET
                    job_title = :job_title,
                    start_year = :start_year,
                    end_year = :end_year,
                    company = :company,
                    location = :location,
                    description = :description,
                    sort_order = :sort_order
                WHERE id = :id
            ");

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':job_title', $job_title);

            if ($start_year === null) {
                $stmt->bindValue(':start_year', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':start_year', $start_year, PDO::PARAM_INT);
            }

            if ($end_year === null) {
                $stmt->bindValue(':end_year', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':end_year', $end_year, PDO::PARAM_INT);
            }

            $stmt->bindValue(':company', $company);
            $stmt->bindValue(':location', $location);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':sort_order', $sort_order, PDO::PARAM_INT);

            $stmt->execute();

            $message = "Experience updated successfully.";

        } catch (PDOException $e) {

            $error = "Something went wrong while updating the experience.";

        }
    }
}



/* ============================================================
   ADD EXPERIENCE ITEM
   ============================================================ */

if (isset($_POST['add_experience_item'])) {

    $experience_id = (int) ($_POST['experience_id'] ?? 0);
    $item_description = trim($_POST['item_description'] ?? '');
    $item_sort_order = !empty($_POST['item_sort_order'])
            ? (int) $_POST['item_sort_order']
            : 0;

    if ($experience_id <= 0 || $item_description === '') {

        $error = "Item description is required.";

    } else {

        try {

            $stmt = $pdo->prepare("
                INSERT INTO experience_items
                (
                    experience_id,
                    description,
                    sort_order
                )
                VALUES
                (
                    :experience_id,
                    :description,
                    :sort_order
                )
            ");

            $stmt->bindValue(
                    ':experience_id',
                    $experience_id,
                    PDO::PARAM_INT
            );

            $stmt->bindValue(
                    ':description',
                    $item_description
            );

            $stmt->bindValue(
                    ':sort_order',
                    $item_sort_order,
                    PDO::PARAM_INT
            );

            $stmt->execute();

            $message = "Experience item added successfully.";

        } catch (PDOException $e) {

            $error = "Something went wrong while adding the item.";

        }
    }
}



/* ============================================================
   DELETE EXPERIENCE ITEM
   ============================================================ */

if (isset($_GET['delete_item'])) {

    $item_id = (int) $_GET['delete_item'];

    try {

        $stmt = $pdo->prepare("
            DELETE FROM experience_items
            WHERE id = :id
        ");

        $stmt->bindValue(
                ':id',
                $item_id,
                PDO::PARAM_INT
        );

        $stmt->execute();

        $message = "Experience item deleted successfully.";

    } catch (PDOException $e) {

        $error = "Something went wrong while deleting the item.";

    }
}



/* ============================================================
   DELETE EXPERIENCE
   ============================================================ */

if (isset($_GET['delete'])) {

    $id = (int) $_GET['delete'];

    try {

        $pdo->beginTransaction();


        /* Delete related items first */

        $stmt = $pdo->prepare("
            DELETE FROM experience_items
            WHERE experience_id = :experience_id
        ");

        $stmt->bindValue(
                ':experience_id',
                $id,
                PDO::PARAM_INT
        );

        $stmt->execute();


        /* Delete experience */

        $stmt = $pdo->prepare("
            DELETE FROM experience
            WHERE id = :id
        ");

        $stmt->bindValue(
                ':id',
                $id,
                PDO::PARAM_INT
        );

        $stmt->execute();


        $pdo->commit();

        $message = "Experience deleted successfully.";

    } catch (PDOException $e) {

        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        $error = "Something went wrong while deleting the experience.";

    }
}



/* ============================================================
   GET EXPERIENCE FOR EDIT
   ============================================================ */

$edit_experience = null;

if (isset($_GET['edit'])) {

    $edit_id = (int) $_GET['edit'];

    $stmt = $pdo->prepare("
        SELECT *
        FROM experience
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->bindValue(
            ':id',
            $edit_id,
            PDO::PARAM_INT
    );

    $stmt->execute();

    $edit_experience = $stmt->fetch(PDO::FETCH_ASSOC);
}



/* ============================================================
   GET EXPERIENCES
   ============================================================ */

$experiences = $pdo->query("
    SELECT *
    FROM experience
    ORDER BY sort_order ASC, id ASC
")->fetchAll(PDO::FETCH_ASSOC);



/* ============================================================
   GET EXPERIENCE ITEMS
   ============================================================ */

$items = $pdo->query("
    SELECT *
    FROM experience_items
    ORDER BY sort_order ASC, id ASC
")->fetchAll(PDO::FETCH_ASSOC);



/* ============================================================
   GROUP ITEMS BY EXPERIENCE
   ============================================================ */

$experience_items = [];

foreach ($items as $item) {

    $experience_items[$item['experience_id']][] = $item;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
    >

    <title>Experience - Kelly Admin</title>

    <link
            rel="stylesheet"
            href="assets/css/admin.css?v=3"
    >

</head>


<body>


<div class="admin-wrapper">


<!--    sidebar     -->
    <?php require_once 'includes/sidebar.php'; ?>



    <!-- ========================================================
         MAIN CONTENT
         ======================================================== -->

    <main class="main-content">


        <div class="experience-page">


            <!-- ====================================================
                 HEADER
                 ==================================================== -->

            <div class="experience-header">

                <div>

                    <h1>
                        Experience
                    </h1>

                    <p>
                        Manage your professional experience and achievements.
                    </p>

                </div>

            </div>



            <!-- ====================================================
                 ALERTS
                 ==================================================== -->

            <?php if ($message): ?>

                <div class="experience-alert experience-success">
                    <?= htmlspecialchars($message) ?>
                </div>

            <?php endif; ?>


            <?php if ($error): ?>

                <div class="experience-alert experience-error">
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>



            <!-- ====================================================
                 ADD / EDIT EXPERIENCE
                 ==================================================== -->

            <div class="experience-card">

                <div class="experience-card-header">

                    <h2>

                        <?= $edit_experience
                                ? 'Edit Experience'
                                : 'Add Experience'
                        ?>

                    </h2>

                    <p>

                        <?= $edit_experience
                                ? 'Update your professional experience.'
                                : 'Add a new professional experience.'
                        ?>

                    </p>

                </div>


                <form
                        method="POST"
                        class="experience-form"
                >


                    <?php if ($edit_experience): ?>

                        <input
                                type="hidden"
                                name="id"
                                value="<?= (int) $edit_experience['id'] ?>"
                        >

                    <?php endif; ?>


                    <div class="experience-grid">


                        <!-- JOB TITLE -->

                        <div class="experience-field">

                            <label for="job_title">
                                Job Title
                            </label>

                            <input
                                    type="text"
                                    id="job_title"
                                    name="job_title"
                                    value="<?= htmlspecialchars($edit_experience['job_title'] ?? '') ?>"
                                    required
                            >

                        </div>



                        <!-- COMPANY -->

                        <div class="experience-field">

                            <label for="company">
                                Company
                            </label>

                            <input
                                    type="text"
                                    id="company"
                                    name="company"
                                    value="<?= htmlspecialchars($edit_experience['company'] ?? '') ?>"
                            >

                        </div>



                        <!-- START YEAR -->

                        <div class="experience-field">

                            <label for="start_year">
                                Start Year
                            </label>

                            <input
                                    type="number"
                                    id="start_year"
                                    name="start_year"
                                    min="1900"
                                    max="2100"
                                    value="<?= htmlspecialchars($edit_experience['start_year'] ?? '') ?>"
                            >

                        </div>



                        <!-- END YEAR -->

                        <div class="experience-field">

                            <label for="end_year">
                                End Year
                            </label>

                            <input
                                    type="number"
                                    id="end_year"
                                    name="end_year"
                                    min="1900"
                                    max="2100"
                                    placeholder="Leave empty if current"
                                    value="<?= htmlspecialchars($edit_experience['end_year'] ?? '') ?>"
                            >

                        </div>



                        <!-- LOCATION -->

                        <div class="experience-field">

                            <label for="location">
                                Location
                            </label>

                            <input
                                    type="text"
                                    id="location"
                                    name="location"
                                    value="<?= htmlspecialchars($edit_experience['location'] ?? '') ?>"
                            >

                        </div>



                        <!-- SORT ORDER -->

                        <div class="experience-field">

                            <label for="sort_order">
                                Sort Order
                            </label>

                            <input
                                    type="number"
                                    id="sort_order"
                                    name="sort_order"
                                    min="0"
                                    value="<?= htmlspecialchars($edit_experience['sort_order'] ?? '0') ?>"
                            >

                        </div>



                        <!-- DESCRIPTION -->

                        <div class="experience-field experience-field-full">

                            <label for="description">
                                Description
                            </label>

                            <textarea
                                    id="description"
                                    name="description"
                                    rows="4"
                            ><?= htmlspecialchars($edit_experience['description'] ?? '') ?></textarea>

                        </div>


                    </div>



                    <!-- SAVE BUTTON -->

                    <div class="experience-form-footer">

                        <button
                                type="submit"
                                name="<?= $edit_experience
                                        ? 'update_experience'
                                        : 'add_experience'
                                ?>"
                                class="experience-save-btn"
                        >

                            <?= $edit_experience
                                    ? 'Update Experience'
                                    : 'Add Experience'
                            ?>

                        </button>


                        <?php if ($edit_experience): ?>

                            <a
                                    href="experience.php"
                                    class="experience-cancel-btn"
                            >
                                Cancel
                            </a>

                        <?php endif; ?>

                    </div>


                </form>

            </div>



            <!-- ====================================================
                 EXISTING EXPERIENCES
                 ==================================================== -->

            <div class="experience-list">


                <?php if (empty($experiences)): ?>

                    <div class="experience-card">

                        <p>
                            No experience records found.
                        </p>

                    </div>

                <?php endif; ?>



                <?php foreach ($experiences as $experience): ?>


                    <div class="experience-card experience-item-card">


                        <!-- EXPERIENCE HEADER -->

                        <div class="experience-item-header">


                            <div>

                                <h2>
                                    <?= htmlspecialchars(
                                            $experience['job_title'] ?? ''
                                    ) ?>
                                </h2>


                                <p class="experience-company">

                                    <?= htmlspecialchars(
                                            $experience['company'] ?? ''
                                    ) ?>


                                    <?php if (!empty($experience['location'])): ?>

                                        ·

                                        <?= htmlspecialchars(
                                                $experience['location']
                                        ) ?>

                                    <?php endif; ?>

                                </p>

                            </div>



                            <!-- ACTIONS -->

                            <div class="experience-actions">

                                <a
                                        href="experience.php?edit=<?= (int) $experience['id'] ?>"
                                        class="experience-edit-btn"
                                >
                                    Edit
                                </a>


                                <a
                                        href="experience.php?delete=<?= (int) $experience['id'] ?>"
                                        class="experience-delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this experience?');"
                                >
                                    Delete
                                </a>

                            </div>


                        </div>



                        <!-- DATE -->

                        <div class="experience-meta">

                            <?php if (!empty($experience['start_year'])): ?>

                                <span>
                                    <?= htmlspecialchars(
                                            $experience['start_year']
                                    ) ?>
                                </span>

                            <?php endif; ?>


                            <span>
                                -
                            </span>


                            <span>

                                <?php if (!empty($experience['end_year'])): ?>

                                    <?= htmlspecialchars(
                                            $experience['end_year']
                                    ) ?>

                                <?php else: ?>

                                    Present

                                <?php endif; ?>

                            </span>

                        </div>



                        <!-- DESCRIPTION -->

                        <?php if (!empty($experience['description'])): ?>

                            <p class="experience-description">

                                <?= nl2br(
                                        htmlspecialchars(
                                                $experience['description']
                                        )
                                ) ?>

                            </p>

                        <?php endif; ?>



                        <!-- ====================================================
                             EXPERIENCE ITEMS
                             ==================================================== -->

                        <div class="experience-items">


                            <h3>
                                Responsibilities & Achievements
                            </h3>


                            <?php if (!empty($experience_items[$experience['id']])): ?>

                                <ul>

                                    <?php foreach (
                                            $experience_items[$experience['id']]
                                            as $item
                                    ): ?>

                                        <li>

                                            <span>
                                                <?= htmlspecialchars(
                                                        $item['description'] ?? ''
                                                ) ?>
                                            </span>


                                            <a
                                                    href="experience.php?delete_item=<?= (int) $item['id'] ?>"
                                                    class="experience-item-delete"
                                                    onclick="return confirm('Delete this item?');"
                                            >
                                                Delete
                                            </a>

                                        </li>

                                    <?php endforeach; ?>

                                </ul>

                            <?php else: ?>

                                <p class="experience-no-items">
                                    No responsibilities or achievements added yet.
                                </p>

                            <?php endif; ?>



                            <!-- ADD ITEM -->

                            <form
                                    method="POST"
                                    class="experience-item-form"
                            >

                                <input
                                        type="hidden"
                                        name="experience_id"
                                        value="<?= (int) $experience['id'] ?>"
                                >


                                <input
                                        type="text"
                                        name="item_description"
                                        placeholder="Add a responsibility or achievement..."
                                        required
                                >


                                <input
                                        type="number"
                                        name="item_sort_order"
                                        value="0"
                                        min="0"
                                        title="Sort order"
                                >


                                <button
                                        type="submit"
                                        name="add_experience_item"
                                >
                                    Add Item
                                </button>

                            </form>


                        </div>


                    </div>


                <?php endforeach; ?>


            </div>


        </div>

    </main>


</div>


</body>

</html>