<!-- Accounts Controller -->

<?php
// create or access the session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
require_once '../library/functions.php';

$classifications = getClassifications();
$navList = buildNavList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
  case 'login':
    include '../view/login.php';
  break;

  case 'Login':
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $checkPassword = checkPassword($clientPassword);
    // A valid password exists, proceed with the login process
    if(empty($clientEmail) || empty($clientPassword)){
      // echo $clientEmail;
      // echo $clientPassword;
      $_SESSION['message'] = '<p class="notice">Please provide information for all empty form fields.</p>';
      include '../view/login.php';
      exit;
    }
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if(!$hashCheck) {
      $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view
    include '../view/admin.php';
    exit;
  break;

  case 'registration':
    include '../view/registration.php';
  break;

  case 'register':
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);
    
    $emailAlreadyUsed = checkExistingEmail($clientEmail);
    if($emailAlreadyUsed){
      $_SESSION['message'] = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
    }

    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
      $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
      include '../view/registration.php';
      exit; 
    }

    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    if($regOutcome === 1){
      // setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['firstname'] = $clientFirstname;
      $_SESSION['message'] = "Thanks for registering, $clientFirstname. Please use your email and password to login.";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
    } else {
      $_SESSION['message'] = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }
  break;

  case 'Logout':
    unset($_SESSION['clientData']);
    unset($_SESSION['firstname']);
    unset($_SESSION['loggedin']);
    unset($_SESSION['message']);
    
    session_destroy();
    header('Location: /phpmotors/');
  break;
  
  case 'clientUpdate':
    include '../view/client-update.php';
  break;

  case 'updateAccount':
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
      $emailAlreadyUsed = checkExistingEmail($clientEmail);
      if($emailAlreadyUsed){
        $_SESSION['message'] = '<p class="notice">An account with that email address already exists. Do you want to login instead?</p>';
        include '../view/client-update.php';
        exit;
      }
    }

    $clientEmail = checkEmail($clientEmail);
    $clientId = $_SESSION['clientData']['clientId'];
    if ($emailAlreadyUsed) {
      $_SESSION['message'] = '<p class="notice">That email address has already been used. Please choose a different one.</p>';
      include '../view/client-update.php';
      exit;
    } elseif (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
      $_SESSION['message'] = '<p class="notice">That email address has already been used. Please choose a different one.</p>';
      include '../view/client-update.php';
      exit;
    }

    $updateResult = updateAccount($clientId, $clientFirstname, $clientLastname, $clientEmail);
    if($updateResult === 1){
      $message = "<p class='notify'>Congratulations, your information was successfully updated.</p>";
    } else {
      $message = "<p class='notice'>We're sorry, but your information failed to update. Please try again.</p>";
    }
    $_SESSION['message'] = $message;
    $clientData = getClientById($clientId);
    $_SESSION['clientData'] = $clientData;
    header('Location: /phpmotors/accounts/?');
  break;

  case 'updatePassword':
    $clientId = $_SESSION['clientData']['clientId'];
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $checkPassword = checkPassword($clientPassword);
    
    if (empty($clientPassword)){
      $_SESSION['message'] = '<p>Please provide a new password in the password field.</p>';
      include '../view/client-update.php';
      exit;
    } elseif (empty($checkPassword)){
      $_SESSION['message'] = '<p>Please ensure that the password matches the requirements.</p>';
      include '../view/client-update.php';
      exit;
    }
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    $updateResult = updatePassword($clientId, $hashedPassword);

    if($updateResult === 1){
      $message = "<p class='notify'>Congratulations, your password was successfully updated.</p>";
    } else {
      $message = "<p class='notice'>We're sorry, but your password failed to update. Please try again.</p>";
    }
    $_SESSION['message'] = $message;
    $clientData = getClientById($clientId);
    $_SESSION['clientData'] = $clientData;
    header('Location: /phpmotors/accounts/?');

  break;
  
  default:
    include '../view/admin.php';
  break;
}

?>