<?php
// Initialize variable to handle error message
$showError = "false";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include '_dbconnect.php';

    // Retrieve form data
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];

    // SQL query to check if the email exists
    $sql = "SELECT * FROM users WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    // If email exists
    if ($numRows == 1) {
        // Fetch user data
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($pass, $row['user_pass'])) {
            // Start session
            session_start();
            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['useremail'] = $email;
            // Redirect to home page
            header("Location: /forum/index.php");
            // Print message
            echo "logged in" . $email;
        }
    }
    // Redirect to home page
    header("Location: /forum/index.php");
}
?>