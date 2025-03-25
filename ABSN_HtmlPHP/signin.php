<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Sign In</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Sign In</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <button type="submit" name="signin">Sign In</button>
            <a href="student_login.php" class="link-btn">Back to Login</a>
        </form>

        <?php
      
        if (isset($_POST['signin'])) {
           
            $conn = new mysqli("localhost", "root", "", "student_portal", 3307);

            // Check connection
            if ($conn->connect_error) {
                die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
            }

          
            $username = $conn->real_escape_string($_POST['username']);
            $password = $conn->real_escape_string($_POST['password']); 
            $email = $conn->real_escape_string($_POST['email']);

         
            $check_sql = "SELECT * FROM students WHERE username='$username'";
            $check_result = $conn->query($check_sql);

            if ($check_result->num_rows > 0) {
                echo "<p style='color: red;'>Username already taken. Please choose another.</p>";
            } else {
               
                $insert_sql = "INSERT INTO students (username, password, email) VALUES ('$username', '$password', '$email')";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "<p style='color: green;'>Sign-in successful! You can now <a href='student_login.php'>log in</a>.</p>";
                } else {
                    echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
                }
            }

            // Close connection
            $conn->close();
        }
        ?>
    </div>
</body>
</html>