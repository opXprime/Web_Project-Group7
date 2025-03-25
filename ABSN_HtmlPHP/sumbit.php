<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "admissions_db"; 
$port = 3307; 


$conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$programme_id = $_POST['programme_id'];
$student_name = $_POST['student_name'];
$email = $_POST['email'];


$stmt = $conn->prepare("INSERT INTO applications (programme_id, student_name, email) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $programme_id, $student_name, $email);


if ($stmt->execute()) {
    echo "<h2>Application Submitted Successfully!</h2>";
    echo "<p>Programme ID: " . htmlspecialchars($programme_id) . "</p>";
    echo "<p>Student Name: " . htmlspecialchars($student_name) . "</p>";
    echo "<p>Email: " . htmlspecialchars($email) . "</p>";
    echo "<p><a href='submission.html'>Submit Another Application</a></p>";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>