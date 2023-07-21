<?php
/* **********************************
   * Search Model
  ********************************** */
// Get all vehicles matching search criteria
function getSearchResults($searchString)
{
    $db = phpmotorsConnect();
    $sql = "SELECT * FROM inventory AS inv WHERE CONCAT(invYear, invMake, invModel, invDescription, invColor) LIKE CONCAT('%', :searchString, '%')
            ORDER BY invModel ASC, invMake ASC";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':searchString', $searchString, PDO::PARAM_STR);
    $stmt->execute();
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $searchResults;
}

// Get paginated results
function paginate($searchString, $startIndex, $resultsPerPage)
{
    $db = phpmotorsConnect();
    $sql = "SELECT * FROM inventory AS inv WHERE CONCAT(invYear, invMake, invModel, invDescription, invColor) LIKE CONCAT('%', :searchString, '%')
            ORDER BY invModel ASC, invMake ASC LIMIT $startIndex, $resultsPerPage";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':searchString', $searchString, PDO::PARAM_STR);
    $stmt->execute();
    $paginatedResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $paginatedResults;
}
