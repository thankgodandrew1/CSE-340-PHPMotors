<?php
// This is the account controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../models/main-model.php';

// Get the accounts model
require_once '../models/accounts-model.php';

// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = navigationBar($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include '../view/login.php';
        break;
    case 'registration':
        include '../view/registration.php';
        break;
    case 'register':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));

        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // Checking for an existing email address
        $existingEmail = checkExistingEmail($clientEmail);

        if ($existingEmail) {
            $message = '<p class="msg">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        // Validate both Email and Password 

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);


        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $newReg = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check if the registration was successful
        if ($newReg === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'Login':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));

        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // Validate both Email and Password 
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        if (empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        include '../view/admin.php';
        exit;
        break;
    case 'Logout':
        session_destroy();
        header('Location: /phpmotors/accounts/?action=login');
        break;
    case 'updateAccountView':
        include '../view/client-update.php';
        break;
    case 'updateAccount':
        $clientId = $_SESSION['clientData']['clientId'];
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        // $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // Checks if the new email address is different from the one in the session
        if ($clientEmail !== $_SESSION['clientData']['clientEmail']) {
            $existingEmail = checkExistingEmail($clientEmail);
            if ($existingEmail) {
                $message = '<p class="msg">That email address already exists. Please choose a different email.</p>';
                include '../view/client-update.php';
                exit;
            }
        }

        // Validate Email
        $clientEmail = checkEmail($clientEmail);

        // Validate other form fields
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $message = '<p>Please provide information for all required fields.</p>';
            include '../view/client-update.php';
            exit;
        }

        $updateInfo = updatePersonalInfo($clientFirstname, $clientLastname, $clientEmail, $clientId);
        // Retrieve the client data from the database based on the clientId
        $clientData = getClientById($clientId);
        // array_pop($clientData);

        // Update the client data into the session
        $_SESSION['clientData'] = $clientData;

        // Check and report the result
        if ($updateInfo === 1) {
            $message = "<p class='msg'>Information update was successful.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p class='err-msg'>Failed to update information. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        }
        break;
    case 'updatePassword':
        $clientId = $_SESSION['clientData']['clientId'];
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $checkPassword = checkPassword($clientPassword);


        if (empty($checkPassword)) {
            $message = '<p class="msg">Please provide information for the password field.</p>';
            include '../view/client-update.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $newPassword = updateClientPassword($hashedPassword, $clientId);

        // $clientData = getClientById($clientId);
        // array_pop($clientData);

        // Update the client data into the session
        // $_SESSION['clientData'] = $clientData;

        // Check and report the result in admin.php view
        if ($newPassword == 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $message = "<p class='msg'>You've successfully updated your password.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p class='err-msg'>Failed to update password. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('Location: /phpmotors/accounts/');
            exit;
        }
        break;
    default:
        include '../view/admin.php';
        break;
}
