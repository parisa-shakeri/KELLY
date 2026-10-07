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
   UPDATE CONTACT INFO
   ============================================================ */

if (isset($_POST['update_contact'])) {

    $id = (int)($_POST['id'] ?? 0);

    $address = trim($_POST['address'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $map_url = trim($_POST['map_url'] ?? '');


    if ($id <= 0) {

        $error = "Invalid contact information.";

    } else {

        try {

            $stmt = $pdo->prepare("
                UPDATE contact_info
                SET
                    address = :address,
                    phone = :phone,
                    email = :email,
                    map_url = :map_url
                WHERE id = :id
            ");

            $stmt->bindValue(
                    ':id',
                    $id,
                    PDO::PARAM_INT
            );

            $stmt->bindValue(
                    ':address',
                    $address
            );

            $stmt->bindValue(
                    ':phone',
                    $phone
            );

            $stmt->bindValue(
                    ':email',
                    $email
            );

            $stmt->bindValue(
                    ':map_url',
                    $map_url
            );

            $stmt->execute();

            $message = "Contact information updated successfully.";

        } catch (PDOException $e) {

            $error = "Something went wrong while updating contact information.";

        }
    }
}


/* ============================================================
   GET CONTACT INFO
   ============================================================ */

$stmt = $pdo->query("
    SELECT *
    FROM contact_info
    ORDER BY id ASC
    LIMIT 1
");

$contact = $stmt->fetch(PDO::FETCH_ASSOC);


/* ============================================================
   CREATE RECORD IF EMPTY
   ============================================================ */

if (!$contact) {

    try {

        $stmt = $pdo->prepare("
            INSERT INTO contact_info
            (
                address,
                phone,
                email,
                map_url
            )
            VALUES
            (
                NULL,
                NULL,
                NULL,
                NULL
            )
        ");

        $stmt->execute();

        $contact_id = $pdo->lastInsertId();

        $stmt = $pdo->prepare("
            SELECT *
            FROM contact_info
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->bindValue(
                ':id',
                $contact_id,
                PDO::PARAM_INT
        );

        $stmt->execute();

        $contact = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        $error = "Unable to create contact information.";

    }
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

    <title>Contact Info - Kelly Admin</title>

    <link
            rel="stylesheet"
            href="assets/css/admin.css?v=6"
    >

</head>


<body>


<div class="admin-wrapper">


    <!-- SIDEBAR -->
    <?php require_once 'includes/sidebar.php'; ?>



    <!-- MAIN CONTENT -->

    <main class="main-content">

        <div class="contact-page">


            <!-- HEADER -->

            <div class="contact-header">

                <h1>
                    Contact Info
                </h1>

                <p>
                    Manage the contact information displayed on your portfolio.
                </p>

            </div>


            <!-- ALERTS -->

            <?php if ($message): ?>

                <div class="contact-alert contact-success">

                    <?= htmlspecialchars($message) ?>

                </div>

            <?php endif; ?>


            <?php if ($error): ?>

                <div class="contact-alert contact-error">

                    <?= htmlspecialchars($error) ?>

                </div>

            <?php endif; ?>


            <!-- CONTACT FORM -->

            <?php if ($contact): ?>

                <div class="contact-card">


                    <div class="contact-card-header">

                        <h2>
                            Contact Information
                        </h2>

                        <p>
                            Update your public contact details.
                        </p>

                    </div>


                    <form
                            method="POST"
                            class="contact-form"
                    >


                        <input
                                type="hidden"
                                name="id"
                                value="<?= (int)$contact['id'] ?>"
                        >


                        <div class="contact-grid">


                            <!-- ADDRESS -->

                            <div class="contact-field contact-field-full">

                                <label for="address">
                                    Address
                                </label>

                                <input
                                        type="text"
                                        id="address"
                                        name="address"
                                        value="<?= htmlspecialchars(
                                                $contact['address'] ?? ''
                                        ) ?>"
                                        placeholder="Enter your address"
                                >

                            </div>


                            <!-- PHONE -->

                            <div class="contact-field">

                                <label for="phone">
                                    Phone
                                </label>

                                <input
                                        type="text"
                                        id="phone"
                                        name="phone"
                                        value="<?= htmlspecialchars(
                                                $contact['phone'] ?? ''
                                        ) ?>"
                                        placeholder="Enter phone number"
                                >

                            </div>


                            <!-- EMAIL -->

                            <div class="contact-field">

                                <label for="email">
                                    Email
                                </label>

                                <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        value="<?= htmlspecialchars(
                                                $contact['email'] ?? ''
                                        ) ?>"
                                        placeholder="Enter email address"
                                >

                            </div>


                            <!-- MAP URL -->

                            <div class="contact-field contact-field-full">

                                <label for="map_url">
                                    Google Maps URL
                                </label>

                                <textarea
                                        id="map_url"
                                        name="map_url"
                                        rows="4"
                                        placeholder="Paste Google Maps embed URL here..."
                                ><?= htmlspecialchars(
                                            $contact['map_url'] ?? ''
                                    ) ?></textarea>

                                <small class="contact-help">
                                    Enter the Google Maps URL or embed URL used on the contact page.
                                </small>

                            </div>


                        </div>


                        <div class="contact-form-footer">

                            <button
                                    type="submit"
                                    name="update_contact"
                                    class="contact-save-btn"
                            >
                                Save Changes
                            </button>

                        </div>


                    </form>


                </div>

            <?php endif; ?>


        </div>

    </main>


</div>


</body>

</html>