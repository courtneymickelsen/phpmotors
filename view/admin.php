<?php
if (!($_SESSION['loggedin'] == TRUE)) {
    header('Location: /phpmotors/');
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" type="text/css" media="screen">
    <title>Admin Page | PHP Motors</title>
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
        <?php
          echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'];
        ?>
      </h1>
      <p>You are currently logged in.</p>
      <?php
        if(isset($_SESSION['message'])){
          echo $_SESSION['message'];
        }
      ?>
      <a href="../accounts/?action=clientUpdate">Update Account Information</a>
      <?php
      if ($_SESSION['clientData']['clientLevel'] > 1){
        echo "<h2>Vehicles Management</h2>";
        echo "<p>Use the link below to update vehicle classifications and inventory.</p>";
        echo "<p><a href='../vehicles/?'>Manage Vehicle Information</a></p>";
      }
      ?>
    </main>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>
  </div>
</body>
</html>