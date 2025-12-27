<?php
require_once 'config.php';

// Initialize variables
$username = $email = $password = $confirm_password = "";
$errors = array();

// Process form when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $errors[] = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
        
        // Check if username already exists
        $sql = "SELECT id FROM users WHERE username = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $errors[] = "This username is already taken.";
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $errors[] = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
        
        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        } else {
            // Check if email already exists
            $sql = "SELECT id FROM users WHERE email = ?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        $errors[] = "This email is already registered.";
                    }
                }
                mysqli_stmt_close($stmt);
            }
        }
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $errors[] = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $errors[] = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $errors[] = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password != $confirm_password) {
            $errors[] = "Passwords do not match.";
        }
    }
    
    // If no errors, insert user into database
    if (empty($errors)) {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);
            
            if (mysqli_stmt_execute($stmt)) {
                // Registration successful, redirect to login
                header("location: login.php?success=registered");
                exit();
            } else {
                $errors[] = "Something went wrong. Please try again later.";
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
    <title>Register - User System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Create Account</h2>
            
            <?php 
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
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" required>
                </div>
                
                <button type="submit" class="btn">Register</button>
                
                <p class="text-center">Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </div>
</body>
</html>