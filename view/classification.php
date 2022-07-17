<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" type="text/css" media="screen">
    <title>
      <?php echo $classificationName; ?> 
    Vehicles | PHP Motors, Inc.</title>
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
    <h1>
      <?php echo $classificationName; ?> Vehicles
    </h1>
    <?php if(isset($message)){
      echo $message; }
    ?>
    <?php if(isset($vehicleDisplay)){
      echo $vehicleDisplay;
    } ?>
    </main>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>
  </div>
</body>
</html>
