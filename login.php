<?php
require_once('./include/Session.php');
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once("./include/Controller.php");
require_once('./include/Functions.php');
// var_dump($_SESSION);
$Controller = new Controller();

$dbConnection = new DbConnection();
$conn = $dbConnection->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  // Initialize the response array
  $response = [
    'status' => 'error',  // Default status
    'message' => 'Invalid request'  // Default message
  ];

  if (empty($email) || empty($password)) {
    $response['message'] = "Fields cannot be empty!";
  } elseif (strlen($password) < 6) {
    $response['message'] = "Password must be at least 6 characters";
  } else {
    try {
      $user = $Controller->verifyUser($email, $password);

      if (is_array($user) && array_key_exists('user_id', $user)) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION["user_id"] = $user['user_id'];
        $_SESSION["user_role"] = $user['roles'];
        $_SESSION['is_logged_in'] = true; 

        $secureFlag = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
        setcookie("user_id", $user['user_id'], time() + 3600, "/", "", $secureFlag, true);

        $response['status'] = 'success';  // Successful login
        $response['message'] = "Login successful";
        $response['redirect_to'] = $_SESSION['redirect_to'];
      } else {
        $response['message'] = "Invalid Password/Email";
      }
    } catch (PDOException $e) {
      $response['message'] = "Database error: " . $e->getMessage();
    } catch (Exception $e) {
      $response['message'] = "An unexpected error occurred: " . $e->getMessage();
    }
  }

  // Return JSON response, ensure no extra output occurs
  echo json_encode($response);
  exit; // Ensure no additional output is sent
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <title>OFFERS NG | LOGIN </title>
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





  <!--===== LOGIN =====-->
  <section id="login" class="padding">
    <div class="container">
      <div class="row">
      <?php
    echo errorMsg();
    echo successMsg();
    echo infoMsg();
    ?>
        <div class="col-md-12 text-center">
          <div class="profile-login">
            <div class="login_detail">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
                <li role="presentation"><a href="./register.php">Register</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content padding_b40 padding_t40">
                <div role="tabpanel" class="tab-pane fade in active" id="login">
                  <h2>Welcome Back!</h2>
                  <div class="agent-p-form">
                    <div class="row">
                      
                      <form class="callus" id="loginForm" method="post" >
                        <div class="col-md-12">
                          <div class="single-query">
                            <input type="text" class="keyword-input" name="email" placeholder="Email">
                          </div>
                          <div class="single-query">
                            <input type="password" class="keyword-input" name="password" placeholder="Password">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="search-form-group white">
                            <div class="check-box-2">
                              <i><input type="checkbox" name="remember"></i>
                            </div>
                            <span>Remember Me</span>
                          </div>
                        </div>
                        <div class="col-md-6 text-right">
                          <a href="#" class="lost-pass">Lost your password?</a>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                          <div class="query-submit-button">
                            <button type="submit" class="btn_fill">Submit Now</button>
                          </div>
                        </div>
                      </form>
                      <div id="responseMessage" style="margin-top:10px;"></div>


                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--===== #/LOGIN =====-->




  <!--===== FOOTER =====-->
  <?php include_once('./components/footer.php') ?>
  <!--===== #/FOOTER =====-->


  <!-- Modal -->
  <?php include_once('./components/message_modal.php') ?>
  <!-- #/Modal -->

<script>
document.getElementById('loginForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent default form submission

  // Collect form data
  const formData = new FormData(this);

  // Send POST request using fetch
  fetch('login.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())  
  .then(data => {
    if (data.status === "success") {
      // Display SweetAlert for success
      Swal.fire({
        icon: 'success',
        title: 'Login Successful',
        text: data.message,
        showConfirmButton: false,
        timer: 1500
      }).then(() => {
        // Redirect after SweetAlert
        window.location.href = data.redirect_to;
      });
    } else {
      // Display SweetAlert for error
      Swal.fire({
        icon: 'error',
        title: 'Login Failed',
        text: data.message,
      });
    }
  })
  .catch(error => {
    // Display SweetAlert for unexpected errors
    Swal.fire({
      icon: 'error',
      title: 'Unexpected Error',
      text: 'An error occurred. Please try again later.',
    });
    console.error('Error:', error);
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