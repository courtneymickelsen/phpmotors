<div>
  <img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo" id="logo">
  <?php
  if (isset($_SESSION['loggedin'])){
    echo '<a href="/phpmotors/accounts/?">Welcome, ' . $_SESSION['clientData']['clientFirstname'] . '</a>';
    echo '<a href="/phpmotors/accounts?action=Logout" title="Log out of your PHP Motors account" id="account">Log Out</a>';
  } else {
  echo '<a href="/phpmotors/accounts?action=login" title="Login or Register with PHP Motors" id="account">My Account</a>';
  }
  echo '<a href="/phpmotors/search/index.php">&#x1F50E;</a>';
  ?>
</div>