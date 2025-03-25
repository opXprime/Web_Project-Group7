<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login</title>
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
        button {
            display: block;
            width: 100%;
            max-width: 300px;
            padding: 12px;
            margin: 15px auto;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
        }
        .link-btn {
            background-color: #3498db;
        }
        p {
            margin: 10px 0;
            font-size: 1em;
            color: #666;
        }
        .back-link {
            margin-top: 15px;
            display: block;
            font-size: 1em;
            color: #3498db;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Staff Login</h2>
        <form method="POST">
            <input type="text" name="staffuniquecode" placeholder="Staff Unique Code" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
            <button type="submit" name="signup" class="link-btn">Sign Up</button>
            <input type="text" name="reg_key" placeholder="Registration Key (For Signup)" style="display: <?php echo isset($_POST['signup']) ? 'block' : 'none'; ?>;">
        </form>

        <?php
        
        $conn = new mysqli("localhost", "root", "", "staff_management", 3307);
        if ($conn->connect_error) {
            die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
        }

        $valid_reg_key = "ADMIN123"; 

        // Login logic
        if (isset($_POST['login'])) {
            $staffuniquecode = $conn->real_escape_string($_POST['staffuniquecode']);
            $password = $conn->real_escape_string($_POST['password']);

            $sql = "SELECT * FROM staff WHERE staffuniquecode='$staffuniquecode'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if ($password === $row['password']) {
                    $_SESSION['staffuniquecode'] = $staffuniquecode;
                    header("Location: staff.html"); 
                    exit();
                } else {
                    echo "<p style='color: red;'>Incorrect password.</p>";
                }
            } else {
                echo "<p style='color: red;'>Staff unique code not found.</p>";
            }
        }

        // Signup logic
        if (isset($_POST['signup'])) {
            $staffuniquecode = $conn->real_escape_string($_POST['staffuniquecode']);
            $password = $conn->real_escape_string($_POST['password']);
            $reg_key = $conn->real_escape_string($_POST['reg_key']);

            if ($reg_key !== $valid_reg_key) {
                echo "<p style='color: red;'>Invalid registration key. Contact the administrator.</p>";
            } else {
                $check_sql = "SELECT * FROM staff WHERE staffuniquecode='$staffuniquecode'";
                $check_result = $conn->query($check_sql);

                if ($check_result->num_rows > 0) {
                    echo "<p style='color: red;'>Staff unique code already exists.</p>";
                } else {
                    $insert_sql = "INSERT INTO staff (staffuniquecode, password) VALUES ('$staffuniquecode', '$password')";
                    if ($conn->query($insert_sql) === TRUE) {
                        echo "<p style='color: green;'>Sign up successful! You can now log in.</p>";
                    } else {
                        echo "<p style='color: red;'>Error during sign up: " . $conn->error . "</p>";
                    }
                }
            }
        }

        $conn->close();
        ?>
        
        <p>For security reasons, passwords cannot be changed online. Please contact the administrator for assistance.</p>
        
        <!-- Add the Back to Login link here -->
        <a href="login.html" class="back-link">Back to Login</a>
    </div>
</body>
</html>