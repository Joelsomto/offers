<?php
require_once('./include/Session.php');
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once("./include/Controller.php");

$Controller = new Controller();
$propertiesPerPage = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $propertiesPerPage;

// Fetch properties for the current page
$properties = $Controller->getAllProperties($offset, $propertiesPerPage);
$property_status = $Controller->property_status();

$statusMap = [];
foreach ($property_status as $status) {
    $statusMap[$status['status_id']] = $status['status_name']; 
}

$timeAgo = fn($datetime) => function () use ($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;

    $units = [
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second',
    ];

    foreach ($units as $unitSeconds => $unitName) {
        if ($diff >= $unitSeconds) {
            $value = floor($diff / $unitSeconds);
            return $value . ' ' . $unitName . ($value > 1 ? 's' : '') . ' ago';
        }
    }
    return 'just now';
};

// Generate HTML for properties
foreach ($properties as $property): ?>
    <div class="col-md-6 col-sm-6">
        <div class="property_item heading_space">
            <div class="image">
                <img src="./uploads/property_images/<?= htmlspecialchars($property['image_file_name']) ?>" 
                     alt="listing" class="img-responsive" style="max-height: 250px; object-fit: cover;">
                <div class="overlay">
                    <div class="centered">
                        <a class="link_arrow white_border" href="property-details.php?id=<?= htmlspecialchars($property['property_id']) ?>">View Detail</a>
                    </div>
                </div>
                <div class="feature">
                    <span class="tag"><?= htmlspecialchars($statusMap[$property['property_status']] ?? 'Unknown') ?></span>
                </div>
                <div class="property_meta">
                    <span><i class="fa fa-object-group"></i><?= htmlspecialchars($property['square_fit_min']) ?> - <?= htmlspecialchars($property['square_fit_max']) ?> sq ft</span>
                    <span><i class="fa fa-bed"></i><?= htmlspecialchars($property['bed_room']) ?></span>
                    <span><i class="fa fa-bath"></i><?= htmlspecialchars($property['bath_room']) ?> Bathroom</span>
                </div>
            </div>
            <div class="proerty_content">
                <div class="proerty_text">
                    <h3>
                        <a href="property_details_<?= htmlspecialchars($property['property_id']) ?>.html"><?= htmlspecialchars($property['property_title']) ?></a>
                    </h3>
                    <span class="bottom10"><?= htmlspecialchars($property['property_address']) ?></span>
                    <p><strong><i class="fa-solid fa-naira-sign" style="font-size: 17px;"></i>
                    <?= number_format($property['price'], 2) ?></strong></p>
                </div>
                <div class="favroute clearfix">
                    <p class="pull-left"><i class="icon-calendar2"></i> <?= $timeAgo($property['created_at'])() ?></p>
                    <ul class="pull-right">
                        <li><a href="<?= htmlspecialchars($property['video_url']) ?>" class="popup-video"><i class="icon-video"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
