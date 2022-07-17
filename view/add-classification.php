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
    <title>Add Classification | PHP Motors</title>
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
      <h1>Add Classification</h1>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
      <form method="post" action="/phpmotors/vehicles/index.php">
          <label>*Classification Name (30 characters or less): <input type="text" name="classificationName" id="classificationName" pattern="[A-Za-z0-9 ]{0,30}" required></label>
          <input type="hidden" name="action" value="verifyClassification">
          <label><input type="submit" value="Add Classification"></label>
        </form>
        <p>*Required Field</p>
    </main>
    <hr>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>
  </div>
</body>
</html>