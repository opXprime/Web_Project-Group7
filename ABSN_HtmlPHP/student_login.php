<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h2 {
            color: #333;
            margin-bottom: 30px;
            font-size: 1.8em;
        }
        input {
            width: 100%;
            max-width: 280px;
            padding: 12px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button, a {
            display: block;
            width: 100%;
            max-width: 300px;
            padding: 12px;
            margin: 15px auto;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 1.1em;
        }
        .link-btn {
            background-color: #3498db;
        }
        p {
            margin: 10px 0;
            font-size: 1em;
        }
        .back-link {
            background-color: #555; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
            <a href="forgot_password.php" class="link-btn">Forgotten Password?</a>
            <a href="signin.php" class="link-btn">Sign In</a>
        </form>

        <?php
        if (isset($_POST['login'])) {
            $conn = new mysqli("localhost", "root", "", "student_portal", 3307);

            if ($conn->connect_error) {
                die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
            }

            $username = $conn->real_escape_string($_POST['username']);
            $password = $conn->real_escape_string($_POST['password']);

            $sql = "SELECT * FROM students WHERE username='$username'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if ($password === $row['password']) { 
                   
                    header("Location: admission.html");
                    exit();
                } else {
                    echo "<p style='color: red;'>Incorrect password.</p>";
                }
            } else {
                echo "<p style='color: red;'>Username not found.</p>";
            }

            $conn->close();
        }
        ?>
        <a href="login.html" class="back-link">Back to Login</a>
    </div>
</body>
</html>