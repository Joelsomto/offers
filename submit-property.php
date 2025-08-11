<?php
require_once('./include/Session.php');
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once("./include/Controller.php");
require_once('./include/Functions.php');

$Controller = new Controller();
if (!isset($_SESSION['user_role'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['user_role'] !== 'A') {
    header("Location: unauthorized.php");
    exit;
}

$getStates = $Controller->getStates();

$property_types = $Controller->property_types();

$property_status = $Controller->property_status();


   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Initialize the response array
  $response = [
    'status' => 'error',  // Default status
    'message' => 'Invalid request'  // Default message
  ];
        // Sanitize and retrieve property details from the POST request
        $propertyData = [
            'property_title' => trim($_POST['property_title'] ?? ''),
            'property_address' => trim($_POST['property_address'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'property_type' => trim($_POST['property_type'] ?? ''),
            'property_status' => trim($_POST['property_status'] ?? ''),
            'bed_room' => trim($_POST['bed_room'] ?? ''),
            'bath_room' => trim($_POST['bath_room'] ?? ''),
            'square_fit_min' => trim($_POST['square_fit_min'] ?? ''),
            'square_fit_max' => trim($_POST['square_fit_max'] ?? ''),
            'price' => trim($_POST['price'] ?? ''),
            'video_url' => trim($_POST['video_url'] ?? ''),
            'keyword' => trim($_POST['keyword'] ?? ''),
            'user_id' => trim($_POST['user_id'] ?? '')
        ];
    
        // Validate input fields
        $errors = [];
        foreach ($propertyData as $key => $value) {
            if (empty($value) && $key !== 'video_url') {
                $errors[$key] = ucfirst(str_replace('_', ' ', $key)) . ' is required.';
            }
        }
    
        if (!empty($errors)) {
            $_SESSION['errorMsg'] = 'Errors: ' . implode(' ', $errors);
            return;
        }
    
        try {
            // Submit the property details and retrieve the property ID
            $property_id = $Controller->properties($propertyData);
    
            // Initialize upload directory and allowed file types
            $uploadDir = 'uploads/property_images/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    
            // JustCopied
            // Process uploaded images
         // Process uploaded images
if (isset($_FILES['uploaded_images'])) {
    $uploadedFiles = []; // Array to store file names for database insertion

    foreach ($_FILES['uploaded_images']['tmp_name'] as $key => $tmp_name) {
        $fileName = $_FILES['uploaded_images']['name'][$key];
        $fileType = $_FILES['uploaded_images']['type'][$key];
        $fileError = $_FILES['uploaded_images']['error'][$key];

        if ($fileError === UPLOAD_ERR_OK && in_array($fileType, $allowedTypes)) {
            $uniqueFileName = uniqid() . '_' . basename($fileName);
            $destinationPath = $uploadDir . $uniqueFileName;

            if (move_uploaded_file($tmp_name, $destinationPath)) {
                // Save only the file name
                $uploadedFiles[] = [
                    'property_id' => $property_id,
                    'file_name' => $uniqueFileName, // Store only the unique file name
                ];
            } else {
                $response['message'] = "Error: Failed to move file $fileName.\n";
            }
        }
    }

    // Save file names to the database
    if (!empty($uploadedFiles)) {
        $Controller->uploaded_images($uploadedFiles);
        $response['message'] = "File names saved to database.\n";
    }
} else {
    $response['message'] = "No files received.";
}

            // justcopied
    
            // Capture property features
            $featureData = [
                'washer_and_dryer' => isset($_POST['washer_and_dryer']),
                'balcony' => isset($_POST['balcony']),
                'storage' => isset($_POST['storage']),
                'swimming_pool' => isset($_POST['swimming_pool']),
                'fitness_center' => isset($_POST['fitness_center']),
                'air_conditioning' => isset($_POST['air_conditioning']),
                'pet_friendly' => isset($_POST['pet_friendly']),
                'garage' => isset($_POST['garage']),
                'furnished' => isset($_POST['furnished']),
                'garden' => isset($_POST['garden']),
                'security' => isset($_POST['security']),
                'smart_home_features' => isset($_POST['smart_home_features']),
                'near_public_transport' => isset($_POST['near_public_transport']),
                'fireplace' => isset($_POST['fireplace']),
                'high_speed_internet' => isset($_POST['high_speed_internet']),
                'walk_in_closet' => isset($_POST['walk_in_closet']),
                'roof_terrace' => isset($_POST['roof_terrace']),
                'playground' => isset($_POST['playground']),
                'elevator' => isset($_POST['elevator']),
                'dishwasher' => isset($_POST['dishwasher'])
            ];
    
            // Insert property features
            $Controller->property_features($property_id, $featureData);
    
            $response['status'] = 'success';  
            $response['message'] = "Form submitted successfully.";

        } catch (Exception $e) {
            // Handle exceptions and set error message
            $response['message'] = 'An error occurred: ' . $e->getMessage();
        }
        echo json_encode($response);
        exit; // Ensure no additional output is sent
      
    } else {
        // Handle invalid request method
        // $_SESSION['errorMsg'] = 'Error: Invalid request method.';
    }
      // Return JSON response, ensure no extra output occurs

?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>OFFERS NG | SUBMIT PROPERTY</title>
<link rel="stylesheet" type="text/css" href="css/master.css">
<link rel="stylesheet" type="text/css" href="css/color/color-8.css" id="color" />
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.19/dist/sweetalert2.min.css">

<style>
    /* Optional styles to show the active drop area */
    .file_uploader {
        border: 2px dashed #ddd;
        padding: 20px;
        text-align: center;
        cursor: pointer;
    }
    .file_uploader.drag-over {
        border-color: #009688;
        background-color: #f1f1f1;
    }
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }
    .image-preview {
        display: inline-block;
        position: relative;
    }
    .image-preview img {
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .remove-button {
        position: absolute;
        top: 0;
        right: 0;
        background-color: red;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 12px;
        padding: 2px 5px;
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
<section id="new-property" class="padding">
      <div class="container">
        <div class="row">

          <div class="col-sm-3 col-md-3" id="block-menu-content">
            <ul class="block-menu" data-spy="affix" data-offset-top="500" data-offset-bottom="400">
              <li><a class="active" href="#basic"><i class="icon fa fa-check-square-o"></i>Basic Information</a></li>
              <li><a class="" href="#summary"><i class="icon fa fa-th-list"></i> Summary</a></li>
              <li><a class="" href="#images"><i class="icon fa fa-picture-o"></i> Images</a></li>
              <li><a class="" href="#features"><i class="icon fa fa-sliders"></i> Features </a></li>
              <!-- <li><a class="" href="#map-area"><i class="icon fa fa-map-marker"></i>Location</a></li> -->
              
            </ul>
          </div>
            <form class="findus" id="property-form" method="post" enctype="multipart/form-data" action="">

                <div class="col-sm-9 col-md-9">
                        <!-- Alerts for success and error messages -->
                        <div class="alert alert-success" id="success-message" role="alert" style="display: none;">
                            Property added successfully!
                        </div>
                        <div class="alert alert-danger" id="error-message" role="alert" style="display: none;">
                            There was an error submitting your property.
                        </div>
                                    <?php
                                    echo errorMsg();
                                    echo successMsg();
                                    echo infoMsg();

                                    ?>
                    <div class="info-block" id="basic">

                    <div class="row">
                        <div class="col-md-12 bottom40">
                        <h2 class="text-uppercase">Basic <span class="color_red">Information</span></h2>
                        <div class="line_1"></div>
                        <div class="line_2"></div>
                        <div class="line_3"></div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-query form-group">
                            <label>Property Title</label>
                            <input class="keyword-input" name="property_title" placeholder="Title" required="" type="text">
                        </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-query form-group">
                            <label>Property Address</label>
                            <input class="keyword-input" name="property_address" placeholder="Your address is here" required="" type="text">
                        </div>
                        </div>


                        <div class="col-md-12 top20">
                        <textarea name="description" id="description" name="description" class="form-control description">
                            <h2>Property Description</h2>
                            <br>Clear and Type Here</textarea>
                        </div>
                    </div>

                    </div>

                    <div class="info-block padding" id="summary">

                    <div class="row">
                        <div class="col-md-12 bottom40">
                        <h2 class="text-uppercase">Summary</h2>
                        <div class="line_1"></div>
                        <div class="line_2"></div>
                        <div class="line_3"></div>
                        </div>
                    </div>

                    <div class="row">

                        

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="single-query form-group">
                            <label>Keyword</label>
                            <input type="text" class="keyword-input" placeholder="Any" required name="keyword">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="single-query form-group">
                                <label>Location</label>
                                <select class="selectpicker" data-live-search="true" name="location">
                                <option selected="" value="any">Any</option>
                                <?php foreach ($getStates as $state): ?>
                                <option value="<?php echo htmlspecialchars($state['id']); ?>">
                                    <?php echo htmlspecialchars($state['state_name']); ?>
                                </option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="single-query form-group">
                                <label>Property Type</label>
                                <select class="selectpicker" data-live-search="true" name="property_type">
                                <option class="active">Any</option>
                                <?php foreach ($property_types as $property): ?>
                                <option value="<?php echo htmlspecialchars($property['id']); ?>">
                                    <?php echo htmlspecialchars($property['property_type']); ?>
                                </option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="single-query form-group">
                                <label>Property Status</label>
                                <select class="selectpicker" data-live-search="true" name="property_status">
                                <option class="active">Any</option>
                                <?php foreach ($property_status as $prop_stat): ?>
                                <option value="<?php echo htmlspecialchars($prop_stat['status_id']); ?>">
                                    <?php echo htmlspecialchars($prop_stat['status_name']); ?>
                                </option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="single-query form-group">
                                <label>Bed Room</label>
                                <select class="selectpicker" data-live-search="true" name="bed_room">
                                <option class="active">Any</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                </select>
                            </div>
                        </div>

                          
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="single-query form-group">
                                <label>Bath Room</label>
                                <select class="selectpicker" data-live-search="true" name="bath_room">
                                <option class="active">Any</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="single-query form-group">
                                <label>Square Fit Min</label>
                                <input type="number" class="keyword-input" placeholder="Any" name="square_fit_min">
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="single-query form-group">
                                <label>Square Fit Max</label>
                                <input type="number" class="keyword-input" placeholder="Any" name="square_fit_max">
                            </div>
                        </div>


                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="single-query form-group">
                                <label>Price:</label>
                                <input class="keyword-input" name="price" placeholder="price" required type="number">
                            </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-query form-group">
                            <label>Video Url</label>
                            <input class="keyword-input" name="video_url" placeholder="" required type="text">
                        </div>
                        <input class="keyword-input" name="user_id" value="<?=$_SESSION['user_id']?>" hidden>
                        
                        


                        

                    </div>

                    </div>

                    <div class="info-block" id="images">

                    <div class="row">
                        <div class="col-md-12 bottom40">
                        <h2 class="text-uppercase">Property <span class="color_red">Images</span></h2>
                        <div class="line_1"></div>
                        <div class="line_2"></div>
                        <div class="line_3"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="file_uploader bottom20" id="dropZone">
                            <input type="file" id="imageUpload" name="uploaded_images[]" multiple accept="image/*" style="display:  none;">
                                <label for="imageUpload" class="dz-default dz-message">
                                    <span id="uploadPrompt">
                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                        Drag & drop images here or click to upload (Max 5 files)
                                    </span>
                                </label>
                                <div id="previewContainer" class="preview-container"></div>
                                <p id="uploadMessage" style="color: white;"></p>
                            </div>
                        </div>
                    </div>







                    </div>

                    <div class="info-block padding" id="features">
                        <div class="row">
                            <div class="col-md-12 bottom40">
                                <h2 class="text-uppercase">Property <span class="color_red">Features</span></h2>
                                <div class="line_1"></div>
                                <div class="line_2"></div>
                                <div class="line_3"></div>
                            </div>
                        </div>

                        <div class="features-box">
                            <div class="search-propertie-filters">
                                <div class="container-2">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="washer_and_dryer" type="checkbox"></i></div>
                                                <span>Washer and Dryer</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="balcony" type="checkbox"></i></div>
                                                <span>Balcony</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="storage" type="checkbox"></i></div>
                                                <span>Storage</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="swimming_pool" type="checkbox"></i></div>
                                                <span>Swimming Pool</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="fitness_center" type="checkbox"></i></div>
                                                <span>Fitness Center</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="air_conditioning" type="checkbox"></i></div>
                                                <span>Air Conditioning</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="pet_friendly" type="checkbox"></i></div>
                                                <span>Pet Friendly</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="garage" type="checkbox"></i></div>
                                                <span>Garage</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="furnished" type="checkbox"></i></div>
                                                <span>Furnished</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="garden" type="checkbox"></i></div>
                                                <span>Garden</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="security" type="checkbox"></i></div>
                                                <span>24/7 Security</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="smart_home_features" type="checkbox"></i></div>
                                                <span>Smart Home Features</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="near_public_transport" type="checkbox"></i></div>
                                                <span>Near Public Transport</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="fireplace" type="checkbox"></i></div>
                                                <span>Fireplace</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="high_speed_internet" type="checkbox"></i></div>
                                                <span>High-Speed Internet</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="walk_in_closet" type="checkbox"></i></div>
                                                <span>Walk-in Closet</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="roof_terrace" type="checkbox"></i></div>
                                                <span>Roof Terrace</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="playground" type="checkbox"></i></div>
                                                <span>Playground</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="elevator" type="checkbox"></i></div>
                                                <span>Elevator</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="search-form-group white">
                                                <div class="check-box"><i><input name="dishwasher" type="checkbox"></i></div>
                                                <span>Dishwasher</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                 

                    <button type="submit" id="submit-button" class="btn_fill" style="margin-top: 15px"><i class="icon fa fa-cart-arrow-down"></i> Submit Property</button>

                </div>

            </form>
        </div>
      </div>
    </section>
<!-- PROPERTY DETAILS --> 




<!--===== FOOTER =====-->
<?php include_once('./components/footer.php')?>
<!--===== #/FOOTER =====--> 


  <!-- Modal -->
  <?php include_once('./components/message_modal.php') ?>
  <!-- #/Modal -->

  <script>
    // Form and alert elements
    const form = document.getElementById('property-form'); // Replace with your form's actual ID
    const submitButton = document.getElementById('submit-button'); // Optional, for disabling during submission

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        // Ensure at least one file is selected
        if (selectedFiles.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Files Selected',
                text: 'Please select at least one file to upload.',
            });
            return;
        }

        // Disable the submit button to avoid multiple submissions
        submitButton.disabled = true;

        // Create FormData and append selected images
        const formData = new FormData(form);
        selectedFiles.forEach((file, index) => {
            formData.append('uploaded_images[]', file, file.name);
        });

        // Send the POST request with the form data and files
        fetch('submit-property.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Assuming server response is JSON
        .then(data => {
            if (data.status === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'Submission Successful',
                    text: data.message || 'Your property has been submitted successfully!',
                }).then(() => {
                    window.location.href = "my-properties.php"; // Redirect after success
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Submission Failed',
                    text: data.message || 'An error occurred while submitting your property. Please try again.',
                });
            }
        })
        .catch(error => {
            console.error('Error submitting form:', error);
            Swal.fire({
                icon: 'error',
                title: 'Unexpected Error',
                text: 'Something went wrong. Please try again later.',
            });
        })
        .finally(() => {
            submitButton.disabled = false;
        });
    });

    // Image file handling script
    let selectedFiles = [];
    const maxSizeMB = 2;
    const maxFiles = 5;
    const previewContainer = document.getElementById("previewContainer");
    const uploadMessage = document.getElementById("uploadMessage");
    const dropZone = document.getElementById("dropZone");

    function updateFilePrompt() {
        const prompt = document.getElementById("uploadPrompt");
        prompt.innerText = selectedFiles.length > 0 
            ? `${selectedFiles.length} file(s) selected` 
            : "Drag & drop images here or click to upload (Max 5 files)";
    }

    document.getElementById("imageUpload").addEventListener("change", function(event) {
        handleFiles(event.target.files);
        event.target.value = ""; // Clear input to allow re-selection
    });

    dropZone.addEventListener("dragover", (event) => {
        event.preventDefault();
        dropZone.classList.add("drag-over");
    });

    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("drag-over");
    });

    dropZone.addEventListener("drop", (event) => {
        event.preventDefault();
        dropZone.classList.remove("drag-over");
        handleFiles(event.dataTransfer.files);
    });

    function handleFiles(files) {
        const newFiles = Array.from(files);
        uploadMessage.innerText = "";

        if (selectedFiles.length + newFiles.length > maxFiles) {
            Swal.fire({
                icon: 'error',
                title: 'File Limit Exceeded',
                text: `Please select up to ${maxFiles} files in total.`,
            });
            return;
        }

        newFiles.forEach(file => {
            if (file.size > maxSizeMB * 1024 * 1024) {
                Swal.fire({
                    icon: 'warning',
                    title: 'File Too Large',
                    text: `Each file must be smaller than ${maxSizeMB} MB.`,
                });
            } else {
                selectedFiles.push(file);
                previewImage(file);
            }
        });
        
        updateFilePrompt();
    }

    function previewImage(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imgContainer = document.createElement("div");
            imgContainer.className = "image-preview";
            
            const img = document.createElement("img");
            img.src = e.target.result;
            img.style.width = "100px";
            img.style.margin = "5px";
            
            const removeButton = document.createElement("button");
            removeButton.innerText = "Remove";
            removeButton.className = "remove-button";
            removeButton.addEventListener("click", function() {
                removeImage(file);
                imgContainer.remove();
            });
            
            imgContainer.appendChild(img);
            imgContainer.appendChild(removeButton);
            previewContainer.appendChild(imgContainer);
        };
        reader.readAsDataURL(file);
    }

    function removeImage(file) {
        selectedFiles = selectedFiles.filter(f => f !== file);
        updateFilePrompt();
    }

    dropZone.addEventListener("click", function() {
        document.getElementById("imageUpload").click();
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

<!--Maps & Markers-->
<script src="js/form.js"></script> 
<script src="js/custom-map.js"></script> 
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBN8doQuCnDhcTkQStjMZQiAH0imIbp54E"></script>
<script src="js/gmaps.js"></script>
<script src="js/contact.js"></script> 

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

<!--===== #/REQUIRED JS =====-->
<script>
    // TEXT EDITOR INITIALIZATION
    $('#description').editor();
  </script>
<!--===== #/REQUIRED JS =====-->

</body>

</html>