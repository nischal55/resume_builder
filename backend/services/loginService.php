<?php
// Start session at the very top (before any output)
session_start();

// Include database connection
include('../config/db.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get username and password from POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($password)) {
        die("Username and password are required");
    }

    // Prepare SQL query (using prepared statements for security)
    $sql = "SELECT * FROM resume_db.user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        die("Database error: " . mysqli_error($conn));
    }

    // Bind parameters and execute
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if user exists
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $row['id']; // Assuming there's an id column
            $_SESSION['username'] = $row['username'];
            
            // Successful login redirect (remove space after 'location')
            header('Location: ../../frontend/pages/dashboard.php?status=200');
            exit();
        }
    }
    
    // Failed login redirect
    header('Location: ../../frontend/pages/user_login.php?status=500');
    exit();
} else {
    // Not a POST request - redirect to login page
    header('Location: ../../frontend/pages/user_login.php');
    exit();
}
?>