<?php
session_start();


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "staff_management", 3307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['staffuniquecode'])) {
    $staffuniquecode = $_GET['staffuniquecode'];

  
    $sql = "SELECT * FROM staff WHERE staffuniquecode = '$staffuniquecode'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Staff not found!";
        exit();
    }
}


if (isset($_POST['submit'])) {
    $password = $_POST['password'];

   
    $update_sql = "UPDATE staff SET password = ? WHERE staffuniquecode = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ss", $password, $staffuniquecode);
    
    if ($stmt->execute()) {
        echo "Staff password updated successfully!";
    } else {
        echo "Error updating staff password: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            padding: 20px;
            background-color: #fff;
            width: 50%;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Staff</h2>
        <form method="POST" action="">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>" required>

            <button type="submit" name="submit">Update Password</button>
        </form>
    </div>
</body>
</html>
