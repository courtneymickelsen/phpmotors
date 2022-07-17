<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" type="text/css" media="screen">
    <title>Search | PHP Motors</title>
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
      <h1>Search</h1>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
      <form method="post" action="/phpmotors/search/index.php">
        <label>Search Here: <input type='text' name='searchTerm' id='searchTerm' <?php if(isset($searchTerm)){echo "value='$searchTerm'";} ?> required placeholder='Enter search term...'></label>
        <input type='hidden' name='action' value='searchResults'>
        <label><input type='submit' value='Get Results'></label>
      </form>
    </main>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>
  </div>
</body>
</html>
