<?php
// listing.php
require_once('./include/Session.php');
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once("./include/Controller.php");
require_once('./include/Functions.php');

// Initialize Controller
$Controller = new Controller();
$getStates = $Controller->getStates();

$property_types = $Controller->property_types();

$property_status = $Controller->property_status();

$getRecentProperties = $Controller->getRecentProperties();
// var_dump($getRecentProperties);
// die();
// Pagination variables
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$propertiesPerPage = 4;
$offset = ($currentPage - 1) * $propertiesPerPage;

// Fetch total properties count
$totalProperties = $Controller->getTotalProperties();

// Calculate total pages
$totalPages = ceil($totalProperties / $propertiesPerPage);

// Fetch properties for the current page
$properties = $Controller->getAllProperties($offset, $propertiesPerPage);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <title>OFFERS NG | LISTING</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <link rel="stylesheet" type="text/css" href="css/master.css">
  <link rel="stylesheet" type="text/css" href="css/color/color-8.css" id="color" />
  <link rel="shortcut icon" href="images/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Magnific Popup CSS -->
  <!-- CSS to Adjust Popup Size -->
  <style>
    .mfp-content {
      max-width: 800px;
      /* Set max width for popup */
      margin: 0 auto;
      /* Center the popup */
    }

    .popup-wrapper {
      width: 100%;
      max-width: 100%;
      overflow: hidden;
    }

    iframe,
    video {
      width: 100%;
      border-radius: 8px;
      /* Optional: Add rounded corners for a better design */
    }

    .mfp-video-wrapper {
      max-width: 800px;
      margin: 0 auto;
    }
  </style>
</head>

<body>

  <!-- LOADER -->
  <div class="loader">
    <div class="cssload-thecube">
      <div class="cssload-cube cssload-c1"></div>
      <div class="cssload-cube cssload-c2"></div>
      <div class="cssload-cube cssload-c4"></div>
      <div class="cssload-cube cssload-c3"></div>
    </div>
  </div>
  <!-- LOADER -->

  <!--===== BACK TO TOP =====-->
  <div class="short-msg">
    <a href="#." class="back-to"><i class="icon-arrow-up2"></i></a>
    <a href="#." class="short-topup" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
  </div>
  <!--===== #/BACK TO TOP =====-->


  <!--===== HEADER =====-->
  <?php include_once('./components/header.php') ?>

  <!--===== #/HEADER =====-->





  <!-- LISTING STYLE-->
  <section id="agent-p-2" class="listing-1 bg_light padding_top">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="uppercase">PROPERTY <span class="color_red">LISTINGS</span></h2>
          <div class="line_1"></div>
          <div class="line_2"></div>
          <div class="line_3"></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
          <form class="findus">
            <div class="row bottom30">
              <div class="col-md-12">
                <div class="single-query">
                  <!-- <select class="selectpicker" data-live-search="true">
                    <option class="active">Default Order</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                  </select> -->
                </div>
              </div>
            </div>
            <div id="property-list" class="row ">

            </div>

            <!-- Pagination -->
            <ul class="pager top40 padding_bottom" id="pagination">
              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li>
                  <a href="#" data-page="<?= $i ?>" <?= ($i === $currentPage) ? 'class="active"' : '' ?>><?= $i ?></a>
                </li>
              <?php endfor; ?>
            </ul>


          </form>
        </div>
        <div class="col-md-4 colsm-4 col-xs-12">


          <div class="property-query-area padding-all20">
            <div class="row">
              <div class="col-md-12">
                <h3 class="text-uppercase bottom40 top10">Advance <span class="color_red">Search</span></h3>
              </div>
            </div>
            <form class="findus" id="advanced-search-form">
              <div class="row">
                <div class="col-md-12">
                  <div class="single-query">
                    <input type="text" name="keyword" class="keyword-input" placeholder="Keyword (e.g. 'office')">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="single-query">
                    <input type="text" name="property_address" class="keyword-input" placeholder="Property Address (e.g. 'ikeja')">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="single-query">
                    <select name="location" class="selectpicker" data-live-search="true">
                      <option value="">Location</option>
                      <?php foreach ($getStates as $state): ?>
                        <option value="<?php echo htmlspecialchars($state['id']); ?>">
                          <?php echo htmlspecialchars($state['state_name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="single-query">
                    <select name="property_type" class="selectpicker" data-live-search="true">
                      <option value="">Property Type</option>
                      <?php foreach ($property_types as $property): ?>
                        <option value="<?php echo htmlspecialchars($property['id']); ?>">
                          <?php echo htmlspecialchars($property['property_type']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="single-query">
                    <select name="property_status" class="selectpicker" data-live-search="true">
                      <option value="">Property Status</option>
                      <?php foreach ($property_status as $prop_stat): ?>
                        <option value="<?php echo htmlspecialchars($prop_stat['status_id']); ?>">
                          <?php echo htmlspecialchars($prop_stat['status_name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row search-2">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="single-query">
                        <select name="min_beds" class="selectpicker" data-live-search="true">
                          <option value="">Min Beds</option>
                          <?php for ($i = 1; $i <= 6; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php endfor; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="single-query">
                        <select name="min_baths" class="selectpicker" data-live-search="true">
                          <option value="">Min Baths</option>
                          <?php for ($i = 1; $i <= 6; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php endfor; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="single-query">
                        <input type="number" name="min_area" class="keyword-input" placeholder="Min Area (sq ft)">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="single-query">
                        <input type="number" name="max_area" class="keyword-input" placeholder="Max Area (sq ft)">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="single-query">
                        <span><i class="fa-solid fa-naira-sign" style="font-size: 17px;"></i></span>
                        <input type="number" name="min_price" placeholder="Min Price">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="single-query">
                        <span>to <i class="fa-solid fa-naira-sign" style="font-size: 17px;"></i></span>
                        <input type="number" name="max_price" placeholder="Max Price">
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-md-6 text-center">
                  <div class="query-submit-button top30">
                    <button type="submit" class="btn_fill" id="advanced-search">Search</button>
                  </div>
                </div>
              </div>
            </form>
          </div>


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
  </section>
  <!-- LISTING -->



  <!--===== FOOTER =====-->
  <?php include_once('./components/footer.php') ?>
  <!--===== #/FOOTER =====-->


  <!-- Modal -->
  <?php include_once('./components/message_modal.php') ?>
  <!-- #/Modal -->



  <!--===== REQUIRED JS =====-->

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const paginationLinks = document.querySelectorAll('#pagination a');
      const propertyList = document.querySelector('#property-list');

      function loadProperties(page) {
        fetch(`fetch_properties.php?page=${page}`)
          .then(response => {
            if (!response.ok) {
              throw new Error('Failed to fetch properties');
            }
            return response.text();
          })
          .then(html => {
            // Update property list content
            propertyList.innerHTML = html;

            // Update active class on pagination links
            paginationLinks.forEach(link => link.classList.remove('active'));
            document.querySelector(`#pagination a[data-page="${page}"]`).classList.add('active');
          })
          .catch(error => console.error('Error:', error));
      }

      paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const page = this.dataset.page;
          loadProperties(page);
        });
      });

      // Load properties for the first page initially
      loadProperties(1);
    });
  </script>




  <script>
    document.getElementById('advanced-search').addEventListener('click', function(e) {
      e.preventDefault();

      const form = document.getElementById('advanced-search-form');
      const formData = new FormData(form);

      // Collect data
      const data = {};
      formData.forEach((value, key) => {
        if (value.trim() !== '') {
          data[key] = value;
        }
      });

      // Convert to query string
      const params = new URLSearchParams(data).toString();

      // Fetch request
      fetch('advancedsearch.php?' + params)
        .then(response => response.json())
        .then(result => {
          if (result.status === 'success') {
            renderProperties(result.data, result.pagination);
          } else {
            console.error('Error:', result.message);
          }
        })
        .catch(error => console.error('Fetch Error:', error));
    });

    // Render function
    function renderProperties(data, pagination) {
      const propertyListContainer = document.getElementById('property-list');
      propertyListContainer.innerHTML = ''; // Clear previous results

      const statusMap = {
        "1": "For Sale",
        "2": "For Rent",
        "3": "Sold",
        "4": "Under Contract",
        "5": "Coming Soon",
        "6": "Off Market",
      };

      function timeAgo(createdAt) {
        const now = new Date();
        const createdDate = new Date(createdAt);
        const diff = Math.floor((now - createdDate) / (1000 * 60 * 60 * 24));
        return diff === 0 ? "Today" : `${diff} days ago`;
      }

      data.forEach((property) => {
        const propertyDiv = document.createElement('div');
        propertyDiv.className = 'col-md-6 col-sm-6';

        propertyDiv.innerHTML = `
                <div class="property_item heading_space">
                    <div class="image">
                        <img src="./uploads/property_images/${property.images[0]}" 
                             alt="listing" class="img-responsive" style="max-height: 250px; object-fit: cover;">
                        <div class="overlay">
                            <div class="centered">
                                <a class="link_arrow white_border" href="property-details.php?id=${property.id}">View Detail</a>
                            </div>
                        </div>
                        <div class="feature">
                            <span class="tag">${statusMap[property.property_status] || 'Unknown'}</span>
                        </div>
                        <div class="property_meta">
                            <span><i class="fa fa-object-group"></i>${property.square_fit_min} - ${property.square_fit_max} sq ft</span>
                            <span><i class="fa fa-bed"></i>${property.bed_room}</span>
                            <span><i class="fa fa-bath"></i>${property.bath_room} Bathroom</span>
                        </div>
                    </div>
                    <div class="proerty_content">
                        <div class="proerty_text">
                            <h3>
                                <a href="property_details_${property.id}.html">${property.property_title}</a>
                            </h3>
                            <span class="bottom10">${property.property_address}</span>
                            <p><strong><i class="fa-solid fa-naira-sign" style="font-size: 17px;"></i>
                            ${Number(property.price).toLocaleString()}</strong></p>
                        </div>
                        <div class="favroute clearfix">
                            <p class="pull-left"><i class="icon-calendar2"></i> ${timeAgo(property.created_at)}</p>
                            <ul class="pull-right">
                                <li><a href="${property.video_url}" class="popup-video"><i class="icon-video"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            `;

        propertyListContainer.appendChild(propertyDiv);
      });

      // Optional: Handle pagination if needed
      if (pagination) {
        console.log('Pagination:', pagination);
        // Implement pagination logic here if provided by the API
      }
    }
  </script>
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


  <!-- Magnific Popup JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
  <script>
    $(document).ready(function() {
      $(document).on('click', '.popup-video', function(e) {
        e.preventDefault(); // Prevent default link behavior

        const videoUrl = $(this).attr('href');
        let popupContent = '';

        // Check the type of video URL
        if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
          // YouTube Embed
          const youtubeId = videoUrl.match(/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|embed|shorts|e)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
          popupContent = youtubeId ?
            `<iframe width="100%" height="400" src="https://www.youtube.com/embed/${youtubeId[1]}?autoplay=1" frameborder="0" allowfullscreen></iframe>` :
            '<p>Invalid YouTube URL</p>';
        } else if (videoUrl.includes('vimeo.com')) {
          // Vimeo Embed
          const vimeoId = videoUrl.match(/(?:https?:\/\/)?(?:www\.)?vimeo\.com\/(\d+)/);
          popupContent = vimeoId ?
            `<iframe width="100%" height="400" src="https://player.vimeo.com/video/${vimeoId[1]}?autoplay=1" frameborder="0" allowfullscreen></iframe>` :
            '<p>Invalid Vimeo URL</p>';
        } else if (videoUrl.match(/\.(mp4|webm|ogg)$/i)) {
          // Direct Video URL (MP4, WebM, etc.)
          popupContent = `
                    <video controls autoplay style="width: 100%; height: auto;">
                        <source src="${videoUrl}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>`;
        } else {
          popupContent = '<p>Unsupported video format.</p>';
        }

        // Open Magnific Popup
        $.magnificPopup.open({
          items: {
            src: `<div class="mfp-video-wrapper">${popupContent}</div>`,
          },
          type: 'inline',
          closeBtnInside: true,
          callbacks: {
            close: function() {
              $.magnificPopup.instance.content.empty(); // Cleanup content on close
            },
          },
        });
      });
    });
  </script>


</body>

</html>