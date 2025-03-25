<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Form</title>
</head>
<body>
    <h2>Welcome to Our Website!</h2>
    
    <!-- Form to submit name and email -->
    <form action="welcome.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter your name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
