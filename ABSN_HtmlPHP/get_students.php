<?php
// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'admissions_db';
$port = 3307;

try {
    // Create connection
    $conn = new PDO("mysql:host=$db_host;port=$port;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt = $conn->prepare("SELECT * FROM applications");
    $stmt->execute();

    
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

   
    echo json_encode($applications);

} catch(PDOException $e) {
    
    echo json_encode(['error' => $e->getMessage()]);
}
?>
