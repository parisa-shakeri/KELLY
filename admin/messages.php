<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'includes/db.php';


// Delete message
if (isset($_GET['delete'])) {

    $id = (int) $_GET['delete'];

    $stmt = $pdo->prepare("
        DELETE FROM contact_messages
        WHERE id = ?
    ");

    $stmt->execute([$id]);

    header("Location: messages.php");
    exit;
}


// Get messages
$stmt = $pdo->query("
    SELECT id, name, email, subject, message, is_read, created_at
    FROM contact_messages
    ORDER BY created_at DESC
");

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/admin.css?v=10">

    <title>Messages | Kelly Admin</title>

</head>

<body>

<div class="admin-wrapper">



<!--    sidebar     -->
    <?php require_once 'includes/sidebar.php'; ?>

    <!-- MAIN CONTENT -->

    <main class="main-content messages-page">


        <!-- HEADER -->

        <div class="messages-header">

            <h1>Messages</h1>

            <p>Messages received from the contact form.</p>

        </div>


        <?php if (count($messages) > 0): ?>


            <!-- MESSAGES CARD -->

            <div class="messages-card">

                <div class="messages-card-header">

                    <h2>Received Messages</h2>

                    <p>
                        <?= count($messages) ?>
                        <?= count($messages) === 1 ? 'message' : 'messages' ?>
                    </p>

                </div>


                <div class="messages-table-wrapper">

                    <table class="messages-table">

                        <thead>

                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>

                        </thead>


                        <tbody>

                        <?php foreach ($messages as $message): ?>

                            <tr>

                                <td class="messages-name">
                                    <?= htmlspecialchars($message['name']) ?>
                                </td>


                                <td class="messages-email">
                                    <?= htmlspecialchars($message['email']) ?>
                                </td>


                                <td class="messages-subject">
                                    <?= htmlspecialchars($message['subject']) ?>
                                </td>


                                <td class="messages-text">
                                    <?= htmlspecialchars($message['message']) ?>
                                </td>


                                <td>

                                    <?php if ($message['is_read']): ?>

                                        <span class="messages-status messages-status-read">
                                            Read
                                        </span>

                                    <?php else: ?>

                                        <span class="messages-status messages-status-unread">
                                            Unread
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <td class="messages-date">
                                    <?= htmlspecialchars($message['created_at']) ?>
                                </td>


                                <td>

                                    <a
                                            href="messages.php?delete=<?= (int)$message['id'] ?>"
                                            class="messages-delete-btn"
                                            onclick="return confirm('Are you sure you want to delete this message?')"
                                    >
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>


        <?php else: ?>


            <!-- EMPTY STATE -->

            <div class="messages-card messages-empty">

                <div class="messages-empty-icon">
                    ✉
                </div>

                <h2>No Messages Yet</h2>

                <p>
                    Messages submitted through the contact form will appear here.
                </p>

            </div>


        <?php endif; ?>


    </main>

</div>

</body>

</html>