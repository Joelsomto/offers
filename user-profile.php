<?php
ob_start();
require_once('./include/Session.php');
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once("./include/Controller.php");
require_once('./include/Functions.php');

$Controller = new Controller();

$dbConnection = new DbConnection();
$conn = $dbConnection->getConnection();

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Sanitize and validate input
  $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session during login
  $first_name = htmlspecialchars(trim($_POST['first_name']));
  $last_name = htmlspecialchars(trim($_POST['last_name']));
  $phone_no = htmlspecialchars(trim($_POST['phone_no']));
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $about = htmlspecialchars(trim($_POST['about']));

  // Validate required fields
  if (empty($first_name) || empty($last_name) || empty($email)) {
    echo 'Error: First Name, Last Name, and Email are required.';
    exit;
  }

  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Error: Invalid email format.';
    exit;
  }

  try {
    // Call the controller's update method
    $response = $Controller->updateprofile($user_id, $first_name, $last_name, $phone_no, $email, $about);

    // Output just the response message
    echo $response['message'];
    exit;
  } catch (Exception $e) {
    // Catch unexpected errors and return the error message
    echo 'Error: An unexpected error occurred: ' . $e->getMessage();
    exit;
  }
}



?>
<?php
$getUserById = $Controller->getUserById($user_id);




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <title>OFFERS NG | USER PROFILE </title>
  <link rel="stylesheet" type="text/css" href="css/master.css">
  <link rel="stylesheet" type="text/css" href="css/color/color-8.css" id="color" />
  <link rel="shortcut icon" href="images/favicon.ico">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.19/dist/sweetalert2.min.css">


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





  <!--===== PROFILE =====-->
  <section id="agent-2-peperty" class="profile padding ">
    <?php
    echo errorMsg();
    echo successMsg();
    echo infoMsg();
    ?>

    <!-- <div class='alert alert-success' role='alert'>
                    <strong>Success:</strong> $message
                              </div> -->
    <div class="container-3">

      <div class="row">

        <div class="col-md-4 col-sm-6 col-xs-12">
          <h2 class="text-uppercase">my profile</h2>
          <div class="agent-p-img">
            <img id="profile-preview"
              src="<?= !empty($getUserById[0]['profile_image']) ? 'uploads/profile_images/' . $getUserById[0]['profile_image'] : 'images/profile.png' ?>"
              class="img-responsive"
              alt="Profile Image" />



            <form id="profile-image-form" method="post" enctype="multipart/form-data">
              <label for="profile-image-input" style="cursor: pointer;">Click Here to Upload</label>
              <input type="file" id="profile-image-input" name="profile_image" accept="image/*" style="display: none;" />
              <button type="submit" id="update-profile-image" class="btn btn-primary">Update Profile Picture</button>
            </form>
            <p>Minimum 215px x 215px<span>*</span></p>
          </div>

          <!-- <div class="agent-p-img">
            <img src="images/profile.png" class="img-responsive" alt="image" />
            <a href="#">Update Profile Picture</a>
            <p>Minimum 215px x 215px<span>*</span></p>

          </div> -->

          <!-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        More Options
      </button> -->

        </div>

        <div class="col-md-8">

          <div class="agent-p-form">

            <div class="row">

              <form action="#">
                <div class="col-md-12 clearfix">
                  <div class="single-query">
                    <label>First Name:</label>
                    <input type="text" value="<?= $getUserById[0]['first_name'] ?>" name="first_name" placeholder="John" class="keyword-input">
                  </div>
                </div>
                <div class="col-md-12 clearfix">
                  <div class="single-query">
                    <label>Last Name:</label>
                    <input type="text" value="<?= $getUserById[0]['last_name'] ?>" name="last_name" placeholder="Doe" class="keyword-input">
                  </div>
                </div>

                <div class="col-md-12 clearfix">
                  <div class="single-query">
                    <label>Phone No.:</label>
                    <input type="text" value="<?= $getUserById[0]['phone_no'] ?>" name="phone_no" class="keyword-input">
                  </div>
                </div>



                <div class="col-md-12 clearfix">
                  <div class="single-query">
                    <label>Email Adress:</label>
                    <input type="text" value="<?= $getUserById[0]['email'] ?>" name="email" placeholder="" class="keyword-input">
                  </div>
                </div>



                <div class="col-md-12 clearfix">
                  <div class="single-query">
                    <label>About:</label>
                    <textarea name="about"><?= htmlspecialchars($getUserById[0]['about']) ?></textarea>

                  </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                  <div class="query-submit-button">
                    <input type="submit" class="btn_fill" id="update_profile" value="Update Profile">
                  </div>
                </div>
              </form>

            </div>

          </div>

        </div>

        <div class="col-md-12 text-center">
          <ul class="socials">
            <?php
            function ensureHttps($url)
            {
              if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
              }
              return 'https://' . $url;
            }
            ?>
            <li><a href="<?= ensureHttps($getUserById[0]['facebook_url']) ?>"><i class="fa fa-facebook"></i></a></li>
            <li><a href="<?= ensureHttps($getUserById[0]['twitter_url']) ?>"><i class="fa fa-twitter"></i></a></li>
            <li><a href="<?= ensureHttps($getUserById[0]['instagram_url']) ?>"><i class="fa fa-instagram"></i></a></li>

          </ul>
        </div>
      </div>

    </div>



    <div class="container">



      <div class="row">
        <!-- <div class="collapse" id="collapseExample"> -->
        <div class="well">
          <div class="agent-p-form social-network">

            <div class="col-md-5 col-sm-5 col-xs-12">
              <h3 class="text-uppercase  bottom40">My Social <span class="color_red">Network</span></h3>
              <div class="row">

                <form action="#">
                  <div class="col-md-12">
                    <div class="single-query">
                      <label>Facebook:</label>
                      <input type="text" value="<?= $getUserById[0]['facebook_url'] ?>" name="facebook_url" placeholder="http://facebook.com" class="keyword-input">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="single-query">
                      <label>Twitter:</label>
                      <input type="text" value="<?= $getUserById[0]['twitter_url'] ?>" name="twitter_url" placeholder="http://twitter.com" class="keyword-input">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="single-query">
                      <label>Instagram:</label>
                      <input type="text" value="<?= $getUserById[0]['instagram_url'] ?>" name="instagram_url" placeholder="http://instagram.com" class="keyword-input">
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                    <div class="query-submit-button">
                      <input type="submit" class="btn_fill" id="update_socials" value="Update Socials">
                    </div>
                  </div>

                </form>

              </div>
            </div>
            <div class="col-md-1 hidden-xs"></div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <h3 class="text-uppercase  bottom40">Change Your <span class="color_red">Password</span></h3>
              <div class="row">

                <form action="#">
                  <div class="col-md-12">
                    <div class="single-query">
                      <label>Current Password</label>
                      <input type="text" value="**********" class="keyword-input">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="single-query">
                      <label>New Password</label>
                      <input type="text" placeholder="" name="password" class="keyword-input">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="single-query">
                      <label>Confirm Password</label>
                      <input type="text" placeholder="" name="password" class="keyword-input">
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                    <div class="query-submit-button">
                      <input type="submit" class="btn_fill" id="update_password" value="Update Password">
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
        <!-- </div> -->
      </div>
    </div>
  </section>
  <!--===== #/PROFILE =====-->





  <!--===== FOOTER =====-->
  <?php include_once('./components/footer.php') ?>

  <!--===== #/FOOTER =====-->


  <!-- Modal -->
  <?php include_once('./components/message_modal.php') ?>

  <!-- #/Modal -->

  <script>
    document.getElementById('update_profile').addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default form submission

      const button = event.target;
      button.disabled = true; // Optionally disable the button to prevent multiple clicks

      const form = button.closest('form'); // Get the form element
      const formData = new FormData(form);

      // Send POST request
      fetch('user-profile.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text()) // Expect plain text response
        .then(data => {
          // Display the SweetAlert message
          if (data.includes('Profile updated successfully')) {
            Swal.fire({
              icon: 'success',
              title: 'Profile Updated',
              text: data, // Success message returned from the server
              showConfirmButton: false,
              timer: 3000 // Automatically close after 2 seconds
            }).then(() => {
              window.location.reload(); // Refresh the page after confirmation
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Update Failed',
              text: data, // Error message returned from the server
              showConfirmButton: true
            });
          }

          button.disabled = false; // Enable the button again
        })
        .catch(error => {
          console.error('Error:', error);
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'An unexpected error occurred. Please try again.',
            showConfirmButton: true
          });
          button.disabled = false; // Enable the button again in case of error
        });
    });

    document.getElementById('update_socials').addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default form submission

      const button = event.target;
      const form = button.closest('form'); // Get the form element
      const formData = new FormData(form);

      fetch('form-api/update_socials.php', {
          method: 'POST',
          body: formData,
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: data.message,
            }).then(() => {
              window.location.reload(); // Refresh the page after confirmation
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: data.message,
            });
          }
        })
        .catch(error => {
          Swal.fire({
            icon: 'error',
            title: 'Unexpected Error',
            text: 'Something went wrong. Please try again later.',
          });
          console.error(error);
        });
    });

    document.getElementById('update_password').addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default form submission

      const button = event.target;
      const form = button.closest('form'); // Get the form element
      const formData = new FormData(form);

      fetch('form-api/update_password.php', {
          method: 'POST',
          body: formData,
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: data.message,
            });
            form.reset(); // Clear the form inputs
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: data.message,
            });
          }
        })
        .catch(error => {
          Swal.fire({
            icon: 'error',
            title: 'Unexpected Error',
            text: 'Something went wrong. Please try again later.',
          });
          console.error(error);
        });
    });


    document.getElementById('profile-image-input').addEventListener('change', function(event) {
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('profile-preview').src = e.target.result; // Update image preview
        };
        reader.readAsDataURL(file);
      }
    });

    document.getElementById('profile-image-form').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent default form submission

      const formData = new FormData();
      const fileInput = document.getElementById('profile-image-input');
      const file = fileInput.files[0];

      if (!file) {
        Swal.fire({
          icon: 'error',
          title: 'No File Selected',
          text: 'Please select a profile image to upload.',
        });
        return;
      }

      formData.append('profile_image', file);

      fetch('form-api/upload_profile_image.php', {
          method: 'POST',
          body: formData,
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: data.message,
            }).then(() => {
              // Dynamically update the profile image preview with the new file name
              const imagePath = 'uploads/profile_images/' + data.file_name;
              document.getElementById('profile-preview').src = imagePath; // Assuming 'profile-preview' is the id of the image element
              window.location.reload(); // Optionally reload the page to reflect changes
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: data.message,
            });
          }
        })
        .catch(error => {
          console.error('Error in fetch request:', error); // Log the actual error
          Swal.fire({
            icon: 'error',
            title: 'Unexpected Error',
            text: 'Something went wrong. Please try again later.',
          });
          console.error(error);
        });

    });
  </script>


  
  <!--===== REQUIRED JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.19/dist/sweetalert2.all.min.js"></script>
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