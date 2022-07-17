<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" type="text/css" media="screen">
    <title>Login | PHP Motors</title>
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
      <h1>User Login</h1>
      <?php
      if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
      }
      ?>
      <form action="/phpmotors/accounts/index.php" method="post">
        <label for="username">Username/Email: <input type="email" name="clientEmail" id="username" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required></label>
        <span>In your password, please include at least 8 characters, including 1 uppercase letter, 1 number, and 1 special character.</span>
        <label>Password: <input type="password" name="clientPassword" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required></label>
        <input type="hidden" name="action" value="Login">
        <label><input type="submit"></label>
      </form>
      <p>Don't have an account? <a href="/phpmotors/accounts?action=registration">Sign Up!</a></p>
    </main>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>
  </div>
</body>
</html>
