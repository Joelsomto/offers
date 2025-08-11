<header id="header-top_2">
  <div class="container">
    <div class="row">
      <div class="header_set">
        <div class="col-md-12 text-right">
          <div class="get-tuch text-left">
            <i class="icon-telephone114"></i>
            <ul>
              <li>
                <h4>+1(123) 456 567</h4>
              </li>
              <li><a href="#.">
                  <p class="p_14">support@offersng.com</p>
                </a></li>
            </ul>
          </div>
          <div class="get-tuch text-left">
            <i class="icon-alarmclock"></i>
            <ul>
              <li>
                <h4>08:00 - 16:30</h4>
              </li>
              <li>
                <p class="p_14">Monday to Saturday</p>
              </li>
            </ul>
          </div>
          <div class="get-tuch text-left">
            <i class=" icon-icons142"></i>
            <ul>
              <li>
                <h4 class="p-font-17">Email Address</h4>
              </li>
              <li><a href="#.">
                  <p class="p-font-15">info@offersng.com</p>
                </a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-default navbar-fixed no-background navbar-sticky dark bootsnav">
    <div class="container">
      <!-- Start Header Navigation -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
          <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="index.html">
          <h2 class="logo logo-display" style="color: white">OFFERS NG</h2>
          <h2 class="logo logo-scrolled">OFFERS NG</h2>
          <!-- <img src="images/logo.png" class="logo logo-display" alt="">
        <img src="images/logo-white_2.png" class="logo logo-scrolled" alt=""> -->
          <!-- <img src="images/logo.png" class="logo logo-display" alt="">
        <img src="images/logo-white_2.png" class="logo logo-scrolled" alt=""> -->
        </a>
      </div><!-- End Header Navigation -->
      <div class="collapse navbar-collapse nav_bor_bot" id="navbar-menu">
        <ul class="nav navbar-nav navbar-right nav_3" data-in="fadeInDown" data-out="fadeOutUp">
          <li class="dropdown active">
            <a href="/" class="dropdown-toggle" data-toggle="dropdown">Homes</a>
            <ul class="dropdown-menu">
              <!-- <li><a href="index.html">Home V-1</a></li>
                  <li><a href="index-2.html">Home V - 2</a></li>
                  <li><a href="index-3.html">Home V - 3</a></li>
                  <li><a href="index-4.html">Home V - 4</a></li>
                  <li><a href="index-5.html">Home V - 5</a></li>
                  <li><a href="index-6.html">Home V - 6</a></li>
                  <li class="active"><a href="index-7.html">Home V - 7</a></li>
                  <li><a href="index-8.html">Home V - 8</a></li>
                  <li><a href="index-9.html">Home V - 9</a></li>
                  <li><a href="index-10.html">Home V - 10</a></li>
                  <li><a href="landing-page.html">Landing Page</a></li> -->
            </ul>
          </li>

          <li class="dropdown">
            <a href="about.html" class="dropdown-toggle" data-toggle="dropdown">About Us</a>
            <ul class="dropdown-menu">
              <li><a href="about.php">About Us </a></li>
              <!-- <li><a href="about-2.html">About Us V - 2</a></li>
                  <li><a href="about-3.html">About Us V - 3</a></li> -->
            </ul>
          </li>

          <li class="dropdown">
            <a href="#." class="dropdown-toggle" data-toggle="dropdown">Properties</a>
            <ul class="dropdown-menu">
              <li class="dropdown">
                <a href="listing.php" class="dropdown-toggle" data-toggle="dropdown">Property Listing</a>
              </li>
                <?php 
                if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] === 'A') { 
                ?>
                    <!-- Dropdown menu for admin-specific functionality -->
                    <li class="dropdown">
                        <a href="my-properties.php" class="dropdown-toggle" data-toggle="dropdown">My Properties</a>
                    </li>
                    <li class="dropdown">
                        <a href="submit-property.php" class="dropdown-toggle" data-toggle="dropdown">Create New Property</a>
                    </li>
                <?php 
                } 
                ?>


            </ul>
          </li>

          <li class="dropdown">
            <a href="#." class="dropdown-toggle" data-toggle="dropdown">Agents</a>
            <ul class="dropdown-menu">
              <li class="dropdown">
                <a href="#." class="dropdown-toggle" data-toggle="dropdown">Our Agents</a>
                <ul class="dropdown-menu">
                  <!-- <li><a href="agent-1.html">Our Agents V - 1</a></li>
                  <li><a href="agent-2.html">Our Agents V - 2</a></li> -->
                </ul>
              </li>
              <li class="dropdown">
                <a href="#." class="dropdown-toggle" data-toggle="dropdown">Agent Profiles</a>
                <ul class="dropdown-menu">
                  <!-- <li><a href="agent-profile-1.html">Agents Profile V - 1</a></li>
                  <li><a href="agent-profile-2.html">Agents Profile V - 2</a></li> -->
                </ul>
              </li>
              <li class="dropdown">
                <a href="#." class="dropdown-toggle" data-toggle="dropdown">Agent Listings</a>
                <ul class="dropdown-menu">
                  <!-- <li><a href="agent-listing.html">Agents Listings V - 1</a></li>
                  <li><a href="agent-listing-2.html">Agents Listings V - 2</a></li> -->
                </ul>
              </li>
            </ul>
          </li>



          <!-- <li class="dropdown">
                <a href="#." class="dropdown-toggle" data-toggle="dropdown" >Pages</a>
                <ul class="dropdown-menu">
                  <li class="dropdown">
                    <a href="#." class="dropdown-toggle" data-toggle="dropdown" >Agency</a>
                    <ul class="dropdown-menu">
                      <li><a href="agency-listing.html">Agency Listing</a></li>
                      <li><a href="agency-details.html">Agency Deatil</a></li>
                      <li><a href="create-agency.html">Creat New Agency</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#." class="dropdown-toggle" data-toggle="dropdown" >Galleries</a>
                    <ul class="dropdown-menu">
                      <li><a href="gallery-1.html">Gallery V - 1</a></li>
                      <li><a href="gallery-2.html">Gallery V - 2</a></li>
                      <li><a href="gallery-3.html">Gallery V - 3</a></li>
                      <li><a href="gallery-4.html">Gallery V - 4</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#." class="dropdown-toggle" data-toggle="dropdown" >Our Blogs</a>
                    <ul class="dropdown-menu">
                      <li><a href="news-1.html">Our Blog V - 1</a></li>
                      <li><a href="news-2.html">Our Blog V - 2</a></li>
                      <li><a href="news-3.html">Our Blog V - 3</a></li>
                      <li><a href="news-details.html">Blog Details</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#." class="dropdown-toggle" data-toggle="dropdown" >Create Invoice</a>
                    <ul class="dropdown-menu">
                      <li><a href="invoice-1.html">Create Invoice V - 1</a></li>
                      <li><a href="invoice-2.html">Create Invoice V - 2</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#." class="dropdown-toggle" data-toggle="dropdown" >FAQ's</a>
                    <ul class="dropdown-menu">
                      <li><a href="faq-1.html">FAQ's V - 1</a></li>
                      <li><a href="faq-2.html">FAQ's V - 2</a></li>
                      <li><a href="faq-3.html">FAQ's V - 3</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#." class="dropdown-toggle" data-toggle="dropdown" >Timelines</a>
                    <ul class="dropdown-menu">
                      <li><a href="timeline-1.html">Timeline V - 1</a></li>
                      <li><a href="timeline-2.html">Timeline V - 2</a></li>
                      <li><a href="timeline-3.html">Timeline V - 3</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a href="#." class="dropdown-toggle" data-toggle="dropdown" >Error Pages</a>
                    <ul class="dropdown-menu">
                      <li><a href="error-401.html">Error Page 401</a></li>
                      <li><a href="error-403.html">Error Page 403</a></li>
                      <li><a href="error-404.html">Error Page 404</a></li>
                      <li><a href="error-500.html">Error Page 500</a></li>
                    </ul>
                  </li>
                  <li><a href="packages.html">Packages</a></li>
                  <li><a href="testimonials.html">Testimonial</a></li>
                  <li><a href="term%26condition.html">Terms & Conditions</a></li>
                  <li><a href="auto-loan-calculator.html">Loan Calculate</a></li>
                </ul>
              </li> -->



          <li class="dropdown">
            <a href="#." class="dropdown-toggle" data-toggle="dropdown">Contact Us</a>
            <ul class="dropdown-menu">
              <!-- <li><a href="contact-us.html">Contact Us V - 1</a></li>
              <li><a href="contact-us-2.html">Contact Us V - 2</a></li>
              <li><a href="contact-us-3.html">Contact Us V - 3</a></li>
              <li><a href="contact-us-4.html">Contact Us V - 4</a></li> -->
            </ul>
          </li>

          <li class="dropdown">
            <a href="#." class="dropdown-toggle" data-toggle="dropdown">Profile</a>
            <ul class="dropdown-menu">
            <?php
              if (isset($_SESSION['user_id']) && isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
                echo '<li><a href="user-profile.php">Profile</a></li>';
              }
             ?>

              <?php
              if (isset($_SESSION['user_id']) && isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
                echo '<li><a href="logout.php">Logout</a></li>';
              } else {
                echo '<li><a href="login.php">Login</a></li>';
              }
              ?>

            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>