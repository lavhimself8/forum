<?php
// Initialize variable to handle error message
$showError = "false";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include '_dbconnect.php';

    // Retrieve form data
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];

    // Check if email already exists
    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
        // Set error message if email already in use
        $showError = "Email already in use";
    } else {
        // Validate passwords
        if ($pass == $cpass) {
            // Hash password
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            // Insert user data into database
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            // Redirect if signup is successful
            if ($result) {
                $showAlert = true;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            }
        } else {
            // Set error message if passwords do not match
            $showError = "Passwords do not match";
        }
    }
    // Redirect with error message
    header("Location: /forum/index.php?signupsuccess=false&error=$showError");
}
?>