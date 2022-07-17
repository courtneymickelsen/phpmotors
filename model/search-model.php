<?php

function getSearchMatches($searchTerm){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory
            WHERE CONCAT(invColor, invMake, invModel, invYear) 
            LIKE CONCAT("%", :searchTerm, "%")';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    $searchMatches = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $searchMatches;
}

// I decided to split up the results rather than re-querying from the database each time,
// but I decided to keep the function here instead of functions.php so you could find it easier
function getPageSearchMatches($numResults, $pageNumber, $searchMatches){
  $startNumber = ($pageNumber - 1) * 10;
  $pageSearchMatches = [];

  for ($i = 0; $i < 10 and ($startNumber + $i) < $numResults; $i++){
    $pageSearchMatches[] = $searchMatches[$startNumber + $i];
  }

  return $pageSearchMatches;
}

?>