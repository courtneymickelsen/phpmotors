<?php
if (!($_SESSION['loggedin'] == TRUE and $_SESSION['clientData']['clientLevel'] > 1)){
  header('Location: /phpmotors/');
} else {
  $classificationList = "<label>Classification: <select id='classificationId' name='classificationId'>";
  $classificationList .= "<option>Choose a Car Classification...</option>";
  foreach ($classifications as $classification){
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)){
      if($classification['classificationId'] == $classificationId){
        $classificationList .= ' selected';
      }
    } elseif(isset($invInfo['classificationId'])){
      if($classification['classificationId'] === $invInfo['classificationId']){
       $classificationList .= ' selected';
      }
    $classificationList .= ">$classification[classificationName]</option>";
  }
}
$classificationList .= "</select></label>";
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" type="text/css" media="screen">
    <title>
      <?php
      if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		    echo "Modify $invInfo[invMake] $invInfo[invModel]";
      } elseif(isset($invMake) && isset($invModel)) { 
		    echo "Modify $invMake $invModel"; 
      }
      ?>
     | PHP Motors</title>
</head>
<body>
  <div id="wrapper">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/header.php"; ?>
    </header>
    <nav>
      <?php echo $navList; ?>
    </nav>
    <main>
        <h1>
          <?php
            if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		          echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif(isset($invMake) && isset($invModel)) { 
		          echo "Modify $invMake $invModel"; 
            }
          ?>
      </h1>
      <?php
      if (isset($message)) {
        echo $message;
      }
      ?>
      <p>*All Fields are Required</p>
      <form method="post" action="/phpmotors/vehicles/index.php">
        <?php echo $classificationList; ?>
        <label>Year: <input type="number" name="invYear" id="invYear" required <?php if(isset($invYear)){ echo "value='$invYear'"; } elseif(isset($invInfo['invYear'])) {echo "value='$invInfo[invYear]'"; }?>></label>
        <label>Make: <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>></label>
        <label>Model: <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>></label>
        <label>Description: <textarea name="invDescription" id="invDescription" required><?php if(isset($invDescription)){ echo $invDescription;} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription'];}?></textarea></label>
        <label>Price: <input type="number" name="invPrice" id="invPrice" required <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>></label>
        <label>Miles: <input type="number" name="invMiles" id="invMiles" required <?php if(isset($invMiles)){ echo "value='$invMiles'"; } elseif(isset($invInfo['invMiles'])) {echo "value='$invInfo[invMiles]'"; }?>></label>
        <label>Color: <input type="text" name="invColor" id="invColor" required <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>></label>
        <label>Image Path: <input type="text" name="invImage" id="invImage" value="phpmotors/images/no-image.png" required <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>></label>
        <label>Thumbnail Path: <input type="text" name="invThumbnail" id="invThumbnail" value="phpmotors/images/no-image.png" required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>></label>
        <input type="hidden" name="action" value="updateVehicle">
        <input type="hidden" name="invId" value="
          <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
          elseif(isset($invId)){ echo $invId; } ?>
        ">
        <label><input type="submit" name="submit" value="Update Vehicle" ></label>
      </form>
    </main>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php"; ?>
    </footer>
  </div>
</body>
</html>