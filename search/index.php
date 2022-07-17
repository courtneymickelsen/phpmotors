<?php
// create or access the session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/uploads-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/search-model.php';
require_once '../library/functions.php';

$classifications = getClassifications();
$navList = buildNavList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'searchResults':
        $searchTerm = trim(filter_input(INPUT_POST, 'searchTerm', FILTER_SANITIZE_STRING)) ?: trim(filter_input(INPUT_GET, 'searchTerm', FILTER_SANITIZE_STRING));
        if (empty($searchTerm)){
            $message = "Please type something in the search box before continuing.";
            include '../view/search.php';
            break;
        }

        $searchMatches = getSearchMatches($searchTerm);
        $numResults = sizeof($searchMatches);
        if ($numResults == 0){
            $message = "We're sorry, we could not find any results matching '$searchTerm'.";
            include '../view/search-results.php';
            break;
        }
        $numPages = ceil($numResults / 10);
        $pageNumber = filter_input(INPUT_GET, 'pageNumber', FILTER_SANITIZE_NUMBER_INT);
        if (empty($pageNumber)) {
          $pageNumber = 1;
        }

        if ($numPages > 1){
            $pageSearchMatches = getPageSearchMatches($numResults, $pageNumber, $searchMatches);
            $searchResults = buildSearchResults($numResults, $pageSearchMatches, $searchTerm);
            $pageButtons = buildPageButtons($numPages, $pageNumber, $searchTerm);

        } else {
            $searchResults = buildSearchResults($numResults, $searchMatches, $searchTerm);
        }
        include '../view/search-results.php';
    break;

    default:
        include '../view/search.php';
    break;
}
?>