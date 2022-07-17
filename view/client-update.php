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
    <title>Update Account Information | PHP Motors</title>
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
      <h1>Update Account Information</h1>
      <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
      ?>
      <h2>Update Name or Email Address</h2>
      <form method="post" action="/phpmotors/accounts/index.php">
          <label>*First Name: <input type="text" name="clientFirstname" id="firstName" value="<?php if(isset($clientFirstname)){echo $clientFirstname;} elseif (isset($_SESSION['clientData']['clientFirstname'])){ echo $_SESSION['clientData']['clientFirstname']; } ?>" required></label>
          <label>*Last Name: <input type="text" name="clientLastname" id="lastName" value="<?php if(isset($clientLastName)){echo $clientLastName;} elseif (isset($_SESSION['clientData']['clientLastname'])){ echo $_SESSION['clientData']['clientLastname']; }?>" required></label>
          <label>*Email Address: <input type="email" name="clientEmail" id="email" value="<?php if(isset($clientEmail)){echo $clientEmail;} elseif (isset($_SESSION['clientData']['clientEmail'])){ echo $_SESSION['clientData']['clientEmail']; } ?>" required></label>
          <input type="hidden" name="action" value="updateAccount">
          <label><input type="submit" value="Update"></label>
        </form>
        <br>
        <h2>Update Password</h2>
        <form method="post" action="/phpmotors/accounts/index.php">
            <span>Warning! This will change your current password permanently.</span>
            <span>In your new password, please include at least 8 characters, including 1 uppercase letter, 1 number, and 1 special character.</span>
            <label>*Password: <input type="password" name="clientPassword" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required></label>
            <input type="hidden" name="action" value="updatePassword">
            <label><input type="submit" value="Update"></label>
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
