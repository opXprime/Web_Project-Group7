<?php
session_start();


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = new mysqli("localhost", "root", "", "admissions_db", 3307);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $sql = "SELECT * FROM applications WHERE id = $id";
    $result = $conn->query($sql);
    $application = $result->fetch_assoc();

   
    if (isset($_POST['submit'])) {
        $student_name = $_POST['student_name'];
        $email = $_POST['email'];
        $programme_id = $_POST['programme_id'];

        
        $update_sql = "UPDATE applications SET student_name = '$student_name', email = '$email', programme_id = $programme_id WHERE id = $id";
        if ($conn->query($update_sql) === TRUE) {
            echo "Application updated successfully!";
            header("Location: admin_panel.php"); 
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "No application ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Application</title>
</head>
<body>
    <div>
        <h1>Edit Application - ID: <?php echo $application['id']; ?></h1>
        <form method="POST">
            <label for="student_name">Student Name:</label>
            <input type="text" name="student_name" value="<?php echo $application['student_name']; ?>" required><br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $application['email']; ?>" required><br><br>

            <label for="programme_id">Programme ID:</label>
            <input type="number" name="programme_id" value="<?php echo $application['programme_id']; ?>" required><br><br>

            <button type="submit" name="submit">Update Application</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
