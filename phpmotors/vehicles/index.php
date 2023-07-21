<?php
// This is the VEHICLES controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../models/main-model.php';

// Get the vehicles model
require_once '../models/vehicles-model.php';

// Get the vehicles model
require_once '../models/uploads-model.php';

// Get the functions library 
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = navigationBar($classifications);

// Watch for and capture name-value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

// Control structures to deliver views
switch ($action) {
    case 'addClassification':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the classification name from the form
            $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            // Perform data validation and error handling
            if (empty($classificationName)) {
                $message = '<p>Please enter a classification name.</p>';
            } else {
                // Code to insert the new classification into the database
                // Call the newCarClassification() function from the vehicles model
                $rowsChanged = newCarClassification($classificationName);

                // Check if the insertion was successful
                if ($rowsChanged === 1) {
                    // Redirect to the vehicles controller without a name-value pair
                    header('Location: /phpmotors/vehicles/index.php');
                    exit;
                } else {
                    $message = '<p>Failed to insert the classification into the database.</p>';
                }
            }
        }
        include '../view/add-classification.php';
        exit;
        break;
    case 'addVehicle':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the names from the form
            $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            // Perform data validation and error handling

            if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invColor) || empty($classificationId)) {
                $message = '<p>Please fill in all the fields.</p>';
            } else {
                // Code to insert the new vehicle into the database
                // Call the newCarClassification() function from the vehicles model
                $addNewVehicle = newVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invColor, $classificationId);

                // Check if the insertion was successful
                if ($addNewVehicle === 1) {
                    $message = '<p> Vehicle Registration Successful</p>';
                } else {
                    $message = '<p>Failed to insert new vehicle into the database. Please try again!</p>';
                }
            }
        }
        include '../view/add-vehicle.php';
        exit;
        break;
        /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */
    case 'getInventoryItems':
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray);
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        break;
    case 'updateVehicle':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the names from the form
            $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Perform data validation and error handling

            if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invColor) || empty($classificationId)) {
                $message = '<p class="err-msg">Please complete all information for the updated item! Double check the classification of the item.</p>';
            } else {
                // Code to insert the new vehicle into the database
                // Call the newCarClassification() function from the vehicles model
                $updateResult  = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invColor, $classificationId, $invId);

                // Check if the insertion was successful
                if ($updateResult) {
                    $message = "<p class='msg'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                    $_SESSION['message'] = $message;
                    header('location: /phpmotors/vehicles/');
                    exit;
                } else {
                    $message = '<p class="err-msg">Error. The new vehicle was not added.</p>';
                    include '../view/vehicle-update.php';
                    exit;
                }
            }
        }
        include '../view/vehicle-update.php';
        exit;
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        break;
    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='msg'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='err-msg'>Error: $invMake $invModel was not
            deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);
        if (!count($vehicles)) {
            $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        // echo $vehicleDisplay;
        // exit;
        include '../view/classification.php';
        break;

    case 'vehicleInfo':
        $vehicleId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // echo $vehicleId;
        $vehicleInfo = getVehicleInfo($vehicleId);

        if (!$vehicleInfo) {
            $message = "<p class='err-msg'>Sorry, no vehicle information could be found.</p>";
        } else {
            $vehiclesInfoDisplay = displayVehicleInfo($vehicleInfo);
        }
        include '../view/vehicle-detail.php';
        break;

    default:
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicle-management.php';
        break;
}
