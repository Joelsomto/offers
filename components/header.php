<header id="main_header">

  <!--===== HEADER TOP =====-->
  <div id="header-top">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <p class="p-font-15 p-white">We are Best in Town With 10 years of Experience.</p>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12 text-right">
          <div class="header-top-links">
            <ul>
              <!-- <li><a href="favorite-properties.html"><i class="icon-heart2"></i>Favorites</a></li> -->
              <li class="af-line"></li>
              <!-- <li><a href="submit-property.php"><i class="icon-icons215"></i>Submit Property</a></li> -->
              <li class="af-line"></li>
              <!-- <li><a href="my-properties.php"><i class="icon-icons215"></i>My Property</a></li> -->

              <?php 
              if (isset($_SESSION['user_id']) && isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
                  // User is logged in, show logout option
                  echo '<li><a href="logout.php" class="header-login"><i class="icon-icons179"></i> Logout</a></li>';
              } else {
                  // User is not logged in, show login option
                  echo '<li><a href="login.php" class="header-login"><i class="icon-icons179"></i> Login</a></li>';
              }
              ?>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--===== #/HEADER TOP =====--> 

  <!--===== HEADER BOTTOM =====-->
  <div id="header-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-2 hidden-xs hidden-sm"><a href="index.php"><h2 class="logo" alt=""> Offers NG</h2></a></div>
        <!-- <div class="col-md-2 hidden-xs hidden-sm"><a href="index.html"><img src="images/logo-white.png" alt="logo"/></a></div> -->
        <div class="col-md-10 col-sm-12 col-xs-12">
          <div class="get-tuch text-left top20">
            <i class="icon-telephone114"></i>
            <ul>
              <li>
                <h4>Phone Number</h4>
              </li>
              <li>
                <p>+1 900 234 567 - 68</p>
              </li>
            </ul>
          </div>
          <div class="get-tech-line top20"><img src="images/get-tuch-line.png" alt="line"/></div>
          <div class="get-tuch text-left top20">
            <i class="icon-icons74"></i>
            <ul>
              <li>
                <h4>Victoria Hall,</h4>
              </li>
              <li>
                <p>Idea Homes Melbourne, australia</p>
              </li>
            </ul>
          </div>
          <div class="get-tech-line top20"><img src="images/get-tuch-line.png" alt="line"/></div>
          <div class="get-tuch text-left top20">
            <i class=" icon-icons142"></i>
            <ul>
              <li>
                <h4>Email Address</h4>
              </li>
              <li>
                <p><a href="#">info@offersng.com</a></p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--===== #/HEADER BOTTOM =====--> 

  <!--===== NAV-BAR =====-->
  <nav class="navbar navbar-default navbar-sticky bootsnav">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="social-icons text-right">
            <ul class="socials">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            </ul>
          </div>
          <!-- Start Header Navigation -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
            <i class="fa fa-bars"></i></button>
            <a class="navbar-brand sticky_logo" href="index.php"><h2 class="logo" alt=""> Offers NG</h2></a>
            <!-- <a class="navbar-brand sticky_logo" href="index.html"><img src="images/logo-white.png" class="logo" alt=""></a> -->
          </div>
          <!-- End Header Navigation --> 
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav" data-in="fadeInDown" data-out="fadeOutUp">
              <li class="dropdown">
                <a href="index.php">Homes</a>
                
              </li>
              
              <li class="dropdown">
                <a href="about.php">About Us</a>
                
              </li>
              
              <li class="dropdown">
                <a href="#." class="dropdown-toggle" data-toggle="dropdown">Properties</a>
                <ul class="dropdown-menu">
                  <li class="dropdown">
                    <a href="listing.php" >Property Listing</a>
                    
                  </li>
                  <?php 
                    // Check if the user is an admin
                    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] === 'A') { 
                    ?>
                      <li class="dropdown">
                        <a href="my-properties.php">My Properties</a>
                      </li>
                      <li class="dropdown">
                        <a href="submit-property.php">Create New Property</a>
                      </li>
                    <?php 
                    } 
                    ?>

                </ul>
              </li>
              
              <li class="dropdown">
                <a href="#." class="dropdown-toggle" data-toggle="dropdown" >Agents</a>
                <ul class="dropdown-menu">
                  <li class="dropdown">
                    <a href="#." class="dropdown-toggle" data-toggle="dropdown" >Our Agents</a>
                    <ul class="dropdown-menu">
                      <!-- <li><a href="agent-1.html">Our Agents V - 1</a></li>
                      <li><a href="agent-2.html">Our Agents V - 2</a></li> -->
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#." class="dropdown-toggle" data-toggle="dropdown" >Agent Profiles</a>
                    <ul class="dropdown-menu">
                      <!-- <li><a href="agent-profile-1.html">Agents Profile V - 1</a></li>
                      <li><a href="agent-profile-2.html">Agents Profile V - 2</a></li> -->
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#." class="dropdown-toggle" data-toggle="dropdown" >Agent Listings</a>
                    <ul class="dropdown-menu">
                      <!-- <li><a href="agent-listing.html">Agents Listings V - 1</a></li>
                      <li><a href="agent-listing-2.html">Agents Listings V - 2</a></li> -->
                    </ul>
                  </li>
                </ul>
              </li>
              
              <li class="dropdown active">
                <a href="#." class="dropdown-toggle" data-toggle="dropdown">User Profile</a>
                <ul class="dropdown-menu">
                  <li><a href="user-profile.php"> Profile</a></li>
                  <!-- <li><a href="bookmark-properties.php">Bookmarks</a></li> -->

                </ul>
              </li>
              
             

              
              <li class="dropdown">
                <a href="#." class="dropdown-toggle" data-toggle="dropdown">Contact Us</a>
                <ul class="dropdown-menu">
                  
                </ul>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!--===== #/NAV-BAR =====--> 
</header>