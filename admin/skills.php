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
   ADD SKILL
   ============================================================ */

if (isset($_POST['add_skill'])) {

    $name = trim($_POST['name'] ?? '');
    $percentage = (int) ($_POST['percentage'] ?? 0);
    $sort_order = (int) ($_POST['sort_order'] ?? 0);

    if ($name === '') {

        $error = "Skill name is required.";

    } elseif ($percentage < 0 || $percentage > 100) {

        $error = "Percentage must be between 0 and 100.";

    } else {

        try {

            $stmt = $pdo->prepare("
                INSERT INTO skills
                (
                    name,
                    percentage,
                    sort_order
                )
                VALUES
                (
                    :name,
                    :percentage,
                    :sort_order
                )
            ");

            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':percentage', $percentage, PDO::PARAM_INT);
            $stmt->bindValue(':sort_order', $sort_order, PDO::PARAM_INT);

            $stmt->execute();

            $message = "Skill added successfully.";

        } catch (PDOException $e) {

            $error = "Something went wrong while adding the skill.";

        }
    }
}


/* ============================================================
   UPDATE SKILL
   ============================================================ */

if (isset($_POST['update_skill'])) {

    $id = (int) ($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $percentage = (int) ($_POST['percentage'] ?? 0);
    $sort_order = (int) ($_POST['sort_order'] ?? 0);

    if ($id <= 0 || $name === '') {

        $error = "Skill name is required.";

    } elseif ($percentage < 0 || $percentage > 100) {

        $error = "Percentage must be between 0 and 100.";

    } else {

        try {

            $stmt = $pdo->prepare("
                UPDATE skills
                SET
                    name = :name,
                    percentage = :percentage,
                    sort_order = :sort_order
                WHERE id = :id
            ");

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':percentage', $percentage, PDO::PARAM_INT);
            $stmt->bindValue(':sort_order', $sort_order, PDO::PARAM_INT);

            $stmt->execute();

            $message = "Skill updated successfully.";

        } catch (PDOException $e) {

            $error = "Something went wrong while updating the skill.";

        }
    }
}


/* ============================================================
   DELETE SKILL
   ============================================================ */

if (isset($_GET['delete'])) {

    $id = (int) $_GET['delete'];

    if ($id > 0) {

        try {

            $stmt = $pdo->prepare("
                DELETE FROM skills
                WHERE id = :id
            ");

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            $message = "Skill deleted successfully.";

        } catch (PDOException $e) {

            $error = "Something went wrong while deleting the skill.";

        }
    }
}


/* ============================================================
   GET SKILL FOR EDIT
   ============================================================ */

$edit_skill = null;

if (isset($_GET['edit'])) {

    $edit_id = (int) $_GET['edit'];

    if ($edit_id > 0) {

        $stmt = $pdo->prepare("
            SELECT *
            FROM skills
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->bindValue(':id', $edit_id, PDO::PARAM_INT);

        $stmt->execute();

        $edit_skill = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


/* ============================================================
   GET ALL SKILLS
   ============================================================ */

$skills = $pdo->query("
    SELECT *
    FROM skills
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

    <title>Skills - Kelly Admin</title>

    <link
        rel="stylesheet"
        href="assets/css/admin.css?v=4"
    >

</head>


<body>


<div class="admin-wrapper">


<!--    sidebar      -->
    <?php require_once 'includes/sidebar.php';?>

    <!-- MAIN CONTENT -->

    <main class="main-content">

        <div class="skills-page">


            <!-- HEADER -->

            <div class="skills-header">

                <div>

                    <h1>
                        Skills
                    </h1>

                    <p>
                        Manage your professional skills and proficiency levels.
                    </p>

                </div>

            </div>


            <!-- ALERTS -->

            <?php if ($message): ?>

                <div class="skills-alert skills-success">

                    <?= htmlspecialchars($message) ?>

                </div>

            <?php endif; ?>


            <?php if ($error): ?>

                <div class="skills-alert skills-error">

                    <?= htmlspecialchars($error) ?>

                </div>

            <?php endif; ?>


            <!-- ADD / EDIT SKILL -->

            <div class="skills-card">


                <div class="skills-card-header">

                    <h2>

                        <?= $edit_skill
                            ? 'Edit Skill'
                            : 'Add Skill'
                        ?>

                    </h2>

                    <p>

                        <?= $edit_skill
                            ? 'Update the selected skill.'
                            : 'Add a new skill to your portfolio.'
                        ?>

                    </p>

                </div>


                <form
                    method="POST"
                    class="skills-form"
                >


                    <?php if ($edit_skill): ?>

                        <input
                            type="hidden"
                            name="id"
                            value="<?= (int) $edit_skill['id'] ?>"
                        >

                    <?php endif; ?>


                    <div class="skills-grid">


                        <!-- NAME -->

                        <div class="skills-field">

                            <label for="name">
                                Skill Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="<?= htmlspecialchars(
                                    $edit_skill['name'] ?? ''
                                ) ?>"
                                placeholder="e.g. PHP"
                                required
                            >

                        </div>


                        <!-- PERCENTAGE -->

                        <div class="skills-field">

                            <label for="percentage">
                                Proficiency
                            </label>

                            <input
                                type="number"
                                id="percentage"
                                name="percentage"
                                min="0"
                                max="100"
                                value="<?= htmlspecialchars(
                                    $edit_skill['percentage'] ?? '0'
                                ) ?>"
                                placeholder="e.g. 90"
                                required
                            >

                        </div>


                        <!-- SORT ORDER -->

                        <div class="skills-field">

                            <label for="sort_order">
                                Sort Order
                            </label>

                            <input
                                type="number"
                                id="sort_order"
                                name="sort_order"
                                min="0"
                                value="<?= htmlspecialchars(
                                    $edit_skill['sort_order'] ?? '0'
                                ) ?>"
                            >

                        </div>


                    </div>


                    <div class="skills-form-footer">


                        <button
                            type="submit"
                            name="<?= $edit_skill
                                ? 'update_skill'
                                : 'add_skill'
                            ?>"
                            class="skills-save-btn"
                        >

                            <?= $edit_skill
                                ? 'Update Skill'
                                : 'Add Skill'
                            ?>

                        </button>


                        <?php if ($edit_skill): ?>

                            <a
                                href="skills.php"
                                class="skills-cancel-btn"
                            >
                                Cancel
                            </a>

                        <?php endif; ?>


                    </div>


                </form>

            </div>


            <!-- SKILLS LIST -->

            <div class="skills-list">


                <?php if (empty($skills)): ?>

                    <div class="skills-card">

                        <p class="skills-empty">
                            No skills found.
                        </p>

                    </div>

                <?php endif; ?>


                <?php foreach ($skills as $skill): ?>

                    <div class="skills-card skills-item-card">


                        <div class="skills-item-header">


                            <div>

                                <h2>
                                    <?= htmlspecialchars(
                                        $skill['name'] ?? ''
                                    ) ?>
                                </h2>

                                <span class="skills-percentage">

                                    <?= (int) $skill['percentage'] ?>%

                                </span>

                            </div>


                            <div class="skills-actions">

                                <a
                                    href="skills.php?edit=<?= (int) $skill['id'] ?>"
                                    class="skills-edit-btn"
                                >
                                    Edit
                                </a>

                                <a
                                    href="skills.php?delete=<?= (int) $skill['id'] ?>"
                                    class="skills-delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this skill?');"
                                >
                                    Delete
                                </a>

                            </div>


                        </div>


                        <!-- PROGRESS BAR -->

                        <div class="skills-progress">

                            <div
                                class="skills-progress-bar"
                                style="width: <?= (int) $skill['percentage'] ?>%;"
                            ></div>

                        </div>


                    </div>

                <?php endforeach; ?>


            </div>


        </div>

    </main>


</div>


</body>

</html>