<?php
require_once '..\connect.php';

$sql = "SELECT * FROM class";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin List - SRI AL-AMIN ActivHub</title>
    <link rel="stylesheet" href="../css/teacherList.css" />
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
                <span class="admin-text">admin</span>

                <span class="welcome-text">Welcome back!</span>
            </div>
            <span class="material-symbols-outlined icon">notifications</span>
        </div>
    </header>
    <div class="container">
        <div class="teacher-list-container">
            <div class="teacher-list-box">
                <div class="title-bar">
                    <h2>Class List</h2>
                    <div class="button-group">
                        <button class="btn-yellow" onclick="location.href='admin_add_class.php'">Add New Class</button>
                        <button class="btn-red" onclick="location.href='admin_dashboard.php'">Cancel</button>
                    </div>
                </div>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="teacher-card" id="<?php echo $row["class_id"] ?>">
                            <p>
                                <strong>Class Name:</strong> <?php echo $row["class_name"] ?><br>
                                <br>
                                <button class="edit-button" onclick="edit('<?php echo $row['class_id'] ?>')">Edit</button>
                        </div>
                    <?php }
                } else { ?>
                    <div class="teacher-card">
                        <p><strong>No record</strong><br>
                    </div>
                <?php
                }

                ?>

            </div>
        </div>
    </div>
</body>

</html>

<script>
    function edit(id) {
        const data = {
            id: id
        };

        fetch('function/get_class.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                document.getElementById(id).innerHTML = result.message;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function cancel(id) {
        const data = {
            id: id
        };

        fetch('../admin/function/class_list.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                document.getElementById(id).innerHTML = result.message;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function delete_(id) {
        const data = {
            id: id
        };

        fetch('function/class_delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.status == 1) {
                    alert("Delete " + id + " successfully!");
                } else {
                    alert("Delete " + id + " unsuccessfully!");
                }
                location.href = "admin_classList.php";
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function save(id) {
        var password = document.getElementsByName("edit_password_" + id)[0].value;
        var c_password = document.getElementsByName("edit_c_password_" + id)[0].value;
        if (password == "" || c_password == "") {
            alert("Please fill all field!");
        } else if (password != c_password) {
            alert("Password and Confirm Password must be same!");
        } else {
            const data = {
                id: id,
                password: password
            };

            fetch('function/admin_update.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status == 1) {
                        alert("Updated " + id + " successfully!");
                        document.getElementById(id).innerHTML = result.message;
                    } else {
                        alert("Updated " + id + " unsuccessfully!");
                        document.getElementById(id).innerHTML = result.message;
                    }

                })
                .catch(error => {
                    console.error('Error:', error);
                });

        }

    }
</script>