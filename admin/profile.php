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
   GET PROFILE
   ============================================================ */

$profile = $pdo->query("
    SELECT *
    FROM profile
    ORDER BY id ASC
    LIMIT 1
")->fetch(PDO::FETCH_ASSOC);


/* ============================================================
   UPDATE PROFILE
   ============================================================ */

if (isset($_POST['update_profile'])) {

    $name = trim($_POST['name'] ?? '');
    $role = trim($_POST['role'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $birth_date = !empty($_POST['birth_date']) ? $_POST['birth_date'] : null;
    $mobile = trim($_POST['mobile'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $age = !empty($_POST['age']) ? (int) $_POST['age'] : null;
    $degree = trim($_POST['degree'] ?? '');
    $website = trim($_POST['website'] ?? '');
    $freelance_status = trim($_POST['freelance_status'] ?? '');


    if (!$profile) {

        $stmt = $pdo->prepare("
            INSERT INTO profile
            (
                name,
                role,
                description,
                birth_date,
                mobile,
                city,
                address,
                email,
                age,
                degree,
                website,
                freelance_status
            )
            VALUES
            (
                :name,
                :role,
                :description,
                :birth_date,
                :mobile,
                :city,
                :address,
                :email,
                :age,
                :degree,
                :website,
                :freelance_status
            )
        ");

    } else {

        $stmt = $pdo->prepare("
            UPDATE profile
            SET
                name = :name,
                role = :role,
                description = :description,
                birth_date = :birth_date,
                mobile = :mobile,
                city = :city,
                address = :address,
                email = :email,
                age = :age,
                degree = :degree,
                website = :website,
                freelance_status = :freelance_status
            WHERE id = :id
        ");

        $stmt->bindValue(':id', $profile['id'], PDO::PARAM_INT);
    }


    try {

        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':role', $role);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':birth_date', $birth_date);
        $stmt->bindValue(':mobile', $mobile);
        $stmt->bindValue(':city', $city);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':email', $email);

        if ($age === null) {
            $stmt->bindValue(':age', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':age', $age, PDO::PARAM_INT);
        }

        $stmt->bindValue(':degree', $degree);
        $stmt->bindValue(':website', $website);
        $stmt->bindValue(':freelance_status', $freelance_status);

        $stmt->execute();

        $message = "Profile updated successfully.";

        $profile = $pdo->query("
            SELECT *
            FROM profile
            ORDER BY id ASC
            LIMIT 1
        ")->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        $error = "Something went wrong while updating the profile.";

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

    <title>Profile - Kelly Admin</title>

    <link
            rel="stylesheet"
            href="assets/css/admin.css"
    >

</head>


<body>


<div class="admin-wrapper">



    <?php require_once 'includes/sidebar.php'; ?>

    <!-- ========================================================
         MAIN CONTENT
         ======================================================== -->

    <main class="main-content">


        <div class="profile-page">


            <!-- HEADER -->

            <div class="profile-header">

                <div>

                    <h1>
                        Profile
                    </h1>

                    <p>
                        Manage your personal and professional information.
                    </p>

                </div>

            </div>


            <!-- SUCCESS -->

            <?php if ($message): ?>

                <div class="profile-alert profile-success">
                    <?= htmlspecialchars($message) ?>
                </div>

            <?php endif; ?>


            <!-- ERROR -->

            <?php if ($error): ?>

                <div class="profile-alert profile-error">
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>


            <!-- PROFILE FORM -->

            <form
                    method="POST"
                    class="profile-form"
            >


                <!-- BASIC INFORMATION -->

                <div class="profile-card">

                    <div class="profile-card-header">

                        <h2>
                            Basic Information
                        </h2>

                        <p>
                            Main information displayed on your portfolio.
                        </p>

                    </div>


                    <div class="profile-grid">


                        <div class="profile-field">

                            <label for="name">
                                Full Name
                            </label>

                            <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="<?= htmlspecialchars($profile['name'] ?? '') ?>"
                            >

                        </div>


                        <div class="profile-field">

                            <label for="role">
                                Professional Role
                            </label>

                            <input
                                    type="text"
                                    id="role"
                                    name="role"
                                    value="<?= htmlspecialchars($profile['role'] ?? '') ?>"
                            >

                        </div>


                        <div class="profile-field profile-field-full">

                            <label for="description">
                                Description
                            </label>

                            <textarea
                                    id="description"
                                    name="description"
                                    rows="5"
                            ><?= htmlspecialchars($profile['description'] ?? '') ?></textarea>

                        </div>


                    </div>

                </div>


                <!-- PERSONAL INFORMATION -->

                <div class="profile-card">

                    <div class="profile-card-header">

                        <h2>
                            Personal Information
                        </h2>

                        <p>
                            Personal details used throughout your website.
                        </p>

                    </div>


                    <div class="profile-grid">


                        <div class="profile-field">

                            <label for="birth_date">
                                Birth Date
                            </label>

                            <input
                                    type="date"
                                    id="birth_date"
                                    name="birth_date"
                                    value="<?= htmlspecialchars($profile['birth_date'] ?? '') ?>"
                            >

                        </div>


                        <div class="profile-field">

                            <label for="age">
                                Age
                            </label>

                            <input
                                    type="number"
                                    id="age"
                                    name="age"
                                    min="1"
                                    max="120"
                                    value="<?= htmlspecialchars($profile['age'] ?? '') ?>"
                            >

                        </div>


                        <div class="profile-field">

                            <label for="mobile">
                                Mobile
                            </label>

                            <input
                                    type="text"
                                    id="mobile"
                                    name="mobile"
                                    value="<?= htmlspecialchars($profile['mobile'] ?? '') ?>"
                            >

                        </div>


                        <div class="profile-field">

                            <label for="email">
                                Email
                            </label>

                            <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="<?= htmlspecialchars($profile['email'] ?? '') ?>"
                            >

                        </div>


                        <div class="profile-field">

                            <label for="city">
                                City
                            </label>

                            <input
                                    type="text"
                                    id="city"
                                    name="city"
                                    value="<?= htmlspecialchars($profile['city'] ?? '') ?>"
                            >

                        </div>


                        <div class="profile-field">

                            <label for="degree">
                                Degree
                            </label>

                            <input
                                    type="text"
                                    id="degree"
                                    name="degree"
                                    value="<?= htmlspecialchars($profile['degree'] ?? '') ?>"
                            >

                        </div>


                        <div class="profile-field profile-field-full">

                            <label for="address">
                                Address
                            </label>

                            <input
                                    type="text"
                                    id="address"
                                    name="address"
                                    value="<?= htmlspecialchars($profile['address'] ?? '') ?>"
                            >

                        </div>


                    </div>

                </div>


                <!-- PROFESSIONAL INFORMATION -->

                <div class="profile-card">

                    <div class="profile-card-header">

                        <h2>
                            Professional Information
                        </h2>

                        <p>
                            Information related to your work and availability.
                        </p>

                    </div>


                    <div class="profile-grid">


                        <div class="profile-field">

                            <label for="website">
                                Website
                            </label>

                            <input
                                    type="text"
                                    id="website"
                                    name="website"
                                    value="<?= htmlspecialchars($profile['website'] ?? '') ?>"
                            >

                        </div>


                        <div class="profile-field">

                            <label for="freelance_status">
                                Freelance Status
                            </label>

                            <select
                                    id="freelance_status"
                                    name="freelance_status"
                            >

                                <option
                                        value=""
                                        <?= empty($profile['freelance_status']) ? 'selected' : '' ?>
                                >
                                    Select status
                                </option>

                                <option
                                        value="Available"
                                        <?= ($profile['freelance_status'] ?? '') === 'Available' ? 'selected' : '' ?>
                                >
                                    Available
                                </option>

                                <option
                                        value="Not Available"
                                        <?= ($profile['freelance_status'] ?? '') === 'Not Available' ? 'selected' : '' ?>
                                >
                                    Not Available
                                </option>

                            </select>

                        </div>


                    </div>

                </div>


                <!-- SAVE -->

                <div class="profile-form-footer">

                    <button
                            type="submit"
                            name="update_profile"
                            class="profile-save-btn"
                    >
                        Save Changes
                    </button>

                </div>


            </form>


        </div>

    </main>

</div>


</body>

</html>