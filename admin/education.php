<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once "includes/db.php";

$message = "";
$error = "";


/* =========================
   ADD EDUCATION
   ========================= */

if (isset($_POST['add_education'])) {

    $degree = trim($_POST['degree']);
    $start_year = trim($_POST['start_year']);
    $end_year = trim($_POST['end_year']);
    $institution = trim($_POST['institution']);
    $description = trim($_POST['description']);
    $sort_order = (int) $_POST['sort_order'];

    if ($degree === "" || $start_year === "" || $institution === "") {

        $error = "Please fill in all required fields.";

    } else {

        $stmt = $pdo->prepare("
            INSERT INTO education
            (degree, start_year, end_year, institution, description, sort_order)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $degree,
            $start_year,
            $end_year !== "" ? $end_year : null,
            $institution,
            $description,
            $sort_order
        ]);

        header("Location: education.php?success=added");
        exit;
    }
}


/* =========================
   DELETE EDUCATION
   ========================= */

if (isset($_GET['delete'])) {

    $id = (int) $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM education WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: education.php?success=deleted");
    exit;
}


/* =========================
   EDIT EDUCATION
   ========================= */

$editEducation = null;

if (isset($_GET['edit'])) {

    $id = (int) $_GET['edit'];

    $stmt = $pdo->prepare("
        SELECT *
        FROM education
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    $editEducation = $stmt->fetch(PDO::FETCH_ASSOC);
}


/* =========================
   UPDATE EDUCATION
   ========================= */

if (isset($_POST['update_education'])) {

    $id = (int) $_POST['id'];

    $degree = trim($_POST['degree']);
    $start_year = trim($_POST['start_year']);
    $end_year = trim($_POST['end_year']);
    $institution = trim($_POST['institution']);
    $description = trim($_POST['description']);
    $sort_order = (int) $_POST['sort_order'];

    if ($degree === "" || $start_year === "" || $institution === "") {

        $error = "Please fill in all required fields.";

    } else {

        $stmt = $pdo->prepare("
            UPDATE education
            SET
                degree = ?,
                start_year = ?,
                end_year = ?,
                institution = ?,
                description = ?,
                sort_order = ?
            WHERE id = ?
        ");

        $stmt->execute([
            $degree,
            $start_year,
            $end_year !== "" ? $end_year : null,
            $institution,
            $description,
            $sort_order,
            $id
        ]);

        header("Location: education.php?success=updated");
        exit;
    }
}


/* =========================
   SUCCESS MESSAGE
   ========================= */

if (isset($_GET['success'])) {

    switch ($_GET['success']) {

        case "added":
            $message = "Education added successfully.";
            break;

        case "updated":
            $message = "Education updated successfully.";
            break;

        case "deleted":
            $message = "Education deleted successfully.";
            break;
    }
}


/* =========================
   GET EDUCATION
   ========================= */

$stmt = $pdo->query("
    SELECT *
    FROM education
    ORDER BY sort_order ASC, start_year DESC
");

$educations = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Education | Kelly Admin</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="assets/css/admin.css"
    >

</head>

<body>

<div class="admin-wrapper">


<!--    side bar    -->

    <?php require_once 'includes/sidebar.php'; ?>

    <!-- =========================
         MAIN CONTENT
         ========================= -->

    <main class="main-content">


        <div class="admin-header">

            <div>

                <h1>Education</h1>

                <p>
                    Manage your educational background.
                </p>

            </div>

        </div>


        <!-- =========================
             ALERTS
             ========================= -->

        <?php if ($message): ?>

            <div class="alert alert-success">
                <?= htmlspecialchars($message) ?>
            </div>

        <?php endif; ?>


        <?php if ($error): ?>

            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <!-- =========================
             FORM
             ========================= -->

        <div class="admin-card">

            <h2>

                <?= $editEducation
                    ? "Edit Education"
                    : "Add Education"
                ?>

            </h2>


            <form method="POST">


                <?php if ($editEducation): ?>

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $editEducation['id'] ?>"
                    >

                <?php endif; ?>


                <div class="row">


                    <!-- DEGREE -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Degree *
                        </label>

                        <input
                            type="text"
                            name="degree"
                            class="form-control"
                            required
                            value="<?= htmlspecialchars(
                                $editEducation['degree'] ?? ''
                            ) ?>"
                            placeholder="e.g. Bachelor of Computer Engineering"
                        >

                    </div>


                    <!-- INSTITUTION -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Institution *
                        </label>

                        <input
                            type="text"
                            name="institution"
                            class="form-control"
                            required
                            value="<?= htmlspecialchars(
                                $editEducation['institution'] ?? ''
                            ) ?>"
                            placeholder="e.g. University Name"
                        >

                    </div>


                    <!-- START YEAR -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Start Year *
                        </label>

                        <input
                            type="number"
                            name="start_year"
                            class="form-control"
                            required
                            min="1900"
                            max="2100"
                            value="<?= htmlspecialchars(
                                $editEducation['start_year'] ?? ''
                            ) ?>"
                        >

                    </div>


                    <!-- END YEAR -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            End Year
                        </label>

                        <input
                            type="number"
                            name="end_year"
                            class="form-control"
                            min="1900"
                            max="2100"
                            value="<?= htmlspecialchars(
                                $editEducation['end_year'] ?? ''
                            ) ?>"
                            placeholder="Leave empty if ongoing"
                        >

                    </div>


                    <!-- SORT ORDER -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            class="form-control"
                            min="0"
                            value="<?= htmlspecialchars(
                                $editEducation['sort_order'] ?? 0
                            ) ?>"
                        >

                        <small class="text-muted">
                            Lower numbers appear first.
                        </small>

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="5"
                            placeholder="Education description..."
                        ><?= htmlspecialchars(
                                $editEducation['description'] ?? ''
                            ) ?></textarea>

                    </div>

                </div>


                <!-- BUTTONS -->

                <?php if ($editEducation): ?>

                    <button
                        type="submit"
                        name="update_education"
                        class="btn btn-dark"
                    >
                        Update Education
                    </button>

                    <a
                        href="education.php"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                <?php else: ?>

                    <button
                        type="submit"
                        name="add_education"
                        class="btn btn-dark"
                    >
                        Add Education
                    </button>

                <?php endif; ?>


            </form>

        </div>


        <!-- =========================
             EDUCATION TABLE
             ========================= -->

        <div class="admin-card mt-4">


            <div class="d-flex justify-content-between align-items-center mb-4">

                <h2 class="mb-0">
                    Education History
                </h2>

                <span class="badge bg-dark">
                    <?= count($educations) ?> Records
                </span>

            </div>


            <div class="table-responsive">

                <table class="table align-middle">


                    <thead>

                    <tr>

                        <th>Order</th>

                        <th>Degree</th>

                        <th>Institution</th>

                        <th>Period</th>

                        <th>Description</th>

                        <th>Actions</th>

                    </tr>

                    </thead>


                    <tbody>


                    <?php if (empty($educations)): ?>

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-4"
                            >
                                No education records found.
                            </td>

                        </tr>

                    <?php else: ?>


                        <?php foreach ($educations as $education): ?>

                            <tr>


                                <td>

                                    <?= (int) $education['sort_order'] ?>

                                </td>


                                <td>

                                    <strong>
                                        <?= htmlspecialchars(
                                            $education['degree']
                                        ) ?>
                                    </strong>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $education['institution']
                                    ) ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $education['start_year']
                                    ) ?>

                                    -

                                    <?= $education['end_year']
                                        ? htmlspecialchars(
                                            $education['end_year']
                                        )
                                        : "Present"
                                    ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        mb_strimwidth(
                                            $education['description'] ?? '',
                                            0,
                                            80,
                                            '...'
                                        )
                                    ) ?>

                                </td>


                                <td>

                                    <a
                                        href="education.php?edit=<?= $education['id'] ?>"
                                        class="btn btn-sm btn-outline-dark"
                                    >
                                        Edit
                                    </a>


                                    <a
                                        href="education.php?delete=<?= $education['id'] ?>"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this education record?');"
                                    >
                                        Delete
                                    </a>

                                </td>


                            </tr>

                        <?php endforeach; ?>


                    <?php endif; ?>


                    </tbody>

                </table>

            </div>

        </div>


    </main>

</div>

</body>

</html>