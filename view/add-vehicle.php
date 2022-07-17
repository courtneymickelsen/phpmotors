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
    }
    $classificationList .= ">$classification[classificationName]</option>";
  }
}
$classificationList .= "</select></label>";
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" type="text/css" media="screen">
    <title>Add Vehicle | PHP Motors</title>
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
        <h1>Add Vehicle</h1>
        <?php
        if (isset($message)) {
          echo $message;
        }
        ?>
        <p>*All Fields are Required</p>
        <form method="post" action="/phpmotors/vehicles/index.php">
          <?php echo $classificationList; ?>
          <label>Make: <input type="text" name="invMake" id="invMake" <?php if (isset($invMake)) {echo "value='$invMake'";} ?> required></label>
          <label>Model: <input type="text" name="invModel" id="invModel" <?php if (isset($invModel)) {echo "value='$invModel'";} ?> required></label>
          <label>Description: <textarea name="invDescription" id="invDescription" required><?php if (isset($invDescription)) {echo $invDescription;} ?></textarea></label>
          <label>Image Path: <input type="text" name="invImage" id="invImage" value="phpmotors/images/no-image.png" <?php if (isset($invImage)) {echo "value='$invImage'";} ?> required></label>
          <label>Thumbnail Path: <input type="text" name="invThumbnail" id="invThumbnail" value="phpmotors/images/no-image.png" <?php if (isset($invThumbnail)) {echo "value='$invThumbnail'";} ?> required></label>
          <label>Price: <input type="number" name="invPrice" id="invPrice" <?php if (isset($invPrice)) {echo "value='$invPrice'";} ?> required></label>
          <label>Amount in Stock: <input type="number" name="invStock" id="invStock" <?php if (isset($invStock)) {echo "value='$invStock'";} ?> required></label>
          <label>Color: <input type="text" name="invColor" id="invColor" <?php if (isset($invColor)) {echo "value='$invColor'";} ?> required></label>
          <input type="hidden" name="action" value="verifyVehicle">
          <label><input type="submit" value="Add Vehicle" ></label>
        </form>
    </main>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php"; ?>
    </footer>
  </div>
</body>
</html>