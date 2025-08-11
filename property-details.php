<?php
require_once('./include/Session.php');
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once("./include/Controller.php");
require_once('./include/Functions.php');

$Controller = new Controller();

$getRecentProperties = $Controller->getRecentProperties();
$getRecentPropertiesLimitTen = $Controller->getRecentPropertiesLimitTen();

if (isset($_GET['id']) && !empty($_GET['id'])) {
  $propertyId = $_GET['id'];
  $getPropertyById = $Controller->getPropertyById(propertyId: $propertyId);
  $propertyTitle = $getPropertyById[0]['property_title'];
  //   var_dump($getPropertyById);
  // die();
} else {
  redirect_to('listing.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <title>OFFERS NG | PROPERTY DETAILS </title>
  <link rel="stylesheet" type="text/css" href="css/master.css">
  <link rel="stylesheet" type="text/css" href="css/color/color-8.css" id="color" />
  <link rel="shortcut icon" href="images/favicon.ico">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
  .property_item .image img {
    max-width: 100%; 
    max-height: 400px; 
    object-fit: cover; 
    width: auto; 
    height: auto;
  }
</style>
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





  <!-- PROPERTY DETAILS -->
  <section class="property-details padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-uppercase"><?= $getPropertyById[0]['property_title'] ?></h2>
          <p class="bottom20"><?= $getPropertyById[0]['property_address'] ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-12">
              <div id="property-d-1" class="owl-carousel">
                <?php
                // Split the image files into an array
                $images = explode(',', $getPropertyById[0]['image_files']);

                foreach ($images as $image) {
                  echo '<div class="item"><img src="./uploads/property_images/' . htmlspecialchars(trim($image)) . '" alt="image" /></div>';
                }
                ?>
              </div>

              <div id="property-d-1-2" class="owl-carousel">
                <?php
                foreach ($images as $image) {
                  echo '<div class="item"><img src="./uploads/property_images/' . htmlspecialchars(trim($image)) . '" alt="image" /></div>';
                }
                ?>
              </div>


            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="property-tab">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
                  <li role="presentation"><a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">Summary</a></li>
                  <li role="presentation"><a href="#features" aria-controls="features" role="tab" data-toggle="tab">Features</a></li>
                  <li role="presentation"><a href="#tab_contact" aria-controls="tab_contact" role="tab" data-toggle="tab">Contact</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="description">
                    <h3 class="text-uppercase  bottom20 top10">Property <span class="color_red">Description</span></h3>
                    <p class="p-font-15"><?= $getPropertyById[0]['description'] ?></p>
                    <p class="p-font-15 top30 bottom30"></p>
                    <div class="property_meta bottom40">
                      <!-- <span><i class="fa fa-object-group"></i><?= $getPropertyById[0]['square_fit_min'] ?> sq ft </span> <span style="color: white width ">-</span> -->
                      <span><i class="fa fa-object-group"></i> <?= $getPropertyById[0]['square_fit_max'] ?> sq ft </span>
                      <span><i class="fa fa-bed"></i><?= $getPropertyById[0]['bed_room'] ?> Bedrooms</span>
                      <span><i class="fa fa-bath"></i><?= $getPropertyById[0]['bath_room'] ?> Bathroom</span>
                    </div>
                    <!-- <a class="link_arrow" href="#.">Read More</a> -->
                  </div>
                  <div role="tabpanel" class="tab-pane" id="summary">
                    <div class="row property-d-table">
                      <div class="col-md-12">
                        <h3 class="text-uppercase  bottom30 top10">Quick <span class="color_red">Summary</span></h3>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <table class="table table-striped table-responsive">
                          <tbody>

                            <tr>
                              <td><b>Price</b></td>
                              <td class="text-right"><i class="fa-solid fa-naira-sign" style="font-size: 15px;"></i><?= $getPropertyById[0]['price'] ?></td>
                            </tr>
                            <tr>
                              <td><b>Property Size</b></td>
                              <td class="text-right"><?= $getPropertyById[0]['square_fit_max'] ?> sq ft</td>
                            </tr>
                            <tr>
                              <td><b>Bedrooms</b></td>
                              <td class="text-right"><?= $getPropertyById[0]['bed_room'] ?></td>
                            </tr>
                            <tr>
                              <td><b>Bathrooms</b></td>
                              <td class="text-right"><?= $getPropertyById[0]['bath_room'] ?></td>
                            </tr>
                            <?php
                            $statusMapping = [
                              1 => 'For Sale',
                              2 => 'For Rent',
                              3 => 'Sold',
                              4 => 'Under Contract',
                              5 => 'Coming Soon',
                              6 => 'Off Market',
                            ];

                            // Get the mapped status
                            $propertyStatus = isset($statusMapping[$getPropertyById[0]['property_status']])
                              ? $statusMapping[$getPropertyById[0]['property_status']]
                              : 'Unknown'; // Default if status is not found
                            ?>

                            <tr>
                              <td><b>Status</b></td>
                              <td class="text-right"><?= htmlspecialchars($propertyStatus) ?></td>
                            </tr>

                            <tr>
                              <td><b>Available From</b></td>
                              <td class="text-right">
                                <?= htmlspecialchars((new DateTime($getPropertyById[0]['created_at']))->format('Y-m-d')) ?>
                              </td>

                            </tr>

                          </tbody>
                        </table>
                      </div>

                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="features">
                    <div class="row">
                      <div class="col-md-12">
                        <h3 class="text-uppercase  bottom30 top10">Property <span class="color_red">Features</span></h3>
                      </div>
                      <?php
                      // Example: $getPropertyById[0]['available_features'] is a comma-separated string of features
                      $features = explode(',', $getPropertyById[0]['available_features']); // Convert to array
                      $chunkedFeatures = array_chunk($features, 4); // Split the array into chunks of 4
                      ?>

                      <?php foreach ($chunkedFeatures as $featureSet): ?>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <ul class="pro-list">
                            <?php foreach ($featureSet as $feature): ?>
                              <li><?= htmlspecialchars(str_replace('_', ' ', trim($feature))) ?></li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      <?php endforeach; ?>

                    </div>
                  </div>

                  <div role="tabpanel" class="tab-pane" id="tab_contact">
                    <div class="row">
                      <div class="col-md-12">
                        <h3 class="text-uppercase bottom30 top10">Contact <span class="color_red">Agent</span></h3>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="agent-p-img">
                          <img src="./uploads/profile_images/<?= !empty($getPropertyById[0]['user_profile_image']) ? htmlspecialchars($getPropertyById[0]['user_profile_image']) : 'default_profile.png'; ?>"
                            class="img-responsive" alt="Profile Image" />
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="agent-p-contact">
                          <div class="our-agent-box">
                            <h3 class="bottom10">
                              <?= !empty($getPropertyById[0]['user_full_name']) ? htmlspecialchars($getPropertyById[0]['user_full_name']) : 'Corporate Agent'; ?>
                            </h3>
                            <p class="bottom30">
                              <?= !empty($getPropertyById[0]['user_about']) ? htmlspecialchars($getPropertyById[0]['user_about']) : 'No information available about the agent.'; ?>
                            </p>
                          </div>
                          <div class="agetn-contact">
                            <h6>Phone:</h6>
                            <h6>Email Address:</h6>
                          </div>
                          <div class="agetn-contact-2">
                            <p>
                              <?= !empty($getPropertyById[0]['user_phone']) ? htmlspecialchars($getPropertyById[0]['user_phone']) : 'Not available'; ?>
                            </p>
                            <p>
                              <?= !empty($getPropertyById[0]['user_email']) ? htmlspecialchars($getPropertyById[0]['user_email']) : 'Not available'; ?>
                            </p>
                          </div>
                        </div>
                        <ul class="socials">
                          <li>
                            <a href="<?= !empty($getPropertyById[0]['facebook_url']) ? htmlspecialchars($getPropertyById[0]['facebook_url']) : '#'; ?>" target="_blank">
                              <i class="fa-brands fa-facebook"></i>
                            </a>
                          </li>
                          <li>
                            <a href="<?= !empty($getPropertyById[0]['twitter_url']) ? htmlspecialchars($getPropertyById[0]['twitter_url']) : '#'; ?>" target="_blank">
                              <i class="fa-brands fa-twitter"></i>
                            </a>
                          </li>
                          <li>
                            <a href="<?= !empty($getPropertyById[0]['instagram_url']) ? htmlspecialchars($getPropertyById[0]['instagram_url']) : '#'; ?>" target="_blank">
                              <i class="fa-brands fa-instagram"></i>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>


                    <div class="row top30">
                      <div class="col-xs-12">
                        <form class="findus">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="single-query">
                                <input type="text" placeholder="Your Name" class="keyword-input">
                              </div>
                              <div class="single-query">
                                <input type="text" placeholder="Phone Number" class="keyword-input">
                              </div>
                              <div class="single-query">
                                <input type="text" placeholder="Email Adress" class="keyword-input">
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="single-query">
                                <textarea placeholder="Message"></textarea>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <input type="submit" value="Submit Now" class="btn_fill">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <?php
// Define the base URL of your website
$baseUrl = "https://offersng.com/property-details.php";

// Get the property ID (ensure it's fetched properly, e.g., from $getPropertyById)
$propertyId = $getPropertyById[0]['property_id'] ?? 0;

// Construct the property URL
$propertyUrl = $baseUrl . "?id=" . $propertyId;
?>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="social-networks top40">
                        <div class="social-icons-2">
    <span class="share-it">Share: </span>
    <span>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($propertyUrl) ?>" target="_blank">
            Facebook
        </a>
    </span>
    <span>
        <a href="https://twitter.com/intent/tweet?text=<?= urlencode($propertyTitle . ' - ' . $propertyUrl) ?>" target="_blank">
            Twitter
        </a>
    </span>
    <span>
        <button class="btn btn-link" onclick="copyToClipboard()">Copy Link</button>
        <input type="text" id="propertyUrlInput" value="<?= $propertyUrl ?>" readonly style="display:none; width: 0;">
    </span>
</div>

<script>
function copyToClipboard() {
    const input = document.getElementById("propertyUrlInput");
    input.style.display = "block"; // Temporarily make the input visible
    input.style.width = "1px";     // Ensure it's still hidden visually
    input.select();                // Select the text in the input
    document.execCommand("copy");  // Copy the selected text
    input.style.display = "none";  // Hide the input again
    alert("Property URL copied to clipboard!");
}
</script>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="property-query-area">
            <div class="row">
              <div class="col-md-12">
                <h3 class="text-uppercase  bottom40">Advance <span class="color_red">Search</span></h3>
              </div>
            </div>
            <div class="row">
              <form class="findus">
                <div class="col-md-12">
                  <div class="single-query">
                    <input type="text" class="keyword-input" placeholder="Keyword (e.g. 'office')">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="single-query">
                    <select class="selectpicker" data-live-search="true">
                      <option selected="" value="any">Location</option>
                      <option>Location - 1</option>
                      <option>Location - 2</option>
                      <option>Location - 3</option>
                      <option>Location - 4</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="single-query">
                    <select class="selectpicker" data-live-search="true">
                      <option class="active">Property Type</option>
                      <option>Property Type - 1</option>
                      <option>Property Type - 2</option>
                      <option>Property Type - 3</option>
                      <option>Property Type - 4</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="single-query">
                    <select class="selectpicker" data-live-search="true">
                      <option class="active">Property Status</option>
                      <option>Property Status - 1</option>
                      <option>Property Status - 2</option>
                      <option>Property Status - 3</option>
                      <option>Property Status - 4</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="row search-2">
              <form action="#">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="single-query">
                        <select class="selectpicker" data-live-search="true">
                          <option class="active">Min Beds</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="single-query">
                        <select class="selectpicker" data-live-search="true">
                          <option class="active">Min Baths</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="single-query">
                        <input type="text" class="keyword-input" placeholder="Min Area (sq ft)">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="single-query">
                        <input type="text" class="keyword-input" placeholder="Max Area (sq ft)">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="single-query-slider">
                    <label>Price Range:</label>
                    <div class="price text-right">
                      <span>$</span>
                      <div class="leftLabel"></div>
                      <span>to $</span>
                      <div class="rightLabel"></div>
                    </div>
                    <div data-range_min="0" data-range_max="1500000" data-cur_min="0" data-cur_max="1500000" class="nstSlider">
                      <div class="bar"></div>
                      <div class="leftGrip"></div>
                      <div class="rightGrip"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 text-center  top30">
                  <div class="query-submit-button">
                    <button type="submit" class="btn_fill black">Search</button>
                  </div>
                </div>
                <div class="col-md-6 text-center">
                  <div class="group-button-search">
                    <a data-toggle="collapse" href=".html" class="more-filter">
                      <i class="fa fa-plus text-1 bg-color-yello" aria-hidden="true"></i> <i class="fa fa-minus text-2 hide bg-color-yello" aria-hidden="true"></i>
                      <div class="text-1">more options</div>
                      <div class="text-2 hide">more options</div>
                    </a>
                  </div>
                </div>
              </form>
            </div>
            <div class="search-propertie-filters collapse">
              <div class="container-2">
                <div class="row">
                  <div class="col-md-6">
                    <div class="search-form-group white">
                      <input type="checkbox" name="check-box" />
                      <span>Washer and Dryer</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="search-form-group white">
                      <input type="checkbox" name="check-box" />
                      <span>Balcony</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="search-form-group white">
                      <input type="checkbox" name="check-box" />
                      <span>Storage</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="search-form-group white">
                      <input type="checkbox" name="check-box" />
                      <span>Balcony</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="search-form-group white">
                      <input type="checkbox" name="check-box" />
                      <span>Storage</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="search-form-group white">
                      <input type="checkbox" name="check-box" />
                      <span>Balcony</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h3 class="text-uppercase  bottom40 top40">Recent <span class="color_red">Properties</span></h3>
              <?php
              foreach ($getRecentProperties as $recentProperty) {
                // Extract the first image from the comma-separated list
                $imagesArray = explode(',', $recentProperty['images']);
                $firstImage = trim($imagesArray[0]); // Get the first image and trim any extra spaces
              ?>
                <div class="media">
                  <div class="media-left media-middle">
                    <a href="#.">
                      <img class="media-object" src="./uploads/property_images/<?= htmlspecialchars($firstImage) ?>"
                        alt="image"
                        style="max-width: 150px; height: auto; object-fit: cover; border-radius: 5px;">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading"><a href="#."><?= htmlspecialchars($recentProperty['property_title']) ?></a></h4>
                    <p><?= htmlspecialchars($recentProperty['property_address']) ?></p>
                    <a href="#."><i class="fa-solid fa-naira-sign" style="font-size: 17px;"></i><?= number_format($recentProperty['price'], 2) ?></a>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </div>

        </div>
      </div>
    </div>
    </div>
  </section>
  
  
  <section id="agent-p-2" class="property-details padding">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 bottom40">
          <h2 class="text-uppercase">Similar <span class="color_red">Properties </span></h2>
          <div class="line_1"></div>
          <div class="line_2"></div>
          <div class="line_3"></div>
        </div>
      </div>
      <div class="row">
        <div id="property-1-slider" class="owl-carousel">
        <?php foreach ($getRecentPropertiesLimitTen as $property): ?>
<div class="item">
  <div class="property_item heading_space">
    <div class="image">
      <!-- Dynamic Property Image -->
      <img src="uploads/property_images/<?= explode(',', $property['images'])[0] ?>" 
           alt="<?= htmlspecialchars($property['property_title']) ?>" 
           class="img-responsive">
      <div class="overlay">
        <div class="centered">
          <a class="link_arrow white_border" href="property-details.php?id=<?= $property['id'] ?>">View Detail</a>
        </div>
      </div>
      <div class="feature"><span class="tag">Featured</span></div>

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

      <div class="property_meta">
        <span><i class="fa fa-object-group"></i><?= $property['square_fit_min'] ?> - <?= $property['square_fit_max'] ?> sq ft</span>
        <span><i class="fa fa-bed"></i><?= $property['bed_room'] ?> Bedroom<?= $property['bed_room'] > 1 ? 's' : '' ?></span>
        <span><i class="fa fa-bath"></i><?= $property['bath_room'] ?> Bathroom<?= $property['bath_room'] > 1 ? 's' : '' ?></span>
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
        <p class="pull-left">
          <i class="icon-calendar2"></i> <?= date('F j, Y', strtotime($property['created_at'])) ?>
        </p>
        <ul class="pull-right">
          <li>
            <a href="<?= htmlspecialchars($property['video_url']) ?>" target="_blank">
              <i class="icon-video"></i>
            </a>
          </li>
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
  </section>
  <!-- PROPERTY DETAILS -->



  <!--===== FOOTER =====-->
  <?php include_once('./components/footer.php') ?>
  <!--===== #/FOOTER =====-->


  <!-- Modal -->
  <?php include_once('./components/message_modal.php') ?>
  <!-- #/Modal -->

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6749dbcb2480f5b4f5a5ccae/1ids855sf';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

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

  <!--Maps & Markers-->
  <script src="js/form.js"></script>
  <script src="js/custom-map.js"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAOBKD6V47-g_3opmidcmFapb3kSNAR70U"></script>
  <script src="js/gmaps.js"></script>
  <script src="js/contact.js"></script>
  <!--===== #/REQUIRED JS =====-->

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

</body>

<!-- Mirrored from logicsforest.com/themeforest/idea-homes/ideahomes_demo_files/property-details-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Nov 2024 10:52:01 GMT -->

</html>