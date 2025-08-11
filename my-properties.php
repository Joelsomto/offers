<?php
require_once('./include/Session.php');
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once("./include/Controller.php");
require_once("./include/Functions.php");

$Controller = new Controller();

if (!isset($_SESSION['user_role'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['user_role'] !== 'A') {
    header("Location: unauthorized.php");
    exit;
}


$user_id = $_SESSION['user_id'];

$getMyproperties = $Controller->getMyproperties($user_id);
$property_status = $Controller->property_status();
// var_dump($getMyproperties);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>OFFERS NG | MY PROPERTIES </title>
<link rel="stylesheet" type="text/css" href="css/master.css">
<link rel="stylesheet" type="text/css" href="css/color/color-8.css" id="color" />
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>


<!--===== LOADER =====-->
<div class="loader">
    <div class="cssload-thecube">
      <div class="cssload-cube cssload-c1"></div>
      <div class="cssload-cube cssload-c2"></div>
      <div class="cssload-cube cssload-c4"></div>
      <div class="cssload-cube cssload-c3"></div>
    </div>
</div>
<!--===== #/LOADER =====-->


<!--===== BACK TO TOP =====-->
<div class="short-msg">
  <a href="#." class="back-to"><i class="icon-arrow-up2"></i></a>
  <a href="#." class="short-topup" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
</div>
<!--===== #/BACK TO TOP =====-->


<!--===== HEADER =====-->
<?php include_once('./components/header.php') ?>

<!--===== #/HEADER =====-->




<!--- My Property Start -->
<section class="my_pro padding bg-color-gray">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="text-uppercase">My <span class="color_red"> Properties</span></h2>
        <div class="line_1"></div>
        <div class="line_2"></div>
        <div class="line_3"></div>
      </div>
    </div>
    <div class="row">

    <?php 
// Transform the array of arrays into an associative array
$status_map = [];
foreach ($property_status as $status) {
    $status_map[$status['status_id']] = $status['status_name'];
}

foreach ($getMyproperties as $properties) {
    // Fetch the status name using the mapped array
    $statusName = isset($status_map[$properties['property_status']]) 
                  ? $status_map[$properties['property_status']] 
                  : 'Unknown Status';

    // Handle the image path
    $imagePath = !empty($properties['image_file_name']) 
                ? "./uploads/property_images/" . $properties['image_file_name'] 
                : "./uploads/property_images/default-image.png"; // Default image path
?>
    <div class="property-list-list" data-target="Residential">
        <div class="col-xs-12 col-sm-4 col-md-4 property-list-list-image">
            <img src="<?=$imagePath?>" alt="property-image" class="img-responsive">
        </div>

        <div class="col-xs-12 col-sm-8 col-md-8 property-list-list-info">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <a href="#.">
                    <h3><?=$properties['property_title']?></h3>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <label class="property-list-list-label"><?=$statusName?></label>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <p class="recent-properties-price"><?=$properties['property_address']?></p>
                <span class="recent-properties-address"><i class="fa-solid fa-naira-sign" style="font-size: 17px;"></i><?=number_format($properties['price'], 2)?></span>
                <p><?=strip_tags($properties['description'])?></p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 property-list-list-facility">
                <ul>
                    <li class="left"><i class="fa fa-home" aria-hidden="true"></i> Bathrooms</li>
                    <li class="right"><span><?=$properties['bath_room']?></span></li>
                </ul>
                <ul>
                    <li class="left"><i class="fa fa-bed" aria-hidden="true"></i> Beds</li>
                    <li class="right"><span><?=$properties['bed_room']?></span></li>
                </ul>
                <!-- <ul>
                    <li class="left"><i class="fa fa-car" aria-hidden="true"></i> Garages</li>
                    <li class="right"><span>1</span></li> 
                </ul> -->
            </div>
        </div>
    </div>
<?php 
}
?>



    </div>
  </div>
</section>
<!-- My - Property end -->



<!--===== FOOTER =====-->
<?php include_once('./components/footer.php')?>

<!--===== #/FOOTER =====--> 


<!-- Modal -->
<?php include_once('./components/message_modal.php') ?>

<!-- #/Modal -->


<!--===== REQUIRED JS =====--> 
<script src="js/jquery-3.2.1.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/bootsnav.js"></script>

<!--To View on scroll-->
<script src="js/jquery.appear.js"></script>
 
<!--Owl Slider-->
<script src="js/owl.carousel.min.js"></script>

<!--Parallax-->
<script src="js/parallaxie.js"></script>

<!--Fancybox-->
<script src="js/jquery.fancybox.min.js"></script> 

<!--Cube Gallery-->
<script src="js/cubeportfolio.min.js"></script> 

<!--Bootstrap Dropdown-->
<script src="js/bootstrap-select.js"></script>

<!--Video Popup-->
<script src="js/videobox/video.js"></script>

<!--Datepicker-->
<script src="js/datepicker.js"></script> 

<!--Dropzone-->
<script src="js/dropzone.min.js"></script>

<!--Wow animation-->
<script src="js/wow.min.js"></script>

<!--Rang Slider-->
<script src="js/range-Slider.min.js"></script> 

<!--Checkbox-->
<script src="js/selectbox-0.2.min.js"></script> 

<!--Checkbox-->
<script src="js/scrollreveal.min.js"></script> 

<!--Checkbox-->
<script src="js/jquery-countTo.js"></script> 

<!--Checkbox-->
<script src="js/jquery.typewriter.js"></script> 

<!--Checkbox-->
<script src="js/death.min.js"></script>

<!--Revolution Slider-->
<script src="js/themepunch/jquery.themepunch.tools.min.js"></script>
<script src="js/themepunch/jquery.themepunch.revolution.min.js"></script>   
<script src="js/themepunch/revolution.extension.layeranimation.min.js"></script> 
<script src="js/themepunch/revolution.extension.navigation.min.js"></script> 
<script src="js/themepunch/revolution.extension.parallax.min.js"></script> 
<script src="js/themepunch/revolution.extension.slideanims.min.js"></script> 
<script src="js/themepunch/revolution.extension.video.min.js"></script>

<!--Custom Js -->
<script src="js/functions.js"></script>

<!--Maps & Markers-->
<script src="js/form.js"></script> 
<script src="js/custom-map.js"></script> 
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAOBKD6V47-g_3opmidcmFapb3kSNAR70U"></script>
<script src="js/gmaps.js"></script>
<script src="js/contact.js"></script> 
<!--===== #/REQUIRED JS =====-->


</body>

<!-- Mirrored from logicsforest.com/themeforest/idea-homes/ideahomes_demo_files/my-properties.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Nov 2024 10:51:04 GMT -->
</html>
