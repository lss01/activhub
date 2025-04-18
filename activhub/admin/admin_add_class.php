<?php
session_start();
require_once '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_name = trim($_POST['class_name']);

    if (!empty($class_name)) {
        $stmt = $conn->prepare("INSERT INTO class (class_name) VALUES (?)");
        $stmt->bind_param("s", $class_name);

        if ($stmt->execute()) {
            echo "<script>alert('Class added successfully'); window.location.href='admin_classList.php';</script>";
        } else {
            echo "<script>alert('Failed to add class');</script>";
        }
    } else {
        echo "<script>alert('Class name cannot be empty');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Class - ActivHub</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
</head>

<body>
    <header>
        <div class="logo-section">
            <img src="../img/logo.png" alt="Logo" />
            <div class="logo-text">
                <span>SRI AL-AMIN ActivHub</span>
                <div class="nav-links">
                    <a href="admin_dashboard.php">Dashboard</a>
                    <a href="admin_list.php">Profile</a>
                </div>
            </div>
        </div>

        <div class="icon-section">
            <div class="admin-section">
                <span class="admin-text"><?= ucfirst($user_role) ?></span><br>
                <span class="welcome-text">Welcome, <?= htmlspecialchars($username) ?>!</span>
            </div>
            <span class="material-symbols-outlined icon">notifications</span>
        </div>
    </header>

    <div class="container">
        <h1 class="profile-title">ADD NEW CLASS</h1>
        <form method="POST" class="profile-container">
            <section class="left-card">
                <div class="info-group">
                    <label>CLASS NAME:</label>
                    <input type="text" name="class_name" required>
                </div>
                <div class="action-buttons">
                    <button class="yellow" type="submit">SAVE</button>
                    <button class="red" type="reset" onclick="location.href='admin_classList.php'">CANCEL</button>
                </div>
            </section>
        </form>
    </div>

</body>

</html>