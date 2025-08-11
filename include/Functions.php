<?php

function redirect_to($new_location){
    header("Location: ". $new_location);
    exit;
}
function confirm_login()
{
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if user is logged in
    if (isset($_SESSION['user_id']) && isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
        return true;
    }

    // Get the current page name
    $current_page = basename($_SERVER['PHP_SELF']); 
    
    // Prevent redirect loop if already on the login page
    if ($current_page === 'login.php') {
        return false;
    }

    // Save the current page in session for redirection after login
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];

    // Set error message and redirect to login page
    $_SESSION['errorMsg'] = "Kindly Login to continue!";
    redirect_to("login.php");
    exit(); // Ensure no further execution after redirect
}

confirm_login();

?>
