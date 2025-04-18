<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SRI AL-AMIN ActivHub</title>
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../css/admin_dash.css" />
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
          <a href="#">Dashboard</a>
          <a href="admin_list.php">Profile</a>
        </div>
      </div>
    </div>

    <div class="icon-section">
      <div class="admin-section">
        <span class="admin-text">Administrator</span>
        <span class="welcome-text">Welcome back!</span>
      </div>
      <span class="material-symbols-outlined icon">notifications</span>
    </div>
  </header>

  <div class="container">
    <div class="welcome-section">
      <img src="../img/logo.png" alt="Logo">
      <div class="welcome-texts">
        <h1>Welcome To <br> SRI AL-AMIN ActivHub</h1>
        <h2>"Centre For SRI AL-AMIN Students' Co-curricular Records"</h2>
      </div>
    </div>

    <br>
    <div class="dashboard-content">
      <div class="left-panel card">
        <p>HELLO,<br>ADMINISTRATOR</p>
        <button class="btn-yellow">INBOX</button>
        <button class="btn-yellow" onclick="location.href='admin_list.php'">ADMIN LIST</button>
        <button class="btn-yellow" onclick="location.href='admin_classList.php'">CLASS LIST</button>
        <button class=" btn-yellow">COCURRICULAR EVENT</button>
        <button class="btn-yellow">COCURRICULAR BOARD</button>
        <form action="../logout.php" method="post">
          <button type="submit" class="btn-red">SIGN OUT</button>
        </form>
      </div>

      <div class="right-panel">
        <h3>COCURRICULAR EVENTS</h3>

        <div class="event-item">
          <strong>12th January 2025</strong><br>
          TAEKWONDO COMPETITION <br>
          Place: SRI AL-AMIN<br>
          Registration: Open Till 16th December<br>
          Contact: 019-xxxxxxxx<br>
          <button class="btn-status-green">Event Open</button>
          <button class="btn-status-blue">Register Here</button>
        </div>

        <div class="event-item">
          <strong>12th January 2025</strong><br>
          BEACH CLEANUP VOLUNTEERS <br>
          Place: Pantai Morib<br>
          Registration: Open Till 10th November<br>
          Contact: 019-xxxxxxxx<br>
          <button class="btn-status-red">Event Closed</button>
        </div>

        <div class="event-item">
          <strong>12th January 2025</strong><br>
          BEACH CLEANUP VOLUNTEERS <br>
          Place: Pantai Morib<br>
          Registration: Open Till 10th November<br>
          Contact: 019-xxxxxxxx<br>
          <button class="btn-status-red">Event Closed</button>
        </div>
      </div>
    </div>

    <div class="manage-users-section">
      <h1>MANAGE USERS</h1>
      <div class="manage-users-cards">
        <div class="card">
          <img src="../img/teachers.jpg" alt="Teachers">
          <p>Teachers</p>
          <a href="../teacher/teacherList.php">
            <button class="btn-yellow">Select</button>
          </a>
        </div>

        <div class="card">
          <img src="../img/students.jpg" alt="Students">
          <p>Students</p>
          <a href="admin_studentList.php">
            <button class="btn-yellow">Select</button>
          </a>
        </div>
      </div>
    </div>
  </div>

</body>

</html>