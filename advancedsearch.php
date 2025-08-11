<?php
// advancedsearch.php

require_once('./include/Session.php');
require_once('./include/Dbconfig.php');
require_once('./include/Crud.php');
require_once('./include/Controller.php');
require_once('./include/Functions.php');

// Set response header for JSON
// header('Content-Type: application/json');

try {
    // Instantiate the controller
    $controller = new Controller();

    // Collect filters from GET parameters
    $filters = [
        'keyword' => $_GET['keyword'] ?? null,
        'property_address' => $_GET['property_address'] ?? null,
        'location' => $_GET['location'] ?? null,
        'property_type' => $_GET['property_type'] ?? null,
        'property_status' => $_GET['property_status'] ?? null,
        'min_beds' => $_GET['min_beds'] ?? null,
        'min_baths' => $_GET['min_baths'] ?? null,
        'min_area' => $_GET['min_area'] ?? null,
        'max_area' => $_GET['max_area'] ?? null,
        'min_price' => $_GET['min_price'] ?? null,
        'max_price' => $_GET['max_price'] ?? null,
        'page' => $_GET['page'] ?? 1,
    ];

    // Fetch properties using the controller
    $properties = $controller->getProperties($filters);

    // Success response
    echo json_encode([
        'status' => 'success',
        'message' => 'Properties fetched successfully.',
        'data' => $properties['data'],
        'pagination' => [
            'total' => $properties['total'],
            'page' => $properties['page'],
            'limit' => $properties['limit'],
        ],
    ]);
} catch (Exception $e) {
    // Error response
    echo json_encode([
        'status' => 'error',
        'message' => 'An error occurred while fetching properties.',
        'error' => $e->getMessage(),
    ]);
}
