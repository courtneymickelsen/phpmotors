<?php
if (!($_SESSION['loggedin'] == TRUE and $_SESSION['clientData']['clientLevel'] > 1)){
  header('Location: /phpmotors/');
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
		    echo "Delete $invInfo[invMake] $invInfo[invModel]";
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
		          echo "Delete $invInfo[invMake] $invInfo[invModel]";
            }
          ?>
      </h1>
      <?php
      if (isset($message)) {
        echo $message;
      }
      ?>
      <p>*All Fields are Required</p>
      <p class='notice'>Warning! This will permanently delete the given vehicle and cannot be undone.</p>
      <form method="post" action="/phpmotors/vehicles/index.php">
        <?php echo $classificationList; ?>
        <label>Make: <input type="text" name="invMake" id="invMake" required readonly <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>></label>
        <label>Model: <input type="text" name="invModel" id="invModel" required readonly <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>></label>
        <label>Description: <textarea name="invDescription" id="invDescription" required readonly><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription'];}?></textarea></label>
        <input type="hidden" name="action" value="deleteVehicle">
        <input type="hidden" name="invId" value="
          <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>
        ">
        <label><input type="submit" name="submit" value="Delete Vehicle" ></label>
      </form>
    </main>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php"; ?>
    </footer>
  </div>
</body>
</html>