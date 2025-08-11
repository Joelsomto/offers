<?php
// Start the session
require_once('./include/Session.php');
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once("./include/Controller.php");
require_once('./include/Functions.php');

$controller = new Controller();

$dbConnection = new DbConnection();
$conn = $dbConnection->getConnection();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $first_name = htmlspecialchars(trim($_POST['first_name'] ?? ''));
    $last_name = htmlspecialchars(trim($_POST['last_name'] ?? ''));
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    // Initialize an error message array
    $errors = [];

    // Field checks
    if (empty($first_name)) {
        $errors[] = "First name cannot be empty.";
    }
    if (empty($last_name)) {
        $errors[] = "Last name cannot be empty.";
    }
    if (empty($username)) {
        $errors[] = "Username cannot be empty.";
    }
    if (empty($email)) {
        $errors[] = "Email cannot be empty.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password cannot be empty.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be more than six characters.";
    }

    // Check if user is already registered
    if (empty($errors) && $controller->isUserRegistered($email, $conn, $username)) {
        $errors[] = "User already registered. Please log in.";
    }

    // Process registration if there are no errors
    if (empty($errors)) {
        try {
            $hashPassword = password_hash($password, PASSWORD_BCRYPT);

            // Data array for insertion
            $data_array = [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "username" => $username,
                "email" => $email,
                "password" => $hashPassword,
                "roles" => 'U',
            ];

            $lastInsertedId = $controller->registerUser($data_array);

            if ($lastInsertedId) {
                $secureFlag = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
                setcookie("email", $email, time() + 3600, "/", "", $secureFlag, true);
                setcookie("user_id", $lastInsertedId, time() + 3600, "/", "", $secureFlag, true);

                $_SESSION['is_logged_in'] = true; 
                $_SESSION['user_id'] = $lastInsertedId;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['successMsg'] = "Registration successful";
                echo "success";
                exit();
            } else {
                $_SESSION['errorMsg'] = "An error occurred while registering.";
                exit();
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            $_SESSION['errorMsg'] = "An unexpected error occurred: " . $e->getMessage();
            exit();
        }
    } else {
        $_SESSION['errorMsg'] = implode("<br>", $errors);
        exit();
    }
} else {
    // $_SESSION['errorMsg'] = "Invalid request method.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>OFFERS NG | REGISTER </title>
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
    <?php
    echo errorMsg();
    echo successMsg();
    echo infoMsg();
    ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">

                    <div class="profile-login">
                        <div class="login_detail">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation"><a href="./login.php">Login</a></li>
                                <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Register</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content padding_b40 padding_t40">

                                <div role="tabpanel" class="tab-pane fade in active" id="profile">
                                    <h2>Sign Up for Free</h2>
                                    <div class="agent-p-form">
                                        <div class="row">



                                            <form class="callus" id="registrationForm">
                                                <div class="col-md-12">

                                                    <div class="single-query">
                                                        <input type="text" class="keyword-input" name="first_name" placeholder="First Name">
                                                    </div>
                                                    <div class="single-query">
                                                        <input type="text" class="keyword-input" name="last_name" placeholder="Last Name">
                                                    </div>
                                                    <div class="single-query">
                                                        <input type="text" class="keyword-input" name="username" placeholder="Username">
                                                    </div>
                                                    <div class="single-query">
                                                        <input type="email" class="keyword-input" name="email" placeholder="Email Address">
                                                    </div>
                                                    <div class="single-query">
                                                        <input type="password" class="keyword-input" name="password" placeholder="Password">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="search-form-group white">
                                                        <div class="check-box-2"><i><input type="checkbox" name="check-box"></i></div>
                                                        <span>Receive Newsletter</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                    <div class="query-submit-button">
                                                        <button type="submit" class="btn_fill">Create an Account</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div id="responseMessage" style="color:red"></div>


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
    <!-- <script>
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);
            const responseMessage = document.getElementById('responseMessage');
            responseMessage.style.color = 'red'; // Default color for error messages

            fetch('register.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "success") {
                        responseMessage.style.color = 'green';
                        responseMessage.innerHTML = "Registration successful. Redirecting...";
                        setTimeout(() => {
                            window.location.href = "user-profile.php";
                        }, 2000);
                    } else {
                        responseMessage.innerHTML = data; // Display any errors
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script> -->

<script>
document.getElementById('registrationForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    const formData = new FormData(this);

    fetch('register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Parse response as text
    .then(data => {
        if (data.trim() === "success") {
            // Display SweetAlert for successful registration
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful',
                text: 'Redirecting to your profile...',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                // Redirect to user profile
                window.location.href = "user-profile.php";
            });
        } else {
            // Display SweetAlert for error response
            Swal.fire({
                icon: 'error',
                title: 'Registration Failed',
                text: data,
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