<?php
session_start();


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");  
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "admissions_db", 3307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM applications WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Record deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}


$sql = "SELECT * FROM applications";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
            width: 90%;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        button {
            padding: 5px 10px;
            cursor: pointer;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #c0392b;
        }
        .edit-btn {
            background-color: #f39c12;
        }
        .edit-btn:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel - Manage Applications</h1>
        <a href="admin_logout.php"><button>Logout</button></a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Programme ID</th>
                    <th>Submission Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['student_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['programme_id'] . "</td>";
                        echo "<td>" . $row['submission_date'] . "</td>";
                        echo "<td>
                                <a href='edit_application.php?id=" . $row['id'] . "'><button class='edit-btn'>Edit</button></a>
                                <a href='?delete_id=" . $row['id'] . "'><button>Delete</button></a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No applications found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
