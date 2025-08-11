<?php
ob_start();
require_once('../include/Session.php');
require_once('../include/Dbconfig.php');
require_once('../include/Crud.php');
require_once("../include/Controller.php");
require_once('../include/Functions.php');

$Controller = new Controller();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_SESSION['user_id']; 

        // Sanitize and validate password fields
        $new_password = htmlspecialchars(trim($_POST['password']));

        if (empty($new_password)) {
            echo json_encode(['status' => 'error', 'message' => 'New password cannot be empty.']);
            exit;
        }

        // Call the update method
        $response = $Controller->updatePassword($user_id, $new_password);
        echo json_encode($response);
        exit;
}
?>
