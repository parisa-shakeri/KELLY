<?php

session_start();

require_once "includes/db.php";
$error = "";

// Login
if (isset($_POST['login'])) {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {

        $error = "Please enter your username and password.";

    } elseif (strlen($username) < 3 || strlen($username) > 30) {

        $error = "Invalid username.";

    } else {

        $stmt = $pdo->prepare("
            SELECT *
            FROM admins
            WHERE username = :username
            LIMIT 1
        ");

        $stmt->execute([
                'username' => $username
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {

            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];

            header("Location: index.php");
            exit;

        } else {

            $error = "Username or password is incorrect.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Kelly</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600&display=swap"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css"
          rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            font-family: "Poppins", sans-serif;

            background:
                    linear-gradient(
                            rgba(255, 255, 255, 0.88),
                            rgba(255, 255, 255, 0.88)
                    ),
                    url("../assets/img/hero-bg.jpg");

            background-size: cover;
            background-position: center;

            color: #333;
        }

        .login-wrapper {
            width: 100%;
            max-width: 430px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.96);

            padding: 45px 40px;

            border-radius: 16px;

            box-shadow:
                    0 20px 60px rgba(0, 0, 0, 0.12);

            text-align: center;
        }

        .login-icon {
            width: 62px;
            height: 62px;

            margin: 0 auto 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #f3f3f3;

            color: #333;

            font-size: 25px;
        }

        .login-card h1 {
            margin-bottom: 8px;

            font-family: "Playfair Display", serif;

            font-size: 32px;
            font-weight: 500;

            color: #222;
        }

        .login-subtitle {
            margin-bottom: 30px;

            color: #888;

            font-size: 14px;
        }

        .login-error {
            margin-bottom: 20px;

            padding: 11px 14px;

            border-radius: 7px;

            background: #fff1f1;

            border: 1px solid #f1cccc;

            color: #b33a3a;

            font-size: 13px;
        }

        .login-field {
            text-align: left;

            margin-bottom: 18px;
        }

        .login-field label {
            display: block;

            margin-bottom: 7px;

            color: #444;

            font-size: 13px;
            font-weight: 500;
        }

        .login-input {
            position: relative;
        }

        .login-input i {
            position: absolute;

            left: 14px;
            top: 50%;

            transform: translateY(-50%);

            color: #999;

            font-size: 16px;
        }

        .login-input input {
            width: 100%;

            padding: 12px 14px 12px 42px;

            border: 1px solid #ddd;

            border-radius: 8px;

            outline: none;

            background: #fff;

            color: #333;

            font-family: inherit;

            font-size: 14px;

            transition: 0.2s;
        }

        .login-input input:focus {
            border-color: #999;

            box-shadow:
                    0 0 0 3px rgba(0, 0, 0, 0.04);
        }

        .login-button {
            width: 100%;

            margin-top: 8px;

            padding: 13px;

            border: none;

            border-radius: 8px;

            background: #222;

            color: #fff;

            font-family: inherit;

            font-size: 14px;
            font-weight: 500;

            cursor: pointer;

            transition: 0.25s;
        }

        .login-button:hover {
            background: #444;

            transform: translateY(-1px);
        }

        .back-to-site {
            display: inline-flex;

            align-items: center;
            gap: 6px;

            margin-top: 25px;

            color: #777;

            text-decoration: none;

            font-size: 13px;

            transition: 0.2s;
        }

        .back-to-site:hover {
            color: #222;
        }

        .login-footer {
            margin-top: 25px;

            padding-top: 18px;

            border-top: 1px solid #eee;

            color: #aaa;

            font-size: 11px;
        }

        @media (max-width: 480px) {

            .login-card {
                padding: 35px 25px;
            }

            .login-card h1 {
                font-size: 28px;
            }

        }

    </style>

</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <div class="login-icon">
            <i class="bi bi-person-lock"></i>
        </div>

        <h1>Admin Login</h1>

        <p class="login-subtitle">
            Sign in to manage your portfolio
        </p>

        <?php if ($error): ?>

            <div class="login-error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>

        <form method="post">

            <div class="login-field">

                <label for="username">
                    Username
                </label>

                <div class="login-input">

                    <i class="bi bi-person"></i>

                    <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Enter your username"
                            autocomplete="username"
                            required
                    >

                </div>

            </div>


            <div class="login-field">

                <label for="password">
                    Password
                </label>

                <div class="login-input">

                    <i class="bi bi-lock"></i>

                    <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                    >

                </div>

            </div>


            <button
                    type="submit"
                    name="login"
                    class="login-button"
            >
                Sign In
            </button>

        </form>


        <a href="../index.php" class="back-to-site">

            <i class="bi bi-arrow-left"></i>

            Back to website

        </a>


        <div class="login-footer">
            Kelly Portfolio · Admin Panel
        </div>