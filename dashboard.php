<?php
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - User System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="dashboard-box">
            <h2>Welcome to Your Dashboard</h2>
            
            <div class="user-info">
                <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION["email"]); ?></p>
                <p><strong>User ID:</strong> <?php echo htmlspecialchars($_SESSION["id"]); ?></p>
            </div>
            
            <div class="actions">
                <a href="logout.php" class="btn btn-logout">Logout</a>
            </div>
            
            <div class="info-box">
                <h3>What's Next?</h3>
                <p>You can now expand this system by adding:</p>
                <ul>
                    <li>Profile editing functionality</li>
                    <li>Password reset feature</li>
                    <li>Email verification</li>
                    <li>User roles and permissions</li>
                    <li>Remember me functionality</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>