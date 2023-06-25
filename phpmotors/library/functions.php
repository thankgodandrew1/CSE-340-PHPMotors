<?php
//  Library of custom functions 

function checkEmail($clientEmail)
{
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function navigationBar($classifications)
{
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
            . urlencode($classification['classificationName']) .
            "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications)
{
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

// New function to build a display of vehicles within an unordered list.
function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<a href='/phpmotors/vehicles/index.php?action=vehicleInfo&vehicle=$vehicle[invId]'>";
        $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>$vehicle[invPrice]</span>";
        $dv .= '</a>';
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}


// New function to build a display of vehicles.
function buildVehiclesView($vehicleInfo)
{
    $dv = "<section class='car-info'>";
    $dv .= '<div class="car-img-price">';
    $dv .= "<img src='{$vehicleInfo['invImage']}' alt='{$vehicleInfo['invMake']}-{$vehicleInfo['invModel']}' class='car-image'>";
    $dv .= '<h2>Price: $' . number_format($vehicleInfo['invPrice']) . '</h2>';
    $dv .= '</div>';
    $dv .= '<div class="car-details">';
    $dv .= "<h2 class='car-padding'>{$vehicleInfo['invMake']} {$vehicleInfo['invModel']} Details</h2>";
    $dv .= "<p class='car-padding car-bg'>{$vehicleInfo['invDescription']}</p>";
    $dv .= "<p class='car-padding'>Color: {$vehicleInfo['invColor']}</p>";
    $dv .= "<p class='car-padding car-bg'># in Stock: {$vehicleInfo['invStock']}</p>";
    $dv .= '</div>';
    $dv .= '</section>';
    return $dv;
}
