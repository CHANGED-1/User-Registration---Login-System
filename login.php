<?php
require_once 'config.php';

// Initialize variables
$username = $password = "";
$errors = array();
$success_msg = "";

// Check if user came from registration
if (isset($_GET['success']) && $_GET['success'] == 'registered') {
    $success_msg = "Registration successful! Please login.";
}

// Process form when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $errors[] = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $errors[] = "Please enter password.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // If no errors, check credentials
    if (empty($errors)) {
        $sql = "SELECT id, username, email, password FROM users WHERE username = ?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $email, $hashed_password);
                    
                    if (mysqli_stmt_fetch($stmt)) {
                        // Verify password
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            session_regenerate_id();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["email"] = $email;
                            
                            // Redirect to dashboard
                            header("location: dashboard.php");
                            exit();
                        } else {
                            $errors[] = "Invalid username or password.";
                        }
                    }
                } else {
                    $errors[] = "Invalid username or password.";
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - User System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Login</h2>
            
            <?php 
            if (!empty($success_msg)) {
                echo '<div class="alert alert-success">' . $success_msg . '</div>';
            }
            
            if (!empty($errors)) {
                echo '<div class="alert alert-danger">';
                foreach ($errors as $error) {
                    echo '<p>' . $error . '</p>';
                }
                echo '</div>';
            }
            ?>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo $username; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                
                <button type="submit" class="btn">Login</button>
                
                <p class="text-center">Don't have an account? <a href="register.php">Register here</a></p>
            </form>
        </div>
    </div>
</body>
</html>