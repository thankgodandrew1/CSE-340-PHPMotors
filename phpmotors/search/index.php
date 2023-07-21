<?php
// This is the SEARCH controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../models/main-model.php';

// Get the vehicles model
require_once '../models/vehicles-model.php';

// Get the functions library 
require_once '../library/functions.php';

// Get the search model 
require_once '../models/search-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = navigationBar($classifications);

// Watch for and capture name-value pairs
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'search':
        $searchString = trim(filter_input(INPUT_POST, 'searchString', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ?: trim(filter_input(INPUT_GET, 'searchString', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // check for missing data
        if (empty($searchString)) {
            $message = '<p class="err-msg">You must provide a search string. Try your search again.</p>';
            include '../view/search.php';
            exit;
        }
        // Look for this as part of the link and if it doesn't exist, default it to page 1
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
        if (empty($page)) {
            $page = 1;
        }
        // Send the search string to the model
        $searchResults = getSearchResults($searchString);

        $resNum = count($searchResults);
        if ($resNum < 1) {
            $message = "<h3 class='err-msg'>Sorry, no results were found to match '$searchString'. Please check search term and try again.</h3>";
        } elseif ($resNum > 10) {
            // Invoke pagination 
            $entriesPerPage = 10; // Number of entries per page (10)
            $totalPages = ceil($resNum / $entriesPerPage);
            $startIndex = ($page - 1) * $entriesPerPage;
            $resultsPerPage = $entriesPerPage;

            $paginatedResults = paginate($searchString, $startIndex, $resultsPerPage);

            // This is the pagination bar (e.g. the HTML that goes under your search results)
            $paginationBar = pagination($totalPages, $page, $searchString);
            // Build the results page based on the $paginatedResults above
            $searchDisplay = buildSearchResults($resNum, $searchString, $paginatedResults, $paginationBar);
        } else {
            // Since there is only one page, build the display based on the original query.
            $searchDisplay = buildSearchResults($resNum, $searchString, $searchResults, NULL);
        }

        include '../view/search.php';
        exit;
        break;
    default:
        include '../view/search.php';
        break;
}
