<?php
require_once('./include/Session.php');
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once("./include/Controller.php");

$Controller = new Controller();

$getStates = $Controller->getStates();

$property_types = $Controller->property_types();

$property_status = $Controller->property_status();

$getRecentPropertiesLimitTen = $Controller->getRecentPropertiesLimitTen();

// var_dump($getRecentPropertiesLimitTen);
// die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>OFFERS NG </title>
<link rel="stylesheet" type="text/css" href="css/master.css">
<link rel="stylesheet" type="text/css" href="css/color/color-8.css" id="color" />
<link rel="shortcut icon" href="images/favicon.ico">
<!-- Add this CSS -->
<style>
  .property_item .image img {
    max-width: 100%;
    max-height: 300px; 
    object-fit: cover; 
    width: auto; 
    height: auto;
  }
</style>

</head>

<body>

<!-- LOADER -->
<!-- <div class="loader">
    <div class="cssload-thecube">
        <div class="cssload-cube cssload-c1"></div>
        <div class="cssload-cube cssload-c2"></div>
        <div class="cssload-cube cssload-c4"></div>
        <div class="cssload-cube cssload-c3"></div>
    </div>
</div> -->
<!--LOADER-->

<!--===== BACK TO TOP =====-->
<div class="short-msg">
  <a href="#." class="back-to"><i class="icon-arrow-up2"></i></a>
  <!-- <a href="#." class="short-topup" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope-o" aria-hidden="true"></i></a> -->
</div>
<!--===== #/BACK TO TOP =====-->


<!-- HEADER START -->
<?php include_once('./components/header-index.php')?>
<!--HEADER End -->


<!-- BANNER -->
<?php include_once('./components/banner-index.php')?>
<!-- #/BANNER -->


<!-- WELCOME -->
<section id="wellcome" class="padding">
  <div class="container">
    <div class="row">
    <div class="col-sm-1 col-md-2"></div>
      <div class="col-xs-12 col-sm-10 col-md-8 text-center">
        <h2 class="text-uppercase">Welcome to <span class="color_red">OFFERS NG</span></h2>
        <div class="line_1-1"></div>
        <div class="line_2-2"></div>
        <div class="line_3-3"></div>
        <p class="heading_space">Discover your dream home with us! Whether you're buying, selling, or renting, we make finding the perfect property easy and exciting. Explore a range of premium listings tailored to meet your lifestyle and budget. Let us turn your real estate goals into reality!</p>

      </div>
      <div class="col-sm-1 col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12 text-center">
        <div class="welcome top40">
          <img src="images/wellcome_1.png" alt="image">
          <h4> 24/7 Emergency Available</h4>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12 text-center">
        <div class="welcome top40">
          <img src="images/wellcome_2.png" alt="image">
          <h4>Expert and Professional</h4>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12 text-center">
        <div class="welcome top40">
          <img src="images/wellcome_3.png" alt="image">
          <h4>Satisfaction Guarantee</h4>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12 text-center">
        <div class="welcome top40">
          <img src="images/wellcome_4.png" alt="image">
          <h4>Free Inspection</h4>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- #/WELCOME -->




<!-- RECENT PROPERTY -->
<section id="agent-p-2" class="property-details bg_light padding">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 bottom40">
        <h2 class="text-uppercase">Recent <span class="color_red">PROPERTY</span></h2>
        <div class="line_1"></div>
        <div class="line_2"></div>
        <div class="line_3"></div>
        <!-- <p class="margin-t-20">Mauris accumsan eros eget libero posuere vulputate. Etiam elit elit, elementum sed varius at, adipiscing
          <br>vitae est. Sed nec felis pellentesque, lacinia dui sed, ultricies sapien.
        </p> -->
      </div>
    </div>
    <div class="col-md-12">
      <div class="row">
        <div id="property-2-slider" class="owl-carousel">
        <?php foreach ($getRecentPropertiesLimitTen as $property): ?>
<div class="item">
  <div class="property_item bottom40">
    <div class="image">
      <!-- Display the first image from the `images` field -->
      <img src="uploads/property_images/<?= explode(',', $property['images'])[0] ?>" 
           alt="<?= htmlspecialchars($property['property_title']) ?>" 
           class="img-responsive">
      <div class="property_meta">
        <span><i class="fa fa-object-group"></i><?= $property['square_fit_min'] ?> - <?= $property['square_fit_max'] ?> sq ft</span>
        <span><i class="fa fa-bed"></i><?= $property['bed_room'] ?> Bedroom<?= $property['bed_room'] > 1 ? 's' : '' ?></span>
        <span><i class="fa fa-bath"></i><?= $property['bath_room'] ?> Bathroom<?= $property['bath_room'] > 1 ? 's' : '' ?></span>
      </div>

      <?php
        // Status mapping array
        $statusMapping = [
          1 => 'For Sale',
          2 => 'For Rent',
          3 => 'Sold',
          4 => 'Under Contract',
          5 => 'Coming Soon',
          6 => 'Off Market',
        ];

        // Get the mapped status using the property status value
        $propertyStatus = isset($statusMapping[$property['property_status']])
          ? $statusMapping[$property['property_status']]
          : 'Unknown'; // Default if status is not found
      ?>

      <div class="price"><span class="tag"><?= htmlspecialchars($propertyStatus) ?></span></div>
      
      <div class="overlay">
        <div class="centered">
          <a class="link_arrow white_border" href="property-details.php?id=<?= $property['id'] ?>">View Detail</a>
        </div>
      </div>
    </div>
    <div class="proerty_content">
      <div class="proerty_text">
        <h3><a href="property-details.php?id=<?= $property['id'] ?>">
          <?= htmlspecialchars($property['property_title']) ?>
        </a></h3>
        <span class="bottom10"><?= htmlspecialchars($property['property_address']) ?></span>
        <p><strong><i class="fa-solid fa-naira-sign" style="font-size: 17px;"><?= number_format($property['price'], 2) ?></i></strong></p>
      </div>
      <div class="favroute clearfix">
        <p class="pull-left"><i class="icon-calendar2"></i> 
          <?= date('F j, Y', strtotime($property['created_at'])) ?>
        </p>
        <ul class="pull-right">
          <li><a href="<?= htmlspecialchars($property['video_url']) ?>" target="_blank"><i class="icon-video"></i></a></li>
          <li><a href="#."><i class="icon-like"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- #/RECENT PROPERTY -->


<!-- Image & Text-->
<section id="image-text" class="padding-bottom-top-120 parallaxie">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="image-text-heading top30 bottom30">
          <h2 class="bottom40">We Don't Just Find<br><span>Great Deals</span> We Create Them</h2>
          <a href="listing.php" class="link_arrow white_border top10">View All Listing</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Image & Text End-->


<!-- BEST DEALS -->
<section id="property-listing" class="padding">
  <div class="container">
    <div class="row">
      <div class="col-md-12 bottom40">
        <!-- <div class="line_1"></div>
        <div class="line_2"></div>
        <div class="line_3"></div> -->
      </div>
    </div>
    <div class="col-md-12">
      <div class="row">
        <div id="listing_slider" class="owl-carousel">

        </div>
      </div>
    </div>
  </div>
</section>
<!-- BEST DEALS -->







<!-- FOOTER -->
<?php include_once('./components/footer.php')?>
<!-- #/FOOTER -->


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

</html>