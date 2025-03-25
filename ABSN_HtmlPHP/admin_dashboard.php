<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <ul>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="manage_courses.php">Manage Courses</a></li>
        <li><a href="manage_admissions.php">Manage Admissions</a></li>
        <li><a href="view_reports.php">View Reports</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>