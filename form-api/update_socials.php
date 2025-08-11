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

        $facebook_url = htmlspecialchars(trim($_POST['facebook_url']));
        $twitter_url = htmlspecialchars(trim($_POST['twitter_url']));
        $instagram_url = htmlspecialchars(trim($_POST['instagram_url']));

        // Call the update method
        $response = $Controller->updateSocialLinks($user_id, $facebook_url, $twitter_url, $instagram_url);
        echo json_encode($response);
        exit;
   
}
?>
