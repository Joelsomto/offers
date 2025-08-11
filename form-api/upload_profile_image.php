<?php

require_once('../include/Session.php');
require_once('../include/Dbconfig.php');
require_once('../include/Crud.php');
require_once("../include/Controller.php");
require_once('../include/Functions.php');

// Instantiate the Controller
$Controller = new Controller();

$response = ['status' => 'error', 'message' => 'An unexpected error occurred.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $user_id = $_SESSION['user_id']; // Assuming user is logged in

        // Validate file type and size
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['profile_image']['type'];
        $fileSize = $_FILES['profile_image']['size'];

        if (!in_array($fileType, $allowedTypes)) {
            $response['message'] = 'Invalid file type. Only JPG, PNG, and GIF are allowed.';
        } elseif ($fileSize > 2 * 1024 * 1024) { // 2 MB limit
            $response['message'] = 'File size exceeds the limit of 2 MB.';
        } else {
            // Process the upload
            $uploadDir = '../uploads/profile_images/';
            $fileName = 'profile_' . $user_id . '_' . time() . '.' . pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
            $filePath = $uploadDir . $fileName;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
            }

            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $filePath)) {
                // Call the update method from the Controller
                $response = $Controller->updateProfileImage($user_id, $fileName);
            } else {
                $response['message'] = 'Failed to move uploaded file.';
            }
        }
    } else {
        $response['message'] = 'No file uploaded or file upload error.';
    }
}

echo json_encode($response);
?>
