<?php
session_start();
if($_SESSION['validUser'] == 'yes' && $_REQUEST['userID'] == $_SESSION['userID'] || $_SESSION['validEmployee'] == 'yes') {
require_once('../inc/Users.class.php');
require_once('../inc/Accounts.class.php');

$user = new Users();
$userDataArray = array();

$account = new Accounts();

$accountDataArray = array();
$accountErrorsArray = array();

// load the account if we have it
if (isset($_REQUEST['accountID']) && $_REQUEST['accountID'] > 0)
{
    $account->load($_REQUEST['accountID']);
    $accountDataArray = $account->accountData;
}

if (isset($_REQUEST['userID']) && $_REQUEST['userID'] > 0)
{
    $user->load($_REQUEST['userID']);
    $userDataArray = $user->userData;
}


// apply the data if we have new data
if (isset($_POST['Save'])) {
    $accountDataArray = $_POST;
    //var_dump($accountDataArray);
    //sanitize

    $accountDataArray = $account->sanitize($accountDataArray);
    //var_dump("sanitized");
    $account->set($accountDataArray);

    //validate
    if ($account->validate())
    {

        //  save
        if ($account->save())
        {

          header("location: account-save-success.php");


        }
        else
        {
            $accountErrorsArray[] = "Save failed";
        }
    }
    else
    {
        $accountErrorsArray = $account->errors;
        $accountDataArray = $account->accountData;
    }

    //var_dump($faqErrorsArray);
  }
    require_once('../tpl/account-input.tpl.php');
  } else {
    header("location: access-denied.php");
    exit;
  }
?>
