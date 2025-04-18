<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['user_ic']) || $_SESSION['user_role'] !== 'student') {
  header("Location: login.php?expired=true");
  exit;
}
$student_ic = $_SESSION['user_ic'];


if ($student_ic) {
  $query = "SELECT s.*, c.class_name, t.teacher_fname, t.teacher_email FROM student s JOIN class c ON s.student_class = c.class_id JOIN teacher t ON s.teacher_incharge = t.teacher_ic WHERE s.student_ic = ?";

  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $student_ic);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
  } else {
    echo "No student data found.";
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Profile - SRI AL-AMIN ActivHub</title>
  <link rel="stylesheet" href="css/profile.css" />
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
          <a href="student_dashboard.php">Dashboard</a>
          <a href="student_profile.php">Profile</a>
          <a href="#">CoCurricular Board</a>
        </div>
      </div>
    </div>

    <div class="icon-section">
      <div class="admin-section">
        <span class="admin-text"><?php echo strtoupper($row['student_fname']); ?></span><br>
        <span class="welcome-text">Welcome back!</span>
      </div>
      <span class="material-symbols-outlined icon">notifications</span>
    </div>
  </header>

  <div class="container">
    <h1 class="profile-title">PROFILE</h1>

    <main class="profile-container">

      <section class="left-card">
        <div class="profile-header">
          <img src="img/profile.jpg" alt="Student Image" class="profile-pic">
          <h2>Welcome,<br><span><?php echo strtoupper($row['student_fname']); ?></span></h2>
        </div>

        <div class="info-group">
          <label>FULL NAME:</label>
          <input type="text" value="<?php echo strtoupper($row['student_fname']); ?>" readonly>
          <label>IC NUMBER:</label>
          <input type="text" value="<?php echo $row['student_ic']; ?>" readonly>
          <label>DATE OF BIRTH:</label>
          <input type="text" value="<?php echo date('d M Y', strtotime($row['student_dob'])); ?>" readonly>
          <label>DATE OF ENTRY:</label>
          <input type="text" value="<?php echo date('d M Y', strtotime($row['student_doe'])); ?>" readonly>
          <label>ADDRESS:</label>
          <input type="text" value="<?php echo $row['student_address']; ?>" readonly>
          <label>EMERGENCY CONTACT NUMBER:</label>
          <input type="text" value="<?php echo $row['student_emergency']; ?>" readonly>
        </div>

        <h3>GUARDIAN INFORMATION</h3>
        <div class="info-group">
          <label>IC NUMBER:</label>
          <input type="text" value="<?php echo $row['guardian_ic']; ?>" readonly>
          <label>FULL NAME:</label>
          <input type="text" value="<?php echo strtoupper($row['guardian_name']); ?>" readonly>
          <label>RELATIONSHIP:</label>
          <input type="text" value="<?php echo strtoupper($row['relationship']); ?>" readonly>
          <label>ADDRESS:</label>
          <input type="text" value="<?php echo $row['guardian_address']; ?>" readonly>
          <label>CONTACT NUMBER:</label>
          <input type="text" value="<?php echo $row['contact_num']; ?>" readonly>
        </div>
      </section>

      <section class="right-card">
        <div class="class-info">
          <h3>CLASS INFORMATION</h3>
          <label>CLASS:</label>
          <input type="text" value="<?php echo strtoupper($row['class_name']); ?>" readonly>
          <br>
          <hr>
          <h3>TEACHER INFORMATION</h3>
          <label>TEACHER IN-CHARGE:</label>
          <input type="text" value="<?php echo strtoupper($row['teacher_fname']); ?>" readonly>
          <label>EMAIL:</label>
          <input type="text" value="<?php echo $row['teacher_email']; ?>" readonly>

        </div>

        <div class="action-buttons">
          <button class="yellow" onClick="document.location.href='student_dashboard.php';">DASHBOARD</button>
          <button class="yellow">INBOX</button>
          <form action="logout.php" method="post">
            <button type="submit" class="red">SIGN OUT</button>
          </form>
        </div>
      </section>
  </div>
  </main>

</body>

</html>