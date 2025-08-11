<?php 
require_once('./include/Session.php');
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once("./include/Controller.php");
require_once('./include/Functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>OFFERS NG | ABOUT US </title>
<link rel="stylesheet" type="text/css" href="css/master.css">
<link rel="stylesheet" type="text/css" href="css/color/color-8.css" id="color" />
<link rel="shortcut icon" href="images/favicon.ico">

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


<!--===== PAGE TITLE =====-->
<div class="page-title page-main-section parallaxie">
  <div class="container padding-bottom-top-120 text-uppercase text-center">
    <div class="main-title">
      <h1>about us</h1>
      <h5>10 Years Of Experience!</h5>
      <div class="line_4"></div>
      <div class="line_5"></div>
      <div class="line_6"></div>
      <a href="index.html">home</a><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><a href="about.html">about us</a> 
    </div>
  </div>
</div>
<!--===== #/PAGE TITLE =====-->


<!--===== ABOUT US =====-->
<section id="about_us" class="about-us padding">
  <div class="container">
    <div class="row">
      <div class="history-section">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <h2 class="text-uppercase">Company <span class="color_red">overview</span></h2>
          <div class="line_1"></div>
          <div class="line_2"></div>
          <div class="line_3"></div>
          <p class="top20 bottom40">OFFERS NG connects buyers and sellers with their perfect property. We deliver trusted expertise and results-driven service to make buying, selling, or renting seamless and successful. With a focus on residential and commercial properties, we turn real estate dreams into reality—backed 
            by market insights, cutting-edge marketing, and personalized guidance every step of the way.</p>
          <a class="link_arrow dark_border top40" href="about.html">Read More</a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div id="about_single" class="owl-carousel">
            <div class="item">
              <div class="content-right-md">
                <figure class="effect-layla">
                  <img src="images/about-2.jpg" alt="img"/>
                  <figcaption> </figcaption>
                </figure>
              </div>
            </div>
            <div class="item">
              <div class="content-right-md">
                <figure class="effect-layla">
                  <img src="images/about-1.jpg" alt="img"/>
                  <figcaption> </figcaption>
                </figure>
              </div>
            </div>
            <div class="item">
              <div class="content-right-md">
                <figure class="effect-layla">
                  <img src="images/about-2.jpg" alt="img"/>
                  <figcaption> </figcaption>
                </figure>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--===== #/ABOUT US =====-->


<!--===== WHO WE ARE =====-->
<section id="we_are">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12 skills margin_bottom">
        <ul>
          <li>
            <p class="pull-left">Property Investment</p>
            <p class="pull-right"> 100%</p>
            <div class="clearfix"></div>
          </li>
          <li class="progress bottom30 top10">
            <div class="progress-bar" data-width="95"> </div>
          </li>
          <li>
            <p class="pull-left">Luxury Homes</p>
            <p class="pull-right"> 100%</p>
            <div class="clearfix"></div>
          </li>
          <li class="progress bottom30 top10">
            <div class="progress-bar" data-width="78"> </div>
          </li>
          <li>
            <p class="pull-left">Real Estate Listings</p>
            <p class="pull-right"> 100%</p>
            <div class="clearfix"></div>
          </li>
          <li class="progress bottom30 top10">
            <div class="progress-bar" data-width="70"> </div>
          </li>
          <li>
            <p class="pull-left">Market Trends</p>
            <p class="pull-right"> 100%</p>
            <div class="clearfix"></div>
          </li>
          <li class="progress top10">
            <div class="progress-bar" data-width="85"> </div>
          </li>
        </ul>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <h2 class="text-uppercase">who we  <span class="color_red">are</span></h2>
        <div class="line_1"></div>
        <div class="line_2"></div>
        <div class="line_3"></div>
        <p class="top40 bottom30">
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto 
        </p>
        <p>sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores. Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
      </div>
    </div>
  </div>
</section>
<!--===== #/WHO WE ARE =====-->


<!--===== TEAM  =====-->
<section class=" padding_bottom" id="teams">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-uppercase">Our <span class="color_red">experts</span></h2>
        <div class="line_1"></div>
        <div class="line_2"></div>
        <div class="line_3"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <div class="team-member top40 text-center">
          <div class="team-img">
            <img src="images/t-s-1.jpg" alt="">
          </div>
          <div class="team-hover">
            <div class="desk">
              <h4 class="bottom10">I love to desing</h4>
              <p>I love to introduce myself as a hardcore Web Designer.</p>
            </div>
            <div class="s-link">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-google-plus"></i></a>
            </div>
          </div>
        </div>
        <div class="team-title top20 text-center">
          <h3>Martin Smith</h3>
          <span>Founder & CEO</span>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="team-member top40 text-center">
          <div class="team-img">
            <img src="images/t-s-2.jpg" alt="">
          </div>
          <div class="team-hover">
            <div class="desk">
              <h4 class="bottom10">I love to desing</h4>
              <p>I love to introduce myself as a hardcore Web Designer.</p>
            </div>
            <div class="s-link">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-google-plus"></i></a>
            </div>
          </div>
        </div>
        <div class="team-title top20 text-center">
          <h3>Franklin Harbet</h3>
          <span>Civil Engineer</span>
        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="team-member top40 text-center">
          <div class="team-img">
            <img src="images/t-s-3.jpg" alt="">
          </div>
          <div class="team-hover">
            <div class="desk">
              <h4 class="bottom10">I love to desing</h4>
              <p>I love to introduce myself as a hardcore Web Designer.</p>
            </div>
            <div class="s-link">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-google-plus"></i></a>
            </div>
          </div>
        </div>
        <div class="team-title top20 text-center">
          <h3>Linda Anderson</h3>
          <span>Marketing Manager</span>
        </div>
      </div>
    </div>
  </div>
</section>
<!--===== #/TEAM  =====-->


<!--===== IMAGE WITH CONTENT =====-->
<section class="info_section parallaxie">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 col-sm-4"> </div>
      <div class="col-md-4 col-sm-4 right_box">
        <div class="right_box_inner padding clearfix">
          <div class="col-md-12 col-sm-12 white_content text-center top20 bottom30">
            <i class="icon-library"></i>
            <h3 class="bottom10 top20">Residential</h3>
            <p>Duis autem vel eum iriure dolor in hend rerit in vulputate velit esse molestie vel illum dolore nulla facilisis.</p>
          </div>
          <div class="col-md-12 col-sm-12 white_content text-center top20 bottom30">
            <i class="icon-history"></i>
            <h3 class="bottom10 top20">24 Hours Services</h3>
            <p>Duis autem vel eum iriure dolor in hend rerit in vulputate velit esse molestie vel illum dolore nulla facilisis.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4"> </div>
    </div>
  </div>
</section>
<!--===== #/IMAGE WITH CONTENT =====--> 


<!--===== WHAT WE DO =====--> 
<section id="our-services" class="we_are bg_light padding">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-uppercase">What We <span class="color_red">Do</span></h2>
        <div class="line_1"></div>
        <div class="line_2"></div>
        <div class="line_3"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4 top40">
        <div class="feature_box equal-height">
          <span class="icon"> <i class="icon-select-an-objecto-tool"></i></span>
          <div class="description">
            <h4>Wide Range of Properties</h4>
            <p>Aliquam gravida magna et fringilla convallis. Pellentesque habitant morbi </p>
            <a href="showcase_property.html" class="link_arrow top20">Read More</a> 
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 top40">
        <div class="feature_box equal-height">
          <span class="icon"><i class="icon-user-tie"></i></span>
          <div class="description">
            <h4>14 Agents for Your Service</h4>
            <p>Aliquam gravida magna et fringilla convallis. Pellentesque habitant morbi </p>
            <a href="showcase_property.html" class="link_arrow top20">Read More</a> 
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 top40">
        <div class="feature_box equal-height">
          <span class="icon"><i class="fa fa-money"></i></span>
          <div class="description">
            <h4>Best Price Guarantee!</h4>
            <p>Aliquam gravida magna et fringilla convallis. Pellentesque habitant morbi </p>
            <a href="showcase_property.html" class="link_arrow top20">Read More</a> 
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4 top40">
        <div class="feature_box equal-height">
          <span class="icon"> <i class="icon-select-an-objecto-tool"></i></span>
          <div class="description">
            <h4>Wide Range of Properties</h4>
            <p>Aliquam gravida magna et fringilla convallis. Pellentesque habitant morbi </p>
            <a href="showcase_property.html" class="link_arrow top20">Read More</a> 
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 top40">
        <div class="feature_box equal-height">
          <span class="icon"><i class="icon-user-tie"></i></span>
          <div class="description">
            <h4>14 Agents for Your Service</h4>
            <p>Aliquam gravida magna et fringilla convallis. Pellentesque habitant morbi </p>
            <a href="showcase_property.html" class="link_arrow top20">Read More</a> 
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 top40">
        <div class="feature_box equal-height">
          <span class="icon"><i class="fa fa-money"></i></span>
          <div class="description">
            <h4>Best Price Guarantee!</h4>
            <p>Aliquam gravida magna et fringilla convallis. Pellentesque habitant morbi </p>
            <a href="showcase_property.html" class="link_arrow top20">Read More</a> 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--===== #/WHAT WE DO =====--> 


<!--===== OUR PARTNER =====-->
<div id="our-partner">
  <div class="container-fluid">
    <div id="partner_slider" class="owl-carousel">
      <div class="item"><img src="images/partner-1.png" alt="Our Partner"></div>
      <div class="item"><img src="images/partner-2.png" alt="Our Partner"></div>
      <div class="item"><img src="images/partner-3.png" alt="Our Partner"></div>
      <div class="item"><img src="images/partner-4.png" alt="Our Partner"></div>
      <div class="item"><img src="images/partner-5.png" alt="Our Partner"></div>
      <div class="item"><img src="images/partner-1.png" alt="Our Partner"></div>
      <div class="item"><img src="images/partner-2.png" alt="Our Partner"></div>
      <div class="item"><img src="images/partner-3.png" alt="Our Partner"></div>
      <div class="item"><img src="images/partner-4.png" alt="Our Partner"></div>
      <div class="item"><img src="images/partner-5.png" alt="Our Partner"></div>
    </div>
  </div>
</div>
<!--===== #/OUR PARTNER =====--> 


<!--===== CONTACT =====-->
<section id="contact" class="bg-color-red">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-12 text-center">
        <div class="get-tuch">
          <i class="icon-telephone114"></i>
          <ul>
            <li>
              <h4 class="p-font-17">Phone Number</h4>
            </li>
            <li>
              <p class="p-font-15">+1 900 234 567 - 68</p>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 text-center">
        <div class="get-tuch">
          <i class="icon-icons74"></i>
          <ul>
            <li>
              <h4 class="p-font-17">Victoria Hall,</h4>
            </li>
            <li>
              <p class="p-font-15">idea homes, australia</p>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12 text-center">
        <div class="get-tuch">
          <i class=" icon-icons142"></i>
          <ul>
            <li>
              <h4 class="p-font-17">Email Address</h4>
            </li>
            <li>
              <a href="#"><p class="p-font-15">info@Idea-Homes.com</p></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!--===== #/CONTACT =====--> 


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

<!-- Mirrored from logicsforest.com/themeforest/idea-homes/ideahomes_demo_files/about.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Nov 2024 10:51:48 GMT -->
</html>

h