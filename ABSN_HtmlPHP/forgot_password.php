<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #000;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            width: 350px;
        }
        h2 {
            color: #333;
            margin-bottom: 30px;
        }
        input {
            width: 100%;
            max-width: 280px;
            padding: 12px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button, a {
            width: 100%;
            max-width: 300px;
            padding: 12px;
            margin: 15px auto;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="gmail" placeholder="Gmail Address" required><br>
            <input type="password" name="new_password" placeholder="New Password" required><br>
            <button type="submit" name="reset">Reset</button>
            <a href="student_login.php">Back to Login</a>
        </form>

        <?php
        if (isset($_POST['reset'])) {
           
            $conn = new mysqli("localhost", "root", "", "student_portal", 3307);

            if ($conn->connect_error) {
                die("<p style='color: red;'>Connection failed!</p>");
            }

            // Get form data
            $username = $conn->real_escape_string($_POST['username']);
            $gmail = $conn->real_escape_string($_POST['gmail']);
            $new_password = $conn->real_escape_string($_POST['new_password']);

            // Verify username and Gmail match
            $sql = "SELECT * FROM students WHERE username='$username' AND email='$gmail'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
               
                $update_sql = "UPDATE students SET password='$new_password' WHERE username='$username'";
                if ($conn->query($update_sql)) {
                    echo "<p style='color: green;'>Password reset! <a href='student_login.php'>Log in</a></p>";
                } else {
                    echo "<p style='color: red;'>Error resetting password!</p>";
                }
            } else {
                echo "<p style='color: red;'>Username or Gmail incorrect!</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>