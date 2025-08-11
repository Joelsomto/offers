<?php
// session.php
session_start();

// Function to display error messages
function errorMsg()
{
    if (isset($_SESSION['errorMsg']) && !empty($_SESSION['errorMsg'])) {
        $message = $_SESSION['errorMsg'];
        $_SESSION['errorMsg'] = null;
        return "<div class='alert alert-danger' role='alert'>
                    $message
                               </div>";
    }
    return ""; // Return an empty string if no error message
}

// Function to display success messages
function successMsg()
{
    if (isset($_SESSION['successMsg']) && !empty($_SESSION['successMsg'])) {
        $message = $_SESSION['successMsg'];
        $_SESSION['successMsg'] = null;
        return "<div class='alert alert-success' role='alert'>
                    <strong>Success:</strong> $message
                              </div>";
    }
}
function infoMsg()
{
    if (isset($_SESSION['infoMsg']) && !empty($_SESSION['infoMsg'])) {
        $message = $_SESSION['infoMsg'];
        $_SESSION['infoMsg'] = null;
        return "<div class='alert alert-info' role='alert'>
                    <strong>$message</strong> 
        
                </div>";
    }
}
