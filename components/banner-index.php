<?php
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once("./include/Controller.php");

$Controller = new Controller();

$getStates = $Controller->getStates();

$property_types = $Controller->property_types();
?>

<div class="hero_slider padding-bottom-top-120 parallaxie">
  <div class="container padding-bottom-top-120">
    <div class="row padding_bottom">
      <div class="col-sm-12 padding_top">
        <h2 class="text-capitalize text-center top30 color_white"> Discover your places at <span class="color_red">OFFERS NG </span> </h2>
        <div class="line_1-1"></div>
        <div class="line_2-2"></div>
        <div class="line_3-3"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="search_2 search_2_set">
          <form class="findus clearfix">
            <div class="row">
              <div class="col-md-4 col-sm-3">
                <div class="single-query">
                  <input type="text" class="keyword-input" placeholder="keyword">
                </div>
              </div>

              <!-- For Location Dropdown -->
              <div class="col-md-3 col-sm-3">
                <div class="single-query">
                  <select class="selectpicker" data-live-search="true">
                    <option class="active">Location</option>
                    <?php foreach ($getStates as $state): ?>
                      <option value="<?php echo htmlspecialchars($state['id']); ?>">
                        <?php echo htmlspecialchars($state['state_name']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              

              <!-- For Property Type Dropdown -->
              <div class="col-md-3 col-sm-3">
                <div class="single-query">
                  <select class="selectpicker" data-live-search="true">
                    <option class="active">Property Type</option>
                    <?php foreach ($property_types as $property): ?>
                      <option value="<?php echo htmlspecialchars($property['id']); ?>">
                        <?php echo htmlspecialchars($property['property_type']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-2 col-sm-3 col-xs-12 text-right">
                <div class="query-submit-button form-group">
                  <button type="submit" class="btn_fill">Search</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>