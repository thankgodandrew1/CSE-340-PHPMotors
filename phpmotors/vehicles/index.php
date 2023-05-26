<?php
// This is the VEHICLES controller

// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../models/main-model.php';

// Get the vehicles model
require_once '../models/vehicles-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

// Build a dynamic dropdown for car classification
$classificationList = '<select class="selectClass" name="classificationId">';
$classificationList .= "<option value='' selected>Choose Car Classification</option>";
foreach ($classifications as $classification) {
    $classificationId = $classification['classificationId'];
    $classificationName = $classification['classificationName'];

    $classificationList .= '<option value="' . $classificationId . '">' . $classificationName . '</option>';
}
$classificationList .= '</select>';

// Watch for and capture name-value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// Control structures to deliver views
switch ($action) {
    case 'addClassification':
        // Retrieve the classification name from the form
        $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_SPECIAL_CHARS);

        // Perform data validation and error handling

        if (empty($classificationName)) {
            $errorMsg = 'Please enter a classification name.';
            include '../view/add-classification.php';
            exit;
        }

        // Code to insert the new classification into the database
        // Call the newCarClassification() function from the vehicles model
        $rowsChanged = newCarClassification($classificationName);

        // Check if the insertion was successful
        if ($rowsChanged > 0) {
            // Redirect to the vehicles controller without a name-value pair
            header('Location: /phpmotors/vehicles/index.php');
            exit;
        } else {
            $errorMsg = 'Failed to insert the classification into the database.';
            include '../view/add-classification.php';
            exit;
        }
    case 'addVehicle':
        // Retrieve the names from the form
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_SPECIAL_CHARS);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_SPECIAL_CHARS);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_SPECIAL_CHARS);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_SPECIAL_CHARS);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_SPECIAL_CHARS);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_SPECIAL_CHARS);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_SPECIAL_CHARS);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_SPECIAL_CHARS);

        // Perform data validation and error handling

        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $errorMsg = 'Please fill in all the fields.';
            include '../view/add-vehicle.php';
            exit;
        }

        // Development Code
        // $emptyFields = [];

        // Created an associative array for the form fieldsNames
        // $fieldNames = [
        //     'invMake' => 'Make',
        //     'invModel' => 'Model',
        //     'invDescription' => 'Description',
        //     'invImage' => 'Image',
        //     'invThumbnail' => 'Thumbnail',
        //     'invPrice' => 'Price',
        //     'invStock' => 'Stock',
        //     'invColor' => 'Color',
        //     'classificationId' => 'Car Classification'
        // ];

        // foreach ($fieldNames as $fieldName => $label) {
        //     if (empty($$fieldName)) {
        //         $emptyFields[] = $label;
        //     }
        // }

        // if (!empty($emptyFields)) {
        //     $errorMsg = 'Please enter the following fields: ' . implode(', ', $emptyFields) . '.';
        //     include '../view/add-vehicle.php';
        //     exit;
        // }

        // Code to insert the new vehicle into the database
        // Call the newCarClassification() function from the vehicles model
        $addNewVehicle = newVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        // Check if the insertion was successful
        if ($addNewVehicle === 1) {
            $message = "<p> Vehicle Registration Successful</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Failed to insert new vehicle to database. Please try again!</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break;
    default:
        include '../view/vehicle-management.php';
        break;
}
