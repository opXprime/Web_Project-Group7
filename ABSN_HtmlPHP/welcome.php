<!--<html>
    <body>

    Welcome Dear, <?php echo $_POST['name']; ?> <br>
    Your email address is: <?php echo $_POST['email'];?>

</body>
<html>-->

<?php

$host = "localhost"; 
$dbname = "student"; // Make sure this database exists in MySQL
$username = "root"; // Change if needed
$password = ""; // Default XAMPP password

// Establish database connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];

// SQL query to insert data
$sql = "INSERT INTO contact (name, email) VALUES ('$name', '$email')";

// Execute the query
$check = mysqli_query($conn, $sql);

if ($check) {
    echo "The data is inserted successfully";
} else {
    echo "The data could not be inserted. Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

?>