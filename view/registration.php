<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" type="text/css" media="screen">
    <title>Sign Up | PHP Motors</title>
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
      <h1>Sign Up</h1>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
      <form method="post" action="/phpmotors/accounts/index.php">
          <label>*First Name: <input type="text" name="clientFirstname" id="firstName" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required></label>
          <label>*Last Name: <input type="text" name="clientLastname" id="lastName" <?php if(isset($clientLastName)){echo "value='$clientLastName'";} ?> required></label>
          <label>*Email Address: <input type="email" name="clientEmail" id="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required></label>
          <span>In your password, please include at least 8 characters, including 1 uppercase letter, 1 number, and 1 special character.</span>
          <label>*Password: <input type="password" name="clientPassword" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required></label>
          <label><input type="submit" value="Register"></label>
          <input type="hidden" name="action" value="register">
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
