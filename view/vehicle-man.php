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
    <title>Vehicle Management | PHP Motors</title>
</head>
<body>
  <div id="wrapper">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/header.php" ?>
    </header>
    <nav>
      <?php echo $navList; ?>
    </nav>
    <main>
      <h1></h1>
      <ul>
          <li><a href="/phpmotors/vehicles?action=addClassification">Add Classification</a></li>
          <li><a href="/phpmotors/vehicles?action=addVehicle">Add Vehicle</a></li>
      </ul>
      <?php
        if (isset($_SESSION['message'])) { 
         echo $_SESSION['message']; 
        } 
        if (isset($classificationList)) { 
         echo '<h2>Vehicles By Classification</h2>'; 
         echo '<p>Choose a classification to see those vehicles</p>'; 
         echo $classificationList; 
        }
      ?>
      <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
      </noscript>
      <table id="inventoryDisplay"></table>
    </main>
    <hr>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>
  </div>
</body>
<script src="../js/inventory.js"></script>
</html>