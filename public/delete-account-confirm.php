<?php
session_start();
if($_SESSION['validUser'] == 'yes' && $_REQUEST['userID'] == $_SESSION['userID'] || $_SESSION['validEmployee'] == 'yes') {
  require_once('../inc/Accounts.class.php');

  $account = new Accounts();

  $accountDataArray = array();

  // load the user if we have it
  if (isset($_REQUEST['accountID']) && $_REQUEST['accountID'] > 0)
  {
      $account->load($_REQUEST['accountID']);
      $accountDataArray = $account->accountData;
  }
  require_once('../tpl/delete-account-confirm.tpl.php');

} else {
  header("location: access-denied.php");
  exit;
}

?>
