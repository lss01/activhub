<?php
session_start();
require_once '../connect.php';

if (!isset($_SESSION['user_role']) || !isset($_SESSION['user_ic'])) {
    header("Location: ../login.php");
    exit();
}

$user_role = $_SESSION['user_role'];
$user_ic = $_SESSION['user_ic'];

if ($user_role === 'admin') {
    $stmt = $conn->prepare("SELECT uname_admin AS name FROM admin WHERE uname_admin = ?");
    $stmt->bind_param("s", $user_ic);
} else {
    $stmt = $conn->prepare("SELECT teacher_fname AS name FROM teacher WHERE teacher_ic = ?");
    $stmt->bind_param("s", $user_ic);
}
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$username = $user['name'] ?? 'User';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $teacher_ic = $_POST['teacher_ic'];
    $password = $_POST['teacher_pass'];
    $teacher_pass = password_hash($password, PASSWORD_DEFAULT);
    $teacher_fname = $_POST['teacher_fname'];
    $teacher_contact = $_POST['teacher_contact'];
    $teacher_email = $_POST['teacher_email'];
    $teacher_dob = $_POST['teacher_dob'];
    $teacher_doe = $_POST['teacher_doe'];
    $teacher_address = $_POST['teacher_address'];
    $class = $_POST['class'];

    $stmt = $conn->prepare("INSERT INTO teacher (teacher_ic, teacher_pass, teacher_fname, teacher_contact,teacher_email, teacher_dob, teacher_doe, teacher_address, class) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssssssssi",
        $teacher_ic,
        $teacher_pass,
        $teacher_fname,
        $teacher_contact,
        $teacher_email,
        $teacher_dob,
        $teacher_doe,
        $teacher_address,
        $class
    );

    if ($stmt->execute()) {
        echo "<script>alert('Teacher added successfully'); window.location.href='admin_add_teacher.php';</script>";
    } else {
        echo "<script>alert('Failed to add teacher');</script>";
    }
}


$class_query = $conn->query("SELECT * FROM class");
$classes = $class_query->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Add Student - ActivHub</title>
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
        <h1 class="profile-title">ADD NEW TEACHER ACCOUNT</h1>

        <form method="POST">
            <section class="left-card">
                <div class="profile-header">
                    <img src="../img/profile.jpg" alt="Student Image" class="profile-pic">
                    <h2>New Teacher Entry</h2>
                </div>

                <div class="info-group">
                    <label>IC Number:</label>
                    <input type="text" name="teacher_ic" required>

                    <label>Password:</label>
                    <input type="password" name="teacher_pass" required>

                    <label>Full Name:</label>
                    <input type="text" name="teacher_fname" required>

                    <label>Contact Number:</label>
                    <input type="text" name="teacher_contact" required>

                    <label>Email:</label>
                    <input type="email" name="teacher_email">

                    <label>Date of Birth:</label>
                    <input type="date" name="teacher_dob">

                    <label>Date of Employment:</label>
                    <input type="date" name="teacher_doe">

                    <label>Address:</label>
                    <input type="text" name="teacher_address">

                    <label>Class:</label>
                    <select name="class" required>
                        <option value="">-- Select Class --</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['class_id'] ?>"><?= $class['class_name'] ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="action-buttons">
                    <button class="yellow" type="submit">SAVE</button>
                    <button class="red" type="reset" onclick="location.href='../teacher/teacherList.php'">CANCEL</button>
                </div>
            </section>

        </form>
    </div>

</body>

</html>