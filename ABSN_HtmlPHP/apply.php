<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';  
$db_name = 'admissions_db';
$port = 3307;   

try {
    
    $conn = new PDO("mysql:host=$db_host;port=$port;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $programme_id = $_POST['programme_id'];
        $student_name = $_POST['student_name'];
        $email = $_POST['email'];

       
        $stmt = $conn->prepare("INSERT INTO applications (programme_id, student_name, email) VALUES (?, ?, ?)");
        $stmt->execute([$programme_id, $student_name, $email]);

        
        echo "<html>
        <head>
            <title>Submission Successful</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 50px; }
                h2 { color: #4CAF50; }
                a { color: #002147; text-decoration: none; }
                a:hover { text-decoration: underline; }
            </style>
        </head>
        <body>
            <h2>Application Submitted Successfully!</h2>
            <p>Thank you, $student_name, for applying to Programme ID: $programme_id.</p>
            <p><a href='courses.html'>Back to Courses</a></p>
        </body>
        </html>";
    } else {
        echo "Invalid request method.";
    }
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}

$conn = null; 
?>